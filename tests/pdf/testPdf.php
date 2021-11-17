<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',90,30,30);
    
    // Line break
    $this->Ln(50);
}

function GrandTableau($header)
{
    //Header
    $this->SetTextColor(25,65,115);
    $this->SetFont('times','B',13);
    $this->SetX(-190);
    $this->Cell(171,6,"REMBOURSEMENT DE FRAIS ENGAGES",1,0,'C');
    $this->Ln();
    
    // Data
    $this->SetTextColor(50,50,50);
    
    $this->Rect(20, 66, 171, 134);
    $this->SetDrawColor(228,228,228);
    $this->Line(20,69,191,69);
    $this->SetDrawColor(0,0,0);
    
}


public function ContenuTablo($header){
    //Header
    $this->SetFont('times','',12);
        $this->SetY(75);
        $this->SetX(-190);
        $this->Cell(0,0,"",0,0,'C');
    
    // Data
    $this->SetTextColor(50,50,50);
    $this->SetX(-180);
    $this->SetDrawColor(0,0,0);
    $this->Cell(25,10,"",0,0);
    }
}
// Instanciation of inherited class
$pdf = new PDF();
$pdf->AddPage();

$headerGrdTablo = array(' REMBOURSEMENT DE FRAIS ENGAGES');
$headerContenuTablo = array('');

$pdf->GrandTableau($headerGrdTablo);
$pdf->ContenuTablo($headerContenuTablo);


$pdf->Output();
?>