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
        <form action="UpdateWelcome.php">



            <?php
           


            $q = $_GET["q"];



            $con = mysql_connect('localhost', 'root', '');
            if (!$con) {
                die('Could not connect: ' . mysql_error());
            }

            mysql_select_db("eventmanagementsystem", $con);

            $sql = "SELECT * FROM  employee WHERE EmployeeID = '" . $q . "'";

            $result = mysql_query($sql);




            while ($row = mysql_fetch_array($result)) {

                echo "<table border='0' align='center'>";

                echo "<tr><td>Employee ID:</td><td><input type='text' readonly='readonly' name='EID' value='" . $row['EmployeeID'] . "'/></td></tr>";


                echo "<tr><td>Name:</td><td> <input type='text' readonly='readonly' name='EName' value='" . $row['EmployeeName'] . "'/></td></tr>";

                echo "<tr><td>Contact Number:</td><td> <input type='text' readonly='readonly' name='ENum' value='" . $row['EmployeeContactNumber'] . "'/></td></tr>";

                echo "<tr><td>Email ID:</td><td> <input type='text' readonly name='EEmail' value='" . $row['EmployeeemailID'] . "'/></td></tr>";

                echo "<tr><td>Date of Joining: </td><td><input type='text' readonly='readonly' name='EDOJ' value='" . $row['EmployeeDOJ'] . "'/></td></tr>";
            }

            mysql_close($con);

            echo "</table>";
            ?>





        </form>

    </body>
</html>
