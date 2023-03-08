<div class="container">
    <div class="col-3"></div>
    <div class="col-6 m-auto text-center">
        <?php
        include_once(FONCTION_CRUD_CONTROLE_PATH);



        try {
            if (isset($_FILES['fichierControles'])) {

                // Récupération du nom du fichier de promotion
                $fichierControles = $_FILES['fichierControles']['name'];

                // Récupération du chemin temporaire du fichier sur le serveur
                $cheminTemporaire = $_FILES['fichierControles']['tmp_name'];

                // Définission du chemin où on souhaite enregistrer l'image
                $emplacement = CSV_CONTROLES_FOLDER_NAME . LISTE_CONTROLES_FILE_NAME;

                //Vérification de l'extension CSV
                $extension = pathinfo($fichierControles, PATHINFO_EXTENSION);
                if ($extension != "csv") {
                    throw new Exception("Le fichier importé n'est pas au format 'csv'");
                }

                // Déplacement de l'image du répertoire temporaire vers le répertoire de destination
                move_uploaded_file($cheminTemporaire, $emplacement);

                echo '<div class="alert alert-success" role="alert">La liste des contrôles a bien été ajoutée</div>';
            }
        }
            
            catch (Exception $e) {
                echo '<div class="alert alert-danger" role="alert">
                Erreur lors de l\'ajout de la promotion : ' .
                $e->getMessage() . '</div>';
            }
        ?>

        <?php
        echo '
        <h2>
            <form action="'.PAGE_CONTROLES_PATH.'" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
            </form>
            Importer une liste de contrôles
        </h2>';

        echo "<div class='alert alert-warning' role='alert'>";
        echo "Attention!<br>En important une nouvelle liste de contrôles, vous effacez l'ancien fichier.<br>
        Les champs nécéssaires sont les suivants :<br>
        <ul>
            <li>".PROMOTION_NOM_COLONNE_CONTROLE."</li>
            <li>".NOM_COURT_NOM_COLONNE_CONTROLE."</li>
            <li>".NOM_LONG_NOM_COLONNE_CONTROLE."</li>
            <li>".DATE_NOM_COLONNE_CONTROLE."</li>
            <li>".ENSEIGNANT_REF_NOM_COLONNE_CONTROLE."</li>
            <li>".DUREE_NOM_COLONNE_CONTROLE."</li>
            <li>".DATE_NOM_COLONNE_CONTROLE."</li>
            <li>".HEURE_NOM_COLONNE_CONTROLE."</li>
            <li>".HEURE_TT_NOM_COLONNE_CONTROLE."</li>
            <li>".SALLES_NOM_COLONNE_CONTROLE."</li>
            <li>".SURVEILLANTS_NOM_COLONNE_CONTROLE."</li>
        </ul>

        
        ";
        echo "</div>";?>
        <form action="<?php echo PAGE_IMPORTER_CONTROLE_PATH ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="fichierControles" class="col-4 col-form-label">Fichier de contrôles (format CSV)</label>
                <div class="col-8">
                    <input type="file" name="fichierControles" class="btn btn-primary">
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button type="submit" class="btn btn-primary">Importer</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
    (*) signifie obligatoire
</div>
