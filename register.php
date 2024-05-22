<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="acrossous">
    <title>register</title>
</head>

<body class="d-flex align-items-center bg-primary-subtle" style="height: 100%;">
    <div class="w-100 m-auto card p-3" style="max-width: 350px;">
        <h2 class="mb-4">Registration Page</h2>
        <form action="register.php" method="post">
            <div class="form-floating">
                <input class="form-control" placeholder="foo" type="text" name="username" required="required">
                <label class="form-label" for="username">Username</label>
            </div>
            <div class="form-floating">
                <input class="form-control" placeholder="foo" type="password" name="password" required="required">
                <label class="form-label" for="username">Password</label>
            </div>
            <br>
            <input class="btn btn-primary" type="submit" value="Register">
        </form>
        <a href="index.php">click here to go back</a>
    </div>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "config.php";
    // real escape string, deprecated
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $bool = true;

    // echo "Username entered is: " . $username . "<br>";
    // echo "Password is:" . $password . "<br>";

    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "error: " . mysqli_error($conn);
        exit();
    }
    $count = mysqli_num_rows($result);
    if ($count > 9) {
        print '<script> alert ("Sorry, the user limit has been reached and registration is closed. :(");</script>';
        exit;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        // echo $row['username'] . "<br>";
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