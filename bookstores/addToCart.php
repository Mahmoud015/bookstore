<?php 
    session_start();
    require('conn.php');
    $fetchdata = "";
    if(isset($_SESSION['cart'])){
        $sql = "SELECT * FROM addtocart";
        $result = mysqli_query($conn, $sql);
        $fetchdata = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if(isset($_POST['buy'])){
            $orders = [];
            foreach($fetchdata as $data){
                $orders[] = $data;
            }
        }
        print_r($orders);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="styles/universal.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/addcart.css">
</head>
<body>
    <?php include('navbar.php') ?>
    <div class="products">
        <?php if(isset($_SESSION['cart'])){foreach($fetchdata as $data){ ?>
            <div class="container">
                <span>BOOK NAME : <?php echo $data['productname'] ?></span>
                <span>BOOK PRICE :<?php echo $data['productprice'] ?>$</span>
                <span>QUANTATY : <?php echo $data['quantaty'] ?></span>
                <span>TOTAL COST : <?php echo $data['productprice'] * $data['quantaty'] ?>$</span>
            </div>
        <?php } }else{ echo 'no items in the cart'; } ?>
        <form action="addToCart.php" method="POST">
            <input id="confirm" type="submit" value="CONFIRM ORDER" name="buy">
        </form>  
    </div>
    
</body>
</html>