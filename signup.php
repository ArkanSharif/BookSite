<?php

error_reporting(E_ALL & ~E_WARNING);
include 'partials/connect.php';
include 'partials/getuserdetails.php';

$errorsSignUp = array('username'=>'', 'email'=>'', 'password'=>'', 'profilePic'=>'');
$valuesSignUp = array('username'=>'', 'email'=>'', 'password'=>'', 'profilePic'=>'');

if(isset($_POST['signupSubmit'])){
    $username = $_POST['signupUsername'];
    $email = $_POST['signupEmail'];
    $password = $_POST['signupPassword'];
    $profilepic_uploaded_file = $_FILES['signupProfilePic']['tmp_name'];
    $profilepic_destination_path = 'img/' . $_FILES['signupProfilePic']['name'];
    
    if($username === ''){
      $errorsSignUp['username'] = 'Username is required';
      $valuesSignUp['username'] = $username;  
    } else{
      $sql = "SELECT username FROM userhistory WHERE username = '$username' AND hasUserDetails = 'true'";
      $result = mysqli_query($con, $sql);
      if(!$result){
        echo die(mysqli_error($con));
    } else{
        $num = mysqli_num_rows($result);
        if($num > 0){
            $errorsSignUp['username'] = 'Username already taken';
            $valuesSignUp['username'] = $username;
            $username = '';
        }else{
          $valuesSignUp['username'] = $username;
        }
    }
    }
  
    if($email === ''){
      $errorsSignUp['email'] = 'Email is required';
      $valuesSignUp['email'] = $email;  
    } else{
      $sql = "SELECT email FROM userhistory WHERE email ='$email' AND hasUserDetails = 'true'";
      $result = mysqli_query($con, $sql);
      if(!$result){
        echo die(mysqli_error($con));
    } else{
        $num = mysqli_num_rows($result);
        if($num > 0){
            $errorsSignUp['email'] = 'Email already taken';
            $valuesSignUp['email'] = $email;
        } else{
          $valuesSignUp['email'] = $email;
        }
    }
    }
    
    if($password === ''){
      $errorsSignUp['password'] = 'Password is required';
      $valuesSignUp['password'] = $password;  
    } else{
      $valuesSignUp['password'] = $password; 
    }
  
    if($profilepic_uploaded_file === ''){
      $errorsSignUp['profilePic'] = 'Profile pic is required';
      $valuesSignUp['profilePic'] = $profilepic_destination_path;  
    } else{
      $valuesSignUp['profilePic'] = $profilepic_destination_path;
    }
    
    if($errorsSignUp['username'] === '' && $errorsSignUp['email'] === '' && $errorsSignUp['password'] === '' && $errorsSignUp['profilePic'] === ''){
    $sql = "INSERT INTO userhistory (username, email, password, profilePic, hasUserDetails) VALUES ('$username', '$email', '$password', '$profilepic_destination_path', 'true')";
    $result = mysqli_query($con, $sql);
    if($result){
      header('location:signin.php');
    }
  } else{
    $username = '';
  }
  }
  echo $username;

?>


<html lang="eng">
<head>
<title> BestBooks.com </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootsrap 5 icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Index CSS-->
<link rel="stylesheet" href="signup.css?v=<?php echo time(); ?>">
</header>
<body>

<?php include 'partials/header.php'; ?>
<div class="container media-t">
    <h1 class="text-center mt-5">SIGN UP FORM</h1>
    <div class="mb-3">
        <form method="POST" enctype="multipart/form-data">
        <div class="mb-4 mt-4">
    <input type="text" class="form-control" placeholder="Username" name="signupUsername" value="<?php echo $valuesSignUp['username']; ?>">
    <p class="text-danger"><?php echo $errorsSignUp['username']; ?></p>
  </div>
  <div class="mb-4">
    <input type="email" class="form-control" placeholder="Email" name="signupEmail" value="<?php echo $valuesSignUp['email']; ?>">
    <p class="text-danger"><?php echo $errorsSignUp['email']; ?></p>
  </div>
  <div class="mb-4">
    <input type="text" class="form-control" placeholder="Password" name="signupPassword" value="<?php echo $valuesSignUp['password']; ?>">
    <p class="text-danger"><?php echo $errorsSignUp['password']; ?></p>
  </div>
  <div class="mb-4">
  <label for="formFile" class="form-label">Choose an image for profile pic</label>
  <input class="form-control" type="file" id="formFile" name="signupProfilePic" value="<?php echo $valuesSignUp['profilePic']; ?>">
  <p class="text-danger"><?php echo $errorsSignUp['profilePic']; ?></p>
</div>
<button type="submit" class="btn btn-primary mt-2 form-control" name="signupSubmit"><span class="d-flex justify-content-start p-0">Submit</span></button>
</form>
<h1 class="text-center my-2">OR</h1>
<p class="text-center"><a class="text-dark" href="signin.php">Already have an account, click here to sign in</a></p>
</div>
</div>
<?php include 'partials/footer.php'; ?>
<!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>