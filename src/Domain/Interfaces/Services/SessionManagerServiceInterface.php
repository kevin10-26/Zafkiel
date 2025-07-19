<?php declare(strict_types=1);

namespace Zafkiel\Domain\Interfaces\Services;

interface SessionManagerServiceInterface
{
    /**
     * Enregistre une session utilisateur active
     *
     * @param int $adminId ID de l'administrateur
     * @param array $metadata Métadonnées supplémentaires de la session
     * @return void
     */
    public function registerUserSession(int $adminId, array $metadata = []): void;
    
    /**
     * Met à jour l'activité d'un utilisateur
     *
     * @param int $adminId ID de l'administrateur
     * @return void
     */
    public function updateUserActivity(int $adminId): void;
    
    /**
     * Déconnecte un utilisateur
     *
     * @param int $adminId ID de l'administrateur
     * @return void
     */
    public function logoutUser(int $adminId): void;
    
    /**
     * Récupère la liste des utilisateurs en ligne
     *
     * @param int $minutes Nombre de minutes pour considérer un utilisateur comme actif
     * @return array Liste des utilisateurs en ligne avec leurs métadonnées
     */
    public function getOnlineUsers(int $minutes = 60): array;
    
    /**
     * Vérifie si un utilisateur est en ligne
     *
     * @param int $adminId ID de l'administrateur
     * @return bool
     */
    public function isUserOnline(int $adminId): bool;
    
    /**
     * Récupère des statistiques sur les sessions utilisateurs
     *
     * @return array Statistiques des sessions
     */
    public function getSessionStatistics(): array;

    /**
     * Récupère l'ID de la session en cours
     *
     * @return int|null ID de la session en cours
     */
    public function getSessionId(int $adminId): ?int;
} 