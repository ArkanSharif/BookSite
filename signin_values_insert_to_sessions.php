<?php

session_start();

$username = $_GET['username'];
$email = $_GET['email'];
$password = $_GET['password'];
$profilePic = $_GET['profilePic'];

$_SESSION["signinUsername"] = $username;
$_SESSION["signinEmail"] = $email;
$_SESSION["signinPassword"] = $password;
$_SESSION["signinProfilePic"] = $profilePic;

header('location:home.php?alert=<div class="alert alert-warning alert-dismissible fade show"><strong>Signed in successfuly!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


?>