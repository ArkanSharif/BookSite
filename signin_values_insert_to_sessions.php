<?php

session_start();

$username = $_GET['username'];
$email = $_GET['email'];
$password = $_GET['password'];
$profilePic = $_GET['profilePic'];

echo $profilePic;

$_SESSION["signinUsername"] = $username;
$_SESSION["signinEmail"] = $email;
$_SESSION["signinPassword"] = $password;
$_SESSION["signinProfilePic"] = $profilePic;

header('location:home.php');


?>