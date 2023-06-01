<?php 

error_reporting(E_ALL & ~E_WARNING);

include 'partials/connect.php';
include 'partials/getuserdetails.php';

$headerSearchInput = $_GET['input'];

$sql = "Select * from `all-books`";
$result = mysqli_query($con, $sql);
$all_books = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "Select * from `all-books` limit 8";
$result = mysqli_query($con, $sql);
$pageOne = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "Select * from `all-books` WHERE title = '$headerSearchInput' OR author = '$headerSearchInput'";
$result = mysqli_query($con, $sql);
$headerSearchInputRow = mysqli_fetch_assoc($result);

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
<link rel="stylesheet" href="all-books.css?v=<?php echo time(); ?>">   
</head>   
<body>


<?php include 'partials/header.php'; ?>

<div class="container push-down cards-container-wrapper media-t">
        <div class="my-5 me-4">
           <input type="text" class="form-control search-bar" placeholder="SEARCH BY TITLE OR AUTHOR">
        </div>
        
        <div class="cards-container-hider hide">
        <div class="cards-container">   
        <?php foreach($all_books as $row){ ?>
           <div class="card border-0 transition mb-5 width-card">
           <a href="sbook.php?title=<?php echo $row['title'];?>">
               <img src="<?PHP echo $row['img'] ?>" class="card-img-top">
               <div class="card-body p-0">
                  <h3 class="title mt-2"><?PHP echo $row['title'] ?></h3>
                  <h5 class="author mt-2"><?PHP echo $row['author'] ?></h5>
                  <div class="rating mt-2">
                      <span class="rating-star"><i class="bi bi-star-fill"></i></span>
                      <span class="text-muted">4.46></span>
                  </div>
               </div>
           </a> 
            </div>           
    <?php } ?> 
        </div>
        </div>

        <?php if($headerSearchInput){?>
             <div class="row-genre-hider hide">
             <div class="row-genre">   
             <?php foreach($pageOne as $row){ ?>
                <div class="card border-0 transition mb-5 width-card">
                <a href="sbook.php?title=<?php echo $row['title'];?>">
                    <img src="<?PHP echo $row['img'] ?>" class="card-img-top">
                    <div class="card-body p-0">
                       <h3 class="title mt-2"><?PHP echo $row['title'] ?></h3>
                       <h5 class="author mt-2"><?PHP echo $row['author'] ?></h5>
                       <div class="rating mt-2">
                           <span class="rating-star"><i class="bi bi-star-fill"></i></span>
                           <span class="text-muted">4.46</span>
                       </div>
                    </div>
                </a> 
                 </div>           
         <?php } ?> 
             </div>
             </div>
       <?php }else{?> 
        <div class="row-genre-hider">
        <div class="row-genre">   
        <?php foreach($pageOne as $row){ ?>
           <div class="card border-0 transition mb-5 width-card">
           <a href="sbook.php?title=<?php echo $row['title'];?>">
               <img src="<?PHP echo $row['img'] ?>" class="card-img-top">
               <div class="card-body p-0">
                  <h3 class="title mt-2"><?PHP echo $row['title'] ?></h3>
                  <h5 class="author mt-2"><?PHP echo $row['author'] ?></h5>
                  <div class="rating mt-2">
                      <span class="rating-star"><i class="bi bi-star-fill"></i></span>
                      <span class="text-muted">4.46</span>
                  </div>
               </div>
           </a> 
            </div>           
    <?php } ?> 
        </div>
        </div>
        <?php } ?>
        
        <?php if($headerSearchInput){
        echo '<div class="headers-search-input">
        <div class="card border-0 transition mb-5 width-card">
           <a href="sbook.php?title='.$headerSearchInputRow["title"].'">
               <img src="'.$headerSearchInputRow["img"].'" class="card-img-top">
               <div class="card-body p-0">
                  <h3 class="title mt-2">'.$headerSearchInputRow["title"].'</h3>
                  <h5 class="author mt-2">'.$headerSearchInputRow["author"].'</h5>
                  <div class="rating mt-2">
                      <span class="rating-star"><i class="bi bi-star-fill"></i></span>
                      <span class="text-muted">4.46</span>
                  </div>
               </div>
           </a> 
            </div>    
        </div>';
        }else{
            echo '<div class="headers-search-input"></div>';
        }?>
     
     <?php if($headerSearchInput){?> 
        <nav aria-label="...">
  <ul class="pagination pagination-lg justify-content-center hide">
  </ul>
</nav>
</div>        
<?php }else{ ?>
    <nav aria-label="...">
  <ul class="pagination pagination-lg justify-content-center">
  </ul>
</nav>
</div>      
    <?php } ?>

    <?php include 'partials/footer.php'; ?>



<!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Index JS-->
<script src="all-books.js?v=<?php echo time(); ?>"></script> 
</body>     
</html>