<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        
    </head>
    <body>
        <form action="UpdateEventWelcome.php" >
            <?php
            $q = $_GET["ev"];
            $con = mysql_connect('localhost', 'root', '');
            if (!$con) {
                die('Could not connect: ' . mysql_error());
            }

            mysql_select_db("eventmanagementsystem", $con);

            $sql = "SELECT * FROM  events WHERE EventID = '" . $q . "'";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {

                echo "<hr><table border=0 align='center'>";

                echo "<tr><td><input type='hidden' name='EditeventID' value='" . $row['EventID'] . "'/></td></tr>";

                echo "<tr><td>Event Name</td><td> <input type='text' id='EditeventName' name='EditeventName' value='" . $row['EventName'] . "'/></td></tr>";

                echo "<tr><td>Event Type</td><td><input type='text' id='EditeventType' name='EditeventType' value='" . $row['EventType'] . "'/></td></tr>";

                echo "<tr><td>Start Date</td><td> <input type='text' id='EditstartDate' name='EditstartDate' value='" . $row['StartDate'] . "'/></td></tr>";

                echo "<tr><td>End Date</td><td> <input type='text' id='EditendDate' name='EditendDate' value='" . $row['EndDate'] . "'/></td></tr>";


                echo "<tr><td>Staff Required</td><td> <input type='text' id='EditstaffKey' name='EditstaffKey' value='" . $row['StaffRequired'] . "'/></td></tr>";


                echo "<tr><td>Employee ID</td><td><input type='text' readonly='readonly' name='Editempid' value='" . $row['EmployeeID'] . "'/></td></tr>";



                echo "<tr><td>Customer ID</td><td> <input type='text' readonly='readonly' name='Editcustid' value='" . $row['CustomerID'] . "'/></td></tr>";


                echo "<tr><td>No of people</td><td><input type='text' name='EditPeople' id='EditPeople' value='" . $row['NoOfPeople'] . "'/></td></tr>";



                echo "<tr><td>Location </td><td><input type='text' readonly='readonly' name='EditLocation' value='" . $row['Location'] . "'/></td></tr>";
            }

            mysql_close($con);

            echo "<tr><td><input type='submit' value='Update' onClick='return func1()'/><input type='reset' value='Reset' /></td></tr>";
            echo "</table>";
            ?>

        </form>

    </body>
</html>
