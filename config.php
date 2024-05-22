<?php
$conn = mysqli_connect("localhost", "root", "", "crudphp");
if (!$conn) {
    echo "Database connectioni error" . mysqli_connect_error();
}

function exec_query($conn, $query)
{
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error: " . mysqli_error($conn);
    }
    return $result;
}