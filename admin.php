<?php
session_start();

// Including navbar.
include('nav.php');

// Checking islogin is true or not.
if(!isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == false){
  header("location: index.php");
  exit();
}

// Checking the get quest for question number.
if(isset($_GET['q']) && is_numeric($_GET['q']) && number_format($_GET['q']>6) || number_format($_GET['q']<1)){
  $qnumber = $_GET['q'];
   include('q'.$qnumber.'.php');
}
else{
  include('q1.php');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="d-flex align-item-center" style="width: 700px; margin:auto; height: 700px;">
    <h5>NOTE: To show the question please click on button or in browser search type http://domain/admin.php?q='question number'.</h1>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
