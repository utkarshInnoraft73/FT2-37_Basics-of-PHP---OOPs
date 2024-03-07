<?php
// if(!$_SESSION['isValid']){
//     header("location:index.php");
//     exit;
// }
session_start();

    if(isset($_GET['q']) && is_numeric($_GET['q'])){
        $qnumber = $_GET['q'];
        include('q'.$qnumber.'.php');
    }
    else{
        include('q1.php');
    }
?>







<a href="logout.php" class="btn btn-danger">Log out</a>

<!-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <div class="container my-5">
    <h3 class="text-center"></h3>
    <div class="col-6" style="margin:auto">
    <div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
    Open the question to see.
  </a>
  <a href="q1.php?q=1" class="list-group-item list-group-item-action">1. First question</a>
  <a href="q2.php?q=2" class="list-group-item list-group-item-action">2. Second question</a>
  <a href="#" class="list-group-item list-group-item-action">3. Third question</a>
  <a href="#" class="list-group-item list-group-item-action">4. Forth question</a>
  <a href="#" class="list-group-item list-group-item-action">5. Fifth question</a>
  <a href="#" class="list-group-item list-group-item-action">6. Sixth question</a>

</div>
    </div>
  </div>  


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html> -->
