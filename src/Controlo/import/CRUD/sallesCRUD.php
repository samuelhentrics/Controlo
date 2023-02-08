<?php

/**
 * @brief Contient les fonctions CRUD pour les salles (ajouter, modifier, supprimer)
 * @file sallesCRUD.php
 * @version 1.0
 * @date 06/02/2023
 * @author Ahmed FAKHFAKH <fakhfakhahmed45@gmail.com>
 */

/**
 * @brief Ajoute une salle dans le fichier CSV des salles
 * @param Salle $nouvelleSalle La salle à ajouter
 * @throws Exception Si le fichier CSV ne contient pas les champs obligatoires de la nomenclature
 * @return bool Retourne vrai si l'ajout s'est bien passé, faux sinon
 */
function ajouterSalle(
    $nouvelleSalle
)
{

    // On initialise un booléen en cas d'erreur
    $ajoutOk = false;

    // Tentative d'écriture du fichier CSV
    try {

        // Créer le plan de la salle
        $lienFichier = CSV_SALLES_FOLDER_NAME . $nouvelleSalle->getNom() . ".csv";

        if (file_exists($lienFichier)) {
            throw new Exception("La salle existe déja");
        }

        modifierPlanSalle($nouvelleSalle);

        // Ajouter la salle dans le fichier CSV liste salles

        $lienFichier = CSV_SALLES_FOLDER_NAME . LISTE_SALLES_FILE_NAME;

        // Ouvrir le fichier CSV en mode ajout

        $monFichier = fopen($lienFichier, "a");

        // Vérifier que le fichier CSV est bien ouvert

        if ($monFichier === false) {
            throw new Exception("Impossible d'ouvrir le fichier CSV");
        }

        // Ajouter la salle dans le fichier CSV
        $nomSalle = $nouvelleSalle->getNom();

        $salleVoisine = $nouvelleSalle->getMonVoisin();
        $nomSalleVoisine = "";
        if($salleVoisine != null){
            $nomSalleVoisine = $salleVoisine->getNom();
        }

        $ligne = array($nomSalle, $nomSalleVoisine);
        fputcsv($monFichier, $ligne, ";");

        // Fermer le fichier CSV
        fclose($monFichier);

        $ajoutOk = true;

    } catch (Exception $e) {
        $ajoutOk = false;
        throw new Exception($e->getMessage());
    }

    return $ajoutOk;
}

function ajouterAffichageSalle($nomSalle, $nomVoisin)
{

    // On initialise un booléen en cas d'erreur
    $ajoutOk = true;

    // Tentative d'écriture du fichier CSV
    try {
        $lienFichier = CSV_SALLES_FOLDER_NAME . LISTE_SALLES_FILE_NAME;

        // On verifie si le fichier contient une erreur à l'ouverture 
        $file = fopen($lienFichier, "a");
        if ($file == false) {
            throw new Exception("Impossible d'ecrire dans le fichier de liste de promotions");
        }

        // Contient l'entête des fichiers de promotions
        $noms = array($nomSalle, $nomVoisin);

        // Ajoute l'array dans le CSV
        fputcsv($file, $noms, ";");

        // Fermer le fichier CSV
        fclose($file);

    } catch (Exception $e) {
        $ajoutOk = false;
        throw new Exception($e->getMessage());
    }

    return $ajoutOk;



}

function modifierPlanSalle($uneSalle)
{
    try {
        $lienFichier = CSV_SALLES_FOLDER_NAME . $uneSalle->getNom() . ".csv";
        // Ouvrir le fichier CSV en mode création
        $monFichier = fopen($lienFichier, "w");

        // Vérifier que le fichier CSV est bien ouvert
        if ($monFichier === false) {
            throw new Exception("Impossible d'ouvrir le fichier CSV");
        }

        $plan = $uneSalle->getMonPlan();
        $lesZones = $plan->getMesZones();
        for ($i = 0; $i < count($lesZones); $i++) {
            $uneLigne = array();
            for ($j = 0; $j < count($lesZones[$i]); $j++) {
                //Ajouter la zone dans le CSV

                $uneZone = $lesZones[$i][$j];
                $typeZone = $uneZone->getType();

                switch ($typeZone) {
                    case "tableau":
                        $infoZone = "T";
                        break;

                    case "place":
                        $infoZone = $uneZone->getNumero();
                        if ($uneZone->getInfoPrise()) {
                            $infoZone .= "E";
                        }
                        break;

                    default:
                        $infoZone = "";
                        break;

                }

                array_push($uneLigne, $infoZone);

            }
            fputcsv($monFichier, $uneLigne, ";");
        }

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

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


function modifierVoisinSalle($nomSalle, $nomSalleVoisine){
    try{
        // Ouvir le fichier liste-salles en mode lecture
        $monFichier = fopen(CSV_SALLES_FOLDER_NAME . LISTE_SALLES_FILE_NAME, "r");

        // Vérifier que le fichier CSV est bien ouvert
        if ($monFichier === false) {
            throw new Exception("Impossible d'ouvrir le fichier CSV");
        }

        // On parcourt le fichier CSV
        $contenuDossier = array();
        while (($data = fgetcsv($monFichier, 1000, ";")) !== FALSE) {
            // On vérifie que l'indice de la ligne est celui de la salle à modifier
            if ($data[0] == $nomSalle) {
                // On modifie la salle voisine
                $data[1] = $nomSalleVoisine;
            }

            // Pareil pour la salle voisine
            if ($data[1] == $nomSalleVoisine) {
                $data[0] = $nomSalle;
            }

            // On ajoute la ligne dans le tableau
            $contenuDossier[] = $data;
        }

        // Fermer le fichier CSV
        fclose($monFichier);

        // Ouvir le fichier liste-salles en mode écriture
        $monFichier = fopen(CSV_SALLES_FOLDER_NAME . LISTE_SALLES_FILE_NAME, "w");

        // Vérifier que le fichier CSV est bien ouvert
        if ($monFichier === false) {
            throw new Exception("Impossible d'ouvrir le fichier CSV");
        }

        // On parcourt le tableau
        foreach ($contenuDossier as $uneLigne) {
            // On ajoute la ligne dans le fichier CSV
            fputcsv($monFichier, $uneLigne, ";");
        }

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}


function recupererSallesSansVoisin(){
    try{
        // Ouvrir le fichier liste salles
        $monFichier = fopen(CSV_SALLES_FOLDER_NAME . LISTE_SALLES_FILE_NAME, "r");

        // Vérifier que le fichier CSV est bien ouvert
        if ($monFichier === false) {
            throw new Exception("Impossible d'ouvrir le fichier CSV");
        }

        // On parcourt le fichier CSV
        $contenuDossier = array();
        while (($data = fgetcsv($monFichier, 1000, ";")) !== FALSE) {
            // On vérifie que la salle n'a pas de voisine
            if ($data[1] == "") {
                // On ajoute la salle dans le tableau
                $contenuDossier[] = $data[0];
            }
        }

        // Fermer le fichier CSV
        fclose($monFichier);

        return $contenuDossier;
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>