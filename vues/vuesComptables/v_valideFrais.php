<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
    <label for="lstemp" accesskey="l">choisir le visiteur :</label>
    <select id="lstemp" name="lstemp" class="form-control" style="width: 200px" onchange="clickSelectionnerMois()">
        <?php
        //on recuperer les visiteurs pour les pouvoir les afficher
        foreach ($lesNomsvisiteurs as $visiteurs) {
            $nom = $visiteurs['nom'];
            $prenom = $visiteurs['prenom'];
            $id = $visiteurs['id'];
                    ?>
        <!--on utilise l'id des visiteurs pour pouvoir en suite les afficher avec leur nom/prenom -->
        <option value= "<?php echo $id?>" >
        
            <?php echo $nom . " ". $prenom?> </option>

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
              action="index.php?uc=gererFrais&action=recupererfraisforfait" 
              role="form">
            <p style="margin-left: 10px">Forfait Etape</p>
            <input type="text" style="margin-left: 10px;border-radius: 5px">
            <p style="margin-left: 10px">Frais Kilometrique</p>
            <input type="text" style="margin-left: 10px;border-radius: 5px">
            <p style="margin-left: 10px">Nuitée Hôtel</p>
            <input type="text" style="margin-left: 10px;border-radius: 5px">
            <p style="margin-left: 10px">Repas Restaurant</p>
            <input type="text" style="margin-left: 10px;border-radius: 5px">
            <br>
            <button class="btn btn-success" type="submit" style="background-color: green;color:white;margin-top: 5px;margin-left: 10px">Corriger</button>
            <button class="btn btn-danger" type="reset" style="background-color: red;color:white;margin-top: 5px">Réinitialiser</button>
            <fieldset>
                <table style="border: 1px solid orange ">
                    <thead style="background-color:orange;border: 1px solid orange">
                        <tr>
                            <th colspan="4" style="color:white;width:1000px;text-align: left">Descriptif des évenements hors forfait</th>
                        </tr>
                    </thead>
                    <tr style="border: 1px solid black">
                        <td style="width: 28%;border: 1px solid orange">Date</td>
                        <td style="width: 28%;border: 1px solid orange">Libellé</td>
                        <td style="width: 28%;border: 1px solid orange">Montant</td>
                        <td style="width: 15%;border: 1px solid orange"></td>
                    </tr>
                    <?php
                    //on recupere les frais hors forfait pour pouvoir les mettre dans un tableaux
                    foreach ($lesFraisForfait as $unFrais) {
                        $Mois = $unFrais['mois'];
                        $libelle = htmlspecialchars($unFrais['libelle']);
                        $quantite = $unFrais['quantite'];
                        ?>
                        <!-- les lignes d'instrucitions suivante servent à créer les lignes pour chaque frais-->
                        <tr style="border: 1px solid orange">
                            <td style="width: 25%;border: 1px solid orange"><input type="text" style="border-radius: 5px" value="<?php echo $idFrais ?>"></td>
                            <td style="width: 25%;border: 1px solid orange"><?php echo $libelle ?></td>
                            <td style="width: 25%;border: 1px solid orange"><?php echo $unFrais ?></td>
                            <td style="width: 25%;border: 1px solid orange"><button class="btn btn-success" type="submit" style="background-color: red;color:white;border-radius: 5px">Corriger</button>
                                <button class="btn btn-danger" type="reset" style="background-color: green;color:white;border-radius: 5px">Réinitialiser</button></td>
                        </tr>
    <!--                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">-->

                        <?php
                    }
                    ?>

                </table>


                <button class="btn btn-success" type="submit" style="background-color: green;color:white;border-radius: 5px">Valider</button>
                <button class="btn btn-danger" type="reset" style="background-color: red;color:white;border-radius: 5px">Réinitialiser</button>
            </fieldset>
            <label for="nbjustificatif">Nombre de Justificatifs: </label>
            <input type="text" style="margin-left:5px;width: 30px;border-radius: 5px">    
        </form>
    </div>
