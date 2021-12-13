<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
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
<h3>Eléments forfaitisés</h3>
<div class="col-md-4">
    <form method="post" action="index.php?uc=validerFrais&action=elementForfaitise" role="form">
        <!--les variables sont encore à ajouter pour pouvoir les remplir automatiquement -->
        <?php 
        if($LesFrais == null){
            ?>
        <h2 style="color: red">Le visiteur <strong><?php echo $leVisiteur['nom']. " " . $leVisiteur['prenom']?></strong> ne possède pas de fiche de frais ce mois là</h2>
        <?php 
        }
        else{
            $ETP=$LesFrais[0]['quantite'];
            $KM = $LesFrais[1]['quantite'];
            $NUI = $LesFrais[2]['quantite'];
            $REP = $LesFrais[3]['quantite'];
            $Nouv=$LesFrais;
        ?>
        <p style="margin-left: 10px">Forfait Etape</p>
        <input method="post" type="text" name="ETP" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value="<?php echo $ETP?>">
        <p><?php echo filter_input(INPUT_POST,'ETP', FILTER_SANITIZE_STRING)?></p>
        <p style="margin-left: 10px">Frais Kilometrique</p>
        <input type="text" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value=" <?php echo $KM?>">      
        <p style="margin-left: 10px">Nuitée Hôtel</p>
        <input type="decimal" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value="<?php echo $NUI?>">
        <p style="margin-left: 10px">Repas Restaurant</p>
        <input type="decimal" style="margin-left: 10px;border-radius: 5px" maxlength="5,2" value="<?php echo $REP?>">
        <br>
        <!-- style="background-color: green;color:white;margin-top: 5px;margin-left: 10px" -->
        <input type="submit" value="Corriger" class="btn btn-success" href="index.php?uc=validerFrais&action=corrigerElement&id=<?=$idVisiteurSelectionner?>&mois=<?=$Date?>"> 
<!--        <a class="btn btn-success" action="submit()" href="index.php?uc=validerFrais&action=corrigerElement&id=<?=$idVisiteurSelectionner?>&mois=<?=$Date?>" type="button" >Corriger</a>-->
        <a class="btn btn-danger" type="reset" style="background-color: red;color:white;margin-top: 5px" 
           href="index.php?uc=validerFrais&action=MoisDispo&action2=reinitialise&visiteur=<?=$idVisiteurSelectionner?>&lstMmois=<?=$Date?>">Réinitialiser</a>
        <?php }
        unset($ETP,$KM,$NUI,$REP);
        ?>
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
                    $Mois = $unFrais['date'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $montant = $unFrais['montant'];
                    ?>
                    <!-- les lignes d'instrucitions suivante servent à créer les lignes pour chaque frais-->
                    <tr style="border: 1px solid orange">
                        <td style="width: 25%;border: 1px solid orange"><input  type="decimal" style="border-radius: 5px" maxlength="5,2" value="<?php echo $Mois ?>"></td>
                        <td style="width: 25%;border: 1px solid orange"><input type="decimal" style="border-radius: 5px" maxlength="5,2" value="<?php echo $libelle ?>"></td>
                        <td style="width: 25%;border: 1px solid orange"><input type="decimal" style="border-radius: 5px" maxlength="5,2" value="<?php echo $montant ?>"></td>
                        <td style="width: 25%;border: 1px solid orange"><button class="btn btn-success" type="submit" style="background-color: red;color:white;border-radius: 5px">Corriger</button>
                            <button class="btn btn-danger" type="reset" style="background-color: green;color:white;border-radius: 5px">Rénitialiser</button></td>
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
