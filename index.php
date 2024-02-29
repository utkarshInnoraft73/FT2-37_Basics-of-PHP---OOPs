<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>

  <?php
    $firstName = $lastName = "";

    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $firstName = test_input($_POST["firstName"]);
        $lastName = test_input($_POST["lastName"]);
    }
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>




  <div class="container">

      <div class="card mt-5">
      <div class="card-header">
        Personal Details.
      </div>
      <div class="card-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="mb-3">
        <label for="" class="form-label">First name</label>
        <input type="text" class="form-control" id="" aria-describedby="" name = firstName>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Last name</label>
        <input type="text" class="form-control" id="" aria-describedby="" name="lastName">
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Last name</label>
        <input type="text" class="form-control" id="" aria-describedby="" name="lastName" value = "<?php echo "{$firstName} {$lastName}"?>" disabled>
      </div>
      <input type="submit" class="btn btn-primary">
    </form>
      </div>


      <div class="container mt-5 py-3">
      <div class="card" style="width: 18rem;">
  <div class="card-header">
    Your details
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
        <?php echo "First Name: " . $firstName?>
    </li>
    <li class="list-group-item">
    <?php echo "Last Name: " . $lastName?>
    </li>
    <li class="list-group-item">
    <?php echo "Full Name: " . $firstName . " " . $lastName?>
    </li>
  </ul>
</div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>