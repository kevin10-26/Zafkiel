<?php declare(strict_types=1);

namespace Zafkiel\Infrastructure\Services;

use Zafkiel\Domain\Interfaces\Services\SessionManagerServiceInterface;
use Zafkiel\Domain\Interfaces\iCache;
use Zafkiel\Infrastructure\Persistence\AdminDoctrineRepository;
use Zafkiel\Domain\Entities\ZafkielAdmin;

class SessionManagerService implements SessionManagerServiceInterface
{
    private const SESSION_PREFIX = 'session:';
    private const ONLINE_USERS_KEY = 'online_users';
    private const USER_TTL = 3600; // 1 heure

    public function __construct(
        private readonly iCache $cache,
        private readonly AdminDoctrineRepository $adminDoctrine
    ) {}

    /**
     * Enregistre une session utilisateur active
     */
    public function registerUserSession(int $adminId, array $metadata = []): void
    {
        $admin = $this->adminDoctrine->fetch($adminId);
        if (!$admin) {
            return;
        }

        $sessionId = $this->generateSessionId($adminId);
        $sessionData = [
            'adminId' => $adminId,
            'adminName' => $admin->getAdminName(),
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'lastActivity' => time(),
            'metadata' => $metadata
        ];
        
        // Stocker les données de session
        $this->cache->set(
            self::SESSION_PREFIX . $sessionId,
            json_encode($sessionData),
            self::USER_TTL
        );
        
        // Ajouter à l'ensemble des utilisateurs en ligne avec timestamp comme score
        $this->cache->zAdd(self::ONLINE_USERS_KEY, $sessionId, time());
    }
    
    /**
     * Met à jour l'activité d'un utilisateur
     */
    public function updateUserActivity(int $adminId): void
    {
        $sessionId = $this->generateSessionId($adminId);
        $sessionKey = self::SESSION_PREFIX . $sessionId;
        
        // Récupérer les données de session existantes
        $sessionDataJson = $this->cache->get($sessionKey);
        if ($sessionDataJson) {
            $sessionData = json_decode($sessionDataJson, true);
            $sessionData['lastActivity'] = time();
            
            // Mettre à jour la session et prolonger sa durée
            $this->cache->set($sessionKey, json_encode($sessionData), self::USER_TTL);
            
            // Mettre à jour le score dans l'ensemble des utilisateurs en ligne
            $this->cache->zAdd(self::ONLINE_USERS_KEY, $sessionId, time());
        }
    }
    
    /**
     * Déconnecte un utilisateur
     */
    public function logoutUser(int $adminId): void
    {
        $sessionId = $this->generateSessionId($adminId);
        
        // Supprimer la session
        $this->cache->delete(self::SESSION_PREFIX . $sessionId);
        
        // Supprimer de l'ensemble des utilisateurs en ligne
        $this->cache->zRem(self::ONLINE_USERS_KEY, $sessionId);
    }
    
    /**
     * Récupère la liste des utilisateurs en ligne
     */
    public function getOnlineUsers(int $minutes = 60): array
    {
        // Nettoyer d'abord les sessions expirées
        $this->cleanExpiredSessions();
        
        // Récupérer la liste des utilisateurs actifs dans les X dernières minutes
        $cutoff = time() - ($minutes * 60);
        
        // Utiliser un script Lua pour récupérer les données de session en une seule opération
        $script = <<<LUA
            local users = redis.call('ZRANGEBYSCORE', KEYS[1], ARGV[1], '+inf')
            local result = {}
            for i, sessionId in ipairs(users) do
                local sessionData = redis.call('GET', KEYS[2] .. sessionId)
                if sessionData then
                    table.insert(result, sessionData)
                end
            end
            return result
        LUA;
        
        $results = $this->cache->eval(
            $script, 
            [self::ONLINE_USERS_KEY, self::SESSION_PREFIX], 
            [$cutoff]
        );
        
        // Transformer les résultats en tableau PHP
        $onlineUsers = [];
        foreach ($results as $sessionData) {
            $userData = json_decode($sessionData, true);
            if ($userData) {
                $onlineUsers[] = $userData;
            }
        }
        
        return $onlineUsers;
    }
    
