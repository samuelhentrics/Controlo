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

function ajouterControle ($nouveauControle)
{

    // On initialise un booléen en cas d'erreur
    $ajoutOk = false;

    // Tentative d'écriture du fichier CSV
    try {
        $lienFichier = CSV_CONTROLES_FOLDER_NAME.LISTE_CONTROLES_FILE_NAME;

        // Récupérer un array selon l'entete du fichier CSV
        $infoControle = recupererEnteteControle($lienFichier);

        // Faire un array avec les informations de l'étudiant
        $infoControle = saisirLigneControle(
            $infoControle,
            $nouveauControle
        );

        // Ajouter l'étudiant en fin de fichier

        // Ouvrir le fichier CSV en mode écriture en fin de fichier
        $monFichier = fopen($lienFichier, "a");

        if (!$monFichier) {
            throw new Exception("Impossible d'ouvrir le fichier CSV. Il semble être ouvert par un autre programme.");
        }

        // Ajouter l'array dans le CSV
        fputcsv($monFichier, $infoControle, ";");

        // Fermer le fichier CSV
        fclose($monFichier);

        $ajoutOk = true;

    } catch (Exception $e) {
        $ajoutOk = false;
        throw new Exception($e->getMessage());
    }

    return $ajoutOk;
}


function recupererEnteteControle($lienFichier)
{
    try {
        // Ouvrir le fichier CSV en mode lecture pour récupérer les entêtes
        $monFichier = fopen($lienFichier, "r");

        if ($monFichier === false) {
            throw new Exception("Impossible d'ouvrir le fichier CSV");
        }

        // Récupérer les entêtes
        $entetes = fgetcsv($monFichier, 10000, ";");

        if ($entetes === false) {
            throw new Exception("Impossible de récupérer les entêtes du fichier CSV");
        }

        // Fermer le fichier CSV
        fclose($monFichier);

        // Supprimer les espaces en début et fin de chaîne de chaque entête
        $entetes = array_map('trim', $entetes);

        // Vérifier que l'entete contient les champs obligatoires de la nomenclature
        if (
            !in_array(PROMOTION_NOM_COLONNE_CONTROLE, $entetes) || !in_array(NOM_LONG_NOM_COLONNE_CONTROLE, $entetes) ||
            !in_array(NOM_COURT_NOM_COLONNE_CONTROLE, $entetes) || !in_array(ENSEIGNANT_REF_NOM_COLONNE_CONTROLE, $entetes) ||
            !in_array(DUREE_NOM_COLONNE_CONTROLE, $entetes) || !in_array(DATE_NOM_COLONNE_CONTROLE, $entetes) || 
            !in_array(HEURE_NOM_COLONNE_CONTROLE, $entetes) || !in_array(HEURE_TT_NOM_COLONNE_CONTROLE, $entetes) ||
            !in_array(SALLES_NOM_COLONNE_CONTROLE, $entetes) || !in_array(SURVEILLANTS_NOM_COLONNE_CONTROLE, $entetes)

        ) {
            throw new Exception("Le fichier CSV de la promotion ne contient pas les champs obligatoires de la nomenclature");
        }

        // Mettre les valeurs de l'entete en tant que clés
        $infoControles = array_flip($entetes);
        foreach ($infoControles as $key => $value) {
            $infoControles[$key] = null;
        }

        return $infoControles;
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @brief Modifie une ligne d'un array d'une info étudiante
 * @param array $infoEtudiant Array contenant les infos d'un étudiant
 * @param Etudiant $unEtudiant Objet Etudiant
 * @return array Liste contenant les infos d'un étudiant
 */
function saisirLigneControle($infoControle, $unControle)
{
    try {
        

        // Variables
        $nomLongControle = $unControle->getNomLong();
        $nomCourtControle = $unControle->getNomCourt();
        $dureeControle = $unControle->getDuree();
        $dateControle = $unControle->getDate();
        $heureNonTTControle = $unControle->getHeureNonTT();
        $heureTTControle = $unControle->getHeureTT();

        // Créer les données à écrire dans le fichier CSV
        $infoControle[NOM_LONG_NOM_COLONNE_CONTROLE] = $nomLongControle;
        $infoControle[NOM_COURT_NOM_COLONNE_CONTROLE] = $nomCourtControle;
        $infoControle[DUREE_NOM_COLONNE_CONTROLE] = $dureeControle;
        $infoControle[DATE_NOM_COLONNE_CONTROLE] = $dateControle;
        $infoControle[HEURE_NOM_COLONNE_CONTROLE] = $heureNonTTControle;
        $infoControle[HEURE_TT_NOM_COLONNE_CONTROLE] = $heureTTControle;

    } catch (Exception $e) {
        throw $e;
    }
    return $infoControle;
}

?>