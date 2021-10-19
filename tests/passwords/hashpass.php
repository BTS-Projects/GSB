<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$pdo = new PDO('mysql:host=localhost;dbname=gsb_frais', 'root', '');
$pdo->query('SET CHARACTER SET utf8');

function getLesVisiteurs($pdo){
    $req = 'select id, mdp from visiteur';
    $res = $pdo->query($req);
    $lesLignes = $res->fetchAll();
    return $lesLignes;
};

$visiteurs = getLesVisiteurs($pdo);
foreach($visiteurs as $visiteur) {
    $hashMdp = password_hash($visiteur['mdp'],PASSWORD_DEFAULT);
    $req = "UPDATE visiteur SET mdp='" . $hashMdp . "' WHERE id='" . $visiteur['id'] . "';";
    $pdo->exec($req);
};
