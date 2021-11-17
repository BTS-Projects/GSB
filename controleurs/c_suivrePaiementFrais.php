<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$idComptable = $_SESSION['idComptable'];
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idVisiteurCourant = "";
switch($action) {
case 'choisirVisiteur':
        $lesVisiteurs = $pdo->getLesNomsVIsiteurs();
        $lesCles = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesCles[0];     
        include 'vue/vuesComptables/v_listeVisiteurs.php';
    break;
case 'selectionnerMois':
    $leVisiteur = filter_input(INPUT_POST,'IdVisiteur', FILTER_SANITIZE_STRING);
    $lesMois = $pdo->getLesMoisDesponibles($leVisteur['id']);
    break;
case 'afficherFrais':
    break;
case 'changerEtat':
    
    break;
case "":
    break;
}