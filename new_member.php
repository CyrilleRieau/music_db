<?php
$db = new PDO('mysql:host=localhost;dbname=music_db', 'cyrille', 'm0byl3tte');

$newmember = $db->prepare('INSERT INTO member(firstname, lastname, nickname, `role`, birth, death) VALUES (:firstname, :lastname, :nickname, :role, :birth, :death)');
    $newmember->bindValue(':firstname', 'Jacques');
    $newmember->bindValue(':lastname', 'Brel');
    $newmember->bindValue(':nickname', 'Le Belge');
    $newmember->bindValue(':role', 'Singer');
    $newmember->bindValue(':birth', '1929-04-08');
    $newmember->bindValue(':death', '1978-10-09');
    $newmember->execute();