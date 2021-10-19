<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//mail("v.schalckens@gmail.com", "test mail papercut", "je test la fct mail");

$to = 'mail@test.fr';
$subject = 'test test';
$message = '<html>'
        . '<head>'
        . '<title></title>'
        . '</head>'
        . '<body>'
        . '<table>'
        . '<tr><th>Jean de la Fontaine</th><th>Poète</th></tr>'
        . '<tr><th>Leonard De Vinci</th><th>Peintre</th></tr>'
        . '</table>'
        . '</body>'
        . '</html>';
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; cherset=iso-8859-1';
$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
$headers[] = 'From: Birthday Reminder <birthday@example.com>';
$headers[] = 'Cc: birthdayarchive@example.com';
$headers[] = 'Bcc: birthdaycheck@example.com';

mail($to, $subject, $message,implode("\r\n",$headers));
/*
 * "C:\wamp64\bin\php\php7.3.21\php.exe" 
 */