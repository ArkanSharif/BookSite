<?php 
$rating = $_GET['rating'];
?>

<?php

for($i = 0; $i < 5; $i++){
    $id = $i;
    ++$id;
    if($i < $rating){
        echo '<i class="fa-solid fa-star rev-star text-warning" data-id="'.$id.'"></i>';
    } else{
        echo '<i class="fa-solid fa-star rev-star grey" data-id="'.$id.'"></i>';
    }
};

?>

