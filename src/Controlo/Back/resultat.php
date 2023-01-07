<?php

include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);

echo "<div class='container'>";
echo "  <div class='col-12'>";



if (isset($_GET['succes']) and isset($_GET['id'])) {
    $page = $_GET['succes'];
    $id = $_GET['id'];
    $controleNom = recupererUnControle($id)->getNomLong();


    switch ($page) {
        // Cas où l'utilisateur souhaite voir la liste des contrôles
        case 'ok':
            // Afficher un message de confirmation en bootstrap
            echo "<div class='alert alert-success' role='alert'>
              <h4 class='alert-heading'>Plans générés</h4>
              Les plans de placement pour le contrôle \"$controleNom\" ont été générés avec succès.<br>
              Vous pouvez les télécharger en cliquant sur le bouton ci-dessous.<br><br>
              <a href='". PAGE_TELECHARGEMENT_PATH ."&id=". $id ."' class='btn btn-primary'>Télécharger les plans</a>
            </div>";

            break;

        default:
            // Afficher un message d'erreur
            echo "<div class='alert alert-danger' role='alert'>
            <h4 class='alert-heading'>Erreur</h4>
            Les contraintes choisies ne semblent pas permettre le placement des étudiants.
            Veuillez réessayer avec d'autres contraintes.
            </div>";
            break;
    }
}
else {
    // Afficher un message d'erreur
    echo "<div class='alert alert-danger' role='alert'>
    <h4 class='alert-heading'>Erreur</h4>
    Problème au niveau du lien de la page. Veuillez contactez l'administrateur si l'erreur persiste.
    </div>";
}

echo "  </div>";
echo "</div>";


?>