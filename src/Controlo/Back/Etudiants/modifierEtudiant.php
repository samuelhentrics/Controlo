<div class="container">
  <div class="col-3"></div>
  <div class="col-6 m-auto">
    <h2>Modifier un étudiant</h2>

    <?php
    include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

    if (isset($_POST["idEtudiant"]) && isset($_POST["nomPromotion"])) {
        $idEtudiant = $_POST["idEtudiant"];
        $nomPromotion = $_POST["nomPromotion"];

        if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["td"]) && isset($_POST["tp"]) && isset($_POST["mail"])) {
            include_once(FONCTION_CRUD_ETUDIANTS_PATH);
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $td = $_POST["td"];
            $tp = $_POST["tp"];
            $email = $_POST["mail"];

            if (isset($_POST["tiersTemps"]))
                $tiersTemps = $_POST["tiersTemps"];
            else
                $tiersTemps = 0;

            if (isset($_POST["ordinateur"]))
                $ordinateur = $_POST["ordinateur"];
            else
                $ordinateur = 0;

            if (isset($_POST["demissionnaire"]))
                $demissionnaire = $_POST["demissionnaire"];
            else
                $demissionnaire = 0;

            try {
                modifierEtudiant($nomPromotion, $idEtudiant, $nom, $prenom, $td, $tp, $email, $tiersTemps, $ordinateur, $demissionnaire);
                print("
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Succès !</strong>
                        <p>L'étudiant a bien été modifié.</p>
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



        $etudiant = recupererUnEtudiant($idEtudiant, $nomPromotion);

        echo '
        <form action="'.PAGE_MODIFIER_ETUDIANT_PATH.'" method="post">
        <div class="form-group row">
            <label for="nom" class="col-4 col-form-label">Nom</label>
            <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fa fa-address-card"></i>
                </div>
                </div>
                <input id="nom" name="nom" placeholder="ex : DUPONT" type="text" 
                class="form-control" value="' . $etudiant->getNom() . '"
                required="required">
            </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="prenom" class="col-4 col-form-label">Prénom</label>
            <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fa fa-address-card"></i>
                </div>
                </div>
                <input id="prenom" name="prenom" placeholder="ex : Paul" type="text"
                class="form-control" value="' . $etudiant->getPrenom() . '"
                required="required">
            </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="nomPromo" class="col-4 col-form-label">Promotion</label>
            <div class="col-8">
            <p>' . $nomPromotion . '</p>
            <input id="nomPromo" name="nomPromo" value="' . $nomPromotion . '" hidden>
            </div>
        </div>
        <div class="form-group row">
            <label for="td" class="col-4 col-form-label">TD</label>
            <div class="col-8">
            <input id="td" name="td" placeholder="ex : 1" type="text"
            class="form-control" value="' . $etudiant->getTd() . '"
             required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="tp" class="col-4 col-form-label">TP</label>
            <div class="col-8">
            <input id="tp" name="tp" placeholder="ex : 1" type="text"
            class="form-control" value="' . $etudiant->getTp() . '"
            required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="mail" class="col-4 col-form-label">Mail</label>
            <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fa fa-envelope"></i>
                </div>
                </div>
                <input id="mail" name="mail" placeholder="ex : pdupont@iutbayonne.univ-pau.fr"
                type="text" value="' . $etudiant->getEmail() . '" required="required"
                class="form-control">
            </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4">Statuts</label>
            <div class="col-8">
            <div class="custom-control custom-checkbox custom-control-inline">
        ';

        // Case à cocher Tiers-temps
        if ($etudiant->getEstTT()) {
            echo '
                <input name="tiersTemps" id="tiersTemps" type="checkbox" class="custom-control-input" checked>
            ';
        } else {
            echo '
                <input name="tiersTemps" id="tiersTemps" type="checkbox" class="custom-control-input">
            ';
        }

        echo '
                <label for="tiersTemps" class="custom-control-label">
                    Tiers-temps
                </label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">';


        // Case à cocher Ordinateur
        if ($etudiant->getAOrdi()) {
            echo '
                <input name="ordinateur" id="ordinateur" type="checkbox" class="custom-control-input" checked>
            ';
        }
        else {
            echo '
                <input name="ordinateur" id="ordinateur" type="checkbox" class="custom-control-input">
            ';
        }

        echo '
                <label for="ordinateur" class="custom-control-label">
                    Ordinateur
                </label>
            </div>
            <div class="custom-control custom-checkbox custom-control-inline">';


        // Case à cocher Démissionnaire
        if ($etudiant->getEstDemissionnaire()) {
            echo '
                <input name="demissionnaire" id="demissionnaire" type="checkbox" class="custom-control-input" checked>
            ';
        }
        else {
            echo '
                <input name="demissionnaire" id="demissionnaire" type="checkbox" class="custom-control-input">
            ';
        }

        echo '                
                <label for="demissionnaire" class="custom-control-label">
                    Démissionnaire
                </label>
            </div>
            </div>
        </div>
        <div class="form-group row">
            <input name="idEtudiant" value="' . $idEtudiant . '" hidden></input>
            <input name="nomPromotion" value="' . $nomPromotion . '" hidden></input>
            <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
        </form>

        ';
    }
    else{
        echo "Aucun étudiant n'a été renseigné. Veuillez-réessayer";    
    }
    ?>


  </div>
  <div class="col-3"></div>
</div>