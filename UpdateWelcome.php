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
        <div align="center">
            <a href="Booking.php">Booking</a>
            <a href="EditEvent.php">Update Event</a>
            <a href="Customer.php">Update Customer</a>
            <br>
        </div>
<?php

$mysql_db = "eventmanagementsystem";
$mysql_user = "root";
$mysql_link = mysql_connect("localhost", $mysql_user, "");
if (!$mysql_link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($mysql_db);

$update_a = "update customerDetails set customerName='" . $_GET["EditcstName"] . "', customerAddress='" . $_GET["EditcstAddress"] . "',customerContactNumber='" . $_GET["EditcstNum"] . "',customerEmailID='" . $_GET["EditcstEmail"] . "' where customerID='" . $_GET["EditcstID"] . "'";

$result3 = mysql_query($update_a);
if (!$result3) {
    die('Invalid query: ' . mysql_error());
} else {
    print("<center><br><br><br>Thank you for submitting your data with us</center>");
    
}
?>
    </body>
</html>
