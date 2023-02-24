<?php
/**
 * @file generer.php
 * @brief Affiche le résultat du placement des étudiants dans les salles du contrôle
 * @version 1.0
 * @date 2020-04-20
 * @author Samuel HENTRICS LOISTINE, Benjamin PEYRE
 */



/* ----------------------------------------------------------------
----------------------------------------------------------------
-------------------------- Inclusions --------------------------
----------------------------------------------------------------
----------------------------------------------------------------*/

include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
include_once(CLASS_PATH . CLASS_CONTRAINTES_ESPACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_CONTRAINTES_GENERALES_FILE_NAME);
include_once(CLASS_PATH . CLASS_PLAN_PLACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_UN_PLACEMENT_FILE_NAME);
include_once(IMPORT_PATH . "genererPDF.php");


/**
 * Retourne une liste d'étudiants sans les étudiants démissionnaire
 * @param array $listeEtudiants Liste d'étudiants
 * @return array Liste d'étudiants sans les étudiants démissionnaire
 */
function supprimerDemissionnaire($listeEtudiants){
  foreach ($listeEtudiants as $key => $etudiant) {
    if($etudiant->getEstDemissionnaire() == true){
      unset($listeEtudiants[$key]);
    }
  }
  $listeEtudiants = array_values($listeEtudiants);
  return $listeEtudiants;
}

/**
 * @brief Trie les listes d'étudiants
 * @param array $liste Liste d'étudiants
 * @param string $algo Algorithme de tri
 * @return array
 */
