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
function placerEtudiants(&$listeEtudiants, &$unControle, &$erreur)
{
  // Récupérer la liste des Salles du Controle
  $listeSalles = $unControle->getMesSalles();

  // Récupérer la liste des PlansDePlacement du Controle
  $listePDP = $unControle->getMesPlansDePlacement();

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

    // Parcourir chaque étudiant pour leur trouver une place
    foreach ($listeEtudiants as $unEtudiant) {
      $trouve = false;

      // Initialiser le numéro de ligne
      $numeroLigne = $nbRangeesSeparant;

      // Trouver une place pour l'étudiant
      foreach ($planSalleLibre->getMesZones() as $uneLigne) {

        // Vérifier qu'on est sur une ligne acceptable
        if ($numeroLigne % ($nbRangeesSeparant + 1) == 0) {

          // Initialiser un numero de colonne
          $numeroColonne = $nbPlacesSeparant;

          // Parcourir chaque place de la ligne
          foreach ($uneLigne as $unePlace) {

            // Vérifier qu'on est sur une colonne acceptable
            if ($numeroColonne % ($nbPlacesSeparant + 1) == 0) {

              // Vérifier que la place n'est pas prise
              if (!$unPDP->existePlace($unePlace)) {

                // Vérifier que la place a une prise si l'on dispose d'un ordinateur
                if ($unEtudiant->getAOrdi()) {
                  if ($unePlace->getInfoPrise()) {
                    $trouve = true;
                  }
                }

                // Cas où l'Etudiant n'a pas besoin d'une prise
                else {
                  $trouve = true;
                }
              }


              // Véfifier que la place n'est pas prise
              if ($trouve) {
                // Si la place est disponible, l'attribuer à l'étudiant
                $placement = new UnPlacement();
                $placement->setMonEtudiant($unEtudiant);
                $placement->setMaZone($unePlace);
                $unPDP->ajouterPlacement($placement);

                unset($listeEtudiants[array_search($unEtudiant, $listeEtudiants)]);


                // afficher i puis le nom de l'étudiant puis a été ajouté à la salle
                break;
              }


            }

            // Incrémenter le numéro de colonne
            $numeroColonne++;



          }



        }

        // Incrémenter le numéro de ligne
        $numeroLigne++;

        if ($trouve) {
          break;
        }
      }

      // Quitter la boucle si une place n'a pas été trouvée sinon continuer
      if ($trouve) {
        $unControle->ajouterPlanDePlacement($unPDP);
      } else {
        $erreur = true;
        break;
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
  placerEtudiants($listeOrdi, $unControle, $erreur);

  // Sortir en cas d'erreur
  if ($erreur) {
    break;
  }

  // Placement des étudiants tiers-temps sans ordinateur
  placerEtudiants($listeTTSansOrdi, $unControle, $erreur);

  // Sortir en cas d'erreur
  if ($erreur) {
    break;
  }

  // Placement des étudiants sans ordinateur ni tiers-temps
  placerEtudiants($listeEtud, $unControle, $erreur);

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

?>
<html>page resultat

</html>