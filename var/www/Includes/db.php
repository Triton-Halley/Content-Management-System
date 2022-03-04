<?php
$servername = "127.0.0.1:8111";
$username = "root";
$password = "";

$connection = mysqli_connect($servername, $username, $password,'cms');

if(!$connection){
    die("Failed :  {$connection->error}");
    //echo "<script>alert('connection succesfully')</script>";
}
else{
    //echo $connection ->error;
    //echo "<script>alert('connection failed')</script>";
}
