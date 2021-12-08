
<?php
$lesNomsvisiteurs = $pdo->getTableauVisiteur();
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$idComptable = $_SESSION['idComptable'];
$mois = getMois(date('d/m/Y'));
$numAnnee= substr($mois, 0,4);
$numMois = substr($mois, 4, 2);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);


switch ($action) {
    case 'valideFrais':
        $idVisiteur=$lesNomsvisiteurs[0]['id'];
        $idVisiteurSelectionner=$idVisiteur;
        $lesMoisVisiteur = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
        $moisASelectionner = $lesMoisVisiteur[0];
        $leVisiteur=$lesNomsvisiteurs[0];
        $lesMois = $lesMoisVisiteur;
        include 'vues/vuesComptables/v_valideFrais.php';
        break;
    
    case 'MoisDispo':
        $idVisiteurSelectionner = $_POST['visiteur'];
        $MoiSelectionner = $_POST['lstMois'];
        $nomVisiteur=$lesNomsvisiteurs;
        $lesMois = $pdo->getLesMoisDisponibles($idVisiteurSelectionner);
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
        foreach ($lesNomsvisiteurs as $visiteurs){
        if($visiteurs['id']==$idVisiteurSelectionner){
            $leVisiteur = $visiteurs;
        }
        }
        include 'vues/vuesComptables/v_valideFrais.php';
        break;
        
    case 'afficherElement':
        echo "salut";
        break;
        
    case 'selectionnerMois':
    //$idVisiteur = filter_input(INPUT_POST, 'visiteur', FILTER_SANITIZE_STRING);
    $idVisiteur = $_POST['visiteur'];
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
    
}

   
        
        