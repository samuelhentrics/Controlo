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
?>