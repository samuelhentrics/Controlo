<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Bienvenue sur Controlo</h1>
    <p>Bienvenue sur Controlo, cette plateforme permet de générer des plans de placement pour des
      contrôles.</p>
    
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#controle" aria-expanded="true"
              aria-controls="controle">
              Le dossier /<?php echo CSV_CONTROLES_FOLDER_NAME; ?>
            </button>
          </h5>
        </div>
        <div id="controle" class="collapse show" aria-labelledby="controle" data-parent="#accordion">
          <div class="card-body">
            Le fichier <?php echo LISTE_CONTROLES_FILE_NAME; ?> contient la liste des contrôles.
          </div>
        </div>
      </div>


      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#etudiant" aria-expanded="false"
              aria-controls="etudiant">
              Le dossier /<?php echo CSV_ETUDIANTS_FOLDER_NAME; ?>
            </button>
          </h5>
        </div>
        <div id="etudiant" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
            Chaque fichier CSV contiennent une promotion (le nom de la promotion est celle du fichier).
          </div>
        </div>
      </div>

    

      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#salle"
              aria-expanded="false" aria-controls="salle">
              Le dossier /<?php echo CSV_SALLES_FOLDER_NAME; ?>
            </button>
          </h5>
        </div>
        <div id="salle" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">
            Le fichier <?php echo LISTE_SALLES_FILE_NAME; ?> contient la liste des salles ainsi que la salle voisine d'une salle si celle-ci existe.<br>
            Chaque fichier CSV contiennt le plan d'une salle (le nom la salle est celle du fichier).
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#pdp"
              aria-expanded="false" aria-controls="pdp">
              Le dossier /<?php echo PLANS_DE_PLACEMENT_FOLDER_NAME; ?>
            </button>
          </h5>
        </div>
        <div id="pdp" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">
            Vous retrouvez dans ce dossier, chaque plan de placement généré d'un contrôle.
          </div>
        </div>
      </div>


    </div>

  </div>
</main>