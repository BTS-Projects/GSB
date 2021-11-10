<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">    
    <label for="lstemp" accesskey="l">choisir le visiteur :</label>
    <select id="lstemp" name="lstemp" class="form-control" style="width: 150px">
        <?php
        foreach ($lesvisiteurs as $visiteurs) {
            $visiteur = visiteurs['visiteur'];
            $prenom = $visiteurs['nom'];
            $nom = $visiteurs['prenom'];
            ?>

            <option selected value= "<?php echo $visiteur ?>">

                <?php
            }
            ?>
    </select>
    <!-- liste des Mois par rapport au employées -->

    <label for="lstMois" accesskey="n" style="margin-left:20px">Mois : </label>
    <select id="lstMois" name="lstMois" class="form-control" style="width: 100px">
        <?php
        $numMois = $unMois['numMois'];
        foreach ($lesMois as $unMois) {
            $mois = $unMois['mois'];
            $numAnnee = $unMois['numAnnee'];
            if ($mois == $moisASelectionner) {
                ?>
                <option selected value="<?php echo $mois ?>">
                    <?php echo $numMois . '/' . $numAnnee ?> </option>
                <?php
            } else {
                ?>
                <option value="<?php echo $mois ?>">
                    <?php echo $numMois . '/' . $numAnnee ?> </option>
                <?php
            }
        }
        ?>    

    </select>   
    <h2>Valider la fiche de frais
        <?php echo $numMois . '-' . $numAnnee ?>
    </h2>
    <h3>Eléments forfaitisés</h3>
    <div class="col-md-4">
        <form method="post" 
              action="index.php?uc=gererFrais&action=validerMajFraisForfait" 
              role="form">
            <p style="margin-left: 10px">Forfait Etape</p>
            <input type="text" style="margin-left: 10px">
            <p style="margin-left: 10px">Frais Kilometrique</p>
            <input type="text" style="margin-left: 10px">
            <p style="margin-left: 10px">Nuitée Hôtel</p>
            <input type="text" style="margin-left: 10px">
            <p style="margin-left: 10px">Repas Restaurant</p>
            <input type="text" style="margin-left: 10px">
            <br>
            <button class="btn btn-success" type="submit" style="background-color: red;color:white;margin-top: 5px;margin-left: 10px">Corriger</button>
            <button class="btn btn-danger" type="reset" style="background-color: green;color:white;margin-top: 5px">Réinitialiser</button>
            <fieldset>
                <table style="border: 1px solid black ">
                    <thead style="background-color:orange;border: 1px solid black">
                        <tr>
                            <th colspan="4" style="color:white;width:1000px">Descriptif des évenements hors forfait</th>
                        </tr>
                    </thead>
                    <tr style="border: 1px solid black;width: 100%">
                        <td style="width: 25%;border: 1px solid orange">Date</td>
                        <td style="width: 25%;border: 1px solid orange">Libellé</td>
                        <td style="width: 25%;border: 1px solid orange">Montant</td>
                        <td style="width: 25%;border: 1px solid orange"></td>
                    </tr>
                </table>
                    
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control
                               </div>
                               <?php
                           }
                           ?>
                           <button class="btn btn-success" type="submit" style="background-color: red;color:white">Corriger</button>
                    <button class="btn btn-danger" type="reset" style="background-color: green;color:white">Réinitialiser</button>
            </fieldset>
        </form>
    </div>
</div>