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

$query = "select max(LocID) from location";

$result = mysql_query($query, $conn);
if (!$result) {
    echo("No record found");
} else {
    $get_in = mysql_fetch_row($result);
    $LID = $get_in[0] + 1;
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Location</title>
    </head>
    <body>
        <form  method="post" >

            <h1><center> Add Location</center></h1>

            <table border="0" align="center">
                <tr>
                    <td>Location ID:</td>
                    <td><input type="text" readonly="readonly" value=<?php echo $LID; ?> name="LID"/></td>
                </tr>
                <tr>
                    <td>
                        Name: </td>

                    <td>

                        <input type="text" name="LName" value="" maxlength="30" /><label id="lblID"></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        Address:
                    </td><td><textarea name="LAddress" rows="4" cols="20" >
                            </textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Submit" style="height:30;width:100"/>
                        <input type="reset" value="Reset" style="height:30;width:100"/>
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
    if (empty($_POST["LName"]) || empty($_POST["LAddress"])) {
        die("<font color='red'>Both fields are mandatory</font>");
    }
    if (!preg_match("/^[a-zA-Z]{1,25}$/", $_POST["LName"])) {
        echo "<p><font color='red'>Invalid location name</font></p>";
        $count = 1;
    }
if(strlen($_POST["LAddress"])>50)
{
        echo "<p><font color='red'>Location address must be less than or equal to 50 characters</font></p>";
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
        $sql = "insert into location(LocID, LocName,LocAddress)values('$_POST[LID]','$_POST[LName]','$_POST[LAddress]')";
        $result3 = mysql_query($sql);
        if (!$result3) {
            die('Error: ' . mysql_error());
        }
        header("Location:Admin.php");

        mysql_close($con);
    }
}
?>
