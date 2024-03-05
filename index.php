<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    /*
    Variable for error message.
    fnameErr = for first name error.Invalid Input.
    lnameErr = for last name error.
    */
    $fnameErr = $lnameErr = "";
    
    /*
    Function for Validation.
    nameValidation for validating name.
    */
    function nameValidation($data, &$errorMsg)
    {
        if (empty($data)) {
            $errorMsg = "This field is required";
            return "";
        } 
        else {
            $name = test_input($data);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $errorMsg = "Only letters are allowed.";
                return "";
            } 
            else if (empty($name)) {
                $errorMsg = "Invalid Input.";
                return "";
            } 
            else {
                return $name;
            }
        }
    }

   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname = nameValidation($_POST['fname'], $fnameErr);
        $lname = nameValidation($_POST['lname'], $lnameErr);

        //   Accessing the Images.
        $imgName = $_FILES['image']['name'];
        $img_temp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($img_temp_name, "Uploads/$imgName");
    }

    /**Testing input data. */
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /* Making the person class. */
    class Person
    {
        /* Create the public variables.
        fname for first name.
        lname for last name.
        phone for phone number.
        */
        public $fname;
        public $lname;
        

        /* Creating the cunstructor */
        function __construct(string $fname, string $lname)
        {
            $this->fname = $fname;
            $this->lname = $lname;
            
        }

        /* Getting First name. */
        function getFirstName()
        {
            return $this->fname;
        }

        /* Getting Last name. */
        function getLastName()
        {
            return $this->lname;
        }
    }

    $person = new Person($fname, $lname);

    ?>

    <div class="container py-5">

        <div class="card mt-5">
            <div class="card-header">
                Personal Details.
            </div>
            <!-- After given input, The message will be show. -->
            <h3 class="mt-3 ms-3">Hello, <?php echo "{$person->getFirstName()} {$person->getLastName()}"; ?></h3>
            <div class="card-body">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

                    <!-- Input field for First name. -->
                    <div class="mb-3">
                        <label for="" class="form-label">First name
                            <span class="error">*<?php echo "{$fnameErr}" ?><span>
                        </label>
                        <input type="text" class="form-control" aria-describedby="" name="fname" required minlength="3" maxlength="20" value="<?php echo $_POST['fname']; ?>">
                    </div>

                    <!-- Input field for Last name. -->
                    <div class="mb-3">
                        <label for="" class="form-label">Last name
                            <span class="error">*<?php echo "{$lnameErr}" ?><span>
                        </label>
                        <input type="text" class="form-control" aria-describedby="" name="lname" required  maxlength="20" value="<?php echo $_POST['lname']; ?>">
                    </div>

                    <!-- Input field for image. -->
                    <div class="mb-3">
                        <label for="" class="form-label">Upload image</label>
                        <input type="file" class="form-control" aria-describedby="" name="image" accept="image/*">
                    </div>

                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>