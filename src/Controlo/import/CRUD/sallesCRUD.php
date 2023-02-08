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
        $lienFichier = CSV_SALLES_FOLDER_NAME . $_POST["nomSalle"] . ".csv";

        if ($lienFichier) {
            throw new Exception("La salle existe déja");
        }

        // Ouvrir le fichier CSV en mode création
        $monFichier = fopen($lienFichier, "w");

        ///for ($i = 0; $i < $_POST['nbrLigne']; $i++)
        ///{
           /// for ($j = 0; $j < $_POST['nbrColonne']; $j++)
           /// {
                // Ajouter la zone dans le CSV
              ///  fputcsv($monFichier, $uneZone, ";");
          ///  }
       /// }

        // Fermer le fichier CSV
        fclose($monFichier);

        $ajoutOk = true;

    } catch (Exception $e) {
        $ajoutOk = false;
        throw new Exception($e->getMessage());
    }

    return $ajoutOk;
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


?>