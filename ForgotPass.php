<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
include("index.php");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Forgot Password</title>
    </head>
    <body>

        <form  method="POST" >

            <h1> <center>Forgot Password</center></h1>

            <table border="0" align="center">
                <tr>
                    <td>
                        ID: </td>

                    <td>

                        <input type="text" name="ID" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Security Question:
                    </td><td><select name="drpQues">
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
                    <td><input type="password" name="Answer" value=""/></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit" style="height:30;width:100"/> <td><input type="reset" value="Reset" style="height:30;width:100"/></td>
                    
                </tr>
            </table>

        </form>
<?php
if ($_POST) {
    if (empty($_POST["ID"]) || empty($_POST["Answer"]) || $_POST["drpQues"]==="Please Select") {
                die("<font color='red'>All fields are mandatory.</font>");
            }
    $mysql_user = "root";
    $mysql_db = "eventmanagementsystem";
    $mysql_link = mysql_connect("localhost", $mysql_user, "");
    if (!$mysql_link) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db($mysql_db);

    $select_prj = "select EmployeeID,Password from Employee where EmployeeID='" . $_POST["ID"] . "' and Security_Ques='" . $_POST["drpQues"] . "' and Answer='" . $_POST["Answer"] . "'";
    $result1 = mysql_query($select_prj);

    if (!$result1) {
        echo("No record found");
    } else {
        $get_in = mysql_fetch_row($result1);
        if (!$get_in) {
            print("<font color='red'>No record found</font>");
        } else {
            $pass = $get_in[1];
            for ($i = 0; $i < strlen($pass); $i++) {
                $ascii_val = ord($pass[$i]);
                $ascii_val -=3;
                $pass[$i] = chr($ascii_val);
            }
echo "Your password is ". $pass;
echo "&nbsp&nbsp<a href='Login.php'>Click here to continue </a>";
     }
    }
}
?>
    </body>
</html>
