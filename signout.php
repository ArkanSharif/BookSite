<?php 

session_start();

$_SESSION["signinUsername"] = '';
$_SESSION["signinEmail"] = '';
$_SESSION["signinPassword"] = '';
$_SESSION["signinProfilePic"] = '';

header('location:home.php?alert=<div class="alert alert-warning alert-dismissible fade show"><strong>Signed out successfully!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');


?>