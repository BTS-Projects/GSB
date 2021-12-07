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
    $this->Cell(0,6,"REMBOURSEMENT DE FRAIS ENGAGES",1,1,'C');
    
    // Data
    $this->SetTextColor(50,50,50);
    
    // Créer le cadre
    $this->Rect(10, 66, 190, 134);
    $this->SetDrawColor(228,228,228);
    $this->Line(10,69,200,69);
    $this->SetDrawColor(0,0,0);
    
}


public function ContenuTablo($header){
    //Header
    $this->SetFont('times','',12);
        $this->SetY(75);
    
    // Data
    $this->SetTextColor(50,50,50);
    $this->SetDrawColor(0,0,0);
    //Ligne Visiteur
    $this->Cell(10, 20, '', 'L');
    $this->Cell(50,20,"Visiteur");
    // Placeholder id visiteur
    $this->Cell(50,20,"NRD/A-131");
    // Placeholder PrenomNOM visiteur
    $this->Cell(25,20,"LouisVILLECHALANE",0,1);
    
    //Ligne Mois
    $this->Cell(10, 20, '', 'L');
    $this->Cell(50,20,"Mois",0,0);
    // Placeholder Date
    $this->Cell(50,20,"Juillet2021",0,0);
    
    }
    public function FraisTablo($header){
    //Header
    $this->SetFont('times','I',12);
    $this->SetTextColor(25,65,115);
        $this->SetY(108);
        $this->Cell(0,0,"Frais Forfaitaires",0,0,'L');
    $this->SetFont('times','I',12);
    $this->SetTextColor(25,65,115);
        $this->SetY(108);
        $this->Cell(0,0,utf8_decode("Quantité"),0,0,'L');
    
    // Data
    $this->SetTextColor(50,50,50);
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