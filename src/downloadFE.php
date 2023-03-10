<?php
/**
 * @file download.php
 * @brief Telecharge un ZIP des feuilles d'émargement
 * @version 1.0
 * @date 2023-01-07
 * @author Samuel HENTRICS LOISTINE
 */

include_once("config.php");
include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);


if (isset($_GET["id"]) ) {
    // Récuperer l'id du controle
    $id = $_GET["id"];

    // Récuperer le controle
    $unControle = recupererUnControle($id);

    // Récuperer les infos du contrôle
    $nomCourtControle = $unControle->getNomCourt();
    $dateControle = $unControle->getDate();

    // Récupérer le nom du dossier qui sera zippé puis télécharger au client
    $nomDossier = $unControle->getNomDossierGeneration();

    $pathDossier = "./". GENERATIONS_FOLDER_NAME . $nomDossier . "/" . FEUILLES_EMARGEMENT_FOLDER_NAME;
    $zip = new ZipArchive();
    $filename = "./".$nomDossier.".zip";

    if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
        exit("Impossible d'ouvrir le fichier <$filename>\n");
    }

    $dossier = opendir($pathDossier);
    while (($fichier = readdir($dossier)) !== false) {
        if (is_file($pathDossier ."/". $fichier)) {
            // Récupérer le fichier et le mettre dans le ZIP
            $zip->addFile($pathDossier."/".$fichier, $fichier);
        }
    }
    closedir($dossier);
    
    $zip->close();

    // Faire telecharger le zip au client
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $filename);
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    
    unlink($filename);
}

?>