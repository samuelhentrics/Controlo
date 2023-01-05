<?php
include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
include_once(CLASS_PATH . CLASS_CONTRAINTES_ESPACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_CONTRAINTES_GENERALES_FILE_NAME);
include_once(CLASS_PATH . CLASS_PLAN_PLACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_UN_PLACEMENT_FILE_NAME);
include_once(IMPORT_PATH . "genererPDF.php");

?>

<?php

/**
 * @brief Trie les listes d'étudiants
 * @param array $liste Liste d'étudiants
 * @param string $algo Algorithme de tri
 * @return array
 */
function trieListes($liste, $algo)
{
  switch ($algo) {
    case 'aléatoire':
      // Mélange la liste d'étudiants
      shuffle($liste);
      break;
    case 'descendant':
      // Trie la liste d'étudiants par ordre alphabétique descendant
      usort($liste, function ($a, $b) {
        return strcmp($b->getNom(), $a->getNom());
      });
      break;
    default:
      // Trie la liste d'étudiants par ordre alphabétique ascendant
      usort($liste, function ($a, $b) {
        return strcmp($a->getNom(), $b->getNom());
      });
      break;
  }
  return $liste;
}

/**
 * @brief Place les étudiants dans les salles du contrôle
 * @param array $listeEtudiants Liste d'étudiants à placer
 * @param Controle $unControle Contrôle où l'on doit placer les étudiants
 * @param string $type Type d'élèves à placer
 * @param bool $erreur Erreur de placement
 * @return void
 */
function placerEtudiants(&$listeEtudiants, &$unControle, $type, &$erreur)
{
  // Récupérer la liste des Salles du Controle
  $listeSalles = $unControle->getMesSalles();

  // Récupérer la liste des PlansDePlacement du Controle
  $listePDP = $unControle->getMesPlansDePlacement();

  // Partir dans l'idée que l'on a pas trouvé de place pour l'étudiant
  $erreur = true;

  // Trouver une place dans une des salles pour le premier étudiant
  foreach ($listeSalles as $nom => $uneSalle) {
    // Récupération du plan de placement de la salle
    $unPDP = $listePDP[$nom];

    // Récupérer les contraintes d'espacement de la salle
    $contraintesSalle = $unPDP->getMaContrainteEspacement();

    // Récupérer le nombre de rangées d'espacement et le nombre de places d'espacement
    $nbRangeesSeparant = $contraintesSalle->getNbRangs();
    $nbPlacesSeparant = $contraintesSalle->getNbPlaces();

    // Récupérer le Plan de la Salle
    $planSalle = $uneSalle->getMonPlan();

    // Récupérer le Plan de la Salle avec uniquement les places libres
    $planSalleLibre = $planSalle->planAvecPlacesUniquement();
    echo '<pre>';
    print_r($planSalleLibre);
    echo '</pre>';


    // Trouver une place pour chaque étudiant
    foreach ($listeEtudiants as $unEtudiant) {
      
      foreach($planSalle as $uneRangee) {
        foreach($uneRangee as $unePlace) {
          if($planSalleLibre->existeUneZone) {
            $unePlace->setMonEtudiant($unEtudiant);
          }
        }
      }
      
    }


    

    // Quitter la boucle si la liste des étudiants est vide
    if (empty($listeEtudiants)) {
      $erreur = false;
      break;
    }
  }
}



/* ----------------------------------------------------------------
----------------------------------------------------------------
------------------------ Initialisation ------------------------
----------------------------------------------------------------
----------------------------------------------------------------*/

// -- Récupération du contrôle passé en paramètre
$unControle = recupererUnControle($_GET["id"]);

// -- Récupération des contraintes générales
$typePlacement = $_POST["typePlacement"];
$typeSeparation = $_POST["typeSeparation"];

// -- Création des contraintes générales
$contraintesGenerales = new ContraintesGenerales($typePlacement, $typeSeparation);

// -- Récupération des Salles du contrôle
$listeDeSalles = $unControle->getMesSalles();

// -- Création des plans de placement pour chaque salle
foreach ($listeDeSalles as $nom => $uneSalle) {
  // Récupération des contraintes d'espacement
  $nbPlaceSeparant = $_POST["nbPlaceSeparant-" . $nom];
  $nbRangeeSeparant = $_POST["nbRangeeSeparant-" . $nom];

  // Création des contraintes d'espacement
  $contraintesSalle = new ContraintesEspacement($nbRangeeSeparant, $nbPlaceSeparant);

  // Création du plan de placement
  $unPDP = new PlanDePlacement($contraintesGenerales, $contraintesSalle, $uneSalle);

  // Ajout du plan de placement au contrôle
  $unControle->ajouterPlanDePlacement($unPDP);

}

// -- Récupération des promotions du contrôle
$listePromos = $unControle->getMesPromotions();

