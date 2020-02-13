<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
include_once("Logout.php");
session_start();
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Update Employee Details</title>
    </head>
    <body>
        <br>
        <br>
        <br>

        <form action="Settings.php" method="POST">
            <?php
            $q = $_SESSION["uid"];
            $con = mysql_connect('localhost', 'root', '');
            if (!$con) {
                die('Could not connect: ' . mysql_error());
            }

            mysql_select_db("eventmanagementsystem", $con);

            $sql = "SELECT * FROM  employee WHERE EmployeeID = '" . $q . "'";

            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {

                echo "<table border='0' align='center'>";

                echo "<tr><td>Name:</td><td> <input type='text' readonly='readonly' name='EditempName' value='" . $row['EmployeeName'] . "'/></td></tr>";

                echo "<tr><td>Contact Number:</td><td> <input type='text' name='EditempNum' value='" . $row['EmployeeContactNumber'] . "'/></td></tr>";

                echo "<tr><td>Email ID:</td><td> <input type='text' name='EditempEmail' value='" . $row['EmployeeemailID'] . "'/></td></tr>";

                echo "<tr><td>Date of Joining: </td><td><input type='text' name='EditempDOB' readonly='readonly' value='" . $row['EmployeeDOJ'] . "'/></td></tr>";
            }

            mysql_close($con);

            echo "<tr><td><input type='submit' value='Update' />&nbsp<input type='reset' value='Reset'/></td><td><a href='Change_Pwd.php'>Change Password</a></td></tr></table>";
            ?>
        </form>





    </body>
</html>
<?php
            if ($_POST) {
                $val = $_POST["EditempEmail"];
                if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                    die("<font color='red'>Invalid Email ID</font>");
                }

                $mysql_db = "eventmanagementsystem";
                $mysql_user = "root";
                $mysql_link = mysql_connect("localhost", $mysql_user, "");
                if (!$mysql_link) {
                    die('Could not connect: ' . mysql_error());
                }
                mysql_select_db($mysql_db);

                $update_a = "update employee set EmployeeContactNumber='" . $_POST["EditempNum"] . "',EmployeeemailID='" . $_POST["EditempEmail"] . "',EmployeeDOJ='" . $_POST["EditempDOB"] . "' where EmployeeID='" . $q . "'";

                $result3 = mysql_query($update_a);
                if (!$result3) {
                    die('Invalid query: ' . mysql_error());
                } else {
                    echo "Your details are updated successfully.";
                }
            }
?>

