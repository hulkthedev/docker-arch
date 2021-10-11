<?php

include 'MariaDb.php';
include 'RedisDb.php';

$maria = new MariaDb();
$entriesFromMaria = $maria->getAllEntries();

$redis = new RedisDb();
$redis->storeEntries($entriesFromMaria);

$entriesFromRedis = $redis->getAllEntries();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Docker Arch</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><h3>Docker Arch</h3></a>
        </div>
    </nav>

    <div class="container">
        <div class="row">Content from MariaDB</div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entriesFromMaria as $entry): ?>
                        <tr>
                            <th scope="row"><?= $entry['id'] ?></th>
                            <td><?= $entry['name'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="row">Content from Redis</div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($entriesFromRedis as $index => $value): ?>
                        <tr>
                            <th scope="row"><?= $index ?></th>
                            <td><?= $value ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

  </body>
</html>