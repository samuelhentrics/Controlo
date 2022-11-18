<?php

include("../rsc/class/Controle.php");

DEFINE("CHEMIN_LISTE_CONTROLES", "../rsc/CSV/controles/liste-controles.csv");

function creerListeControles(){
    $monFichier = fopen(CHEMIN_LISTE_CONTROLES, "r");

    // Créer la liste des controles en lisant le fichier CSV

    if (!($monFichier)) {
        print("Impossible d'ouvrir le fichier \n");
        exit;
    } else {
        $listeControles = array();
        $i = 0;

        // On enleve l'entete
        fgetcsv($monFichier, null, ";");

        // Lecture du reste du CSV
        while ($data = fgetcsv($monFichier, null, ";")) {
            // Création d'un contrôle de la ligne actuelle
            $unControle = new Controle();

            // Mettre la date au format YYYY-MM-DD si une date existe
            if ($data[7] != null){
                $data[7] = DateTime::createFromFormat('d/m/Y', $data[7]);
                $data[7] = $data[7]->format('Y-m-d');
            }

            // Affecter les infos au contrôle
            $unControle->setNomLong($data[3]);
            $unControle->setNomCourt($data[4]);
            $unControle->setDuree($data[6]);
            $unControle->setDate($data[7]);
            $unControle->setHeureNonTT($data[8]);
            $unControle->setHeureTT($data[9]);
          
            // Ajout du contrôle dans la liste des contrôles
            $listeControles[$i] = $unControle;
            $i++;
        }

    }

    fclose($monFichier);

    return $listeControles;
}


?>