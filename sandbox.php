<?php 

include 'partials/connect.php';

$alert = '';

if(isset($_POST['profilepicupdate'])){
  $profilepicname = $_POST['profilepicname'];
  $sql = "UPDATE sandbix SET profilepic='$profilepicname' WHERE profilepic='sad'";
  $result = mysqli_query($con, $sql);
  if($result){
      $alert = 'hurrah!';
  }
}

?>

<html lang="eng">
<head>
<title> BestBooks.com </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">  
</head>   
<body>

<form action="" method="POST" enctype="multipart/form-data">

<div class="mb-4">
  <input class="form-control" type="text" name="profilepicname">
</div>
<button type="submit" class="btn btn-primary" name="profilepicupdate">Submit</button>

</form>

<div>
  <?php echo $alert ?>
</div>

</body>
</html>