<?php
include_once(FONCTION_CRUD_CONTROLE_PATH);
?>

<?php

echo '
        <h2>
            <form action="'.PAGE_CONTROLES_PATH.'" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
            </form>
            Supprimer un contrôle
        </h2><br>';

if (isset($_POST["idControle"])) {
    
    $controleId = htmlspecialchars($_POST["idControle"]);
    try {
        supprimerControle($controleId);
        // Affichage d'un message de succès
        print("
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Succès !</strong>
                        <p>Le contrôle a bien été supprimé.</p>
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
    echo "Erreur : le contrôle n'a pas été supprimé.<br>";
    echo "L'identifiant de le contrôle ou le nom de la promotion n'a pas été transmis.<br>";
    echo "Si le problème persiste, veuillez contacter l'administrateur du site.<br>";
    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
    echo '</div>';
}


?>