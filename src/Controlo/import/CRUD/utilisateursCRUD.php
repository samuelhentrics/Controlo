<?php

include_once(FONCTION_CREER_LISTE_UTILISATEURS_PATH);

/**
 * @brief Fonction qui ajoute un utilisateur dans le fichier CSV des utilisateurs
 * @param Utilisateur $unUtilisateur L'utilisateur à ajouter
 * @throws Exception
 * @return void
 */
function ajouterUtilisateur($unUtilisateur){
    try{
        // Ouvrir le fichier CSV des liste-enseignants
        $monFichier = fopen(CSV_UTILISATEURS_FOLDER_NAME . LISTE_UTILISATEURS_FILE_NAME, 'a');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des utilisateurs");
        }

        // Ajouter l'utilisateur à la fin du fichier CSV
        $id = $unUtilisateur->getId();
        $nom = $unUtilisateur->getNom();
        $prenom = $unUtilisateur->getPrenom();
        $role = $unUtilisateur->getRole();
        $mail = $unUtilisateur->getMail();
        $mdp = $unUtilisateur->getMdp();
        $ligne = array($id, $mail, $mdp, $role, $nom, $prenom, "profil/default.png");
        fputcsv($monFichier, $ligne, ";");

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}

function supprimerUtilisateur($idUtilisateur){
    try{
        // Ouvrir le fichier CSV des liste-utilisateurs
        $monFichier = fopen(CSV_UTILISATEURS_FOLDER_NAME . LISTE_UTILISATEURS_FILE_NAME, 'r');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des utilisateurs");
        }

        // Lire le fichier CSV
        $listeUtilisateurs = array();

        // Ajouter l'en-tête du fichier CSV
        $entete = fgetcsv($monFichier, 0, ";");

        // Lire le fichier CSV
        while(!feof($monFichier)){
            $ligne = fgetcsv($monFichier, 0, ";");

            $id = 0;
            // Si la ligne n'est pas vide
            if($ligne != false){
                // Récupérer les informations de l'enseignant
                $id = utf8_encode($ligne[0]);
                $nom = utf8_encode($ligne[4]);
                $prenom = utf8_encode($ligne[5]);
                $role = utf8_encode($ligne[3]);
                $mail = utf8_encode($ligne[1]);
                $mdp = utf8_encode($ligne[2]);
                // Créer l'objet Utilisateur
                $utilisateur = new Utilisateur($id,$nom, $prenom, $role, $mail, $mdp);

                // Ajouter l'objet Utilisateur à la liste
                array_push($listeUtilisateurs, $utilisateur);

                // Incrémenter l'id
                $id++;
            }
        }

        // Fermer le fichier CSV

        fclose($monFichier);

        // Supprimer l'utilisateur dans la liste
        unset($listeUtilisateurs[$idUtilisateur]);

        // Réécrire le fichier CSV
        $monFichier = fopen(CSV_UTILISATEURS_FOLDER_NAME . LISTE_UTILISATEURS_FILE_NAME, 'w');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des utilisateurs");
        }

        // Ajouter l'entête du fichier CSV
        fputcsv($monFichier, $entete, ";");

        // Ajouter les utilisateurs dans le fichier CSV
        foreach ($listeUtilisateurs as $unUtilisateur) {
            $id = $unUtilisateur->getId();
            $nom = $unUtilisateur->getNom();
            $prenom = $unUtilisateur->getPrenom();
            $role = $unUtilisateur->getRole();
            $mail = $unUtilisateur->getMail();
            $mdp = $unUtilisateur->getMdp();

            $ligne = array($id, $mail, $mdp, $role, $nom, $prenom, "profil/default.png");
            fputcsv($monFichier, $ligne, ";");

        }

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}
