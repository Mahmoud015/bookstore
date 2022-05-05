<?php
    session_start();
    require('conn.php');
    $addsuccess = $adderr = $delsuccess = $delerr = $editsuccess = $editerr = '';

    if(isset($_POST['add'])){
        $addedcategory = $_POST['addcategory'];
        $checkQuiry = "SELECT * FROM categories WHERE categoryname = '$addedcategory'";
        $checkresult = mysqli_query($conn, $checkQuiry);
        if(mysqli_num_rows($checkresult) == 0){
            $addQuiry = "INSERT INTO categories VALUES ('null', '$addedcategory')";
            $addResult = mysqli_query($conn, $addQuiry);
            $addsuccess = 'this category added successfully';
        }else{
            $adderr = 'this category already exists';
        }
        
    }

    if(isset($_POST['edit'])){
        $oldcategory = $_POST['oldcategory'];
        $newcategory = $_POST['newcategory'];
        $checkQuiry = "SELECT * FROM categories WHERE categoryname = '$oldcategory'";
        $checkresult = mysqli_query($conn, $checkQuiry);
        if(mysqli_num_rows($checkresult) == 0){
            $editerr = 'this category does not exists';
        }else{
            
            $editQuiry = "UPDATE categories SET categoryname = '$newcategory' WHERE categoryname = '$oldcategory'";
            $editResult = mysqli_query($conn, $editQuiry);
            $editsuccess = 'this category updated successfully';
        }
        
    }


    if(isset($_POST['delete'])){
        $deletedcategory = $_POST['deletecategory'];
        $checkQuiry = "SELECT * FROM categories WHERE categoryname = '$deletedcategory'";
        $checkresult = mysqli_query($conn, $checkQuiry);
        if(mysqli_num_rows($checkresult) == 0){
            $delerr = 'this category dose not exists';
        }else{
            $deleteQuiry = "DELETE FROM categories WHERE categoryname = '$deletedcategory'";
            $deleteResult = mysqli_query($conn, $deleteQuiry);
            $delsuccess = 'this category deleted successfully';
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
            <h3>ADD CATEGORIES</h3>
                <form action="categories.php" method="POST">
                    <label for="addcategories">CATEGORY NAME</label>
                    <input type="text" name="addcategory" id="addcategory">


                    <input type="submit" value="add" name="add">
                    <span><?php echo $addsuccess?></span>
                    <span><?php echo $adderr?></span>
                </form>
        </section>

        <section>
            <h3>delete category</h3>
                <form action="categories.php" method="POST">
                    <label for="deletecategory">DELETE CATEGORY</label>
                    <input type="text" name="deletecategory" id="deletecategory">

                    <input type="submit" value="delete" name="delete">
                    <span><?php echo $delsuccess?></span>
                    <span><?php echo $delerr?></span>
                </form>

        </section>

        <section>
            <h3>EDIT CATEGORY</h3>
                <form action="categories.php" method="POST">
                    <label for="oldcategory">OLD NAME</label>
                    <input type="text" name="oldcategory" id="oldcategory">

                    <label for="newcategory">NEW NAME</label>
                    <input type="text" name="newcategory" id="newcategory">
                    <input type="submit" value="edit" name="edit">
                    <span><?php echo $editsuccess?></span>
                    <span><?php echo $editerr?></span>
                </form>
        </section>

        
    </div>
</body>
</html>