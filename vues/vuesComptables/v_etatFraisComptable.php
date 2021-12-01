<?php
/**
 * Vue État de Frais
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

<div class="panel panel-primary" style="border-color : #ff9933">
    <div class="panel-heading" style="background-color: #ff9933">Fiche de frais du mois 
        <?php echo $numMois . '-' . $numAnnee ?> : </div>
    <div class="panel-body">
        <div>
            <strong><u> Visiteur :</u></strong> <?php echo $visiteur ?> <br>
            <strong><u>Etat :</u></strong> <?php echo $libEtat ?>
            depuis le <?php echo $dateModif ?> <br> 
            <strong><u>Montant validé :</u></strong> <?php echo $montantValide ?>
        </div>
        <a class="btn btn-danger" href="#" role="button" hidden="hidden"><strong><?php echo $changementEtat ?></strong></a>
    </div>
</div>