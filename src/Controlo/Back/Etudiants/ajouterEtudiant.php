<div class="container">

  <div class="col-3"></div>
  <div class="col-6 m-auto text-center">
  <?php
    include_once(FONCTION_CRUD_ETUDIANTS_PATH);
    include_once(CLASS_PATH . CLASS_ETUDIANT_FILE_NAME);

    echo '
        <h2>
            <form action="'.PAGE_ETUDIANTS_PATH.'" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
            </form>
            Ajouter un étudiant
        </h2><br>';

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
        $tiersTemps = true;
      else
        $tiersTemps = false;

      if (isset($_POST["ordinateur"]))
        $ordinateur = true;
      else
        $ordinateur = false;

      if (isset($_POST["demissionnaire"]))
        $demissionnaire = true;
      else
        $demissionnaire = false;


      // Ajouter l'étudiant
      try {
        $nouvelEtudiant = new Etudiant(0, $nom, $prenom, $td, $tp, $email);
        $nouvelEtudiant->setEstTT($tiersTemps);
        $nouvelEtudiant->setAOrdi($ordinateur);
        $nouvelEtudiant->setEstDemissionnaire($demissionnaire);

        ajouterEtudiant($nouvelEtudiant, $nomPromotion);
        print("
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Succès !</strong>
                <p>L'étudiant a bien été ajouté.</p>
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

    ?>
    <form action="<?php echo PAGE_AJOUTER_ETUDIANT_PATH; ?>" method="post">
      <div class="form-group row">
        <label for="nom" class="col-4 col-form-label">Nom *</label>
        <div class="col-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-address-card"></i>
              </div>
            </div>
            <input id="nom" name="nom" placeholder="ex : DUPONT" type="text" class="form-control" required="required">
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="prenom" class="col-4 col-form-label">Prénom *</label>
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
        <label for="promo" class="col-4 col-form-label">Promotion *</label>
        <div class="col-8">
          <select id="nomPromotion" name="nomPromotion" class="custom-select form-control" required="required">
            <?php
            include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

            $listePromotions = creerListePromotions();

            foreach ($listePromotions as $unePromotion) {
              $nomPromo = $unePromotion->getNom();
              echo '<option value="' . $nomPromo . '">' . $nomPromo . '</option>';
            }

            ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="td" class="col-4 col-form-label">TD *</label>
        <div class="col-8">
          <input id="td" name="td" placeholder="ex : 1" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="tp" class="col-4 col-form-label">TP *</label>
        <div class="col-8">
          <input id="tp" name="tp" placeholder="ex : 1" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="mail" class="col-4 col-form-label">Mail *</label>
        <div class="col-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-envelope"></i>
              </div>
            </div>
            <input id="mail" name="mail" placeholder="ex : pdupont@iutbayonne.univ-pau.fr" type="text"
              class="form-control">
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
            <label for="demissionnaire" class="custom-control-label">Démission</label>
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
  (*) signifie obligatoire
</div>