<?php
require "config.php";
session_start();
$username = mysqli_real_escape_string($conn, $_POST["username"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);
$bool = true;

$query = "SELECT * FROM `users` where username='$username'";
$result = mysqli_query($conn, $query);

// check if username exists
$exists = mysqli_num_rows($result);
if ($exists <= 0) {
    print '<script>alert("Incorrect Username");</script>';
    print '<script>window.location.assign("login.php")</script>';
    exit();
}
$table_users = "";
$table_password = "";
// dont really expect to have more than one result (username unique)
while ($row = mysqli_fetch_assoc($result)) {
    $table_users = $row['username'];
    $table_password = $row['password'];
}
if (($username == $table_users) && ($password == $table_password)) {
    // check again to improve security
    if ($password == $table_password) {
        $_SESSION['user'] = $username;
        header("location: home.php");
    }
} else {
    print '<script>alert("Incorrect password");</script>';
    print '<script>window.location.assign("login.php");</script>';
}