    /**
     * Vérifie si un utilisateur est en ligne
     */
    public function isUserOnline(int $adminId): bool
    {
        $sessionId = $this->generateSessionId($adminId);
        $sessionKey = self::SESSION_PREFIX . $sessionId;
        
        // Vérifier si la session existe et récupérer son contenu
        if ($this->cache->exists($sessionKey)) {
            $sessionData = $this->cache->get($sessionKey);
            if ($sessionData) {
                $data = json_decode($sessionData, true);
                return ($data && isset($data['lastActivity']) && 
                        $data['lastActivity'] > (time() - self::USER_TTL));
            }
        }
        
        return false;
    }
    
    /**
     * Récupère des statistiques sur les sessions utilisateurs
     */
    public function getSessionStatistics(): array
    {
        // Récupérer les utilisateurs en ligne pour différentes périodes
        $onlineUsers = $this->getOnlineUsers();
        $onlineCount = count($onlineUsers);
        $onlineLast15Min = count($this->getOnlineUsers(15));
        $onlineLast5Min = count($this->getOnlineUsers(5));
        
        // Récupérer le nombre total d'administrateurs
        $allAdmins = $this->adminDoctrine->findAll();
        $totalAdmins = count($allAdmins);
        
        // Collecter des statistiques supplémentaires (navigateurs, systèmes, etc.)
        $browsers = $this->collectBrowserStats($onlineUsers);
        $ips = $this->collectIpStats($onlineUsers);
        
        return [
            'totalUsers' => $totalAdmins,
            'onlineUsers' => $onlineCount,
            'onlineLast15Min' => $onlineLast15Min,
            'onlineLast5Min' => $onlineLast5Min,
            'percentage' => $totalAdmins > 0 ? ($onlineCount / $totalAdmins) * 100 : 0,
            'browsers' => $browsers,
            'ips' => $ips
        ];
    }
    
    /**
     * Nettoie les sessions expirées
     */
    private function cleanExpiredSessions(): void
    {
        $cutoff = time() - self::USER_TTL;
        
        // Supprimer les entrées plus anciennes que le TTL
        $this->cache->zRemRangeByScore(self::ONLINE_USERS_KEY, 0, $cutoff);
        
        // Script Lua pour supprimer les sessions expirées
        $script = <<<LUA
            local cutoff = ARGV[1]
            local sessions = redis.call('ZRANGEBYSCORE', KEYS[1], 0, cutoff)
            for i, sessionId in ipairs(sessions) do
                redis.call('DEL', KEYS[2] .. sessionId)
            end
            return #sessions
        LUA;
        
        $this->cache->eval(
            $script, 
            [self::ONLINE_USERS_KEY, self::SESSION_PREFIX], 
            [$cutoff]
        );
    }
    
    /**
     * Collecte des statistiques sur les navigateurs des utilisateurs en ligne
     */
    private function collectBrowserStats(array $onlineUsers): array
    {
        $browsers = [];
        foreach ($onlineUsers as $user) {
            $userAgent = $user['userAgent'] ?? 'unknown';
            $browser = $this->parseBrowser($userAgent);
            
            if (!isset($browsers[$browser])) {
                $browsers[$browser] = 0;
            }
            
            $browsers[$browser]++;
        }
        
        return $browsers;
    }
    
    /**
     * Collecte des statistiques sur les adresses IP des utilisateurs en ligne
     */
    private function collectIpStats(array $onlineUsers): array
    {
        $ips = [];
        foreach ($onlineUsers as $user) {
            $ip = $user['ip'] ?? 'unknown';
            
            if (!isset($ips[$ip])) {
                $ips[$ip] = 0;
            }
            
            $ips[$ip]++;
        }
        
        return $ips;
    }
    
    /**
     * Parse le user-agent pour déterminer le navigateur
     */
    private function parseBrowser(string $userAgent): string
    {
        if (strpos($userAgent, 'Chrome') !== false) {
            return 'Chrome';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            return 'Firefox';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            return 'Safari';
        } elseif (strpos($userAgent, 'Edge') !== false) {
            return 'Edge';
        } elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident/') !== false) {
            return 'Internet Explorer';
        } else {
            return 'Other';
        }
    }
    
    /**
     * Génère un ID de session unique pour un utilisateur
     */
    private function generateSessionId(int $adminId): string
    {
        return md5($adminId . '_' . session_id());
    }

    public function getSessionId(int $adminId): ?int
    {
        return $this->cache->get(self::SESSION_PREFIX . $this->generateSessionId($adminId));
    }
}