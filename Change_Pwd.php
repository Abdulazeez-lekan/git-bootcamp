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
        <title>Change Password</title>
    </head>
    <body>
        <br>
        <br>
        <br>

        <form action="Change_Pwd.php" method="POST">
            <table border="0" align="center">
                <caption><b>Change Password</b></caption>
                <tr><td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        Employee ID</td>
                    <td>

                        <input type="text" readonly="readonly" name="EID" value=<?php echo $_SESSION["uid"]; ?> />
                    </td>
                </tr>
                <tr>
                    <td>
                        Current Password
                    </td>
                    <td>
                        <input type="password" name="EPassword" value="" />


                    </td>


                </tr>
                <tr>

                    <td>
                        New Password </td>
                    <td><input type="password" name="ENewPassword" value="" /> (Minimum 5 and Maximum 15 characters are allowed)
                    </td>
                </tr>

                <tr>
                    <td>

                        Confirm Password

                    </td>
                    <td>

                        <input type="password" name="EConfPassword" value="" />
                    </td>
                </tr>
                <tr>
                    <td>Select Security Question</td>
                    <td><select name="drpQues">
                            <option value="Please Select">Please Select</option>
                            <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                            <option value="What is the name of your childhood friend?">What is the name of your childhood friend?</option>
                            <option value="Which is your favorite color?">Which is your favorite color?</option>
                            <option value="What is the name of your school?">What is the name of your school?</option>
                            <option value="How many friends you have?">How many friends you have?</option>
                        </select></td>

                </tr>
                <tr>
                    <td>Answer</td>
                    <td><input type="text" name="Answer" value=""/></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Update" style="height:30; width:100"/>
                        <input type="reset" value="Reset" style="height:30; width:100"/>
                    </td>

                </tr>
            </table>

        </form>
        <?php
        if ($_POST) {
            $count = 0;

            if (empty($_POST["EPassword"]) || empty($_POST["ENewPassword"]) || empty($_POST["EConfPassword"]) || empty($_POST["Answer"])) {
                die("<font color='red'>All fields are mandatory.</font>");
            }
            if ($_POST["ENewPassword"] != $_POST["EConfPassword"]) {
                echo "<font color='red'>Password mismatch</font>";
                $count = 1;
            }
            if ((strlen($_POST["ENewPassword"]) < 5) || (strlen($_POST["ENewPassword"]) > 15)) {
                echo "<font color='red'>Invalid password</font>";
                $count = 1;
            }
            if ($_POST["drpQues"] === "Please Select") {
                echo "<font color='red'>Please select security question</font>";
                $count = 1;
            }

            if ($count == 0) {
                $mysql_user = "root";
                $mysql_db = "eventmanagementsystem";
                $mysql_link = mysql_connect("localhost", $mysql_user, "");
                if (!$mysql_link) {
                    die('Could not connect: ' . mysql_error());
                }
                mysql_select_db($mysql_db);

                $pass = $_POST["ENewPassword"];

                for ($i = 0; $i < strlen($pass); $i++) {
                    $ascii_val = ord($pass[$i]);
                    $ascii_val +=3;
                    $pass[$i] = chr($ascii_val);
                }

                $update_a = "update employee set Flag=1 ,Password='" . $pass . "',Security_Ques='" . $_POST["drpQues"] . "',Answer='" . $_POST["Answer"] . "' where EmployeeID='" . $_POST["EID"] . "'";
                $result3 = mysql_query($update_a);
                if (!$result3) {
                    die('Invalid Enteries');
                } else {

                    header("Location:Welcome.php");
                }
            }
        }
        ?>


    </body>
</html>
