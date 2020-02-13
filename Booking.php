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


    echo("No record found");
} else {
    $get_in = mysql_fetch_row($result);
    $C_ID = $get_in[0] + 1;
}
?>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Booking</title>
    </head>
    <body>
        <div align="center">

            <a href="EditEvent.php">Update Event</a>
            <a href="Customer.php">Update Customer</a>
            <br>
            <br>
        </div>
        <h1><center> Please enter customer details </center></h1>

        <form name="Customer"  method="POST">
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
                        <input type="text" name="CName" value="" maxlength="30"/>


                    </td>


                </tr>
                <tr>

                    <td>
                        Address </td>
                    <td><input type="text" name="CAddress" value="" maxlength="50"/>
                    </td>
                </tr>

                <tr>
                    <td>

                        Contact Number

                    </td>
                    <td>

                        <input type="text" name="CContactNo" value="" maxlength="10"/>
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
                        <input type="submit" value="Submit" style="height:30; width:100"/>
                        <input type="reset" value="Reset" style="height:30; width:100"/>
                    </td>

                </tr>
            </table>
        </form>


    </body>
</html>
<?php
if ($_POST) {
    $count = 0;
    if (empty($_POST["CName"]) || empty($_POST["CAddress"]) || empty($_POST["CContactNo"]) || empty($_POST["CEmailID"])) {
        $count = 1;
        die("<font color='red'>All fields are mandatory.</font>");
    }
    if (!preg_match("/^[0-9]{10}$/", $_POST["CContactNo"]) || strlen($_POST["CContactNo"]) < 10) {
        echo "<p><font color='red'>Invalid phone number</font></p>";
        $count = 1;
    }
    if (!filter_var($_POST["CEmailID"], FILTER_VALIDATE_EMAIL)) {
        die("<font color='red'>Invalid Email ID</font>");
    }

    if ($count == 0) {
        $mysql_user = "root";
        $mysql_db = "eventmanagementsystem";
        $mysql_link = mysql_connect("localhost", $mysql_user, "");
        if (!$mysql_link) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($mysql_db);
        $insert = "insert into customerdetails values
                    ('" . $_POST["CID"] . "','" . $_POST["CName"] . "','" . $_POST["CAddress"] . "','" . $_POST["CContactNo"] . "','" . $_POST["CEmailID"] . "')";

        $result = mysql_query($insert);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        } else {
            header("Location:EventDetails.php?CID=" . $_POST["CID"]);
        }
    }
}
?>