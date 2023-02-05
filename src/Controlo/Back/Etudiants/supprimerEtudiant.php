<?php
include_once(FONCTION_CRUD_ETUDIANTS_PATH);
include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);
?>

<?php
if (isset($_POST["idEtudiant"]) && isset($_POST["nomPromotion"])) {
    $etudiantId = $_POST["idEtudiant"];
    $nomPromotion = $_POST["nomPromotion"];
    try {
        supprimerEtudiant($etudiantId, $nomPromotion);
        // Affichage d'un message de succès
        print("
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Succès !</strong>
                        <p>L'étudiant a bien été supprimé.</p>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
        ");
        
    }
    catch (Exception $e){
        // Message d'erreur
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo $e->getMessage();
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        echo '</div>';

    }
}
else{
    // Message d'erreur
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo "Erreur : l'étudiant n'a pas été supprimé.<br>";
    echo "L'identifiant de l'étudiant ou le nom de la promotion n'a pas été transmis.<br>";
    echo "Si le problème persiste, veuillez contacter l'administrateur du site.<br>";
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo '</div>';
}


?>