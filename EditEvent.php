<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<script type="text/javascript">
    function func1()
    {
        var s1=document.getElementById("EditeventName").value.toString();
        var s2=document.getElementById("EditeventType").value.toString();
        var s3=document.getElementById("EditstartDate").value.toString();
        var s4=document.getElementById("EditendDate").value.toString();
        var s5=document.getElementById("EditstaffKey").value.toString();
        var s6=document.getElementById("EditPeople").value.toString();
        var sk= parseInt(document.getElementById("EditstaffKey").value.toString());
        var ep= parseInt(document.getElementById("EditPeople").value.toString());
        var msg="";
        var count=0;
        if(s1.length<=0 || s2.length<=0 || s3.length<=0 || s4.length<=0 || s5.length<=0 || s6.length<=0)
        {
            msg="All fields are mandatory";
            count=1;
        }
        if(sk<1 || sk>50)
        {
            msg += "\n"+"Staff required must be between 1 and 50";
            count=1;
        }
        if(ep<1 || ep>1000)
        {
            msg += "\n"+"Number of people must be between 1 and 1000";
            count=1;
        }
        if(count==1)
        {
            alert (msg);
            return false;
        }
        else
        {
            return true;
        }
    }
</script>
<?php
include("logout.php");
echo "<div align='center'>
              <a href='Booking.php'>Booking</a>
         <a href='Customer.php'>Update Customer</a>

                <br>
                       <br>
        </div>";
$conn = mysql_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db('eventmanagementsystem', $conn);

$query = "select EventID from events";


$result = mysql_query($query, $conn);

$selectbox = 'Event ID: <select name=\'eventID\' position:absolute;
left:100px;
top:150px; onchange=\'showEvent(this.value)\'>';
$selectbox.='<option value="Please Select">Please Select</option>';
while ($row = mysql_fetch_array($result)) {
    $selectbox.='<option value="' . $row['EventID'] . '">' . $row['EventID'] . '</option>';
}

$selectbox.='</select>';
echo $selectbox;
?>
<html>
    <head>
        <script type="text/javascript">
            function showEvent(str)
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
                xmlhttp.open("get","EditEventDetails.php?ev="+str,true);
                xmlhttp.send();
            }
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>



        <br>

        <div id="txtHint"><b>Event information will be displayed here.</b></div>

        <br>

    </body>
</html>
