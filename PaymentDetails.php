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

$query = "select max(PaymentDetailsID) from paymentdetails";

$result = mysql_query($query, $conn);
if (!$result) {


    echo("No record found");
} else {
    $get_in = mysql_fetch_row($result);
    $PAY_ID = $get_in[0] + 1;
}
?>
<script type="text/javascript">
    function show1()
    {

        var val1= document.getElementById("drp1").value.toString();
        if(val1=='Cheque')
        {
            document.getElementById("lbl2").innerHTML="Bank Details";
            document.getElementById("txt2").style.visibility="visible";
            document.getElementById("lbl1").innerHTML="Cheque Number";
            document.getElementById("txt1").style.visibility="visible";

        }

    }
</script>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div align="center">

            <a href="EditEvent.php">Update Event</a>
            <a href="Customer.php">Update Customer</a>
            <br>
            <br>
        </div>
        <h1><center> Please Enter Payment Details</center></h1>

        <form name="Events" method="POST">

            <table border="0" align="center">
                <tr>
                    <td>
                        Payment Details ID </td><td><input type="text" name="PID" readonly="readonly" value=<?php echo $PAY_ID; ?> /></td>
                </tr>
                <tr>

                    <td>
                        Customer ID </td><td><input type="text" readonly="readonly" name="CustID" value=<?php echo $_GET["CID"]; ?> /></td>
                </tr>
                <tr><td>
                        Event ID</td> <td><input type="text" name="EID" readonly="readonly" value=<?php echo $_GET["EVID"]; ?> />
                    </td>
                </tr>
                <tr>

                    <td>
                        Payment Amount
                    </td><td><input type="text" name="Payment" value="" /></tr>
                <tr><td>
                        Payment Method </td><td><select id="drp1" name="drpPayment" onchange="show1()">
                            <option value="Select">Please Select</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Cash">Cash</option>
                        </select></td>
                </tr>
                <tr><td >

                        <label id="lbl2"></label> </td><td><input type="text" id="txt2" style="visibility:hidden;"  name="BankDetails" value="" /></td>
                </tr>
                <tr><td >

                        <label id="lbl1"></label> </td><td><input type="text" id="txt1" style="visibility:hidden;"  name="chequeNumber" value="" /></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Submit" style="height:30; width:100"/>
                        <input type="reset" value="Reset" style="height:30; width:100"/>
                    </td></tr>
            </table>
        </form>
    </body>
</html>
<?php
if ($_POST) {
    if (empty($_POST["Payment"]) || $_POST["drpPayment"] == "Please Select") {
        die("<font color='red'>All fields are mandatory.</font>");
    } else if (($_POST["drpPayment"] == "Cheque") && ((strlen($_POST["chequeNumber"]) != 6) || (!preg_match("/^[0-9]/", $_POST["chequeNumber"])))) {

        die("<font color='red'>Please provide valid bank details</font>");
    } else {
        $mysql_user = "root";
        $mysql_db = "eventmanagementsystem";
        $mysql_link = mysql_connect("localhost", $mysql_user, "");
        if (!$mysql_link) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db($mysql_db);
        if ($_POST["drpPayment"] == "Cheque") {
            $insert = "insert into paymentdetails (PaymentDetailsID, CustomerID, EventID, Payment, PaymentMethod, ChequeNumber,BankDetails) values
                    ('" . $_POST["PID"] . "','" . $_POST["CustID"] . "','" . $_POST["EID"] . "','" . $_POST["Payment"] . "','" . $_POST["drpPayment"] . "','" . $_POST["chequeNumber"] . "','" . $_POST["BankDetails"] . "')";
        } else {
            $insert = "insert into paymentdetails (PaymentDetailsID, CustomerID, EventID, Payment, PaymentMethod) values
                    ('" . $_POST["PID"] . "','" . $_POST["CustID"] . "','" . $_POST["EID"] . "','" . $_POST["Payment"] . "','" . $_POST["drpPayment"] . "')";
        }

        $result = mysql_query($insert);
        if (!$result) {
            die('Invalid query: ' . mysql_error());
        } else {
            header("Location:Thanks.php");
        }
    }
}
?>