<?php
include_once(FONCTION_CRUD_ETUDIANTS_PATH);
include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);
?>

<?php
if (isset($_POST["idEtudiant"]) && isset($_POST["nomPromotion"])) {
    $etudiantId = $_POST["idEtudiant"];
    $nomPromotion = $_POST["nomPromotion"];
    supprimerEtudiant($etudiantId, $nomPromotion);
}


?>