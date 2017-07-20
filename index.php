<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<style>
    h1 {
        color: red;
    }
</style>
    <?php 
try {
    $db = new PDO('mysql:host=localhost;dbname=music_db', 'cyrille', 'mdp');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $groups = $db->query('SELECT * FROM `group`');
    $group =$groups->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $exception) {
    echo $exception->getMessage();
}  
?>
<?php foreach($group as $g) { ?>
    <section> 
        <h1><?php echo $g['name'];?></h1>
            <ul>
                <li> <?php echo $g['start'] ; ?> </li>
                <li> <?php echo $g['end'] ; ?> </li>
                <li> <?php echo $g['origin'] ; ?> </li>
            </ul></section>
<?php } ?>
</body>
</html>