<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * "C:\wamp64\bin\php\php7.3.21\php.exe" testSecuCode.php
 * https://waytolearnx.com/2020/01/tutoriel-curl-en-php.html
 */


$codeVisiteur = rand(1000,9999);

$cpt = 0;
$tmp = microtime(true);
for ($i = 1000; $i < 10000; $i++) {
    if ($codeVisiteur == $i) {
        $tmp = microtime(true) - $tmp ;
        echo "\n";
        echo "Success after " . $cpt . " try ";
        echo "\n";
        echo "fin :" . $tmp;
        echo "\n";
    } else {
        $cpt++;
    }
}

