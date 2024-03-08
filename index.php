<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assignment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center my-5">
            <div class="col-6">
                <form class="row g-3 needs-validation" action="pdf.php" method="post" enctype="multipart/form-data"  onsubmit="return checkInputs()">
                    <!-- <p class="text-center text-danger" id="errMsg"></p> -->
                    <div class="col-md-8">
                        <label for="validationCustom01" class="form-label">First name
                            <span class="require" id="fnameErr">*</span>
                        </label>
                        <input type="text" class="form-control item" id="fname" name="fname"  value="" minlength="3" maxlength="20" required>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Last name
                        <span class="require" id="lnameErr">*</span>
                        </label>
                        <input type="text" class="form-control item" id="lname" name="lname"  value="" minlength="3" maxlength="20" required>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Email
                        <span class="require" id="emailErr">*</span>
                        </label>
                        <input type="text" class="form-control item" id="email" name="email" value="" maxlength="40" required>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Phone
                        <span class="require" id="phoneErr">*</span>
                        </label>
                        <input type="text" class="form-control item" id="phone" name="phone" value="" maxlength="13" required>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom02" class="form-label">Upload image
                        </label>
                        <input type="file" class="form-control item" name="image" accept="image/*" required>
                    </div>
                    <div class="col-md-8">
                        <label for="floatingTextarea2">Subject marks (Format: Subject|Marks)
                            <span class="require" id="marksErr">*</span>
                        </label>
                        <div class="form-floating">
                            <textarea class="form-control" id="marks" style="height: 100px" name="marks" required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- <button class="btn btn-primary" type="submit" >Submit form</button> -->
                        <input type="submit" name="submit" >
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>