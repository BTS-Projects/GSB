<?php
/**
 * Vue Erreurs
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
<br>
<div class="alert alert-success" role="alert">
    <?php
    foreach ($_REQUEST['succes'] as $unSucces) {
        echo '<p>' . htmlspecialchars($unSucces) . '</p>';
    }
    ?>
</div>