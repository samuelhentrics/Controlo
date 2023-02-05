<?php
/**
 * @brief Contient les fonctions CRUD pour les étudiants (ajouter, modifier, supprimer)
 * @file etudiantsCRUD.php
 * @version 1.0
 * @date 02/02/2023
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 */


/**
 * @brief Ajoute un étudiant dans le fichier CSV des étudiants (selon la promotion donnée)
 * @param string $nomEtudiant Nom de l'étudiant
 * @param string $prenomEtudiant Prénom de l'étudiant
 * @param string $nomPromotion Nom de la promotion de l'étudiant
 * @param int $tdEtudiant TD de l'étudiant
 * @param int $tpEtudiant TP de l'étudiant
 * @param string $emailEtudiant Email de l'étudiant
 * @param string $tiersTempsEtudiant Tiers-temps de l'étudiant (vrai s'il en dispose, faux sinon)
 * @param string $ordinateurEtudiant Ordinateur de l'étudiant (vrai s'il en dispose, faux sinon)
 * @param string $demissionnaireEtudiant Démissionnaire de l'étudiant (vrai s'il est démissionnaire, faux sinon)
 * @throws Exception Si le fichier CSV ne contient pas les champs obligatoires de la nomenclature
 * @return bool Retourne vrai si l'ajout s'est bien passé, faux sinon
 */
function ajouterEtudiant(
    $nomEtudiant,
    $prenomEtudiant,
    $nomPromotion,
    $tdEtudiant,
    $tpEtudiant,
    $emailEtudiant,
    $tiersTempsEtudiant,
    $ordinateurEtudiant,
    $demissionnaireEtudiant
)
{

    // On initialise un booléen en cas d'erreur
    $ajoutOk = false;

    // Tentative d'écriture du fichier CSV
    try {
        $lienFichier = CSV_ETUDIANTS_FOLDER_NAME . $nomPromotion . ".csv";

        // Récupérer un array selon l'entete du fichier CSV
        $infoEtudiant = recupererEnteteEtudiant($lienFichier);

        // Faire un array avec les informations de l'étudiant
        $infoEtudiant = saisirLigneEtudiant(
            $infoEtudiant,
            $nomEtudiant,
            $prenomEtudiant,
            $tdEtudiant,
            $tpEtudiant,
            $emailEtudiant,
            $tiersTempsEtudiant,
            $ordinateurEtudiant,
            $demissionnaireEtudiant
        );

        // Ajouter l'étudiant en fin de fichier

        // Ouvrir le fichier CSV en mode écriture en fin de fichier
        $monFichier = fopen($lienFichier, "a");

        if (!$monFichier) {
            throw new Exception("Impossible d'ouvrir le fichier CSV. Il semble être ouvert par un autre programme.");
        }

        // Ajouter l'array dans le CSV
        fputcsv($monFichier, $infoEtudiant, ";");

        // Fermer le fichier CSV
        fclose($monFichier);

        $ajoutOk = true;

    } catch (Exception $e) {
        $ajoutOk = false;
        throw new Exception($e->getMessage());
    }

    return $ajoutOk;
}

/**
 * @brief Modifie un étudiant dans le fichier CSV des étudiants (selon la promotion donnée)
 * @param string $nomPromotion Nom de la promotion de l'étudiant
 * @param int $idEtudiant ID de l'étudiant
 * @param string $nomEtudiant Nom de l'étudiant
 * @param string $prenomEtudiant Prénom de l'étudiant
 * @param int $tdEtudiant TD de l'étudiant
 * @param int $tpEtudiant TP de l'étudiant
 * @param string $emailEtudiant Email de l'étudiant
 * @param string $tiersTempsEtudiant Tiers-temps de l'étudiant (vrai s'il en dispose, faux sinon)
 * @param string $ordinateurEtudiant Ordinateur de l'étudiant (vrai s'il en dispose, faux sinon)
 * @param string $demissionnaireEtudiant Démissionnaire de l'étudiant (vrai s'il est démissionnaire, faux sinon)
 * @throws Exception 
 * @return bool Retourne vrai si la modification s'est bien passée, faux sinon
 */
