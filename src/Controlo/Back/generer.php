<?php print('<form action="'.BACK_PATH.'resultat.php" method="post">'); ?>

<?php 
include(FONCTION_CREER_LISTE_CONTROLES_PATH);

$numControle = $_GET["numControle"];
$leControle = recupererUnControle($numControle);
// print_r($leControle);
// print_r("<h1>".$leControle->getNomLong()."</h1>");


faireContrainteSalles($leControle);
function faireContrainteSalles($leControle){
    print("<h2>Placer automatiquement</h2>");
    print('<table class="table table-striped table-bordered" style="width: 35%">');
    print("<tr>
        <th>Salles</th>
        <th>Nombre de place séparent les étudiants</th>
        <th>Nombre de rangées séparent les étudiants</th>
    </tr>");
    foreach ($leControle->getMesSalles() as $key => $uneSalle) {
        print("<tr>");
        print("<td>".$uneSalle->getNom()."</td>");
        print("<td> <input type='number' name='nbPlaceSeparant' min='0' max='999' id='nbPlaceSeparant-".$uneSalle->getNom()."' value='0'></td>");
        print("<td> <input type='number' name='nbRangeSeparant' min='0' max='999' id='nbRangeSeparant-".$uneSalle->getNom()."' value='0'></td>");
        print("</tr>");
    }
    print("</table>");

}

?>
<table>
    <tr>
        <th>Contraintes générales</th>
        <!-- <th>Nombre de place séparent les étudiants</th> -->
    </tr>
    <td>Etudiant separer par TD/TP différent</td>
    <td>
        <select name="typeSeparation" id="">
            <option value="TD">TD</option>
            <option value="TP">TP</option>
        </select>
     </td>
    <tr>  
    <td>Etudiants placés par</td>
    <td>
        <select name="typePlacement" id="">
            <option value="aléatoire">aléatoire</option>
            <option value="ascendant">ascendant</option>
            <option value="descendant">descendant</option>
    </td>
</tr>
</table>
<button type="submit">Valider</button>
</form>