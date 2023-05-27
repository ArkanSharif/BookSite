<?php 

error_reporting(E_ALL & ~E_WARNING);

include 'partials/connect.php';

$limit = $_GET['limit'];
$offset = $_GET['offset'];

$sql = "Select * from `all-books` limit $limit offset $offset";
$result = mysqli_query($con, $sql);
$page = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<?php foreach($page as $row){ ?>
           <div class="card border-0 transition mb-5" style="width: 18rem;">
           <a>
               <img src="<?PHP echo $row['img'] ?>" class="card-img-top">
               <div class="card-body p-0">
                  <h3 class="title mt-2"><?PHP echo $row['title'] ?></h3>
                  <h5 class="author mt-2"><?PHP echo $row['author'] ?></h5>
                  <div class="rating mt-2">
                      <span class="rating-star"><i class="bi bi-star-fill"></i></span>
                      <span class="text-muted"><?PHP echo $row['rating'] ?></span>
                  </div>
               </div>
           </a> 
            </div>           
    <?php } ?> 