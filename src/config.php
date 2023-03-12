<?php
/**
 * @file        config.php
 * @brief       Contient les variables d'environnement pour la bonne configuration du projet
 * @author      Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>, Benjamin PEYRE
 * @version     1.5
 * @date       05/02/2023
 */

// Désactive les informations d'erreur (pour le mode non-dev)
//ini_set('display_errors','off');

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

define("NOM_IUT", "IUT DE BAYONNE ET DU PAYS BASQUE");
define("DEPARTEMENT", "Département Informatique");
define("ANNEE_UNIVERSITAIRE", "2022-2023");





// -----------------------------------------
// DOSSIER SAUVEGARDE
// -----------------------------------------

/**
 * @brief Nom du dossier où se retrouvent les sauvegardes
 * @note ex : Sauvegardes/
 */
define("SAUVEGARDES_FOLDER_NAME","Sauvegardes/");



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
 * @brief Nom du dossier où se retrouvent les CSV (partie Enseignants)
 * (La liste des enseignants)
 * @note ex : Enseignants/
 */
define("CSV_ENSEIGNANTS_FOLDER_NAME","Enseignants/");

/**
 * @brief Nom du dossier où se retrouvent les CSV (partie Salles)
 * (La liste des salles et des plans de salle)
 * @note ex : Salles/
 */
define("CSV_SALLES_FOLDER_NAME","Salles/");

/**
 * @brief Nom du dossier où se retrouvent les CSV (partie Promotions)
 * (La liste des salles et des plans de salle)
 * @note ex : Promotions/
 */
define("CSV_PROMOTIONS_FOLDER_NAME","Promotions/");

/**
 * @brief Nom du dossier où se retrouvent les CSV (partie Utilisateurs)
 * (La liste des utilisateurs)
 * @note ex : Utilisateurs/
 */
define("CSV_UTILISATEURS_FOLDER_NAME","Utilisateurs/");

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

/**
 * @brief Lien complet pour accéder au dossier CSV (Utilisateurs)
 * @note ex : http://localhost/src/Utilisateurs
 */
define("CSV_UTILISATEURS_PATH", PATH.CSV_UTILISATEURS_FOLDER_NAME);


/**
 * @brief Lien vers le message de mail par defaut
 * @note ex : Utilisateurs/MessageMailDefaut.txt
 */
define("MESSAGE_MAIL_DEFAUT_PATH", CSV_UTILISATEURS_FOLDER_NAME."MessageMailDefaut.txt");




// -----------------------------------------
// DOSSIERS DE GENERATION
// -----------------------------------------

/**
 * @brief Nom du dossier où se retrouvent les fichiers générés
 * @note ex : Generations/
 */
define("GENERATIONS_FOLDER_NAME", "Generations/");

/**
 * @brief Lien complet pour accéder au dossier de génération
 * @note ex : http://localhost/src/Generations
 */
define("GENERATIONS_PATH", PATH.GENERATIONS_FOLDER_NAME);


// -----------------------------------------
// DOSSIER GENERATION PDF PLANS DE PLACEMENT
// -----------------------------------------


/**
 * @brief Nom du dossier où se trouvent les plans de placement générés
 * @note ex : PlansPlacement/
 */
define("PLANS_DE_PLACEMENT_FOLDER_NAME", "PlansPlacement/");

/**
 * @brief Nom du dossier où se trouvent les plans de placement générés
 * @note ex : PDF/
 */
define("PLANS_DE_PLACEMENT_PDF_FOLDER_NAME", "PDF/");

/**
 * @brief Lien complet pour accéder au dossier des plans de placement
 * @note ex : PlansPlacement/PDF
 */
define("PLANS_DE_PLACEMENT_PDF_PATH", PLANS_DE_PLACEMENT_FOLDER_NAME.PLANS_DE_PLACEMENT_PDF_FOLDER_NAME);

/**
 * @brief Nom du dossier où se trouvent les plans de placement générés
 * @note ex : CSV/
 */
define("PLANS_DE_PLACEMENT_CSV_FOLDER_NAME", "CSV/");

/**
 * @brief Lien complet pour accéder au dossier des plans de placement
 * @note ex : PlansPlacement/CSV
 */
