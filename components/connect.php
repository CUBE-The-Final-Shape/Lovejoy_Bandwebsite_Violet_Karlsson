<?php
$connection = mysqli_connect('localhost', 'root', '', 'lovejoy_customer_info');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'lovejoy_customer_info');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
