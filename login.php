<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="acrossous">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" -->
    <!-- integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"> -->
    </script>
    <title>Login</title>
</head>

<body class="d-flex align-items-center bg-secondary-subtle" style="height: 100%;">
    <div class="w-100 m-auto card p-3" style="max-width: 350px;">
        <h2 style="width: max-content" class="">Login Page</h2>
        <form action="checklogin.php" method="post" class=" ">
            <div class="mt-4 form-floating">
                <input placeholder="foo" id="floatingInput" class="form-control" type="text" name="username"
                    required="required">
                <label class="form-label" for="floatingInput">Username</label>
            </div>
            <div class="form-floating">

                <input class="form-control" type="password" name="password" required="required" placeholder="foo">
                <label class="form-label">Password</label>
            </div>
            <input class="mt-4 btn btn-primary" type="submit" value="Login">
        </form>
        <a style="width: max-content" class="" href="index.php">click here to go back</a>
    </div>
</body>

</html>