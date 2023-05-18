<?php

include 'partials/connect.php';
include 'partials/getuserdetails.php';

$title = $_GET['title'];

$sql = "DELETE FROM userhistory WHERE username = '$username' AND title = '$title'";
$result = mysqli_query($con, $sql);

?>