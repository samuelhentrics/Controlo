<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5">Bienvenue sur Controlo</h1>
    <p>Bienvenue sur Controlo, cette plateforme permet de générer des plans de placement pour des
      contrôles.</p>
    <div class="row text-center">
      <div class="col-md-4 card-container">
        <div class="card card-flip">
          <div class="front card-block">
            <!-- <span class="card-img-top fa" style="font-size: 4em">&#xf118;</span> -->
            <h4 class="card-title">Controles</h4>
            <h6 class="card-subtitle text-muted">Emplacement du dossier</h6>
            <p class="card-text"><?php echo CSV_CONTROLES_FOLDER_NAME; ?></p>
          </div>
          <div class="back card-block">

            <p> Contenu actuel du dossier </p>
            <?php
            $directory = CSV_CONTROLES_FOLDER_NAME;
            $files = scandir($directory);
            echo "<p style='color:green'>";

            foreach ($files as $file) {
              $extension = pathinfo($file, PATHINFO_EXTENSION);
              if ($extension === "csv")
                echo $file . "<br>";
            }
            ?></p>
            <br>
            <!-- <a href="#" class="btn btn-outline-primary">Read More</a> -->
          </div>
        </div>
      </div>
      <div class="col-md-4 card-container">
        <div class="card card-flip">
          <div class="front card-block">
            <!-- <span class="card-img-top fa" style="font-size: 4em">&#xf118;</span> -->
            <h4 class="card-title">Étudiants</h4>
            <h6 class="card-subtitle text-muted">Emplacement du dossier</h6>
            <p class="card-text"><?php echo CSV_ETUDIANTS_FOLDER_NAME; ?></p>
          </div>
          <div class="back card-block">

            <p> Contenu actuel du dossier </p>
            <?php
            $directory = CSV_ETUDIANTS_FOLDER_NAME;
            $files = scandir($directory);
            echo "<p style='color:green'>";

            foreach ($files as $file) {
              $extension = pathinfo($file, PATHINFO_EXTENSION);
              if ($extension === "csv")
                echo $file . "<br>";
            }
            ?></p>
            <br>
            <!-- <a href="#" class="btn btn-outline-primary">Read More</a> -->
          </div>
        </div>
      </div>
      <div class="col-md-4 card-container">
        <div class="card card-flip">
          <div class="front card-block">
            <!-- <span class="card-img-top fa" style="font-size: 4em">&#xf118;</span> -->
            <h4 class="card-title">Salles</h4>
            <h6 class="card-subtitle text-muted">Emplacement du dossier</h6>
            <p class="card-text"><?php echo CSV_SALLES_FOLDER_NAME; ?></p>
          </div>
          <div class="back card-block">

            <p> Contenu actuel du dossier </p>
            <?php
            $directory = CSV_SALLES_FOLDER_NAME;
            $files = scandir($directory);
            echo "<p style='color:green'>";

            foreach ($files as $file) {
              $extension = pathinfo($file, PATHINFO_EXTENSION);
              if ($extension === "csv")
                echo $file . "<br>";
            }
            ?></p>
            <br>
            <!-- <a href="#" class="btn btn-outline-primary">Read More</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<style>
  .card-block .btn-outline-primary {
    width: 100%;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    bottom: 0;
    left: 0;
    position: absolute;
  }

  .card {
    margin: 20px 0;
  }

  /* Flip Cards CSS */
  .card-container {
    perspective: 700px;
  }

  .card-flip {
    position: relative;
    width: 100%;
    transform-style: preserve-3d;
    height: auto;
    transition: all 0.5s ease-out;
    background: white;
    border: none;
  }

  .card-flip div {
    backface-visibility: hidden;
    transform-style: preserve-3d;
    height: 100%;
    width: 100%;
    border: none;
  }

  .card-flip .front {
    position: relative;
    z-index: 1;
  }

  .card-flip .back {
    position: relative;
    z-index: 0;
    transform: rotateY(-180deg);
  }

  .card-container:hover .card-flip {
    transform: rotateY(180deg);
  }
</style>
<script>
  $(document).ready(function() {
    var front = document.getElementsByClassName("front");
    var back = document.getElementsByClassName("back");

    var highest = 0;
    var absoluteSide = "";

    for (var i = 0; i < front.length; i++) {
      if (front[i].offsetHeight > back[i].offsetHeight) {
        if (front[i].offsetHeight > highest) {
          highest = front[i].offsetHeight;
          absoluteSide = ".front";
        }
      } else if (back[i].offsetHeight > highest) {
        highest = back[i].offsetHeight;
        absoluteSide = ".back";
      }
    }
    $(".front").css("height", highest);
    $(".back").css("height", highest);
    $(absoluteSide).css("position", "absolute");
  });
</script>