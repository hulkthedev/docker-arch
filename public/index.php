<?php

/**
 * @return PDO
 * @throws Exception
 */
function getPdoDriver(): PDO
{
    $host = getenv('MARIADB_HOST');
    $user = getenv('MARIADB_USER');
    $password = getenv('MARIADB_PASSWORD');
    $name = getenv('MARIADB_NAME');
    $port = getenv('MARIADB_PORT');

    if (empty($host) || empty($user) || empty($password) || empty($name) || empty($port)) {
        throw new Exception('No MariaDB Config Data found!');
    }

    return new PDO("mysql:dbname=$name;host=$host;port=$port;charset=utf8mb4", $user, $password, [
        PDO::ATTR_TIMEOUT => 10
    ]);
}

/**
 * @return array
 */
function readFromDatabase(): array
{
    $result = [];

    try {
        $statement = getPdoDriver()->prepare('SELECT * FROM example_table');
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $exception) {
        var_dump($exception->getMessage());
    }

    return $result;
}

$data = readFromDatabase();
var_dump($data);


?>
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docker Arch</title>
  </head>
  <body>
    <h1>Docker Arch</h1>
  </body>
</html>