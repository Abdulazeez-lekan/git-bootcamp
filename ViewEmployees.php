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

        <script type="text/javascript">
            function showUser(str)
            {
                if (str=="")
                {
                    document.getElementById("txtHint").innerHTML="";
                    return;
                }
                if (window.XMLHttpRequest)
                {
                    xmlhttp=new XMLHttpRequest();
                }

                xmlhttp.onreadystatechange=function()
                {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("get","ShowEmployee.php?q="+str,true);
                xmlhttp.send();
            }
        </script>


        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <div align="center">

            <a href="Customer.php">View Details of Customers </a> &nbsp; <a href="EditEvent.php"> View Details of Events </a> &nbsp; <a href="AddEmployee.php"> Add Employee </a> &nbsp;<a href="AddLocation.php"> Add Location </a>

        </div>
        <br>
        <div id="txtHint"><b>Employee information will be shown here.</b></div>
        <br>
    </body>
</html>


<?php
$conn = mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db('eventmanagementsystem', $conn);

$query = "select EmployeeID from employee";


$result = mysql_query($query, $conn);

$selectbox = 'Employee ID: <select name=\'EmployeeID\' position:absolute; onchange=\'showUser(this.value)\'>';
$selectbox.='<option value="Please Select">Please Select</option>';
while ($row = mysql_fetch_array($result)) {
    $selectbox.='<option value="' . $row['EmployeeID'] . '">' . $row['EmployeeID'] . '</option>';
}

$selectbox.='</select>';



echo $selectbox;
?>






