<?php
require("user.php");
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
         
        else if (!preg_match("/^(\+91)[1-9][0-9]{9}$/", $data)) {
            $errorMsg = "Invalid input.";
        } 
        else if (strlen($data) != 13) {
            $errorMsg = "Number will be of 10 digits.";
        } 
        else {
            return "$data";
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

    $user = new User($fname, $lname, $phone, $email);

    // Message to show after successfull submit the form.
    if (!empty($user->getFirstName()) && !empty($user->getLastName())) {
        $message = "Hello, {$user->getFirstName()} {$user->getLastName()}.";
    }

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>

<body>
<div class="container">
        <div class="row d-flex justify-content-center my-5">
            <h1 class="text-center my-2"><?php echo $message; ?></h1>
            <div class="col-6">
                <form class="row g-3 needs-validation" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" onsubmit="return checkInputs()">
                    <!-- Field to take input of first name. -->
                <div class="col-md-8">
                        <label for="fname" class="form-label">First name
                            <span class="require" id="fnameErr">* <?php echo "$fnameErr";?></span>
                        </label>
                        <input type="text" class="form-control item" id="fname" name="fname" value="<?php echo $_SERVER['fname'];?>" minlength="3" maxlength="20" required>
                    </div>

                    <!-- Field to take input of last name. -->
                    <div class="col-md-8">
                        <label for="lname" class="form-label">Last name
                            <span class="require" id="lnameErr">* <?php echo "$lnameErr";?></span>
                        </label>
                        <input type="text" class="form-control item" id="lname" name="lname" value="<?php echo $_SERVER['lname'];?>" minlength="3" maxlength="20" required>
                    </div>
                    <!-- Field to take input of phone. -->
                    <div class="col-md-8">
                        <label for="phone" class="form-label">Phone
                            <span class="require" id="phoneErr">* <?php echo "$phoneErr";?></span>
                        </label>
                        <input type="text" class="form-control item" id="phone" name="phone" value="<?php echo $_SERVER['phone'];?>" maxlength="13" required>
                    </div>
                    <!-- Field to take input of email. -->
                    <div class="col-md-8">
                        <label for="email" class="form-label">Email
                            <span class="require" id="emailErr">* <?php echo "$emailErr";?></span>
                        </label>
                        <input type="text" class="form-control item" id="email" name="email" value="<?php echo $_SERVER['email'];?>" maxlength="40" required>
                    </div>

                    <!-- Field to take input of image -->
                    <div class="col-md-8">
                        <label for="image" class="form-label">Upload image
                        </label>
                        <input type="file" class="form-control item" id="image" name="image" accept="image/*" required>
                    </div>

                    <!-- Field to take input of subject marks pair. -->
                    <div class="col-md-8">
                        <label for="marks">Subject marks (Format: Subject|Marks)
                            <span class="require" id="marksErr">*</span>
                        </label>
                        <div class="form-floating">
                            <textarea class="form-control" id="marks" style="height: 100px" name="marks" value="<?php echo $_SERVER['marks'];?>" required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="submit">
                    </div>
                </form>
            </div>
            <div style="width: 100% !important;">
                <?php
                if (!empty($imgName)) { ?>
                    <img src="./Uploads/<?php echo $imgName;?>" height='400' width='400' style='display: block; margin: auto;'>
                <?php
                }
                ?>
            </div>

            <!-- Printing the table. -->
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
                                return "";
                            } 
                            else if (is_numeric(trim($parts[0]))) {
                                $mark = trim($parts[0]);
                                $subject = trim($parts[1]);
                            }
                            else {
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>