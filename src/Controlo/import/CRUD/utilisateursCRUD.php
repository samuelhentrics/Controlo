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
        $nom = utf8_decode($unUtilisateur->getNom());
        $prenom = utf8_decode($unUtilisateur->getPrenom());
        $role = $unUtilisateur->getRole();
        $mail = $unUtilisateur->getMail();
        $mdp = $unUtilisateur->getMdp();
        $imgProfil = $unUtilisateur->getImgProfil();
        $ligne = array($id, $mail, $mdp, $role, $nom, $prenom, $imgProfil);
        fputcsv($monFichier, $ligne, ";");

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}


function modifierUtilisateur($oldUser, $newUser){
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

            // Si la ligne n'est pas vide
            if($ligne != false){
                $unUtilisateurArray = array();
                // Récupérer les informations de l'enseignant
                $id = utf8_encode($ligne[0]);

                if($id == $oldUser->getId()){
                    $nom = $newUser->getNom();
                    $prenom = $newUser->getPrenom();
                    $role = $newUser->getRole();
                    $mail = $newUser->getMail();
                    $mdp = $newUser->getMdp();
                    $imgProfil = $newUser->getImgProfil();
                }
                else{
                    $nom = $ligne[4];
                    $prenom = $ligne[5];
                    $role = $ligne[3];
                    $mail = $ligne[1];
                    $mdp = $ligne[2];
                    $imgProfil = $ligne[6];
                }

                $unUtilisateurArray = array($id, $mail, $mdp, $role, $nom, $prenom, $imgProfil);
            
                // Ajouter l'objet Utilisateur à la liste
                array_push($listeUtilisateurs, $unUtilisateurArray);
            }
        }

        // Fermer le fichier CSV
        fclose($monFichier);

        // Réécrire le fichier CSV
        $monFichier = fopen(CSV_UTILISATEURS_FOLDER_NAME . LISTE_UTILISATEURS_FILE_NAME, 'w');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des utilisateurs");
        }

        // Ajouter l'entête du fichier CSV

        fputcsv($monFichier, $entete, ";");

        // Ajouter les utilisateurs dans le fichier CSV

        foreach($listeUtilisateurs as $unUtilisateur){
            fputcsv($monFichier, $unUtilisateur, ";");
        }

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

                if($id != $idUtilisateur){
                    $nom = $ligne[4];
                    $prenom = $ligne[5];
                    $role = $ligne[3];
                    $mail = $ligne[1];
                    $mdp = $ligne[2];
                    $imgProfil = $ligne[6];
                    // Créer l'objet Utilisateur
                    $utilisateur = new Utilisateur($id,$nom, $prenom, $role, $mail, $mdp, $imgProfil);

                    // Ajouter l'objet Utilisateur à la liste
                    array_push($listeUtilisateurs, $utilisateur);
                }

                // Incrémenter l'id
                $id++;
            }
        }

        // Fermer le fichier CSV

        fclose($monFichier);

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
            $imgProfil = $unUtilisateur->getImgProfil();

            $ligne = array($id, $mail, $mdp, $role, $nom, $prenom, $imgProfil);
            fputcsv($monFichier, $ligne, ";");

        }

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}
