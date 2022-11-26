<?php


DEFINE("CHEMIN_LISTE_SALLES", $CSV_SALLES_PATH.$LISTE_SALLES_FILE_NAME);
include($CLASS_PATH.$CLASS_SALLE_FILE_NAME);


/**
 * Cette fonction permet de créer une liste de salles
 *
 * @return array
 */

function creerListeSalles()
{
    $monFichier = fopen(CHEMIN_LISTE_SALLES, "r");

    // Récupérer les données du CSV dans un tableau

    if (!($monFichier)) {
        print("Impossible d'ouvrir le fichier \n");
        exit;
    } else {
        $tabCSV = array(array());
        $i = 0;

        // On enleve l'entete
        fgetcsv($monFichier, null, ";");

        // Lecture du reste du CSV
        while ($data = fgetcsv($monFichier, null, ";")) {
             $tabCSV[$i][0] = $data[0];
             $tabCSV[$i][1] = $data[1];
             $i++;
        }

    }

    fclose($monFichier);


    $listeSalles = array();

    // Création des objets de la classe Salle
    for ($j=0; $j<=count($tabCSV)-1; $j++){
        $uneSalle = new Salle;
        $uneSalle->setNom($tabCSV[$j][0]);
        $listeSalles[$j] = $uneSalle;
    }

    // Association des voisins des salles
    for ($j=0; $j<=count($tabCSV)-1; $j++){
        if ($tabCSV[$j][1]!=null){
            // Création de la salle que l'on recherche
            $uneSalleAChercher = new Salle;
            $uneSalleAChercher->setNom($tabCSV[$j][1]);

            // Tentative de recherche du voisin si l'objet a été crée
            $indiceSalleListe = array_search($uneSalleAChercher, $listeSalles);
            if($indiceSalleListe!=null){
                $listeSalles[$j]->lierVoisin($listeSalles[$indiceSalleListe]);
            }
            
        }
    }



    // Création des plans et association



    return $listeSalles;
}

?>
