<?php

include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
include_once(CLASS_PATH . CLASS_CONTRAINTES_ESPACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_CONTRAINTES_GENERALES_FILE_NAME);
include_once(CLASS_PATH . CLASS_PLAN_PLACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_UN_PLACEMENT_FILE_NAME);
include_once(IMPORT_PATH . "genererPDF.php");


/**
 * @brief Retourne une liste contenant les indices des étudiants qui disposent d'un tiers temps
 *      et qui n'ont pas d'ordinateur OU qui disposent d'un ordinateur (selon le paramètre $avecOrdi)
 * @param array $listeEtudiants Liste des étudiants
 * @param bool $avecOrdi Si true, on récupère les étudiants qui ont un ordinateur et un tiers temps
 * @return array Liste des indices des étudiants qui disposent d'un tiers temps
 */
function recupererIndiceEtudiantsTT($listeEtudiants, $avecOrdi = false)
{
    $listeIndiceTT = array();
    foreach ($listeEtudiants as $key => $unEtudiant) {
        if($avecOrdi){
            if($unEtudiant->getAOrdi()){
                $listeIndiceTT[] = $key;
            }
        }
        else{
            if((!$unEtudiant->getAOrdi()) && $unEtudiant->getEstTT()){
                $listeIndiceTT[] = $key;
            }
        }
    }
    return $listeIndiceTT;
}

/**
 * @brief Place un étudiant dans le tableau de placement
 * @param array $listeEtudiants Liste des étudiants
 * @param array $placementEtudiants Tableau de placement des étudiants
 * @param int $nbEtudiantsPlaces Nombre d'étudiants placés
 * @param int $numLigneCourante Numéro de ligne courant
 * @param int $numColonneCourante Numéro de colonne courant
 * @param int $indiceEtudiantAPlacer Indice de l'étudiant à placer
 * @return void
 */
function placerEtudiant(&$listeEtudiants, &$placementEtudiants, &$nbEtudiantsPlaces, $numLigneCourante, $numColonneCourante, $indiceEtudiantAPlacer){
    $placementEtudiants[$numLigneCourante][$numColonneCourante] = $listeEtudiants[$indiceEtudiantAPlacer];

    // Supprimer l'étudiant de la liste
    array_splice($listeEtudiants,$indiceEtudiantAPlacer,1);

    $nbEtudiantsPlaces++;
}

/**
 * @brief Passe à la ligne suivante. Si la ligne est supérieure au nombre de lignes du plan de salle,
 *     on retourne false sinon on retourne true
 * @param int $numColonneCourante Numéro de colonne courant
 * @param int $numLigneCourante Numéro de ligne courant
 * @param Plan $planSalle Plan de la salle
 * @param int $nbRangeesEspacement Nombre de rangées d'espacement
 * @param int $indiceColonneDepartRemplissage Indice de la colonne de départ du remplissage
 * @return bool True si on peut passer à la ligne suivante, false sinon
 */
function passerLigneSuivante(
    &$numColonneCourante,
    &$numLigneCourante,
    $planSalle,
    $nbRangeesEspacement,
    $indiceColonneDepartRemplissage){

    $etatOk = true;
    if (($numColonneCourante < 0) || ($numColonneCourante >= $planSalle->getNbColonnes())) {

        $indice = 0;
        while($indice < $nbRangeesEspacement + 1){
            $numLigneCourante += 1;
            if($numLigneCourante >= $planSalle->getNbRangees()){
                break;
            }
            if($planSalle->ligneAvecPlace($numLigneCourante)){
                $indice++;
            }
        }

        if($numLigneCourante >= $planSalle->getNbRangees()){
            $etatOk = false;
        }

        $numColonneCourante = $indiceColonneDepartRemplissage;
    }
    return $etatOk;
    
}

/**
 * @brief Passe à la colonne suivante
 * @param int $numColonneCourante Numéro de colonne courant
 * @param int $nbPlacesEspacement Nombre de places d'espacement
 * @param int $sensRemplissage Sens du remplissage
 * @return void
 */
function passerColonneSuivante(
    &$numColonneCourante,
    $nbPlacesEspacement,
    $sensRemplissage
){
        if ($sensRemplissage == "versLaGauche") {
            $numColonneCourante -= $nbPlacesEspacement + 1;
        } else {
            $numColonneCourante += $nbPlacesEspacement + 1;
        }
}

/**
 * @brief Remplit la salle avec les étudiants (avec recherche de la meilleure place)
 * @param Plan $planSalle Plan de la salle
 * @param array $listeEtudiants Liste des étudiants
 * @param int $nbRangeesEspacement Nombre de rangées d'espacement
 * @param int $nbPlacesEspacement Nombre de places d'espacement
 * @param int $indiceColonneDepartRemplissage Indice de la colonne de départ du remplissage
 * @param int $indiceLigneDepartRemplissage Indice de la ligne de départ du remplissage
 * @param int $sensRemplissage Sens du remplissage
 * @param array $placementEtudiants Tableau de placement des étudiants
 * @param int $nbEtudiantsPlaces Nombre d'étudiants placés
 * @param bool $tousTTplaces Si tous les étudiants avec un tiers temps ont été placés
 * @return void
 */
