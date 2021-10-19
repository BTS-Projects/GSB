<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$pdo = new PDO('mysql:host=localhost;dbname=gsb_frais', 'root', '');
$pdo->query('SET CHARACTER SET utf8');

function getLesComptables($pdo) {
    $req = 'select id, mdp from comptable';
    $res = $pdo->query($req);
    $lesLignes = $res->fetchAll();
    return $lesLignes;
};

$comptables = getLesComptables($pdo);
foreach($comptables as $comptable) {
    $hashMdp = password_hash($comptable['mdp'],PASSWORD_DEFAULT);
    $req = "UPDATE comptable SET mdp='" . $hashMdp . "' WHERE id='" . $comptable['id'] . "';";
    $pdo->exec($req);
};
