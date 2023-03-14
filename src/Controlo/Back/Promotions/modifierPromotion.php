<div class="container">
  <div class="col-3"></div>
  <div class="col-6 m-auto text-center">
    <?php
    include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);
    include_once(CRUD_PATH . FONCTION_CRUD_PROMOTIONS_FILE_NAME);

    echo '
        <h2>
            <form action="'.PAGE_PROMOTIONS_PATH.'" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
            </form>
            Modifier une promotion
        </h2><br>';

    if (isset($_POST["nomPromotion"])) {
        $nomPromotion = htmlspecialchars($_POST["nomPromotion"]);

        if(isset($_POST["nouveauNomGeneration"])){
            include_once(FONCTION_CRUD_ENSEIGNANTS_PATH);
            $nouveauNomGeneration = htmlspecialchars($_POST["nouveauNomGeneration"]);
            $nouveauNomAffichage = htmlspecialchars($_POST["nouveauNomAffichage"]);

            try {

                $promotionActuelle = creerUnePromotion($nomPromotion);
                $promotionMaj = new Promotion($nouveauNomGeneration, $nouveauNomAffichage);
                modifierPromotion($promotionActuelle, $promotionMaj);

                // Modifier le nom de la promotion dans la variable
                $nomPromotion = $nouveauNomGeneration;
                
                print("
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Succès !</strong>
                        <p>La promotion a bien été modifiée.</p>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ");
            } catch (Exception $e) {
                // Afficher l'erreur      
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo $e->getMessage();
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo '</div>';
            }
        }


        $promotion = creerUnePromotion($nomPromotion);

        echo '
        <form action="' . PAGE_MODIFIER_PROMOTION_PATH . '" method="POST">
            <input type="hidden" name="nomPromotion" value="' . $promotion->getNom() . '">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom de promotion pour génération *</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="nouveauNomGeneration" name="nouveauNomGeneration" placeholder="Ex : Info semestre 1" type="text" class="form-control" value="'. $promotion->getNom() .'" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="controleNomCourt" class="col-4 col-form-label">Nom de promotion pour affichage *</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="nouveauNomAffichage" name="nouveauNomAffichage" placeholder="Ex: BUT Informatique S1" type="text" class="form-control" value="'. $promotion->getNomAffichage() .'">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </div>
        </form>

        ';
    }
    else{
        echo "Aucune promotion n'a été renseignée. Veuillez-réessayer";    
    }
    ?>


  </div>
  <div class="col-3"></div>
  (*) signifie obligatoire
</div>