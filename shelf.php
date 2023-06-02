<?php

error_reporting(E_ALL & ~E_WARNING);

include 'partials/connect.php';
include 'partials/getuserdetails.php';

// CODE TO GET BOOKS FROM DATABASE

$email = $userProfile['email'];
$password = $userProfile['password'];
$profilePic = $userProfile['profilePic'];
$title = $_GET['title'];
$author = $_GET['author'];
$bookImg = $_GET['bookImg'];

$sql = "SELECT * FROM `userhistory` WHERE username = '$username' AND title = '$title'";
$result = mysqli_query($con, $sql);
$num = mysqli_num_rows($result);
if($num === 0){
    $sql = "INSERT INTO userhistory (username, email, password, profilePic, bookImg, title, author, shelvedBook)
    VALUES ('$username', '$email', '$password', '$profilePic', '$bookImg', '$title', '$author', 'true')";
    $result = mysqli_query($con, $sql);
} 

$initialLimit = 4;
$i = 0;

$sql = "SELECT * FROM `userhistory` WHERE username = '$username' AND shelvedBook = 'true'";
$result = mysqli_query($con, $sql);
if($result){
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $rowcount=mysqli_num_rows($result);
} 

// Gets all rows with shelvedBook = 'true'

$sql = "SELECT * FROM `userhistory` WHERE username = '$username' AND shelvedBook = 'true'";
$result = mysqli_query($con, $sql);
$maxRows = mysqli_num_rows($result);

?>

<html lang="eng">
<head>
    <title> PHP OOP TUT </title>
</head>   
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootsrap 5 icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Index CSS -->
<link rel="stylesheet" href="shelf.css?v=<?php echo time(); ?>">
<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

<body>

<?php include 'partials/header.php'; ?>

<div class="container row-shelf-wrapper media-t">
    <?php if($rowcount > 0){
    echo '<h1 class="text-center my-3 display-1">YOUR SHELF</h1>';
    } else{
        echo '<h1 class="text-center my-3 display-1">NOTHING ON THE SHELF</h1>';
    }
    ?>
    <div class="row-shelf">

    <!--- Books posted here --> 

    <?PHP foreach($row as $value){ 
        if($initialLimit > $i ){
        echo '<div class="card border-0 shelf-book mt-5" style="width: 15rem;">
  <img src="'.$value['bookImg'].'" class="card-img-top" alt="...">
  <div class="card-body p-0">
                      <h3 class="title mt-2">'.$value['title'].'</h3>
                      <h5 class="author mt-2">'.$value['author'].'</h5>
                      <div class="rating mt-2">**
                          <span class="rating-star"><i class="bi bi-star-fill"></i></span>
                          <span class="text-muted">4.47</span>
                      </div>
                      <a class="remove-book" data-title="'.$value['title'].'">Remove</a>
                   </div>
                   </div>';
        }else{
            echo '<div class="card border-0 hide shelf-book mt-5" style="width: 15rem;">
            <img src="'.$value['bookImg'].'" class="card-img-top" alt="...">
            <div class="card-body p-0">
                                <h3 class="title mt-2">'.$value['title'].'</h3>
                                <h5 class="author mt-2">'.$value['author'].'</h5>
                                <div class="rating mt-2">**
                                    <span class="rating-star"><i class="bi bi-star-fill"></i></span>
                                    <span class="text-muted">4.47</span>
                                </div>
                                <a class="remove-book" data-title="'.$value['title'].'">Remove</a>
                             </div>
                             </div>';
        }
        ++$i;
                   } ?>

                   <!-- END OF CODE -->

</div>
<?php if($rowcount > 0){
    if($rowcount > 4){
echo '<button type="button" class="btn btn-primary view-more mt-5">View more</button>';
    } else{
        echo '';
    }
} else{
    echo '';
}
?>
<div class="vent"></div>
    </div>
</div>
<?php include 'partials/footer.php'; ?>

<!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Shelf JS-->
<script src="shelf.js?v=<?php echo time(); ?>"></script> 
<script>

//FOR REMOVE BOOK

document.querySelectorAll('.remove-book').forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
       const btn = e.currentTarget;
       const title = btn.dataset.title;
       btn.parentElement.parentElement.style.display = 'none';
       console.log(btn.parentElement.parentElement);
       var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
             document.querySelector(".vent").innerHTML = this.responseText;
                       }
           };
        xhttp.open("GET", `delBookAJAX.php?title=${title}`, true);
        xhttp.send();
    })
})

// FOR VIEW-MORE

    var limit = 4;
document.querySelector('.view-more').addEventListener('click', ()=>{
    var maxRows = <?php echo $maxRows ?> ;
    limit += 4;
    for(var i = 0; i < limit; i++){
        if(maxRows <= limit){
            document.querySelector(".view-more").style.display = 'none';
        }
        document.querySelectorAll('.shelf-book')[i].classList.remove('hide');
    }
        
        
        
        
       
})
</script>  
</body>     
</html>