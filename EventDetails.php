<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
session_start();
include_once("Logout.php");
$conn = mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db('eventmanagementsystem', $conn);

$query = "select max(EventID) from events";

$result = mysql_query($query, $conn);
if (!$result) {
    echo("No record found");
} else {
    $get_in = mysql_fetch_row($result);
    $EV_ID = $get_in[0] + 1;
}
echo "<div align='center'>
         <a href='Booking.php'>Booking</a>
         <a href='EditEvent.php'>Update Event</a>
         <a href='Customer.php'>Update Customer</a>
                <br>
                <br>
        </div>"; ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div align="center">
            <br>
            <br>
        </div>
        <h1> <center>Please Enter Event Details</center></h1>
        <form name="Events"  method="POST">
            <table border="0" align="center">
                <tr>
                    <td>
                        Event ID</td><td> <input type="text" name="EID" readonly="readonly" value=<?php echo $EV_ID; ?> /></td>
                </tr>
                <tr>
                    <td> Event Name </td><td><input type="text" name="EName" value="" /></td>
                </tr>
                <tr>
                    <td>
                        Event Type
                    </td>
                    <td>
                        <input type="text" name="EType" value="" />
                    </td>
                </tr>
                <tr>
                    <td>Start Date </td><td><select name="ST_YY" size="1">
                            <?php
                            for ($i = 2012; $i < 2020; $i++) {
                                echo"<option value=" . $i . ">" . $i . "</option>";
                            }
                            ?>
                        </select>YY</td><td><select name="ST_MM" size="1">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo"<option value=" . $i . ">" . $i . "</option>";
                            }
                            ?>
                        </select>MM</td>               <td><select name="ST_DD" size="1">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                echo"<option value=" . $i . ">" . $i . "</option>";
                            }
                            ?>
                        </select>DD</td>
                </tr>
                <tr>
                    <td>
                        End Date
                    </td>
                    <td><select name="EN_YY" size="1">
                            <?php
                            for ($i = 2012; $i < 2020; $i++) {
                                echo"<option value=" . $i . ">" . $i . "</option>";
                            }
                            ?>
                        </select>YY</td>
                    <td><select name="EN_MM" size="1">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo"<option value=" . $i . ">" . $i . "</option>";
                            }
                            ?>
                        </select>MM</td>
                    <td><select name="EN_DD" size="1">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                echo"<option value=" . $i . ">" . $i . "</option>";
                            }
                            ?>
                        </select>DD</td>
                </tr>
                <tr><td>
                        Staff Required </td><td><input type="text" name="EStaffRequired" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Employee ID
                    </td>
                    <td>
                        <input type="text" readonly="readonly" name="EEmpID" value=<?php echo $_SESSION["uid"]; ?> /></td>
                </tr>
                <tr>
                    <td>
                        Customer ID
                    </td>
                    <td>
                        <input type="text" readonly="readonly" name="ECustID" value=<?php echo $_GET["CID"]; ?> />
                    </td>
                </tr>
                <tr>
                    <td>
                        Number of People </td><td><input type="text" name="ENoOfPeople" value="" onchange="fun1()" />
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" value="Submit" style="height:30; width:70"/>
                        <input type="reset" value="Reset" style="height:30; width:70"/>
                    </td>
                    <td></td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
                            if ($_POST) {
                                $count = 0;
                                $m1 = (int) $_POST["ST_MM"];
                                $d1 = (int) $_POST["ST_DD"];
                                $y1 = (int) $_POST["ST_YY"];
                                $m2 = (int) $_POST["EN_MM"];
                                $d2 = (int) $_POST["EN_DD"];
                                $y2 = (int) $_POST["EN_YY"];
                                if (empty($_POST["EName"]) || empty($_POST["EType"]) || empty($_POST["ST_YY"]) || empty($_POST["ST_MM"]) || empty($_POST["ST_DD"]) || empty($_POST["EN_YY"]) || empty($_POST["EN_MM"]) || empty($_POST["EN_DD"]) || empty($_POST["EStaffRequired"]) || empty($_POST["ENoOfPeople"])) {
                                    die("<font color='red'><br>All fields are mandatory</font>");
                                }
                                if (!(checkdate($m1, $d1, $y1)) || !(checkdate($m2, $d2, $y2))) {
                                    echo("<font color='red'><br>Invalid dates</font>");
                                    $count = 1;
                                }
                                if ($_POST["EStaffRequired"] < 1 || $_POST["EStaffRequired"] > 50) {
                                    echo("<font color='red'><br>Staff required must be between 1 and 50</font>");
                                    $count = 1;
                                }
                                if ($_POST["ENoOfPeople"] < 1 || $_POST["ENoOfPeople"] > 1000) {
                                    echo("<font color='red'><br>Number of people must be between 1 and 1000</font>");
                                    $count = 1;
                                }
                                $st_date = $y1 . "-" . $m1 . "-" . $d1;
                                $en_date = $y2 . "-" . $m2 . "-" . $d2;
                                if ($st_date > $en_date) {
                                    echo("<font color='red'><br>Start date must be less than end date</font>");
                                    $count = 1;
                                }
                                if ($count == 0) {
                                    $mysql_user = "root";
                                    $mysql_db = "eventmanagementsystem";
                                    $con = mysql_connect("localhost", $mysql_user, "");
                                    if (!$con) {
                                        die('Could not connect: ' . mysql_error());
                                    }
                                    mysql_select_db($mysql_db);
                                    $sql = "insert into events(EventID, EventName,EventType,StartDate,EndDate,StaffRequired,EmployeeID,CustomerID,NoOfPeople) VALUES
('$_POST[EID]','$_POST[EName]','$_POST[EType]','$st_date','$en_date','$_POST[EStaffRequired]','$_POST[EEmpID]','$_POST[ECustID]','$_POST[ENoOfPeople]')";
                                    $result3 = mysql_query($sql);
                                    if (!$result3) {
                                        die('Error: ' . mysql_error());
                                    }
                                    else
                                        header("Location:Location.php?CID=" . $_POST[ECustID] . "&EID=" . $_POST[EID] . "&EempID=" . $_POST[EEmpID] . "&ST_DATE=" . $st_date . "&EN_DATE=" . $en_date);
                                }
                            }
?>