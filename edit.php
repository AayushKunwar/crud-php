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
            if ($list['id'] != null) {
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
        <title>Edit page</title>
    </head>
    
    <body>
        
        <h2>Edit Page</h2>
        <p>Hello <?php print "$user" ?></p>
        <a href="logout.php">Click here to go logout</a><br><br>
        <a href="home.php">Return to home page</a>
        <h2 align="center">Currently Selected</h2>
        <table border="1px" width="100%">
            <tr>
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
            print '
            <form action="edit.php" method="post">
                Enter new detail: <input type="text" name="details" /><br>
                public post? <input type="checkbox" name="public[]" value="yes"/><br>
                <input type="submit" value="Update List"/>
            </form>
            ';
        } else {
            print '<h2 align="center">There is no data to be edited</h2>';
        }
        ?>
    </body>
</html>