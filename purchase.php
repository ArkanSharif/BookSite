<?php 
error_reporting(E_ALL & ~E_WARNING);
include 'partials/connect.php';
include 'partials/getuserdetails.php';

if(isset($_POST['purchaseSubmit'])){
    $username = $userProfile['username']; 
    $email = $userProfile ['email'];
    $password = $userProfile['password'];
    $profilePic = $userProfile['profilePic'];  
    $address = $_POST['purchaseAddress'];
    $quantity = $_POST['purchaseQuantity'];
    $bookPurchased = $_GET['title'];

    $sql = "INSERT INTO userhistory (username, email, password, profilePic, address, quantity, bookPurchased, ordered)
    VALUES ('$username', '$email', '$password', '$profilePic', '$address', $quantity, '$bookPurchased', 'true')";
    $result = mysqli_query($con, $sql); 
    header('location:home.php?alert=<div class="alert alert-warning alert-dismissible fade show"><strong>Purchase successful!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');      
  }

?>

<html lang="eng">
<head>
<title> BestBooks.com </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Index CSS-->
<link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
</header>
<body>

<?php include 'partials/header.php'; ?>

<div class="container">
    <h1 class="text-center mt-5">PLACE YOUR ORDER</h1>
    <form method="POST">
<div class="mb-3">
  <input type="text" class="form-control" placeholder="Address" name="purchaseAddress">
</div>
<div class="mb-3">
  <input type="number" class="form-control" placeholder="Quantity" name="purchaseQuantity">
</div>
<button type="submit" class="btn btn-primary mt-3 form-control" name="purchaseSubmit"><span class="d-flex justify-content-start p-0">Submit</span></button>
</form>
</div>

</body>
</html>