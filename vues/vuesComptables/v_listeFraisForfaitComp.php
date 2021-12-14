<?php
/**
 * Vue Liste des frais au forfait
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @author    Valentine SCHALCKENS <v.schalckens@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<div class="row">
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" 
              action="index.php?uc=validerFrais&action=corrigerElementForfaitises&idVisiteur=<?= $leVisiteur['id'] ?>&mois=<?=$Date?>&numMois=<?= $numMoisActuelle ?>&numAnnee=<?=  $numAnneeActuelle ?>" 
              role="form">
            <fieldset>       
                <?php
                foreach ($LesFrais as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite']; ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>       
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit" name="AlisteFrais">Ajouter</button>
                <button class="btn btn-danger" type="reset" name="ElisteFrais">Effacer</button>
            </fieldset>
        </form>
    </div>
</div>
