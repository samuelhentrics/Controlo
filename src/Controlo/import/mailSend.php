<?php

include_once(FONCTION_ASSOCIER_ENTETE_LIGNE_PATH);

function envoyerMailEtudiants($unControle, $intitule, $contenuMail, $expediteur){
    // Ouvrir le fichier contenant la liste des étudiants pour ce contrôle
    $nomFichier = "listeEtudiants.csv";
    $cheminFichier = GENERATIONS_FOLDER_NAME . $unControle->getNomDossierGeneration() . "/" . PLANS_DE_PLACEMENT_CSV_PATH . $nomFichier;

    $file = fopen($cheminFichier, "r");

    // Récupérer l'entête
    $entete = fgetcsv($file, 0, ";");

    $listeOk = array();

    // Traiter étudiant par étudiant
    while (($ligne = fgetcsv($file, 0, ";")) !== FALSE) {
        $infoEtudiantPlace = associerEnteteLigne($entete, $ligne);
        $contenuPerso = contenuMailSelonEtudiant($unControle, $infoEtudiantPlace, $contenuMail);
        
        $emailDestinataire = $infoEtudiantPlace["Mail"];
        $resultat = envoieUnMail($expediteur, $emailDestinataire, $intitule, $contenuPerso, $file);

        if ($resultat){
            array_push($listeOk, $infoEtudiantPlace["Email"]);
        }
    }

    fclose($file);

    return $listeOk;
}

function contenuMailSelonEtudiant($unControle, $infoEtudiantPlace, $contenu){
    $contenu = str_replace("[Prénom]", $infoEtudiantPlace["Prenom"], $contenu);
    $contenu = str_replace("[Nom]", $infoEtudiantPlace["Nom"], $contenu);
    $contenu = str_replace("[NomLongControle]", $unControle->getNomLong(), $contenu);
    $contenu = str_replace("[NomCourtControle]", $unControle->getNomCourt(), $contenu);
    $contenu = str_replace("[Date]", $unControle->getDate(), $contenu);

    $statut = $infoEtudiantPlace["Statut"];

    if ($statut == "TT"){
        $contenu = str_replace("[Heure]", $unControle->getHeureTT(), $contenu);
        $contenu = str_replace("[Durée]", $unControle->getDuree(), $contenu);
    } else {
        $contenu = str_replace("[Heure]", $unControle->getHeureNonTT(), $contenu);
        $contenu = str_replace("[Durée]", $unControle->getDureeNonTT(), $contenu);
    } 

    $contenu = str_replace("[Salle]", $infoEtudiantPlace["Salle"], $contenu);
    $contenu = str_replace("[Place]", $infoEtudiantPlace["NumeroPlace"], $contenu);

    return $contenu;
}

function envoieUnMail($emailEnvoyeur, $emailDestinataire, $sujet, $message, $file)
{

    // if (isset($_POST['emailEnvoyeur']) && isset($_POST['emailDestinataire']) && isset($_POST['sujet']) && isset($_POST['message'])) {
    // $emailEnvoyeur = $_POST['emailEnvoyeur'];
    // $emailDestinataire = $_POST['emailDestinataire'];
    // $sujet = $_POST['sujet'];
    // $message = $_POST['message'];

    // Construction de l'en-tête du message
    $boundary = md5(time());
    $headers = "From: $emailEnvoyeur\r\n";
    $headers .= "Reply-To: $emailEnvoyeur\r\n";
    $headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";

    // Création du corps du message
    $body = "--$boundary\r\n";
    $body .= "Content-type: text/plain; charset=utf-8\r\n";
    $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $body .= $message . "\r\n";


    if (isset($file['name']) && $file['size'] > 0) {
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];

        $handle = fopen($file_tmp, "r");
        $content = fread($handle, $file_size);
        fclose($handle);

        $content = chunk_split(base64_encode($content));

        $body .= "--$boundary\r\n";
        $body .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";
        $body .= $content . "\r\n";
    }

    $body .= "--$boundary--";

    // Envoi de l'email
    if (mail($emailDestinataire, $sujet, $body, $headers)) {
        return true;
    } else {
        return false;
    }
    // }
}

function recupererMessageMailDefaut(){
    // Tentative ouverture fichier Utilisateurs/messageDefaut.txt

    $fichier = fopen(MESSAGE_MAIL_DEFAUT_PATH, "r");
    if($fichier){
        $message = fread($fichier, filesize(MESSAGE_MAIL_DEFAUT_PATH));
        fclose($fichier);
        return $message;
    }
    else{
        return "";
    }

}

?>