function modifierEtudiant($nomPromotion, $idEtudiant, $nomEtudiant, $prenomEtudiant, $tdEtudiant, $tpEtudiant, $emailEtudiant, $tiersTempsEtudiant, $ordinateurEtudiant, $demissionnaireEtudiant)
{

    // On initialise un booléen en cas d'erreur
    $modificationOk = false;

    // Tentative de suppression de l'étudiant
    try {
        $lienFichier = CSV_ETUDIANTS_FOLDER_NAME . $nomPromotion . ".csv";

        // Récupérer les entêtes du fichier CSV
        $entetes = recupererEnteteEtudiant($lienFichier);

        // Ouvrir le fichier en mode modification
        $monFichier = fopen($lienFichier, "r+");

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
        $infoEtudiant = saisirLigneEtudiant(
            $entetes,
            $nomEtudiant,
            $prenomEtudiant,
            $tdEtudiant,
            $tpEtudiant,
            $emailEtudiant,
            $tiersTempsEtudiant,
            $ordinateurEtudiant,
            $demissionnaireEtudiant
        );

        $data[$idEtudiant + 1] = $infoEtudiant;

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

/**
 * @brief Retourne un array prêt à remplir avec pour clés les entêtes du fichier CSV
 * @param string $lienFichier Chemin du fichier CSV
 * @throws Exception 
 * @return array|null Retourne un array prêt à remplir avec pour clés les entêtes du fichier CSV, null si le fichier CSV ne peut être ouvert
 */
function recupererEnteteEtudiant($lienFichier)
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
            !in_array(NOM_NOM_COLONNE_ETUDIANT, $entetes) || !in_array(PRENOM_NOM_COLONNE_ETUDIANT, $entetes) ||
            !in_array(TD_NOM_COLONNE_ETUDIANT, $entetes) || !in_array(TP_NOM_COLONNE_ETUDIANT, $entetes) ||
            !in_array(MAIL_NOM_COLONNE_ETUDIANT, $entetes) || !in_array(STATUTS_NOM_COLONNE_ETUDIANT, $entetes)
        ) {
            throw new Exception("Le fichier CSV de la promotion ne contient pas les champs obligatoires de la nomenclature");
        }

        // Mettre les valeurs de l'entete en tant que clés
        $infoEtudiant = array_flip($entetes);
        foreach ($infoEtudiant as $key => $value) {
            $infoEtudiant[$key] = null;
        }

        return $infoEtudiant;
    } catch (Exception $e) {
        throw $e;
    }
}

/**
 * @brief Modifie une ligne d'un array d'une info étudiante
 * @param array $infoEtudiant Array contenant les infos d'un étudiant
 * @param string $nomEtudiant Nom de l'étudiant
 * @param string $prenomEtudiant Prénom de l'étudiant
 * @param int $tdEtudiant Numéro du TD de l'étudiant
 * @param int $tpEtudiant Numéro du TP de l'étudiant
 * @param string $emailEtudiant Email de l'étudiant
 * @param string $tiersTempsEtudiant Tiers temps de l'étudiant
 * @param string $ordinateurEtudiant Ordinateur de l'étudiant
 * @param string $demissionnaireEtudiant Démisionnaire de l'étudiant
 * @return array Liste contenant les infos d'un étudiant
 */
function saisirLigneEtudiant($infoEtudiant, $nomEtudiant, $prenomEtudiant, $tdEtudiant, $tpEtudiant, $emailEtudiant, $tiersTempsEtudiant, $ordinateurEtudiant, $demissionnaireEtudiant)
{
    try {
        // Créer les données à écrire dans le fichier CSV
        $infoEtudiant[NOM_NOM_COLONNE_ETUDIANT] = $nomEtudiant;
        $infoEtudiant[PRENOM_NOM_COLONNE_ETUDIANT] = $prenomEtudiant;

        // Vérifier que le numéro de TD est un entier
        if (!is_numeric($tdEtudiant)) {
            throw new Exception("Le numéro de TD de l'étudiant n'est pas un entier");
        }
        $infoEtudiant[TD_NOM_COLONNE_ETUDIANT] = $tdEtudiant;

        // Vérifier que le numéro de TP est un entier
        if (!is_numeric($tpEtudiant)) {
            throw new Exception("Le numéro de TP de l'étudiant n'est pas un entier");
        }
        $infoEtudiant[TP_NOM_COLONNE_ETUDIANT] = $tpEtudiant;

        // Vérifier que le mail est valide
        if (!filter_var($emailEtudiant, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Le mail de l'étudiant n'est pas valide");
        }

        $infoEtudiant[MAIL_NOM_COLONNE_ETUDIANT] = $emailEtudiant;

        $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] = null;
        if ($tiersTempsEtudiant == "on") {
            $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] .= "Tiers temps";
        }

        if ($ordinateurEtudiant == "on") {
            if ($infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] != null) {
                $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] .= ", ";
            }
            $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] .= "Ordinateur";
        }

        if ($demissionnaireEtudiant == "on") {
            if ($infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] != null) {
                $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] .= ", ";
            }
            $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] .= "Démissionnaire";
        }
    } catch (Exception $e) {
        throw $e;
    }
    return $infoEtudiant;
}

function supprimerEtudiant($idEtudiant, $nomPromotion)
{
    include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

    // On initialise un booléen en cas d'erreur
    $suppressionOk = false;
    // Tentative d'écriture du fichier CSV
    try {
        $lienFichier = CSV_ETUDIANTS_FOLDER_NAME . $nomPromotion . ".csv";
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
            if (!($indiceLigne == $idEtudiant + 1)) {
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