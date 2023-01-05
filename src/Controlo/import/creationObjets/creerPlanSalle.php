<?php
/**
 * @file creerPlanSalle.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Fichier contenant les fonctions nécéssaires pour créer 
 * un Plan d'une Salle
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 * 
 */


include_once(CLASS_PATH . CLASS_PLAN_FILE_NAME);
include_once(CLASS_PATH . CLASS_ZONE_FILE_NAME);

/**
 * @brief Retourne un Plan de Salle si cette Salle existe
 *
 * @param string $nomSalle
 * @return Plan|null
 */
function creerPlanSalle($nomSalle)
{
    $nomFichier = CSV_SALLES_PATH . $nomSalle . ".csv";
    $monFichier = fopen($nomFichier, "r");

    // Créer le plan de la salle en lisant le fichier CSV s'il existe

    if (!($monFichier)) {
        return null;
    } else {
        // Création d'un objet unPlan
        $unPlan = new Plan;
        $numLigne = 0;

        // Lecture du CSV
        while ($uneLigne = fgetcsv($monFichier, 10000, ";")) {
            for ($numColonne = 0; $numColonne <= count($uneLigne) - 1; $numColonne++) {
                $uneZone = new Zone();

                // Informer de la position de cette zone
                $uneZone->setNumLigne($numLigne);
                $uneZone->setNumCol($numColonne);

                // Déterminer le type de Zone qu'il s'agit
                $texteZone = $uneLigne[$numColonne];

                switch ($texteZone) {
                    case 'T':
                        $uneZone->setType("tableau");
                        break;
                    case '':
                        $uneZone->setType("vide");
                        break;
                    default:
                        $uneZone->setType("place");
                        break;
                }


                // Vérifier s'il s'agit d'une place avec prise
                if (substr($texteZone, -1) == "E") {
                    $uneZone->setInfoPrise(true);
                }
                // On met le numéro de la place s'il s'agit d'une place
                $uneZone->setNumero($texteZone);

                // Ajouter la Zone dans le Plan
                $unPlan->ajouterUneZone($uneZone);
            }
            $numLigne++;
        }
    }

    fclose($monFichier);

    return $unPlan;
}