<div>
    <form role="form" method="post" action="index.php?uc=validerFrais&action=MoisDispo&action2=generale" onchange="submit()">
    <script language='javascript' id="cible" src="js/j_validerFrais.js"></script>
    <label for="lstemp" accesskey="l">choisir le visiteur :</label>
    <div class="form-inline">
    <select id="lstemp" name="visiteur" class="form-control" style="width: 200px" >
        <?php
        //on recuperer les visiteurs pour les pouvoir les afficher
        foreach ($lesNomsvisiteurs as $visiteurs) {
                $nom = $visiteurs['nom'];
                $prenom = $visiteurs['prenom'];
                $id = $visiteurs['id'];
                if ($id == $idVisiteurSelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                    <!--on utilise l'id des visiteurs pour pouvoir en suite les afficher avec leur nom/prenom -->
                            <option value="<?php echo $id ?>" >
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
        }
        ?>
    </select>
        <label for="lstMois" accesskey="n">Mois : </label>
        <select id="lstMois" name="lstMois" class="form-control" style="width:100px" action="index.php?uc=validerFrais&action=afficherElement">
            <?php
            foreach ($lesMois as $unMois) {
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                $Date=$numMois.$numAnnee;
                 $numMoisActuelle;
                if ($Date == $_POST['lstMois']) {
                    $numMoisActuelle=$numMois;
                    $numAnneeActuelle=$numAnnee;
                    ?>
                    
                    <option selected value="<?php echo $numMois.$numAnnee ?>">
                        <?php echo $numMois . '/' . $numAnnee ?> </option>
                    <?php
                } else {
                    ?>
                    <option value="<?php echo $numMois.$numAnnee ?>">
                        <?php echo $numMois . '/' . $numAnnee ?> </option>
                    <?php
                }
                if(empty($numMoisActuelle)){
                    $numMoisActuelle=$numMois;
                    $numAnneeActuelle=$numAnnee;
                }
            }
            ?>    
        </select>
    </div>
    <br>
</form>
<h2>Valider la fiche de frais
    <?php echo $numMoisActuelle . '-' . $numAnneeActuelle ?>
</h2>
</div>