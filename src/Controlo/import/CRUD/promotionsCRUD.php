<?php
/**
 * @brief Contient les fonctions CRUD pour les promotions (ajouter, modifier, supprimer, importer)
 * @file etudiantsCRUD.php
 * @version 1.0
 * @date 03/02/2023
 * @author Cédric ETCHEPARE <etcheparecedric@gmail.com>
 */





function ajouterPromotion($unePromotion)
{

    // On initialise un booléen en cas d'erreur
    $ajoutOk = true;

    // Tentative d'écriture du fichier CSV
    try {
        $nomPromotion = $unePromotion->getNom();


        // On verifie si le fichier que l'on souhaite créer existe déjà
        $lienFichier = CSV_ETUDIANTS_FOLDER_NAME . $nomPromotion . ".csv";
        if (file_exists($lienFichier)) {
            throw new Exception("Cette promotion existe déjà");
        }

        // On verifie si le fichier contient une erreur à l'ouverture 
        $file = fopen($lienFichier, "w");
        if ($file == false) {
            throw new Exception("Impossible de créer le fichier CSV");
        }

        // Contient l'entête des fichiers de promotions
        $entete = array(PRENOM_NOM_COLONNE_ETUDIANT, NOM_NOM_COLONNE_ETUDIANT, TD_NOM_COLONNE_ETUDIANT, TP_NOM_COLONNE_ETUDIANT, STATUTS_NOM_COLONNE_ETUDIANT, MAIL_NOM_COLONNE_ETUDIANT);

        // Ajoute l'array dans le CSV
        fputcsv($file, $entete, ";");

        // Fermer le fichier CSV
        fclose($file);

        // Modifier le fichier de liste des promotions
        ajouterAffichagePromotion($unePromotion);

    } catch (Exception $e) {
        $ajoutOk = false;
        throw new Exception($e->getMessage());
    }

    return $ajoutOk;
}

function ajouterAffichagePromotion($unePromotion)
{

    // On initialise un booléen en cas d'erreur
    $ajoutOk = true;

    // Tentative d'écriture du fichier CSV
    try {
        $nomPromotion = $unePromotion->getNom();
        $nomPromotionAffichage = $unePromotion->getNomAffichage();

        $lienFichier = CSV_ETUDIANTS_FOLDER_NAME . "liste-promotions.csv";

        // On verifie si le fichier contient une erreur à l'ouverture 
        $file = fopen($lienFichier, "a");
        if ($file == false) {
            throw new Exception("Impossible d'ecrire dans le fichier de liste de promotions");
        }

        // Contient l'entête des fichiers de promotions
        $noms = array($nomPromotion, $nomPromotionAffichage);

        // Ajoute l'array dans le CSV
        fputcsv($file, $noms, ";");

        // Fermer le fichier CSV
        fclose($file);

    } catch (Exception $e) {
        $ajoutOk = false;
        throw new Exception($e->getMessage());
    }

    return $ajoutOk;



}

function supprimerPromotion($nomPromotion)
{

    // On initialise un booléen en cas d'erreur
    $suppressionOk = true;

    // Tentative de suppression du fichier CSV
    try {

        // On verifie si le fichier que l'on souhaite créer existe déjà
        $lienFichier = CSV_ETUDIANTS_FOLDER_NAME . $nomPromotion . ".csv";
        if (!file_exists($lienFichier)) {
            throw new Exception("Cette promotion n'existe pas");
        }

        // Ouvrir le fichier liste-promotions en lecture afin de vérifier si le nom de la promotion existe
        $fichierListePromo = fopen(CSV_ETUDIANTS_FOLDER_NAME . LISTE_PROMOTIONS_FILE_NAME, "r");
        if ($fichierListePromo == false) {
            throw new Exception("Impossible d'ouvrir le fichier de liste de promotions.");
        }

        // On initialise un tableau qui contiendra les noms de promotions
        $infoFichierListePromo = array();

        $existeListePromo = false;
        // On parcours le fichier liste-promotions
        while (($data = fgetcsv($fichierListePromo, 1000, ";")) !== FALSE) {

            // On vérifie si le nom de la promotion existe
            if ($data[0] == $nomPromotion) {
                $existeListePromo = true;
            }

            // On ajoute les informations du fichier dans le tableau
            $infoFichierListePromo[] = $data;
        }

        // On ferme le fichier liste-promotions
        fclose($fichierListePromo);

        // Supprimer dans le fichier liste-promotions la promotion
        if ($existeListePromo) {

            // On ouvre le fichier liste-promotions en écriture
            $fichierListePromo = fopen(CSV_ETUDIANTS_FOLDER_NAME . LISTE_PROMOTIONS_FILE_NAME, "w");
            if ($fichierListePromo == false) {
                throw new Exception("Impossible d'ouvrir le fichier de liste de promotions.");
            }

            // On parcours le tableau qui contient les informations du fichier liste-promotions
            foreach ($infoFichierListePromo as $info) {

                // On vérifie si le nom de la promotion existe
                if ($info[0] != $nomPromotion) {
                    // On ajoute les informations du fichier dans le tableau
                    fputcsv($fichierListePromo, $info, ";");
                }
            }

            // On ferme le fichier liste-promotions
            fclose($fichierListePromo);
        }

        // Suppression du fichier de la promotion
        unlink($lienFichier);

        // Cas d'erreur
        if (file_exists($lienFichier)) {
            throw new Exception("Impossible de supprimer le fichier CSV");
        }

    } catch (Exception $e) {
        $suppressionOk = false;
        throw new Exception($e->getMessage());
    }
    return $suppressionOk;
}


