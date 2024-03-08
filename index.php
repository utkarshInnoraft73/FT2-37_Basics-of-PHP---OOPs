<?php

/**
 * Define valid user and password.
 */
$validUser = "user@try.com";
$validPassword = "1234";
$errMsg = "";
/**
 * Check of the request method is post or not.
 * If method is post, then it check the input detail is match or not to the valid user.
 * If match all the detail the session islogin set true, and set header to the admin page. 
 */

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = $_POST['email'];
    $password = $_POST['password'];

    if ($user == $validUser && $password == $validPassword) {
        session_start();
        $_SESSION['isLogin'] = true;
        header("location: admin.php");
        exit();
    } 
    else {
        $errMsg = "Invalid user id or password.";
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
    <link rel="stylesheet" href="./Style/style.css">
</head>

<body>
    <div class="container my-5 d-flex justify-content-center align-item-center flex-column">
        <div class="row">

            <form class="col-4 my-5 border py-4 px-3 offset-1 rounded" method="post" action="index.php">
                <h3>Login in here.</h3>
                <p class="require"><?php echo $errMsg; ?></p>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" maxlength="40" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3 ">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                </div>
                <input type="submit" class="btn btn-primary" name="submit">
            </form>
            <div class="img col-6 offset-1">
                <img src="./Assets/Images/login.webp" alt="" width="500" height="400" srcset="">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>