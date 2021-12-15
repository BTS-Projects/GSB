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
 * @author    Julien Lempereur <lempereur.julien83@gmail.com>
 * @author    Valentine SCHALCKENS <v.schalckens@gmail.com>
 * @author    Dorian Dubois<john.doe@example.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<div class="row">
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" action="index.php?uc=validerFrais&action=corrigerElementForfaitises&visiteur=<?= $leVisiteur['id'] ?>&mois=<?= $numAnneeActuelle . $numMoisActuelle ?>" role="form">
            <fieldset>
                <!--les variables sont encore à ajouter pour pouvoir les remplir automatiquement -->
                <?php
                if ($LesFrais == null) {
                    ?>
                    <h2 style="color: red">Le visiteur <strong><?php echo $leVisiteur['nom'] . " " . $leVisiteur['prenom'] ?></strong> ne possède pas de fiche de frais ce mois là</h2>
                    <?php
                } else {
                    ?>
                    <p style="margin-left: 10px">Forfait Etape</p>
                    <input type="text" name="ETP" style="margin-left: 10px;border-radius: 5px" maxlength="5" value="<?php echo $ETP ?>">
                    <p style="margin-left: 10px">Frais Kilometrique</p>
                    <input type="text" name="KM" style="margin-left: 10px;border-radius: 5px" maxlength="5" value=" <?php echo $KM ?>">      
                    <p style="margin-left: 10px">Nuitée Hôtel</p>
                    <input type="text" name="NUI" style="margin-left: 10px;border-radius: 5px" maxlength="5" value="<?php echo $NUI ?>">
                    <p style="margin-left: 10px">Repas Restaurant</p>
                    <input type="text" name="REP" style="margin-left: 10px;border-radius: 5px" maxlength="5" value="<?php echo $REP ?>">
                </fieldset>
            <br>
                <button id="BtnCorriger" class="btn btn-success" type="submit" >Corriger</button>
                <a id="BtnReset"  class="btn btn-danger" role="button" href="index.php?uc=validerFrais&action=Reinitialise&visiteur=<?= $leVisiteur['id'] ?>&mois=<?= $numMoisActuelle . $numAnneeActuelle ?>">Réinitialiser</a>
                <?php
            }
            ?>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <h3> Eléments Hors Forfait :</h3>
</div>