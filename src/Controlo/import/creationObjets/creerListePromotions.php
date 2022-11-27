<?php

include(CLASS_PATH.CLASS_PROMOTION_FILE_NAME);
include(CLASS_PATH.CLASS_ETUDIANT_FILE_NAME);

/**
 * Fonction permettant d'obtenir la liste de toutes les promotions
 *
 * @return array $listePromotions
 *
 */
function creerListePromotions(){

    $listePromotions = array();

    // On va traiter chaque fichier dans le dossier /Etudiants/
    $scandir = scandir(CSV_ETUDIANTS_FOLDER_NAME);
    foreach($scandir as $nomFichier){
        
        // S'il s'agit d'un fichier CSV, on suppose qu'il s'agit d'un fichier d'étudiants
        if(preg_match("#\.(csv)$#",strtolower($nomFichier))){
            // On récupére le nom de la promotion
            $nomPromotion = substr($nomFichier,0,-4);
            
            // On récupére une promotion
            $unePromotion = creerUnePromotion($nomPromotion);

            // On ajoute la promotion à la liste des promotions
            $listePromotions[$nomPromotion] = $unePromotion;
            
        }
    }
    return $listePromotions;

}

function creerUnePromotion($nomPromotion){
    $monFichier = fopen(CSV_ETUDIANTS_FOLDER_NAME.$nomPromotion.".csv", "r");

    // Créer la liste des controles en lisant le fichier CSV

    if (!($monFichier)) {
        print("Impossible d'ouvrir le fichier \n");
        exit;
    } else {
        // Création d'un objet Promotion
        $maPromotion = new Promotion($nomPromotion);

        // Création d'une liste d'étudiants
        $uneListeEtudiants = array();

        // On enleve l'entete
        fgetcsv($monFichier, null, ";");

        // Lecture du reste du CSV
        while ($data = fgetcsv($monFichier, null, ";")) {
            // Création d'un contrôle de la ligne actuelle
            $nomEtudiant = $data[0];
            $prenomEtudiant = $data[1];
            $tdEtudiant = $data[4];
            $tpEtudiant = $data[5];
            $emailEtudiant = $data[11];

            // Création d'un objet de type Controle avec les informations
            // de la ligne courante que l'on traite dans le CSV
            $unEtudiant = new Etudiant($nomEtudiant, $prenomEtudiant, $tdEtudiant, $tpEtudiant, $emailEtudiant);
          
            
            // Traiter si l'étudiant dispose d'un tiers temps
            $unEtudiant->setEstTT(false);

            // Traiter si l'étudiant dispose d'un ordinateur
            $unEtudiant->setAOrdi(false);
            // Traiter si l'étudiant est demissionaire
            $unEtudiant->setEstDemissionnaire(false);

            // Ajout de l'étudiant dans la liste des étudiants (clé de la liste = l'email de l'étudiant)
            $maPromotion->ajouterEtudiant($unEtudiant);
        }
    }

    fclose($monFichier);

    return $maPromotion;
}



?>