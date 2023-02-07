<div class="container">
    <div class="col-3"></div>
    <div class="col-6">
        <?php
        include_once(FONCTION_CRUD_PROMOTIONS_PATH);

        if (isset($_FILES['fichierPromotion'])) {

            // Récupération du nom du fichier de promotion
            $fichierPromotion = $_FILES['fichierPromotion']['name'];

            //Récupération du nom du fichier sans l'extension .csv
            $fichierPromotionSansExtension = str_replace(".csv", "",$fichierPromotion);

            // Récupération du chemin temporaire du fichier sur le serveur
            $cheminTemporaire = $_FILES['fichierPromotion']['tmp_name'];

            // Définission du chemin où on souhaite enregistrer l'image
            $emplacement = CSV_ETUDIANTS_FOLDER_NAME . $_FILES['fichierPromotion']['name'];

            // Récupération du nom de la promotion pour génération et pour l'affichage
            $nomGeneration = $_POST["nomGeneration"];
            $nomFormation = $_POST["nomFormation"];

            //Vérification de l'extension CSV
            $extension = pathinfo($fichierPromotion, PATHINFO_EXTENSION);
            if ($extension != "csv") {
                throw new Exception("Le fichier importé n'est pas au format 'csv'");
            }

            // Emplacement du fichier avec le nouveau nom
            $emplacementRenomme = CSV_ETUDIANTS_FOLDER_NAME . $nomGeneration . ".csv";

            // Cas où seulement le fichier est saisi
            if ($nomGeneration == "" & $nomFormation == "") 
            {
                // Déplacement de l'image du répertoire temporaire vers le répertoire de destination
                move_uploaded_file($cheminTemporaire, $emplacement);
                ajouterNomPromotion($fichierPromotionSansExtension, $fichierPromotionSansExtension);

            } 

            // Cas où le nom de génération et le fichier sont remplis
            else if($nomGeneration != "" & $nomFormation ==""){

                // Déplacement de l'image du répertoire temporaire vers le répertoire de destination
                move_uploaded_file($cheminTemporaire, $emplacement);
                rename($emplacement, $emplacementRenomme);
                ajouterNomPromotion($nomGeneration, $nomGeneration);
            }

            // Cas où le nom de formation et le fichier sont remplis
            else if($nomGeneration== "" & $nomFormation !=""){
                move_uploaded_file($cheminTemporaire, $emplacement);
                ajouterNomPromotion($fichierPromotionSansExtension, $nomFormation);
            }

            // Cas où les 2 champs et le fichier sont remplis 
            else{
                move_uploaded_file($cheminTemporaire, $emplacement);
                rename($emplacement, $emplacementRenomme);
                ajouterNomPromotion($nomGeneration, $nomFormation);
            }
        }
        ?>
        <form action="<?php echo PAGE_IMPORTER_PROMOTION_PATH ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom de promotion pour génération</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomLong" name="nomGeneration" placeholder="Ex : Info semestre 1" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="controleNomCourt" class="col-4 col-form-label">Nom de promotion pour affichage</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomCourt" name="nomFormation" placeholder="Ex: BUT Informatique S1" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    Fichier de promotion (CSV) : <input type="file" name="fichierPromotion" class="btn btn-primary">
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
</div>