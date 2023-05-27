<?php 

include 'partials/connect.php';


$alert = $_GET['alert'];
$headerSearchValue = '';

// Sign Up

if(isset($_POST['signupSubmit'])){
  $username = $_POST['signupUsername'];
  $email = $_POST['signupEmail'];
  $password = $_POST['signupPassword'];
  $profilepic_uploaded_file = $_FILES['signupProfilePic']['tmp_name'];
  $profilepic_destination_path = 'img/' . $_FILES['signupProfilePic']['name'];
  if(move_uploaded_file($profilepic_uploaded_file, $profilepic_destination_path)){
    echo 'file uploaded successfully';
    $sql = "INSERT INTO userhistory (username, email, password, profilePic, hasUserDetails) VALUES ('$username', '$email', '$password', '$profilepic_destination_path', 'true')";
    $result = mysqli_query($con, $sql);
    if($result){
      header('location:signin.php');
    }
  }
}

// Update account

if(isset($_POST['updatesubmitusername'])){
  $updateusername = $_POST['updateusername'];
  $sql = "UPDATE userhistory SET username='$updateusername' WHERE username='$username'";
  $result = mysqli_query($con, $sql);
  if($result){ 
    header('location:updateusername.php?updateusername='.$updateusername.'');
  }
}

if(isset($_POST['updatesubmitemail'])){
  $updateemail = $_POST['updateemail'];
  $sql = "UPDATE userhistory SET email='$updateemail' WHERE username='$username'";
  $result = mysqli_query($con, $sql);
  if($result){   
    header('location:updatevoid.php');
  }
}

if(isset($_POST['updatesubmitpassword'])){
  $updatepassword = $_POST['updatepassword'];
  $sql = "UPDATE userhistory SET password='$updatepassword' WHERE username='$username'";
  $result = mysqli_query($con, $sql);
  if($result){
    header('location:updatevoid.php');
  }
}

if(isset($_POST['updatesubmitprofilepic'])){
  $updateprofilepic_uploaded_file = $_FILES['updateprofilepic']['tmp_name'];
  $updateprofilepic_destination_path = 'img/' . $_FILES['updateprofilepic']['name'];
  echo $updateprofilepic_destination_path;
  if(move_uploaded_file($updateprofilepic_uploaded_file, $updateprofilepic_destination_path)){
    $sql = "UPDATE userhistory SET profilePic='$updateprofilepic_destination_path' WHERE username='$username'";
    $result = mysqli_query($con, $sql);
    if($result){
      header('location:updatevoid.php');
    }
  }
}

// sbook code to add liveRating -------------------------------------------------

$titleSbook = $_SESSION["titleSbook"];

$zero = 0;
$liveRating = $_COOKIE['liveRatingId'];

$email = $userProfile['email'];
$password = $userProfile['password'];
$profilePic = $userProfile['profilePic'];

$sql = "SELECT * FROM userhistory WHERE username = '$username' AND liveRatingTitle = '$titleSbook'";
$result = mysqli_query($con, $sql);
$checkLiveRating = mysqli_num_rows($result);

if($liveRating){
  if($checkLiveRating > 0){ 
    $sql = "UPDATE userhistory SET liveRating = '$liveRating' WHERE username = '$username' AND liveRatingTitle = '$titleSbook'";
    $result = mysqli_query($con, $sql);
    setcookie('liveRatingId', $zero);
  } else{
$sql = "INSERT INTO userhistory (username, email, password, profilePic, liveRating, liveRatingTitle) VALUES ('$username', '$email', '$password', '$profilePic', '$liveRating', '$titleSbook')";
$result = mysqli_query($con, $sql);
setcookie('liveRatingId', $zero);
} 
}

/* Nav Search Bar PHP CODE */

