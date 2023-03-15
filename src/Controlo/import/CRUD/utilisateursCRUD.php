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
