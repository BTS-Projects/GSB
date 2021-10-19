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
        $visiteur = $pdo->getInfosVisiteur($login);
        $comptable = $pdo->getInfosComptable($login);
        if (!password_verify($mdp, $pdo->getMdpVisiteur($login))) {
            if (!password_verify($mdp, $pdo->getMdpComptable($login))) {
                ajouterErreur('Login ou mot de passe incorrect');
                include 'vues/v_erreurs.php';
                include 'vues/v_connexion.php';
            } else {
                $id = $comptable['id'];
                $nom = $comptable['nom'];
                $prenom = $comptable['prenom'];
                connecterComptable($id, $nom, $prenom);
                header('Location: index.php');
            }
        } else {
            $id = $visiteur['id'];
            $nom = $visiteur['nom'];
            $prenom = $visiteur['prenom'];
            $email = $visiteur['email'];
            connecter($id, $nom, $prenom);
            $codeRand = rand(1000, 9999);
            $pdo->setCodeVisiteur($id,$codeRand);
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
        break;
    case 'valideConnexionMail' :
        $code = filter_input(INPUT_POST, 'codemail', FILTER_SANITIZE_STRING);
        if ($pdo->getCodeVisiteur($_SESSION['idVisiteur']) == $code) {
            connecterAuthentification($code);
            header('Location: index.php');
        } else {
            ajouterErreur('Code d\'authentification incorrect');
            include 'vues/v_erreurs.php';
            include 'vues/v_authentificationMail.php';
        }

        break;
    default:
        include 'vues/v_connexion.php';
        break;
}
