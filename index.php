<?php
    session_start();
    if(is_null($_SESSION['name'])){
        header('location: login.php');
    }
    require('conn.php');
    $selectBooksQuery = "SELECT bookName, author, price FROM books";
    $selectResult = mysqli_query($conn, $selectBooksQuery);
    $books = mysqli_fetch_all($selectResult, MYSQLI_ASSOC);

    //cart
    
    if(isset($_POST['cart'])){
        $_SESSION['cart'] = $_POST['cart'];
        $sql = "CREATE TABLE if not exists addtocart(
            id tinyint PRIMARY KEY AUTO_INCREMENT,
            productname varchar (100),
            productprice smallint (50),
            quantaty tinyint
        )";
       $result = mysqli_query($conn, $sql);
       $addquery = "INSERT INTO addtocart VALUES ('null','$_POST[cartBook]', '$_POST[cartPrice]', '$_POST[quantaty]')";
       $addresult = mysqli_query($conn, $addquery);
       }

    if($_SESSION['name'] == null){
        $delquery = "DROP TABLE addtocart";
        $dellresult = mysqli_query($conn, $delquery); 
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book store</title>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/universal.css">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <?php require('navbar.php') ?>
    <div class="container">
        <?php foreach($books as $book): ?>
            <div class="book">
                <span class="bookname"><?php echo $book['bookName'] ?></span>
                <span class="author"><?php echo $book['author'] ?></span>
                <span class="bookname"><?php echo $book['price'] ?>$</span>
                <form action="index.php" method="POST">
                    <input type="number" min="1" name="quantaty" value="1">
                    <input type="hidden" name="cartBook" id="" value="<?php echo $book['bookName'] ?>">
                    <input type="hidden" name="cartPrice" id="" value="<?php echo $book['price'] ?>">
                   <input type="submit" value="add to cart" name="cart">
                </form>
            </div>
        <?php endforeach ?>
    </div>
</body>
</html>