<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$idComptable = $_SESSION['idComptable'];
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch($action) {
case 'afficherFichesFrais':
    include 'vues/vuesComptables/v_filtreFicheFrais.php';
    $lesVisiteurs = $pdo->getTableauVisiteur();
    foreach ($lesVisiteurs as $unVisiteur) {
        $idVisiteur = $unVisiteur['id'];
        $visiteur = $unVisiteur['nom'] . " " . $unVisiteur['prenom'];
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        foreach ($lesMois as $unMois) {
            $mois = $unMois['mois'];
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFraisPaiement($idVisiteur, $mois);
            if($lesInfosFicheFrais) {
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                $libEtat = $lesInfosFicheFrais['libEtat'];
                $idEtat = $lesInfosFicheFrais['idEtat'];
                $succes = "danger";
                if($idEtat == "VA") {
                    $changementEtat = "Mettre la fiche de frais en Paiement";
                } elseif($idEtat == "MP") {
                    $changementEtat = "Relancer le Paiement";
                }
                else {
                    $changementEtat = "Remboursée";
                    $succes = "succes";
                }
                $montantValide = $lesInfosFicheFrais['montantValide'];
                $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
                include 'vues/vuesComptables/v_etatFraisComptable.php';
            }
        }
    }
    break;
case 'choixVisiteur':
    $leVisiteur= filter_input(INPUT_POST,'IdVisiteur', FILTER_SANITIZE_STRING);
    $idVisiteurCourant = $leVisiteur['id'];
    $lesMois = $pdo->getLesMoisDisponibles($idVisiteurCourant);
    include 'vue/vuesComptable/v_etatFraisComptable.php';

    break;
case 'changerEtat':
    
    break;
case "":
    break;
}