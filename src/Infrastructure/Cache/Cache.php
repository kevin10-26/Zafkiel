<?php declare(strict_types=1);

namespace Zafkiel\Infrastructure\Cache;

use Zafkiel\Domain\Interfaces\iCache;

use Predis\Client;

class RedisClient extends Client implements iCache
{
    public function __construct()
    {
        parent::__construct([
            'host' => 'localhost',
            'scheme' => 'tcp',
            'port' => 6379,
        ]);
    }

    public function get(string $key): string|null
    {
        $data = $this->get($key);

        if ($data !== null)
        {
            return unserialize($data);
        }

        return null;
    }

    public function set($key, $data, $ttl = 3600): void
    {
        $data = serialize($data);
        $this->setex($key, $ttl, $data);
    }

    public function delete(string $key): void
    {
        $this->del($key);
    }
}