define("PLANS_DE_PLACEMENT_CSV_PATH", PLANS_DE_PLACEMENT_FOLDER_NAME.PLANS_DE_PLACEMENT_CSV_FOLDER_NAME);


// -----------------------------------------
// DOSSIER GENERATION FEUILLES EMARGEMENT
// -----------------------------------------

/**
 * @brief Nom du dossier où se trouvent les feuilles d'emargement générées
 * @note ex : FeuillesEmargement/
 */
define("FEUILLES_EMARGEMENT_FOLDER_NAME", "FeuillesEmargement/");







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
 * @brief Nom du fichier de la classe Etudiant
 * @note ex : Etudiants.php
 */
define("CLASS_ETUDIANT_FILE_NAME" , "Etudiant.php");

/**
 * @brief Nom du fichier de la classe Enseignant
 * @note ex : Etudiants.php
 */
define("CLASS_ENSEIGNANT_FILE_NAME" , "Enseignant.php");

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

/**
 * @brief Nom du fichier de la liste des promotions
 * @note ex: liste-promotions.csv
 */
define("LISTE_PROMOTIONS_FILE_NAME" , "liste-promotions.csv");

/**
 * @brief Nom du fichier de la liste des enseignants
 * @note ex: liste-enseignants.csv
 */
define("LISTE_ENSEIGNANTS_FILE_NAME" , "liste-enseignants.csv");

/**
 * @brief Nom du fichier de la liste des utilisateurs
 * @note ex: liste-utilisateurs.csv
 */
define("LISTE_UTILISATEURS_FILE_NAME" , "liste-utilisateurs.csv");












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
 * @note ex : localhost/src/Controlo/Front/css
 */
define("CSS_PATH" , PATH.FRONT_PATH.CSS_FOLDER_NAME);

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier image
 * @note ex : localhost/src/Controlo/Front/images
 */
define("IMG_PATH" , PATH.FRONT_PATH.IMG_FOLDER_NAME);

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier videos
 * @note ex : localhost/src/Controlo/Front/videos
 */
define("VIDEOS_PATH" , PATH.FRONT_PATH.VIDEOS_FOLDER_NAME);


/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier js
 * @note ex : localhost/src/Controlo/Front/js
 */
define("JS_PATH" , PATH.FRONT_PATH.JS_FOLDER_NAME);














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
 * @brief Nom du fichier où se trouve la fonction mailSend
 * @note ex : mailSend.php
 */
define("FONCTION_MAILS_FILE_NAME" , "mailSend.php");

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction mailSend
 * @note ex : Controlo/import/mailSend.php
 */
define("FONCTION_MAILS_PATH" , IMPORT_PATH.FONCTION_MAILS_FILE_NAME);



/**
 * @brief Nom du fichier où se trouve la fonction associerEnteteLigne
 * @note ex : associerEnteteLigne.php
 */
define("FONCTION_ASSOCIER_ENTETE_LIGNE_FILE_NAME" , "associerEnteteLigne.php");

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction associerEnteteLigne
 * @note ex : Controlo/import/associerEnteteLigne.php
 */
define("FONCTION_ASSOCIER_ENTETE_LIGNE_PATH" , IMPORT_PATH.FONCTION_ASSOCIER_ENTETE_LIGNE_FILE_NAME);

/**
 * @brief Nom du fichier où se trouve la fonction genererPDP
 * @note ex : genererPDP.php
 */
define("FONCTION_GENERER_PDP_FILE_NAME" , "genererPDP.php");


/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction genererPDP
 * @note ex : Controlo/import/genererPDP.php
 */
define("FONCTION_GENERER_PDP_PATH" , IMPORT_PATH.FONCTION_GENERER_PDP_FILE_NAME);

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
 * @brief Nom du fichier où se trouve la fonction de création de la liste des enseignants
 * @note ex: creerListeEnseignants.php
 */
define("FONCTION_CREER_LISTE_ENSEIGNANTS_FILE_NAME" , "creerListeEnseignants.php");

/**
 * @brief Lien complet (sans l'adresse du serveur) où se trouve la fonction de création de la liste des enseignants
 * @note ex : Controlo/creationObjets/creerListeEnseignants.php
 */
