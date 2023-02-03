<?php
/**
 * @file creerListeControles.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la fonction creerListeControles
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 * 
 */

DEFINE("CHEMIN_LISTE_CONTROLES", CSV_CONTROLES_FOLDER_NAME . LISTE_CONTROLES_FILE_NAME);
include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);
include_once(FONCTION_CREER_LISTE_SALLES_PATH);
include_once(CLASS_PATH . CLASS_CONTROLE_FILE_NAME);
include_once(FONCTION_ASSOCIER_ENTETE_LIGNE_PATH);



/**
 * @brief Cette fonction retourne la liste des contrôles sans les liens
 *
 * @return array
 */
function creerListeControles()
{
    $monFichier = fopen(CHEMIN_LISTE_CONTROLES, "r");

    // Créer la liste des controles en lisant le fichier CSV

    if (!($monFichier)) {
        print("Impossible d'ouvrir le fichier \n");
        exit;
    } else {
        // Création des listes nécéssaires
        $listeControles = array();
        $listePromo = creerListePromotions();
        $listeSalles = creerListeSalles();
        
        $i = 0;

        // On récupére la première ligne du CSV qui contient les noms des colonnes
        $entete = fgetcsv($monFichier, null, ";");

        // Supprimer les espaces en début et fin de chaque nom de colonne
        foreach ($entete as $key => $value) {
            $entete[$key] = trim($value);
        }
        

        // Lecture du reste du CSV
        while ($uneLigne = fgetcsv($monFichier, null, ";")) {
            // Changer les clés associatives pour que les clés soient les noms des colonnes
            $unControleInfo = associerEnteteLigne($entete, $uneLigne);

            // Création du contrôle de la ligne actuelle
            $unControle = creerControle($unControleInfo, $listePromo, $listeSalles);


            // Ajout du contrôle dans la liste des contrôles
            $listeControles[$i] = $unControle;
            $i++;
        }

    }

    fclose($monFichier);

    return $listeControles;
}

/**
 * @brief Retourne un Controle selon un id donné (= ligne dans le CSV sans l'entête)
 * @param int $id Id du Controle que nous souhaitons récupérer
 * @return Controle|null
 */
function recupererUnControle($id)
{
    $monFichier = fopen(CHEMIN_LISTE_CONTROLES, "r");

    // Créer la liste des controles en lisant le fichier CSV

    if (!($monFichier)) {
        print("Impossible d'ouvrir le fichier \n");
        exit;
    } else {
        // Création d'une liste vide
        $leControle = null;
        $i = 0;

        // On récupére la première ligne du CSV qui contient les noms des colonnes
        $entete = fgetcsv($monFichier, null, ";");
        
        // Supprimer les espaces en début et fin de chaque nom de colonne
        foreach ($entete as $key => $value) {
            $entete[$key] = trim($value);
        }

        // Lecture du reste du CSV
        while ($uneLigne = fgetcsv($monFichier, null, ";")) {
            if ($i == $id) {
                $unControleInfo = associerEnteteLigne($entete, $uneLigne);

                $leControle = creerControle($unControleInfo); 
            }
            $i++;
        }

    }

    fclose($monFichier);

    return $leControle;
}

/**
 * Retourne un Controle selon les informations données
 * @param array $unControleInfo Ligne d'information venant du fichier de la liste des contrôles
 * @param array $listePromo Liste des promotions
 * @param array $listeSalles Liste des salles
 * @return Controle
 */
function creerControle($unControleInfo, $listePromo = null, $listeSalles = null){
    // Mettre la date au format YYYY-MM-DD si une date existe (pour datatables)
    $laDate = $unControleInfo[DATE_NOM_COLONNE_CONTROLE];
    if ($laDate != null) {
        $laDate = DateTime::createFromFormat('d/m/Y', $laDate);
        $laDate = $laDate->format('Y-m-d');
    }

    // Création du contrôle de la ligne actuelle
    $leNomLong = $unControleInfo[NOM_LONG_NOM_COLONNE_CONTROLE];
    $leNomCourt = $unControleInfo[NOM_COURT_NOM_COLONNE_CONTROLE];
    $laDuree = $unControleInfo[DUREE_NOM_COLONNE_CONTROLE];
    $lHeureNonTT = $unControleInfo[HEURE_NOM_COLONNE_CONTROLE];
    $lHeureTT = $unControleInfo[HEURE_TT_NOM_COLONNE_CONTROLE];

    // Création d'un objet de type Controle avec les informations
    // de la ligne courante que l'on traite dans le CSV
    $leControle = new Controle($leNomLong, $leNomCourt, $laDuree, $laDate, $lHeureNonTT, $lHeureTT);

    // Création du lien entre les promotions et le contrôle
    $leControle = creerRelationPromotionControle($leControle, $unControleInfo[PROMOTION_NOM_COLONNE_CONTROLE], $listePromo);

    // Création du lien entre les salles et le contrôle
    $leControle = creerRelationSalleControle($leControle, $unControleInfo[SALLES_NOM_COLONNE_CONTROLE], $listeSalles);

    return $leControle;
}

/**
 * @brief Retourne un Controle en le mettant en relation avec une liste de nom de Promotion
 * @param Controle $unControle Controle que nous souhaitons mettre en relation avec $lesPromos
 * @param string $lesPromos Les Promotion qui doivent être mis en relation avec $unControle
 * (chaine de carateres avec le nom des promotions séparées par des virgules)
 * @param array $listePromo Liste des promotions (objet) qui peuvent être associées au contrôle
 * @return Controle
 */
function creerRelationPromotionControle($unControle, $lesPromos, $listePromo)
{
    if ($listePromo == null) {
        $listePromo = creerListePromotions();
    }

    // On récupére la liste des promotions participants au contrôle
    $listePromosControle = explode(",", $lesPromos);

    // Pour chaque promotion (chaîne de caractère), on essaye d'associer
    // si possible la promotion (objet)
    foreach ($listePromosControle as $nomUnePromoControle) {
        $nomUnePromoControle = trim($nomUnePromoControle);// solution au espace pour recuperer plusieurs promo
        foreach ($listePromo as $nomPromo => $unePromo) {
            if ($nomPromo == $nomUnePromoControle) {
                $unControle->ajouterPromotion($unePromo);
            }
        }
    }


    return $unControle;
}

/**
 * @brief Retourne un Controle en le mettant en relation avec une liste de nom de Salle
 * @param Controle $unControle Controle que nous souhaitons mettre en relation avec $lesSalles
 * @param string $lesSalles Les Salles qui doivent être mis en relation avec $unControle
 * (chaine de caractères avec le nom des salles séparées par des virgules)
 * @param array $listeSalles Liste des salles (objets) à utiliser pour la relation
 * @return Controle
 */
function creerRelationSalleControle($unControle, $lesSalles, $listeSalles = null)
{
    if ($listeSalles == null){
        // On récupére la liste des salles (objets)
        $listeSalles = creerListeSalles();
    }

    // On récupére la liste des promotions participants au contrôle
    $listeSallesControle = explode(",", $lesSalles);

    // Pour chaque promotion, on essaye d'associer si possible la promotion
    foreach ($listeSallesControle as $nomUneSalleControle) {
        $nomUneSalleControle = str_replace(" ", "", $nomUneSalleControle);
        foreach ($listeSalles as $nomSalle => $uneSalle) {
            if ($nomSalle == $nomUneSalleControle) {
                $unControle->ajouterSalle($uneSalle);
            }
        }
    }

    return $unControle;
}


?>