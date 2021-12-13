
<?php
//recupère tous les visireurs avec leurs attributs
$lesNomsvisiteurs = $pdo->getTableauVisiteur();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idComptable = $_SESSION['idComptable'];
//recupère le mois acutelle
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$action2=filter_input(INPUT_GET, 'action2', FILTER_SANITIZE_STRING);

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
                
                switch ($action2) {
                case'RenistialiserElementForfaitises':
                $leVisiteur = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
                $mois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
                //$LesFrais = $pdo->getLesFraisForfait($idVisiteur, $mois);
                include 'vues/vuesComptables/v_choisirLeVisiteur.php';
                header("Refresh:0; url='vues/vuesComptables/v_ElementForfaitises.php'");
                include 'vues/vuesComptables/v_descriptifHorsForfait.php';
                
        break;
        }
        
//    case 'selectionnerMois':
//        //$idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
//        $idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
//        $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
//        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
//        // on demande toutes les clés, et on prend la première,
//        // les mois étant triés décroissants
//        $lesCles = array_keys($lesMois);
//        $moisASelectionner = $lesCles[0];
//        include 'vues/v_valideFrais.php';
//        break;

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

    case 'corrigerElementForfaitises':
        $ETP = filter_input(INPUT_POST, 'ETP', FILTER_SANITIZE_STRING);
        $ETP = $_POST['ETP'];
        $KM = filter_input(INPUT_GET, 'KM', FILTER_SANITIZE_STRING);
        $NUI = filter_input(INPUT_GET, 'NUI', FILTER_SANITIZE_STRING);
        $REP = filter_input(INPUT_GET, 'REP', FILTER_SANITIZE_STRING);
        $idVisiteur = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $mois = filter_input(INPUT_GET, 'mois', FILTER_SANITIZE_STRING);
        $lesFrais = array(
            'ETP' => $ETP,
            'KM' => $KM,
            'NUI' => $NUI,
            'REP' => $REP,
        );
        $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
}

   
        
        