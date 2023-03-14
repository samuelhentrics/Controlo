<?php
include_once("config.php");
function CopieRep($orig, $dest)
{

    //mkdir ($dest,0777); // à modifier si le rep cible existe déjà
    $dir = dir($orig);
    while ($entry = $dir->read()) {
        $pathOrig = "$orig/$entry";
        $pathDest = "$dest/$entry";
        // repertoire ->copie récursive
        if (is_dir($pathOrig) and (substr($entry, 0, 1) <> '.')) CopieRep($pathOrig, $pathDest);
        // fichier -> copie simple
        if (is_file($pathOrig) and ($pathDest <> '') and ($fp = fopen($pathOrig, 'rb'))) {
            $buf = fread($fp, filesize($pathOrig));
            $cop = fopen($pathDest, 'ab+');
            fputs($cop, $buf);
            fclose($cop);
            fclose($fp);
        }
    }
    $dir->close();
}


function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir . "/" . $object) == "dir") rmdir($dir . "/" . $object);
                else unlink($dir . "/" . $object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}
function sauvegarde()
{

    // Sauvegarde générale
    $cheminSauvegarde = SAUVEGARDE_FOLDER_NAME;

    // Créer le dossier s'il n'existe pas
    if (!file_exists($cheminSauvegarde)) {
        mkdir($cheminSauvegarde, 0777, true);
    }


    // Chemin du dossier de sauvegarde Controles
    $cheminSauvegardeControles = SAUVEGARDE_CONTROLES_FOLDER_NAME;

    if (!file_exists($cheminSauvegardeControles)) {
        mkdir($cheminSauvegardeControles, 0777, true);
    }


    // Chemin du dossier de sauvegarde Enseignants
    $cheminSauvegardeEnseignants = SAUVEGARDE_ENSEIGNANTS_FOLDER_NAME;

    if (!file_exists($cheminSauvegardeEnseignants)) {
        mkdir($cheminSauvegardeEnseignants, 0777, true);
    }


    // Chemin du dossier de sauvegarde Etudiants
    $cheminSauvegardeEtudiants = SAUVEGARDE_ETUDIANTS_FOLDER_NAME;

    if (!file_exists($cheminSauvegardeEtudiants)) {
        mkdir($cheminSauvegardeEtudiants, 0777, true);
    }

    // Chemin du dossier de sauvegarde Salles
    $cheminSauvegardeSalles = SAUVEGARDE_SALLES_FOLDER_NAME;

    if (!file_exists($cheminSauvegardeSalles)) {
        mkdir($cheminSauvegardeSalles, 0777, true);
    }

    // Chemin du dossier de sauvegarde Utilisateurs
    $cheminSauvegardeUtilisateurs = SAUVEGARDE_UTILISATEURS_FOLDER_NAME;

    if (!file_exists($cheminSauvegardeUtilisateurs)) {
        mkdir($cheminSauvegardeUtilisateurs, 0777, true);
    }


    
    $dossierSauvegarde = scandir($cheminSauvegarde);
    // Pacours le tableau de contrôles et récupère chaque dossier
    foreach ($dossierSauvegarde as $dossier) {

        // Vérifier si c'est le dossier Controles
        if (is_dir($dossier) and $dossier == "Controles") {
            // Copier les dossiers
            CopieRep($dossier, $cheminSauvegardeControles);
        }

        // Vérifier si c'est le dossier Enseignants
        elseif (is_dir($dossier) and $dossier == "Enseignants") {
            // Copier les dossiers
            CopieRep($dossier, $cheminSauvegardeEnseignants);
        }

        // Vérifier si c'est le dossier Etudiants 
        elseif (is_dir($dossier) and $dossier == "Etudiants") {
            // Copier les dossiers
            CopieRep($dossier, $cheminSauvegardeEtudiants);
        }

        // Vérifier si c'est le dossier Salles
        elseif (is_dir($dossier) and $dossier == "Salles") {
            // Copier les dossiers
            CopieRep($dossier, $cheminSauvegardeSalles);
        }

        // Vérifier si c'est le dossier Utilisateurs
        elseif (is_dir($dossier) and $dossier == "Utilisateurs") {
            // Copier les dossiers
            CopieRep($dossier, $cheminSauvegardeUtilisateurs);
        }
    }
}
?>
</p>
</body>

</html>