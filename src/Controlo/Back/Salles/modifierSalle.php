<div class="container">
  <h2>Modifier Plan de Salle 
    <?php print($_POST["nomSalle"]); ?>
  </h2>
  <?php
  include_once(CLASS_PATH . CLASS_SALLE_FILE_NAME);
  include_once(FONCTION_CRUD_SALLES_PATH);
  include_once(FONCTION_CREER_LISTE_SALLES_PATH);
  // Récupérer les données saisies dans le formulaire précédent
  $nomSalle = $_POST["nomSalle"];
  //Traitement
  if (isset($_POST["cell-0-0"])) {
    $uneSalle = creerListeSalles()[$nomSalle]; // Création de la salle
    $unPlan = $uneSalle->getMonPlan(); // Créer un plan de salle

    for ($indiceLigne = 0; $indiceLigne < $nbrLigne; $indiceLigne++) {
      for ($indiceColonne = 0; $indiceColonne < $nbrColonne; $indiceColonne++) {
        $uneZone = new Zone(); // Créer une zone
        $infoZone = $_POST["cell-" . $indiceLigne . "-" . $indiceColonne]; // Récupérer la donnée saisi dans le formulaire
        // Informer de la position de cette zone
        $uneZone->setNumLigne($indiceLigne);
        $uneZone->setNumCol($indiceColonne);
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
                $uneZone->setType("vide");
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

    try {
      modifierSalle($uneSalle);

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
    $uneSalle = creerListeSalles()[$nomSalle];
    $unPlan = $uneSalle->getMonPlan();
    $mesZones = $unPlan->getMesZones();
    echo "<input id='nomSalle' name='nomSalle' class='form-salle' type='hidden' value='$nomSalle'>";
    ?>
    <table class="table table-striped table-bordered">
      <?php for ($i = 0; $i < count($mesZones); $i++) { ?>
        <tr>
          <?php
          for ($j = 0; $j < count($mesZones[$i]); $j++) {
            $uneZone = $mesZones[$i][$j];
            switch($uneZone->getType()){
                case "tableau":
                    $infoZone = "T";
                    break;
                case "place":
                    $infoZone = $uneZone->getNumero();	
                    if($uneZone->getInfoPrise()){
                        $infoZone .= "E";
                    }
                    
                    break;
                default:
                    $infoZone = "";
                    break;
                
            }
            
            ?>

            <td class="text-center">
                <input type="text" style="width:50px;" name="<?php echo 'cell-' . $i . '-' . $j; ?>"
                        value="<?php echo $infoZone;?>">
            </td>
          <?php } ?>
        </tr>
      <?php } ?>
    </table>
    <h6>Légende : </h6>
    <p>T : Tableau <br>E : Place avec prise<br></p>

    <input type="submit" class="btn btn-primary" value="Modifier"></button>
  </form>
</div>