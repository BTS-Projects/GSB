<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div>
    <h2>
        Gestion des frais<small> - Comptable :
            <?php
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']
            ?></small>
    </h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary" style="border-color : #ff9933" >
            <div class="panel-heading" style="background-color: #ff9933">
                <h3 class="panel-title" style="background-color: #ff9933">
                    <span class="glyphicon glyphicon-bookmark"></span>
                    Navigation
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <a href=""
                           class="btn btn-warning btn-lg" role="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <br>Valider des fiches de frais</a>
                        <a href=""
                           class="btn btn-info btn-lg" role="button">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            <br>Suivre les paiements de fiche de frais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

