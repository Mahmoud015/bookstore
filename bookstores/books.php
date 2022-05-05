<?php 
    session_start();
    require('conn.php');
    $addsuccess = $adderr = $delsuccess = $delerr = $editsuccess = $editerr = '';
    if(isset($_POST['add'])){
        $addedBook = $_POST['bookname'];
        $author = $_POST['author'];
        $chekQuiry = "SELECT * FROM books WHERE bookName = '$addedBook'";
        $checkResult = mysqli_query($conn, $chekQuiry);
        if(mysqli_num_rows($checkResult) == 0){
            $addQuiry = "INSERT INTO books VALUES ('null', '$addedBook', '$author')";
            $addresult = mysqli_query($conn, $addQuiry);
            $addsuccess = 'the book added seccessfully';
        }else{
            $adderr = 'this book already exists';
        }
    }

        if(isset($_POST['delete'])){
            $deletedbook = $_POST['deletedbook'];
            $checkQuiry = "SELECT * FROM books WHERE bookName = '$deletedbook'";
            $checkResult = mysqli_query($conn, $checkQuiry);
            if(mysqli_num_rows($checkResult) == 0){
                $delerr = 'this book dose not exists';
            }else{
                $delQuiry = "DELETE FROM books WHERE bookName = '$deletedbook'";
                $delResult = mysqli_query($conn, $delQuiry);
                $delsuccess = 'deleted successfully';
            }
        }

        if(isset($_POST['edit'])){
            $oldname = $_POST['oldname'];
            $newname = $_POST['newname'];
            $checkQuiry = "SELECT * FROM books WHERE bookName = '$oldname'";
            $checkResult = mysqli_query($conn, $checkQuiry);
            if(mysqli_num_rows($checkResult) == 0){
                $editerr = 'this book does not exists';
            }else{
                $editQuiry = "UPDATE books SET bookName = '$newname' WHERE bookName = '$oldname'";
                $editResult = mysqli_query($conn, $editQuiry);
                $editsuccess = 'apdated successfully';
            }
        }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/universal.css">
    <link rel="stylesheet" href="styles/books.css">
</head>
<body>
    <?php
        include("navbar.php");
    ?>
    <div class="container">
    <section>
            <h3>ADD book</h3>
                <form action="books.php" method="POST">
                    <label for="bookname">BOOK NAME</label>
                    <input type="text" name="bookname" id="bookname">

                    <label for="author">AUTHOR</label>
                    <input type="text" name="author" id="author">
                    <input type="submit" value="add" name="add">

                    <span><?php echo $addsuccess?></span>
                    <span><?php echo $adderr?></span>
                </form>
        </section>

        <section>
            <h3>delete book</h3>
                <form action="books.php" method="POST">
                    <label for="deletedbook">BOOK NAME</label>
                    <input type="text" name="deletedbook" id="deletedbook">


                    <input type="submit" value="delete" name="delete">

                    <span><?php echo $delsuccess?></span>
                    <span><?php echo $delerr?></span>
                </form>
        </section>

        <section>
            <h3>edit book</h3>
                <form action="books.php" method="POST">
                    <label for="editbook">old NAME</label>
                    <input type="text" name="oldname" id="oldname">

                    <label for="newname">NEW NAME</label>
                    <input type="text" name="newname" id="newname">

                    <input type="submit" value="edit" name="edit">

                    <span><?php echo $editsuccess?></span>
                    <span><?php echo $editerr?></span>
                </form>
        </section>

        
    </div>


<?php
    include("footer.html");
?>
</body>
</html>