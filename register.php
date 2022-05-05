<?php
    session_start();
    include("conn.php");    
    $fname = $lname = $email = $pass = $repass = "";
    $errList = [
            "fnameErr" => "",
            "lnameErr" => "",
            "emailErr" => "",
            "passErr" => "",
            "repassErr" => "",
            "genderErr" => "",
            "checkboxErr" => "",
            ];

    if (isset($_POST["submit"])){



        //check fname
        if(empty($_POST["fname"])){
            $errList["fnameErr"] = "please enter your name";
        }else{
            $fname = $_POST["fname"];
            if(!preg_match("/^[a-zA-Z]*$/",$fname)){
                $errList["fnameErr"] = "name must be only alpha";
            }
        }

        //check lname
        if(empty($_POST["lname"])){
            $errList["lnameErr"] = "name must be only alpha and spaces";
        }else{
            $lname = $_POST["lname"];
            if(!preg_match("/^[a-zA-Z]*$/",$lname)){
                $errList["lnameErr"] = "not valid name";
            }
        }

        //check email
        if(empty($_POST["email"])){
            $errList["emailErr"] = "please enter your email";
        }else{
            $email = $_POST["email"];
            $_SESSION['email'] = $email;
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errList["emailErr"] = "not valid email";
            }
        }

        //check pass
        if(empty($_POST["pass"])){
            $errList["passErr"] = "please enter your password";
        }else{
            $pass = ($_POST["pass"]);
            if(!preg_match("((?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,})", $pass)){
                $errList["passErr"] = "password should contain at least 8 chars only alpha & numric :
                 1 uppercase , 1 lower case";
            }
        }

        //check repass
        if(empty($_POST["repass"])){
            $errList["repassErr"] = "please re type your password";
        }else{
            $repass = ($_POST["repass"]);
            if($pass != $repass){
                $errList["repassErr"] = "dont't match your password";
            }
        }

        //check gender
        if(empty($_POST["gender"])){
            $errList["genderErr"] = "please select your gender";
        }else{
            $gender = $_POST['gender'];
            if($gender == "male"){
                $gender = true;
            }else{
                $gender = false;
            }
        }

        //check checkbox
        if(empty($_POST["checkbox"])){
            $errList["checkboxErr"] = "please add at least on interest";
        }


        //check if there is errors in error list
        if(array_filter($errList)){
            //errors in the form
        }else{
                        // set the session name
                        $_SESSION['name'] = $fname;
                        // remove virouses from the input to protect data base
                        $fname = mysqli_real_escape_string($conn, $fname);
                        $lname = mysqli_real_escape_string($conn, $lname);
                        $email = mysqli_real_escape_string($conn, $email);
                        $pass = mysqli_real_escape_string($conn, $pass);
                        $gender = mysqli_real_escape_string($conn, $gender);
            
                        // create sql query
                        $sql = "INSERT  INTO users(fname, lname, email, pass, gender) VALUES('$fname', '$lname', '$email', '$pass', '$gender')";
                        $saveData = mysqli_query($conn, $sql);

                        
                        // if admin
                        $checkAdminQuery = "SELECT * FROM users WHERE id = '1' AND fname ='$fname'";
                        $checkAdminResult = mysqli_query($conn, $checkAdminQuery);
                        if(mysqli_num_rows($checkAdminResult) == 1){
                                    //save register info
                            setcookie('name', $_POST['fname'], time() + 86400);
                            header('Location: adminPanel.php');
                        }else{
                                    //save register info
                            setcookie('name', $_POST['fname'], time() + 86400);
                            header("Location: index.php");
                        }
        }




            
        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="styles/universal.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="styles/form.css">
</head>
<body>
        <?php include("navbar.php");?>
        <form action="register.php" method="POST">
            <h3>SIGN UP</h3>
            <label for="fname" style="margin-top: 1rem;">First name</label>
            <input type="text" name="fname" id="fname" value="<?php echo $fname ?>">
            <div class="err"><?php echo $errList["fnameErr"] ?></div><br>

            <label for="lname">Last name</label>
            <input type="text" name="lname" id="lname" value="<?php echo $lname ?>">
            <div class="err"><?php echo $errList["lnameErr"] ?></div><br>

            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php echo $email ?>">
            <div class="err"><?php echo $errList["emailErr"] ?></div><br>

            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" value="<?php echo $pass ?>">
            <div class="err"><?php echo $errList["passErr"] ?></div><br>

            <label for="repass">Confirm password</label>
            <input type="password" name="repass" id="repass" value="<?php echo $repass ?>">
            <div class="err"><?php echo $errList["repassErr"] ?></div><br>
            
            <div class="gender">
                <h4>gender</h4><br>

                    <input type="radio" name="gender" id="gender" value="male">
                    <label for="gender">Male</label><br>
 
                    <input type="radio" name="gender" id="gender" value="female">
                    <label for="gender">female</label><br>
                    <div class="err"><?php echo $errList["genderErr"] ?></div><br>

                


                <h4>interests</h4><br>
                <input type="checkbox" name="checkbox[]" id="history" value="history">
                <label for="history">History</label><br>

                <input type="checkbox" name="checkbox[]" id="physics" value="physics">
                <label for="physics">Physics</label><br>

                <input type="checkbox" name="checkbox[]" id="tech" value="tech">
                <label for="tech">Technology</label><br>

                <input type="checkbox" name="checkbox[]" id="science" value="science">
                <label for="science">Science</label><br>

                <input type="checkbox" name="checkbox[]" id="psych" value="Psychology">
                <label for="psych">Psychology</label><br>
            </div>
            <div class="err"><?php echo $errList["checkboxErr"] ?></div><br>
            <input type="submit" value="submit" id="submit" name="submit">
            <span class="login">I already have account <a href="login.php">login</a></span>

        </form>

<?php include("footer.html") ?>