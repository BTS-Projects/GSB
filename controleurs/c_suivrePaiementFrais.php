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
    $lesCles = array_keys($lesVisiteurs);
    $visiteurASelectionner = $lesCles[0];
    $lesEtats = $pdo->getTableauEtat();
    $lesClesEtat = array_keys($lesEtats);
    $etatASelectionner = $lesClesEtat[0];
    include 'vues/vuesComptables/v_filtreFicheFrais.php';
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
case 'choixFiltre':
    $idVisiteurCourant= filter_input(INPUT_POST,'lstVisiteurs', FILTER_SANITIZE_STRING);
    $idEtatCourant= filter_input(INPUT_POST,'lstEtats', FILTER_SANITIZE_STRING);
    $lesVisiteurs = $pdo->getTableauVisiteur();
    $leVisiteur = $pdo->getVisiteurById($idVisiteurCourant);
    $visiteurASelectionner = $leVisiteur;
    $lesEtats = $pdo->getTableauEtat();
    $leEtat = $pdo->getEtatById($idEtatCourant);;
    $etatASelectionner = $leEtat;
    include 'vues/vuesComptables/v_filtreFicheFrais.php';
    $visiteur = $leVisiteur['nom'] . " " . $leVisiteur['prenom'];
    $lesMoisDuVisiteur = $pdo->getLesMoisDisponibles($idVisiteurCourant);
    foreach ($lesMoisDuVisiteur as $unMois) {
            $mois = $unMois['mois'];
            $lesInfosFicheFraisDuVisiteur = $pdo->getLesInfosFicheFraisPaiement($idVisiteurCourant, $mois);
            if($lesInfosFicheFraisDuVisiteur) {
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                $libEtat = $lesInfosFicheFraisDuVisiteur['libEtat'];
                $idEtat = $lesInfosFicheFraisDuVisiteur['idEtat'];
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
                $montantValide = $lesInfosFicheFraisDuVisiteur['montantValide'];
                $dateModif = dateAnglaisVersFrancais($lesInfosFicheFraisDuVisiteur['dateModif']);
                include 'vues/vuesComptables/v_etatFraisComptable.php';
            }
        }

    break;
case 'changerEtat':
    
    break;
case "":
    break;
}