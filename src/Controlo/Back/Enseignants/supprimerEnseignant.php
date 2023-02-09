<?php
include_once(FONCTION_CRUD_ENSEIGNANTS_PATH);
include_once(CLASS_PATH . CLASS_ENSEIGNANT_FILE_NAME);
?>

<?php

echo '
        <h2>
            <form action="'.PAGE_ENSEIGNANTS_PATH.'" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
            </form>
            Supprimer un enseignant
        </h2><br>';
        

if (isset($_POST["idEnseignant"])) {
    $idEnseignant = $_POST["idEnseignant"];
    try {
        supprimerEnseignant($idEnseignant);
        // Affichage d'un message de succès
        print("
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Succès !</strong>
                        <p>L'enseignant a bien été supprimé.</p>
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
    echo "Erreur : l'enseignant n'a pas été supprimé.<br>";
    echo "L'identifiant de l'enseignant n'a pas été transmis.<br>";
    echo "Si le problème persiste, veuillez contacter l'administrateur du site.<br>";
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo '</div>';
}


?>