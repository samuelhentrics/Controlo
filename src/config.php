<?php

$PATH = 'http://'.$_SERVER['HTTP_HOST']."/src/";

//echo $PATH.$_SERVER['PHP_SELF'];

// DOSSIERS CSV

$CSV_CONTROLES = $PATH."Controles/";
$CSV_ETUDIANTS = $PATH."Etudiants/";
$CSV_SALLES = $PATH."Salles/";

// DOSSIER GENERATION PDF PLANS DE PLACEMENT

$ETUDIANTS = $PATH."PlansPlacement";

// DOSSIERS RESSOURCES

$RESSOURCES_FOLDER = $PATH."Controlo/";

$BACK_FOLDER = $RESSOURCES_FOLDER."Back/";
$FRONT_FOLDER = $RESSOURCES_FOLDER."Front/";

$CLASS_FOLDER = $RESSOURCES_FOLDER."class/";
$IMPORT_FOLDER = $RESSOURCES_FOLDER."import";

// FRONT

$CSS_FOLDER = $FRONT_FOLDER."css/";
$IMG_FOLDER = $FRONT_FOLDER."img/";
$JS_FOLDER = $FRONT_FOLDER."js/";

// LIENS DES PAGES

$CONTROLES = $PATH."Controles/";
$ETUDIANTS = $PATH."Etudiants/";
$SALLES = $PATH."Salles/";

?>