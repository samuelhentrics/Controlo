<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Bienvenue sur Controlo</h1>
    <p>Bienvenue sur Controlo, cette plateforme permet de générer des plans de placement pour des
      contrôles.</p>

    <div id="accordion" class="card-deck" style="display: flex">
      <div class="card mx-5">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link">
              <!-- Le dossier /<?php echo CSV_CONTROLES_FOLDER_NAME; ?> -->
              Controles
            </button>
          </h5>
        </div>
        <div id="controle" aria-labelledby="controle">
          <div class="card-body">
            Contenu actuel du dossier
            <br>
            <?php
            $directory = CSV_CONTROLES_FOLDER_NAME;
            $files = scandir($directory);
            echo "<p style='color:green'>";

            foreach ($files as $file) {
              $extension = pathinfo($file, PATHINFO_EXTENSION);
              if ($extension === "csv")
                echo "<br>" . $file . "<br>";
            }
            ?>
          </div>

          <div class="card-body-desc">
            Le fichier <?php echo LISTE_CONTROLES_FILE_NAME; ?> contient la liste des contrôles.
          </div>
        </div>
      </div>


      <div class="card mx-5">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link">
              <!-- Le dossier /<?php echo CSV_ETUDIANTS_FOLDER_NAME; ?> -->
              ETUDIANTS
            </button>
          </h5>
        </div>
        <div id="etudiant" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
            Contenu actuel du dossier
            <br>
            <?php
            $directory = CSV_ETUDIANTS_FOLDER_NAME;
            $files = scandir($directory);
            echo "<p style='color:green'>";

            foreach ($files as $file) {
              $extension = pathinfo($file, PATHINFO_EXTENSION);
              if ($extension === "csv")
                echo $file . "<br>";
            }
            echo "</p>";
            ?>
          </div>
          <div class="card-body-desc">
            Chaque fichier CSV contiennent une promotion (le nom de la promotion est celle du fichier).
          </div>
        </div>
      </div>



      <div class="card mx-5">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link">
              <!-- Le dossier /<?php echo CSV_SALLES_FOLDER_NAME; ?> -->
              Salles
            </button>
          </h5>
        </div>
        <div id="salle" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">
            Contenu actuel du dossier
            <br>
            <?php
            $directory = CSV_SALLES_FOLDER_NAME;
            $files = scandir($directory);
            echo "<p style='color:green'>";

            foreach ($files as $file) {
              $extension = pathinfo($file, PATHINFO_EXTENSION);
              if ($extension === "csv")
                echo $file . "<br>";
            }
            ?>
          </div>
          <div class="card-body-desc">
            Le fichier <?php echo LISTE_SALLES_FILE_NAME; ?> contient la liste des salles ainsi que la salle voisine
            d'une salle si celle-ci existe.<br>
            Chaque fichier CSV contiennt le plan d'une salle (le nom la salle est celle du fichier).
          </div>
        </div>
      </div>



    </div>
    <script>
$(document).ready(function(){
  $(".card-header").mouseenter(function(){
    $(this).parent()[0].querySelector('.card-body-desc').hidden = false
  });
  $(".card-header").mouseleave(function(){
    $(this).parent()[0].querySelector('.card-body-desc').hidden = true
  });
});
</script>

  </div>
</main>