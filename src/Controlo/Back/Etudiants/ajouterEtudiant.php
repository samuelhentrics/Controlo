<div class="container">
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Attention !</strong>
        <p>Cette page est en cours de développement.</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

  <div class="col-3"></div>
  <div class="col-6 m-auto">
    <h2>Ajouter un étudiant</h2>
    <br>
    <?php
    include_once(FONCTION_CRUD_ETUDIANTS_PATH);

    // Vérifier si le formulaire a été envoyé
    if (isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["nomPromotion"]) && isset($_POST["td"]) && isset($_POST["tp"]) && isset($_POST["mail"])) {
        // Récupérer les données du formulaire
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $nomPromotion = $_POST["nomPromotion"];
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


        // Ajouter l'étudiant
        $bool = ajouterEtudiant($nom, $prenom, $nomPromotion, $td, $tp, $email, $tiersTemps, $ordinateur, $demissionnaire);
      if ($bool) {
        // Afficher un message de succès bootstrap
        print("
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Succès !</strong>
            <p>L'étudiant a bien été ajouté.</p>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ");
      }
    }

    ?>
    <form action="<?php echo PAGE_AJOUTER_ETUDIANTS_PATH; ?>" method="post">
      <div class="form-group row">
        <label for="nom" class="col-4 col-form-label">Nom</label>
        <div class="col-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-address-card"></i>
              </div>
            </div>
            <input id="nom" name="nom" placeholder="ex : DUPONT" type="text" class="form-control"
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
            <input id="prenom" name="prenom" placeholder="ex : Paul" type="text" class="form-control"
              required="required">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="promo" class="col-4 col-form-label">Promotion</label>
        <div class="col-8">
          <select id="nomPromotion" name="nomPromotion" class="custom-select" required="required">
            <option value="Info semestre 1">Info semestre 1</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="td" class="col-4 col-form-label">TD</label>
        <div class="col-8">
          <input id="td" name="td" placeholder="ex : 1" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="tp" class="col-4 col-form-label">TP</label>
        <div class="col-8">
          <input id="tp" name="tp" placeholder="ex : 1" type="text" class="form-control" required="required">
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
            <input id="mail" name="mail" placeholder="ex : pdupont@iutbayonne.univ-pau.fr" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-4">Statuts</label>
        <div class="col-8">
          <div class="custom-control custom-checkbox custom-control-inline">
            <input name="tiersTemps" id="tiersTemps" type="checkbox" class="custom-control-input">
            <label for="tiersTemps" class="custom-control-label">Tiers-temps</label>
          </div>
          <div class="custom-control custom-checkbox custom-control-inline">
            <input name="ordinateur" id="ordinateur" type="checkbox" class="custom-control-input">
            <label for="ordinateur" class="custom-control-label">Ordinateur</label>
          </div>
          <div class="custom-control custom-checkbox custom-control-inline">
            <input name="demissionnaire" id="demissionnaire" type="checkbox" class="custom-control-input">
            <label for="demissionnaire" class="custom-control-label">Démissionnaire</label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-4 col-8">
          <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </form>
  </div> 
  <div class="col-3"></div>
</div>