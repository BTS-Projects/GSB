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
    $this->SetFont('times','B',14);
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
    $this->Cell(25,10,"Visiteur",0,0);
    // Placeholder id visiteur
    $this->SetX(-130);
    $this->Cell(25,10,"NRD/A-131",0,0);
    // Placeholder PrenomNOM visiteur
    $this->SetX(-95);
    $this->Cell(25,10,"LouisVILLECHALANE",0,0);
    
    $this->Ln();
    $this->SetX(-180);
    $this->Cell(25,10,"Mois",0,0);
    // Placeholder Date
    $this->SetX(-130);
    $this->Cell(25,10,"Juillet2021",0,0);
    
    }
    public function FraisTablo($header){
    //Header
    $this->SetFont('times','I',12);
    $this->SetTextColor(25,65,115);
        $this->SetY(108);
        $this->SetX(42);
        $this->Cell(0,0,"Frais Forfaitaires",0,0,'L');
    $this->SetFont('times','I',12);
    $this->SetTextColor(25,65,115);
        $this->SetY(108);
        $this->SetX(92);
        $this->Cell(0,0,utf8_decode("Quantité"),0,0,'L');
    
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

$headerGrdTablo = array('');
$headerContenuTablo = array('');
$headerFraisTablo = array('');

$pdf->GrandTableau($headerGrdTablo);
$pdf->ContenuTablo($headerContenuTablo);
$pdf->FraisTablo($headerFraisTablo);


$pdf->Output();
?>