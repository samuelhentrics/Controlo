<div class="container">
  <?php

  if(isset($_POST["idControle"])){
    include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
    $idControle = $_POST["idControle"];
    $unControle = recupererUnControle($idControle);

    if($unControle->getEtatPDP() == 2){
      include_once(FONCTION_MAILS_PATH);

      $intitule = "Placement contrôle ";
      $intitule .= $unControle->getNomCourt();
      $intitule .= " du ";
      $intitule .= $unControle->getDate();
      $contenuMail = recupererMessageMailDefaut();

      if (isset($_POST["emailSubject"]) && isset($_POST["emailContent"])){
        $expediteur = $_SESSION["email"];
        $intitule = $_POST["emailSubject"];
        $contenuMail = $_POST["emailContent"];

        $listeOk = array();
        $listePasOk = array();
        envoyerMailEtudiants($unControle, $intitule, $contenuMail, $expediteur, $listeOk, $listePasOk);

        if($listePasOk){
          echo '<div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">Erreur</h4>
          <p>Les mails n\'ont pas pu être envoyés aux étudiants suivants :</p>
          <ul>';
          foreach ($listePasOk as $key => $value) {
            echo '<li>'.$value.'</li>';
          }
          echo '</ul>
          </div>';
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

      <form action="'.PAGE_ENVOYER_MAILS_CONTROLE_PATH.'" method="POST">
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
          <button type="submit" class="btn btn-primary">Envoyer</button><br>
          <small class="form-text text-muted">
              [Prénom] sera remplacé par le prénom de l\'étudiant<br>
              [Nom] par le nom<br>
              [NomLongControle] par le nom long du contrôle<br>
              [NomCourtControle] par le nom court du contrôle<br>
              [Date] par la date du contrôle<br>
              [Heure] par l\'heure à laquelle débute l\'étudiant<br>
              [Durée] par la durée du contrôle<br>
              [Salle] par le nom de la salle<br>
              [Place] par le numéro de place attribué à l\'étudiant<br>
          </small>
        </div>
        
      </form>
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
