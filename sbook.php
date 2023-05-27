<?php
error_reporting(E_ALL & ~E_WARNING);

include 'partials/connect.php';
include 'partials/getuserdetails.php';

$_SESSION["titleSbook"] = $_GET['title'];
$title = $_GET['title'];

$sql = "SELECT * FROM `all-books` WHERE title = '$title'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

?>


<html lang="eng">
<head>
    <title> PHP OOP TUT </title>
</head>   
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Index CSS -->
<link rel="stylesheet" href="sbook.css?v=<?php echo time(); ?>">
<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<!-- Owl Carousel-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 

<body>

<?php include 'partials/header.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-4 relative">
                <div class="fixed">
                <div class="card border-0" style="width: 18rem;">
                    <img src="<?php echo $row['img']?>" class="card-img-top" alt="...">
                    <div class="d-grid gap-2">

                      <!-- Already shelved code -->

                      <?php 
                      if($username){
                        $sql = "SELECT * FROM `userhistory` WHERE username = '$username' AND title = '$title'";
                        $result = mysqli_query($con, $sql);
                        $num = mysqli_num_rows($result);
                         if($num === 0){
                          echo '<button class="btn btn-primary rounded-pill fw-bold mt-3" type="button"><a href="shelf.php?title='.$row['title'].'&author='.$row['author'].'&bookImg='.$row['img'].'" class="text-light full-width">Add to shelf</a></button>';
                          }else{
                            echo '<button class="btn btn-primary rounded-pill fw-bold mt-3"  type="button">Already shelved</button>';
                          }
                      }else{
                        echo '<button class="btn btn-primary rounded-pill fw-bold mt-3 sign-in-alert" type="button">Add to shelf</button>';
                      }
                      ?>
                        <!-- end of code -->
                      <?php 
                       if($username){ 
                        echo '<button class="btn btn-danger rounded-pill fw-bold mt-3" type="button"><a href="purchase.php?title='.$title.'">Purchase $19.99</a></button>';
                       }
                        else{
                          echo '<button class="btn btn-danger rounded-pill fw-bold mt-3 sign-in-alert" type="button">Purchase $19.99</button>';
                        }
                        ?>
                    </div>    
                  </div>
                  <div class="live-rating mt-3">

    <!--------------- LIVERATING CODE ------------------------------>

                    <?php 
                    if($username){
                      $sql = "SELECT * FROM userhistory WHERE username = '$username' AND liveRatingTitle = '$title'";
                      $result = mysqli_query($con, $sql);
                      $num = mysqli_num_rows($result);
                          if($num > 0){
                            $rowLiveRating = mysqli_fetch_assoc($result);
                            $one = 1;
                            for($i = 0; $i < 5; $i++){   
                              if($i < $rowLiveRating['liveRating']){
                                  echo "<i class='fa-solid fa-star live-star orange me-1' data-id='${one}'></i>";
                              } else{
                                  echo "<i class='fa-solid fa-star live-star me-1' data-id='${one}'></i>";
                              }
                              ++$one;
                          };
                          } else{
                            echo '<i class="fa-solid fa-star live-star" data-id="1"></i>
                            <i class="fa-solid fa-star live-star" data-id="2"></i>
                            <i class="fa-solid fa-star live-star" data-id="3"></i>
                            <i class="fa-solid fa-star live-star" data-id="4"></i>
                            <i class="fa-solid fa-star live-star" data-id="5"></i>';
                          }
                    } else{
                      echo '<i class="fa-solid fa-star sign-in-alert offline-star" data-id="1"></i>
                      <i class="fa-solid fa-star sign-in-alert offline-star" data-id="2"></i>
                      <i class="fa-solid fa-star sign-in-alert offline-star" data-id="3"></i>
                      <i class="fa-solid fa-star sign-in-alert offline-star" data-id="4"></i>
                      <i class="fa-solid fa-star sign-in-alert offline-star" data-id="5"></i>';
                  }
                    ?>

                    <!--------------- END OF CODE ----------->

                </div>
                <h4 class="rate-this">Rate this book</h4>
                </div>
            </div>
            <div class="col">
                <div class="book-details">
                    <div class="header">
                    <h1 class="text-dark">
                    <?php echo $row['title']?>
                    </h1>
                    <h3 class="fw-light mb-3">
                    <?php echo $row['author']?>
                    </h3>
                    <div class="total-rating">
                    <i class="fa-solid fa-star text-warning"></i>
                    <i class="fa-solid fa-star text-warning"></i>
                    <i class="fa-solid fa-star text-warning"></i>
                    <i class="fa-solid fa-star text-warning"></i>
                    <i class="fa-solid fa-star-half text-warning"></i>
                    <span class="h2">4.47</span>
                    </div>
                    </div>
                    <div class="desc relative">
                        <p class="desc-content mt-4">
                        <?php echo $row['description']?>
                        </p>
                        <div class="blur hide"></div>
                        <div class="read-more-desc btn btn-success hide">Read more</div>
                        <div class="extra mt-4">
                        <p class="text-muted">Genre: lorem ipsum</p>
                        <p class="text-muted">250 pages, Paperback</p>
                        <p class="text-muted">First published June 26, 1997</p>
                        </div>
                    </div>
                    <div class="line mt-4"></div>
                    <div class="about-the-author mt-4">
                        <h4 class="mb-3">
                            About the author
                        </h4>
                        <div class="header d-flex justify-content-between">
                            <div class="author d-flex">
                                <div class="author-img-wrapper">
                                <img class="author-img" src="img/sadboy.jpg" alt="">
                                </div>
                                <div class="author-dets mt-3 ms-2">
                                    <h6>Lorem</h6>
                                    <p class="text-muted">805 books - 2216 followers</p>
                                </div>
                            </div>
                            <div> 
                                <button type="button" class="mt-3 px-4 btn btn-dark rounded-pill">Follow</button>
                            </div>
                        </div>
                        <div class="author-content-container relative mt-3">
                            <p class="author-content">
                                Although she writes under the pen name J.K. Rowling, pronounced like rolling, her name when her first Harry Potter book was published was simply Joanne Rowling. Anticipating that the target audience of young boys might not want to read a book written by a woman, her publishers demanded that she use two initials, rather than her full name. As she had no middle name, she chose K as the second initial of her pen name, from her paternal grandmother Kathleen Ada Bulgen Rowling. She calls herself Jo and has said, "No one ever called me 'Joanne' when I was young, unless they were angry." Following her marriage, she has sometimes used the name Joanne Murray when conducting personal business. During the Leveson Inquiry she gave evidence under the name of Joanne Kathleen Rowling. In a 2012 interview, Rowling noted that she no longer cared that people pronounced her name incorrectly.
                            </p>
                            <div class="blur blur-author-content hide"></div>
                        <div class="read-more-author-content btn btn-success hide">Read more</div>
                        </div>
                    </div>
                    <div class="line mt-4"></div>
                    <div class="readers-also-enjoyed">
                        <div id="carouselExampleControls" class="carousel slide carousel-dark realtive" data-bs-ride="carousel">
                            <h4 class="rae">Readers also enjoyed</h4>
                            <div class="carousel-inner pt-5">
                              <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-3">
                                <div class="card border-0" style="width: 12rem;">
                                    <img src="img/new-arr-10.jpg" alt="...">
                                    <div class="card-body p-0">
                                        <h5 class="title mt-2">Just Like You</h5>
                                        <h6 class="author">Nick Hornby</h6>
                                      <div class="rating">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <span>4.47</span>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="card border-0" style="width: 12rem;">
                                        <img src="img/new-arr-10.jpg" alt="...">
                                        <div class="card-body p-0">
                                          <h5 class="title mt-2">Just Like You</h5>
                                          <h6 class="author">Nick Hornby</h6>
                                          <div class="rating">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <span>4.47</span>
                                          </div>
                                        </div>
                                      </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="card border-0" style="width: 12rem;">
                                            <img src="img/new-arr-10.jpg" alt="...">
                                            <div class="card-body p-0">
                                              <h5 class="title mt-2">Just Like You</h5>
                                              <h6 class="author">Nick Hornby</h6>
                                              <div class="rating">
                                                <i class="fa-solid fa-star text-warning"></i>
                                                <span>4.47</span>
                                              </div>
                                            </div>
                                          </div>
                                          </div>
                                          <div class="col-3">
                                            <div class="card border-0" style="width: 12rem;">
                                                <img src="img/new-arr-10.jpg" alt="...">
                                                <div class="card-body p-0">
                                                  <h5 class="title mt-2">Just Like You</h5>
                                                  <h6 class="author">Nick Hornby</h6>
                                                  <div class="rating">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <span>4.47</span>
                                                  </div>
                                                </div>
                                              </div>
                                              </div>
                                  </div>
                                  </div>
                              <div class="carousel-item">
                                <div class="row">
                                    <div class="col-3">
                                <div class="card border-0" style="width: 12rem;">
                                    <img src="img/new-arr-12.jpg" alt="...">
                                    <div class="card-body p-0">
                                      <h5 class="title mt-2">Another Day</h5>
                                      <h6 class="author">David Levithan</h6>
                                      <div class="rating">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <span>4.47</span>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="card border-0" style="width: 12rem;">
                                        <img src="img/new-arr-12.jpg" alt="...">
                                        <div class="card-body p-0">
                                          <h5 class="title mt-2">Another Day</h5>
                                          <h6 class="author">David Levithan</h6>
                                          <div class="rating">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <span>4.47</span>
                                          </div>
                                        </div>
                                      </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="card border-0" style="width: 12rem;">
                                            <img src="img/new-arr-12.jpg" alt="...">
                                            <div class="card-body p-0">
                                              <h5 class="title mt-2">Another Day</h5>
                                              <h6 class="author">David Levithan</h6>
                                              <div class="rating">
                                                <i class="fa-solid fa-star text-warning"></i>
                                                <span>4.47</span>
                                              </div>
                                            </div>
                                          </div>
                                          </div>
                                          <div class="col-3">
                                            <div class="card border-0" style="width: 12rem;">
                                                <img src="img/new-arr-12.jpg" alt="...">
                                                <div class="card-body p-0">
                                                  <h5 class="title mt-2">Another Day</h5>
                                                  <h6 class="author">David Levithan</h6>
                                                  <div class="rating">
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                    <span>4.47</span>
                                                  </div>
                                                </div>
                                              </div>
                                              </div>
                                  </div>
                              </div>
                             
                            </div>
                            <button class="carousel-control-prev help1" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next help2" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                    </div>
                    <div class="line mt-4"></div>
                    <h1 class="mt-3">Ratings & Reviews</h1>
                    <?php if($username){
                    echo '<a href="review.php?title='.$title.'"><button class="btn btn-dark px-5 py-3 rounded-pill my-5"><h3>Write a Review</h3></button></a>';
                    } else{
                      echo '<button class="btn btn-dark px-5 py-3 rounded-pill my-5 sign-in-alert"><h3>Write a Review</h3></button>';
                    }
                    ?>

                    <div class="line mt-4"></div>
                    
                    <div class="reviews mt-2">
                        <h4 class="mb-5">Coummunity Reviews</h4>

                        <!-----------REVIEW POSTING CODE------------->
                        <?php
                        $sql = "SELECT * FROM userhistory WHERE username = '$username' && reviewedBook = '$title'";
                        $result = mysqli_query($con, $sql); 
                          $num = mysqli_num_rows($result);
                          if($num > 0){
                            $row = mysqli_fetch_assoc($result);
                            echo '<div class="review-container relative row">
                          <div class="review-author col-3">
                              <div class="rev-img-wrapper">
                              <img src="'.$row['profilePic'].'" alt="">
                              </div>
                              <p class="fw-bold mb-1">'.$row['username'].'</p>
                              <p class="text-muted mb-0">4 reviews</p>
                              <p class="text-muted nudger1">15 followers</p>
                              <button class="btn-dark rounded-pill px-3 py-1 border-0">Follow</button>
                          </div>
                          <div class="review-div col">
                              <div class="rating d-flex justify-content-between">
                                  <div>';
                                  for($i = 0; $i < 5; $i++){
                                    if($i < $row['revRating']){
                                        echo "<i class='fa-solid fa-star rev-star text-warning me-2'></i>";
                                    } else{
                                        echo "<i class='fa-solid fa-star rev-star text-secondary me-2'></i>";
                                    }
                                };
                                  echo '</div>
                                  <p class="text-muted">Septmber 24, 2022</p>
                              </div>
                              <div class="review-content relative overflow">
                                <div class="blur blur-review"></div> 
                                  <p class="review-p">
                                  '.$row['review'].'
                                  </p>  
                              </div>
                              <div class="read-more-review btn btn-success">Read more</div>
                              <div class="line mt-4 mb-4"></div>
                          </div>
                      </div>';
                          }                          
                        ?>
                        <!-- END -->




                        <div class="review-container relative row">
                            <div class="review-author col-3">
                                <div class="rev-img-wrapper">
                                <img src="img/rev-img.jpg" alt="">
                                </div>
                                <p class="fw-bold mb-1">Tommy</p>
                                <p class="text-muted mb-0">4 reviews</p>
                                <p class="text-muted nudger1">15 followers</p>
                                <button class="btn-dark rounded-pill px-3 py-1 border-0">Follow</button>
                            </div>
                            <div class="review-div col">
                                <div class="rating d-flex justify-content-between">
                                    <div>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-secondary"></i>
                                    </div>
                                    <p class="text-muted">Septmber 24, 2022</p>
                                </div>
                                <div class="review-content relative overflow">
                                  <div class="blur blur-review"></div>
                                    <p class="review-p">
                                    Zabaniya is the name of the Noble Phantasms of the nineteen Hassan-i-Sabbah. Each one of the Hassan had to earn their title by proving their piety through obtaining a divine miracle bearing the name of ShayṭānWP could bring swift and reliable death to its target. All of them, with the exception of Hassan of the Hundred Faces who had a qualifying in-born ability, modified their bodies to achieve their miracles. They are currently keeping their abilities as concealed ultimate techniques, all with the same name for the purpose of taking down the other eighteen Hassans so that they can vie for the position of Leader of the Assassins.[1]The techniques have not been passed down in history like regular Noble Phantasms, but instead because the Assassins themselves are a famous anecdote. Due to being the abilities that have established them as Assassins by virtue of being placed as the Old Man of the Mountain, the superhuman abilities they had in life are sublimated as their Noble Phantasms.[2] The No Name Assassin, a failed candidate for the position, is noted to have copied eighteen of the techniques, accumulated into Phantasmal Pedigree. Each which would take a lifetime to master for a regular person, but she extensively modified her body in only a matter of years. She only lacks Delusional Illusion, the Zabaniya of the Hassan of the Hundred Facees who got chosen for the position instead of her. Although possessing the talent, strength, and fortitude to master the previous eighteen miracles in a matter of years, she was unable to innovate her own original miracle, so she was rejected as the next grandmaster for that reason and her people feared her ability in so quickly mastering the other miracles.[3]
                                    </p>
                                </div>
                                <div class="read-more-review btn btn-success">Read more</div>
                                    
                        
                                <div class="line mt-4 mb-4"></div>
                            </div>
                        </div>
                        <div class="review-container relative row">
                            <div class="review-author col-3">
                                <div class="rev-img-wrapper">
                                <img src="img/rev-img.jpg" alt="">
                                </div>
                                <p class="fw-bold mb-1">Tommy</p>
                                <p class="text-muted mb-0">4 reviews</p>
                                <p class="text-muted nudger1">15 followers</p>
                                <button class="btn-dark rounded-pill px-3 py-1 border-0">Follow</button>
                            </div>
                            <div class="review-div col">
                                <div class="rating d-flex justify-content-between">
                                    <div>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-secondary"></i>
                                    </div>
                                    <p class="text-muted">Septmber 24, 2022</p>
                                </div>
                                <div class="review-content relative overflow">
                                  <div class="blur blur-review"></div> 
                                    <p class="review-p">
                                      Zabaniya is the name of the Noble Phantasms of the nineteen Hassan-i-Sabbah. Each one of the Hassan had to earn their title by proving their piety through obtaining a divine miracle bearing the name of ShayṭānWP could bring swift and reliable death to its target. All of them, with the exception of Hassan of the Hundred Faces who had a qualifying in-born ability, modified their bodies to achieve their miracles. 
                                    </p>  
                                </div>
                                <div class="read-more-review btn btn-success">Read more</div>
                                <div class="line mt-4 mb-4"></div>
                            </div>
                        </div>
                        <div class="review-container relative row">
                            <div class="review-author col-3">
                                <div class="rev-img-wrapper">
                                <img src="img/rev-img.jpg" alt="">
                                </div>
                                <p class="fw-bold mb-1">Tommy</p>
                                <p class="text-muted mb-0">4 reviews</p>
                                <p class="text-muted nudger1">15 followers</p>
                                <button class="btn-dark rounded-pill px-3 py-1 border-0">Follow</button>
                            </div>
                            <div class="review-div col">
                                <div class="rating d-flex justify-content-between">
                                    <div>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <i class="fa-solid fa-star text-secondary"></i>
                                    </div>
                                    <p class="text-muted">Septmber 24, 2022</p>
                                </div>
                                <div class="review-content relative overflow">
                                  <div class="blur blur-review"></div>
                                    <p class="review-p">
                                      Zabaniya is the name of the Noble Phantasms of the nineteen Hassan-i-Sabbah. Each one of the Hassan had to earn their title by proving their piety through obtaining a divine miracle bearing the name of ShayṭānWP could bring swift and reliable death to its target. All of them, with the exception of Hassan of the Hundred Faces who had a qualifying in-born ability, modified their bodies to achieve their miracles. They are currently keeping their abilities as concealed ultimate techniques, all with the same name for the purpose of taking down the other eighteen Hassans so that they can vie for the position of Leader of the Assassins.[1]The techniques have not been passed down in history like regular Noble Phantasms, but instead because the Assassins themselves are a famous anecdote. Due to being the abilities that have established them as Assassins by virtue of being placed as the Old Man of the Mountain, the superhuman abilities they had in life are sublimated as their Noble Phantasms.[2] The No Name Assassin, a failed candidate for the position, is noted to have copied eighteen of the techniques, accumulated into Phantasmal Pedigree. Each which would take a lifetime to master for a regular person, but she extensively modified her body in only a matter of years. She only lacks Delusional Illusion, the Zabaniya of the Hassan of the Hundred Facees who got chosen for the position instead of her. Although possessing the talent, strength, and fortitude to master the previous eighteen miracles in a matter of years, she was unable to innovate her own original miracle, so she was rejected as the next grandmaster for that reason and her people feared her ability in so quickly mastering the other miracles.[3]
                                    </p>
                                </div>
                                <div class="read-more-review btn btn-success">Read more</div>
                            </div>
                        </div>
                       
                    </div>

                </div>
            </div>
        </div>
        <div class="line mt-5"></div>
        <div id="carouselExampleIndicators" class="carousel slide carousel-dark pushtop relative" data-bs-ride="carousel">
            <h4 class="raa">Other books by Desmond Shum</h4>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <div class="card border-0" style="width: 12rem;">
                            <img src="img/new-arr-10.jpg" alt="...">
                            <div class="card-body p-0">
                              <h5 class="title mt-2">Just Like You</h5>
                              <h6 class="author">Nick Hornby</h6>
                              <div class="rating">
                                <i class="fa-solid fa-star text-warning"></i>
                                <span>4.47</span>
                              </div>
                            </div>
                          </div>
                          </div>
                          <div class="col-2">
                            <div class="card border-0" style="width: 12rem;">
                                <img src="img/new-arr-10.jpg" alt="...">
                                <div class="card-body p-0">
                                    <h5 class="title mt-2">Just Like You</h5>
                                    <h6 class="author">Nick Hornby</h6>
                                  <div class="rating">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <span>4.47</span>
                                  </div>
                                </div>
                              </div>
                              </div>
                              <div class="col-2">
                                <div class="card border-0" style="width: 12rem;">
                                    <img src="img/new-arr-10.jpg" alt="...">
                                    <div class="card-body p-0">
                                        <h5 class="title mt-2">Just Like You</h5>
                                        <h6 class="author">Nick Hornby</h6>
                                      <div class="rating">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <span>4.47</span>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-2">
                                    <div class="card border-0" style="width: 12rem;">
                                        <img src="img/new-arr-10.jpg" alt="...">
                                        <div class="card-body p-0">
                                            <h5 class="title mt-2">Just Like You</h5>
                                            <h6 class="author">Nick Hornby</h6>
                                          <div class="rating">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <span>4.47</span>
                                          </div>
                                        </div>
                                      </div>
                                      </div>
                                      <div class="col-2">
                                        <div class="card border-0" style="width: 12rem;">
                                            <img src="img/new-arr-10.jpg" alt="...">
                                            <div class="card-body p-0">
                                                <h5 class="title mt-2">Just Like You</h5>
                                                <h6 class="author">Nick Hornby</h6>
                                              <div class="rating">
                                                <i class="fa-solid fa-star text-warning"></i>
                                                <span>4.47</span>
                                              </div>
                                            </div>
                                          </div>
                                          </div>
                  </div>
              </div>
              <div class="carousel-item">
                <div class="row justify-content-center">
                    <div class="col-2">
                        <div class="card border-0" style="width: 12rem;">
                            <img src="img/new-arr-12.jpg" alt="...">
                            <div class="card-body p-0">
                              <h5 class="title mt-2">Another Day</h5>
                              <h6 class="author">David Levithan</h6>
                              <div class="rating">
                                <i class="fa-solid fa-star text-warning"></i>
                                <span>4.47</span>
                              </div>
                            </div>
                          </div>
                          </div>
                          <div class="col-2">
                            <div class="card border-0" style="width: 12rem;">
                                <img src="img/new-arr-12.jpg" alt="...">
                                <div class="card-body p-0">
                                  <h5 class="title mt-2">Another Day</h5>
                                  <h6 class="author">David Levithan</h6>
                                  <div class="rating">
                                    <i class="fa-solid fa-star text-warning"></i>
                                    <span>4.47</span>
                                  </div>
                                </div>
                              </div>
                              </div>
                              <div class="col-2">
                                <div class="card border-0" style="width: 12rem;">
                                    <img src="img/new-arr-12.jpg" alt="...">
                                    <div class="card-body p-0">
                                      <h5 class="title mt-2">Another Day</h5>
                                      <h6 class="author">David Levithan</h6>
                                      <div class="rating">
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <span>4.47</span>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="col-2">
                                    <div class="card border-0" style="width: 12rem;">
                                        <img src="img/new-arr-12.jpg" alt="...">
                                        <div class="card-body p-0">
                                          <h5 class="title mt-2">Another Day</h5>
                                          <h6 class="author">David Levithan</h6>
                                          <div class="rating">
                                            <i class="fa-solid fa-star text-warning"></i>
                                            <span>4.47</span>
                                          </div>
                                        </div>
                                      </div>
                                      </div>
                                      <div class="col-2">
                                        <div class="card border-0" style="width: 12rem;">
                                            <img src="img/new-arr-12.jpg" alt="...">
                                            <div class="card-body p-0">
                                              <h5 class="title mt-2">Another Day</h5>
                                              <h6 class="author">David Levithan</h6>
                                              <div class="rating">
                                                <i class="fa-solid fa-star text-warning"></i>
                                                <span>4.47</span>
                                              </div>
                                            </div>
                                          </div>
                                          </div>
                  </div>
              </div>
            </div>
            <button class="carousel-control-prev help4" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next help3" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

        <br><br><br><br><br><br><br><br><br>


    </div>
    <!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
