<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
    <div class="col-md-4">
        <h3>Filtrer la recherche : </h3>
    </div>
    <div class="col-md-4">
        <form action="index.php?uc=suivrePaiementFrais&action=choixVisiteur" 
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
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
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
                            <option selected value="<?php echo $idEtat ?>">
                                <?php echo $libelleEtat ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $idEtat ?>">
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