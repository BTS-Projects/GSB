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
    //Titre
    $this->SetTextColor(25,65,115);
    $this->SetFont('times','B',13);
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
    $this->SetFont('times','',11);
        $this->SetY(75);
    
    // Data
    $this->SetTextColor(50,50,50);
    $this->SetDrawColor(0,0,0);
    //Ligne Visiteur
    $this->Cell(10, 20, '', 'L');
    $this->Cell(65,20,"Visiteur");
    // Placeholder id visiteur
    $this->Cell(50,20,"NRD/A-131");
    // Placeholder PrenomNOM visiteur
    $this->Cell(27,20,"LouisVILLECHALANE",0,0, 'R');
    
    $this->Ln(10);
    
    //Ligne Mois
    $this->Cell(10, 20, '', 'L');
    $this->Cell(65,20,"Mois",0,0);
    // Placeholder Date
    $this->Cell(50,20,"Juillet2021",0,0);
    
    }
    public function FraisTablo($header){
    //Couleur tableau frais forfaitaires
    $this->SetFont('times','I',11);
    $this->SetTextColor(25,65,115);
    
    // Noms des colonnes du tableau frais forfaitaires
    $this->SetY(110);
    $this->Cell(10, 20, '', 'L');
    $this->Cell(67,5,"Frais Forfaitaires","LTRB",0, 'C');
    $this->Cell(37,5,utf8_decode("Quantité"),"LTRB",0,'C');
    $this->Cell(35,5,utf8_decode("Montant unitaire"),"LTRB",0,'C');
    $this->Cell(30,5,utf8_decode("Total"),"LTRB",0,'C');
    
    $this->Ln(5);
    
    // Boucle for each à faire pour parcourir les différents frais
    
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