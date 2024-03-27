<?php
session_start();
require('fpdf186/fpdf.php');

$email = $_SESSION['email'];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM donors WHERE email='$email'";
$result = $conn->query($sql);

$pdf = new FPDF();
$pdf->AddPage();

// Set font styles
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(230, 230, 230);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0);

// Table header
$pdf->Cell(60, 12, 'Name', 1, 0, 'C', true);
$pdf->Cell(60, 12, 'Last Name', 1, 0, 'C', true);
$pdf->Cell(60, 12, 'Amount', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);
$fill = false; // To alternate row background colors
while ($row = $result->fetch_assoc()) {
    // Fill table with data
    $pdf->Cell(60, 12, $row['name'], 1, 0, 'C', $fill);
    $pdf->Cell(60, 12, $row['last_name'], 1, 0, 'C', $fill);
    $pdf->Cell(60, 12, '$' . $row['amount'], 1, 1, 'C', $fill);
    $fill = !$fill; // Toggle row fill
}

$pdf->SetY(-30); // Set position at 2.5 cm from the bottom
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, 'Thank you for your generous support!', 0, 1, 'C');

$pdfFileName = 'donation_table.pdf';
$pdf->Output('D', $pdfFileName);

$conn->close();
?>
