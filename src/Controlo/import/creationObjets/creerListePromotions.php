<?php
/**
 * @file creerListePromotions.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la fonction creerListeControles
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 * 
 */

require_once(CLASS_PATH.CLASS_PROMOTION_FILE_NAME);
require_once(CLASS_PATH.CLASS_ETUDIANT_FILE_NAME);



if (!function_exists("creerListePromotions")) {
    /**
     * @brief Fonction permettant d'obtenir la liste de toutes les promotions
     *
     * @return array $listePromotions
     *
     */
    function creerListePromotions()
    {

        $listePromotions = array();

        // On va traiter chaque fichier dans le dossier /Etudiants/
        $scandir = scandir(CSV_ETUDIANTS_FOLDER_NAME);
        foreach ($scandir as $nomFichier) {

            // S'il s'agit d'un fichier CSV, on suppose qu'il s'agit d'un fichier d'étudiants
            if (preg_match("#\.(csv)$#", strtolower($nomFichier))) {
                // On récupére le nom de la promotion
                $nomPromotion = substr($nomFichier, 0, -4);

                // On récupére une promotion
                $unePromotion = creerUnePromotion($nomPromotion);

                // On ajoute la promotion à la liste des promotions
                $listePromotions[$nomPromotion] = $unePromotion;

            }
        }
        return $listePromotions;

    }
}


if (!function_exists("creerUnePromotion")) {
    /**
     * @brief Fonction permettant de créer une promotion à partir de son nom
     *
     * @param string $nomPromotion Nom de la promotion
     * @return Promotion $unePromotion 
     */
    function creerUnePromotion($nomPromotion)
    {
        $monFichier = fopen(CSV_ETUDIANTS_FOLDER_NAME . $nomPromotion . ".csv", "r");

        // Créer la liste des controles en lisant le fichier CSV

        if (!($monFichier)) {
            print("Impossible d'ouvrir le fichier \n");
            exit;
        } else {
            // Création d'un objet Promotion
            $maPromotion = new Promotion($nomPromotion);

            // On enleve l'entete du CSV
            fgetcsv($monFichier, null, ";");

            // Lecture du reste du CSV
            while ($data = fgetcsv($monFichier, null, ";")) {
                // On créer l'étudiant
                $unEtudiant = creerEtudiant($data);

                // Ajout de l'étudiant dans la liste des étudiants (clé de la liste = l'email de l'étudiant)
                $maPromotion->ajouterEtudiant($unEtudiant);
            }
        }

        fclose($monFichier);

        return $maPromotion;
    }
}

if (!function_exists("creerEtudiant")) {
    /**
     * 
     * @brief Créer un étudiant grâce à une ligne du CSV traité
     * @param Array $ligneCSV Ligne du CSV actuelle contenant les informations de l'étudiant actuel
     * @return Etudiant Etudiant avec toutes ses informations nom, prenom...
     */
    function creerEtudiant($ligneCSV)
    {
        // Création d'un contrôle de la ligne actuelle
        $nomEtudiant = $ligneCSV[0];
        $prenomEtudiant = $ligneCSV[1];
        $tdEtudiant = $ligneCSV[4];
        $tpEtudiant = $ligneCSV[5];
        $emailEtudiant = $ligneCSV[11];
        $status = $ligneCSV[6];

        // Création d'un objet de type Controle avec les informations
        // de la ligne courante que l'on traite dans le CSV
        $unEtudiant = new Etudiant($nomEtudiant, $prenomEtudiant, $tdEtudiant, $tpEtudiant, $emailEtudiant);


        // Traiter si l'étudiant dispose d'un tiers temps
        $TABLEAUX_MOT_CLEE_TIERS_TEMPS = ["TiersTemps", "Tiers-temps"];
        $unEtudiant->setEstTT(contientMot($status, $TABLEAUX_MOT_CLEE_TIERS_TEMPS));

        // Traiter si l'étudiant dispose d'un ordinateur
        $TABLEAUX_MOT_CLEE_ORDINATEUR = ["PC", "pc", "Ordinateur"];
        $unEtudiant->setAOrdi(contientMot($status, $TABLEAUX_MOT_CLEE_ORDINATEUR));
        // Traiter si l'étudiant est demissionaire
        $TABLEAUX_MOT_CLEE_DEMISSION = ["Demission", "DÃ©mission", "Démission"];
        $unEtudiant->setEstDemissionnaire(contientMot($status, $TABLEAUX_MOT_CLEE_DEMISSION));

        return $unEtudiant;
    }
}

if (!function_exists("contientMot")) {
    /**
     * @brief Permet de vérifier si un mot clé est dans une phrase
     * @param String $unePhrase Phrase où l'on doit trouver un mot
     * @param Array $tableauMotClee Tableau des mots qui doivent être identifié
     * @return bool
     */
    function contientMot($unePhrase, $tableauMotClee)
    {
        $bool = false;

        # TiersTemps
        if (!empty($unePhrase))

            foreach ($tableauMotClee as $key => $unMotClee) {
                if ($unePhrase === $unMotClee || strpos($unePhrase, $unMotClee)) {
                    $bool = true;
                    break;
                }
            }

        return $bool;
    }
}

?>