function remplirSalle(
    $planSalle,
    &$listeEtudiants,
    $nbRangeesEspacement,
    $nbPlacesEspacement,
    $indiceColonneDepartRemplissage,
    $indiceLigneDepartRemplissage,
    $sensRemplissage,
    &$placementEtudiants,
    &$nbEtudiantsPlaces,
    &$tousTTplaces
)
{
    $placementEtudiants = $planSalle->getMesZones();
    $nbEtudiantsPlaces = 0;
    $tousTTplaces = false;

    $numLigneCourante = $indiceLigneDepartRemplissage;
    $numColonneCourante = $indiceColonneDepartRemplissage;

    while (true) {
        // Vérifier si l'on passe à la ligne suivante
        if(!passerLigneSuivante(
            $numColonneCourante,
            $numLigneCourante,
            $planSalle,
            $nbRangeesEspacement,
            $indiceColonneDepartRemplissage))
        {
            break;
        }

        // Cas où tous les étudiants ont été placés
        if (count($listeEtudiants) == 0) {
            break;
        }


        // Récupérer la liste des étudiants
        $listeIndiceEtudiantsTTSansOrdi = recupererIndiceEtudiantsTT($listeEtudiants);
        $listeIndiceEtudiantsTTOrdi = recupererIndiceEtudiantsTT($listeEtudiants, true);

        // Récupérer une zone pouvant être une place, un tableau...
        $uneZone = $planSalle->getMesZones()[$numLigneCourante][$numColonneCourante];

        // Vérifier si la zone est une place
        if ($uneZone->getType() == "place") {
            $placeTrouvee = false;

            // Vérifier s'il reste des étudiants TT à placer
            if (count($listeIndiceEtudiantsTTSansOrdi) > 0 || count($listeIndiceEtudiantsTTOrdi) > 0) {
                // Vérifie si la place à une prise
                if ($uneZone->getInfoPrise() && (count($listeIndiceEtudiantsTTOrdi) > 0)) {
                    // Place les étudiants TT Ordi en priorité sur la place qui a une prise
                    $indiceEtudiantAPlacer = $listeIndiceEtudiantsTTOrdi[0];
                    
                    placerEtudiant(
                        $listeEtudiants,
                        $placementEtudiants,
                        $nbEtudiantsPlaces,
                        $numLigneCourante,
                        $numColonneCourante,
                        $indiceEtudiantAPlacer
                    );

                    // Supprimer l'étudiant de la liste
                    array_splice($listeIndiceEtudiantsTTOrdi, 0, 1);

                    $placeTrouvee = true;
                }
                // Cas où la place à une prise et qu'il y a des étudiants tt a placer
                else {
                    if(count($listeIndiceEtudiantsTTSansOrdi) > 0){
                        $indiceEtudiantAPlacer = $listeIndiceEtudiantsTTSansOrdi[0];
                        
                        placerEtudiant(
                            $listeEtudiants,
                            $placementEtudiants,
                            $nbEtudiantsPlaces,
                            $numLigneCourante,
                            $numColonneCourante,
                            $indiceEtudiantAPlacer
                        );

                        // Supprimer l'étudiant de la liste
                        array_splice($listeIndiceEtudiantsTTSansOrdi, 0, 1);

                        $placeTrouvee = true;
                    }
                }


            }

            if (count($listeIndiceEtudiantsTTSansOrdi) == 0 && count($listeIndiceEtudiantsTTOrdi) == 0){
                // Tous les étudiants TT ont été placés
                $tousTTplaces = true;
            }

            // Placer un étudiant non tiers-temps si aucun étudiant TT n'a été placé
            if(!$placeTrouvee){
                // Placer l'étudiant non tiers-temps
                $indiceEtudiantAPlacer = 0;
                    
                placerEtudiant(
                        $listeEtudiants,
                        $placementEtudiants,
                        $nbEtudiantsPlaces,
                        $numLigneCourante,
                        $numColonneCourante,
                        $indiceEtudiantAPlacer
                );
            }

        }
        // Calculer le numéro de ligne de la prochaine case

        // -- nbRangeesEspacement + 1 car parametre = 0

        // Calculer le numéro de colonne de la prochaine case
        passerColonneSuivante(
            $numColonneCourante,
            $nbPlacesEspacement,
            $sensRemplissage);

        // Vérifier la pertinence du numéro de ligne courante
        if ($numLigneCourante >= $planSalle->getNbRangees()) {
            break;
        }

    }


}


