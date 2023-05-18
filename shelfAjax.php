<?php 

include 'partials/connect.php';
include 'partials/getuserdetails.php';

$limit = $_GET['limit'];

$sql = "SELECT * FROM userhistory WHERE username = '$username' AND shelvedBook = 'true' LIMIT $limit";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?PHP foreach($row as $value){ ?>
        <div class="card border-0 mt-5" style="width: 15rem;">
  <img src="<?PHP echo $value['bookImg'] ?>" class="card-img-top" alt="...">
  <div class="card-body p-0">
                      <h3 class="title mt-2"><?PHP echo $value['title'] ?></h3>
                      <h5 class="author mt-2"><?PHP echo $value['author'] ?></h5>
                      <div class="rating mt-2">**
                          <span class="rating-star"><i class="bi bi-star-fill"></i></span>
                          <span class="text-muted">4.47</span>
                      </div>
                      <a class="remove-book">Remove</a>
                   </div>
                   </div>
                   <?php } ?> 

                 