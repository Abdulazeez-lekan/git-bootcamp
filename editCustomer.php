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
            $sql = "SELECT * FROM  customerDetails WHERE customerID = '" . $q . "'";
            $result = mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
                echo "<table border='0' align='center'>";
                echo "<tr><td><input type='hidden' name='EditcstID' value='" . $row['customerID'] . "'/></td></tr>";
                echo "<tr><td>Name</td><td> <input type='text' name='EditcstName' value='" . $row['customerName'] . "'/></td></tr>";
                echo "<tr><td>Address</td><td> <input type='text' name='EditcstAddress' value='" . $row['customerAddress'] . "'/></td></tr>";
                echo "<tr><td>Contact Number</td><td> <input type='text' name='EditcstNum' value='" . $row['customerContactNumber'] . "'/></td></tr>";
                echo "<tr><td>Email ID </td><td><input type='text' name='EditcstEmail' value='" . $row['customerEmailID'] . "'/></td></tr>";
            }
            echo "<tr><td><input type='submit' value='Update' />&nbsp&nbsp<input type='reset' value='Reset' /></td></td></tr></table><br>";
            echo "<center><a href='EventDetails.php?CID=".$q."'>Continue with booking</a></center>";
            mysql_close($con);
            ?>
        </form>
    </body>
</html>
