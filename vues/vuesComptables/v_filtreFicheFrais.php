<?php
/**
 * Vue État de Frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<h2>Fiches de frais</h2>
<div>
    <form action="index.php?uc=etatFrais&action=voirEtatFrais" 
          method="post" role="form">
        <div class="form-group">
            <label for="lstVisiteurs" accesskey="n">Mois : </label>
            <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                <?php
                
                ?>  

            </select>
            <label for="lstEtat" accesskey="n">Mois : </label>
            <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                <?php
                
                ?>  

            </select>
        </div>
        <input id="ok" type="submit" value="Valider" class="btn btn-success" 
               role="button">
        <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
               role="button">
    </form>
</div>


<hr>
