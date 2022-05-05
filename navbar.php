<?php
  require('conn.php');
  $selectCategoriesQuery = "SELECT categoryname FROM categories";
  $categoryResult = mysqli_query($conn, $selectCategoriesQuery);
  $Categories = mysqli_fetch_all($categoryResult, MYSQLI_ASSOC);

?>
    <nav>
      <a href="index.php" id="logo">BOOKSTORE</a> 
      <div class="navigation">
          <a href="categoriespage.php">CATEGORIES</a>
        <a href="addToCart.php">CART</a>
        <a href="contact.php">CONTACT US</a>
        <?php if(isset($_SESSION['name'])) : ?>
          <a href="#"><?php echo $_SESSION['name'] ?></a>
        <?php endif ?>  
      </div> 
      
    </nav>