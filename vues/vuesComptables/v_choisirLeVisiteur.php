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
 * @author    Dorian Dubois<john.doe@example.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>

<div>
    <div class="col-md-4">
        <h2>Filtrer la recherche : </h2>
    </div>
    <div class="col-md-4">
        <form role="form" method="post" action="index.php?uc=validerFrais&action=MoisDispo" onchange="submit()">
            <div class="form-groupe">
                <label for="lstemp" accesskey="l">Visiteur :</label>
                <select id="lstemp" name="visiteur" class="form-control" style="width: 200px" >
                    <?php
                    //Recupération des visiteurs pour pouvoir les afficher
                    foreach ($lesNomsvisiteurs as $visiteurs) {
                        $nom = $visiteurs['nom'];
                        $prenom = $visiteurs['prenom'];
                        $id = $visiteurs['id'];
                        if ($id == $idVisiteurSelectionner) {
                            ?>
                            <option id="<?= $id ?>" selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <!--on utilise l'id des visiteurs pour pouvoir en suite les afficher avec leur nom/prenom -->
                            <option id="<?= $id ?>" value="<?php echo $id ?>" >
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control" style="width:100px" >
                    <?php
                    //on recuperer les mois du visiteur sélectionner pour les pouvoir les afficher
                    foreach ($lesMois as $unMois) {
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        $Date = $numMois . $numAnnee;
                        $numMoisActuelle;
                        if ($Date == $_POST['lstMois']) {
                            $numMoisActuelle = $numMois;
                            $numAnneeActuelle = $numAnnee;
                            ?>

                            <option id="<?= $Date ?>" selected value="<?= $numMois . $numAnnee ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option id="<?= $Date ?>"value="<?= $numMois . $numAnnee ?>">
                                <?= $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                        if (empty($numMoisActuelle)) {
                            $numMoisActuelle = $numMois;
                            $numAnneeActuelle = $numAnnee;
                        }
                    }
                    ?>    
                </select>
            </div>
        </form>
    </div>
    <hr>
    <h2>Valider la fiche de frais du <?php echo $numMoisActuelle . '-' . $numAnneeActuelle ?> : </h2>
</div>