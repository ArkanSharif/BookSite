<?php

error_reporting(E_ALL & ~E_WARNING);

include 'partials/connect.php';
include 'partials/getuserdetails.php';

?>

<html lang="eng">
<head>
<title> BestBooks.com </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<!-- Index CSS-->
<link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">   
</head>   
<body>
<?php include 'partials/header.php'; ?>
<div class="container">
<h1 class="text-center my-5">REVIEW FORM</h1>
<form method="POST">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Rating:</label>
  <div class="rating">
  <i class="fa-solid fa-star text-secondary"></i>
  <i class="fa-solid fa-star text-secondary"></i>
  <i class="fa-solid fa-star text-secondary"></i>
  <i class="fa-solid fa-star text-secondary"></i>
  <i class="fa-solid fa-star text-secondary"></i>
  </div>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Review:</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="7"></textarea>
</div>
</form>
</div>

<!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Index JS-->
<script src="review.js?v=<?php echo time(); ?>"></script>  
</body>
</html>