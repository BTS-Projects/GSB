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
        <form method="post" action="index.php?uc=validerFrais&action=corrigerFraisHorsForfait&visiteur=<?= $leVisiteur['id'] ?>&mois=<?= $numMoisActuelle . $numAnneeActuelle ?>&idFrais=<?= $idFraisHF ?>" >
            <div class="panel panel-info" style="border-color : #ff9933">
                <div class="panel-heading" style="background-color: #ff9933 ; color:white;">Elément hors forfait <?= $idFraisHF?></div>
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
                        <tr>
                            <td> <input type="text" disabled="disabled" style="border-radius: 5px" value="<?= $date ?>"></td>
                            <td> <input type="text" disabled="disabled" style="border-radius: 5px" value="<?= $libelle ?>"></td>
                            <td> <input type="decimal" name="<?= $nameMontant ?>" style="border-radius: 5px" maxlength="10,2" value="<?= $montant ?>"></td>
                            <td>
                                <button class="btn btn-success" onclick="return confirm('Voulez-vous vraiment corriger ce frais?');" name="btnCorrigerFrais" type="submit">Corriger</button>
                                <a class="btn btn-danger" href="index.php?uc=validerFrais&action=refuserFraisHorsForfait&visiteur=<?= $leVisiteur['id'] ?>&mois=<?= $numMoisActuelle . $numAnneeActuelle ?>&idFrais=<?= $idFraisHF ?>" 
                                   onclick="return confirm('Voulez-vous vraiment refuser ce frais?');" name="btnRefuserFrais" role="button">Refuser</a>
                            </td>
                        </tr>
                    </tbody>  
                </table>
            </div>
        </form>
</div>
