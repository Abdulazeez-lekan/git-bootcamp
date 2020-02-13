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

$query = "select max(customerID) from customerdetails";

$result = mysql_query($query, $conn);
if (!$result) {


    echo("Error occurs");
} else {
    $get_in = mysql_fetch_row($result);
    $C_ID = $get_in[0] + 1;
}
?>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <br>    <br>
        <div align="center">

            <a href="Booking.php">Booking</a>
            <a href="EditEvent.php">Update Event</a>
            <a href="Customer.php">Update Customer</a>
        </div>

        <center>  <h1> Add Customer Details</h1></center>

        <form name="Customer" action="Welcome.php" method="GET">
            <table border="0" align="center">
                <tr>
                    <td>
                        Customer ID</td>
                    <td>

                        <input type="text" name="CID" value=<?php echo $C_ID; ?> />
                    </td>
                </tr>
                <tr>
                    <td>
                        Name
                    </td>
                    <td>
                        <input type="text" name="CName" value="" />


                    </td>


                </tr>
                <tr>

                    <td>
                        Address </td>
                    <td><input type="text" name="CAddress" value="" />
                    </td>
                </tr>

                <tr>
                    <td>

                        Contact Number

                    </td>
                    <td>

                        <input type="text" name="CContactNo" value="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        Email ID
                    </td>
                    <td>

                        <input type="text" name="CEmailID" value="" />
                    </td>
                </tr>
                <tr>

                    <td>
                    </td>
                    <td><center> <input type="submit" value="Submit" style="height:30; width:70"/></center></td>
                    <td></td>
                </tr>
            </table>

        </form>
    </body>
</html>
<?php
if ($_GET) {
    // put your code here
    $count = 0;
    $val = $_GET["CEmailID"];
    if (empty($_GET["CID"]) || empty($_GET["CName"]) || empty($_GET["CAddress"]) || empty($_GET["CContactNo"]) || empty($_GET["CEmailID"])) {
        die("<font color='red'>All fields are mandatory.</font>");
    } else if (!preg_match("/^[0-9]/", $_GET["CContactNo"]) && (strlen($_GET["CContactNo"]) < 10 || strlen($_GET["CContactNo"]) > 10)) {
        die("<font color='red'>Invalid Contact Number</font>");
    }
    if (filter_var($val, FILTER_VALIDATE_EMAIL)) {
        $mysql_user = "root";
        $mysql_db = "eventmanagementsystem";
        $mysql_link = mysql_connect("localhost", $mysql_user, "");
        if (!$mysql_link) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($mysql_db);
        $insert = "insert into customerdetails (customerID, customerName,customerAddress, customerContactNumber, customerEmailID) values
            ('" . $_GET["CID"] . "','" . $_GET["CName"] . "','" . $_GET["CAddress"] . "','" . $_GET["CContactNo"] . "','" . $_GET["CEmailID"] . "')";

        $count = 0;
        $result = mysql_query($insert);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        } else {

            header("Location:http://localhost/Project/EventDetails.php?CID=" . $_GET["CID"]);
        }
    } else {

        die("<font color='red'>Invalid Email ID</font>");
    }
}
?>