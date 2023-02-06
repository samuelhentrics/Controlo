<?php 
function supprimerControle($idControle)
{
    include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

    // On initialise un booléen en cas d'erreur
    $suppressionOk = false;
    // Tentative d'écriture du fichier CSV
    try {
        $lienFichier = CSV_CONTROLES_FOLDER_NAME.LISTE_CONTROLES_FILE_NAME;
        $monFichier = fopen($lienFichier, "r");

        if (!$monFichier) {
            throw new Exception("Impossible d'ouvrir le fichier CSV. Il semble être ouvert par un autre programme.");
        }

        $contenuDossier = array();

        while (($data = fgetcsv($monFichier, 1000, ";")) !== FALSE) {
            array_push($contenuDossier, $data);
        }

        fclose($monFichier);

        $monFichier = fopen($lienFichier, "w");

        if (!$monFichier) {
            throw new Exception("Impossible d'ouvrir le fichier CSV. Il semble être ouvert par un autre programme.");
        }

        $indiceLigne = 0;

        // On parcourt le fichier CSV
        foreach ($contenuDossier as $uneLigne) {
            // on verifie que l'indice de la ligne n'est pas celui de l'étudiant à supprimer
            if (!($indiceLigne == $idControle + 1)) {
                fputcsv($monFichier, $uneLigne, ";");
            }
            $indiceLigne++;
        }

        fclose($monFichier);
        
        $suppressionOk = true;

    } catch (Exception $e) {
        $suppressionOk = false;
        throw new Exception($e->getMessage());
    }

    return $suppressionOk;
}
?>