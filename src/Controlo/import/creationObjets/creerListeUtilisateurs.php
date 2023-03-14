<?php 


include_once(CLASS_PATH.CLASS_UTILISATEUR_FILE_NAME);


function creerListeUtilisateurs($affichageErreur = false){
    try{
        $listeUtilisateurs = array();

        // Ouvrir le fichier CSV
        $fichier = fopen(CSV_UTILISATEURS_FOLDER_NAME . LISTE_UTILISATEURS_FILE_NAME, "r");

        // Cas d'erreur : le fichier ne peut pas être ouvert
        if($fichier === false){
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
                $nom = utf8_encode($ligne[4]);
                $prenom = utf8_encode($ligne[5]);
                $role = utf8_encode($ligne[3]);
                $mail = utf8_encode($ligne[1]);
                $mdp = utf8_encode($ligne[2]);
                // Créer l'objet Utilisateur
                $utilisateur = new Utilisateur($id,$nom, $prenom, $role, $mail, $mdp);

                // Ajouter l'objet Utilisateur à la liste
                array_push($listeUtilisateurs, $utilisateur);
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