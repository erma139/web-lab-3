<?php

if (isset($_POST['submit'])) {
    include 'dbconnect.php';

    $email = $_POST['email'];
    $pass = sha1($_POST['password']);

    $sqllogin = "SELECT * FROM tbl_users WHERE user_email = '$email' AND user_pass = '$pass'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();
    if ($number_of_rows > 0) {
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('menu.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script> window.location.replace('login.php')</script>";
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
        <script src="js/script.js" defer></script>
        <title>MyTutor</title>
    </head>

    <body onload="loadCookies()">
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

        <form name="loginForm" action="login.php" method="POST">
            <div class="container">
                <h1>Login Form</h1>
                <hr>
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" id="idemail" style="width: 100%; padding: 15px; margin: 5px 0 22px 0; display: inline-block; border: none; background: #f1f1f1; outline: none;" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="idpass" required>

                <label><input type="checkbox" name="rememberme" id="idremember" onclick="rememberMe()"> Remember me</label>
                <br><br>
                <button type="submit" name="submit">Login</button>
            </div>

            <div class="container" style="background-color: #f1f1f1">
                <button type="button" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
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