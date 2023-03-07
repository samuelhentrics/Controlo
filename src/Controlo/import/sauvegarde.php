<?php


// Chemin des dossiers à sauvegarder
$dossiers = array("Etudiants", "Enseignants", "Utilisateurs", "Controles", "Générations");

// Chemin du dossier de sauvegarde
$sauvegarde = "Sauvegarde";

// Date de la sauvegarde (aujourd'hui)
$date = date("Y-m-d");

// Vérification de la dernière modification du dossier de sauvegarde
$derniere_modification = filemtime($sauvegarde);
if ($derniere_modification > time() - 86400) { // Si la dernière modification date de moins de 24 heures, on ne fait rien
    exit();
}

// Création du dossier de sauvegarde si nécessaire
if (!is_dir($sauvegarde)) {
    mkdir($sauvegarde);
}

// Boucle sur les dossiers à sauvegarder
foreach ($dossiers as $dossier) {
    // Chemin complet du dossier à sauvegarder
    $chemin_dossier = $dossier;

    // Chemin complet du dossier de sauvegarde
    $chemin_sauvegarde = $sauvegarde . '/' . $dossier;

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
            $chemin_fichier = $chemin_dossier . '/' . $fichier;

            // Chemin complet du fichier de sauvegarde
            $chemin_sauvegarde_fichier = $chemin_sauvegarde . '/' . $fichier;

            // Vérification si le fichier existe déjà dans la sauvegarde
            if (!file_exists($chemin_sauvegarde_fichier)) {
                // Copie du fichier dans la sauvegarde
                copy($chemin_fichier, $chemin_sauvegarde_fichier);
            } else {
                // Comparaison des dates de modification du fichier
                $date_fichier = date("Y-m-d", filemtime($chemin_fichier));
                $date_sauvegarde_fichier = date("Y-m-d", filemtime($chemin_sauvegarde_fichier));
                if ($date_fichier > $date_sauvegarde_fichier) {
                    // Le fichier a été modifié depuis la dernière sauvegarde
                    copy($chemin_fichier, $chemin_sauvegarde_fichier);
                }
            }

        }

    }
}

// Enregistrement de la date de la dernière sauvegarde
touch($sauvegarde);