<?php

include 'partials/connect.php';

session_start();

$updateusername = $_GET['updateusername'];

$_SESSION["signinUsername"] = $updateusername;

header('location:home.php?alert=<div class="alert alert-warning alert-dismissible fade show"><strong>Updated successfully!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

?>