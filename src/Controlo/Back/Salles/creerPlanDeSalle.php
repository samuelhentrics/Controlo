<?php
$nomSalle = $_POST['nomSalle'];
$salleVoisine = $_POST['salleVoisine'];
$nbrLigne = $_POST['nbrLigne'];
$nbrColonne = $_POST['nbrColonne'];
?>
<table border="1">
  <?php for ($i = 0; $i < $nbrLigne; $i++) { ?>
    <tr>
      <?php for ($j = 0; $j < $nbrColonne; $j++) { ?>
        <td><input type="text" name="<?php echo $i . '-' . $j; ?>"></td>
      <?php } ?>
    </tr>
  <?php } ?>
</table>




