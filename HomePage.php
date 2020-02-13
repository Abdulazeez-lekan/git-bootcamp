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
        <title></title>
    </head>
    <body>
        <div align="center">
            <br><br>
            <marquee>At ShowmanHouse, we deliver a portfolio of exceptional services.</marquee>
            <br/><br/><br/><br/>
            <i style="color:red; font-size: 50px"> Entrust us with your events</i><br/><br/>
            The aim of <b>ShowmanHouse</b> is to deliver the best to our people and community.<br><br>
                        We manage venues, catering, decoration, welcome groups, and lighting. Some of the events in which we specialized are:
            <br/><br/>
            <center>
                <ul>
                    <li style="position:absolute;left:800px;top:450px;"><b style="color:blue">Anniversary</b></li>
                    <li style="position:absolute;left:800px;top:470px;"><b style="color:blue">Birthdays</b></li>
                    <li style="position:absolute;left:800px;top:490px;"><b style="color:blue">Product Launch</b></li>
                    <li style="position:absolute;left:800px;top:510px;"><b style="color:blue">Dealers Meet</b></li>
                     <li style="position:absolute;left:800px;top:530px;"><b style="color:blue">Exhibitions</b></li>
                    <li style="position:absolute;left:800px;top:550px;"><b style="color:blue">Annual Functions</b></li>
                    <li style="position:absolute;left:800px;top:570px;"><b style="color:blue">Road Shows</b></li>

                </ul>
            </center>



            <br/><br/><br/><br/><br/><br/><br/><br/>

            <b style="color:red"> Media Coverage</b> <br/><br/>
            We gives press coverage since we have a good and decent business relation with almost all the news channels and leading newspapers.






        </div>





    </body>
</html>
