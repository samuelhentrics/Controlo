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
function ajouterEtudiant($nomEtudiant, $prenomEtudiant, $nomPromotion,
$tdEtudiant, $tpEtudiant, $emailEtudiant, $tiersTempsEtudiant,
$ordinateurEtudiant, $demissionnaireEtudiant){

    // On initialise un booléen en cas d'erreur
    $ajoutOk = true;

    // Tentative d'écriture du fichier CSV
    try
    {
        $lienFichier = CSV_ETUDIANTS_FOLDER_NAME . $nomPromotion . ".csv";

        // Ouvrir le fichier CSV en mode lecture pour récupérer les entêtes
        $monFichier = fopen($lienFichier, "r");

        if($monFichier === false)
        {
            throw new Exception("Impossible d'ouvrir le fichier CSV");
        }

        // Récupérer les entêtes
        $entetes = fgetcsv($monFichier, 10000, ";");

        if($entetes === false)
        {
            throw new Exception("Impossible de récupérer les entêtes du fichier CSV");
        }

        // Fermer le fichier CSV
        fclose($monFichier);

        // Supprimer les espaces en début et fin de chaîne de chaque entête
        $entetes = array_map('trim', $entetes);

        // Vérifier que l'entete contient les champs obligatoires de la nomenclature
        if (!in_array(NOM_NOM_COLONNE_ETUDIANT, $entetes) || !in_array(PRENOM_NOM_COLONNE_ETUDIANT, $entetes) ||
            !in_array(TD_NOM_COLONNE_ETUDIANT, $entetes) || !in_array(TP_NOM_COLONNE_ETUDIANT, $entetes) ||
            !in_array(MAIL_NOM_COLONNE_ETUDIANT, $entetes) || !in_array(STATUTS_NOM_COLONNE_ETUDIANT, $entetes))
        {
            throw new Exception("Le fichier CSV de la promotion ne contient pas les champs obligatoires de la nomenclature");
        }

        // Mettre les valeurs de l'entete en tant que clés
        $infoEtudiant = array_flip($entetes);
        foreach ($infoEtudiant as $key => $value)
        {
            $infoEtudiant[$key] = null;
        }

        // Créer les données à écrire dans le fichier CSV
        $infoEtudiant[NOM_NOM_COLONNE_ETUDIANT] = $nomEtudiant;
        $infoEtudiant[PRENOM_NOM_COLONNE_ETUDIANT] = $prenomEtudiant;
        $infoEtudiant[TD_NOM_COLONNE_ETUDIANT] = $tdEtudiant;
        $infoEtudiant[TP_NOM_COLONNE_ETUDIANT] = $tpEtudiant;
        $infoEtudiant[MAIL_NOM_COLONNE_ETUDIANT] = $emailEtudiant;

        $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] = null;
        if ($tiersTempsEtudiant == "on")
        {
            $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT].= "Tiers temps";
        }
        
        if ($ordinateurEtudiant == "on")
        {
            if ($infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] != null)
            {
                $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT].= ", ";
            }
            $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT].= "Ordinateur";
        }

        if ($demissionnaireEtudiant == "on")
        {
            if ($infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT] != null)
            {
                $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT].= ", ";
            }
            $infoEtudiant[STATUTS_NOM_COLONNE_ETUDIANT].= "Démisionnaire";
        }

        // Ajouter l'étudiant en fin de fichier

        // Ouvrir le fichier CSV en mode écriture en fin de fichier
        $monFichier = fopen($lienFichier, "a");

        // Ajouter l'array dans le CSV
        fputcsv($monFichier, $infoEtudiant, ";");

        // Fermer le fichier CSV
        fclose($monFichier);

    }
    catch (Exception $e)
    {
        // Afficher l'erreur      
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo $e->getMessage();
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo '</div>';

        $ajoutOk = false;
    }

    return $ajoutOk;
}