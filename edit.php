<?php
session_start();
if ($_SESSION["user"]) {
} else {
    header("location: index.php");
}
$user = $_SESSION["user"];
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "config.php";
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $public = "no";
    $id = $_SESSION['id'];
    $time = date("H:i:s");
    $date = date("F j, Y");
    if (isset($_POST["public"]) && !empty($_POST["public"])) {
        foreach ($_POST['public'] as $list) {
            if ($list != null) {
                $public = "yes";
            }
        }
    }
    $query = "UPDATE list SET details='$details', public='$public', date_edited='$date', time_edited='$time' where id='$id'";
    $result = exec_query($conn, $query);
    header("location:home.php");
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Edit page</title>
</head>

<body class="p-3">

    <div class="navbar">
        <h2>Edit Page</h2>
        <div style="float: right;">
            <a class="btn btn-primary" href="home.php">Home</a>
            <a class="btn btn-secondary" href="logout.php">Logout</a>
        </div>
    </div>
    <p>Hello <?php print "$user" ?></p>
    <h2 align="center">Currently Selected</h2>
    <table class="table container" border="1px" width="100%">
        <tr class="text-center">
            <th>ID</th>
            <th>Details</th>
            <th>Post Time</th>
            <th>Edit Time</th>
            <th>Public Post</th>
        </tr>
        <?php
            $id_exists = false;
            require_once "config.php";
            function process_id()
            {
                if (empty($_GET['id'])) {
                    return;
                }
                $id = $_GET['id'];
                $_SESSION['id'] = $id;
                $query = "select * from list where id ='$id'";
                $result = exec_query($GLOBALS['conn'], $query);
                $count = mysqli_num_rows($result);
                if ($count <= 0) {
                    $GLOBALS['id_exists'] = false;
                    return;
                }
                $GLOBALS['id_exists'] = true;
                while ($row = mysqli_fetch_assoc($result)) {
                    print "<tr>";
                    print '<td align="center">' . $row['id'] . "</td>";
                    print '<td align="center">' . $row['details'] . "</td>";
                    print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                    print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
                    print '<td align="center">' . $row['public'] . "</td>";
                    print "</tr>";
                }
            }
            process_id();
            ?>
    </table>
    <br>
    <?php
        if ($id_exists == "true") {
            print '<div class="container card p-3 bg-body-tertiary">
            <form  action="edit.php" method="post">
                <div class="form-label">Enter new detail:</div> 
                <input class="form-control mb-3" type="text" name="details" />

                <div class="form-check">
                    <input class="form-check-input mb-3" type="checkbox" name="public[]" value="yes"/>
                    <div class="form-check-label">Is public post</div>
                </div>
                <input class="btn btn-primary mt-3" type="submit" value="Update List"/>
            </form>
            </div>
            ';
        } else {
            print '<h2 align="center">There is no data to be edited</h2>';
        }
        ?>
</body>

</html>