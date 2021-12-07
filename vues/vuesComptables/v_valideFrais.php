<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form role="form" method="post" action="index.php?uc=validerFrais&action=MoisDispo" onchange="submit()">
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
        <select id="lstMois" name="lstMois" class="form-control" style="width:100px" >
            <?php
            foreach ($lesMois as $unMois) {
                $numAnnee = $unMois['numAnnee'];
                $numMois = $unMois['numMois'];
                $Date=$numMois.$numAnnee;
                if ($Date == $_POST['lstMois']) {
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
            }
            ?>    
        </select>
    </div>
    <br>
    <p>Le visiteur actuellement sélectionner est <strong><?php echo $leVisiteur['nom']. " " . $leVisiteur['prenom']?></strong></p>
</form>
<h2>Valider la fiche de frais
    <?php echo $numMois . '-' . $numAnnee ?>
</h2>
<h3>Eléments forfaitisés</h3>
<div class="col-md-4">
    <form method="post" action="index.php?uc=validerFrais&action=elementForfaitise" role="form">
        <!--les variables sont encore à ajouter pour pouvoir les remplir automatiquement -->
        <p style="margin-left: 10px">Forfait Etape</p>
        <input type="text" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value="">
        <p style="margin-left: 10px">Frais Kilometrique</p>
        <input type="text" style="margin-left: 10px;border-radius: 5px" maxlength="5,2">
        <p style="margin-left: 10px">Nuitée Hôtel</p>
        <input type="decimal" style="margin-left: 10px;border-radius: 5px" maxlength="5,2">
        <p style="margin-left: 10px">Repas Restaurant</p>
        <input type="decimal" style="margin-left: 10px;border-radius: 5px" maxlength="5,2">
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
                <!--cette partie du tableaux sert de base au reste de la construction du tableaux -->
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
                        <td style="width: 25%;border: 1px solid orange"><input type="decimal" style="border-radius: 5px" maxlength="5,2" value="<?php echo $idFrais ?>"></td>
                        <td style="width: 25%;border: 1px solid orange"><?php echo $libelle ?></td>
                        <td style="width: 25%;border: 1px solid orange"><?php echo $unFrais ?></td>
                        <td style="width: 25%;border: 1px solid orange"><button class="btn btn-success" type="submit" style="background-color: red;color:white;border-radius: 5px">Corriger</button>
                            <button class="btn btn-danger" type="reset" style="background-color: green;color:white;border-radius: 5px">Réinitialiser</button></td>
                    </tr>
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
