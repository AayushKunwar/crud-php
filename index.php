<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Online Bulletin Board</title>
</head>

<body class="p-3">
    <div class="navbar navbar-expand-lg mb-3">
        <div class="w-100">
            <h2 style="display: inline;">Online Bulletin Board</h2>
            <div style="float: right; display:inline">
                <a class="btn btn-primary" href="login.php">Login</a>
                <a class="btn btn-secondary" href="register.php">Register</a>
            </div>
        </div>
    </div>
    <h3 align="center">Public Posts</h3>
    <table class="table table-striped container" width="100%" border="1px">
        <tr class="text-center">
            <th>Id</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
        </tr>
        <?php
        require_once "config.php";
        $query = "Select * from list where public='yes'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            print "<tr>";
            print '<td align="center">' . $row['id'] . '</id>';
            print '<td align="center">' . $row['details'] . '</id>';
            print '<td align="center">' . $row['date_posted'] . ' - ' . $row['time_posted'] . '</td>';
            print '<td align="center">' . $row['date_edited'] . ' - ' . $row['time_edited'] . '</td>';
            print "</tr>";
        }
        ?>
    </table>
</body>

</html>