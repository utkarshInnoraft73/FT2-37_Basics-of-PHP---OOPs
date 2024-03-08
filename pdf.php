<?php
require 'vendor/autoload.php';
require 'user.php';

use Fpdf\Fpdf;

if (!empty($_POST['submit'])) {

    /**
     * Create the object of class user.
     * Passing the value of fields.
     * 
     */
    $user = new User($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone']);

    /**
     * Getting the first name.
     */
    $fname = $user->getFirstName();

    /**
     * Getting last name.
     */
    $lname = $user->getLastName();

    /**
     * Getting email.
     */
    $email = $user->getEmail();

    /**
     * Getting phone number.
     */
    $phone = $user->getPhone();

    /**
     * Getting marks.
     */
    $marks = $_POST['marks'];

    // Accessing image
    $imgName = $_FILES['image']['name'];
    $img_temp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($img_temp_name, "Uploads/$imgName");

    // Setting the full name by first name and last name.
    $fullname = "$fname $lname";

    // Accessing Subject and marks
    if (!empty($_POST['marks'])) {
        // Converting the string into array by new line.
        $marks_lines = explode("\n", $_POST['marks']);
    }

    /**
     * Create the new object of class Fpdf.
     */
    $pdf = new Fpdf();

    // Adding The page.
    $pdf->AddPage();
    $pdf->SetFont('Arial', "", 15);
    $pdf->Cell(0, 10, "Registration Detail", 0, 1, "C");

    $pdf->Image("Uploads/$imgName", 135, 22, 65);
    $pdf->Cell(45, 15, "Name: ", 0, 0, "");
    $pdf->Cell(76, 15, $fullname, 0, 1, "");
    $pdf->Cell(45, 15, "Email:", 0, 0, "");
    $pdf->Cell(76, 15, $email, 0, 1, "");
    $pdf->Cell(45, 15, "Phone:", 0, 0, "");
    $pdf->Cell(76, 15, $phone, 0, 1, "");

    $pdf->Cell(0, 10, "Subject marks Details.", 0, 1, "C");
    $pdf->Cell(20, 10, "Srl no.", 1, 0, "C");
    $pdf->Cell(130, 10, "Subject", 1, 0, "C");
    $pdf->Cell(0, 10, "Marks", 1, 1, "C");
    $i = 1;

    // Validating the text area subject marks.
    foreach ($marks_lines as $lines) {
        $parts = explode("|", $lines);
        if (is_numeric($parts[0])) {
            $subject = $parts[1];
            $marks = $parts[0];
        } else {
            $subject = trim($parts[0]);
            $marks = trim($parts[1]);
        }
        $pdf->Cell(20, 10, $i, 1, 0, "C");
        $pdf->Cell(130, 10, $subject, 1, 0, "C");
        $pdf->Cell(0, 10, $marks, 1, 1, "C");
        $i = $i + 1;
    }

    $file = time() . ".pdf";
    $pdf->output();
}
