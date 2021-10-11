<?php

class MariaDb
{
    private const CONNECTION = 'mysql:dbname=%s;host=%s;port=%s;charset=utf8mb4';
    private const CONNECTION_TIMEOUT = 30;

    private string $connection;
    private string $user;
    private string $password;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $host = getenv('MARIADB_HOST');
        $user = getenv('MARIADB_USER');
        $password = getenv('MARIADB_PASSWORD');
        $name = getenv('MARIADB_NAME');
        $port = getenv('MARIADB_PORT');

        if (empty($host) || empty($user) || empty($password) || empty($name) || empty($port)) {
            throw new Exception('No MariaDB Config Data found!');
        }

        $this->user = $user;
        $this->password = $password;
        $this->connection = sprintf(self::CONNECTION, $name, $host, $port);
    }

    /**
     * @return PDO
     * @throws Exception
     */
    private function getPdoDriver(): PDO
    {
        return new PDO($this->connection, $this->user, $this->password, [
            PDO::ATTR_TIMEOUT => self::CONNECTION_TIMEOUT
        ]);
    }

    /**
     * @return array
     */
    public function getAllEntries(): array
    {
        try {
            $statement = $this->getPdoDriver()->prepare('SELECT * FROM example_table');
            $statement->execute();

            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            sort($data);

            return $data;
        } catch (Exception $exception) {
            return [];
        }
    }
}