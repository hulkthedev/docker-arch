<?php

include 'MariaDb.php';

$maria = new MariaDb();
$entriesFromMaria = $maria->getAllEntries();


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

    <div class="container">
        <div class="row">
            <b>Docker Arch</b>
        </div>

        <div class="row">
            MariaDB Content
        </div>

        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
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

  </body>
</html>