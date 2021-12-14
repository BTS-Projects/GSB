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
<div class="row">
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
                $id = $unFraisHorsForfait['id']; ?>           
                <tr>
                    <td> <input  type="decimal" style="border-radius: 5px" maxlength="5,2" value="<?php echo $date ?>"></td>
                    <td> <input type="decimal" style="border-radius: 5px" maxlength="5,2" value="<?php echo $libelle ?>"></td>
                    <td> <input type="decimal" style="border-radius: 5px" maxlength="5,2" value="<?php echo $montant ?>"></td>
                    <td><a href="index.php?uc=validerFrais&action=corrigerFraisHorsForfait&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraiment corriger ce frais?');" name="btnSupprimerFrais">Corriger</a></td>
                    <td><a href="index.php?uc=validerFrais&action=reinitialiserFraisHorsForfait&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraimentreinitialiser ce frais?');" name="btnSupprimerFrais">Reinitialiser</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>
    </div>
</div>
