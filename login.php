<?php
    session_start();
    include('conn.php');
    $email = $pass = $notregister =  "";
    if(isset($_SESSION["name"])){
          // if admin

          if(mysqli_num_rows($checkAdminResult) == 1){
              header('Location: adminPanel.php');
          }else{    //normal user
              header("Location: index.php");
          }
    }
    if(isset($_POST['submit'])){
        $sql = "SELECT * FROM users WHERE email = '$_POST[email]' and pass = '$_POST[pass]'";
        $result = mysqli_query($conn, $sql);

        //admin 
        $checkAdminQuery = "SELECT * FROM users WHERE id = '1' AND email ='$_POST[email]' AND pass = '$_POST[pass]'";
        $checkAdminResult = mysqli_query($conn, $checkAdminQuery);  

        //user
        $getusername = "SELECT fname FROM users WHERE email = '$_POST[email]' and pass = '$_POST[pass]'";
        $getusernameResult = mysqli_query($conn, $getusername);
        
        if(mysqli_num_rows($checkAdminResult) == 1){
            $fetchResult = mysqli_fetch_assoc($checkAdminResult);
            $_SESSION['name'] = $fetchResult['fname'];
            
            header('location: adminPanel.php');
        }elseif(mysqli_num_rows($getusernameResult) == 1){
            $fetchResult = mysqli_fetch_assoc($getusernameResult);
            $_SESSION['name'] = $fetchResult['fname'];
            header('Location: index.php');
        }else{
            $notregister = "please register first";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/universal.css">
    <link rel="stylesheet" href="styles/form.css">
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <?php
        include("navbar.php");
    ?> 
    <div class="container">
        <form action="login.php" method="POST">
            <h3>SIGN UP</h3>

            <label for="email" style="margin-top: 1rem;">Email</label>
            <input type="text" name="email" id="email" value="<?php echo $email ?>">
            <!-- <div class="err"><?php echo $errList["emailErr"] ?></div><br> -->

            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" value="<?php echo $pass ?>">
            <!-- <div class="err"><?php echo $errList["passErr"] ?></div><br> -->
            
            
            <input type="submit" value="submit" id="submit" name="submit">
            <?php echo $notregister ?>
            <p>dont have account? <a href="register.php">register</a></p>

        </form>
    </div>
    
</body>
</html>