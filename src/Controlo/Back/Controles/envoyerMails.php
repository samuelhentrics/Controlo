<div class="container">
  <?php

  if(isset($_POST["idControle"])){
    include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
    $idControle = $_POST["idControle"];
    $idControle = htmlspecialchars($idControle);
    $unControle = recupererUnControle($idControle);

    if($unControle->getEtatPDP() == 2){
      include_once(FONCTION_MAILS_PATH);

      $intitule = "[Controlo] Placement contrôle ";
      $intitule .= $unControle->getNomCourt();
      $intitule .= " du ";
      $intitule .= $unControle->getDate();
      $contenuMail = recupererMessageMailDefaut();

      if (isset($_POST["emailSubject"]) && isset($_POST["emailContent"])){
        $expediteur = $_SESSION["email"];
        $intitule = htmlspecialchars($_POST["emailSubject"]);
        $contenuMail = htmlspecialchars($_POST["emailContent"]);

        $listeOk = array();
        $listePasOk = array();
        envoyerMailEtudiants($unControle, $intitule, $contenuMail, $expediteur, $listeOk, $listePasOk);

        if(count($listePasOk) != 0){
          echo '<div class="alertmù alert-danger" role="alert">
          <h4 class="alert-heading">Erreur</h4>
          <p>Les mails n\'ont pas pu être envoyés aux étudiants suivants :</p>
          <ul>';
          foreach ($listePasOk as $key => $value) {
            echo '<li>'.$value.'</li>';
          }
          echo '</ul>
          </div>';
        }
        else{
          
          // Message d'alerte avec le nombre d'étudiants et un bouton qui permet d'afficher en js la liste des mails envoyés
          echo '<div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Succès</h4>
          <p>Les mails ont bien été envoyés aux '.count($listeOk).' étudiants.</p>
          </div>';

          // Liste des mails envoyés
          echo '<div class="alert alert-success" role="alert" id="listeMailsEnvoyes" style="display:none;">
          <h4 class="alert-heading">Liste des mails envoyés</h4>
          <ul>';
          foreach ($listeOk as $key => $value) {
            echo '<li>'.$value.'</li>';
          }
          echo '</ul>
          </div>';

          // Bouton pour afficher la liste des mails envoyés
          echo '<button type="button" class="btn btn-success" onclick="afficherListeMailsEnvoyes()">Afficher la liste des mails envoyés</button>';
          // Bouton pour réduire la liste des mails envoyés
          echo '<button type="button" class="btn btn-danger" onclick="document.getElementById(\'listeMailsEnvoyes\').style.display = \'none\'">Réduire la liste des mails envoyés</button>';

          echo '<script>
          function afficherListeMailsEnvoyes(){
            document.getElementById(\'listeMailsEnvoyes\').style.display = \'block\';
          }
          </script>';

          // Ouvrir le fichier "mails.txt" mettre en première ligne 1 et en seconde ligne la date actuelle
          // au format JJ/MM/YYYY HH:MM:SS
          $chemin = GENERATIONS_FOLDER_NAME . $unControle->getNomDossierGeneration() . "/mails.txt";
          $fichier = fopen($chemin, "w");
          fwrite($fichier, "1\n");
          fwrite($fichier, date("d/m/Y H:i:s"));
          fclose($fichier);
        }
      }


      echo '

      <h2>
      <form action="'.PAGE_PANEL_CONTROLE_PATH.'" method="post" style="display:inline;">
          <input type="hidden" name="idControle" value="' . $idControle . '">
          <button type="submit" class="btn btn-primary">
          <i class="fas fa-arrow-left"></i> Retour
        </button>
      </form>
      Envoyer un mail</h2>
      ';

      // Vérifier l'état des mails
      if($unControle->getEtatMail() == 2){
        // Récupérer la date d'envoi des mails
        $chemin = GENERATIONS_FOLDER_NAME . $unControle->getNomDossierGeneration() . "/mails.txt";
        // Récupérer la deuxieme ligne du fichier
        $fichier = fopen($chemin, "r");
        $ligne = fgets($fichier);
        $ligne = fgets($fichier);
        $dateEnvoi = $ligne;
        fclose($fichier);

        echo '<div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Informations</h4>
        <p>Les mails ont déjà été envoyés pour ce contrôle.</p>
        <p>Date d\'envoi : '.$dateEnvoi.'</p>
        </div>';
      }

      echo'
      <div class="row">
        <div class="col-md-9">

          <form action="'.PAGE_ENVOYER_MAILS_CONTROLE_PATH.'" method="POST">
            <h4>Rédiger le template du mail</h4>
            <input type="hidden" name="idControle" value="'.$idControle.'">
            <div class="form-group">
              <label>Expéditeur : '.$_SESSION["nom"].' '.$_SESSION["prenom"].' ('.$_SESSION["email"].')</label>
            </div>
            <div class="form-group">
              <label for="emailSubject">Intitulé :</label>
              <input type="text" class="form-control" id="emailSubject" name="emailSubject" value="'.$intitule.'" required>
            </div>
            <div class="form-group">
              <label for="emailContent">Contenu :</label>
              <textarea class="form-control" id="emailContent" name="emailContent" rows="5" required>'.$contenuMail.'
              </textarea>
            </div>
            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Envoyer</button>
              <button type="button" onclick="previewMail()" class="btn btn-warning" data-toggle="modal" data-target="#modalMail">Prévisualiser</button>
              <p id="messageMail"></p>
              <p id="messageMail2"></p>
            </div>
          </form> 
        </div>
        <div class="col-md-3">
          <h4>Tags disponibles</h4>

          <p> Les tags suivants peuvent être utilisés dans le contenu du mail :</p>
          <ul>
            <li>
              [Prénom]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Prénom de l\'étudiant.<br>Ex : Paul">
              </i>
            </li>
            <li>
              [Nom]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Nom de l\'étudiant.<br>Ex : DUPONT">
              </i>
            </li>
            <li>
              [NomLongControle]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Nom long du contrôle.<br>Ex : R1.01 - Initiation au développement">
              </i>
            </li>
            <li>
              [NomCourtControle]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Nom court du contrôle.<br>Ex : R1.01 - Initiation au dév.">
              </i>
            </li>
            <li>
              [Date]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Date du contrôle.<br>Ex : 01/01/2021">
              </i>
            </li>
            <li>
              [Heure]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Heure à laquelle débute l\'étudiant.<br>Si l\'étudiant est tiers temps, l\'heure de début sera celle pour les tiers-temps.<br>Ex : 08:00">
              </i>
            </li>
            <li>
              [Durée]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Durée du contrôle en minutes.<br>Ex : 60">
              </i>
            </li>
            <li>
              [Salle]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Nom de la salle.<br>Ex : S124">
              </i>
            </li>
            <li>
              [Place]
              <i class="fa-solid fa-circle-question"
                data-toggle="tooltip"
                data-bs-html="true"
                title="Numéro de place attribué à l\'étudiant.<br>Ex : 1">
              </i>
            </li>
          </ul>
        </div>
      </div>
      ';

      echo '
      <script>
        $(document).ready(function(){
          $(\'[data-toggle="tooltip"]\').tooltip();   
        });

        // Sur clic du bouton prévisualiser, on affiche la prévisualisation du mail on copie le contenu du mail dans le textarea
        function previewMail(){
          var emailContent = document.getElementById("emailContent").value;

          document.getElementById("messageMail").style.margin = "10px";
          document.getElementById("messageMail").style.padding = "10px";
          document.getElementById("messageMail").style.border = "1px solid black";
          document.getElementById("messageMail").style.borderRadius = "5px";

          emailContent = "<style>body{font-family: Arial, Helvetica, sans-serif;}</style>" + emailContent;

          emailContent = "<h3>Prévisualisation du mail</h3>" + emailContent;
          emailContent = emailContent + "<br><br><p style=\'color: red;\'>Ceci est une prévisualisation du mail. Les informations affichées ne sont pas réelles.</p>";


          emailContent = emailContent.replace(/\\r\\n/g, "<br>");
          emailContent = emailContent.replace(/\\n/g, "<br>");
          
          while(emailContent.includes("[Prénom]")){
            emailContent = emailContent.replace("[Prénom]", "Paul");
          }
          while(emailContent.includes("[Nom]")){
            emailContent = emailContent.replace("[Nom]", "DUPONT");
          }
          while(emailContent.includes("[NomLongControle]")){
            emailContent = emailContent.replace("[NomLongControle]", "R1.01 - Initiation au développement");
          }
          while(emailContent.includes("[NomCourtControle]")){
            emailContent = emailContent.replace("[NomCourtControle]", "R1.01 - Initiation au dév.");
          }
          while(emailContent.includes("[Date]")){
            emailContent = emailContent.replace("[Date]", "01/01/2021");
          }
          while(emailContent.includes("[Heure]")){
            emailContent = emailContent.replace("[Heure]", "08:00");
          }
          while(emailContent.includes("[Durée]")){
            emailContent = emailContent.replace("[Durée]", "60");
          }
          while(emailContent.includes("[Salle]")){
            emailContent = emailContent.replace("[Salle]", "S124");
          }
          while(emailContent.includes("[Place]")){
            emailContent = emailContent.replace("[Place]", "1");
          }

          document.getElementById("messageMail").innerHTML = emailContent;
        }


      </script>
      ';
    
    }
    else{
      echo '<div class="alert alert-danger" role="alert">
      Les plans de placement n\'ont pas encore été généré. Merci de les générer avant de pouvoir les envoyer.</div>';
    }
    

  }
  else{
    echo '<div class="alert alert-danger" role="alert">
    Aucun contrôle n\'a été sélectionné. Merci de sélectionner un contrôle avant d\'envoyer des mails.</div>';
  }

  ?>
</div>
