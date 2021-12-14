<?php
/**
 * Gestion de l'affichage des frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @author Valentine SCHALCKENS <v.schalckens@gmail.com>
 * @author Julien Lempereur <lempereur.julien83@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

//recupère tous les visireurs avec leurs attributs
$lesNomsvisiteurs = $pdo->getTableauVisiteur();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idComptable = $_SESSION['idComptable'];
//recupère le mois acutelle
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    case 'valideFrais':
        //Id du visiteur sélectionner
        $idVisiteur = $lesNomsvisiteurs[0]['id'];
        $idVisiteurSelectionner = $idVisiteur;
        //Tous les mois du visiteur
        $lesMoisVisiteur = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
        //Premier Mois du visiteur
        $moisASelectionner = $lesMoisVisiteur[0];
        //Prend le tous premier Visteur de la liste
        $leVisiteur = $lesNomsvisiteurs[0];
        //Recupère tous les frais de ce visiteur
        $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $moisASelectionner['mois']);
        $ETP = $LesFrais[0]['quantite'];
        $KM = $LesFrais[1]['quantite'];
        $NUI = $LesFrais[2]['quantite'];
        $REP = $LesFrais[3]['quantite'];
        $lesMois = $lesMoisVisiteur;
        $lesFraisForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner, $moisASelectionner['mois']);
        include 'vues/vuesComptables/v_choisirLeVisiteur.php';
        include 'vues/vuesComptables/v_ElementForfaitises.php';
        include 'vues/vuesComptables/v_descriptifHorsForfait.php';
        break;

    case 'MoisDispo':
        //recupère le mois choisit par l'utilisateur
        $MoiSelectionner = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        //recupère le visiteur choisit par l'utilisateur
        $idVisiteurSelectionner = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        //recupère tous les mois du visiteur choisi
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
        //Change nom de la variable 
        $nomVisiteur = $lesNomsvisiteurs;
        $lesCles = array_keys($lesMois);
        //$moisASelectionner = $lesCles[0];
        foreach ($lesNomsvisiteurs as $visiteurs) {
            if ($visiteurs['id'] == $idVisiteurSelectionner) {
                $leVisiteur = $visiteurs;
            }
        }
        $existe = false;
        $DateAnne = substr($MoiSelectionner, 2);
        $DateMois = substr($MoiSelectionner, 0, 2);
        $MoiSelectionner = $DateAnne . $DateMois;
        foreach ($lesMois as $unMois) {
            if ($unMois['mois'] == $MoiSelectionner) {
                $existe = true;
            }
        }
        if (!$existe) {
            $MoiSelectionner = $lesMois[0]['mois'];
        }
        //Recupère tous les FraisForfait du visiteur choisi
        $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $MoiSelectionner);
        //Recupère tous les FraisHorsForfait du visiteur choisi
        $lesFraisForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner);
        include 'vues/vuesComptables/v_choisirLeVisiteur.php';
        include 'vues/vuesComptables/v_ElementForfaitises.php';
        include 'vues/vuesComptables/v_descriptifHorsForfait.php';

        //        switch ($action2) {
        //            case'RenistialiserElementForfaitises':
        //                $leVisiteur = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        //                $mois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        ////$LesFrais = $pdo->getLesFraisForfait($idVisiteur, $mois);
        //                include 'vues/vuesComptables/v_choisirLeVisiteur.php';
        //                header("Refresh:0; url='vues/vuesComptables/v_ElementForfaitises.php'");
        //                include 'vues/vuesComptables/v_descriptifHorsForfait.php';
        //                break;
        //        }

        break;
    case 'Reinitialise':
        //recupère le mois choisit par l'utilisateur
        $MoiSelectionner = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        //recupère le visiteur choisit par l'utilisateur
        $idVisiteurSelectionner = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
        //recupère tous les mois du visiteur choisi
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
        //Change nom de la variable 
        $nomVisiteur = $lesNomsvisiteurs;
        $lesCles = array_keys($lesMois);
        //$moisASelectionner = $lesCles[0];
        foreach ($lesNomsvisiteurs as $visiteurs) {
            if ($visiteurs['id'] == $idVisiteurSelectionner) {
                $leVisiteur = $visiteurs;
            }
        }
        $existe = false;
        $DateAnne = substr($MoiSelectionner, 2);
        $DateMois = substr($MoiSelectionner, 0, 2);
        $MoiSelectionner = $DateAnne . $DateMois;
        foreach ($lesMois as $unMois) {
            if ($unMois['mois'] == $MoiSelectionner) {
                $existe = true;
            }
        }
        if (!$existe) {

            $MoiSelectionner = $lesMois[0]['mois'];
        }
        //Recupère tous les FraisForfait du visiteur choisi
        $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $MoiSelectionner);
        //Recupère tous les FraisHorsForfait du visiteur choisi
        $lesFraisForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner);
        include 'vues/vuesComptables/v_choisirLeVisiteur.php';
        include 'vues/vuesComptables/v_ElementForfaitises.php';
        include 'vues/vuesComptables/v_descriptifHorsForfait.php';

        break;

    case 'corrigerElementForfaitises':
        $ETP = filter_input(INPUT_POST, 'ETP', FILTER_SANITIZE_STRING);
        //$ETP = $_POST['ETP'];
        $KM = filter_input(INPUT_POST, 'KM', FILTER_SANITIZE_STRING);
        $NUI = filter_input(INPUT_POST, 'NUI', FILTER_SANITIZE_STRING);
        $REP = filter_input(INPUT_POST, 'REP', FILTER_SANITIZE_STRING);
        $idVisiteurSelectionner = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
        $mois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        $lesFrais = array(
            'ETP' => $ETP,
            'KM' => $KM,
            'NUI' => $NUI,
            'REP' => $REP,
        );
        $pdo->majFraisForfait($idVisiteurSelectionner, $mois, $lesFrais);
//        $idVisiteur = filter_input(INPUT_POST, 'idVisiteur', FILTER_SANITIZE_STRING);
//        $mois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
//        $numMoisActuelle = filter_input(INPUT_POST, 'numMois', FILTER_SANITIZE_STRING);
//        $numAnneeActuelle = filter_input(INPUT_POST, 'numAnnee', FILTER_SANITIZE_STRING);
//        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
//        if (lesQteFraisValides($lesFrais)) {
//            $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
//        } else {
//            ajouterErreur('Les valeurs des frais doivent être numériques');
//            include 'vues/v_erreurs.php';
//        }
        include 'vues/vuesComptables/v_choisirLeVisiteur.php';
        include 'vues/vuesComptables/v_listeFraisForfaitComp.php';
        include 'vues/vuesComptables/v_descriptifHorsForfait.php';
        break;
}

   
        
        