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
        $enseignantRefControle = $unControle->getMesEnseignantsReferents();
        $enseignantSurControle = $unControle->getMesEnseignantsSurveillants();

        $lesPromos = $unControle->getMesPromotions();
        $nomsPromos = "";

        foreach($lesPromos as $unNomPromo){
            $nomsPromos.= $unNomPromo->getNom() . ", ";
        }
        $nomsPromos = substr($nomsPromos, 0, -2);

        $lesSalles = $unControle->getMesSalles();
        $nomsSalles = "";

        foreach($lesSalles as $unNomSalle){
            $nomsSalles.= $unNomSalle->getNom() . ", ";
        }
        $nomsSalles = substr($nomsSalles, 0, -2);

        $nomsSurveillants = "";
        foreach($enseignantSurControle as $unMesSurveillant){
            $nomsSurveillants.= $unMesSurveillant . ", ";
        }
        $nomsSurveillants = substr($nomsSurveillants, 0, -2);

        $nomsRef = "";
        foreach($enseignantRefControle as $unMesReferent){
            $nomsRef.= $unMesReferent . ", ";
        }
        $nomsRef = substr($nomsRef, 0, -2);

        // Créer les données à écrire dans le fichier CSV
        $infoControle[PROMOTION_NOM_COLONNE_CONTROLE] = $nomsPromos;
        $infoControle[NOM_LONG_NOM_COLONNE_CONTROLE] = $nomLongControle;
        $infoControle[NOM_COURT_NOM_COLONNE_CONTROLE] = $nomCourtControle;
        $infoControle[DUREE_NOM_COLONNE_CONTROLE] = $dureeControle;
        $infoControle[DATE_NOM_COLONNE_CONTROLE] = $dateControle;
        $infoControle[HEURE_NOM_COLONNE_CONTROLE] = $heureNonTTControle;
        $infoControle[HEURE_TT_NOM_COLONNE_CONTROLE] = $heureTTControle;
        $infoControle[SALLES_NOM_COLONNE_CONTROLE] = $nomsSalles;
        $infoControle[ENSEIGNANT_REF_NOM_COLONNE_CONTROLE] = $nomsRef;
        $infoControle[SURVEILLANTS_NOM_COLONNE_CONTROLE] = $nomsSurveillants;

    } catch (Exception $e) {
        throw $e;
    }
    return $infoControle;
}
function modifierControle($id, $nouveauControle) {
    // On initialise un booléen en cas d'erreur
    $modificationOk = false;

    // Tentative de suppression du controle
    try {

        $lienFichier = CSV_CONTROLES_FOLDER_NAME.LISTE_CONTROLES_FILE_NAME;

        // Récupérer les entêtes du fichier CSV
        $entetes = recupererEnteteControle($lienFichier);

        // Ouvrir le fichier en mode modification
        $monFichier = fopen($lienFichier, "r+");

        if (!$monFichier) {
            throw new Exception("Impossible d'ouvrir le fichier CSV");
        }

        $data = array();
        $i = 0;
        // Aller sur la ligne de l'étudiant à modifier
        while (true) {
            $ligne = fgetcsv($monFichier, 1000, ";");

            if (!$ligne) {
                break;
            }

            $data[$i] = $ligne;
            $i++;
        }

        // Récupérer les informations de l'étudiant

        // Modifier les informations de l'étudiant
        $infoControle = saisirLigneControle(
            $entetes,
            $nouveauControle
        );

        $data[$id + 1] = $infoControle;

        // Remplacer l'ancienne ligne par la nouvelle
        rewind($monFichier); // On se replace au début du fichier
        ftruncate($monFichier, 0); // On vide le fichier
        foreach ($data as $fields) {
            fputcsv($monFichier, $fields, ";");
        }

        // Fermer le fichier CSV
        fclose($monFichier);

        // On indique que la modification s'est bien passée
        $modificationOk = true;

    } catch (Exception $e) {
        $modificationOk = false;
        throw new Exception($e->getMessage());
    }

    return $modificationOk;
}

?>