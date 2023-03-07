<?php

/**
 * @brief Sauvegarde des fichiers dans le dossier de sauvegarde
 * 
 */
function sauvegarde()
{
    // Chemin des dossiers à sauvegarder
    $dossiers = array(
        CSV_CONTROLES_FOLDER_NAME,
        CSV_ENSEIGNANTS_FOLDER_NAME,
        CSV_ETUDIANTS_FOLDER_NAME,
        GENERATIONS_FOLDER_NAME,
        CSV_SALLES_FOLDER_NAME,
        CSV_UTILISATEURS_FOLDER_NAME
    );

    // Date de la sauvegarde (aujourd'hui)
    $date = date("Y-m-d");

    $faireMaj = true;
    // Vérification de la dernière modification du dossier de sauvegarde
    if (!is_dir(SAUVEGARDES_FOLDER_NAME)) {
        mkdir(SAUVEGARDES_FOLDER_NAME);
    }
    
    $derniere_modification = filemtime(SAUVEGARDES_FOLDER_NAME);
    if ($derniere_modification > time()) { // Si la dernière modification date de moins de 24 heures, on ne fait rien
        $faireMaj = false;
    }

    if ($faireMaj) {
        // Création du dossier de sauvegarde si nécessaire
        if (!is_dir(SAUVEGARDES_FOLDER_NAME)) {
            mkdir(SAUVEGARDES_FOLDER_NAME);
        }

        // Boucle sur les dossiers à sauvegarder
        foreach ($dossiers as $dossier) {
            // Chemin complet du dossier à sauvegarder
            $chemin_dossier = $dossier;

            // Chemin complet du dossier de sauvegarde
            $chemin_sauvegarde = SAUVEGARDES_FOLDER_NAME . $dossier;

            // Création du dossier de sauvegarde si nécessaire
            if (!is_dir($chemin_sauvegarde)) {
                mkdir($chemin_sauvegarde);
            }

            // Boucle sur les fichiers du dossier à sauvegarder
            $fichiers = scandir($chemin_dossier);
            foreach ($fichiers as $fichier) {
                // Exclusion des fichiers cachés
                if (strpos($fichier, '.') !== 0) {

                    // Chemin complet du fichier à sauvegarder
                    $chemin_fichier = $chemin_dossier . $fichier;

                    // Chemin complet du fichier de sauvegarde
                    $chemin_sauvegarde_fichier = $chemin_sauvegarde . $fichier;

                    // Vérification si le fichier existe déjà dans la sauvegarde
                    if (!file_exists($chemin_sauvegarde_fichier)) {
                        if(!is_dir($chemin_sauvegarde_fichier)){
                            // Copie du fichier dans la sauvegarde
                            //print($chemin_fichier . ' -> ' . $chemin_sauvegarde_fichier );
                            copy($chemin_fichier, $chemin_sauvegarde_fichier);
                        }
                        else{
                            mkdir($chemin_sauvegarde_fichier);
                        }
                    } else {
                        // Comparaison des dates de modification du fichier
                        $date_fichier = date("Y-m-d", filemtime($chemin_fichier));
                        $date_sauvegarde_fichier = date("Y-m-d", filemtime($chemin_sauvegarde_fichier));
                        if ($date_fichier > $date_sauvegarde_fichier) {
                            if(!is_dir($chemin_sauvegarde_fichier)){
                            // Le fichier a été modifié depuis la dernière sauvegarde
                            copy($chemin_fichier, $chemin_sauvegarde_fichier);
                            }
                        }
                    }

                }

            }
        }

        // Enregistrement de la date de la dernière sauvegarde
        touch(SAUVEGARDES_FOLDER_NAME);

        // Vérification de la date de la dernière sauvegarde
        if(file_exists(SAUVEGARDES_FOLDER_NAME.'/derniere_sauvegarde.txt')){
            $derniere_sauvegarde = file_get_contents(SAUVEGARDES_FOLDER_NAME.'/derniere_sauvegarde.txt');
        }
        else{
            $derniere_sauvegarde = null;
        }
        
        if (!$derniere_sauvegarde || strtotime($derniere_sauvegarde) < strtotime('-24 hours')) {
            // Si la dernière sauvegarde date de plus de 24 heures, on effectue une nouvelle sauvegarde


            // Écriture de la date de la dernière sauvegarde dans le fichier "derniere_sauvegarde.txt"
            file_put_contents(SAUVEGARDES_FOLDER_NAME . '/derniere_sauvegarde.txt', $date);
        }
    }
}