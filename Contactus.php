<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?php
session_start();
if (isset($_SESSION["uid"])) {
    include("logout.php");
}
else
    include("index.php");
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Contact Us</title>
    </head>
    <body>
        <div align="center">
            <img align="center" src="images/image7.jpg" width="75px" height="75px"/>


            <b>Our Contact Details:</b>

            <br>        <br>
            Office :

            +1-202-268-5530

            <br>        <br>

            Mobile :+1-982-300-8817

            <br>        <br>

            E-mail :

            info@showmanhouse.com



        </div>
    </body>
</html>
