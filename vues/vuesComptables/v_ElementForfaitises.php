<?php
/**
 * Gestion de la déconnexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @author Julien Lempereur <lempereur.julien83@gmail.com>
 * @author Valentine SCHALCKENS <v.schalckens@gmail.com>
 * @author Dorian Dubois<john.doe@example.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<div>
<h3>Eléments forfaitisés</h3>
<div class="col-md-4">
    <form method="post" action="index.php?uc=validerFrais&action=elementForfaitise" role="form">
        <!--les variables sont encore à ajouter pour pouvoir les remplir automatiquement -->
        <?php 
        if($LesFrais == null){
            ?>
        <h2 style="color: red">Le visiteur <strong><?php echo $leVisiteur['nom']. " " . $leVisiteur['prenom']?></strong> ne possède pas de fiche de frais ce mois là</h2>
        <?php 
        }
        else{
            $ETP=$LesFrais[0]['quantite'];
            $KM = $LesFrais[1]['quantite'];
            $NUI = $LesFrais[2]['quantite'];
            $REP = $LesFrais[3]['quantite'];
            $Nouv=$LesFrais;
        ?>
        <p style="margin-left: 10px">Forfait Etape</p>
        <input method="post" type="text" name="ETP" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value="<?php echo $ETP?>">
        <p><?php echo filter_input(INPUT_POST,'ETP', FILTER_SANITIZE_STRING)?></p>
        <p style="margin-left: 10px">Frais Kilometrique</p>
        <input type="text" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value=" <?php echo $KM?>">      
        <p style="margin-left: 10px">Nuitée Hôtel</p>
        <input type="decimal" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value="<?php echo $NUI?>">
        <p style="margin-left: 10px">Repas Restaurant</p>
        <input type="decimal" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value="<?php echo $REP?>">
        <br>
        <!-- style="background-color: green;color:white;margin-top: 5px;margin-left: 10px" -->
<!--        <input type="submit" value="Corriger" class="btn btn-success" href="index.php?uc=validerFrais&action=corrigerElement&id=<?=$idVisiteurSelectionner?>&mois=<?=$Date?>"> -->
        <a class="btn btn-success" action="submit()" href="index.php?uc=validerFrais&action=corrigerElementForfaitises&id=<?=$idVisiteurSelectionner?>&mois=<?=$Date?>" type="button" >Corriger</a>
        <a class="btn btn-danger" type="reset" href="index.php?uc=validerFrais&action=Reinitialise&visiteur=<?= $leVisiteur['id'] ?>&mois=<?= $numMoisActuelle . $numAnneeActuelle?>">Réinitialiser</a>
        <?php }
        unset($ETP,$KM,$NUI,$REP);
        ?>
</div>
</div>