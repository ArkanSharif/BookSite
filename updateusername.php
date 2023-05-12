<?php

include 'partials/connect.php';

session_start();

$updateusername = $_GET['updateusername'];

$_SESSION["signinUsername"] = $updateusername;

header('location:home.php');

?>