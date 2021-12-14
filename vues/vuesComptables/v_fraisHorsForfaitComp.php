<?php
/**
 * Vue Liste des frais hors forfait
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
?>
<hr>
<div>
    <div class="col-md-4">
        <h3> Eléments Hors Forfait :</h3>
        <div class="panel panel-info">
            <div class="panel-heading">Descriptif des éléments hors forfait</div>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>  
                        <th class="montant">Montant</th>  
                        <th class="action">&nbsp;</th>
                    </tr>
                </thead>  
                <tbody>
                    <?php
                    foreach ($lesFraisForfait as $unFraisHorsForfait) {
                        $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                        $date = $unFraisHorsForfait['date'];
                        $montant = $unFraisHorsForfait['montant'];
                        $id = $unFraisHorsForfait['id'];
                        ?>           
                        <tr>
                            <td> <input type="text" disabled="disabled" style="border-radius: 5px" maxlength="5" value="<?= $date ?>"></td>
                            <td> <input type="text" disabled="disabled" style="border-radius: 5px" maxlength="5" value="<?= $libelle ?>"></td>
                            <td> <input type="text" style="border-radius: 5px" maxlength="5" value="<?= $montant ?>"></td>
                            <td>
                                <a class="btn btn-success" href="index.php?uc=validerFrais&action=corrigerFraisHorsForfait&visiteur=<?= $leVisiteur['id'] ?>&mois=<?= $numMoisActuelle . $numAnneeActuelle ?>&idFrais=<?= $id ?>" 
                                   onclick="return confirm('Voulez-vous vraiment corriger ce frais?');" name="btnCorrigerFrais" role="button">Corriger</a>
                                <a class="btn btn-danger" href="index.php?uc=validerFrais&action=refuserFraisHorsForfait&visiteur=<?= $leVisiteur['id'] ?>&mois=<?= $numMoisActuelle . $numAnneeActuelle ?>&idFrais=<?= $id ?>" 
                                   onclick="return confirm('Voulez-vous vraiment refuser ce frais?');" name="btnRefuserFrais" role="button">Refuser</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>  
            </table>
        </div>
    </div>
</div>
