<?php

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if(!empty($post['name']) && !empty($post['label']) && !empty($post['genre']) && !empty($post['sales'])){ 
    try {
        $db = new PDO('mysql:host=localhost;dbname=music_db', 'cyrille', 'mdp');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db = new PDO('mysql:host=localhost;dbname=music_db', 'cyrille', 'mdp');

$newalbum = $db->prepare('INSERT INTO album(name, date, label, genre, sales, group_id) VALUES (:name, :date, :label, :genre, :sales, :group_id)');
    $newalbum->bindValue(':name', 'Yellow Submarine');
    $newalbum->bindValue(':date', '1969-01-13');
    $newalbum->bindValue(':label', 'Apple');
    $newalbum->bindValue(':genre', 'Rock');
    $newalbum->bindValue(':sales', '1300000');
    $newalbum->bindValue(':group_id', '2');
    $newalbum->execute();
$idmember = $db->query('UPDATE album_member SET album_member.album_id=9 INNER JOIN album SET album_member.member_id=group_id');
$idmember->execute();
 header('location:index.php');
    } catch (Exception $e) {
        header('Content-Type: text/plain');
        echo 'fail to contatct DB: ' .$e->getMessage();
    }  
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <form action="" method="POST">
        <label for="name">Nom</label>
        <input type="text" name="name">
        <label for="start">Date de sortie</label>
        <input type="date" name="start">
        <label for="label">Label</label>
        <input type="date" name"label">
        <label for="genre">Genre</label>
        <input type="text" name="genre">
        <label for="sales">Vente</label>
        <input type="text" name="vente">
        <input type="submit">
        </form>
    </body>
    </html>