function trieListe($liste, $algo)
{
  switch ($algo) {
    case 'de façon aléatoire':
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

  // Récupérer les noms de salles
  $nomsSalles = array_keys($listeSalles);
  $indiceSalle = 0;
  $indiceSalleMax = count($nomsSalles);

  // Trouver une place dans une des salles pour le premier étudiant
  while (true) {
    // Vérifier si on a parcouru toutes les salles
    if ($indiceSalle == $indiceSalleMax) {
      $erreur = true;
      break;
    }

    // Récupérer la salle
    $nom = $nomsSalles[$indiceSalle];
    $uneSalle = $listeSalles[$nom];

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

    // Préparation info étudiant
    $listeNumEtudiant = array_keys($listeEtudiants);
    $indiceEtudiant = 0;
    $indiceMaxEtudiant = count($listeEtudiants);

    // Parcourir chaque étudiant pour leur trouver une place
    while (true) {
      // Sortir de la boucle si l'indice de l'étudiant est plus grand que le nombre d'étudiants
      if ($indiceEtudiant == $indiceMaxEtudiant) {
        break;
      }

      $trouve = false;

      // Récupérer l'étudiant
      $numEtudiant = $listeNumEtudiant[$indiceEtudiant];
      $unEtudiant = $listeEtudiants[$numEtudiant];

      // Initialiser le numéro de ligne
      $numeroLigne = $nbRangeesSeparant;

      // Trouver une place pour l'étudiant
      $lesZones = $planSalleLibre->getMesZones();

      $listeNumLigne = array_keys($lesZones);
      $indiceNumLigne = 0;
      $indiceNumLigneMax = count($listeNumLigne);

      while (true) {
        // Sortir si ligne max
        if ($indiceNumLigne == $indiceNumLigneMax) {
          break;
        }

        // Récupérer le numéro de ligne
        $numeroLigne = $listeNumLigne[$indiceNumLigne];
        $uneLigne = $lesZones[$numeroLigne];

        // Vérifier qu'on est sur une ligne acceptable

        if ($indiceNumLigne % ($nbRangeesSeparant+1) == 0) {

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


        if ($trouve) {
          break;
        }

        $indiceNumLigne++;
      }

      // Quitter la boucle si une place n'a pas été trouvée sinon continuer
      if ($trouve) {
        $unControle->ajouterPlanDePlacement($unPDP);
      }
      else {
        $erreur = true;
        break;
      }

      // Incrémenter l'indice de l'étudiant
      $indiceEtudiant++;

    }


    // Quitter la boucle si la liste des étudiants est vide
    if (empty($listeEtudiants)) {
      $erreur = false;
      break;
    }

    // Incrémenter l'indice de salle
    $indiceSalle++;
  }
}


try {

    /* ----------------------------------------------------------------
    ----------------------------------------------------------------
    ------------------------ Initialisation ------------------------
    ----------------------------------------------------------------
    ----------------------------------------------------------------*/

    // Récupérer le contrôle

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
      $nbPlaceSeparant = $_POST["nbPlacesSeparant-" . $nom];
      $nbRangeeSeparant = $_POST["nbRangeesSeparant-" . $nom];
      // Gestion des erreurs

      // String en int
      $nbPlaceSeparant = (int) $nbPlaceSeparant;
      $nbRangeeSeparant = (int) $nbRangeeSeparant;
      
      // Vérifier qu'il s'agit d'entiers
      if (!is_int($nbPlaceSeparant) || !is_int($nbRangeeSeparant)) {
        throw new Exception("Erreur : Les espacements doivent être des entiers");
      }

      // Vérification que les espacements sont positifs
      if ($nbPlaceSeparant < 0 || $nbRangeeSeparant < 0) {
        throw new Exception("Erreur : Les espacements doivent être positifs");
      }

      // Affichage sur une page ?
      if (isset($_POST["affichageMemePage-" . $nom]))
          $affichageMemePage = true;
        else
          $affichageMemePage = false;


      // Création des contraintes d'espacement
      $contraintesSalle = new ContraintesEspacement($nbRangeeSeparant, $nbPlaceSeparant);

      // Création du plan de placement
      $unPDP = new PlanDePlacement($contraintesGenerales, $contraintesSalle, $uneSalle, $affichageMemePage);

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
    foreach ($listePromos as $unePromo) {
      // Récupération des étudiants de la promotion et ajout dans les listes d'étudiants correspondantes
      $listeTTSansOrdi = array_merge($listeTTSansOrdi, $unePromo->recupererListeEtudiantsTTSansOrdi());

      $listeOrdi = array_merge($listeOrdi, $unePromo->recupererListeEtudiantsOrdi());
      $listeEtud = array_merge($listeEtud, $unePromo->recupererListeEtudiantsNonTT());

    }

    // -- Supprimer les étudiants démissionnaires des listes
    $listeTTSansOrdi = supprimerDemissionnaire($listeTTSansOrdi);
    $listeOrdi = supprimerDemissionnaire($listeOrdi);
    $listeEtud = supprimerDemissionnaire($listeEtud);

    // -- Trie les listes d'étudiants
    $listeTTSansOrdi = trieListe($listeTTSansOrdi, $contraintesGenerales->getAlgoRemplissage());
    $listeOrdi = trieListe($listeOrdi, $contraintesGenerales->getAlgoRemplissage());
    $listeEtud = trieListe($listeEtud, $contraintesGenerales->getAlgoRemplissage());

    // -- Création d'un indicateur d'erreur
    $erreur = false;

    /* ----------------------------------------------------------------
    ----------------------------------------------------------------
    -------------------- Placement des étudiants -------------------
    ----------------------------------------------------------------
    ----------------------------------------------------------------*/

    // Placement des étudiants avec ordinateur
    if (!empty($listeOrdi)) {
      placerEtudiants($listeOrdi, $unControle, $erreur);
    }

    if($erreur){
      throw new Exception("Erreur lors du placement des étudiants avec ordinateur");
    }

      // Placement des étudiants tiers-temps sans ordinateur
      if (!empty($listeTTSansOrdi)) {
        placerEtudiants($listeTTSansOrdi, $unControle, $erreur);
      }
    
      if($erreur){
        throw new Exception("Erreur lors du placement des étudiants avec ordinateur");
      }

      // Placement des étudiants sans ordinateur ni tiers-temps
      if (!empty($listeEtud)) {
        placerEtudiants($listeEtud, $unControle, $erreur);
      }
    
      if($erreur){
        throw new Exception("Erreur lors du placement des étudiants sans ordinateur ni tiers-temps");
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
    }
  }
  catch (Exception $e) {
    throw new Exception($e->getMessage());
  }


?>