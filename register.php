<?php

if (isset($_POST['registerbtn'])) {
    include "dbconnect.php";

    $file = addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
    $name = addslashes($_POST['name']);
    $phone = addslashes($_POST['phone']);
    $addr = addslashes($_POST['address']);
    $email = addslashes($_POST['email']);
    $pass = addslashes(sha1($_POST['psw']));
    $confirmpass = addslashes(sha1($_POST['confirmpsw']));

    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE user_email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user) {
        echo "<script>alert('Sorry, the email is already has a account.')</script>";
        echo "<script>window.location.replace('register.php')</script>";
    } elseif ($pass != $confirmpass) {
        echo "<script>alert('The password does not match. Try again.')</script>";
        echo "<script>window.location.replace('register.php')</script>";
    } else {
        $sql = "INSERT INTO `tbl_users`(`user_image`, `user_name`, `user_phone`, `user_addr`, `user_email`, `user_pass`) VALUES ('$file', '$name', '$phone', '$addr', '$email', '$pass')";
        try {
            echo "<script>alert('Your account has been created successfully.')</script>";
            echo "<script>window.location.replace('login.php')</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Registration failed!')</script>";
            echo "<script>window.location.replace('register.php')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="style.css">
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <title>MyTutor</title>
    </head>

    <body>
        <div id="navlist" class="w3-bar w3-top w3-large w3-text-white">
            <span class="w3-bar-item w3-padding-16 w3-purple w3-margin-right w3-xxlarge"><i class="fa fa-institution">MyTutor</i></span>
            <div class="navlist-right">
                <a href="index.php" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Home</a>
                <a href="register.php" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Create Account</a>
                <a href="login.php" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Login</a>
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
            </div>
        </div>

        <div id="nav" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
            <br><br><br>
            <a href="index.php" class="w3-bar-item w3-button w3-padding-16">Home</a>
            <a href="register.php" class="w3-bar-item w3-button w3-padding-16">Create Account</a>
            <a href="login.php" class="w3-bar-item w3-button w3-padding-16">Login</a>
        </div>
        <br><br>

        <form name="registerForm" action="register.php" method="POST" enctype="multipart/form-data">
            <div class="container">
                <h1>Create a new account</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <div class="w3-container w3-center">
                    <img class="w3-image" src="res/user.png" style="height:50%; width:200px"><br>
                    <input type="file" name="img" id="img" accept="image/*" required>
                </div>
                <br><br>

                <label for="name"><b>Name</b></label>
                <input type="text" name="name" id="name" style="text-transform: capitalize" required>

                <div class="w3-row">
                    <div class="w3-half" style="padding-right:4px">	
                        <p>
                            <label for="phone"><b>Phone Number</b></label>
                            <input type="number" name="phone" id="phone" maxlength="12" style="width: 100%; padding: 15px; margin: 5px 0 22px 0; display: inline-block; border: none; background: #f1f1f1; outline: none;" required>
                        </p>
                    </div>

                    <div class="w3-half" style="padding-right:4px">	
                        <p>
                            <label for="email"><b>Email</b></label>
                            <input type="email" name="email" id="email" style="width: 100%; padding: 15px; margin: 5px 0 22px 0; display: inline-block; border: none; background: #f1f1f1; outline: none;" required>
                        </p>
                    </div>
                </div>

                <label for="address"><b>Address</b></label>
                <textarea rows="4" name="address" id="address" style="width: 100%; padding: 15px; margin: 5px 0 22px 0; display: inline-block; border: none; background: #f1f1f1; outline: none; text-transform: capitalize;" required></textarea>

                <div class="w3-row">
                    <div class="w3-half" style="padding-right:4px">	
                        <p>
                            <label for="psw"><b>Password</b></label>
                            <input type="password" name="psw" id="psw" required>
                        </p>
                    </div>

                    <div class="w3-half" style="padding-right:4px">	
                        <p>
                            <label for="psw"><b>Confirm Password</b></label>
                            <input type="password" name="confirmpsw" id="confirmpsw" required>
                        </p>
                    </div>
                </div>
                
                    
                <hr>

                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                <button type="submit" name="registerbtn" class="registerbtn">Create Account</button>
            </div>
            
            <div class="container signin">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </form>

        <p class="w3-center w3-text-white">Copyright&copy; MyTutor-Erma 281299<p>
        <script>
            function myFunction() {
                var x = document.getElementById("nav");
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                } else { 
                    x.className = x.className.replace(" w3-show", "");
                }
            }
        </script>
    </body>
</html>