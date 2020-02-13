<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">


<?php
include("index.php");
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form  method="post" >
            <h1> <center>Welcome to Showman House</center></h1>
            <table border="0" align="center">
                <tr>
                    <td>Type of user</td>
                    <td><select name="drpUser">
                            <option value="Please Select">Please Select</option>
                            <option value="Admin">Admin</option>
                            <option  value="Employee">Employee</option>
                        </select></td>
                </tr>
                <tr>
                    <td>
                        ID </td>
                    <td>
                        <input type="text" name="ID" size="20" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Password
                    </td><td><input type="password" name="Password" size="21" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Login" style="height:30;width:100"/>
                        <input type="reset" value="Reset" style="height:30;width:100"/>
                    </td>
                    <td><a href="ForgotPass.php">Forgot Password</a></td>
                </tr>
            </table>
        </form>
        <?php
        if ($_POST) {
            if (empty($_POST["ID"]) || empty($_POST["Password"]) || $_POST["drpUser"] == "Please Select") {
                die("<font color='red'>All fields are mandatory.</font>");
            }
            $mysql_user = "root";
            $mysql_db = "eventmanagementsystem";
            $mysql_link = mysql_connect("localhost", $mysql_user, "");
            if (!$mysql_link) {
                die('Could not connect: ' . mysql_error());
            }
            mysql_select_db($mysql_db);
            if (isset($_POST["ID"]) && isset($_POST["Password"])) {
                $pass = $_POST["Password"];
                for ($i = 0; $i < strlen($pass); $i++) {
                    $ascii_val = ord($pass[$i]);
                    $ascii_val +=3;
                    $pass[$i] = chr($ascii_val);
                }
                $select_prj = "select EmployeeID,Flag,Type_Of_User from Employee where EmployeeID='" . $_POST["ID"] . "' and Password='" . $pass . "' and Type_Of_User='" . $_POST["drpUser"] . "'";
                $result1 = mysql_query($select_prj);
                if (!$result1) {
                    echo("No record found");
                } else {
                    $get_in = mysql_fetch_row($result1);
                    if (!$get_in) {
                        print("<font color='red'>Sorry, login credentials are not valid</font>");
                    } else {
                        $uid = $_POST["ID"];
                        $_SESSION["uid"] = $uid;
                        $pass2 = $get_in[0];
                        $flag = $get_in[1];
                        $user = $get_in[2];
                        if ($flag == 1 && strcasecmp($user, "Employee") == 0)
                            header("Location:AddCustomer.php");
                        else if ($flag == 0 && strcasecmp($user, "Employee") == 0)
                            header("Location:Change_Pwd.php");
                        else if (($flag == 0 || $flag == 1) && strcasecmp($user, "Admin") == 0)
                            header("Location:Admin.php");
                    }
                }
            }
        }
        ?>
    </body>
</html>
