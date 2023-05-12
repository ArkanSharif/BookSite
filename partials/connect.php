<?php

$con = mysqli_connect('localhost', 'sad', '1234', 'bestbooks');

if(!$con){
    die(mysqli_error($con));
} 

?>