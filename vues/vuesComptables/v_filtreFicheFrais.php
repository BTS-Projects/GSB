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
 * @author Valentine SCHALCKENS <v.schalckens@gmail.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>

<div class="row">
    <div class="col-md-4">
        <h3>Filtrer la recherche : </h3>
    </div>
    <div class="col-md-4">
        <form action="index.php?uc=suivrePaiementFrais&action=choixFiltre" 
              method="post" role="form">
            <div class="form-group">
                <label for="lstVisiteurs" accesskey="n">Visiteurs : </label>
                <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner['id']) {
                            ?>
                            <option id="<?php echo $id?>" selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option id="<?php echo $id?>" value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    
                </select>
                <label for="lstEtats" accesskey="n">Etats : </label>
                <select id="lstEtats" name="lstEtats" class="form-control">
                    <?php
                    foreach ($lesEtats as $unEtat) {
                        $idEtat = $unEtat['id'];
                        $libelleEtat = $unEtat['libelle'];
                        if ($idEtat == $etatASelectionner['id']) {
                            ?>
                            <option id ="<?php echo $idEtat ?>" selected value="<?php echo $idEtat ?>">
                                <?php echo $libelleEtat ?> </option>
                            <?php
                        } else {
                            ?>
                            <option id="<?php echo $idEtat ?>" value="<?php echo $idEtat ?>">
                                <?php echo $libelleEtat ?> </option>
                            <?php
                        }
                    }
                    ?>    
                </select>
            </div>
            <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
            <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
                   role="button">
        </form>
    </div>
</div>

<hr>