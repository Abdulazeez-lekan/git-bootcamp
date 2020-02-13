<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">


<?php
session_start();
include_once("Logout.php");


echo "<div align='center'>
              <a href='Booking.php'>Book an Event</a>
         <a href='EditEvent.php'>Update Event</a>

                <br>
                       <br>
        </div>";
$conn = mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db('eventmanagementsystem', $conn);

$query = "select customerID from customerdetails";


$result = mysql_query($query, $conn);

$selectbox = 'Customer ID: <select name=\'customerID\' position:absolute;
 onchange=\'showUser(this.value)\'>';
$selectbox.='<option value="Please Select">Please Select</option>';
while ($row = mysql_fetch_array($result)) {
    $selectbox.='<option value="' . $row['customerID'] . '">' . $row['customerID'] . '</option>';
}

$selectbox.='</select>';
echo $selectbox;
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
                xmlhttp.open("get","editCustomer.php?q="+str,true);
                xmlhttp.send();
            }
        </script>


        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Search Customer</title>
    </head>
    <body>





        <br>


        <div id="txtHint"><b>Customer information will be displayed here.</b></div>

        <br>






    </body>
</html>