define("FONCTION_CREER_LISTE_ENSEIGNANTS_PATH" , OBJECT_CREATION_PATH.FONCTION_CREER_LISTE_ENSEIGNANTS_FILE_NAME);



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

/** 
 * @brief Nom du fichier où se trouve le dossier des fonctions CRUD
 * @note ex : crud/
 */
define("CRUD_FOLDER_NAME" , "CRUD/");

/** 
 * @brief Lien complet (sans l'adresse du serveur) où se trouve le dossier des fonctions CRUD
 * @note ex : Controlo/import/crud/
 */
define("CRUD_PATH" , IMPORT_PATH.CRUD_FOLDER_NAME);

/** 
 * @brief Nom du fichier où se trouve les fonctions CRUD des contrôles
 * @note ex : controlesCRUD.php
 */
define("FONCTION_CRUD_CONTROLES_FILE_NAME" , "controlesCRUD.php");

/** 
 * @brief Lien complet (sans l'adresse du serveur) où se trouve les fonctions CRUD des contrôles
 * @note ex : Controlo/import/crud/controlesCRUD.php
 */
define("FONCTION_CRUD_CONTROLE_PATH" , CRUD_PATH.FONCTION_CRUD_CONTROLES_FILE_NAME);

/** 
 * @brief Nom du fichier où se trouve les fonctions CRUD des étudiants
 * @note ex : etudiantsCRUD.php
 */
define("FONCTION_CRUD_ETUDIANTS_FILE_NAME" , "etudiantsCRUD.php");

/** 
 * @brief Lien complet (sans l'adresse du serveur) où se trouve les fonctions CRUD des étudiants
 * @note ex : Controlo/import/crud/etudiantsCRUD.php
 */
define("FONCTION_CRUD_ETUDIANTS_PATH" , CRUD_PATH.FONCTION_CRUD_ETUDIANTS_FILE_NAME);

/** 
 * @brief Nom du fichier où se trouve les fonctions CRUD des enseignants
 * @note ex : enseignantsCRUD.php
 */
define("FONCTION_CRUD_ENSEIGNANTS_FILE_NAME" , "enseignantsCRUD.php");

/** 
 * @brief Lien complet (sans l'adresse du serveur) où se trouve les fonctions CRUD des enseignants
 * @note ex : Controlo/import/crud/enseignantsCRUD.php
 */
define("FONCTION_CRUD_ENSEIGNANTS_PATH" , CRUD_PATH.FONCTION_CRUD_ENSEIGNANTS_FILE_NAME);

/** 
 * @brief Nom du fichier où se trouve les fonctions CRUD des promotions
 * @note ex : promotionsCRUD.php
 */
define("FONCTION_CRUD_PROMOTIONS_FILE_NAME" , "promotionsCRUD.php");

/** 
 * @brief Lien complet (sans l'adresse du serveur) où se trouve les fonctions CRUD des promotions
 * @note ex : Controlo/import/crud/promotionsCRUD.php
 */
define("FONCTION_CRUD_PROMOTIONS_PATH" , CRUD_PATH.FONCTION_CRUD_PROMOTIONS_FILE_NAME);

/** 
 * @brief Nom du fichier où se trouve les fonctions CRUD des salles
 * @note ex : sallesCRUD.php
 */
define("FONCTION_CRUD_SALLES_FILE_NAME" , "sallesCRUD.php");

/** 
 * @brief Lien complet (sans l'adresse du serveur) où se trouve les fonctions CRUD des salles
 * @note ex : Controlo/import/crud/sallesCRUD.php
 */
define("FONCTION_CRUD_SALLES_PATH" , CRUD_PATH.FONCTION_CRUD_SALLES_FILE_NAME);





// -----------------------------------------
// COLONNES DU CSV CONTROLE
// -----------------------------------------

/** 
 * @brief Nom de la colonne contenant la promotion
 * @note ex du contenu : Info semestre 1
 */
define("PROMOTION_NOM_COLONNE_CONTROLE", "Promotion");

define("ENSEIGNANT_REF_NOM_COLONNE_CONTROLE", "Enseignant");

/** 
 * @brief Nom de la colonne contenant le nom long du contrôle
 * @note ex du contenu : R1.01 - Initiation au dÃ©veloppement (Partie  1)

 */
define("NOM_LONG_NOM_COLONNE_CONTROLE", "Module/Ressource nom Complet");

