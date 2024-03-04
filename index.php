<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .error {
        color: red;
    }
</style>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fnameErr = $lnameErr ="";
        $fullNameErr = "Invalid input.";

        // Validating Input data.
        function checkValidation($data, &$errorMsg)
        {
            if (empty($data)) {
                $errorMsg = "This field is required";
            } 
            else if (!preg_match("/^[a-zA-Z-' ]*$/", $data)) {
                $errorMsg = "Only letters are allowed.";
            } 
            else {
                return test_input($data);
            }
        }

         // Cheecking input data.
         function test_input($data)
         {
             $data = trim($data);
             $data = stripslashes($data);
             $data = htmlspecialchars($data);
             return $data;
         }
    }

    
    // Calling validation function.
    $fname = checkValidation($_POST['fname'], $fnameErr);
    $lname = checkValidation($_POST['lname'], $lnameErr);

    // Making the person class.
    class Person
    {
        public $fname;
        public $lname;

        // Setting First name.
        function set_firstName($fname)
        {
            $this->fname = $fname;
        }

        // Setting Last name.
        function set_lastName($lname)
        {
            $this->lname = $lname;
        }

        // Getting First name.
        function get_firstName()
        {
            return $this->fname;
        }

        // Getting Last name.
        function get_lastName()
        {
            return $this->lname;
        }
    }

    $person = new Person();
    $person->set_firstName($fname);
    $person->set_lastName($lname);
    
    ?>

    <div class="container">

        <div class="card mt-5">
            <div class="card-header">
                Personal Details.
            </div>
            <!-- After given input, The message will be show -->
            <h3 class="mt-3 ms-3">Hello, <?php echo "{$person->get_firstName()} {$person->get_lastName()}"; ?></h3>
            <div class="card-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <!-- Input field for first name. -->
                    <div class="mb-3">
                        <label for="" class="form-label">First name
                            <span class="error">*<?php echo "$fnameErr" ?><span>
                        </label>
                        <input type="text" class="form-control" id="" aria-describedby="" name="fname" required value="<?php echo $_POST['fname']; ?>" minlength="3" maxlength="20">
                    </div>

                    <!-- Input field for last name. -->
                    <div class="mb-3">
                        <label for="" class="form-label">Last name
                            <span class="error">*<?php echo "$lnameErr" ?><span>

                        </label>
                        <input type="text" class="form-control" id="" aria-describedby="" name="lname" required value="<?php echo $_POST['lname']; ?>" minlength="3" maxlength="20">
                    </div>

                    <!-- Input field for full name. -->
                    <div class="mb-3">
                        <label for="" class="form-label">Full name
                        <span class="error"><?php echo !empty($_POST['fullName'])?$fullNameErr:""; ?><span>
                        </label> 
                        <input type="text" class="form-control" id="" aria-describedby="" name="fullName" value="<?php echo "{$fname} {$lname}" ?>" disabled>
                    </div>

                    <!-- Input field of type submit. -->
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>