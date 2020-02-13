<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
include_once("Logout.php");
session_start();
$conn = mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db('eventmanagementsystem', $conn);

$query = "select max(EmployeeID) from employee";

$result = mysql_query($query, $conn);
if (!$result) {


    echo("Error occurs");
} else {
    $get_in = mysql_fetch_row($result);
    $E_ID = $get_in[0] + 1;
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Employee</title>
    </head>
    <body>
        <center>
            <h1> Please Enter Employee Details</h1>
            <form method="POST">
                <table border="0" align="center">

                    <tr>
                        <td>
                            Employee ID</td><td> <input type="text"  readonly="readonly" name="EID" value=<?php echo $E_ID; ?> /></td>
                    </tr>
                    <tr>

                        <td> Employee Name </td><td><input type="text" name="EName" value="" /></td>
                    </tr>

                    <tr>
                        <td>
                            Employee Contact Number
                        </td>
                        <td>

                            <input type="text" name="EPhone" value="" maxlength="10" />
                        </td>
                    </tr>
                    <tr>
                        <td>Email ID </td><td><input type="text" name="EemailID" value="" /></td>
                    </tr>
                    <tr>

                        <td>
                            Employee DOJ </td><td><select name="YY" size="1">
                                <?php
                                for ($i = 2012; $i < 2020; $i++) {
                                    echo"<option value=" . $i . ">" . $i . "</option>";
                                }
                                ?>
                            </select>YY</td><td><select name="MM" size="1">
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo"<option value=" . $i . ">" . $i . "</option>";
                                }
                                ?>
                            </select>MM</td>               <td><select name="DD" size="1">
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                    echo"<option value=" . $i . ">" . $i . "</option>";
                                }
                                ?>
                            </select>DD</td>


                    </tr>

                    <tr>

                        <td>
                            Password </td><td><input type="password" name="EPass" value="" /></td>


                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Submit" style="height:30; width:100"/>
                            <input type="reset" value="Reset" style="height:30; width:100"/>
                        </td>
                    </tr>
                </table>


            </form>
        </center>
    </body>
</html>
<?php
                                if ($_POST) {
                                    $count = 0;
                                    $val = $_POST["EemailID"];
                                    $m1 = (int) $_POST["MM"];
                                    $d1 = (int) $_POST["DD"];
                                    $y1 = (int) $_POST["YY"];
                                    if (empty($_POST["EName"]) || empty($_POST["EPhone"]) || empty($_POST["EemailID"]) || empty($_POST["EPass"])) {
                                        die("<font color='red'>All fields are mandatory</font>");
                                        $count = 1;
                                    }
                                    if (!preg_match("/^[a-zA-Z]{1,25}$/", $_POST["EName"])) {
                                        echo "<p><font color='red'>Invalid employee name</font></p>";
                                        $count = 1;
                                    }
                                    if (!preg_match("/^[0-9]{10}$/", $_POST["EPhone"]) || strlen($_POST["EPhone"]) < 10) {
                                        echo "<p><font color='red'>Invalid phone number</font></p>";
                                        $count = 1;
                                    }

                                    if (!(checkdate($m1, $d1, $y1))) {
                                        echo("<font color='red'><br>Invalid Date</font>");
                                        $count = 1;
                                    }
                                    if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                                        echo("<font color='red'><br>Invalid email ID</font>");
                                        $count = 1;
                                    }
                                    if ($count == 0) {
                                        $mysql_user = "root";
                                        $mysql_db = "event management system";
                                        $con = mysql_connect("localhost", $mysql_user, "");
                                        if (!$con) {
                                            die('Could not connect: ' . mysql_error());
                                        }

                                        mysql_select_db($mysql_db);
                                        $pass = $_POST["EPass"];
                                        for ($i = 0; $i < strlen($pass); $i++) {
                                            $ascii_val = ord($pass[$i]);
                                            $ascii_val +=3;
                                            $pass[$i] = chr($ascii_val);
                                        }
                                        $st_date = $y1 . "-" . $m1 . "-" . $d1;
                                        $sql = "insert into employee(EmployeeID, EmployeeName,EmployeeContactNumber, EmployeeemailID,EmployeeDOJ, Password)
VALUES
('$_POST[EID]','$_POST[EName]','$_POST[EPhone]','$_POST[EemailID]','$st_date','$pass')";
                                        $result3 = mysql_query($sql);
                                        if (!$result3) {
                                            die('Error: ' . mysql_error());
                                        }
                                        else
                                            header("Location:Admin.php");


                                        mysql_close($con);
                                    }
                                }
?>