<?php 
error_reporting(E_ALL & ~E_WARNING);
include 'partials/connect.php';

$errors = array('username'=>'', 'email'=>'', 'password'=>'');
$values = array('username'=>'', 'email'=>'', 'password'=>'');

if(isset($_POST['signinsubmit'])){
    $username = $_POST['signinusername'];
    $email = $_POST['signinemail'];
    $password = $_POST['signinpassword'];

    $sql = "SELECT username FROM userHistory WHERE username='$username'";
    $result = mysqli_query($con, $sql);
    if(!$result){
        echo die(mysqli_error($con));
    } else{
        $num = mysqli_num_rows($result);
        if($num === 0){
            $errors['username'] = 'Username not found';
            $values['username'] = $username;
        }
    }

    $sql = "SELECT email FROM userHistory WHERE email='$email'";
    $result = mysqli_query($con, $sql);
    if(!$result){
        echo die(mysqli_error($con));
    } else{
        $num = mysqli_num_rows($result);
        if($num === 0){
            $errors['email'] = 'Email not found';
            $values['email'] = $email;
        }
    }

    $sql = "SELECT password FROM userHistory WHERE password ='$password'";
    $result = mysqli_query($con, $sql);
    if(!$result){
        echo die(mysqli_error($con));
    } else{
        $num = mysqli_num_rows($result);
        if($num === 0){
            $errors['password'] = 'Wrong password';
            $values['password'] = $password;
        }
    }

    $sql = "SELECT username, email, password, profilePic FROM userHistory WHERE username='$username' && email='$email' && password ='$password'";
    $result = mysqli_query($con, $sql);
    if(!$result){
        echo die(mysqli_error($con));
    } else{
        $num = mysqli_num_rows($result);
        if($num > 0){
            $row = mysqli_fetch_assoc($result);
            $profilePic = $row['profilePic'];
            header('location:signin_values_insert_to_sessions.php?username='.$username.'&email='.$email.'&password='.$password.'&profilePic='.$profilePic.'');
        }
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
<!-- Index CSS-->
<link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
</header>
<body>

<?php include 'partials/header.php'; ?>

<div class="container">
    <h1 class="text-center mt-5">SIGN IN FORM</h1>
    <div class="mb-3">
        <form method="POST">
  <input type="text" class="form-control" placeholder="Username" name="signinusername" value="<?php echo $values['username']; ?>">
  <p class="text-danger"><?php echo $errors['username']; ?></p>
</div>
<div class="mb-3">
  <input type="text" class="form-control" placeholder="Email" name="signinemail" value="<?php echo $values['email']; ?>">
  <p class="text-danger"><?php echo $errors['email']; ?></p>
</div>
<div class="mb-3">
  <input type="text" class="form-control" placeholder="Password" name="signinpassword" value="<?php echo $values['password']; ?>">
  <p class="text-danger"><?php echo $errors['password']; ?></p>
</div>
<button type="submit" class="btn btn-primary mt-3 form-control" name="signinsubmit"><span class="d-flex justify-content-start p-0">Submit</span></button>
</form>
</div>

</body>
</html>