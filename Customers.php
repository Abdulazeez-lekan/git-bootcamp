<?php

include("index.php");

$mysql_user = "root";
$mysql_db = "eventmanagementsystem";
$mysql_link = mysql_connect("localhost", $mysql_user, "");
if (!$mysql_link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($mysql_db);
$insert = "insert into customerdetails (customerID, customerName,customerAddress, customerContactNumber, customerEmailID) values
                    ('" . $_POST["CID"] . "','" . $_POST["CName"] . "','" . $_POST["CAddress"] . "','" . $_POST["CContactNo"] . "','" . $_POST["CEmailID"] . "')";

$result = mysql_query($insert);
if (!$result) {
    die('Invalid query: ' . mysql_error());
} else {
    print("The customer details have been inserted in the database.");
    header("Location:EventDetails.php");
}
?>
