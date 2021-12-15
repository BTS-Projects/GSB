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
 * @author    Valentine SCHALCKENS <v.schalckens@gmail.com>
 * @author    Julien Lempereur <lempereur.julien83@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
//recupère tous les visireurs avec leurs attributs
$lesNomsvisiteurs = $pdo->getTableauVisiteur();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idComptable = $_SESSION['idComptable'];
//recupère le mois actuel
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);

switch ($action) {
    case 'valideFrais':
        //Id du visiteur sélectionner
        $idVisiteur = $lesNomsvisiteurs[0]['id'];
        $idVisiteurSelectionner = $idVisiteur;
        //Tous les mois du visiteur
        $lesMoisVisiteur = $pdo->getLesMoisDisponiblesCL($idVisiteurSelectionner);

        //Premier Mois du visiteur
        if ($lesMoisVisiteur) {
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
            foreach ($lesFraisForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $idFraisHF = $unFraisHorsForfait['id'];
                $nameMontant = 'montant' . $idFraisHF;
                include 'vues/vuesComptables/v_fraisHorsForfaitComp.php';
            }
        } else {
            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            ajouterErreur("Aucune fiche de frais à validé pour ce visiteur !");
            include 'vues/v_erreurs.php';
        }
        break;

    case 'MoisDispo':
        //recupère le mois choisit par l'utilisateur
        $MoiSelectionner = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        //recupère le visiteur choisit par l'utilisateur
        $idVisiteurSelectionner = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        //recupère tous les mois du visiteur choisi
        $lesMoisVisiteur = $pdo->getLesMoisDisponiblesCL($idVisiteurSelectionner);
        if ($lesMoisVisiteur) {
            if ($MoiSelectionner) {
                $numAnnee = substr($MoiSelectionner, 2, 4);
                $numMois = substr($MoiSelectionner, 0, 2);
                $MoiSelectionner = $numAnnee . $numMois;
            }
            //Change nom de la variable 
            $nomVisiteur = $lesNomsvisiteurs;
            foreach ($lesNomsvisiteurs as $visiteurs) {
                if ($visiteurs['id'] == $idVisiteurSelectionner) {
                    $leVisiteur = $visiteurs;
                }
            }
            $existe = false;
            foreach ($lesMoisVisiteur as $unMois) {
                if ($unMois['mois'] == $MoiSelectionner) {
                    $existe = true;
                }
            }
            if (!$existe) {
                $MoiSelectionner = $lesMoisVisiteur[0]['mois'];
            }

            //Recupère tous les FraisForfait du visiteur choisi
            $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $MoiSelectionner);
            $ETP = $LesFrais[0]['quantite'];
            $KM = $LesFrais[1]['quantite'];
            $NUI = $LesFrais[2]['quantite'];
            $REP = $LesFrais[3]['quantite'];

            //Recupère tous les FraisHorsForfait du visiteur choisi
            $lesFraisForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner);
            
             
            
            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            include 'vues/vuesComptables/v_ElementForfaitises.php';
            foreach ($lesFraisForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $idFraisHF = $unFraisHorsForfait['id'];
                $nameMontant = 'montant' . $idFraisHF;
                $nameLibelle = 'libelle' . $idFraisHF;
                include 'vues/vuesComptables/v_fraisHorsForfaitComp.php';
            }
        } else {
            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            ajouterErreur("Aucune fiche de frais à validé pour ce visiteur !");
            include 'vues/v_erreurs.php';
        }

        break;
    case 'Reinitialise':
        //recupère le mois choisit par l'utilisateur
        $MoiSelectionner = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        //recupère le visiteur choisit par l'utilisateur
        $idVisiteurSelectionner = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
        //recupère tous les mois du visiteur choisi
        $lesMoisVisiteur = $pdo->getLesMoisDisponiblesCL($idVisiteurSelectionner);
        if ($lesMoisVisiteur) {
            if ($MoiSelectionner) {
                $numAnnee = substr($MoiSelectionner, 2, 4);
                $numMois = substr($MoiSelectionner, 0, 2);
                $MoiSelectionner = $numAnnee . $numMois;
            }
            //Change nom de la variable 
            $nomVisiteur = $lesNomsvisiteurs;
            $lesCles = array_keys($lesMoisVisiteur);
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
            foreach ($lesMoisVisiteur as $unMois) {
                if ($unMois['mois'] == $MoiSelectionner) {
                    $existe = true;
                }
            }
            if (!$existe) {

                $MoiSelectionner = $lesMoisVisiteur[0]['mois'];
            }
            //Recupère tous les FraisForfait du visiteur choisi
            $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $MoiSelectionner);
            $ETP = $LesFrais[0]['quantite'];
            $KM = $LesFrais[1]['quantite'];
            $NUI = $LesFrais[2]['quantite'];
            $REP = $LesFrais[3]['quantite'];
            //Recupère tous les FraisHorsForfait du visiteur choisi
            $lesFraisForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner);
            
             
            
            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            include 'vues/vuesComptables/v_ElementForfaitises.php';
            foreach ($lesFraisForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $idFraisHF = $unFraisHorsForfait['id'];
                $nameMontant = 'montant' . $idFraisHF;
                $nameLibelle = 'libelle' . $idFraisHF;
                include 'vues/vuesComptables/v_fraisHorsForfaitComp.php';
            }
        } else {
            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            ajouterErreur("Aucune fiche de frais à validé pour ce visiteur !");
            include 'vues/v_erreurs.php';
        }

        break;

    case 'corrigerElementForfaitises':
        $ETP = filter_input(INPUT_POST, 'ETP', FILTER_SANITIZE_STRING);
        $KM = filter_input(INPUT_POST, 'KM', FILTER_SANITIZE_STRING);
        $NUI = filter_input(INPUT_POST, 'NUI', FILTER_SANITIZE_STRING);
        $REP = filter_input(INPUT_POST, 'REP', FILTER_SANITIZE_STRING);
        $idVisiteurSelectionner = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
        $MoiSelectionner = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);

        $numAnneeActuelle = substr($MoiSelectionner, 0, 4);
        $numMoisActuelle = substr($MoiSelectionner, 4, 2);

        $lesMoisVisiteur = $pdo->getLesMoisDisponiblesCL($idVisiteurSelectionner);
        if ($lesMoisVisiteur) {
            if ($MoiSelectionner) {
                $numAnnee = substr($MoiSelectionner, 2, 4);
                $numMois = substr($MoiSelectionner, 0, 2);
                $MoiSelectionner = $numAnnee . $numMois;
            }

            foreach ($lesNomsvisiteurs as $visiteurs) {
                if ($visiteurs['id'] == $idVisiteurSelectionner) {
                    $leVisiteur = $visiteurs;
                }
            }
            $existe = false;
            foreach ($lesMoisVisiteur as $unMois) {
                if ($unMois['mois'] == $MoiSelectionner) {
                    $existe = true;
                }
            }
            if (!$existe) {
                $MoiSelectionner = $lesMoisVisiteur[0]['mois'];
            }

            $lesNouveauxFrais = array(
                'ETP' => $ETP,
                'KM' => $KM,
                'NUI' => $NUI,
                'REP' => $REP,
            );
            $pdo->majFraisForfait($idVisiteurSelectionner, $MoiSelectionner, $lesNouveauxFrais);

            //Recupère tous les FraisForfait du visiteur choisi
            $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $MoiSelectionner);
            $ETP = $LesFrais[0]['quantite'];
            $KM = $LesFrais[1]['quantite'];
            $NUI = $LesFrais[2]['quantite'];
            $REP = $LesFrais[3]['quantite'];
            //Recupère tous les FraisHorsForfait du visiteur choisi
            $lesFraisForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner);
            
             
            
            ajouterSucces("Les frais forfait ont bien été mis à jour");
            include 'vues/v_succes.php';

            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            include 'vues/vuesComptables/v_ElementForfaitises.php';
            foreach ($lesFraisForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $idFraisHF = $unFraisHorsForfait['id'];
                $nameMontant = 'montant' . $idFraisHF;
                $nameLibelle = 'libelle' . $idFraisHF;
                include 'vues/vuesComptables/v_fraisHorsForfaitComp.php';
            }
        } else {
            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            ajouterErreur("Aucune fiche de frais à validé pour ce visiteur !");
            include 'vues/v_erreurs.php';
        }
        break;
    case 'corrigerFraisHorsForfait' :

        $idVisiteurSelectionner = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
        $MoiSelectionner = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        $idFraisHF = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
        $nameMontant = 'montant' . $idFraisHF;
        $montant = filter_input(INPUT_POST, $nameMontant, FILTER_SANITIZE_STRING);

        $numAnneeActuelle = substr($MoiSelectionner, 2);
        $numMoisActuelle = substr($MoiSelectionner, 0, 2);
        $MoiSelectionner = $numAnneeActuelle . $numMoisActuelle;

        $pdo->majFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner, $montant, $idFraisHF);

        $lesMoisVisiteur = $pdo->getLesMoisDisponiblesCL($idVisiteurSelectionner);
        if ($lesMoisVisiteur) {

            foreach ($lesNomsvisiteurs as $visiteurs) {
                if ($visiteurs['id'] == $idVisiteurSelectionner) {
                    $leVisiteur = $visiteurs;
                }
            }
            $existe = false;
            foreach ($lesMoisVisiteur as $unMois) {
                if ($unMois['mois'] == $MoiSelectionner) {
                    $existe = true;
                }
            }
            if (!$existe) {
                $MoiSelectionner = $lesMoisVisiteur[0]['mois'];
            }
            //Recupère tous les FraisForfait du visiteur choisi
            $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $MoiSelectionner);
            $ETP = $LesFrais[0]['quantite'];
            $KM = $LesFrais[1]['quantite'];
            $NUI = $LesFrais[2]['quantite'];
            $REP = $LesFrais[3]['quantite'];
            //Recupère tous les FraisHorsForfait du visiteur choisi
            $lesFraisForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner);
            
             
            
            ajouterSucces("Les frais hors forfait ont bien été mis à jour");
            include 'vues/v_succes.php';

            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            include 'vues/vuesComptables/v_ElementForfaitises.php';
            foreach ($lesFraisForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $idFraisHF = $unFraisHorsForfait['id'];
                $nameMontant = 'montant' . $idFraisHF;
                $nameLibelle = 'libelle' . $idFraisHF;
                include 'vues/vuesComptables/v_fraisHorsForfaitComp.php';
            }
        } else {
            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            ajouterErreur("Aucune fiche de frais à validé pour ce visiteur !");
            include 'vues/v_erreurs.php';
        }

        break;
    case 'refuserFraisHorsForfait' :
        $idVisiteurSelectionner = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
        $MoiSelectionner = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        $idFraisHF = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);

        $numAnneeActuelle = substr($MoiSelectionner, 2);
        $numMoisActuelle = substr($MoiSelectionner, 0, 2);
        $MoiSelectionner = $numAnneeActuelle . $numMoisActuelle;
        
        $pdo->refusFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner, $idFraisHF);
        $lesMoisVisiteur = $pdo->getLesMoisDisponiblesCL($idVisiteurSelectionner);
        if ($lesMoisVisiteur) {

            foreach ($lesNomsvisiteurs as $visiteurs) {
                if ($visiteurs['id'] == $idVisiteurSelectionner) {
                    $leVisiteur = $visiteurs;
                }
            }
            $existe = false;
            foreach ($lesMoisVisiteur as $unMois) {
                if ($unMois['mois'] == $MoiSelectionner) {
                    $existe = true;
                }
            }
            if (!$existe) {
                $MoiSelectionner = $lesMoisVisiteur[0]['mois'];
            }
            //Recupère tous les FraisForfait du visiteur choisi
            $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $MoiSelectionner);
            $ETP = $LesFrais[0]['quantite'];
            $KM = $LesFrais[1]['quantite'];
            $NUI = $LesFrais[2]['quantite'];
            $REP = $LesFrais[3]['quantite'];
            //Recupère tous les FraisHorsForfait du visiteur choisi
            $lesFraisForfait = $pdo->getLesFraisHorsForfait($idVisiteurSelectionner, $MoiSelectionner);
            

            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            include 'vues/vuesComptables/v_ElementForfaitises.php';
            foreach ($lesFraisForfait as $unFraisHorsForfait) {
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $idFraisHF = $unFraisHorsForfait['id'];
                $nameMontant = 'montant' . $idFraisHF;
                $nameLibelle = 'libelle' . $idFraisHF;
                include 'vues/vuesComptables/v_fraisHorsForfaitComp.php';
            }
        } else {
            include 'vues/vuesComptables/v_choisirLeVisiteur.php';
            ajouterErreur("Aucune fiche de frais à validé pour ce visiteur !");
            include 'vues/v_erreurs.php';
        }
        break;
    case 'validerFicheFrais' :
        $idVisiteurSelectionner = filter_input(INPUT_GET, 'visiteur', FILTER_SANITIZE_STRING);
        $MoiSelectionner = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        
        $pdo->majEtatFicheFrais($idVisiteurSelectionner,$MoiSelectionner,"VA");
        
        
        ajouterSucces(" La fiche est validé ! ");
        include 'vues/v_succes.php';
        
        break;
}

   
        
        