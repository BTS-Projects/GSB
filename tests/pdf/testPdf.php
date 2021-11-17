<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',90,30,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    
    // Line break
    $this->Ln(50);
}
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}

function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->SetX(-180);
        $this->Cell(150,7,$col,1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->SetX(-180);
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage();
$header = array(' REMBOURSEMENT DE FRAIS ENGAGES');
$pdf->SetFont('times','',14);
$data = $pdf->LoadData('E:\BTS SIO 2\AP\CONTEXTE1\GSB_AppliMVC\tests\pdf\test.txt');
$pdf->BasicTable($header,$data);

$pdf->Output();
?>