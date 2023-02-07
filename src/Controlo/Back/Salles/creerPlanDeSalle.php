<h1>Plan de la salle <?php print($_POST["nomSalle"]); ?></h1>
<?php 
  // Récupérer les données saisies dans le formulaire précédent
  $nomSalle=$_POST["nomSalle"];
  $salleVoisine=$_POST["salleVoisine"];
  $nbrLigne=$_POST["nbrLigne"];
  $nbrColonne=$_POST["nbrColonne"];
  //Traitement
  if(isset($_POST["cell-0-0"])){
    $uneSalle= new Salle($nomSalle); // Création de la salle
    if($salleVoisine != null){ // Lier la salle avec sa salle voisine 
      $salleVoisine = recupererUneSalle()[$salleVoisine];
      $nomSalle->setMonvoisin($salleVoisine);
    }
    
    $plan=new Plan(); // Créer un plan de salle
    for ($indiceLigne = 0; $indiceLigne < $nbrLigne; $indiceLigne++){
      for ($indiceColonne = 0; $indiceColonne < $nbrColonne; $indiceColonne++){
        $uneZone=new Zone(); // Créer une zone
        $infoZone=$_POST["cell-".$indiceLigne."-".$indiceColonne]; // Récupérer la donnée saisi dans le formulaire
        $uneZone->setNumLigne($indiceLigne);
        $uneZone->setNumColonne($indiceColonne);
        $infoZone = strtolower($infoZone);
        array_push($uneLigne,$uneZone); // Remplir la donnée dans la zone 
        
      }
    }
  }
  
?>
<form action=<?php echo PAGE_AJOUTER2_SALLE_PATH;?> method="post">
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
  <p>T : Tableau    E : Place avec prise<br></p>
  <input type="submit" value="Créer">
</form>