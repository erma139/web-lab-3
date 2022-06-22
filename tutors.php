<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
error_reporting(0);
include_once("dbconnect.php");

if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'search') {
        $search = $_GET['search'];
        $sqltutor = "SELECT * FROM tbl_tutors WHERE tutor_name LIKE '%$search%'";
    }
} else {
    $sqltutor = "SELECT * FROM tbl_tutors";
}

if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
} else {
    $pageno = 1;
}
$results_per_page = 10;
$page_first_result = ($pageno-1) * $results_per_page;

$stmt = $conn->prepare($sqltutor);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqltutor = $sqltutor . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqltutor);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$conn= null;

function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
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
            <div class="w3-padding w3-margin w3-round">
                <form>
                    <div style="padding-right:4px">
                        <table>
                            <tr align="right">
                                <td style="width:100%"><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Search.."></td>
                                <td><button class="w3-button w3-purple w3-round w3-right" style="width:auto;" type="submit" name="submit" value="search">Search</button></td>
                            </tr>
                        </table>
                    </div>
                </form>
                <h2><b>List of Tutors</b></h2>
            </div>
            
            <div class="w3-grid-template">
                <?php
                $i = 0;
                foreach ($rows as $tutors) {
                    $i++;
                    $tid = $tutors['tutor_id'];
                    $tname = truncate($tutors['tutor_name'], 15);
                    $tphone = $tutors['tutor_phone'];
                    $temail = $tutors['tutor_email'];
                    echo "<div class='w3-card-4 w3-round' style='margin:10px;'>
                    <header class='w3-container w3-blue-gray'><h5><b>$tname</b></h5></header>";
                    echo "<img class='w3-image' src=assets/tutors/$tid.jpg" .
                    " onerror=this.onerror=null;this.src='res/avatar.jpg'"
                    . " style='width:100%;height:250px'>";
                    echo "<div class='w3-container w3-padding'><p>Phone: $tphone<br>Email: $temail<br><br><a href='tutortdetails.php?tid=$tid' class='w3-button w3-purple' style='text-decoration: none;'>More Details</a></p></div>
                    </div>";
                }
                ?>
            </div>

            <?php
            $num = 1;
            if ($pageno == 1) {
                $num = 1;
            } else if ($pageno == 2) {
                $num = ($num) + 10;
            } else {
                $num = $pageno * 10 - 9;
            }
            echo "<div class='w3-container w3-row'>";
            echo "<center>";
            for ($page = 1; $page <= $number_of_page; $page++) {
                echo '<a href = "tutors.php?pageno=' . $page . '" style=
                    "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
            }
            echo " ( " . $pageno . " )";
            echo "</center>";
            echo "</div>";
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