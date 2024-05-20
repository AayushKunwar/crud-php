<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yasoo</title>
</head>
<body>
   <h2>List CRUD php app</h2> 
    <a href="login.php">Click here to login</a>
    <br>
    <br>
    <a href="register.php">Click here to register</a>
    <br>
    <h2 align="center">List</h2>
    <table width="100%" border="1px">
        <tr>
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