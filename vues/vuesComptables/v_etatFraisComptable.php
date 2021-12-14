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
 * @author Valentine SCHALCKENS <v.schalckens@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 * 
 * index.php?uc=suivrePaiementFrais&action=changerEtat
 */
?>

<div class="panel panel-primary" style="border-color : #ff9933">
    <div class="panel-heading" style="background-color: #ff9933">Fiche de frais du mois 
        <!-- Affiche le mois au format mm/aaaa sélectionners-->
        <?php echo $numMois . '-' . $numAnnee ?> : </div>
    <div class="panel-body">
        <div>
            <strong><u id="visiteur"> Visiteur :</u></strong> <?php echo $visiteur ?> <br>
            <strong><u>Etat :</u></strong> <?php echo $libEtat ?>
            depuis le <?php echo $dateModif ?> <br> 
            <strong><u>Montant validé :</u></strong> <?php echo $montantValide ?> €
        </div>
        <a class="<?php echo $btn ?>" href="index.php?uc=suivrePaiementFrais&action=changerEtat&id=<?= $idVisiteur ?>&etat=<?= $idEtat?>&mois=<?=$mois?>" role="button"><strong><?php echo $changementEtat ?></strong></a>
    </div>
</div>