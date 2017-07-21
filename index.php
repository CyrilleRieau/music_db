<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <title>Document</title>
    
</head>
<body class="container-fluid">
<style>
    h1 {
        color: red;
    }
</style>
    <?php 
try {
    $db = new PDO('mysql:host=localhost;dbname=music_db', 'cyrille', 'm0byl3tte');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $groups = $db->query('SELECT * FROM `group`');
    $group =$groups->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $exception) {
    echo $exception->getMessage();
}  
?>
<?php foreach($group as $g) { ?>
    <section class="col-sm-offset-2 col-sm-8">
        <h1><a href="group.php?id=<?php echo $g['id']. '&name='. $g['name']; ?>"><?php echo $g['name'];?></a></h1>
            <ul class="col-sm-offset-2 col-sm-8">
                <li> <?php echo $g['start'] ; ?> </li>
                <li> <?php echo $g['end'] ; ?> </li>
                <li> <?php echo $g['origin'] ; ?> </li>
            </ul></section>
<?php } ?>
</body>
</html>