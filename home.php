<?php 

error_reporting(E_ALL & ~E_WARNING);

include 'partials/connect.php';
include 'partials/getuserdetails.php';

$sql = "SELECT * FROM `all-books` WHERE category = 'new_arr'";
$result = mysqli_query($con, $sql);
$new_arrivals = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql = "SELECT * FROM `all-books` WHERE category = 'best_seller'";
$result = mysqli_query($con, $sql);
$best_sellers = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
<link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">
<!-- Owl Carousel-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
</head>   
<body>


<?php include 'partials/header.php'; ?>

<section class="home">
      <div class="banner-img">
        <img src="img/bannerimg3.png" alt="">
    </div>


    <section class="new-arrs media-t">
      <h1 class="text-center mb-3">NEW-ARRIVALS</h1>
    <div class="owl-carousel owl-theme">
          <?php foreach($new_arrivals as $row){ ?>
            <a href="sbook.php?title=<?php echo $row['title']; ?>">
          <div class="item card"><img src="<?php echo $row['img'] ?>" class="img-fluid" alt=""></div>
          </a>
          <?php } ?>
  </div>
  </section>

  <section class="new-arrs">
      <h1 class="text-center mb-3">BEST-SELLERS</h1>
    <div class="owl-carousel owl-theme">
          <?php foreach($best_sellers as $row){ ?>
            <a href="sbook.php?title=<?php echo $row['title']; ?>">
          <div class="item card"><img src="<?php echo $row['img'] ?>" class="img-fluid" alt=""></div>
          </a>
          <?php } ?>
  </div>
  </section>

  <?php include 'partials/footer.php'; ?>
          </section>



<!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Index JS-->
<script src="index.js?v=<?php echo time(); ?>"></script>   
<!-- Owl Carousel-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
  $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      dots:false,
      responsive:{
          0:{
              items:2
          },
          600:{
              items:3
          },
          1000:{
              items:5
          },
          1790:{
              items:4
          }
      }
  })
  </script>
</body>     
</html>