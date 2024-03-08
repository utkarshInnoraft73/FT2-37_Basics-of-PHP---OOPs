<?php
// Importing the file user.php.
require("./user.php");
/**
 * The pattern for name field.
 */
const PATTERN = "/^[a-zA-Z-' ]*$/";

/**
 * For error messages.
 * fnameErr for first name error.
 * lnameErr for last name error.
 * fullNameErr for full name error.
 */
$fnameErr = $lnameErr = $fullNameErr = "";

/**
 * Method to check the inputs.
 */
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

/**
 * Creating the method for validating the fist name and last name.
 */
function nameValidation($data, &$errorMsg)
{
    if (empty($data)) {
        $errorMsg = "This is required field.";
        return "";
    } else {
        $name = testInput($data);
        if (!preg_match(PATTERN, $name)) {
            $errorMsg = "Invalid input.";
            return "";
        } else if (empty($name)) {
            $errorMsg = "Invalid input.";
            return "";
        } else {
            return $name;
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = nameValidation($_POST['fname'], $fnameErr);
    $lname = nameValidation($_POST['lname'], $lnameErr);

    if(!empty($_POST['fullName'])){
        $fullNameErr = "This field is not editable.";
    }
}

// Message to show after successfull submit the form 
if(!empty($fname) && !empty($lname)){
    $message = "Hello, {$fname} {$lname}."; 
}

$user = new User($fname, $lname);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center my-5">
            <h1 class="text-center my-2"><?php echo $message;?></h1>
            <div class="col-6">
                <form class="row g-3 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" onsubmit="return checkInputs()">
                    <div class="col-md-8">
                        <label for="fname" class="form-label" >First name
                            <span class="error" id="fnameErr">* <?php echo $fnameErr;?></span>
                        </label>
                        <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $_POST['fname'];?>" minlength="3" maxlength="20" required >
                    </div>
                    <div class="col-md-8">
                        <label for="lname" class="form-label">Last name
                            <span class="error" id="lnameErr">* <?php echo $lnameErr;?></span>
                        </label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $_POST['lname'];?>" minlength="3" maxlength="20" required>
                    </div>
                    <div class="col-md-8">
                        <label for="fullName" class="form-label">Full name
                            <span class="error"><?php echo $fullNameErr;?></span>
                        </label>
                        <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo "{$_POST['fname']} {$_POST['lname']}";?>" disabled>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit" >Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>