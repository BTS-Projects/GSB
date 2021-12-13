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
 * @author Julien Lempereur <lempereur.julien83@gmail.com>
 * @author Dorian Dubois<john.doe@example.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<div >
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
        </div>