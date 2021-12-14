<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('./images/logo.jpg',90,30,30);
    
    // Line break
    $this->Ln(50);
}

function contenu($idVisiteur, $nomVisiteur, $leMois, $lesFraisHorsForfait, $lesFraisForfait, $montantValide)
{
    $moisEcrit = dateAnneeMoisVersMoisAnneeEcrit($leMois);
    $moisTotal = dateAnglaisVersFrançaisMoisAnnee($leMois);
    //Titre
    $this->SetTextColor(25,65,115);
    $this->SetFont('times','B',13.5);
    $this->Cell(0,6,"REMBOURSEMENT DE FRAIS ENGAGES",1,1,'C');
    
    // couleur noir
    $this->SetTextColor(0,0,0);
    
    // Créer le cadre
    $this->Rect(10, 66, 190, 134);
    $this->SetDrawColor(228,228,228);
    $this->Line(10,69,200,69);
    $this->SetDrawColor(0,0,0);
    
    //Taille et police des lignes visiteur et mois
    $this->SetFont('times','',11);
        $this->SetY(75);
    
    // Data
    $this->SetTextColor(50,50,50);
    $this->SetDrawColor(0,0,0);
    //Ligne Visiteur
    $this->Cell(10, 20, '', 'L');
    $this->Cell(65,20,"Visiteur");
    $this->Cell(50,20,$idVisiteur);
    $this->Cell(27,20,$nomVisiteur,0,0, 'R');
    
    $this->Ln(10);
    
    //Ligne Mois
    $this->Cell(10, 20, '', 'L');
    $this->Cell(65,20,"Mois",0,0);
    // Placeholder Date
    $this->Cell(50,20, utf8_decode($moisEcrit),0,0);
    
    
    //Couleur tableau frais forfaitaires
    $this->SetFont('times','BI',11);
    $this->SetTextColor(25,65,115);
    
    // Noms des colonnes du tableau frais forfaitaires
    $this->SetY(110);
    $this->Cell(10, 20, '', 'L');
    $this->Cell(67,5,"Frais Forfaitaires","LTRB",0, 'C');
    $this->Cell(37,5,utf8_decode("Quantité"),"LTRB",0,'C');
    $this->Cell(35,5,("Montant unitaire"),"LTRB",0,'C');
    $this->Cell(30,5,("Total"),"LTRB",0,'C');
    
    $this->Ln(10);
    
    foreach ($lesFraisForfait as $fraisForfait) {
            $libelle = iconv("UTF-8", "CP1252//TRANSLIT", $fraisForfait['libelle']);
            $quantite = $fraisForfait['quantite'];
            $montant = $fraisForfait['montant'];
            $total = ((int)$quantite * (float)$montant);

            //Couleur des traits en noir
            $this->SetDrawColor(0, 0, 0);

            //Marge
            $this->Cell(10, 10, '', 'L');

            //Couleur des traits en bleu
            $this->SetDrawColor(31, 73, 125);

            $this->Cell(67, 5, $libelle, 'L');
            $this->Cell(37, 5, $quantite, 'L', 0, 'R');
            $this->Cell(35, 5, $montant, 'L', 0, 'R');
            $this->Cell(30, 5, $total, 'LR', 0, 'R');

            //Couleur des traits en noir
            $this->SetDrawColor(0, 0, 0);
            $this->Cell(0, 10, '', 'R');

            $this->Ln(10);

            //Couleur des traits en bleu
            $this->SetDrawColor(31, 73, 125);

            //Marge
            $this->Cell(10, 0);

            //Ligne inférieur
            //$this->Cell($largeurLigne, 0, '', 'T');

            $this->Ln(0);
        }
    $this->Cell(10, 20, '', 'L');
    $this->Cell(169, 35, 'Autres frais','LTRB', 0, 'C');
    // Noms des colonnes du tableau frais forfaitaires
    $this->SetY(150);
    $this->Cell(10, 20, '', 'L');
    $this->Cell(67,5,"Date","LTRB",0, 'C');
    $this->Cell(72,5,utf8_decode("Libellé"),"LTRB",0,'C');
    $this->Cell(30,5,("Montant"),"LTRB",0,'C');
    
    $this->Ln(10);
    
    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $date = $unFraisHorsForfait['date'];
            $libelle = iconv("UTF-8", "CP1252//TRANSLIT", $unFraisHorsForfait['libelle']);
            $montant = $unFraisHorsForfait['montant'];

            //Couleur des traits en noir
            $this->SetDrawColor(0, 0, 0);
            //Marge
            $this->Cell(10, 10, '', 'L');
            //Couleur des traits en bleu
            $this->SetDrawColor(31, 73, 125);
            $this->Cell(67, 5, $date, 'L');
            $this->Cell(72, 5, $libelle, 'L');
            $this->Cell(30, 5, $montant, 'LR', 0, 'R');
            //Couleur des traits en noir
            $this->SetDrawColor(0, 0, 0);
            $this->Cell(0, 10, '', 'R');

            $this->Ln(10);

            //Ligne en dessous des titres

            //Marge
            $this->Cell(10, 0);

            //Couleur des traits en bleu
            $this->SetDrawColor(31, 73, 125);

            //$this->Cell($largeurLigne, 0, '', 'T');

            $this->Ln(0);
        }
    
    //Petit tableau total
    // Couleur Noir et aucun gras/italique
    $this->SetTextColor(0,0,0);
    $this->SetFont('times','',11);
    $this->Cell(113, 0, '');
    // Placeholder Case total date
    $this->Cell(36,5,utf8_decode('TOTAL' . $moisTotal),"LTRB",0,'C');
    $this->Cell(30,5,$montantValide,"LTRB",0,'C');
    
    $this->Ln(20);
    $this->Cell($this->w - 20, 5);
    $this->Cell(0, 5, iconv("UTF-8", "CP1252//TRANSLIT", 'Fait à Paris, le ' . 'date' . ' ' . $moisEcrit));
    }
}