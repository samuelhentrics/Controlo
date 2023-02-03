<div class="container">
    <div class="col-3"></div>
    <div class="col-6">
        <?php
        include_once(FONCTION_CRUD_PROMOTIONS_PATH);

        // Vérifier si le formulaire a été envoyé
        if (isset($_POST['nomGeneration']) && isset($_POST['nomFormation'])) {
        // Récupérer les données du formulaire
        $nomPromotion = $_POST["nomGeneration"];
        $nomPromotionAffichage = $_POST["nomFormation"];
        
        // Ajouter la promotion

        try{

        creerPromotion($nomPromotion);
                // Afficher un message de succès bootstrap
                print("
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Succès !</strong>
                    <p>La promotion a bien été ajouté.</p>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ");

        ajouterNomAffichage($nomPromotionAffichage);
              
        }catch (Exception $e) {
            // Afficher l'erreur      
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
            echo $e->getMessage();
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo '</div>';
    
            $ajoutOk = false;

        }
    }

        ?>
        <form action="<?php echo PAGE_AJOUTER_PROMOTION_PATH ?>" method="POST">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom de promotion pour génération</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomLong" name="nomGeneration" placeholder="Ex : Info semestre 1" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="controleNomCourt" class="col-4 col-form-label">Nom de promotion pour affichage</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomCourt" name="nomFormation" placeholder="Ex: BUT Informatique S1" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>