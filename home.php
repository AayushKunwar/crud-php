<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Home Page</title>
</head>
<?php
    session_start();
    if ($_SESSION['user']) {
    } else {
        // goto index if not logged in
        header('location: index.php');
    }
    $user = $_SESSION['user'];// assign user variable
    ?>

<body class="p-3">
    <div class="navbar navbar-expanded">
        <h2 style="display: inline;">Home Page</h2>
        <a style="float:right" class="btn btn-secondary" href="logout.php">Logout</a>
    </div>
    <p>Hello <?php print "$user" ?>!</p>
    <div class="card container p-3 mb-5 bg-body-tertiary">
        <form class="" action="add.php" method="POST">
            <div class="form-label"> Add more to list:</div>
            <input class="form-control mb-3" type="text" name="details" />
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="public[]" value="yes" />
                <div class="form-check-label">Is public post</div>
            </div>
            <input class="btn btn-primary mt-2" type="submit" value="Add to list" />
        </form>
    </div>
    <h2 align="center">Main List</h2>
    <table class="container table table-striped" border="1px" width="100%">
        <tr class="text-center">
            <th>ID</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Public</th>
        </tr>
        <?php
            include "config.php";
            $query = "SELECT * FROM list";
            $result = exec_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                print "<tr>";
                print '<td align="center">' . $row['id'] . "</td>";
                print '<td align="center">' . $row['details'] . "</td>";
                print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
                print '<td align="center"><a style="text-decoration:none;" class="badge rounded-pill bg-primary-subtle text-primary-emphasis " href="edit.php?id=' . $row['id'] . ' ">Edit</a> </td>';
                print '<td align="center"><a class="badge rounded-pill bg-danger-subtle text-danger-emphasis " style="text-decoration:none;" href="#" onclick="myFunc(' . $row['id'] . ')">Delete</a> </td>';
                print '<td align="center">' . $row['public'] . "</td>";
                print "</tr>";
            }
            ?>
    </table>
    <script>
    function myFunc(id) {
        let r = confirm(`Are you sure you want to delete this record id ${id}`);
        if (r == true) {
            window.location.assign("delete.php?id=" + id);
        }
    }
    </script>
</body>

</html>