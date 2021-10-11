<?php

class RedisDb
{
    private string $host;
    private int $port;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $host = getenv('REDIS_HOST');
        $port = getenv('REDIS_PORT');

        if (empty($host) || empty($port)) {
            throw new Exception('No Redis Config Data found!');
        }

        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @return Redis
     * @throws Exception
     */
    private function getConnection(): Redis
    {
        $redis = new Redis();
        $redis->connect($this->host, $this->port);

        return $redis;
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function storeEntries(array $data): void
    {
        $redis = $this->getConnection();
        foreach ($data as $entry) {
            $redis->set($entry['id'], $entry['name']);
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAllEntries(): array
    {
        $redis = $this->getConnection();
        $keys = $redis->keys('*');

        $result = [];
        foreach ($keys as $key) {
            $result[$key] = $redis->get($key);
        }

        return $result;
    }
}