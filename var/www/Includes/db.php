<?php

$servername = "localhost";
$username = "padmin";
$password = "admin";

$connection = mysqli_connect($servername, $username, $password,'cms');

if($connection){

    //echo "<script>alert('connection succesfully')</script>";
}
else{
    echo "<script>alert('connection failed')</script>";
}