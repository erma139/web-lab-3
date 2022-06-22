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
        <style>
            .contain {
                position: relative;
                text-align: center;
                color: red;
            }

            .centered {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
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
        
        <div class="container">
            <div class="contain">
                <img src="res/mytutor.jpg" style="width:100%;">
                <div class="centered">
                    <h3><b>Are you looking for Online Tuition? You will find expert Tutors on this Platform.</b></h3>
                    <br>
                    <button type="button" class="w3-large" style="width: auto; padding: 10px 18px; background-color: red;">Create Account<a href="register.php"></a></button>
                </div>
            </div>
        </div>

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