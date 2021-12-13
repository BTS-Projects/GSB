<?php

/**
 * Gestion du suivie des paiements des frais.
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
$idComptable = $_SESSION['idComptable'];
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
    case 'afficherFichesFrais':
        $lesVisiteurs = $pdo->getTableauVisiteur();
        array_unshift($lesVisiteurs, array(
            "nom" => "Tout",
            "prenom" => "Sélectionner",
            "id" => "null"
        ));
        $lesCles = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesCles[0];
        $lesEtats = $pdo->getTableauEtat();
        array_unshift($lesEtats, array(
            "libelle" => "Tout Sélectionner",
            "id" => "null"
        ));
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
                if ($lesInfosFicheFrais) {
                    $numAnnee = $unMois['numAnnee'];
                    $numMois = $unMois['numMois'];
                    $libEtat = $lesInfosFicheFrais['libEtat'];
                    $idEtat = $lesInfosFicheFrais['idEtat'];
                    $btn = "btn btn-danger";
                    if ($idEtat == "VA") {
                        $changementEtat = "Mettre la fiche de frais en Paiement";
                    } elseif ($idEtat == "MP") {
                        $changementEtat = "Relancer le Paiement";
                    } else {
                        $changementEtat = "Remboursée";
                        $btn = "btn btn-success";
                    }
                    $montantValide = $lesInfosFicheFrais['montantValide'];
                    $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
                    include 'vues/vuesComptables/v_etatFraisComptable.php';
                }
            }
        }
        break;
    case 'choixFiltre':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $idEtatCourant = filter_input(INPUT_POST, 'lstEtats', FILTER_SANITIZE_STRING);
        $cpt = 0;

        if ($idVisiteur == "null" && $idEtatCourant != "null") {
            $lesVisiteurs = $pdo->getTableauVisiteur();
            array_unshift($lesVisiteurs, array(
                "nom" => "Tout",
                "prenom" => "Sélectionner",
                "id" => "null"
            ));
            $lesCles = array_keys($lesVisiteurs);
            $visiteurASelectionner = $lesCles[0];
            $lesEtats = $pdo->getTableauEtat();
            array_unshift($lesEtats, array(
                "libelle" => "Tout Sélectionner",
                "id" => "null"
            ));
            $leEtat = $pdo->getEtatById($idEtatCourant);
            $etatASelectionner = $leEtat;
            include 'vues/vuesComptables/v_filtreFicheFrais.php';
            foreach ($lesVisiteurs as $unVisiteur) {
                $idVisiteur = $unVisiteur['id'];
                $visiteur = $unVisiteur['nom'] . " " . $unVisiteur['prenom'];
                $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
                foreach ($lesMois as $unMois) {
                    $mois = $unMois['mois'];
                    $lesInfosFicheFraisDuVisiteur = $pdo->getLesInfosFicheFraisParEtat($idVisiteur, $mois, $idEtatCourant);
                    if ($lesInfosFicheFraisDuVisiteur) {
                        $cpt++;
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        $libEtat = $lesInfosFicheFraisDuVisiteur['libEtat'];
                        $idEtat = $lesInfosFicheFraisDuVisiteur['idEtat'];
                        $btn = "btn btn-danger";
                        if ($idEtat == "VA") {
                            $changementEtat = "Mettre la fiche de frais en Paiement";
                        } elseif ($idEtat == "MP") {
                            $changementEtat = "Relancer le Paiement";
                        } else {
                            $changementEtat = "Remboursée";
                            $btn = "btn btn-success";
                        }
                        $montantValide = $lesInfosFicheFraisDuVisiteur['montantValide'];
                        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFraisDuVisiteur['dateModif']);
                        include 'vues/vuesComptables/v_etatFraisComptable.php';
                    }
                }
            }
        } elseif ($idEtatCourant == "null" && $idVisiteur != "null") {
            $lesVisiteurs = $pdo->getTableauVisiteur();
            array_unshift($lesVisiteurs, array(
                "nom" => "Tout",
                "prenom" => "Sélectionner",
                "id" => "null"
            ));
            $leVisiteur = $pdo->getVisiteurById($idVisiteur);
            $visiteurASelectionner = $leVisiteur;
            $lesEtats = $pdo->getTableauEtat();
            array_unshift($lesEtats, array(
                "libelle" => "Tout Sélectionner",
                "id" => "null"
            ));
            $lesClesEtat = array_keys($lesEtats);
            $etatASelectionner = $lesClesEtat[0];
            include 'vues/vuesComptables/v_filtreFicheFrais.php';

            $visiteur = $unVisiteur['nom'] . " " . $unVisiteur['prenom'];
            $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
            foreach ($lesMois as $unMois) {
                $mois = $unMois['mois'];
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFraisPaiement($idVisiteur, $mois);
                if ($lesInfosFicheFrais) {
                    $cpt++;
                    $numAnnee = $unMois['numAnnee'];
                    $numMois = $unMois['numMois'];
                    $libEtat = $lesInfosFicheFrais['libEtat'];
                    $idEtat = $lesInfosFicheFrais['idEtat'];
                    $btn = "btn btn-danger";
                    if ($idEtat == "VA") {
                        $changementEtat = "Mettre la fiche de frais en Paiement";
                    } elseif ($idEtat == "MP") {
                        $changementEtat = "Relancer le Paiement";
                    } else {
                        $changementEtat = "Remboursée";
                        $btn = "btn btn-success";
                    }
                    $montantValide = $lesInfosFicheFrais['montantValide'];
                    $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
                    include 'vues/vuesComptables/v_etatFraisComptable.php';
                }
            }
        } elseif ($idVisiteur == "null" && $idEtatCourant == "null") {
            $lesVisiteurs = $pdo->getTableauVisiteur();
            array_unshift($lesVisiteurs, array(
                "nom" => "Tout",
                "prenom" => "Sélectionner",
                "id" => "null"
            ));
            $lesCles = array_keys($lesVisiteurs);
            $visiteurASelectionner = $lesCles[0];
            $lesEtats = $pdo->getTableauEtat();
            array_unshift($lesEtats, array(
                "libelle" => "Tout Sélectionner",
                "id" => "null"
            ));
            $lesClesEtat = array_keys($lesEtats);
            $etatASelectionner = $lesClesEtat[0];
            include 'vues/vuesComptables/v_filtreFicheFrais.php';
            foreach ($lesVisiteurs as $unVisiteur) {
                $idVisiteur = $unVisiteur['id'];
                $visiteur = $unVisiteur['nom'] . " " . $unVisiteur['prenom'];
                $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
                foreach ($lesMois as $unMois) {
                    $cpt++;
                    $mois = $unMois['mois'];
                    $lesInfosFicheFrais = $pdo->getLesInfosFicheFraisPaiement($idVisiteur, $mois);
                    if ($lesInfosFicheFrais) {
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        $libEtat = $lesInfosFicheFrais['libEtat'];
                        $idEtat = $lesInfosFicheFrais['idEtat'];
                        $btn = "btn btn-danger";
                        if ($idEtat == "VA") {
                            $changementEtat = "Mettre la fiche de frais en Paiement";
                        } elseif ($idEtat == "MP") {
                            $changementEtat = "Relancer le Paiement";
                        } else {
                            $changementEtat = "Remboursée";
                            $btn = "btn btn-success";
                        }
                        $montantValide = $lesInfosFicheFrais['montantValide'];
                        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
                        include 'vues/vuesComptables/v_etatFraisComptable.php';
                    }
                }
            }
        } else {
            $lesVisiteurs = $pdo->getTableauVisiteur();
            array_unshift($lesVisiteurs, array(
                "nom" => "Tout",
                "prenom" => "Sélectionner",
                "id" => "null"
            ));
            $leVisiteur = $pdo->getVisiteurById($idVisiteur);
            $visiteurASelectionner = $leVisiteur;
            $lesEtats = $pdo->getTableauEtat();
            array_unshift($lesEtats, array(
                "libelle" => "Tout Sélectionner",
                "id" => "null"
            ));
            $leEtat = $pdo->getEtatById($idEtatCourant);
            $etatASelectionner = $leEtat;
            include 'vues/vuesComptables/v_filtreFicheFrais.php';
            $visiteur = $leVisiteur['nom'] . " " . $leVisiteur['prenom'];
            $lesMoisDuVisiteur = $pdo->getLesMoisDisponibles($idVisiteur);
            foreach ($lesMoisDuVisiteur as $unMois) {
                $mois = $unMois['mois'];
                $lesInfosFicheFraisDuVisiteur = $pdo->getLesInfosFicheFraisParEtat($idVisiteur, $mois, $idEtatCourant);
                if ($lesInfosFicheFraisDuVisiteur) {
                    $cpt++;
                    $numAnnee = $unMois['numAnnee'];
                    $numMois = $unMois['numMois'];
                    $libEtat = $lesInfosFicheFraisDuVisiteur['libEtat'];
                    $idEtat = $lesInfosFicheFraisDuVisiteur['idEtat'];
                    $btn = "btn btn-danger";
                    if ($idEtat == "VA") {
                        $changementEtat = "Mettre la fiche de frais en Paiement";
                    } elseif ($idEtat == "MP") {
                        $changementEtat = "Relancer le Paiement";
                    } else {
                        $changementEtat = "Remboursée";
                        $btn = "btn btn-success";
                    }
                    $montantValide = $lesInfosFicheFraisDuVisiteur['montantValide'];
                    $dateModif = dateAnglaisVersFrancais($lesInfosFicheFraisDuVisiteur['dateModif']);
                    include 'vues/vuesComptables/v_etatFraisComptable.php';
                }
            }
        }
        if ($cpt == 0) {
            ajouterErreur('Aucune fiche de frais à afficher');
            include 'vues/v_erreurs.php';
        }

        break;
    case'filtreParEtatUniquement' :
        echo "Bonjour zef";
        break;
    case 'changerEtat':
        $idVisiteur = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $mois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        $idEtat = filter_input(INPUT_GET, 'etat', FILTER_SANITIZE_STRING);
        $lesVisiteurs = $pdo->getTableauVisiteur();
        array_unshift($lesVisiteurs, array(
            "nom" => "Tout",
            "prenom" => "Sélectionner",
            "id" => "null"
        ));
        $leVisiteur = $pdo->getVisiteurById($idVisiteur);
        $visiteurASelectionner = $leVisiteur;
        $lesEtats = $pdo->getTableauEtat();
        array_unshift($lesEtats, array(
            "libelle" => "Tout Sélectionner",
            "id" => "null"
        ));
        $leEtat = $pdo->getEtatById($idEtat);
        $etatASelectionner = $leEtat;
        $success = false;
        if ($idEtat == "VA") {
            $idEtat = "MP";
            $pdo->majEtatFicheFrais($idVisiteur, $mois, $idEtat);
            $success = true;
        } elseif ($idEtat == "MP") {
            $idEtat = "RB";
            $pdo->majEtatFicheFrais($idVisiteur, $mois, $idEtat);
            $success = true;
        } else {
            $succes = false;
            if ($idEtat == "RB") {
                ajouterErreur('Fiche de frais déjà Remboursée, plus de traitement possible');
            } else {
                ajouterErreur('Traitement impossible, etat non conforme');
            }
            include 'vues/vuesComptables/v_filtreFicheFrais.php';
            include 'vues/v_erreurs.php';
        }

        if ($success) {
            ajouterSucces("Changement efectué !");
            include 'vues/vuesComptables/v_filtreFicheFrais.php';
            include 'vues/v_succes.php';
        }
        break;
    case "":
        break;
}