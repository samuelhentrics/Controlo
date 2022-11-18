<?php

include(dirname(dirname(__FILE__))."../../class/Plan.php");
include(dirname(dirname(__FILE__))."../../class/Zone.php");

function creerPlanSalle($nomSalle)
{
    $nomFichier = dirname(dirname(__FILE__))."../../CSV/plansSalles/" . $nomSalle . ".csv";
    $monFichier = fopen($nomFichier, "r");

    // Créer le plan de la salle en lisant le fichier CSV s'il existe

    if (!($monFichier)) {
        print("Cette salle n'existe pas \n");
        exit;
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
                $unPlan->lierUneZone($uneZone);
            }
            $numLigne++;
        }
    }

    fclose($monFichier);

    return $unPlan;
}