/** 
 * @brief Nom de la colonne contenant le nom court du contrôle
 * @note ex du contenu : R1.01 - Initiation au dÃ©v.
 */
define("NOM_COURT_NOM_COLONNE_CONTROLE", "Modules/Ressource nom EDT");

/** 
 * @brief Nom de la colonne contenant la durée du contrôle (en minutes)
 * @note ex du contenu : 120
 */
define("DUREE_NOM_COLONNE_CONTROLE", "Durée");

/** 
 * @brief Nom de la colonne contenant la date du contrôle
 * @note ex du contenu : 28/09/2022
 */
define("DATE_NOM_COLONNE_CONTROLE", "Date");

/** 
 * @brief Nom de la colonne contenant l'heure de début du contrôle (pour les non TT)
 * @note ex du contenu : 08:30
 */
define("HEURE_NOM_COLONNE_CONTROLE", "Heure");

/** 
 * @brief Nom de la colonne contenant l'heure de début du contrôle (pour les TT)
 * @note ex du contenu : 08:30
 */
define("HEURE_TT_NOM_COLONNE_CONTROLE", "HeureTT");

/** 
 * @brief Nom de la colonne contenant la liste des salles du contrôle
 * @note ex du contenu : S124,S125,S126
 */
define("SALLES_NOM_COLONNE_CONTROLE", "Salles");

/** 
 * @brief Nom de la colonne contenant la liste des surveillants du contrôle
 * @note ex du contenu : S124,S125,S126
 */
define("SURVEILLANTS_NOM_COLONNE_CONTROLE", "Surveillants");





// -----------------------------------------
// COLONNES DU CSV ETUDIANT
// -----------------------------------------

/** 
 * @brief Nom de la colonne contenant le nom de l'étudiant
 * @note ex du contenu : Dupont
 */
define("NOM_NOM_COLONNE_ETUDIANT", "Nom");

/** 
 * @brief Nom de la colonne contenant le prénom de l'étudiant
 * @note ex du contenu : Jean
 */
define("PRENOM_NOM_COLONNE_ETUDIANT", "Prenom");

/** 
 * @brief Nom de la colonne contenant le TD de l'étudiant
 * @note ex du contenu : 1
 */
define("TD_NOM_COLONNE_ETUDIANT", "Groupe TD");

/** 
 * @brief Nom de la colonne contenant le TP de l'étudiant
 * @note ex du contenu : 1
 */
define("TP_NOM_COLONNE_ETUDIANT", "Groupe TP");

/** 
 * @brief Nom de la colonne contenant l'email de l'étudiant
 * @note ex du contenu : shloistine@iutbayonne.univ-pau.fr
 */
define("MAIL_NOM_COLONNE_ETUDIANT", "Courriel");

/** 
 * @brief Nom de la colonne contenant les statuts de l'étudiant
 * @note ex du contenu : Démissionnaire, Tiers-temps
 */
define("STATUTS_NOM_COLONNE_ETUDIANT", "Statuts");




// -----------------------------------------
// LIENS DES PAGES POUR LA NAVIGATION DU SITE
// -----------------------------------------

/**
 * @brief Lien complet vers la page de la liste des contrôles
 * @note ex : http://localhost/src/index.php?page=controles
 */
define("PAGE_CONTROLES_PATH" , PATH."index.php?page=controles");

/**
 * @brief Lien complet vers la gestion d'un contrôle
 * @note ex : http://localhost/src/index.php?page=controles&action=panel
 */
define("PAGE_PANEL_CONTROLE_PATH" , PATH."index.php?page=controles&action=panel");

/**
 * @brief Lien complet vers la page d'ajout d'un contrôle
 * @note ex : http://localhost/src/index.php?page=controles&action=ajouter
 */
define("PAGE_AJOUTER_CONTROLE_PATH" , PATH."index.php?page=controles&action=ajouter");

/**
 * @brief Lien complet vers la page d'importation d'un contrôle
 * @note ex : http://localhost/src/index.php?page=controles&action=importer
 */
define("PAGE_IMPORTER_CONTROLE_PATH" , PATH."index.php?page=controles&action=importer");

/**
 * @brief Lien complet vers la page de modification d'un contrôle
 * @note ex : http://localhost/src/index.php?page=controles&action=modifier
 */
