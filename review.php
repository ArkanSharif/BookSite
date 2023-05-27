<?php

include 'partials/connect.php';
include 'partials/getuserdetails.php';

 $title = $_GET['title'];

if(isset($_POST['submitRev'])){
  $rating = $_COOKIE['ratingid'];
  $email = $userProfile['email'];
  $password = $userProfile['password'];
  $profilePic = $userProfile['profilePic'];
  $contentRev = $_POST['contentRev'];
  $sql = "INSERT INTO userhistory (username, email, password, profilePic, revRating, review, reviewedBook) VALUES ('$username', '$email', '$password', '$profilePic', '$rating', '$contentRev', '$title')";
  $result = mysqli_query($con, $sql);
  if($result){
    header('location:home.php');
  }
}

?>

<html lang="eng">
<head>
<title> BestBooks.com </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootsrap 5 icons-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<!-- Index CSS-->
<link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">   
</head>   
<style>
  .rev-star{
    color:grey;
  }

  .orange{
    color: orange;
  }

  .yellow{
    color: yellow;
  }

</style>
<body>
<?php include 'partials/header.php'; ?>
<div class="container">
<h1 class="text-center my-5">REVIEW FORM</h1>
<form method="POST">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Rating:</label>
  <div class="rating">
  <i class="fa-solid fa-star rev-star" data-id="1"></i>
  <i class="fa-solid fa-star rev-star" data-id="2"></i>
  <i class="fa-solid fa-star rev-star" data-id="3"></i>
  <i class="fa-solid fa-star rev-star" data-id="4"></i>
  <i class="fa-solid fa-star rev-star" data-id="5"></i>
  </div>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Review:</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" name="contentRev"></textarea>
</div>
<button type="submit" class="btn btn-primary" name="submitRev">Submit</button>
</form>
</div>

<!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Ajax Lib -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- Index JS-->
<script>
 
    $(document).on('mouseover', '.rev-star', function(e) {
        var id = e.currentTarget.dataset.id;
        for(var i = 0; i < id; i++){
          document.querySelectorAll('.rev-star')[i].classList.add('yellow');
        };
      });

      $(document).on('mouseout', '.rev-star', function(e) {
        for(var i = 0; i < 5; i++){
          document.querySelectorAll('.rev-star')[i].classList.remove('yellow');
        };
      });

      $(document).on('click', '.rev-star', function(e) {
        var ratingId = e.currentTarget.dataset.id;
        document.cookie = "ratingid = " + ratingId;
        var xhttp = new XMLHttpRequest();
        var ratingId = e.currentTarget.dataset.id;
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.querySelector(".rating").innerHTML = this.responseText;
        }
      };
        xhttp.open("GET", `setRevRating.php?rating=${ratingId}`, true);
        xhttp.send();
    });

</script>    
</body>
</html>