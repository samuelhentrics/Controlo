<div class="container">
    <div class="col-12">

<?php

if(isset($_POST["idControle"])){
    include(FONCTION_CREER_LISTE_CONTROLES_PATH);

    $idControle = $_POST["idControle"];
    $unControle = recupererUnControle($idControle);
    $controleNom = $unControle->getNomLong();

    // Récuperer les infos du contrôle
    $nomCourtControle = $unControle->getNomCourt();
    $dateControle = $unControle->getDate();

    // Récupérer le nom du dossier qui sera zippé puis télécharger au client
    $dateFormatDossier = date('Y-m-d', strtotime($dateControle));
    $nomDossier = str_replace("-", "", $nomCourtControle);
    $nomDossier = str_replace(".", "-", $nomDossier);
    $nomDossier = preg_replace("/\s+/", " ", $nomDossier);
    $nomDossier = trim($nomDossier);
    $nomDossier = str_replace("/", "-", $nomDossier);
    $nomDossier = str_replace(" ", "-", $nomDossier);

    $nomDossier = $dateFormatDossier . "_" . $nomDossier;

    $existePDP = false;
    if (is_dir(PLANS_DE_PLACEMENT_FOLDER_NAME.$nomDossier)){
        $existePDP = true;
    }

    // Cas où le contrôle n'a pas toutes les informations nécessaires
    if(!$unControle->controleInfoComplet()){
        echo "
            <div class='alert alert-danger' role='alert'>
                <h4 class='alert-heading'>Informations manquantes</h4>
                Le contrôle \"$controleNom\" ne peut pas être généré car certaines informations sont manquantes.<br>
                Merci de compléter les informations manquantes et de générer les plans de placement avant de les télécharger.<br>
                <p class='mb-0 mt-3'>Si le problème persiste, veuillez contacter l'administrateur.</p>
            </div>";
    }

    // Cas où le plan de placement n'a pas été généré
    elseif(!$existePDP){
        echo "
            <div class='alert alert-danger' role='alert'>
                <h4 class='alert-heading'>Plans non générés</h4>
                Les plans de placement pour le contrôle \"$controleNom\" n'ont pas été générés.<br>
                Merci de générer les plans de placement avant de les télécharger.<br>
                <p class='mb-0 mt-3'>Si le problème persiste, veuillez contacter l'administrateur.</p>
            </div>";

    }
    // Cas où le contrôle est généré et les informations sont completes
    else {
        $dateGeneration = date('d/m/Y H:i:s', filemtime(PLANS_DE_PLACEMENT_FOLDER_NAME.$nomDossier));
        echo "
            <div class='alert alert-primary' role='alert'>
                Date de dernière génération : $dateGeneration
            </div>

            <div class='alert alert-success' role='alert'>
                <h4 class='alert-heading'>Télécharger les plans de placement</h4>
                Les plans de placement pour le contrôle \"$controleNom\" sont disponibles en téléchagement !<br>
                Vous pouvez les télécharger en cliquant sur le bouton ci-dessous.<br><br>
                <form>
                    <input type='hidden' id='id' value='$idControle'>
                    <button type='button' id='download-button' class='btn btn-primary btn-lg w-100'>Télécharger</button>
                </form>
                <p class='mb-0 mt-3'>Si le bouton ci-dessus ne fonctionne pas cliquez <a href='download.php?id=$idControle'>ici</a>.</p>
            </div>";
    }
}
// Cas d'erreur (pas de parametres)
else{
    // Erreur en bootstrap
    echo "<div class='alert alert-danger' role='alert'>";
    echo "L'identifiant du contrôle n'a pas été transmis.<br>";
    echo "Veuillez réessayer.<br>";
    echo "Si le problème persiste, veuillez contacter l'administrateur du site.";
    echo "</div>";
}


?>

    </div>
</div>