<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
session_start();
include_once("Logout.php");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $cid = $_GET["CID"];
        $eid = $_GET["EID"];
        $empid = $_GET["EempID"];
        $sdate = $_GET["ST_DATE"];
        $edate = $_GET["EN_DATE"];
        $conn = mysql_connect('localhost', 'root', '');
        if (!$conn) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db('eventmanagementsystem', $conn);
        $query = "SELECT LocID,LocName
FROM location
WHERE LocID NOT
IN (SELECT LocID FROM EVENTS WHERE StartDate not between '" . $sdate . "' and '" . $edate . "' and EndDate not between '" . $sdate . "'and '" . $edate . "')";
        $result = mysql_query($query, $conn);
        echo "<form method='POST'>";
        echo "<table border='0' align='center'>";
        echo "<tr><td>Event ID:</td><td> <input type='text' readonly='readonly' name='evtID' value=" . $eid . " /></td></tr>";
        echo "<tr><td>Employee ID:</td><td> <input type='text' readonly='readonly' name='empID' value=" . $empid . " /></td></tr>";
        echo "<tr><td>Customer ID:</td><td> <input type='text' readonly='readonly' name='custID' value=" . $cid . " /></td></tr>";
        echo "<tr><td>Select Preferred Location:</td><td><select name='loc'><option value='Please Select'>Please Select</option> ";
        while ($row = mysql_fetch_array($result)) {
            echo "<option value='" . $row['LocName'] . "'>" . $row['LocName'] . "</option>";
        }
        echo "</select></td>";
        echo "</tr>";
        echo "<tr><td></td><td><input type='submit' value='Submit' /><input type='reset' value='Reset' /></td></tr>";
        echo "</table>";
        ?>
    </body>
</html>
<?php
        if ($_POST) {
            $mysql_db = "eventmanagementsystem";
            $mysql_user = "root";
            $mysql_link = mysql_connect("localhost", $mysql_user, "");
            if (!$mysql_link) {
                die('Could not connect: ' . mysql_error());
            }
            mysql_select_db($mysql_db);
            $query = "select LocID from location where LocName='" . $_POST["loc"] . "'";
            $result = mysql_query($query, $mysql_link);
            $LID = 0;
            while ($row = mysql_fetch_array($result)) {
                $LID = $row[0];
            }
            $update_a = "update events set Location='" . $_POST["loc"] . "', LocID='" . $LID . "' where EventID='" . $_POST["evtID"] . "'";
            $result3 = mysql_query($update_a);
            if (!$result3) {
                die('Invalid query: ' . mysql_error());
            } else {
                header("Location:PaymentDetails.php?CID=".$_POST["custID"].'&EVID='.$_POST["evtID"]);
            }
        }
?>