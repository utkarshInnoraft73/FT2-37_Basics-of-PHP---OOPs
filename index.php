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
    phoneErr = for phone number error.
    emailErr = for email error.
    txteraErr = for textarea error.
    emailSts = for email status.
    */
    $fnameErr = $lnameErr = $phoneErr = $emailErr = $emailSts = $txteraErr = "";

    /*
    Function for Validation.
    nameValidation for validating name.
    phoneValidation for validating phone number.
    emailValidation for validating email.
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

    function phoneValidation($data, &$errorMsg)
    {
        if (empty($data)) {
            $errorMsg = "This field is required.";
        } 
         
        else if (!preg_match("/^[1-9][0-9]{9}$/", $data)) {
            $errorMsg = "Invalid input.";
        } 
        else if (strlen($data) != 10) {
            $errorMsg = "Number will be of 10 digits.";
        } 
        else {
            return "+91 $data";
        }
    }
    function emailValidation($data, &$errorMsg, &$emailSts)
    {

        if (empty($data)) {
            $errorMsg = "This field is required";
        } 
        else if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            $errorMsg = "Invalid email format.";
        } 
        else {
            $emailSts = "The email successfull added.";
            return test_input($data);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname = nameValidation($_POST['fname'], $fnameErr);
        $lname = nameValidation($_POST['lname'], $lnameErr);
        $email = emailValidation($_POST['email'], $emailErr, $emailSts);
        $phone = phoneValidation($_POST['phone'], $phoneErr);

        //   Accessing the Images.
        $imgName = $_FILES['image']['name'];
        $img_temp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($img_temp_name, "Uploads/$imgName");

        // Accessing Subject and marks.
        if (!empty($_POST['marks'])) {
            // Converting the string into array by new line.
            $marks_lines = explode("\n", $_POST['marks']);
        }
        $errMsg = "Marks is not entered.";
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
        public $phone;

        /* Creating the cunstructor */
        function __construct(string $fname, string $lname, string $phone)
        {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->phone = $phone;
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

        /* Getting Phone number. */
        function getPhone()
        {
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
            <!-- After given input, The message will be show. -->
            <?php
            // if(!empty($fname) && !empty($lname)) {
            ?>
            <h3 class="mt-3 ms-3">Hello, <?php echo "{$person->getFirstName()} {$person->getLastName()}"; ?></h3>
            <?php 
        // }
        ?>
            <h3 class="mt-3 ms-3">Phone: <?php echo "{$person->getPhone()}"; ?></h3>
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

                    <!-- Input field for Email. -->
                    <div class="mb-3">
                        <label for="" class="form-label">Email
                            <span class="error">*<?php echo "{$emailErr}" ?><span>
                        </label>
                        <input type="text" class="form-control" aria-describedby="" name="email" required maxlength="40" value="<?php echo $_POST['email']; ?>">
                        <span class="success"><?php echo "{$emailSts}" ?><span>

                    </div>

                    <!-- Input field for phone number. -->
                    <div class="mb-3">
                        <label for="" class="form-label">Phone no.(eg: 1234567890)
                            <span class="error">*<?php echo "{$phoneErr}" ?><span>
                        </label>
                        <input type="tel" class="form-control" aria-describedby="" name="phone" required maxlength="10" value="<?php echo $_POST['phone']; ?>">
                    </div>

                    <!-- Input field for image. -->
                    <div class="mb-3">
                        <label for="" class="form-label">Upload image</label>
                        <input type="file" class="form-control" aria-describedby="" name="image" accept="image/*">
                    </div>

                    <!-- Input field for Subject and marks. -->
                    <div class="mb-3">
                        <label for="" class="form-label">Subject and marks (ex: English|80)
                            
                        </label>
                        <textarea type="text" class="form-control" aria-describedby="" name="marks" rows="4" cols="" value="<?php echo $_POST['marks']; ?>"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
            <div style="width: 100% !important;">
                <?php
                if (!empty($imgName)) { ?>
                    <img src="<?php echo 'Uploads/{$imgName}'; ?>" height='400' width='400' style='display: block; margin: auto;'>
                    <h4 style='margin: 10px 0; text-align:center;'><?php echo "{$person->getFirstName()} {$person->getLastName()}"; ?></h4>";
                <?php
                }
                ?>
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
                        foreach ($marks_lines as $lines) {

                            // Exploding marks_line as subject and marks seperating by "|".
                            $parts = explode("|", $lines);
                            if (is_numeric(trim($parts[0])) && is_numeric(trim($parts[1])) || (empty(trim($parts[0])) || empty(trim($parts[1])))) {
                                // $txteraErr = "Invalid Input.";
                                // echo "global $txteraErr";
                                return "";
                            } else if (is_numeric(trim($parts[0]))) {
                                $mark = trim($parts[0]);
                                $subject = trim($parts[1]);
                            } else {
                                $subject = trim($parts[0]);
                                $mark = trim($parts[1]);
                            }

                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $subject; ?></td>
                                <td><?php echo $mark; ?></td>
                            </tr>
                        <?php
                            $i = $i + 1;
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