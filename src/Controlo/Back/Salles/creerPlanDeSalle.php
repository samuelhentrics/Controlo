<h1>Plan de la salle <?php print($_POST["nomSalle"]); ?></h1>
<?php 
  if(isset($_POST["cell-0-0"])){
    $uneSalle= new Salle($_POST["nomSalle"]); // Création de la salle
    if($_POST["salleVoisine"] != null){
      $salleVoisine = recupererUneSalle()[$_POST["salleVoisine"]];
      $_POST["nomSalle"]->setMonvoisin($_POST["salleVoisine"]);
    }
    
    $plan=new Plan();
    for ($indiceLigne = 0; $indiceLigne < $_POST['nbrLigne']; $indiceLigne++){
      for ($indiceColonne = 0; $indiceColonne < $_POST['nbrColonne']; $indiceColonne++){
        $uneZone=new Zone();
        $infoZone=$_POST["cell-".$indiceLigne."-".$indiceColonne];
        $uneZone->setNumLigne($indiceLigne);
        $uneZone->setNumColonne($indiceColonne);
        $infoZone = strtolower($infoZone);
        
        array_push($uneLigne,$uneZone);
      }
    }
  }
  
?>
<form action=<?php echo PAGE_AJOUTER2_SALLE_PATH;?> method="post">
  <table border="1">
    <?php for ($i = 0; $i < $_POST['nbrLigne']; $i++) { ?>
      <tr>
        <?php for ($j = 0; $j < $_POST['nbrColonne']; $j++) { ?>
          <td><input type="text" name="<?php echo 'cell-' . $i . '-' . $j; ?>"></td>
        <?php } ?>
      </tr>
    <?php } ?>
  </table>
  <h6>Légende : </h6>
  <p>T : Tableau    E : Place avec prise<br></p>
  <input type="submit" value="Créer">
</form>