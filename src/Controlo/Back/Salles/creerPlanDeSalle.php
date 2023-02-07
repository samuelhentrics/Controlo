<h1>Plan de la salle
  <?php print($_POST["nomSalle"]); ?>
</h1>
<?php
include_once(CLASS_PATH . CLASS_SALLE_FILE_NAME);
include_once(FONCTION_CRUD_SALLES_FILE_NAME);
// Récupérer les données saisies dans le formulaire précédent
$nomSalle = $_POST["nomSalle"];
$salleVoisine = $_POST["salleVoisine"];
$nbrLigne = $_POST["nbrLigne"];
$nbrColonne = $_POST["nbrColonne"];
//Traitement
if (isset($_POST["cell-0-0"])) {
  $uneSalle = new Salle($nomSalle); // Création de la salle
  if ($salleVoisine != null) { // Lier la salle avec sa salle voisine 
    $salleVoisine = recupererUneSalle()[$salleVoisine];
    $nomSalle->setMonvoisin($salleVoisine);
  }

  $plan = new Plan(); // Créer un plan de salle
  for ($indiceLigne = 0; $indiceLigne < $nbrLigne; $indiceLigne++) {
    for ($indiceColonne = 0; $indiceColonne < $nbrColonne; $indiceColonne++) {
      $uneZone = new Zone(); // Créer une zone
      $infoZone = $_POST["cell-" . $indiceLigne . "-" . $indiceColonne]; // Récupérer la donnée saisi dans le formulaire
      // Informer de la position de cette zone
      $uneZone->setNumLigne($indiceLigne);
      $uneZone->setNumColonne($indiceColonne);
      $infoZone = strtolower($infoZone);
      array_push($uneLigne, $uneZone); // Remplir la donnée dans la zone 
      // Déterminer le type de Zone qu'il s'agit
      switch ($infoZone) {
        case 'T':
          $uneZone->setType("tableau");
          break;
        case '':
          $uneZone->setType("vide");
          break;
        default:
          $uneZone->setType("place");
          break;
      }

      if ($uneZone->getType() == "place") {
        // Vérifier s'il s'agit d'une place avec prise
        if (substr($infoZone, -1) == "E") {
          $uneZone->setInfoPrise(true);
        }
        // On met le numéro de la place s'il s'agit d'une place
        $uneZone->setNumero($infoZone);
      }
      // Ajouter la Zone dans le Plan
      $unPlan->ajouterUneZone($uneZone);
    }
  }
  ajouterSalle($nomSalle);
}

?>
<form action="<?php echo PAGE_AJOUTER2_SALLE_PATH; ?>" method="post">
  <?php
  echo "<input id='nomSalle' name='nomSalle'  type='text' class='form-salle' type='hidden' value='echo $nomSalle;'>";
  echo "<input id='salleVoisine' name='salleVoisine'  type='text' class='form-salle' type='hidden' value=' echo $salleVoisine;'>";
  echo "<input id='nbrLigne' name='nbrLigne'  type='text' class='form-salle' type='hidden' value='echo $nbrLigne;'>";
  echo "<input id='nbrColonne' name='nbrColonne'  type='text' class='form-salle' type='hidden' value='echo $nbrColonne;'>";
  ?>
  <table border="1">
    <?php for ($i = 0; $i < $nbrLigne; $i++) { ?>
      <tr>
        <?php for ($j = 0; $j < $nbrColonne; $j++) { ?>
          <td><input type="text" name="<?php echo 'cell-' . $i . '-' . $j; ?>"></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </table>
  <h6>Légende : </h6>
  <p>T : Tableau E : Place avec prise<br></p>
  <input type="submit" value="Créer">
</form>