define("PAGE_MODIFIER_CONTROLE_PATH" , PATH."index.php?page=controles&action=modifier");

/**
 * @brief Lien complet vers la page de suppression d'un contrôle
 * @note ex : http://localhost/src/index.php?page=controles&action=supprimer
 */
define("PAGE_SUPPRIMER_CONTROLE_PATH" , PATH."index.php?page=controles&action=supprimer");

/**
 * @brief Lien complet vers la page de téléchargement d'un plan de placement d'un contrôle
 * @note ex : http://localhost/src/index.php?page=controles&action=telechargerPDP
 */
define("PAGE_TELECHARGER_PDP_CONTROLE_PATH" , PATH."index.php?page=controles&action=telechargerPDP");

/**
 * @brief Lien complet vers la page de téléchargement des feuilles d'émargement d'un contrôle
 * @note ex : http://localhost/src/index.php?page=controles&action=telechargerFE
 */
define("PAGE_TELECHARGER_FE_CONTROLE_PATH" , PATH."index.php?page=controles&action=telechargerFE");

/**
 * @brief Lien complet vers la page d'envoi de mails d'un contrôle
 * @note ex : http://localhost/src/index.php?page=controles&action=envoyerMails
 */
define("PAGE_ENVOYER_MAILS_CONTROLE_PATH" , PATH."index.php?page=controles&action=envoyerMails");

/**
 * @brief Lien complet vers la page de la liste des etudiants
 * @note ex : http://localhost/src/index.php?page=etudiants
 */
define("PAGE_ETUDIANTS_PATH" , PATH."index.php?page=etudiants");

/**
 * @brief Lien complet vers la page d'ajout d'un etudiant
 * @note ex : http://localhost/src/index.php?page=etudiants&action=ajouter
 */
define("PAGE_AJOUTER_ETUDIANT_PATH" , PATH."index.php?page=etudiants&action=ajouter");

/**
 * @brief Lien complet vers la page de modification d'un étudiant
 * @note ex : http://localhost/src/index.php?page=etudiants&action=modifier
 */
define("PAGE_MODIFIER_ETUDIANT_PATH" , PATH."index.php?page=etudiants&action=modifier");
/**
 * @brief Lien complet vers la page de modification d'un étudiant
 * @note ex : http://localhost/src/index.php?page=etudiants&action=supprimer
 */
define("PAGE_SUPPRIMER_ETUDIANT_PATH" , PATH."index.php?page=etudiants&action=supprimer");

/**
 * @brief Lien complet vers la page de la liste des enseignants
 * @note ex : http://localhost/src/index.php?page=enseignants
 */
define("PAGE_ENSEIGNANTS_PATH" , PATH."index.php?page=enseignants");

/**
 * @brief Lien complet vers la page d'ajoût d'un enseignant
 * @note ex : http://localhost/src/index.php?page=enseignants&action=ajouter
 */
define("PAGE_AJOUTER_ENSEIGNANT_PATH" , PATH."index.php?page=enseignants&action=ajouter");

/**
 * @brief Lien complet vers la page de modification d'un enseignant
 * @note ex : http://localhost/src/index.php?page=enseignants&action=modifier
 */
define("PAGE_MODIFIER_ENSEIGNANT_PATH" , PATH."index.php?page=enseignants&action=modifier");

/**
 * @brief Lien complet vers la page de suppression d'un enseignant
 * @note ex : http://localhost/src/index.php?page=enseignants&action=supprimer
 */
define("PAGE_SUPPRIMER_ENSEIGNANT_PATH" , PATH."index.php?page=enseignants&action=supprimer");


/**
 * @brief Lien complet vers la page de la liste des salles
 * @note ex : http://localhost/src/index.php?page=salles
 */
define("PAGE_SALLES_PATH" , PATH."index.php?page=salles");

/**
 * @brief Lien complet vers la page de promotion
 * @note ex : http://localhost/src/index.php?page=promotions
 */
define("PAGE_PROMOTIONS_PATH" , PATH."index.php?page=promotions");

/**
 * @brief Lien complet vers la page d'ajout d'une promotion
 * @note ex : http://localhost/src/index.php?page=promotions&action=ajouter
 */
