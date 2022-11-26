<?php
/**
 * @file creerListeControles.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la fonction creerListeControles
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 * 
 */

DEFINE("CHEMIN_LISTE_CONTROLES", $CSV_CONTROLES_FOLDER_NAME.$LISTE_CONTROLES_FILE_NAME);
include($CLASS_PATH.$CLASS_CONTROLE_FILE_NAME);
/**
 * @brief Cette fonction retourne la liste des contrôles sans les liens
 *
 * @return array
 */
function creerListeControles(){
    $monFichier = fopen(CHEMIN_LISTE_CONTROLES, "r");

    // Créer la liste des controles en lisant le fichier CSV

    if (!($monFichier)) {
        print("Impossible d'ouvrir le fichier \n");
        exit;
    } else {
        // Création d'une liste vide
        $listeControles = array();
        $i = 0;

        // On enleve l'entete
        fgetcsv($monFichier, null, ";");

        // Lecture du reste du CSV
        while ($data = fgetcsv($monFichier, null, ";")) {

            // Mettre la date au format YYYY-MM-DD si une date existe (pour datatables)
            if ($data[7] != null){
                $data[7] = DateTime::createFromFormat('d/m/Y', $data[7]);
                $data[7] = $data[7]->format('Y-m-d');
            }

            // Création d'un contrôle de la ligne actuelle
            $leNomLong = $data[3];
            $leNomCourt = $data[4];
            $laDuree = $data[6];
            $laDate = $data[7];
            $lHeureNonTT = $data[8];
            $lHeureTT= $data[9];

            // Création d'un objet de type Controle avec les informations
            // de la ligne courante que l'on traite dans le CSV
            $unControle = new Controle($leNomLong,$leNomCourt,$laDuree,
            $laDate,$lHeureNonTT,$lHeureTT);
          
            // Ajout du contrôle dans la liste des contrôles
            $listeControles[$i] = $unControle;
            $i++;
        }

    }

    fclose($monFichier);

    return $listeControles;
}


?>