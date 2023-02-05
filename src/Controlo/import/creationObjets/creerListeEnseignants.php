<?php 
/**
 * @file creerListeEnseignants.php
 * @brief Contient les fonctions pour la création d'enseignants
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @version 1.0
 */

include_once(CLASS_PATH.CLASS_ENSEIGNANT_FILE_NAME);

/**
 * @brief Créer la liste des enseignants
 * @param bool $affichageErreur
 * @throws Exception
 * @return array|bool Liste des enseignants
 */
function creerListeEnseignants($affichageErreur = false){
    try{
        $listeEnseignants = array();

        // Ouvrir le fichier CSV
        $fichier = fopen(CSV_ENSEIGNANTS_FOLDER_NAME.LISTE_ENSEIGNANTS_FILE_NAME, "r");

        // Cas d'erreur : le fichier ne peut pas être ouvert
        if($fichier == false){
            throw new Exception("Impossible d'ouvrir le fichier CSV ".LISTE_ENSEIGNANTS_FILE_NAME);
        }

        // Enlever l'entête du fichier CSV
        fgetcsv($fichier, 0, ";");

        $id = 0;
        // Lire le fichier CSV
        while(!feof($fichier)){
            $ligne = fgetcsv($fichier, 0, ";");

            // Si la ligne n'est pas vide
            if($ligne != false){
                // Récupérer les informations de l'enseignant
                $nom = $ligne[0];
                $prenom = $ligne[1];

                if(strtolower(trim($ligne[2])) == "titulaire"){
                    $estTitulaire = true;
                }
                else{
                    $estTitulaire = false;
                }

                // Créer l'objet Enseignant
                $enseignant = new Enseignant($id, $nom, $prenom, $estTitulaire);

                // Ajouter l'objet Enseignant à la liste
                array_push($listeEnseignants, $enseignant);
            }
            
            $id++;
        }
        return $listeEnseignants;
    }
    catch(Exception $e){
        if($affichageErreur){
            throw new Exception($e->getMessage());
        }
        return false;
    }
}

?>