<?php 

session_start();

$_SESSION["signinUsername"] = '';

header('location:home.php');


?>