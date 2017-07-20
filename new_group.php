<?php

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if(!empty($post['name']) && !empty($post['start'])){ 
    try {
        $db = new PDO('mysql:host=localhost;dbname=music_db', 'cyrille', 'm0byl3tte');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $newgroup = $db->prepare('INSERT INTO `group`(name, start, end, origin) VALUES (:name, :start, :end, :origin);');
        if(empty($post['end'])) {
            $post['end'] = NULL;
        }
        if(empty($post['origin'])) {
            $post['origin'] = NULL;
        }
        $newgroup->execute([ 'name'=>$post['name'], 'start'=>$post['start'], 'end'=>$post['end'], 'origin'=>$post['origin'],]);
    //$newgroup->bindValue(':name', $post['name']);
    //$newgroup->bindValue(':start', $post['start']);
    //$newgroup->bindValue(':end', $post['end']);
    //$newgroup->bindValue(':origin', $post['origin']);
    //$newgroup->execute();
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
        <label for="start">Début</label>
        <input type="date" name="start">
        <label for="end">Fin</label>
        <input type="date" name"end">
        <label for="origin">Origine</label>
        <input type="text" name="origin">
        <input type="submit">
        </form>
    </body>
    </html>