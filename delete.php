<?php
session_start();
if ($_SESSION['user']) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        require "config.php";
        $id = $_GET['id'];
        $query = "DELETE FROM list WHERE id='$id'";
        exec_query($conn, $query);
        header("location:home.php");
    }
} else {
    header("location: index.php");
}

