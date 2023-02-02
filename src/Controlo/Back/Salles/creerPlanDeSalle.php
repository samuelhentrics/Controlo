<?php
$nomSalle = $_POST['NomSalle'];
$nbrLigne = $_POST['nbrLigne'];
$nbrColonne = $_POST['nbrColonne'];

$data = array();
for ($i = 0; $i < $nbrLigne; $i++) {
    $row = array();
    for ($j = 0; $j < $nbrColonne; $j++) {
        $row[] = "Cell ($i, $j)";
    }
    $data[] = $row;
}

$fileName = $nomSalle."csv";
$file = fopen($fileName, "w");

foreach ($data as $row) {
    fputcsv($file, $row);
}

fclose($file);
?>
