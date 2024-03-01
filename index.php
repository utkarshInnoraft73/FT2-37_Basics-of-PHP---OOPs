<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>

    .error{
      color: red;
    }
  </style>

  <body>

  <?php

    $fname = $lname =$phone= "";
    $fnameErr= $lnameErr=$phoneErr="";

    if($_SERVER["REQUEST_METHOD"]== "POST"){
      // Checking if the First name field only contains letters, dashes, apostrophes and whitespaces.
      if (empty($_POST["fname"])) {
        $fnameErr = "This field is required";
      }
      else if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["fname"])) {
        $fnameErr = "Only letters and white space allowed";
      }
      else {
        $fname = test_input($_POST["fname"]);
      }

      // Checking if the Last name field only contains letters, dashes, apostrophes and whitespaces.

      if (empty($_POST["lname"])) {
        $lnameErr = "This field is required";
      }
      else if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["lname"])) {
        $lnameErr = "Only letters and white space allowed";
      }
      else {
        $lname = test_input($_POST["lname"]);
      }

    //   Checking if the phone field has not more than 10 digits.

    if(empty($_POST["phone"])){
        $phoneErr = "This field is required.";
    }
    // else if(!preg_match("/^[+91]+$/", $_POST['phone'])){
    //     $phoneErr = "Only Indian phone number is valid.";
    // }
    else if(!preg_match("/^[0-9]{10}+$/", $_POST['phone'])){
        $phoneErr = "This field contains 10 digits.";
    }
    else{
        $phone = $_POST['phone'];
    }


    //   Accessing the Images
      $imgName = $_FILES['image']['name'];
      $img_temp_name = $_FILES['image']['tmp_name'];
      move_uploaded_file($img_temp_name,"Uploads/$imgName");


    // Accessing Subject and marks
    
    if(!empty($_POST['marks'])){

        // Converting the string into array by new line.
        $marks_lines = explode("\n",$_POST['marks']);
    }
        $errMsg="Marks is not entered.";
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // Making the person class

    class Person{
      public $fname;
      public $lname;
      public $phone;

    // Creating the cunstructor
    function __construct($fname,$lname, $phone)
    {
        $this->fname=$fname;
        $this->lname=$lname;
        $this->phone=$phone;
    }

      // Getting First name
      function get_firstName(){
        return $this->fname;
      }

      // Getting Last name
      function get_lastName(){
          return $this->lname;
        }

        // Getting Phone
      function get_phone(){
        return $this->phone;
      }
    }

    $person = new Person($fname, $lname, $phone);
?>

  <div class="container py-5">

      <div class="card mt-5">
      <div class="card-header">
        Personal Details.
      </div>
      <!-- After given input, The message will be show -->
      <h3 class="mt-3 ms-3">Hello, <?php echo "{$person->get_firstName()} {$person->get_lastName()}";?></h3>
      <div class="card-body">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

      <!-- Input field for First name. -->
      <div class="mb-3">
        <label for="" class="form-label">First name
          <span class="error">*<?php echo "{$fnameErr}"?><span>
            </label>
            <input type="text" class="form-control" id="" aria-describedby="" name = "fname">
          </div>

          <!-- Input field for Last name -->
          <div class="mb-3">
            <label for="" class="form-label">Last name
          <span class="error">*<?php echo "{$lnameErr}"?><span>
        </label>
        <input type="text" class="form-control" id="" aria-describedby="" name = "lname">
      </div>

      <!-- Input field for phone number -->
          <div class="mb-3">
            <label for="" class="form-label">Phone no.(eg: +911234567890)
          <span class="error">*<?php echo "{$phoneErr}"?><span>

        </label>
        <input type="text" class="form-control" id="" aria-describedby="" name = "phone">
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Upload image</label>
        <input type="file" class="form-control" id="" aria-describedby="" name="image" >
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Subject and marks (ex: English|80)</label>
        <textarea type="text" class="form-control" id="" aria-describedby="" name="marks" rows="4" cols=""></textarea>
      </div>
      <input type="submit" class="btn btn-primary">
    </form>
</div>
<div style="width: 100% !important;">
    <img src="<?php echo "Uploads/{$imgName}"?>" height="400" width="400" style="display: block; margin: auto;">
    <h4 style="margin: 10px 0; text-align:center;"><?php echo "{$person->get_firstName()} {$person->get_lastName()}";?></h4>
  </div>


  <div>

      <h4 style="margin: 10px 0; text-align:center;"> Entered Marks</h4>
    
      <table class="table table-hover">
      <thead>
        <tr class="table-dark">
          <th scope="col">#</th>
          <th scope="col">Subject</th>
          <th scope="col">Marks</th>
        </tr>
      </thead>
      <tbody>
            <?php 
            $i = 1;
    
                foreach($marks_lines as $lines){
                    // exploding marks_line as subject and marks seperating by |
                    $parts = explode("|",$lines);
                    $subject = trim($parts[0]);
                    $mark = trim($parts[1]);
    
                    // printing subject and marks
                    echo "<tr>
                    <td>{$i}</td>
                    <td>{$subject}</td>
                    <td>{$mark}</td>
                    
                  </tr>";
                  $i = $i+1;
                }
            ?>
        
      </tbody>
    </table>
  </div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>