<?php declare(strict_types=1);

namespace Zafkiel\Infrastructure\Cache;

use Zafkiel\Domain\Interfaces\iCache;
use Predis\Client;
use Predis\Response\Status;

class RedisClient implements iCache
{
    private Client $client;

    public function __construct(
        string $host = 'localhost', 
        int $port = 6379, 
        string $password = null,
        int $database = 0
    ) {
        $options = [
            'host' => $host,
            'scheme' => 'tcp',
            'port' => $port,
            'database' => $database
        ];
        
        if ($password) {
            $options['password'] = $password;
        }
        
        $this->client = new Client($options);
    }
    
    /**
     * {@inheritdoc}
     */
    public function get(string $key): mixed
    {
        $data = $this->client->get($key);
        
        if ($data === null) {
            return null;
        }
        
        try {
            return unserialize($data);
        } catch (\Exception $e) {
            return $data;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function set(string $key, mixed $data, int $ttl = 3600): bool
    {
        $serializedData = is_string($data) ? $data : serialize($data);
        
        if ($ttl > 0) {
            $response = $this->client->setex($key, $ttl, $serializedData);
        } else {
            $response = $this->client->set($key, $serializedData);
        }
        
        return $response instanceof Status && $response->getPayload() === 'OK';
    }
    
    /**
     * {@inheritdoc}
     */
    public function delete(string $key): bool
    {
        return (bool) $this->client->del([$key]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function exists(string $key): bool
    {
        return (bool) $this->client->exists($key);
    }
    
    /**
     * {@inheritdoc}
     */
    public function zAdd(string $key, mixed $value, float $score): bool
    {
        // Si $value n'est pas une chaîne, la sérialiser
        if (!is_string($value)) {
            $value = serialize($value);
        }
        
        return (bool) $this->client->zadd($key, [$value => $score]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function zRem(string $key, mixed $value): bool
    {
        // Si $value n'est pas une chaîne, la sérialiser
        if (!is_string($value)) {
            $value = serialize($value);
        }
        
        return (bool) $this->client->zrem($key, [$value]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function zRangeByScore(string $key, float $min, float $max): array
    {
        $result = $this->client->zrangebyscore($key, $min, $max);
        
        // Tenter de désérialiser chaque valeur
        return array_map(function ($item) {
            try {
                return @unserialize($item) ?: $item;
            } catch (\Exception $e) {
                return $item;
            }
        }, $result);
    }
    
    /**
     * {@inheritdoc}
     */
    public function zRemRangeByScore(string $key, float $min, float $max): int
    {
        return (int) $this->client->zremrangebyscore($key, $min, $max);
    }
    
    /**
     * {@inheritdoc}
     */
    public function eval(string $script, array $keys = [], array $args = []): mixed
    {
        return $this->client->eval($script, count($keys), array_merge($keys, $args));
    }
    
    /**
     * {@inheritdoc}
     */
    public function increment(string $key, int $value = 1): int
    {
        return (int) $this->client->incrby($key, $value);
    }
    
    /**
     * {@inheritdoc}
     */
    public function expire(string $key, int $ttl): bool
    {
        return (bool) $this->client->expire($key, $ttl);
    }
    
    /**
     * Obtient l'instance Predis\Client sous-jacente
     * 
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
} 