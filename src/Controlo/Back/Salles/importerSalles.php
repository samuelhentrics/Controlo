<div class="container">
    <div class="col-3"></div>
    <div class="col-6 m-auto text-center">
        <?php
        include_once(FONCTION_CRUD_SALLES_PATH);

        try {
            if (isset($_FILES['fichierSalle'])) {

                // Récupération du nom du fichier de Salle
                $fichierSalle = $_FILES['fichierSalle']['name'];

                //Récupération du nom du fichier sans l'extension .csv
                $fichierSalleSansExtension = str_replace(".csv", "", $fichierSalle);

                // Récupération du chemin temporaire du fichier sur le serveur
                $cheminTemporaire = $_FILES['fichierSalle']['tmp_name'];

                // Définission du chemin où on souhaite enregistrer l'image
                $emplacement = CSV_SALLES_FOLDER_NAME . $_FILES['fichierSalle']['name'];

                // Récupération du nom de la Salle et le nom du voisin
                $salleNom = $_POST["salleNom"];
                $nomVoisin = $_POST["nomVoisin"];

                //Vérification de l'extension CSV
                $extension = pathinfo($fichierSalle, PATHINFO_EXTENSION);
                if ($extension != "csv") {
                    throw new Exception("Le fichier importé n'est pas au format 'csv'");
                }

                // Emplacement du fichier avec le nouveau nom
                $emplacementRenomme = CSV_SALLES_FOLDER_NAME . $salleNom . ".csv";
                // Cas où seulement le fichier est saisi
                move_uploaded_file($cheminTemporaire, $emplacement);
                ajouterAffichageSalle($fichierSalleSansExtension, $nomVoisin);
                /*
                
                // Cas où le nom de et le fichier sont remplis
                else if ($salleNom != ""& $nomVoisin == "") {

                    // Déplacement de l'image du répertoire temporaire vers le répertoire de destination
                    move_uploaded_file($cheminTemporaire, $emplacement);
                    rename($emplacement, $emplacementRenomme);
                    // $uneSalle = new Salle($salleNom, $salleNom);
                    ajouterAffichageSalle($uneSalle);
                }

                // Cas où le nom de formation et le fichier sont remplis
                else if ($salleNom == ""& $nomVoisin != "") {
                    move_uploaded_file($cheminTemporaire, $emplacement);
                    // $uneSalle = new Salle($fichierSalleSansExtension, $nomVoisin);
                    ajouterAffichageSalle($uneSalle);
                }

                // Cas où les 2 champs et le fichier sont remplis 
                else {
                    move_uploaded_file($cheminTemporaire, $emplacement);
                    rename($emplacement, $emplacementRenomme);
                    // $uneSalle = new Salle($salleNom, $nomVoisin);
                    ajouterAffichageSalle($uneSalle);
                }*/

                echo '<div class="alert alert-success" role="alert">La Salle a bien été ajoutée</div>';
            }
        }
            
            catch (Exception $e) {
                echo '<div class="alert alert-danger" role="alert">
                Erreur lors de l\'ajout de la Salle : ' .
                $e->getMessage() . '</div>';
            }
        ?>




        <h2>Importer une salle</h2>
        <form action="<?php echo PAGE_IMPORTER_SALLE_PATH ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Renommé la salle (optionnel)</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="salleNom" name="salleNom" placeholder="Ex : S124" type="text" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="salleVoisin" class="col-4 col-form-label">Voisin (optionnel)</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="salleVoisin" name="nomVoisin" placeholder="Ex: vide ou S125" type="text" class="form-control" >
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="fichierSalle" class="col-4 col-form-label">Fichier de salle (format CSV)</label>
                <div class="col-8">
                    <input type="file" name="fichierSalle" class="btn btn-primary" required="required">
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