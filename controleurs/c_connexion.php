<?php

/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @author    Valentine SCHALCKENS <v.schalckens@gmail.com> 
 * @author    Julien Lempereur <lempereur.julien83@gmail.com>
 * @author    Bastien Kerebel <bastienkerebel@gmail.com>
 * @author    Dorian Dubois<john.doe@example.com>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'demandeconnexion';
}

switch ($action) {
    case 'demandeConnexion':
        include 'vues/v_connexion.php';
        break;
    case 'valideConnexion':
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $choix = filter_input(INPUT_POST, 'choix', FILTER_SANITIZE_STRING);

        if ($choix == 'visiteur') {
            $visiteur = $pdo->getInfosVisiteur($login);
            if (!is_array($visiteur)) {
                ajouterErreur('Login ou mot de passe incorrect en tant que Visiteur');
                include 'vues/v_erreurs.php';
                include 'vues/v_connexion.php';
            } else {
                if (!password_verify($mdp, $pdo->getMdpVisiteur($login))) {
                    ajouterErreur('Login ou mot de passe incorrect en tant que Visiteur');
                    include 'vues/v_erreurs.php';
                    include 'vues/v_connexion.php';
                } else {
                    $id = $visiteur['id'];
                    $nom = $visiteur['nom'];
                    $prenom = $visiteur['prenom'];
                    $email = $visiteur['email'];
                    connecter($id, $nom, $prenom, $choix);
                    $codeRand = 1000;
                    $pdo->setCodeVisiteur($id, $codeRand);
                    $subject = 'Connection à GSB';
                    $message = '<html>'
                            . '<head>'
                            . '<title> Connexion </title>'
                            . '</head>'
                            . '<body>'
                            . '<h1>Voulez vous vous connecter ? </h1>'
                            . 'Si oui voici votre code : ' . $codeRand
                            . '</table>'
                            . '</body>'
                            . '</html>';
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; cherset=iso-8859-1';
                    $headers[] = 'To:' . $nom . '<' . $email . '>';
                    $headers[] = 'From: GSB <gsb-mail@example.com>';
                    mail($email, $subject, $message, implode("\r\n", $headers));
                    include 'vues/v_authentificationMail.php';
                }
            }
        } else if ($choix == 'comptable') {
            $comptable = $pdo->getInfosComptable($login);
            if (!is_array($comptable)) {
                ajouterErreur('Login ou mot de passe incorrect en tant que Comptable');
                include 'vues/v_erreurs.php';
                include 'vues/v_connexion.php';
            } else {
                if (password_verify($mdp, $pdo->getMdpComptable($login))) {
                    $id = $comptable['id'];
                    $nom = $comptable['nom'];
                    $prenom = $comptable['prenom'];
                    $email = $comptable['email'];
                    connecterComptable($id, $nom, $prenom, $choix);
                    $codeRand = 1000;
                    $pdo->setCodeComptable($id, $codeRand);
                    $subject = 'Connection à GSB';
                    $message = '<html>'
                            . '<head>'
                            . '<title> Connexion </title>'
                            . '</head>'
                            . '<body>'
                            . '<h1>Voulez vous vous connecter ? </h1>'
                            . 'Si oui voici votre code : ' . $codeRand
                            . '</table>'
                            . '</body>'
                            . '</html>';
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; cherset=iso-8859-1';
                    $headers[] = 'To:' . $nom . '<' . $email . '>';
                    $headers[] = 'From: GSB <gsb-mail@example.com>';
                    mail($email, $subject, $message, implode("\r\n", $headers));
                    include 'vues/v_authentificationMail.php';
                } else {
                    ajouterErreur('Login ou mot de passe incorrect en tant que Comptable');
                    include 'vues/v_erreurs.php';
                    include 'vues/v_connexion.php';
                }
            }
        } else {

            ajouterErreur('Login ou mot de passe incorrect en tant que test');
            include 'vues/v_erreurs.php';
            include 'vues/v_connexion.php';
        }

        break;
    case 'valideConnexionMail' :
        $code = filter_input(INPUT_POST, 'codemail', FILTER_SANITIZE_STRING);
        if ($_SESSION['choix'] == 'visiteur') {
            if ($pdo->getCodeVisiteur($_SESSION['idVisiteur']) == $code) {
                connecterAuthentification($code);
                header('Location: index.php');
            } else {
                ajouterErreur('Code d\'authentification incorrect');
                include 'vues/v_erreurs.php';
                include 'vues/v_authentificationMail.php';
            }
        } else {
            if ($pdo->getCodeComptable($_SESSION['idComptable']) == $code) {
                connecterAuthentification($code);
                header('Location: index.php');
            } else {
                ajouterErreur('Code d\'authentification incorrect');
                include 'vues/v_erreurs.php';
                include 'vues/v_authentificationMail.php';
            }
        }


        break;
    default:
        include 'vues/v_connexion.php';
        break;
}
    