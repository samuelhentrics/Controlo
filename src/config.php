<?php

if (! function_exists('retrouverCheminApp'))
{
    /**
     * Fonction permettant de retrouver le chemin jusqu'au nom du dossier de l'application
     *
     * @return string
     */
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

/**
 * Contient le chemin vers le dossier du projet
 * ex : http://localhost/src (où src est le chemin du projet)
 */
$PATH = 'http://'.$_SERVER['HTTP_HOST'].retrouverCheminApp();











// -----------------------------------------
// DOSSIERS DES CSV
// -----------------------------------------

/**
 * Nom du dossier où se retrouvent les CSV (partie Contrôles)
 * (La liste des controles)
 * ex: Controles/
 */
$CSV_CONTROLES_FOLDER_NAME = "Controles/";

/**
 * Nom du dossier où se retrouvent les CSV (partie Etudiants)
 * (La liste des étudiants dans chaque fichier d'une promotion)
 * ex : Etudiants/
 */
$CSV_ETUDIANTS_FOLDER_NAME = "Etudiants/";

/**
 * Nom du dossier où se retrouvent les CSV (partie Salles)
 * (La liste des salles et des plans de salle)
 * ex : Salles/
 */
$CSV_SALLES_FOLDER_NAME = "Salles/";

/**
 * Lien complet pour accéder au dossier CSV (Controles)
 * ex : http://localhost/src/Controles
 */
$CSV_CONTROLES_PATH = $PATH.$CSV_CONTROLES_FOLDER_NAME;

/**
 * Lien complet pour accéder au dossier CSV (Etudiants)
 * ex : http://localhost/src/Etudiants
 */
$CSV_ETUDIANTS_PATH = $PATH.$CSV_ETUDIANTS_FOLDER_NAME;

/**
 * Lien complet pour accéder au dossier CSV (Salles)
 * ex : http://localhost/src/Salles
 */
$CSV_SALLES_PATH = $PATH.$CSV_SALLES_FOLDER_NAME;














// -----------------------------------------
// DOSSIER GENERATION PDF PLANS DE PLACEMENT
// -----------------------------------------


/**
 * Nom du dossier où se trouvent les plans de placement générés
 * ex : PlansPlacement/
 */
$PLANS_DE_PLACEMENT_FOLDER_NAME = "PlansPlacement/";

/**
 * Lien complet pour accéder au dossier des plans de placement
 * ex : http://localhost/src/PlansPlacement
 */
$PLANS_DE_PLACEMENT_PATH = $PATH.$PLANS_DE_PLACEMENT_FOLDER_NAME;












// -----------------------------------------
// DOSSIERS RESSOURCES
// -----------------------------------------

/**
 * Nom du dossier où se retrouvent les ressources (back/front...) 
 * ex : Controlo/
 */
$RESSOURCES_FOLDER_NAME = "Controlo/";


/**
 * Nom du dossier où se trouve le dossier Back
 * ex : Back/
 */
$BACK_FOLDER_NAME = "Back/";

/**
 * Nom du dossier où se trouve le dossier Front
 * ex : Front/
 */
$FRONT_FOLDER_NAME = "Front/";

/**
 * Lien complet (sans l'adresse du serveur) où se trouve le dossier Back
 * ex: Controlo/Back/
 */
$BACK_PATH = $RESSOURCES_FOLDER_NAME.$BACK_FOLDER_NAME;

/**
 * Lien complet (sans l'adresse du serveur) où se trouve le dossier Front
 * ex: Controlo/Front/
 */
$FRONT_PATH = $RESSOURCES_FOLDER_NAME.$FRONT_FOLDER_NAME;


/**
 * Nom du dossier où se retrouvent les classes
 * ex : class/
 */
$CLASS_FOLDER_NAME = "class/";

/**
 * Nom du dossier où se retrouvent les fonctions
 * ex : import/
 */
$IMPORT_FOLDER_NAME = "import/";


/**
 * Lien complet (sans l'adresse du serveur) où se trouve le dossier des classes
 * ex : Controlo/class/
 */
$CLASS_PATH = $RESSOURCES_FOLDER_NAME.$CLASS_FOLDER_NAME;

/**
 * Lien complet (sans l'adresse du serveur) où se trouve le dossier des fonctions
 * ex : Controlo/import/
 */
$IMPORT_PATH = $RESSOURCES_FOLDER_NAME.$IMPORT_FOLDER_NAME;











// -----------------------------------------
//NOM FICHIER CLASSES
// -----------------------------------------

/**
 * Nom du fichier de la classe Controle
 * ex : Controle.php
 */
$CLASS_CONTROLE_FILE_NAME = "Controle.php";

/**
 * Nom du fichier de la classe Salle
 * ex : Salle.php
 */
$CLASS_SALLE_FILE_NAME = "Salle.php";

/**
 * Nom du fichier de la classe Plan
 * ex : Plan.php
 */
$CLASS_PLAN_FILE_NAME = "Plan.php";

/**
 * Nom du fichier de la classe Zone
 * ex : Zone.php
 */
$CLASS_ZONE_FILE_NAME = "Zone.php";

/**
 * Nom du fichier de la classe ContraintesEspacement
 * ex : ContraintesEspacement.php
 */
$CLASS_CONTRAINTES_ESPACEMENT_FILE_NAME = "ContraintesEspacement.php";

/**
 * Nom du fichier de la classe ContraintesGenerales
 * ex : ContraintesGenerales.php
 */
$CLASS_CONTRAINTES_GENERALES_FILE_NAME = "ContraintesGenerales.php";

/**
 * Nom du fichier de la classe Controles
 * ex : Controles.php
 */
$CLASS_CONTROLES_FILE_NAME = "Controles.php";

/**
 * Nom du fichier de la classe Etudiants
 * ex : Etudiants.php
 */
$CLASS_ETUDIANTS_FILE_NAME = "Etudiants.php";

/**
 * Nom du fichier de la classe PlanDePlacement
 * ex : PlanDePlacement.php
 */
$CLASS_PLAN_PLACEMENT_FILE_NAME = "PlanDePlacement.php";

/**
 * Nom du fichier de la classe Promotion
 * ex : Promotion.php
 */
$CLASS_PROMOTION_FILE_NAME = "Promotion.php";

/**
 * Nom du fichier de la classe UnPlacement
 * ex : UnPlacement.php
 */
$CLASS_UN_PLACEMENT_FILE_NAME = "UnPlacement.php";










// -----------------------------------------
// NOM FICHIER CSV
// -----------------------------------------

$LISTE_CONTROLES_FILE_NAME = "liste-controles.csv";
$LISTE_SALLES_FILE_NAME = "liste-salles.csv";













// -----------------------------------------
// FRONT
// -----------------------------------------


/**
 * Nom du dossier css
 * ex : css/
 */
$CSS_FOLDER_NAME = "css/";

/**
 * Nom du dossier images
 * ex : images/
 */
$IMG_FOLDER_NAME = "images/";


/**
 * Nom du dossier javascript
 * ex : js/
 */
$JS_FOLDER_NAME = "js/";


/**
 * Lien complet (sans l'adresse du serveur) où se trouve le dossier css
 * ex : Controlo/Front/css
 */
$CSS_PATH = $FRONT_PATH.$CSS_FOLDER_NAME;

/**
 * Lien complet (sans l'adresse du serveur) où se trouve le dossier image
 * ex : Controlo/Front/images
 */
$IMG_PATH = $FRONT_PATH.$IMG_FOLDER_NAME;


/**
 * Lien complet (sans l'adresse du serveur) où se trouve le dossier js
 * ex : Controlo/Front/js
 */
$JS_PATH = $FRONT_PATH.$JS_FOLDER_NAME;














// -----------------------------------------
// FONCTIONS (IMPORT)
// -----------------------------------------

/**
 * Nom du fichier où se trouve la fonction ajouterMinutesHeure
 * ex : ajouterMinutesHeure.php
 */
$FONCTION_AJOUTER_MINUTES_HEURE_FILE_NAME = "ajouterMinutesHeure.php";

/**
 * Lien complet (sans l'adresse du serveur) où se trouve la fonction ajouterMinutesHeure
 * ex : Controlo/import/ajouterMinutesHeure.php
 */
$FONCTION_AJOUTER_MINUTES_HEURE_PATH = $IMPORT_PATH.$FONCTION_AJOUTER_MINUTES_HEURE_FILE_NAME;


/**
 * Nom du dossier où se trouve les fonctions de création d'objets
 * ex: creationObjets/
 */
$OBJECT_CREATION_FOLDER_NAME = "creationObjets/";


/**
 * Lien complet (sans l'adresse du serveur) où se trouve le dossier de création d'objets
 * ex : Controlo/import/creationObjets/
 */
$OBJECT_CREATION_PATH = $IMPORT_PATH.$OBJECT_CREATION_FOLDER_NAME;


/**
 * Nom du fichier où se trouve la fonction de création de la liste des contrôles
 * ex: creerListeControles.php
 */
$FONCTION_CREER_LISTE_CONTROLES_FILE_NAME = "creerListeControles.php";

/**
 * Lien complet (sans l'adresse du serveur) où se trouve la fonction de création de la liste des contrôles
 * ex : Controlo/creationObjets/creerListeControles.php
 */
$FONCTION_CREER_LISTE_CONTROLES_PATH = $OBJECT_CREATION_PATH.$FONCTION_CREER_LISTE_CONTROLES_FILE_NAME;

/**
 * Nom du fichier où se trouve la fonction de création de la liste des salles
 * ex: creerListeSalles.php
 */
$FONCTION_CREER_LISTE_SALLES_FILE_NAME = "creerListeSalles.php";


/**
 * Lien complet (sans l'adresse du serveur) où se trouve la fonction de création de la liste des salles
 * ex : Controlo/creationObjets/creerListeSalles.php
 */
$FONCTION_CREER_LISTE_SALLES_PATH = $OBJECT_CREATION_PATH.$FONCTION_CREER_LISTE_SALLES_FILE_NAME;

/**
 * Nom du fichier où se trouve la fonction de création de la liste des salles
 * ex: creerPlanSalle.php
 */
$FONCTION_CREER_PLAN_SALLE_FILE_NAME = "creerPlanSalle.php";


 /**
 * Lien complet (sans l'adresse du serveur) où se trouve la fonction de création d'un plan de salle
 * ex : Controlo/creationObjets/creerPlanSalle.php
 */
$FONCTION_CREER_PLAN_SALLE_PATH = $OBJECT_CREATION_PATH.$FONCTION_CREER_PLAN_SALLE_FILE_NAME;









// -----------------------------------------
// LIENS DES PAGES POUR LA NAVIGATION DU SITE
// -----------------------------------------

/**
 * Lien complet vers la page de la liste des contrôles
 * ex : http://localhost/src/index.php?page=controles
 */
$PAGE_CONTROLES_PATH = $PATH."index.php?page=controles";

/**
 * Lien complet vers la page de la liste des etudiants
 * ex : http://localhost/src/index.php?page=etudiants
 */
$PAGE_ETUDIANTS_PATH = $PATH."index.php?page=etudiants";

/**
 * Lien complet vers la page de la liste des salles
 * ex : http://localhost/src/index.php?page=salles
 */
$PAGE_SALLES_PATH = $PATH."index.php?page=salles";


?>