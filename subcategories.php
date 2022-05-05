<?php
    session_start();
    require('conn.php');
    $addsuccess = $adderr = $delsuccess = $delerr = $editsuccess = $editerr = '';

    if(isset($_POST['add'])){
        $main = $_POST['main'];
        $sub = $_POST['sub'];
        $checkQuiry = "SELECT * FROM categories WHERE categoryname = '$main'";
        $checkresult = mysqli_query($conn, $checkQuiry);
        if(mysqli_num_rows($checkresult) == 0){
            $adderr = "there isn't any category whith this name";
        }else{
            
            $addQuiry = "INSERT INTO subcategories VALUES ('null', '$sub')";
            $addResult = mysqli_query($conn, $addQuiry);
            $addsuccess = 'this subcategory added successfully';
        }
        
    }

    if(isset($_POST['edit'])){
        $old = $_POST['old'];
        $new = $_POST['new'];
        $checkQuiry = "SELECT * FROM subcategories WHERE name = '$old'";
        $checkresult = mysqli_query($conn, $checkQuiry);
        if(mysqli_num_rows($checkresult) == 0){
            $editerr = 'this sub-category does not exists';
        }else{
            
            $editQuiry = "UPDATE subcategories SET name = '$new' WHERE name = '$old'";
            $editResult = mysqli_query($conn, $editQuiry);
            $editsuccess = 'this sub-category updated successfully';
        }
        
    }


    if(isset($_POST['delete'])){
        $delsub = $_POST['delsub'];
        $checkQuiry = "SELECT * FROM subcategories WHERE name = '$delsub'";
        $checkresult = mysqli_query($conn, $checkQuiry);
        if(mysqli_num_rows($checkresult) == 0){
            $delerr = 'this sub-category dose not exists';
        }else{
            $deleteQuiry = "DELETE FROM subcategories WHERE name = '$delsub'";
            $deleteResult = mysqli_query($conn, $deleteQuiry);
            $delsuccess = 'this sub-category deleted successfully';
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/universal.css">
    <link rel="stylesheet" href="styles/categories.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
    <section>
            <h3>ADD SUB-CATEGORIES</h3>
                <form action="subcategories.php" method="POST">
                    <label for="main">MAIN NAME</label>
                    <input type="text" name="main" id="main" placeholder="main category">

                    <label for="sub">SUB NAME</label>
                    <input type="text" name="sub" id="sub">


                    <input type="submit" value="add" name="add">
                    <span><?php echo $addsuccess?></span>
                    <span><?php echo $adderr?></span>
                </form>
        </section>

        <section>
            <h3>DELETE SUB-CATEGORY</h3>
                <form action="subcategories.php" method="POST">
                    <label for="delsub">DELETE SUB-CATEGORY</label>
                    <input type="text" name="delsub" id="delsub">

                    <input type="submit" value="delete" name="delete">
                    <span><?php echo $delsuccess?></span>
                    <span><?php echo $delerr?></span>
                </form>

        </section>

        <section>
            <h3>EDIT CATEGORY</h3>
                <form action="subcategories.php" method="POST">
                    <label for="old">OLD NAME</label>
                    <input type="text" name="old" id="old">

                    <label for="new">NEW NAME</label>
                    <input type="text" name="new" id="new">
                    <input type="submit" value="edit" name="edit">
                    <span><?php echo $editsuccess?></span>
                    <span><?php echo $editerr?></span>
                </form>
        </section>

        
    </div>
</body>
</html>