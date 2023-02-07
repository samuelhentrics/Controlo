<?php
include_once(FONCTION_CRUD_SALLES_PATH);
?>

<?php
if (isset($_POST["nomSalle"])) {
    $nomSalle = $_POST["nomSalle"];
    try {
        supprimerSalle($nomSalle);
        // Affichage d'un message de succès
        print("
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Succès !</strong>
                        <p>La salle a bien été supprimée.</p>
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
    echo "Erreur : la salle n'a pas été supprimée.<br>";
    echo "Le nom de la salle n'a pas été transmis.<br>";
    echo "Si le problème persiste, veuillez contacter l'administrateur du site.<br>";
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo '</div>';
}


?>