// -- Création des listes d'étudiants
$listeTTSansOrdi = array();
$listeOrdi = array();
$listeEtud = array();

// -- Récupération des étudiants des promotions
foreach ($listePromos as $key => $unePromo) {
  // Récupération des étudiants de la promotion et ajout dans les listes d'étudiants correspondantes
  $listeTTSansOrdi = array_merge($listeTTSansOrdi, $unePromo->recupererListeEtudiantsTTSansOrdi());
  $listeOrdi = array_merge($listeOrdi, $unePromo->recupererListeEtudiantsOrdi());
  $listeEtud = array_merge($listeEtud, $unePromo->recupererListeEtudiantsNonTT());

}



// -- Trie les listes d'étudiants
$listeTTSansOrdi = trieListes($listeTTSansOrdi, $contraintesGenerales->getAlgoRemplissage());
$listeOrdi = trieListes($listeOrdi, $contraintesGenerales->getAlgoRemplissage());
$listeEtud = trieListes($listeEtud, $contraintesGenerales->getAlgoRemplissage());

// -- Création d'un indicateur d'erreur
$erreur = false;

/* ----------------------------------------------------------------
----------------------------------------------------------------
-------------------- Placement des étudiants -------------------
----------------------------------------------------------------
----------------------------------------------------------------*/

while (true) {
  // Cas où les listes sont vides on sort de la boucle
  if (empty($listeTTSansOrdi) && empty($listeOrdi) && empty($listeEtud)) {
    break;
  }

  // Placement des étudiants avec ordinateur


  // Sortir en cas d'erreur
  if ($erreur) {
    break;
  }

  // Placement des étudiants tiers-temps sans ordinateur
  placerEtudiants($listeTTSansOrdi, $unControle, "TTSansOrdi", $erreur);

  // Sortir en cas d'erreur
  if ($erreur) {
    break;
  }

  // Placement des étudiants sans ordinateur ni tiers-temps


  // Sortir en cas d'erreur
  if ($erreur) {
    break;
  }
  break;
}

/* ----------------------------------------------------------------
----------------------------------------------------------------
---------------- Génération des PDF si possible ----------------
----------------------------------------------------------------
----------------------------------------------------------------*/

// Tentative de génération des PDF
if (!$erreur) {
  // Génération des PDF
  genererPDF($unControle);
  print("Génération des PDF réussie<br><br>");
} else {
  // Affichage d'un message d'erreur
  print("Erreur lors du placement des étudiants<br><br>");
}



// ----------------------------------------------------------------
// ----------------------------------------------------------------
// Mode développement
// ----------------------------------------------------------------
// ----------------------------------------------------------------

$listeMesZones = $unControle->getMesSalles()["S124"]->getMonPlan()->getMesZones();
function nbPlaceDispo($listeMesZones)
{
  $returnArray = array();
  $totalPlace = 0;
  $totalPrise = 0;
  foreach ($listeMesZones as $uneZone) {
    foreach ($uneZone as $unePosition) {
      if ($unePosition->getType() === "place") {
        $totalPlace++;
      }
      if ($unePosition->getInfoPrise())
        $totalPrise = $totalPrise + 1;

    }
  }
  $returnArray["totalPrise"] = $totalPrise;
  $returnArray["totalPlace"] = $totalPlace;
  return $returnArray;
}

foreach ($unControle->getMesSalles() as $key => $uneSalle) {
  print($uneSalle->getNom() . " info: ");
  print_r(nbPlaceDispo($uneSalle->getMonPlan()->getMesZones()));
  print(" <br> ");
}
// var_dump($listeMesZones);

// print( . "<- nombre de place <br>");
//debut du placement
// print($uneSalle->getNom()." $unControle->getMesSalles()["S124"]->getMonPlan()->getMesZones() . "<br>");
foreach ($unControle->getMesSalles() as $nomSalle => $uneSalle) {
  for ($i = 1; $i < 21; $i++) {
    $unePlace = new Zone();
    $unePlace->setType("place");
    $unePlace->setNumero($i);

    $unEtudiant = new Etudiant("NOM" . $i, "PRENOM", 1, 2, "helloworld@gmail.com");

    $unPlacement = new UnPlacement();
    $unPlacement->setMonEtudiant($unEtudiant);
    $unPlacement->setMaZone($unePlace);

    $unPDP->ajouterPlacement($unPlacement);
    $unPDP->setMaSalle($uneSalle);
  }

  // echo "<h2>Génération des PDP en PDF</h2>";
  $unControle->ajouterPlanDePlacement($unPDP);
  // echo "ok";
}
// genererPDF($unControle);
//aaficher controle
// var_dump( $unControle);

print("contrle id: " . $_GET["id"] . "<br>")
  ?>
<html>page resultat

</html>