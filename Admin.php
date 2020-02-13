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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Administrator</title>
    </head>
    <body>

    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Administrator</title>
        </head>
        <body>
            <br>    <br>
            <div align="center">

                <a href="ViewEmployees.php">View Details of Employees</a><br><br>
                <a href="Customer.php">View Details of Customers</a><br><br>
                <a href="EditEvent.php">View Details of Events</a><br><br>
                <a href="AddEmployee.php">Add Employee</a><br><br>
                <a href="AddLocation.php">Add Location</a>

            </div>
        </body>
    </html>
