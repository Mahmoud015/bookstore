<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles/universal.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/adminPanel.css">
</head>
<body>
    <?php
        include("navbar.php");
    ?>
    <div class="container">
        <a href="checkUsers.php" class="admin">CHECK USERS</a>
        <a href="books.php" class="admin">BOOKS</a>
        <a href="checkBookOrders.php" class="admin">BOOK ORDERS</a>
        <a href="categories.php" class="admin">CATEGORIES</a>
        <a href="subcategories.php" class="admin">SUB-CATEGORIES</a>
    </div>

<?php
    include("footer.html");
?>