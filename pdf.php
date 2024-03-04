<?php

require 'vendor/autoload.php';

use Fpdf\Fpdf;

if (!empty($_POST['submit'])) {
    $fnameErr = $lnameErr=$emailErr=$phoneErr = "";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $marks = $_POST['marks'];
    $imgName = $_FILES['image']['name'];
    $img_temp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($img_temp_name, "Uploads/$imgName");
    
    // Setting the full name by first name and last name.
    $fullname = "$fname $lname";

    // Accessing Subject and marks
    if (!empty($_POST['marks'])) {
        // Converting the string into array by new line.
        $marks_lines = explode("\n", $_POST['marks']);
    } else {

        $errMsg = "Marks is not entered.";
    }



    $pdf = new Fpdf();
    $pdf->AddPage();

    $pdf->SetFont('Arial', "", 15);
    $pdf->Cell(0, 10, "Registration Detail", 0, 1, "C");

    // $pdf->cell(0,60, "$imgName",1,1, "C",);
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
    foreach ($marks_lines as $lines) {
        $parts = explode("|", $lines);
        $subject = trim($parts[0]);
        $marks = trim($parts[1]);
        $pdf->Cell(20, 10, $i, 1, 0, "C");
        $pdf->Cell(130, 10, $subject, 1, 0, "C");
        $pdf->Cell(0, 10, $marks, 1, 1, "C");
        $i = $i + 1;
    }


    $file = time() . ".pdf";
    $pdf->output();
}