<!-- Index JS-->
<script type="text/javascript" src="sbook.js"></script>
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
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:5
          }
      }
  })
  </script> 
<!-- Ajax Lib -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
      $(document).on('mouseover', '.live-star', function(e) {
        var id = e.currentTarget.dataset.id;
        for(var i = 0; i < id; i++){
          console.log('i hate you');
          document.querySelectorAll('.live-star')[i].classList.add('yellow');
        };
      });

      $(document).on('mouseout', '.live-star', function(e) {
        for(var i = 0; i < 5; i++){
          document.querySelectorAll('.live-star')[i].classList.remove('yellow');
        };
      });

      $(document).on('click', '.live-star', function(e) {
        var liveRatingId = e.currentTarget.dataset.id;
        document.cookie = "liveRatingId = " + liveRatingId;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.querySelector(".live-rating").innerHTML = this.responseText;
        }
      };
        xhttp.open("GET", `setLiveRating.php?rating=${liveRatingId}&cookie=<?php echo $liveRating ?>`, true);
        xhttp.send();
    });

    $(document).on('mouseover', '.offline-star', function(e) {
        var id = e.currentTarget.dataset.id;
        for(var i = 0; i < id; i++){
          document.querySelectorAll('.offline-star')[i].classList.add('yellow');
        };
      });

      $(document).on('mouseout', '.offline-star', function(e) {
        for(var i = 0; i < 5; i++){
          document.querySelectorAll('.offline-star')[i].classList.remove('yellow');
        };
      });

    $(document).on('click', '.sign-in-alert', function(){
    document.querySelector('.sign-in-alert-overlay').classList.remove('hide');
});

document.querySelector('.sign-in-alert-overlay').addEventListener('click', (e)=>{
    var closeByClickingOverlay = e.target.className;
    if(closeByClickingOverlay === 'sign-in-alert-overlay'){
        document.querySelector('.sign-in-alert-overlay').classList.add('hide');
    }
})

    
  </script>   
</body>     
</html>