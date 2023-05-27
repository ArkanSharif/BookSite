<?php 

$rating = $_GET['rating'];
$_SESSION["rating"] = $rating;


?>

<?php

for($i = 0; $i < 5; $i++){
    $id = $i;
    ++$id;
    if($i < $rating){
        echo '<i class="fa-solid fa-star rev-star orange" data-id="'.$id.'"></i>';
    } else{
        echo '<i class="fa-solid fa-star rev-star" data-id="'.$id.'"></i>';
    }
};

?>