function modifierPromotion($anciennePromo, $nouvellePromo){
    try{
        $nomAnciennePromo = trim($anciennePromo->getNom());
        $nomNouvellePromo = trim($nouvellePromo->getNom());

        $nomAffichageAnciennePromo = trim($anciennePromo->getNomAffichage());
        $nomAffichageNouvellePromo = trim($nouvellePromo->getNomAffichage());
        if($nomAffichageNouvellePromo == ""){
            $nomAffichageNouvellePromo = $nomNouvellePromo;
        }

        // On vérifie si le nom de l'ancienne promotion diffère
        if($nomAnciennePromo != $nomNouvellePromo){
            // On vérifie si le nom de la nouvelle promotion existe déjà dans le dossier
            if(file_exists(CSV_ETUDIANTS_FOLDER_NAME . $nomNouvellePromo . ".csv")){
                throw new Exception("Le nom de la promotion existe déjà");
            }

            // On renomme le fichier de la promotion
            rename(CSV_ETUDIANTS_FOLDER_NAME . $nomAnciennePromo . ".csv",
                CSV_ETUDIANTS_FOLDER_NAME . $nomNouvellePromo . ".csv");
        }

        // Modifier le nom de la promotion dans le fichier liste-promotions

        // Ouvrir le fichier liste-promotions en lecture afin de vérifier si le nom de la promotion existe
        $fichierListePromo = fopen(CSV_ETUDIANTS_FOLDER_NAME . LISTE_PROMOTIONS_FILE_NAME, "r");

        if ($fichierListePromo == false) {
            throw new Exception("Impossible d'ouvrir le fichier de liste de promotions.");
        }

        // On initialise un tableau qui contiendra les noms de promotions

        $infoFichierListePromo = array();

        $indiceListePromo = null;
        $indiceActuelFichier = 0;

        // On parcours le fichier liste-promotions
        while (($data = fgetcsv($fichierListePromo, 1000, ";")) !== FALSE) {

            // On vérifie si le nom de la promotion existe
            if (strtolower(trim($data[0])) == strtolower(trim($nomAnciennePromo))) {
                $indiceListePromo = count($infoFichierListePromo);
            }

            // On ajoute les informations du fichier dans le tableau
            $infoFichierListePromo[] = $data;
            $indiceActuelFichier++;
        }

        // On ferme le fichier liste-promotions
        fclose($fichierListePromo);

        // On modifie avec les nouvelles infos
        $infoFichierListePromo[$indiceListePromo][0] = $nomNouvellePromo;
        $infoFichierListePromo[$indiceListePromo][1] = $nomAffichageNouvellePromo;

        // On ouvre le fichier liste-promotions en écriture
        $fichierListePromo = fopen(CSV_ETUDIANTS_FOLDER_NAME . LISTE_PROMOTIONS_FILE_NAME, "w");
        if ($fichierListePromo == false) {
            throw new Exception("Impossible d'ouvrir le fichier de liste de promotions.");
        }

        // On parcours le tableau qui contient les informations du fichier liste-promotions
        foreach ($infoFichierListePromo as $info) {
            // On ajoute les informations du fichier dans le tableau
            fputcsv($fichierListePromo, $info, ";");
        }

        // On ferme le fichier liste-promotions
        fclose($fichierListePromo);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}

?>