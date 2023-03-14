<?php 


include_once(CLASS_PATH.CLASS_UTILISATEUR_FILE_NAME);


function creerListeUtilisateurs($affichageErreur = false){
    try{
        $listeUtilisateurs = array();

        // Ouvrir le fichier CSV
        $fichier = fopen(CSV_UTILISATEURS_FOLDER_NAME, "r");

        // Cas d'erreur : le fichier ne peut pas être ouvert
        if($fichier == false){
            throw new Exception("Impossible d'ouvrir le fichier CSV ".LISTE_UTILISATEURS_FILE_NAME);
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
                $nom = $ligne[4];
                $prenom = $ligne[5];
                $role = $ligne[3];
                $mail = $ligne[1];

                // Créer l'objet Utilisateur
                $utilisateur = new Utilisateur($nom, $prenom, $role, $mail);

                // Ajouter l'objet Utilisateur à la liste
                array_push($listeUtilisateurs, $utilsateur);
            }
            
            $id++;
        }
        return $listeUtilisateurs;
    }
    catch(Exception $e){
        if($affichageErreur){
            throw new Exception($e->getMessage());
        }
        return false;
    }
}


?>