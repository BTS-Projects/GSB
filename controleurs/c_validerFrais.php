
<?php

$lesNomsvisiteurs = $pdo->getTableauVisiteur();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idComptable = $_SESSION['idComptable'];
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

    switch ($action) {
    case 'valideFrais':
        $idVisiteur = $lesNomsvisiteurs[0]['id'];
        $idVisiteurSelectionner = $idVisiteur;
        $lesMoisVisiteur = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
        $moisASelectionner = $lesMoisVisiteur[0];
        $leVisiteur = $lesNomsvisiteurs[0];
        $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $moisASelectionner['mois']);
        $ETP = $LesFrais[0]['quantite'];
        $KM = $LesFrais[1]['quantite'];
        $NUI = $LesFrais[2]['quantite'];
        $REP = $LesFrais[3]['quantite'];
        $lesMois = $lesMoisVisiteur;
        include 'vues/vuesComptables/v_valideFrais.php';
        break;

    case 'MoisDispo':
        $MoiSelectionner = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $idVisiteurSelectionner = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
        $nomVisiteur = $lesNomsvisiteurs;
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
        
        foreach ($lesNomsvisiteurs as $visiteurs) {
            if ($visiteurs['id'] == $idVisiteurSelectionner) {
                $leVisiteur = $visiteurs;
            }
        }
        
        $existe = false;
        $DateAnne = substr($MoiSelectionner,2);
        $DateMois = substr($MoiSelectionner, 0,2);
        $MoiSelectionner = $DateAnne.$DateMois;
        foreach ($lesMois as $unMois) {
            if ($unMois['mois'] == $MoiSelectionner) {
                $existe = true;
            }
        }
        if (!$existe) {

            $MoiSelectionner = $lesMois[0]['mois'];
        }

        $LesFrais = $pdo->getLesFraisForfait($idVisiteurSelectionner, $MoiSelectionner);
//        if($LesFrais == null){
//            $ETP="Vide";
//            $KM ="Vide";
//            $NUI ="Vide";
//            $REP ="Vide";
//        }else{
//        $ETP=$LesFrais[0]['quantite'];
//        $KM = $LesFrais[1]['quantite'];
//        $NUI = $LesFrais[2]['quantite'];
//        $REP = $LesFrais[3]['quantite'];
//        }
        include 'vues/vuesComptables/v_valideFrais.php';
        break;

    case 'selectionnerMois':
        //$idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        // on demande toutes les clés, et on prend la première,
        // les mois étant triés décroissants
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
        include 'vues/v_valideFrais.php';
        break;

    case 'voirEtatFrais':
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
        $moisASelectionner = $leMois;
        include 'vues/v_listeMois.php';
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
        $numAnnee = substr($leMois, 0, 4);
        $numMois = substr($leMois, 4, 2);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
        include 'vues/vuesComptables/v_valideFrais';
        break;
    
    case 'corrigerElement':
        $ETP = filter_input(INPUT_POST,'ETP', FILTER_SANITIZE_STRING);
        $KM = filter_input(INPUT_GET,'KM', FILTER_SANITIZE_STRING);
        $NUI = filter_input(INPUT_GET,'NUI', FILTER_SANITIZE_STRING);
        $REP = filter_input(INPUT_GET,'REP', FILTER_SANITIZE_STRING);
        $idVisiteur = filter_input(INPUT_GET,'id', FILTER_SANITIZE_STRING);
        $mois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        $lesFrais = array(
            'ETP' => $ETP,
            'KM' => $KM,
            'NUI' => $NUI,
            'REP' => $REP,
        );
        $pdo->majFraisForfait($idVisiteur,$mois, $lesFrais);
}

   
        
        