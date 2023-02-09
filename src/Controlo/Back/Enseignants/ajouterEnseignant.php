<div class="container">
    <div class="col-3"></div>
    <div class="col-6 m-auto text-center">

        <?php

        echo '
        <h2>
            <form action="'.PAGE_ENSEIGNANTS_PATH.'" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
            </form>
            Ajouter un enseignant
        </h2><br>';

        if (isset($_POST['submit'])) {
            include_once(FONCTION_CRUD_ENSEIGNANTS_PATH);
            include_once(CLASS_PATH . CLASS_ENSEIGNANT_FILE_NAME);

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $statut = $_POST['statut'];

            try {
                $nouvelEnseignant = new Enseignant(0, $nom, $prenom, $statut);
                ajouterEnseignant($nouvelEnseignant);
                echo "<div class='alert alert-success' role='alert'>L'enseignant a bien été ajouté.</div>";
            } catch (Exception $e) {
                echo "<div class='alert alert-danger' role='alert'>
                L'enseignant n'a pas été ajouté : " . $e->getMessage() . "</div>";
            }
        }
        ?>


        <div class="col-3"></div>
        <div class="col-6">
            <form action="<?php echo PAGE_AJOUTER_ENSEIGNANT_PATH; ?>" method="post">
                <div class="form-group row">
                    <label for="nom" class="col-4 col-form-label">Nom *</label>
                    <div class="col-8">
                        <div class="input-group">
                            <input id="nom" name="nom" placeholder="ex: Dupond" type="text" class="form-control"
                                required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prenom" class="col-4 col-form-label">Prénom *</label>
                    <div class="col-8">
                        <div class="input-group">
                            <input id="prenom" name="prenom" placeholder="ex: Jean" type="text" class="form-control"
                                required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="statut" class="col-4 col-form-label">Statut</label>
                    <div class="col-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statut" id="statutTitulaire"
                                value="Titulaire">
                            <label class="form-check-label" for="statutTitulaire">
                                Titulaire
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statut" id="statutVacataire"
                                value="Vacataire" checked>
                            <label class="form-check-label" for="statutVacataire">
                                Vacataire
                            </label>
                        </div>
                    </div>
                </div>
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
    (*) signifie obligatoire
</div>