if(isset($_POST['navSearchBarSubmit'])){
  $input = $_POST['searchBarInput'];
  $sql = "SELECT * FROM `all-books` WHERE title = '$input' OR author = '$input'";
  $result = mysqli_query($con, $sql);
  $num = mysqli_num_rows($result);
  if($num > 0){
    header('location:all-books.php?input='.$input.'');
  }else{
    $headerSearchValue = $input;
    $alert = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>No match found!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
}

  /* get Purchases */
 
  $sql = "SELECT * FROM userhistory WHERE ordered = 'true'";
  $result = mysqli_query($con, $sql);
  $purchases = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

          <!-- Nav Bar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark relative">
        <div class="container-fluid">
          <a class="navbar-brand fs-3 ms-2" href="home.php">bestbooks.com</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav me-2">
              <li class="nav-item">
                <a class="nav-link" href="home.php">HOME</a>
              </li>
                <?php if($username){
                echo '<li class="nav-item"><a class="nav-link" href="shelf.php">SHELF</a></li>';
                }else{
                  echo '<li class="nav-item help"><a class="nav-link"">SHELF</a></li>';   
                }
                ?>
              <li class="nav-item">
                <a class="nav-link" href="all-books.php">ALL BOOKS</a>
              </li>

              <!-- nav search bar -->

              <form class="d-flex" method="POST">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchBarInput" value=<?php echo $headerSearchValue; ?>>
                <button class="btn btn-secondary" type="submit" name="navSearchBarSubmit">Search</button>
              </form>

              <!-- echo submit button if no user details exist -->
              <?php if(!$username){
              echo '<li class="nav-item ms-3">
                <button class="btn btn-danger p-2 signupin" type="submit">SIGN UP/IN</button>
              </li>';
              }?>
              <!-- end -->
            </ul>
            <!-- echo profile pic if user details exist -->
            <?php if($username){?>
            <div class="img-wrapper-profile-pic">
            <a class="p-0 bg-dark border border-dark" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <img src="<?php echo $userProfile['profilePic'] ?>" alt="">
            </a> 
              </div>';
            <?php } ?>
            <!-- end -->
          </div>
        </div>
      </nav>
      <?php echo $alert ?>
            
      <!-- offcanvas bootstrap code -->

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header relative">
    <div class="author-dets-container mt-5">
  <div class="img-wrapper-profile-pic-toggle-on">
  <img src="<?php echo $userProfile['profilePic'] ?>">
  </div>
    <div class="profile-det text-center">
      <p class="text-muted mb-0"><?php echo $userProfile['username'] ?></p>
      <p class="text-muted mt-0"><?php echo $userProfile['email'] ?></p>
    </div>
</div>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <!-- offcanvas body -->
  <div class="offcanvas-body">
  <div class="accordion accordion-flush" id="accordionFlushExample">

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Account details
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <div>
          <?php 
          echo '<p >Username: '.$userProfile['username'].'</p>
          <p >Email: '.$userProfile['email'].'</p>
          <p >Password: '.$userProfile['password'].'</p>
          <p >Profile pic: '.$userProfile['profilePic'].'</p>';
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Update settings -->
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
       Update account
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">

      <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseUsername" aria-expanded="false" aria-controls="flush-collapseThree">
        Username
      </button>
    </h2>
    <div id="flush-collapseUsername" class="accordion-collapse collapse" aria-labelledby="flush-headingThree">
      <div class="accordion-body">
       <form action="" method="POST">
  <input class="form-control" type="text" name="updateusername" placeholder="username">
<button type="submit" class="btn btn-primary" name="updatesubmitusername">Submit</button>
       </form>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEmail" aria-expanded="false" aria-controls="flush-collapseThree">
        Email
      </button>
    </h2>
    <div id="flush-collapseEmail" class="accordion-collapse collapse" aria-labelledby="flush-headingThree">
      <div class="accordion-body">
      <form action="" method="POST">
  <input class="form-control" type="text" name="updateemail" placeholder="email">
<button type="submit" class="btn btn-primary" name="updatesubmitemail">Submit</button>
       </form>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsePassword" aria-expanded="false" aria-controls="flush-collapseThree">
        Password
      </button>
    </h2>
    <div id="flush-collapsePassword" class="accordion-collapse collapse" aria-labelledby="flush-headingThree">
      <div class="accordion-body">
      <form action="" method="POST">
  <input class="form-control" type="text" name="updatepassword" placeholder="password">
<button type="submit" class="btn btn-primary" name="updatesubmitpassword">Submit</button>
       </form>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseProfilePic" aria-expanded="false" aria-controls="flush-collapseThree">
        Profile pic
      </button>
    </h2>
    <div id="flush-collapseProfilePic" class="accordion-collapse collapse" aria-labelledby="flush-headingThree">
      <div class="accordion-body">
      <form method="POST" enctype="multipart/form-data">
      <label for="formFile" class="form-label"></label>
      <input class="form-control" type="file" id="formFile" name="updateprofilepic">
<button type="submit" class="btn btn-primary" name="updatesubmitprofilepic">Submit</button>
       </form>
      </div>
    </div>
  </div>

 
        
      </div>
    </div>
  </div>
</div>

 <!-- purchase details -->

<div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Books purchased
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <div>
          <?php 
          foreach($purchases as $value){
            echo '<p>Purchased '.$value['quantity'].' '.$value['bookPurchased'].' on '.$value['date'].'</p>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>

<div class="border-top">
  <p class="mt-2 ms-4"><a href="signout.php">Sign out<a></p>
            </div>

  </div>
  
  
</div>

<!-- End of code -->

      <!-- SIGN UP FORM -->

      <div class="overlay hide">
        <form action="" method="POST" enctype="multipart/form-data">
      <div class="sign-up-form">
        <div class="img-wrapper">
          <img src="img/footer-img.jpg" alt="">
        </div>
        <div class="form-content">
          <h1 class="text-center text-dark">Sign Up Form</h1>
          <div class="form container">
          <form>
          <div class="mb-4 mt-4">
    <input type="text" class="form-control" placeholder="Username" name="signupUsername">
  </div>
  <div class="mb-4">
    <input type="email" class="form-control" placeholder="Email" name="signupEmail">
  </div>
  <div class="mb-4">
    <input type="text" class="form-control" placeholder="Password" name="signupPassword">
  </div>
  <div class="mb-4">
  <label for="formFile" class="form-label">Choose an image for profile pic</label>
  <input class="form-control" type="file" id="formFile" name="signupProfilePic">
</div>
  <button type="submit" class="btn btn-primary" name="signupSubmit">Submit</button>
  <h4 class="text-center">OR</h4>
  <div class="mb-4">
  <div class="text-center"><a class="text-dark" href="signin.php">If you have an account click here to sign in</a></div>
</div>
</form>
          </div>
        </div>

      </div>
</form>
      </div>

      <!-- sign-in-alert -->
      <div class="sign-in-alert-overlay hide">
        <div class="sign-in-alert-container">
          <h1>YOU HAVE TO BE SIGNED IN FIRST</h1>
          <p><a class="text-dark" href="signin.php">Click here to sign in</a></p>
        </div>
            </div>


      <script src="header.js?v=<?php echo time(); ?>">

</script>
<script>
  document.querySelector('.help').addEventListener('click', (e)=>{
    console.log('hiii');
    document.querySelector('.sign-in-alert-overlay').classList.remove('hide');
});

document.querySelector('.sign-in-alert-overlay').addEventListener('click', (e)=>{
    var closeByClickingOverlay = e.target.className;
    if(closeByClickingOverlay === 'sign-in-alert-overlay'){
        document.querySelector('.sign-in-alert-overlay').classList.add('hide');
    }
})
</script>

      