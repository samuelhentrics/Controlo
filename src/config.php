<?php

if (! function_exists('retrouverCheminApp'))
{
    function retrouverCheminApp(){
        // Nom du dossier de l'application
        $NOM_DOSSIER_PROJET = "src";

        // On récupére le chemin du fichier où est lancé le script
        $cheminFichierLance = explode('/', $_SERVER["REQUEST_URI"], -1);
    
        // Parcourir le tableau de la fin jusqu'à trouver le nom du dossier où se trouve l'application
        // cela permet ainsi d'éviter s'il existe plusieurs fichiers du même nom de les confondre
        $numRechercheSrc=count($cheminFichierLance)-1;
        while ($cheminFichierLance[$numRechercheSrc] != $NOM_DOSSIER_PROJET) {
            $numRechercheSrc--;
        }
    
        // On reconstitue le chemin de l'application
        $cheminVersProjet = '';
        for ($indiceReconstructionChemin=0; $indiceReconstructionChemin <= $numRechercheSrc; $indiceReconstructionChemin++) { 
            $cheminVersProjet .= $cheminFichierLance[$indiceReconstructionChemin].'/';
        }
    
        return $cheminVersProjet;
    }
}

$PATH = 'http://'.$_SERVER['HTTP_HOST'].retrouverCheminApp();

//echo $PATH.$_SERVER['PHP_SELF'];

// DOSSIERS CSV

$CSV_CONTROLES_FOLDER_NAME = "Controles/";
$CSV_ETUDIANTS_FOLDER_NAME = "Etudiants/";
$CSV_SALLES_FOLDER_NAME = "Salles/";

$CSV_CONTROLES_PATH = $PATH.$CSV_CONTROLES_FOLDER_NAME;
$CSV_ETUDIANTS_PATH = $PATH.$CSV_ETUDIANTS_FOLDER_NAME;
$CSV_SALLES_PATH = $PATH.$CSV_SALLES_FOLDER_NAME;

// DOSSIER GENERATION PDF PLANS DE PLACEMENT


$PLANS_DE_PLACEMENT_FOLDER_NAME = "PlansPlacement/";
$PLANS_DE_PLACEMENT_PATH = $PATH.$PLANS_DE_PLACEMENT_FOLDER_NAME;

// DOSSIERS RESSOURCES

$RESSOURCES_FOLDER_NAME = "Controlo/";

$BACK_FOLDER_NAME = "Back/";
$FRONT_FOLDER_NAME = "Front/";

$BACK_PATH = $RESSOURCES_FOLDER_NAME.$BACK_FOLDER_NAME;
$FRONT_PATH = $RESSOURCES_FOLDER_NAME.$FRONT_FOLDER_NAME;

$CLASS_FOLDER = "class/";
$IMPORT_FOLDER = "import/";

$CLASS_PATH = $RESSOURCES_FOLDER_NAME.$CLASS_FOLDER;
$IMPORT_PATH = $RESSOURCES_FOLDER_NAME.$IMPORT_FOLDER;

//NOM FICHIER CLASSE
$CLASS_CONTROLE_FILE_NAME = "Controle.php";
$CLASS_SALLE_FILE_NAME = "Salle.php";
$CLASS_PLAN_FILE_NAME = "Plan.php";
$CLASS_ZONE_FILE_NAME = "Zone.php";

//NOM FICHIER  CSV
$LISTE_CONTROLES_FILE_NAME = "liste-controles.csv";
$LISTE_SALLES_FILE_NAME = "liste-salles.csv";

// FRONT

$CSS_FOLDER_NAME = "css/";
$IMG_FOLDER_NAME = "images/";
$JS_FOLDER_NAME = "js/";

$CSS_PATH = $FRONT_PATH.$CSS_FOLDER_NAME;
$IMG_PATH = $FRONT_PATH.$IMG_FOLDER_NAME;
$JS_PATH = $FRONT_PATH.$JS_FOLDER_NAME;

// LIENS DES PAGES

$PAGE_CONTROLES_PATH = $PATH."index.php?page=controles";
$PAGE_ETUDIANTS_PATH = $PATH."index.php?page=etudiants";
$PAGE_SALLES_PATH = $PATH."index.php?page=salles";

// FONCTIONS
$FONCTION_AJOUTER_MINUTES_HEURE = $IMPORT_PATH."ajouterMinutesHeure.php";

$OBJECT_CREATION_PATH = $IMPORT_PATH."creationObjets/";

$FONCTION_CREER_LISTE_CONTROLES = $OBJECT_CREATION_PATH."creerListeControles.php";
$FONCTION_CREER_LISTE_SALLES = $OBJECT_CREATION_PATH."creerListeSalles.php";
$FONCTION_CREER_PLAN_SALLE = $OBJECT_CREATION_PATH."creerPlanSalle.php";
?>