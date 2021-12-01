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
    $lesVisiteurs = $pdo->getTableauVisiteur();
    foreach ($lesVisiteurs as $unVisiteur) {
        $lesMois = $pdo->getLesMoisDisponibles($unVisiteur['id']);
        foreach ($lesMois as $unMois) {
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($unVisiteur, $unMois);
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
            include 'vues/vuesComptables/v_etatFraisComptable.php';
        }
    }
    break;
case 'selectionnerMois':
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