<div class="container">
    <div class="col-3"></div>
    <div class="col-6 m-auto text-center">
        <?php
        include_once(FONCTION_CRUD_PROMOTIONS_PATH);
        include_once(CLASS_PATH . CLASS_PROMOTION_FILE_NAME);

        echo '
        <h2>
            <form action="'.PAGE_PROMOTIONS_PATH.'" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
            </form>
            Importer une promotion
        </h2><br>';

        try {
            if (isset($_FILES['fichierPromotion'])) {

                // Récupération du nom de la promotion pour génération et pour l'affichage
                $nomGeneration = $_POST["nomGeneration"];
                $nomFormation = $_POST["nomFormation"];

                // Récupération du nom du fichier de promotion
                $fichierPromotion = $_FILES['fichierPromotion']['name'];

                //Récupération du nom du fichier sans l'extension .csv
                $fichierPromotionSansExtension = str_replace(".csv", "", $fichierPromotion);

                // Récupération du chemin temporaire du fichier sur le serveur
                $cheminTemporaire = $_FILES['fichierPromotion']['tmp_name'];



                //Vérification de l'extension CSV
                $extension = pathinfo($fichierPromotion, PATHINFO_EXTENSION);
                if ($extension != "csv") {
                    throw new Exception("Le fichier importé n'est pas au format 'csv'");
                }

                
                // Définission du chemin où on souhaite enregistrer l'image
                if ($nomGeneration != ""){
                    $emplacement = CSV_ETUDIANTS_FOLDER_NAME . $nomGeneration . ".csv";
                }
                else{
                    $emplacement = CSV_ETUDIANTS_FOLDER_NAME . $_FILES['fichierPromotion']['name'];
                }

                
                if (file_exists($emplacement)) {
                    throw new Exception("La promotion existe déjà. Veuillez la renommer ou la supprimer.");
                }

                move_uploaded_file($cheminTemporaire, $emplacement);


                // Cas où seulement le fichier est saisi
                if ($nomGeneration == ""& $nomFormation == "") {
                    // Déplacement de l'image du répertoire temporaire vers le répertoire de destination
                    $unePromotion = new Promotion($fichierPromotionSansExtension, $fichierPromotionSansExtension);
                    ajouterAffichagePromotion($unePromotion);

                }

                // Cas où le nom de génération et le fichier sont remplis
                else if ($nomGeneration != ""& $nomFormation == "") {
                    // Déplacement de l'image du répertoire temporaire vers le répertoire de destination
                    $unePromotion = new Promotion($nomGeneration, $nomGeneration);
                    ajouterAffichagePromotion($unePromotion);
                }

                // Cas où le nom de formation et le fichier sont remplis
                else if ($nomGeneration == ""& $nomFormation != "") {
                    $unePromotion = new Promotion($fichierPromotionSansExtension, $nomFormation);
                    ajouterAffichagePromotion($unePromotion);
                }

                // Cas où les 2 champs et le fichier sont remplis 
                else {
                    $unePromotion = new Promotion($nomGeneration, $nomFormation);
                    ajouterAffichagePromotion($unePromotion);
                }

                echo '<div class="alert alert-success" role="alert">La promotion a bien été ajoutée</div>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">
                Erreur lors de l\'ajout de la promotion : ' .
                $e->getMessage() . '</div>';
        }
        ?>
        <form action="<?php echo PAGE_IMPORTER_PROMOTION_PATH ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom de promotion pour génération</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomLong" name="nomGeneration" placeholder="Ex : Info semestre 1" type="text"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="controleNomCourt" class="col-4 col-form-label">Nom de promotion pour affichage</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomCourt" name="nomFormation" placeholder="Ex: BUT Informatique S1"
                            type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="fichierPromotion" class="col-4 col-form-label">Fichier de promotion (format CSV) *</label>
                <div class="col-8">
                    <input type="file" name="fichierPromotion" class="btn btn-primary">
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