<?php
$validUser = "user@try.com";
$validPassword = "1234";

// echo $_POST['password'];    
// $isLogin = false;

// if(isset($_SESSION['validUser'])){
//     $isLogin = true;
// }

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_POST['email'] == $validUser && $_POST['password'] == $validPassword){
        session_start();
        $_SESSION['validUser'] = $validUser;
        $_SESSION['isLogin'] = true;
        header("location: admin.php");
    }
    else{
        echo "<script>alert('worng user.')</script>";
        header("location:index.php");
    }
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
    <div class="container my-5 d-flex justify-content-center align-item-center flex-column">
        <h3>Login in here.</h3>
    <form class="col-4 border py-4 px-3 rounded" method="post" action="index.php">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "email" maxlength="40" required >
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3 ">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name = "password"  required>
  </div>
  <input type="submit" class="btn btn-primary" name = "submit">
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

