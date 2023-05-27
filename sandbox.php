<?php

?>

<html lang="eng">
<head>
<title> BestBooks.com </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootsrap 5 CSS-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Bootsrap 5 icons-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<!-- Index CSS-->
<link rel="stylesheet" href="home.css?v=<?php echo time(); ?>">   
</head>   
<style>

</style>
<body>
<div class="container">
  <button class='help'>CLICK ME!</button>
  <button class='help'>SAD SAD!</button>
</div>

<!-- Bootsrap 5 JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Ajax Lin -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- Index JS-->
<script>
$(document).on('click', '.help', function() {
  console.log('happy!');
    
    // Ajax called here

    var xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
  document.querySelector(".container").innerHTML = this.responseText;
}
};
xhttp.open("GET", "sandboxAjax.php", true);
xhttp.send();
});




  /*$("button").on("click", function(){

    
});*/
  
</script>    
</body>
</html>