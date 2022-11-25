<?php

const NOM_DOSSIER_PROJET = "src";

function retrouverCheminApp(){
    // On récupére le chemin du fichier où est lancé le script
    $cheminFichierLance = explode('/', $_SERVER["REQUEST_URI"], -1);

    // Parcourir le tableau de la fin jusqu'à trouver le nom du dossier où se trouve l'application
    // cela permet ainsi d'éviter s'il existe plusieurs fichiers du même nom de les confondre
    $numRechercheSrc=count($cheminFichierLance)-1;
    while ($cheminFichierLance[$numRechercheSrc] != NOM_DOSSIER_PROJET) {
        $numRechercheSrc--;
    }

    // On reconstitue le chemin de l'application
    $cheminVersProjet = '';
    for ($indiceReconstructionChemin=0; $indiceReconstructionChemin <= $numRechercheSrc; $indiceReconstructionChemin++) { 
        $cheminVersProjet .= $cheminFichierLance[$indiceReconstructionChemin].'/';
    }

    return $cheminVersProjet;
}

$PATH = 'http://'.$_SERVER['HTTP_HOST'].retrouverCheminApp();

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