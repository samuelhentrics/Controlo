<?php
/**
 * @file        config.php
 * @brief       Contient les variables d'environnement pour la bonne configuration du projet
 * @author      Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>, Benjamin PEYRE
 * @version     0.1
 * @date        26/11/2022
 */

// Désactive les informations d'erreur (pour le mode non-dev)
//ini_set('display_errors','Off');

if (! function_exists('retrouverCheminApp'))
{
    /**
     * @brief Fonction permettant de retrouver le chemin jusqu'au nom du dossier de l'application
     *
     * @return string
     */
    function retrouverCheminApp(){
        // Nom du dossier de l'application
        define("NOM_DOSSIER_PROJET", "src");

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
}

/**
 * @brief Contient le chemin vers le dossier du projet
 * @note ex : http://localhost/src (où src est le chemin du projet)
 */
define("PATH",'http://'.$_SERVER['HTTP_HOST'].retrouverCheminApp());











// -----------------------------------------
// DOSSIERS DES CSV
// -----------------------------------------

/**
 * @brief Nom du dossier où se retrouvent les CSV (partie Contrôles)
 * (La liste des controles)
 * @note ex: Controles/
 */
define("CSV_CONTROLES_FOLDER_NAME","Controles/");

/**
 * @brief Nom du dossier où se retrouvent les CSV (partie Etudiants)
 * (La liste des étudiants dans chaque fichier d'une promotion)
 * @note ex : Etudiants/
 */
define("CSV_ETUDIANTS_FOLDER_NAME","Etudiants/");

/**
 * @brief Nom du dossier où se retrouvent les CSV (partie Salles)
 * (La liste des salles et des plans de salle)
 * @note ex : Salles/
 */
define("CSV_SALLES_FOLDER_NAME","Salles/");

/**
 * @brief Lien complet pour accéder au dossier CSV (Controles)
 * @note ex : http://localhost/src/Controles
 */
define("CSV_CONTROLES_PATH", PATH.CSV_CONTROLES_FOLDER_NAME);

/**
 * @brief Lien complet pour accéder au dossier CSV (Etudiants)
 * @note ex : http://localhost/src/Etudiants
 */
define("CSV_ETUDIANTS_PATH",PATH.CSV_ETUDIANTS_FOLDER_NAME);

/**
 * @brief Lien complet pour accéder au dossier CSV (Salles)
 * @note ex : http://localhost/src/Salles
 */
define("CSV_SALLES_PATH", PATH.CSV_SALLES_FOLDER_NAME);














// -----------------------------------------
// DOSSIER GENERATION PDF PLANS DE PLACEMENT
// -----------------------------------------


/**
 * @brief Nom du dossier où se trouvent les plans de placement générés
 * @note ex : PlansPlacement/
 */
define("PLANS_DE_PLACEMENT_FOLDER_NAME", "PlansPlacement/");

/**
 * @brief Lien complet pour accéder au dossier des plans de placement
 * @note ex : http://localhost/src/PlansPlacement
 */
define("PLANS_DE_PLACEMENT_PATH", PATH.PLANS_DE_PLACEMENT_FOLDER_NAME);












// -----------------------------------------
// DOSSIERS RESSOURCES
// -----------------------------------------

/**
 * @brief Nom du dossier où se retrouvent les ressources (back/front...) 
 * @note ex : Controlo/
 */
define("RESSOURCES_FOLDER_NAME", "Controlo/");


/**
 * @brief Nom du dossier où se trouve le dossier Back
 * @note ex : Back/
 */
define("BACK_FOLDER_NAME", "Back/");

/**
 * @brief Nom du dossier où se trouve le dossier Front
 * @note ex : Front/
 */
define("FRONT_FOLDER_NAME", "Front/");

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier Back
 * @note ex: Controlo/Back/
 */
define("BACK_PATH", RESSOURCES_FOLDER_NAME.BACK_FOLDER_NAME);

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier Front
 * @note ex: Controlo/Front/
 */
define("FRONT_PATH", RESSOURCES_FOLDER_NAME.FRONT_FOLDER_NAME);


/**
 * @brief Nom du dossier où se retrouvent les classes
 * @note ex : class/
 */
define("CLASS_FOLDER_NAME", "class/");

/**
 * @brief Nom du dossier où se retrouvent les fonctions
 * @note ex : import/
 */
define("IMPORT_FOLDER_NAME", "import/");


/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier des classes
 * @note ex : Controlo/class/
 */
define("CLASS_PATH", RESSOURCES_FOLDER_NAME.CLASS_FOLDER_NAME);

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier des fonctions
 * @note ex : Controlo/import/
 */
define("IMPORT_PATH", RESSOURCES_FOLDER_NAME.IMPORT_FOLDER_NAME);











// -----------------------------------------
//NOM FICHIER CLASSES
// -----------------------------------------

/**
 * @brief Nom du fichier de la classe Controle
 * @note ex : Controle.php
 */
define("CLASS_CONTROLE_FILE_NAME", "Controle.php");

/**
 * @brief Nom du fichier de la classe Salle
 * @note ex : Salle.php
 */
define("CLASS_SALLE_FILE_NAME", "Salle.php");

/**
 * @brief Nom du fichier de la classe Plan
 * @note ex : Plan.php
 */
define("CLASS_PLAN_FILE_NAME", "Plan.php");

/**
 * @brief Nom du fichier de la classe Zone
 * @note ex : Zone.php
 */
define("CLASS_ZONE_FILE_NAME" , "Zone.php");

/**
 * @brief Nom du fichier de la classe ContraintesEspacement
 * @note ex : ContraintesEspacement.php
 */
define("CLASS_CONTRAINTES_ESPACEMENT_FILE_NAME" , "ContraintesEspacement.php");

/**
 * @brief Nom du fichier de la classe ContraintesGenerales
 * @note ex : ContraintesGenerales.php
 */
define("CLASS_CONTRAINTES_GENERALES_FILE_NAME" , "ContraintesGenerales.php");

/**
 * @brief Nom du fichier de la classe Etudiants
 * @note ex : Etudiants.php
 */
define("CLASS_ETUDIANT_FILE_NAME" , "Etudiant.php");

/**
 * @brief Nom du fichier de la classe PlanDePlacement
 * @note ex : PlanDePlacement.php
 */
define("CLASS_PLAN_PLACEMENT_FILE_NAME" , "PlanDePlacement.php");

/**
 * @brief Nom du fichier de la classe Promotion
 * @note ex : Promotion.php
 */
define("CLASS_PROMOTION_FILE_NAME" , "Promotion.php");

/**
 * @brief Nom du fichier de la classe UnPlacement
 * @note ex : UnPlacement.php
 */
define("CLASS_UN_PLACEMENT_FILE_NAME" , "UnPlacement.php");










// -----------------------------------------
// NOM FICHIER CSV
// -----------------------------------------

/**
 * @brief Nom du fichier de la liste des contrôles
 * @note ex: liste-controles.csv
 */
define("LISTE_CONTROLES_FILE_NAME" , "liste-controles.csv");

/**
 * @brief Nom du fichier de la liste des salles
 * @note ex: liste-salles.csv
 */
define("LISTE_SALLES_FILE_NAME" , "liste-salles.csv");













// -----------------------------------------
// FRONT
// -----------------------------------------


/**
 * @brief Nom du dossier css
 * @note ex : css/
 */
define("CSS_FOLDER_NAME" , "css/");

/**
 * @brief Nom du dossier images
 * @note ex : images/
 */
define("IMG_FOLDER_NAME" , "images/");

/**
 * @brief Nom du dossier videos
 * @note ex : videos/
 */
define("VIDEOS_FOLDER_NAME" , "videos/");

/**
 * @brief Nom du dossier javascript
 * @note ex : js/
 */
define("JS_FOLDER_NAME" , "js/");


/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier css
 * @note ex : Controlo/Front/css
 */
define("CSS_PATH" , FRONT_PATH.CSS_FOLDER_NAME);

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier image
 * @note ex : Controlo/Front/images
 */
define("IMG_PATH" , FRONT_PATH.IMG_FOLDER_NAME);

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier videos
 * @note ex : Controlo/Front/videos
 */
define("VIDEOS_PATH" , FRONT_PATH.VIDEOS_FOLDER_NAME);


/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier js
 * @note ex : Controlo/Front/js
 */
define("JS_PATH" , FRONT_PATH.JS_FOLDER_NAME);














// -----------------------------------------
// FONCTIONS (IMPORT)
// -----------------------------------------

/**
 * @brief Nom du fichier où se trouve la fonction ajouterMinutesHeure
 * @note ex : ajouterMinutesHeure.php
 */
define("FONCTION_AJOUTER_MINUTES_HEURE_FILE_NAME" , "ajouterMinutesHeure.php");

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction ajouterMinutesHeure
 * @note ex : Controlo/import/ajouterMinutesHeure.php
 */
define("FONCTION_AJOUTER_MINUTES_HEURE_PATH" , IMPORT_PATH.FONCTION_AJOUTER_MINUTES_HEURE_FILE_NAME);


/**
 * @brief Nom du dossier où se trouve les fonctions de création d'objets
 * @note ex: creationObjets/
 */
define("OBJECT_CREATION_FOLDER_NAME" , "creationObjets/");


/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier de création d'objets
 * @note ex : Controlo/import/creationObjets/
 */
define("OBJECT_CREATION_PATH" , IMPORT_PATH.OBJECT_CREATION_FOLDER_NAME);


/**
 * @brief Nom du fichier où se trouve la fonction de création de la liste des contrôles
 * @note ex: creerListeControles.php
 */
define("FONCTION_CREER_LISTE_CONTROLES_FILE_NAME" , "creerListeControles.php");

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction de création de la liste des contrôles
 * @note ex : Controlo/creationObjets/creerListeControles.php
 */
define("FONCTION_CREER_LISTE_CONTROLES_PATH" , OBJECT_CREATION_PATH.FONCTION_CREER_LISTE_CONTROLES_FILE_NAME);

/**
 * @brief Nom du fichier où se trouve la fonction de création de la liste des salles
 * @note ex: creerListeSalles.php
 */
define("FONCTION_CREER_LISTE_SALLES_FILE_NAME" , "creerListeSalles.php");


/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction de création de la liste des salles
 * @note ex : Controlo/creationObjets/creerListeSalles.php
 */
define("FONCTION_CREER_LISTE_SALLES_PATH" , OBJECT_CREATION_PATH.FONCTION_CREER_LISTE_SALLES_FILE_NAME);

/**
 * @brief Nom du fichier où se trouve la fonction de création de la liste des salles
 * @note ex: creerPlanSalle.php
 */
define("FONCTION_CREER_PLAN_SALLE_FILE_NAME" , "creerPlanSalle.php");


 /**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction de création d'un plan de salle
 * @note ex : Controlo/creationObjets/creerPlanSalle.php
 */
define("FONCTION_CREER_PLAN_SALLE_PATH" , OBJECT_CREATION_PATH.FONCTION_CREER_PLAN_SALLE_FILE_NAME);

/**
 * @brief Nom du fichier où se trouve la fonction de création de la liste des promotions
 * @note ex: creerListePromotions.php
 */
define("FONCTION_CREER_LISTE_PROMOTIONS_FILE_NAME" , "creerListePromotions.php");


 /**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction de création de la liste des promotions
 * @note ex : Controlo/creationObjets/creerListePromotions.php
 */
define("FONCTION_CREER_LISTE_PROMOTIONS_PATH" , OBJECT_CREATION_PATH.FONCTION_CREER_LISTE_PROMOTIONS_FILE_NAME);








// -----------------------------------------
// LIENS DES PAGES POUR LA NAVIGATION DU SITE
// -----------------------------------------

/**
 * @brief Lien complet vers la page de la liste des contrôles
 * @note ex : http://localhost/src/index.php?page,controles
 */
define("PAGE_CONTROLES_PATH" , PATH."index.php?page=controles");

/**
 * @brief Lien complet vers la page de la liste des etudiants
 * @note ex : http://localhost/src/index.php?page=etudiants
 */
define("PAGE_ETUDIANTS_PATH" , PATH."index.php?page=etudiants");

/**
 * @brief Lien complet vers la page de la liste des salles
 * @note ex : http://localhost/src/index.php?page=salles
 */
define("PAGE_SALLES_PATH" , PATH."index.php?page=salles");

/**
 * @brief Lien complet vers la page de la politique de confidentialité
 * @note ex : http://localhost/src/index.php?page=politiqueDeConfidentialite
 */
define("PAGE_POLITIQUEDECONFIDENTIALITE_PATH" , PATH."index.php?page=politiqueDeConfidentialite");

/**
 * @brief Lien complet vers la page de mentions légales
 * @note ex : http://localhost/src/index.php?page=mentionsLegalss
 */
define("PAGE_MENTIONSLEGALES_PATH" , PATH."index.php?page=mentionsLegales");

/**
 * @brief Lien complet vers la page de xhoix de génération d'un controle
 * @note ex : http://localhost/src/index.php?page=choixGeneration
 */
define("PAGE_CHOIX_GENERATION_PATH" , PATH."index.php?page=choixGeneration");

/**
 * @brief Lien complet vers la page de génération (qui revoit directement vers la page resultat)
 * @note ex : http://localhost/src/index.php?page=generer
 */
define("PAGE_GENERER_PATH" , PATH."index.php?page=generer");

/**
 * @brief Lien complet vers la page resultat
 * @note ex : http://localhost/src/index.php?page=resultat
 */
define("PAGE_RESULTAT_PATH" , PATH."index.php?page=resultat");

/**
 * @brief Lien complet vers la page de téléchargement
 * @note ex : http://localhost/src/index.php?page=manuelUtilisateur
 */
define("PAGE_MANUELUTILISATEUR_PATH" , PATH."index.php?page=manuelUtilisateur");

?>