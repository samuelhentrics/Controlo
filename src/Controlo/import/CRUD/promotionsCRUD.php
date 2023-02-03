
<?php
/**
 * @brief Contient les fonctions CRUD pour les promotions (ajouter, modifier, supprimer, importer)
 * @file etudiantsCRUD.php
 * @version 1.0
 * @date 03/02/2023
 * @author Cédric ETCHEPARE <etcheparecedric@gmail.com>
 */


/**
 * @brief Ajoute une nouvelle promotion dans le fichier CSV des listes de promotions (selon la promotion donnée)
 * @param string $nomEtudiant Nom de l'étudiant
 * @param string $prenomEtudiant Prénom de l'étudiant
 * @param string $nomPromotion Nom de la promotion de l'étudiant
 * @param int $tdEtudiant TD de l'étudiant
 * @param int $tpEtudiant TP de l'étudiant
 * @param string $emailEtudiant Email de l'étudiant
 * @param string $tiersTempsEtudiant Tiers-temps de l'étudiant (vrai s'il en dispose, faux sinon)
 * @param string $ordinateurEtudiant Ordinateur de l'étudiant (vrai s'il en dispose, faux sinon)
 * @param string $demissionnaireEtudiant Démissionnaire de l'étudiant (vrai s'il est démissionnaire, faux sinon)
 * @throws Exception Si le fichier CSV ne contient pas les champs obligatoires de la nomenclature
 * @return bool Retourne vrai si l'ajout s'est bien passé, faux sinon
 */


function ajouterPromotion($nomPromotion){

        // On initialise un booléen en cas d'erreur
        $ajoutOk = true;

        
        // Tentative d'écriture du fichier CSV
        try {

            // On verifie si le fichier que l'on souhaite créer exite déjà
            $lienFichier = CSV_ETUDIANTS_FOLDER_NAME.$nomPromotion.".csv";
            if (file_exists($lienFichier)){
                throw new Exception("Cette promotion existe déjà");
            }

            // On verifie si le fichier contient une erreur à l'ouverture 
            $file =  fopen($lienFichier  , "w");
            if ($file == false){
                throw new Exception("Impossible de créer le fichier CSV");
            }

            // Contient l'entête des fichiers de promotions
            $entete = array(PRENOM_NOM_COLONNE_ETUDIANT, NOM_NOM_COLONNE_ETUDIANT, TD_NOM_COLONNE_ETUDIANT, TP_NOM_COLONNE_ETUDIANT, STATUTS_NOM_COLONNE_ETUDIANT, MAIL_NOM_COLONNE_ETUDIANT);

            // Ajoute l'array dans le CSV
            fputcsv($file, $entete, ";");

            // Fermer le fichier CSV
            fclose($file);

    } catch (Exception $e) {
        $ajoutOk = false;
        throw new Exception($e->getMessage());
    }

    return $ajoutOk;
}
?>
