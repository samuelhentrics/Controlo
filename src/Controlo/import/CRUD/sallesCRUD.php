<?php


function supprimerSalle($nomSalle)
{
    $nomSalle = trim($nomSalle);
    $nomSalle = strtolower($nomSalle);

    // On initialise un booléen en cas d'erreur
    $suppressionOk = false;
    // Tentative d'écriture du fichier CSV
    try {

        // Supprimer la salle depuis le fichier CSV liste salles
        $lienFichier = CSV_SALLES_FOLDER_NAME . LISTE_SALLES_FILE_NAME;
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


        // On parcourt le fichier CSV
        foreach ($contenuDossier as $uneLigne) {
            $nomSalleTraitee = trim($uneLigne[0]);
            $nomSalleTraitee = strtolower($nomSalleTraitee);

            $nomSalleVoisineTraitee = trim($uneLigne[1]);
            $nomSalleVoisineTraitee = strtolower($nomSalleVoisineTraitee);

            // on verifie que l'indice de la ligne n'est pas celui de la salle à supprimer
            if (!($nomSalleTraitee == $nomSalle)) {
                // Vérifier que la salle n'est pas utilisée en tant que salle voisine
                if ($nomSalleVoisineTraitee == $nomSalle) {
                    $uneLigne[1] = "";
                }

                fputcsv($monFichier, $uneLigne, ";");
            }

            

        }

        fclose($monFichier);



        // Supprimer le fichier CSV de la salle
        $lienFichier = CSV_SALLES_FOLDER_NAME . $nomSalle . ".csv";

        // On vérifie que le fichier existe
        if (file_exists($lienFichier)) {
            unlink($lienFichier);
        } else {
            throw new Exception("Le fichier CSV de la salle n'a pas été trouvé.");
        }
        
        $suppressionOk = true;

    } catch (Exception $e) {
        $suppressionOk = false;
        throw new Exception($e->getMessage());
    }

    return $suppressionOk;
}


?>