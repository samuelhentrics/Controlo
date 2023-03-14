<div class="container">
  <?php
  include_once(CLASS_PATH . CLASS_SALLE_FILE_NAME);
  include_once(FONCTION_CRUD_SALLES_PATH);
  include_once(FONCTION_CREER_LISTE_SALLES_PATH);

  echo '
  <h2>
      <form action="' . PAGE_AJOUTER_SALLE_PATH . '" method="post" style="display:inline;">
              <button type="submit" class="btn btn-primary">
                  <i class="fas fa-arrow-left"></i> Retour
              </button>
      </form>
      Création du plan de la salle
  </h2><br>';


  // Récupérer les données saisies dans le formulaire précédent
  $nomSalle = htmlspecialchars($_POST["nomSalle"]);
  $nomSalleVoisine = htmlspecialchars($_POST["salleVoisine"]);
  $nbrLigne = htmlspecialchars($_POST["nbrLigne"]);
  $nbrColonne = htmlspecialchars($_POST["nbrColonne"]);

  // Faire un array de 2 dimensions pour le plan de salle
  $planSalleWeb = array();
  for ($indiceLigne = 0; $indiceLigne < $nbrLigne; $indiceLigne++) {
    $planSalleWeb[$indiceLigne] = array();
    for ($indiceColonne = 0; $indiceColonne < $nbrColonne; $indiceColonne++) {
      $planSalleWeb[$indiceLigne][$indiceColonne] = "";
    }
  }


  //Traitement
  if (isset($_POST["cell-0-0"])) {

    try {
      // Completer $planSalleWeb
      for ($indiceLigne = 0; $indiceLigne < $nbrLigne; $indiceLigne++) {
        for ($indiceColonne = 0; $indiceColonne < $nbrColonne; $indiceColonne++) {
          $planSalleWeb[$indiceLigne][$indiceColonne] =htmlspecialchars($_POST["cell-" . $indiceLigne . "-" . $indiceColonne]);
        }
      }


      $uneSalle = new Salle($nomSalle); // Création de la salle
      if ($nomSalleVoisine != null) { // Lier la salle avec sa salle voisine 
        $salleVoisine = creerListeSalles()[$nomSalleVoisine];
        if ($salleVoisine != null) {
          $uneSalle->setMonVoisin($salleVoisine);
        }
      }

      $unPlan = new Plan(); // Créer un plan de salle
      for ($indiceLigne = 0; $indiceLigne < $nbrLigne; $indiceLigne++) {
        for ($indiceColonne = 0; $indiceColonne < $nbrColonne; $indiceColonne++) {
          $uneZone = new Zone(); // Créer une zone
          $infoZone = htmlspecialchars($_POST["cell-" . $indiceLigne . "-" . $indiceColonne]); // Récupérer la donnée saisi dans le formulaire
          // Informer de la position de cette zone
          $uneZone->setNumLigne($indiceLigne);
          $uneZone->setNumCol($indiceColonne);
          $infoZoneNonModif = $infoZone;
          $infoZone = strtolower($infoZone);
          // Déterminer le type de Zone qu'il s'agit
          switch ($infoZone) {
            case 't':
              $uneZone->setType("tableau");
              break;
            case '':
              $uneZone->setType("vide");
              break;
            default:
              // Vérifier qu'il s'agit d'un numéro de place
              if (!is_numeric($infoZone)) {
                // Récupérer infoZone jusqu'à l'avant dernier caractère
                if (is_numeric(substr($infoZone, 0, -1))) {
                  $uneZone->setType("place");
                } else {
                  throw new Exception("
                La zone " . $infoZoneNonModif . " n'est pas valide (ligne " . ($indiceLigne + 1) . ", colonne " . ($indiceColonne + 1) . ")");
                }

              } else {
                $uneZone->setType("place");
              }
              break;
          }

          if ($uneZone->getType() == "place") {
            // Vérifier s'il s'agit d'une place avec prise
            if (substr($infoZone, -1) == "e") {
              $uneZone->setInfoPrise(true);
            }
            // On met le numéro de la place s'il s'agit d'une place
            $uneZone->setNumero($infoZone);
          }
          // Ajouter la Zone dans le Plan
          $unPlan->ajouterUneZone($uneZone);
        }

        $uneSalle->setMonPlan($unPlan); // Ajouter le plan à la salle
      }

      if (!$unPlan->verifierPlacesUniques()) {
        throw new Exception("Un numéro de place est utilisé plusieurs fois");
      }

      ajouterSalle($uneSalle);

      // Message de succès
      echo "<div class='alert alert-success' role='alert'>La salle a été ajoutée avec succès</div>";
    } catch (Exception $e) {
      echo "<div class='alert alert-danger' role='alert'>
    Erreur lors de l'ajout de la salle<br>
    Message d'erreur : " . $e->getMessage() . "
    </div>";
    }
  }

  ?>
  <form action="<?php echo PAGE_AJOUTER2_SALLE_PATH; ?>" method="post">
    <?php
    echo "<input id='nomSalle' name='nomSalle' class='form-salle' type='hidden' value='$nomSalle'>";
    echo "<input id='salleVoisine' name='salleVoisine' class='form-salle' type='hidden' value='$nomSalleVoisine'>";
    echo "<input id='nbrLigne' name='nbrLigne' class='form-salle' type='hidden' value='$nbrLigne'>";
    echo "<input id='nbrColonne' name='nbrColonne' class='form-salle' type='hidden' value='$nbrColonne'>";
    ?>
    <table class="table table-striped table-bordered">
      <?php for ($i = 0; $i < $nbrLigne; $i++) { ?>
        <tr>
          <?php for ($j = 0; $j < $nbrColonne; $j++) { ?>
            <td class="text-center">
              <?php
              echo '<input style="width:50px;" type="text"
              name="cell-' . $i . '-' . $j . '"
              value="' . $planSalleWeb[$i][$j] . '"
              >';

              ?>
            </td>
          <?php } ?>
        </tr>
      <?php } ?>
    </table>
    <h6>Légende : </h6>
    <p>T : Tableau <br>E : Place avec prise<br></p>

    <input type="submit" class="btn btn-primary" value="Créer"></button>
  </form>
</div>