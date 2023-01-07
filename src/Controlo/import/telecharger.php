<?php

include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);

if(isset($_GET["id"])){
    // Récuperer l'id du controle
    $id = $_GET["id"];

    // Récuperer le controle
    $unControle = recupererUnControle($id);

    // Récuperer les infos du contrôle
    $nomCourtControle = $unControle->getNomCourt();
    $dateControle = $unControle->getDate();

    // Récupérer le nom du dossier qui sera zippé puis télécharger au client
    $dateFormatDossier = date('Y-m-d', strtotime($dateControle));
    $nomDossier = str_replace("-", "", $nomCourtControle);
    $nomDossier = str_replace(".", "-", $nomDossier);
    $nomDossier = preg_replace("/\s+/", " ", $nomDossier);
    $nomDossier = trim($nomDossier);
    $nomDossier = str_replace("/", "-", $nomDossier);
    $nomDossier = str_replace(" ", "-", $nomDossier);

    $nomDossier = $dateFormatDossier . "_" . $nomDossier;

    $pathDossier = PLANS_DE_PLACEMENT_FOLDER_NAME . $nomDossier ;


    // Créer un nouveau fichier ZIP
    $zip = new ZipArchive();
    $nomDossier = $nomDossier.".zip"; // Attribuer un nom au fichier ZIP

    if($zip->open($nomDossier, ZipArchive::CREATE)!==TRUE){
        $error .= "Impossible d'ouvrir <$nomDossier>\n";
    }

    // Créer un iterateur de répertoire sur le dossier
    $iterator = new RecursiveDirectoryIterator($pathDossier);

    // Itérer sur chaque fichier et ajouter au ZIP
    foreach (new RecursiveIteratorIterator($iterator) as $key=>$value) {
    $zip->addFile(realpath($key), $key) or die ("ERROR: Could not add file: $key");
    }

    // Fermer le fichier ZIP et envoyer au client
    $zip->close();
    readfile($nomDossier);

    

}