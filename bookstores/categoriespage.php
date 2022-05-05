<?php  
    require('conn.php');
    $sql = "select categoryname from categories";
    $sqlresult = mysqli_query($conn, $sql);
    $fetchdata = mysqli_fetch_all($sqlresult, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
    <link rel="stylesheet" href="styles/universal.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/categoriespage.css">
</head>
<body>  
    <?php include('navbar.php');?>
    <div class="container">
        categories :
        <?php foreach($fetchdata as $data) : ?>
            <?php foreach($data as $row) : ?>
                <div class="cat">
                <?php echo $row ?>
                </div>
            <?php endforeach ?>    
        <?php endforeach ?>    
    </div>


    
</body>
</html>