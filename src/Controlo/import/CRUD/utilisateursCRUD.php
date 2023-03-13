<?php


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
        $nom = $unUtilisateur->getNom();
        $prenom = $unUtilisateur->getPrenom();
        $role = $unUtilisateur->getRole();
        $mail = $unUtilisateur->getMail();
        $ligne = array($nom, $prenom, $role, $mail);
        fputcsv($monFichier, $ligne, ";");

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}
