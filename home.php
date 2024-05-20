<html>
    <head>
        <title>PHP website</title>
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
    <body>
        <h2>Home Page</h2>
        <p>Hello <?php print "$user" ?>!</p>
        <a href="logout.php">Click here to logout</a>
        <br>
        <form action="add.php" method="POST">
            Add more to list:
            <input type="text" name="details"/><br>
            Public post? <input type="checkbox" name="public[]" value="yes"/> <br>
            <input type="submit" value="Add to list"/>
        </form>
        <h2 align="center">My List</h2>
        <table border="1px" width="100%">
            <tr>
                <th>ID</th>
                <th>Details</th>
                <th>Post Time</th>
                <th>Edit Time</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Public</th>
            </tr>
            <?php
            require "config.php";
            $query = "SELECT * FROM list";
            $result = exec_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                print "<tr>";
                print '<td align="center">' . $row['id'] . "</td>";
                print '<td align="center">' . $row['details'] . "</td>";
                print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
                print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
                print '<td align="center"><a href="edit.php">edit</a> </td>';
                print '<td align="center"><a href="delete.php">delete</a> </td>';
                print '<td align="center">' . $row['public'] . "</td>";
                print "</tr>";
            }
            ?>
        </table>
    </body>
</html>