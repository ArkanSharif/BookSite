<?php 

session_start();

$username = $_SESSION["signinUsername"];

$sql = "SELECT * FROM `userhistory` WHERE username = '$username'";
$result = mysqli_query($con, $sql);
$userProfile = mysqli_fetch_assoc($result);


?>