<?php
/*
  $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

  if (empty($get['id'])) {
  header('content-type : text/plain');
  echo 'id must be set.';
  exit(1);
  }
  echo 'ok';

  try {
  $db = new PDO('mysql:host=localhost;dbname=music_db', 'cyrille', 'mdp');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $albums = $db->prepare('SELECT * FROM `album` WHERE group_id=:id');
  $albums->bindValue(':id', $get['id']);
  $albums->execute();
  $album = $albums->fetchAll(PDO::FETCH_ASSOC);
  $groups = $db->query('SELECT * FROM `group` WHERE id=' . $get['id'] . '');
  $group = $groups->fetch(PDO::FETCH_ASSOC);
  $members = $db->query('SELECT * FROM member LEFT JOIN album_member ON member.id=album_member.member_id LEFT JOIN album ON album.id=' . $group['id'] . '');
  $member = $members->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $exception) {
  echo $exception->getMessage();
  }
  ?>
  <h1><?php echo $group['name']; ?></h1>

  <?php foreach ($album as $al) { ?>
  <h2><?php echo $al['name']; ?></h2>
  <?php
  foreach ($member as $m) {
  echo $m['firstname'] . ' ' . $m['lastname'];
  }
  }


 */

$get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
if (empty($get['id']) && empty($get['name'])) {
    header('content-type: text/plain');
    echo 'id must be set';
    exit(1);
}
try {
    // 1. Connection à la base de données.
    $pdo = new PDO('mysql:host=localhost;dbname=music_db', 'cyrille', 'mdp');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // 2. Préparation de la requête par PHP.
    $stmt = $pdo->prepare('SELECT * FROM `album` WHERE group_id=:id');
    // 3. On remplace les valeurs dans la requête.
    $stmt->bindValue(':id', $get['id']);
    // 4. On envoie la requête à MariaDB.
    $stmt->execute();
    // 5. On récupère les données.
    $albums = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    header('Content-Type: text/plain');
    echo 'fail to contact DB: ' . $e->getMessage();
    exit(1);
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Discography - <?php echo $get['name']; ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body class="container">
        <div class="page-header"><h1 class="text-center">Discography - <?php echo $get['name']; ?></h1></div>
        <ul class="nav nav-pills">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="new_group.php">New Group</a></li>
        </ul>
        <?php foreach ($albums as $a) { ?>
            <article class="col-sm-offset-2 col-sm-8">
                <h2><?php echo $a['name']; ?></h2>
                <dl class="dl-horizontal">
                    <dt>date</dt><dd><?php echo $a['date']; ?></dd>
                    <dt>label</dt><dd><?php echo $a['label']; ?></dd>
                    <dt>sales</dt><dd><?php echo $a['sales']; ?></dd>
                    <dt>genre</dt><dd><?php echo $a['genre']; ?></dd>
                </dl>
                <h3>Members</h3>
                <ul>
                <?php
                $toto = $pdo->prepare('SELECT * FROM album AS a INNER JOIN album_member AS am ON a.id=am.album_id INNER JOIN member AS m ON m.id = am.member_id WHERE a.id=:id');
                $toto->bindValue(':id', $a['id']);
                $toto->execute();
                while ($members = $toto->fetch()){
                  
                    ?>
                    <li>
                        <?php echo $members['firstname'] . ' ' . $members['lastname']; ?>
                    </li>
                <?php } ?>
                </ul>
            </article>
        <?php } ?>
    </body>
</html>