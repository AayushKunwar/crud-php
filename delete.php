<?php
session_start();
if ($_SESSION['user']) {

} else {
    header("location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    require "config.php";
    $id = $_GET['id'];
    $query = "DELETE FROM list WHERE id='$id'";
    exec_query($conn, $query);
    header("location:home.php");
}