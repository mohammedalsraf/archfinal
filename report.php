<?php

require_once('tcpdf/tcpdf.php');

require("conn.php");
// Fetch data from the database (assuming you have a 'title' table)
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Initialize the PDF
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');
$pdf->SetCreator('Your Creator');
$pdf->SetAuthor('Your Author');
$pdf->SetTitle('Your Report Title');
$pdf->SetSubject('Your Subject');
$pdf->SetKeywords('Your Keywords');

// Add a page
$pdf->AddPage();



// Set font for titles
$pdf->SetFont('dejavusans', 'B', 14);
$pdf->Cell(0, 10, 'تقرير المستندات والكتب الالكترونية ', 0, 1, 'C');

// Add the column names as titles in the PDF
$pdf->Cell(40, 10, 'نوع الكتاب', 1, 0, 'C');
$pdf->Cell(40, 10, 'رقم الكتاب', 1, 0, 'C');
$pdf->Cell(40, 10, 'تاريخ الكتاب', 1, 0, 'C');
$pdf->Cell(40, 10, 'القسم الصادر ', 1, 0, 'C');
$pdf->Cell(40, 10, 'درجة السرية', 1, 0, 'C');
$pdf->Cell(40, 10, 'اخر تحديث', 1, 0, 'C');
$pdf->Cell(40, 10, 'اسم المستخدم', 1, 0, 'C');

// Repeat the above line for other columns

// Set font for data
$pdf->SetFont('dejavusans', '', 12);

// Loop through the data and print it in the PDF
while ($row = $result->fetch_assoc()) {
    // Replace 'column_name' with the appropriate column names from your 'title' table
    $pdf->Ln(); // Move to the next line
    $pdf->Cell(40, 10, $row['doctype'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['docnumber'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['date'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['dep'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['sery'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['updateup'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['username'], 1, 0, 'C');
   
   
    // Repeat the above line for other columns
}

// Output the PDF to the browser with the Arabic content
$pdf->Output('arabic_report.pdf', 'D');

$conn->close();
?>
