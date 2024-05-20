<?php
require "config.php";
session_start();
if ($_SESSION['user']) {

} else {
    header('location:index.php');
}
if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header("location:home.php");
}
$details = mysqli_real_escape_string($conn, $_POST['details']);
$time = date("H:i:s");
$date = date("F j, Y");
$decision = "no";
// print "$time - $date - $details";

// why do we need this? 
foreach ($_POST['public'] as $each_check) {
    if ($each_check != null) {
        $decision = "yes";
    }
}
$query = "INSERT INTO list(details, date_posted, time_posted, public) VALUES ('$details', '$date', '$time', '$decision')";
$result = exec_query($conn, $query);
header("location:home.php");