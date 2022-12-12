<?php 
include(FONCTION_CREER_LISTE_CONTROLES_PATH);

$numControle = $_GET["numControle"];
$leControle = creerListeControles()[$numControle];

print_r($leControle->getNomLong());

?>
Non codé en cours