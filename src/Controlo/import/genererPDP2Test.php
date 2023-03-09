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

function placerEtudiant(&$listeEtudiants, &$placementEtudiants, &$nbEtudiantsPlaces, $numLigneCourante, $numColonneCourante, $indiceEtudiantAPlacer){
    $placementEtudiants[$numLigneCourante][$numColonneCourante] = $listeEtudiants[$indiceEtudiantAPlacer];

    // Supprimer l'étudiant de la liste
    array_splice($listeEtudiants,$indiceEtudiantAPlacer,1);

    $nbEtudiantsPlaces++;
}

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
        if (($numColonneCourante < 0) || ($numColonneCourante >= $planSalle->getNbColonnes())) {

            $numLigneCourante += $nbRangeesEspacement + 1; // Fct rangée suivante


            $numColonneCourante = $indiceColonneDepartRemplissage;
            if($numLigneCourante >= $planSalle->getNbRangees()){
                break;
            }
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
        if ($sensRemplissage == "versLaGauche") {
            $numColonneCourante -= $nbPlacesEspacement + 1;
        } else {
            $numColonneCourante += $nbPlacesEspacement + 1;
        }

        // Vérifier la pertinence du numéro de ligne courante
        if ($numLigneCourante >= $planSalle->getNbRangees()) {
            break;
        }

    }


}



// Préparation des données


$unControle = recupererUnControle(1);

$listeSalles = $unControle->getMesSalles();
$listePromotions = $unControle->getMesPromotions();


$uneSalle = $listeSalles["S124"];

$uneSalle = creerUneSalle("S129");
$uneSalle = creerRelationSallePlan($uneSalle);
$planSalle = $uneSalle->getMonPlan();

$listeEtudiants = array();
foreach ($listePromotions as $unePromotion) {
    $listeEtudiants = array_merge($listeEtudiants, $unePromotion->getMesEtudiants());
}

$nbRangeesEspacement = 0;
$nbPlacesEspacement = 1;

$indiceColDepart = 0;
$indiceLigneDepart = 0;

$sens = "versLaDroite";


$nbEtudiantsPlaces = 0;
$tousTTplaces = false;

$tailleTableauLigne = $planSalle->getNbRangees();
$tailleTableauColonne = $planSalle->getNbColonnes();

// Variables finales
$nbEtudiantsPlacesFinal = 0;
$placementEtudiantsFinal = array();
$tousTTplacesFinal = false;


// Appel de la fonction

// (Sens vers la droite)
for($indiceLigneDepart = 0; $indiceLigneDepart < $tailleTableauLigne; $indiceLigneDepart++){
    for($indiceColDepart = 0; $indiceColDepart < $tailleTableauColonne; $indiceColDepart++){
        $listeEtudiantsCopie = $listeEtudiants;

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
                if($nbEtudiantsPlaces >= $nbEtudiantsPlacesFinal){
                    $placementEtudiantsFinal = $placementEtudiants;
                    $nbEtudiantsPlacesFinal = $nbEtudiantsPlaces;
                    $indiceColDepartFinal = $indiceColDepart;
                    $indiceLigneDepartFinal = $indiceLigneDepart;
                    $sensFinal = $sens;
                    $tousTTplacesFinal = $tousTTplaces;
                }
            }
        }
        else{
            if($nbEtudiantsPlaces >= $nbEtudiantsPlacesFinal || $tousTTplaces){
                $placementEtudiantsFinal = $placementEtudiants;
                $nbEtudiantsPlacesFinal = $nbEtudiantsPlaces;
                $indiceColDepartFinal = $indiceColDepart;
                $indiceLigneDepartFinal = $indiceLigneDepart;
                $sensFinal = $sens;
                $tousTTplacesFinal = $tousTTplaces;
            }
        }
    }
}





// Affichage du résultat

if($tousTTplacesFinal){
    $ttPlaces = "oui";
}
else{
    $ttPlaces = "non";
}


// Nom du contrôle
echo "Contrôle : " . $unControle->getNomLong() . "<br>";
echo "Salle : " . $uneSalle->getNom() . "<br>";
echo "Nombre de rangées d'espacement : $nbRangeesEspacement <br>";
echo "Nombre de places d'espacement : $nbPlacesEspacement <br>";
echo "<br>";

// Info partie étudiant
echo "Nombre d'étudiants : " . count($listeEtudiants) . "<br>";
echo "Nombre d'étudiants TT Sans Ordi: " . count(recupererIndiceEtudiantsTT($listeEtudiants)) . "<br>";
echo "Nombre d'étudiants TT Ordi : " . count(recupererIndiceEtudiantsTT($listeEtudiants, true)) . "<br>";
echo "<br>";

echo "La stratégie choisie est : $sensFinal <br>";
echo "Nombre d'étudiants placés : $nbEtudiantsPlacesFinal <br>";
echo "Tous les étudiants TT ont été placés dans la salle : $ttPlaces <br>";
echo "Indice colonne de départ : $indiceColDepartFinal <br>";
echo "Indice ligne de départ : $indiceLigneDepartFinal <br>";
echo "<br>";

afficherTableau($placementEtudiantsFinal);

// Table bootstrap




function afficherTableau($placementEtudiantsFinal){
echo "<div class='container'>";
echo "<table class='table table-bordered'>";
foreach($placementEtudiantsFinal as $uneLigne){
    echo "<tr>";
    foreach($uneLigne as $uneZoneOuEtudiant){
        // Centrer le texte
        echo "<td class='text-center'";
        if($uneZoneOuEtudiant instanceof Etudiant){
            // Vérifier si l'étudiant dispose d'un tiers temps
            if($uneZoneOuEtudiant->getEstTT()){
                // Vérifier si l'étudiant dispose d'un tiers temps ordinateur
                if($uneZoneOuEtudiant->getAOrdi()){
                    // Couleur de fond en rouge
                    echo " style='background-color: #FF0000;'>";

                    // Afficher le nom de l'étudiant
                    echo $uneZoneOuEtudiant->getNom();
                }
                else{
                    // Couleur de fond en vert
                    echo " style='background-color: #00FF00;'>";

                    // Afficher le nom de l'étudiant
                    echo $uneZoneOuEtudiant->getNom();
                }
            }
            else{
                // Couleur de fond en bleu
                echo " style='background-color: #00BFFF;'>";
                echo $uneZoneOuEtudiant->getNom();
            }
        }
        else{
            
            if($uneZoneOuEtudiant->getType() == "place"){
                // gris
                echo " style='background-color: #808080;'>";
                echo $uneZoneOuEtudiant->getNumero();
            }
            else{
                echo " style='background-color: #FFFFFF;'>";
                echo "X";
            }
        }
        echo "</td>";
    }
    echo "</tr>";
}
echo "</table>";
echo "</div>";
}