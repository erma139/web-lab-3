<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
include_once("dbconnect.php");

if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
    $sqltutor = "SELECT * FROM tbl_tutors WHERE tutor_id = '$tid'";
    $stmt = $conn->prepare($sqltutor);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Tutor not found.');</script>";
        echo "<script> window.location.replace('tutors.php')</script>";
    }
} else {
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('tutors.php')</script>";
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="style.css">
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <title>MyTutor</title>
    </head>

    <body>
        <div id="navlist" class="w3-bar w3-top w3-large w3-text-white">
            <span class="w3-bar-item w3-padding-16 w3-purple w3-margin-right w3-xxlarge"><i class="fa fa-institution">MyTutor</i></span>
            <div class="navlist-right">
                <a href="menu.php" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Dashboard</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Courses</a>
                <a href="tutors.php" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Tutors</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Subscription</a>
                <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Profile</a>
                <a href="logout.php" class="w3-bar-item w3-button w3-padding-16 w3-hide-small">Logout</a>
                <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
            </div>
        </div>

        <div id="nav" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
            <br><br><br>
            <a href="menu.php" class="w3-bar-item w3-button w3-padding-16">Dashboard</a>
            <a href="#" class="w3-bar-item w3-button w3-padding-16">Courses</a>
            <a href="tutors.php" class="w3-bar-item w3-button w3-padding-16">Tutors</a>
            <a href="#" class="w3-bar-item w3-button w3-padding-16">Subscription</a>
            <a href="#" class="w3-bar-item w3-button w3-padding-16">Profile</a>
            <a href="logout.php" class="w3-bar-item w3-button w3-padding-16">Logout</a>
        </div>
        <br><br>
        
        <div class="container">
            <?php
            $i = 0;
            foreach ($rows as $tutors) {
                $i++;
                $tid = $tutors['tutor_id'];
                $tname = $tutors['tutor_name'];
                $tphone = $tutors['tutor_phone'];
                $temail = $tutors['tutor_email'];
                $tdesc = $tutors['tutor_description'];
                echo "<div class='w3-row w3-border w3-card-4 w3-round' style='margin:10px'>
                <div class='w3-container w3-half'><br>
                    <img class='w3-image resimg' src=assets/tutors/$tid.jpg" . 
                    " onerror=this.onerror=null;this.src='res/avatar.jpg'" . " style='width:100%;'><br><br>
                </div>
                <div class='w3-container w3-half'>
                    <div class='w3-padding'><h3><b>$tname</b></h3>
                    <div><p><b>Description</b><br>$tdesc<br><br><b>Phone:</b> $tphone<br><b>Email:</b> $temail<br><div class='w3-button w3-purple w3-round w3-right' style='width:auto'><a href='tutors.php' class='w3-button'>Back</a></div></p>
                </div></div>";
            }
            ?>
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