function associerPlanPlacement(&$unControle, $uneSalle, $unPlacementEtudiants){
    $nomSalle = $uneSalle->getNom();
    $unPlanSalle = $uneSalle->getMonPlan()->getMesZones();
    $nbLigneSalle = count($unPlanSalle);
    
    $unPDP = $unControle->getMesPlansDePlacement()[$nomSalle];
    for($i = 0; $i < $nbLigneSalle; $i++){
        $nbColSalle = count($unPlanSalle[$i]);
        for($j = 0; $j < $nbColSalle; $j++){
            $uneZoneOuEtudiant = $unPlacementEtudiants[$i][$j];
            if($uneZoneOuEtudiant instanceof Etudiant){
                $unEtudiant = $uneZoneOuEtudiant;
                if($unEtudiant != null){
                    $unePlace = $unPlanSalle[$i][$j];
                    $placement = new UnPlacement();
                    $placement->setMonEtudiant($unEtudiant);
                    $placement->setMaZone($unePlace);
                    $unPDP->ajouterPlacement($placement);
                }
            }
        }
    }

    $unControle->ajouterPlanDePlacement($unPDP);
}


function placementAligne(&$unControle, &$erreur = true){
    try{
        $erreur = true;

        $listeSalles = $unControle->getMesSalles();
        $listePromotions = $unControle->getMesPromotions();

        $listeEtudiants = array();
        foreach ($listePromotions as $unePromotion) {
            $listeEtudiants = array_merge($listeEtudiants, $unePromotion->recupererListeEtudiantsNonDemissionnaire());
        }

        // -- Récupération des contraintes générales
        $typePlacement = $_POST["typePlacement"];
        $typeSeparation = $_POST["typeSeparation"];

        // -- Création des contraintes générales
        $contraintesGenerales = new ContraintesGenerales($typePlacement, $typeSeparation);
        $algoRemplissage = $contraintesGenerales->getAlgoRemplissage();
        $listeEtudiants = trieListe($listeEtudiants, $algoRemplissage);

        $tabSens = array("versLaDroite", "versLaGauche");

        $listePDP = $unControle->getMesPlansDePlacement();

        foreach($listeSalles as $uneSalle){
            // Récupérer les contraintes
            $lePDP = $listePDP[$uneSalle->getNom()];

            // Préparation des données
            $contraintesEspacements = $lePDP->getMaContrainteEspacement();

            $nbRangeesEspacement = $contraintesEspacements->getNbRangs();
            $nbPlacesEspacement = $contraintesEspacements->getNbPlaces();
        
            $indiceColDepart = 0;
            $indiceLigneDepart = 0;
        
            $nbEtudiantsPlaces = 0;
            $tousTTplaces = false;

            $planSalle = $uneSalle->getMonPlan();
            $tailleTableauLigne = $planSalle->getNbRangees();
            $tailleTableauColonne = $planSalle->getNbColonnes();

            $tousTTplacesFinal = false;
            $nbEtudiantsPlacesFinal = 0;

            $planSalle = $uneSalle->getMonPlan();

            // Exploration des différents sens de remplissage et du meilleur placement
            foreach($tabSens as $sens){
                for($indiceLigneDepart = 0; $indiceLigneDepart < $tailleTableauLigne; $indiceLigneDepart++){
                    for($indiceColDepart = 0; $indiceColDepart < $tailleTableauColonne; $indiceColDepart++){
                        $listeEtudiantsCopie = $listeEtudiants;
                        $placementEtudiants = array();

                        remplirSalle(
                            $planSalle,
                            $listeEtudiantsCopie,
                            $nbRangeesEspacement,
                            $nbPlacesEspacement,
                            $indiceColDepart,
                            $indiceLigneDepart,
                            $sens,
                            $placementEtudiants,
                            $nbEtudiantsPlaces,
                            $tousTTplaces
                        );

                        // Comparer le nombre d'étudiants placés
                        if($tousTTplacesFinal){
                            if($tousTTplaces){
                                if($nbEtudiantsPlaces > $nbEtudiantsPlacesFinal){
                                    $placementEtudiantsFinal = $placementEtudiants;
                                    $nbEtudiantsPlacesFinal = $nbEtudiantsPlaces;
                                    $indiceColDepartFinal = $indiceColDepart;
                                    $indiceLigneDepartFinal = $indiceLigneDepart;
                                    $sensFinal = $sens;
                                    $tousTTplacesFinal = $tousTTplaces;
                                    $listeEtudiantsFinal = $listeEtudiantsCopie;
                                }
                            }
                        }
                        else{
                            if($nbEtudiantsPlaces > $nbEtudiantsPlacesFinal || $tousTTplaces
                            || $nbEtudiantsPlacesFinal == 0){
                                $placementEtudiantsFinal = $placementEtudiants;
                                $nbEtudiantsPlacesFinal = $nbEtudiantsPlaces;
                                $indiceColDepartFinal = $indiceColDepart;
                                $indiceLigneDepartFinal = $indiceLigneDepart;
                                $sensFinal = $sens;
                                $tousTTplacesFinal = $tousTTplaces;
                                $listeEtudiantsFinal = $listeEtudiantsCopie;
                            }
                        }
                    }
                }
            }

            // Créer le plan de placement de la salle
            associerPlanPlacement($unControle, $uneSalle, $placementEtudiantsFinal);
            $listeEtudiants = $listeEtudiantsFinal;

        }

        if (count($listeEtudiants)!=0){
            throw new Exception("Impossible de placer tous les étudiants");
        }

        $erreur = false;

        return $erreur;
    }  catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

