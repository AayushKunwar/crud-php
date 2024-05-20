<html>
    <head>
        <title>register</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">click here to go back</a>
        <form action="register.php" method="post">
            Enter Username: <input type="text" name="username" required="required">
            <br>
            Enter Password: <input type="password" name="password" required="required">
            <br>
            <input type="submit" value="Register">
        </form>
    </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "config.php";
    // real escape string, deprecated
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $bool = true;

    echo "Username entered is: " . $username . "<br>";
    echo "Password is:" . $password . "<br>";

    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error: " . mysqli_error($conn);
        exit();
    }
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['username'] . "<br>";
        $table_users = $row["username"];
        if ($username == $table_users) {
            $bool = false;
            print '<script> alert("Username has already taken!");</script>';
            print '<script>window.location.assign("register.php");</script>';
        }
    }
    if ($bool) {
        $query = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '$username', '$password');";
        $result = exec_query($conn, $query);
        print '<script>alert("successfully registered!");</script>';
        // print '<script>window.location.assign("register.php");</script>';
        echo "you can now go back";
    }
}
?>