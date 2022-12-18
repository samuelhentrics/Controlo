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

DEFINE("CHEMIN_LISTE_CONTROLES", CSV_CONTROLES_FOLDER_NAME.LISTE_CONTROLES_FILE_NAME);
include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);
include_once(FONCTION_CREER_LISTE_SALLES_PATH);
include_once(CLASS_PATH.CLASS_CONTROLE_FILE_NAME);
include_once(CLASS_PATH.CLASS_CONTROLE_FILE_NAME);



/**
 * @brief Cette fonction retourne la liste des contrôles sans les liens
 *
 * @return array
 */
function creerListeControles(){
    $monFichier = fopen(CHEMIN_LISTE_CONTROLES, "r");

    // Créer la liste des controles en lisant le fichier CSV

    if (!($monFichier)) {
        print("Impossible d'ouvrir le fichier \n");
        exit;
    } else {
        // Création d'une liste vide
        $listeControles = array();
        $i = 0;

        // On enleve l'entete
        fgetcsv($monFichier, null, ";");

        // Lecture du reste du CSV
        while ($data = fgetcsv($monFichier, null, ";")) {

            // Mettre la date au format YYYY-MM-DD si une date existe (pour datatables)
            if ($data[7] != null){
                $data[7] = DateTime::createFromFormat('d/m/Y', $data[7]);
                $data[7] = $data[7]->format('Y-m-d');
            }

            // Création d'un contrôle de la ligne actuelle
            $leNomLong = $data[3];
            $leNomCourt = $data[4];
            $laDuree = $data[6];
            $laDate = $data[7];
            $lHeureNonTT = $data[8];
            $lHeureTT= $data[9];

            // Création d'un objet de type Controle avec les informations
            // de la ligne courante que l'on traite dans le CSV
            $unControle = new Controle($leNomLong,$leNomCourt,$laDuree,$laDate,$lHeureNonTT,$lHeureTT);

            // Création du lien entre les promotions et le contrôle
            $unControle = creerRelationPromotionControle($unControle, $data[0]);

            // Création du lien entre les salles et le contrôle
            $unControle = creerRelationSalleControle($unControle, $data[10]);
            
          
            // Ajout du contrôle dans la liste des contrôles
            $listeControles[$i] = $unControle;
            $i++;
        }

    }

    fclose($monFichier);

    return $listeControles;
}

function recupererUnControle($id){    
    $monFichier = fopen(CHEMIN_LISTE_CONTROLES, "r");

    // Créer la liste des controles en lisant le fichier CSV

    if (!($monFichier)) {
        print("Impossible d'ouvrir le fichier \n");
        exit;
    } else {
        // Création d'une liste vide
        $leControle = null;
        $i = 0;

        // On enleve l'entete
        fgetcsv($monFichier, null, ";");

        // Lecture du reste du CSV
        while ($data = fgetcsv($monFichier, null, ";")) {
            if ($i == $id){
                // Mettre la date au format YYYY-MM-DD si une date existe (pour datatables)
                if ($data[7] != null){
                    $data[7] = DateTime::createFromFormat('d/m/Y', $data[7]);
                    $data[7] = $data[7]->format('Y-m-d');
                }
    
                // Création du contrôle de la ligne actuelle
                $leNomLong = $data[3];
                $leNomCourt = $data[4];
                $laDuree = $data[6];
                $laDate = $data[7];
                $lHeureNonTT = $data[8];
                $lHeureTT= $data[9];
    
                // Création d'un objet de type Controle avec les informations
                // de la ligne courante que l'on traite dans le CSV
                $leControle = new Controle($leNomLong,$leNomCourt,$laDuree,$laDate,$lHeureNonTT,$lHeureTT);
    
                // Création du lien entre les promotions et le contrôle
                $leControle = creerRelationPromotionControle($leControle, $data[0]);
    
                // Création du lien entre les salles et le contrôle
                $leControle = creerRelationSalleControle($leControle, $data[10]);
                
            }
            $i++;
        }

    }

    fclose($monFichier);

    return $leControle;
}

function creerRelationPromotionControle($unControle, $lesPromos){
    $listePromo = creerListePromotions();
    
    // On récupére la liste des promotions participants au contrôle
    $listePromosControle = explode(",", $lesPromos);

    // Pour chaque promotion, on essaye d'associer si possible la promotion
    foreach($listePromosControle as $nomUnePromoControle){
        foreach ($listePromo as $nomPromo => $unePromo) {
            if($nomPromo == $nomUnePromoControle) {
                $unControle->ajouterPromotion($unePromo);
            }
        }
    }
    

    return $unControle;
}

function creerRelationSalleControle($unControle, $lesSalles){
    $listeSalles = creerListeSalles();
    
    // On récupére la liste des promotions participants au contrôle
    $listeSallesControle = explode(",", $lesSalles);

    // Pour chaque promotion, on essaye d'associer si possible la promotion
    foreach($listeSallesControle as $nomUneSalleControle){
        $nomUneSalleControle = str_replace(" ", "", $nomUneSalleControle); 
        foreach ($listeSalles as $nomSalle => $uneSalle) {
            if($nomSalle == $nomUneSalleControle) {
                $unControle->ajouterSalle($uneSalle);
            }
        }
    }

    return $unControle;
}


?>