define("PAGE_AJOUTER_PROMOTION_PATH" , PATH."index.php?page=promotions&action=ajouter");

/**
 * @brief Lien complet vers la page d'import d'une promotion
 * @note ex : http://localhost/src/index.php?page=promotions&action=importer
 */
define("PAGE_IMPORTER_PROMOTION_PATH" , PATH."index.php?page=promotions&action=importer");

/**
 * @brief Lien complet vers la page de modification d'une promotion
 * @note ex : http://localhost/src/index.php?page=promotions&action=modifier
 */
define("PAGE_MODIFIER_PROMOTION_PATH" , PATH."index.php?page=promotions&action=modifier");

/**
 * @brief Lien complet vers la page de suppression d'une promotion
 * @note ex : http://localhost/src/index.php?page=promotions&action=supprimer
 */
define("PAGE_SUPPRIMER_PROMOTION_PATH" , PATH."index.php?page=promotions&action=supprimer");



/**
 * @brief Lien complet vers la page d'un plan d'une salle
 * @note ex : http://localhost/src/index.php?page=salles&action=plan
 */
define("PAGE_PLAN_SALLE_PATH" , PATH."index.php?page=salles&action=plan");

/**
 * @brief Lien complet vers la page d'ajout d'une salle
 * @note ex : http://localhost/src/index.php?page=ajouter
 */
define("PAGE_AJOUTER_SALLE_PATH" , PATH."index.php?page=salles&action=ajouter");

/**
 * @brief Lien complet vers la page d'ajout d'une salle
 * @note ex : http://localhost/src/index.php?page=ajouter2
 */
define("PAGE_AJOUTER2_SALLE_PATH" , PATH."index.php?page=salles&action=ajouter2");

/**
 * @brief Lien complet vers la page d'importation d'une salle
 * @note ex : http://localhost/src/index.php?page=importer
 */
define("PAGE_IMPORTER_SALLE_PATH" , PATH."index.php?page=salles&action=importer");

/**
 * @brief Lien complet vers la page de modification d'une salle
 * @note ex : http://localhost/src/index.php?page=modifier
 */
define("PAGE_MODIFIER_SALLE_PATH" , PATH."index.php?page=salles&action=modifier");

/**
 * @brief Lien complet vers la page de suppression d'une salle
 * @note ex : http://localhost/src/index.php?page=supprimer
 */
define("PAGE_SUPPRIMER_SALLE_PATH" , PATH."index.php?page=salles&action=supprimer");


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
 * @brief Lien complet vers la page de placement automatique
 * @note ex : http://localhost/src/index.php?page=choixGeneration
 */
define("PAGE_PLACEMENT_AUTO_PATH" , PATH."index.php?page=controles&action=placementAuto");

/**
 * @brief Lien complet vers la page de génération (qui revoit directement vers la page resultat)
 * @note ex : http://localhost/src/index.php?page=generer
 */
define("PAGE_GENERER_PATH" , PATH."index.php?page=generer");

/**
 * @brief Lien complet vers la page resultat
 * @note ex : http://localhost/src/index.php?page=resultatPdp
 */
define("PAGE_RESULTAT_PDP_PATH" , PATH."index.php?page=resultatPdp");

/**
 * @brief Lien complet vers la page de téléchargement
 * @note ex : http://localhost/src/index.php?page=manuelUtilisateur
 */
define("PAGE_MANUELUTILISATEUR_PATH" , PATH."index.php?page=manuelUtilisateur");

/**
 * @brief Lien complet vers la page de connexion
 * @note ex : http://localhost/src/index.php?page=login
 */
define("PAGE_CONNEXION_PATH" , PATH."index.php?page=login");

/**
 * @brief Lien complet vers la page de déconnexion
 * @note ex : http://localhost/src/index.php?page=logout
 */
define("PAGE_DECONNEXION_PATH", PATH."index.php?page=logout");

/**
 * @brief Lien complet vers la page des utilisateurs
 * @note ex : http://localhost/src/index.php?page=utilisateurs
 */
define("PAGE_UTILISATEURS_PATH", PATH."index.php?page=utilisateurs");


// Lancement de la sauvegarde
//include_once(IMPORT_PATH."sauvegarde.php");
//sauvegarde();

?>