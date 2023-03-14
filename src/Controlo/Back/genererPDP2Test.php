<?php 
include_once(IMPORT_PATH . "genererPDPAligne.php");


// Préparation des données


$unControle = recupererUnControle(1);

$listeSalles = $unControle->getMesSalles();
$listePromotions = $unControle->getMesPromotions();

// Créer les PDP
foreach ($listeSalles as $nom => $uneSalle) {
    // Récupération des contraintes d'espacement
    $nbPlaceSeparant = 1;
    $nbRangeeSeparant = 0;
    // Gestion des erreurs

    // String en int
    // $nbPlaceSeparant = (int) $nbPlaceSeparant;
    // $nbRangeeSeparant = (int) $nbRangeeSeparant;
    
    // Vérifier qu'il s'agit d'entiers
    // if (!is_int($nbPlaceSeparant) || !is_int($nbRangeeSeparant)) {
    //   throw new Exception("Erreur : Les espacements doivent être des entiers");
    // }

    // // Vérification que les espacements sont positifs
    // if ($nbPlaceSeparant < 0 || $nbRangeeSeparant < 0) {
    //   throw new Exception("Erreur : Les espacements doivent être positifs");
    // }

    // Affichage sur une page ?
    // if (isset($_POST["affichageMemePage-" . $nom]))
    //     $affichageMemePage = true;
    //   else
    //     $affichageMemePage = false;


    // Création des contraintes d'espacement
    $contraintesGenerales = new ContraintesGenerales("aléatoire", "td");
    $contraintesSalle = new ContraintesEspacement($nbRangeeSeparant, $nbPlaceSeparant);
    $affichageMemePage = true;

    // Création du plan de placement
    $unPDP = new PlanDePlacement($contraintesGenerales, $contraintesSalle, $uneSalle, $affichageMemePage);

    // Ajout du plan de placement au contrôle
    $unControle->ajouterPlanDePlacement($unPDP);

  }

// // $uneSalle = creerUneSalle("S129");
// // $uneSalle = creerRelationSallePlan($uneSalle);

// $planSalle = $uneSalle->getMonPlan();

$listeEtudiants = array();
foreach ($listePromotions as $unePromotion) {
    $listeEtudiants = array_merge($listeEtudiants, $unePromotion->getMesEtudiants());
}


// Appel de la fonction

// (Sens vers la droite)
// foreach($tabSens as $sens){
//     for($indiceLigneDepart = 0; $indiceLigneDepart < $tailleTableauLigne; $indiceLigneDepart++){
//         for($indiceColDepart = 0; $indiceColDepart < $tailleTableauColonne; $indiceColDepart++){
//             $listeEtudiantsCopie = $listeEtudiants;

//             remplirSalle(
//                 $planSalle,
//                 $listeEtudiantsCopie,
//                 $nbRangeesEspacement,
//                 $nbPlacesEspacement,
//                 $indiceColDepart,
//                 $indiceLigneDepart,
//                 $sens,
//                 $placementEtudiants,
//                 $nbEtudiantsPlaces,
//                 $tousTTplaces
//             );

//             // Comparer le nombre d'étudiants placés
//             if($tousTTplacesFinal){
//                 if($tousTTplaces){
//                     if($nbEtudiantsPlaces >= $nbEtudiantsPlacesFinal){
//                         $placementEtudiantsFinal = $placementEtudiants;
//                         $nbEtudiantsPlacesFinal = $nbEtudiantsPlaces;
//                         $indiceColDepartFinal = $indiceColDepart;
//                         $indiceLigneDepartFinal = $indiceLigneDepart;
//                         $sensFinal = $sens;
//                         $tousTTplacesFinal = $tousTTplaces;
//                     }
//                 }
//             }
//             else{
//                 if($nbEtudiantsPlaces >= $nbEtudiantsPlacesFinal || $tousTTplaces){
//                     $placementEtudiantsFinal = $placementEtudiants;
//                     $nbEtudiantsPlacesFinal = $nbEtudiantsPlaces;
//                     $indiceColDepartFinal = $indiceColDepart;
//                     $indiceLigneDepartFinal = $indiceLigneDepart;
//                     $sensFinal = $sens;
//                     $tousTTplacesFinal = $tousTTplaces;
//                 }
//             }
//         }
//     }
// }
// $placementEtudiants = $placementEtudiantsFinal;
// $nbEtudiantsPlaces = $nbEtudiantsPlacesFinal;
// $indiceColDepart = $indiceColDepartFinal;
// $indiceLigneDepart = $indiceLigneDepartFinal;
// $sens = $sensFinal;
// $tousTTplaces = $tousTTplacesFinal;






// // Affichage du résultat

// if($tousTTplaces){
//     $ttPlaces = "oui";
// }
// else{
//     $ttPlaces = "non";
// }

// echo "<div class='container'>";
// // Nom du contrôle
// echo "Contrôle : " . $unControle->getNomLong() . "<br>";
// echo "Salle : " . $uneSalle->getNom() . "<br>";
// echo "Nombre de rangées d'espacement : $nbRangeesEspacement <br>";
// echo "Nombre de places d'espacement : $nbPlacesEspacement <br>";
// echo "<br>";

// // Info partie étudiant
// echo "Nombre d'étudiants : " . count($listeEtudiants) . "<br>";
// echo "Nombre d'étudiants TT Sans Ordi: " . count(recupererIndiceEtudiantsTT($listeEtudiants)) . "<br>";
// echo "Nombre d'étudiants TT Ordi : " . count(recupererIndiceEtudiantsTT($listeEtudiants, true)) . "<br>";
// echo "<br>";

// echo "La stratégie choisie est : $sens <br>";
// echo "Nombre d'étudiants placés : $nbEtudiantsPlaces <br>";
// echo "Tous les étudiants TT ont été placés dans la salle : $ttPlaces <br>";
// echo "Indice colonne de départ : $indiceColDepart <br>";
// echo "Indice ligne de départ : $indiceLigneDepart <br>";
// echo "<br>";

//afficherTableau($placementEtudiants);


placementAligne($unControle);
afficherPDPs($unControle);

echo "</div>";

// Table bootstrap

function afficherPDPs($unControle){

    foreach($unControle->getMesPlansDePlacement() as $unPDP){
        echo "Nom de la salle : " . $unPDP->getMaSalle()->getNom() . "<br>";

        echo "<table class='table table-bordered'>";
        echo "<tr>";
        echo "<th class='text-center'>Nom</th>";
        echo "<th class='text-center'>Prénom</th>";
        echo "<th class='text-center'>Promotion</th>";
        echo "<th class='text-center'>Numéro de place</th>";
        echo "</tr>";
        $lesPlacements = $unPDP->getMesPlacements();
        foreach($lesPlacements as $uneLigne){
            foreach($uneLigne as $unPlacement){
                $unEtudiant = $unPlacement->getMonEtudiant();
                echo "<tr>";
                echo "<td class='text-center'>" . $unEtudiant->getNom() . "</td>";
                echo "<td class='text-center'>" . $unEtudiant->getPrenom() . "</td>";
                echo "<td class='text-center'>" . "" . "</td>";
                echo "<td class='text-center'>" . $unPlacement->getMaZone()->getNumero() . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
    }

}


function afficherTableau($placementEtudiants){
echo "<table class='table table-bordered'>";
foreach($placementEtudiants as $uneLigne){
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
}