<?php 
include(FONCTION_CREER_LISTE_CONTROLES_PATH);

$numControle = $_GET["numControle"];
$leControle = creerListeControles()[$numControle];

print_r($leControle->getNomLong());
print("<br> -------nombre de salle pour ce controle: ".count($leControle->getMesSalles()) ."| nombre etudiants: ".count($leControle->getMesPromotions()[0]->getMesEtudiants())."--------");
// var_dump($leControle->getMesPromotions()[0]->getMesEtudiants());
foreach ($leControle->getMesSalles() as $key => $value) {
    print("<br>".$value->getNom());
}
print("<br>---------------");
