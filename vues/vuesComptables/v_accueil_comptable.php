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
 * @author    Valentine SCHALCKENS <v.schalckens@gmail.com>
 * @author    Julien Lempereur <lempereur.julien83@gmail.com>
 * @author    Bastien Kerebel <john.doe@example.com>
 * @author    Dorian Dubois<john.doe@example.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>

<div>
    <h2>
        Gestion des frais<small> - Comptable :
            <?php
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']
            ?></small>
    </h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" style="border-color : #ff9933" >
            <div class="panel-heading" style="background-color: #ff9933">
                <h3 class="panel-title" style="background-color: #ff9933">
                    <span class="glyphicon glyphicon-bookmark"></span>
                    Navigation
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                            <!-- Bouton pour accéder à Valider des Fiches de Frais -->
                        <a href="index.php?uc=validerFrais&action=valideFrais"
                           class="btn btn-warning btn-lg" role="button" name="VficheFrais">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <br>Valider des fiches de frais</a>
                            
                           <!-- Bouton pour accéder à Suivre les paiements de fiche de frais -->
                        <a href="index.php?uc=suivrePaiementFrais&action=afficherFichesFrais"
                           class="btn btn-info btn-lg" role="button" name="SficheFrais">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            <br>Suivre les paiements de fiche de frais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

