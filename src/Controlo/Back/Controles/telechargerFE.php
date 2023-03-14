<div class="container">
    <div class="col-12">

<?php

if(isset($_POST["idControle"])){
    include(FONCTION_CREER_LISTE_CONTROLES_PATH);
    include(IMPORT_PATH."genererPDF.php");

    $idControle = htmlspecialchars($_POST["idControle"]);
    echo '
    <h2>
        <form action="'.PAGE_PANEL_CONTROLE_PATH.'" method="post" style="display:inline;">
                <input type="hidden" name="idControle" value="' . $idControle . '">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Retour
                </button>
        </form>
        Télécharger les feuilles d\'émargement
    </h2>';


    $unControle = recupererUnControle($idControle);

    $controleNom = $unControle->getNomLong();

    // Récuperer les infos du contrôle
    $nomCourtControle = $unControle->getNomCourt();
    $dateControle = $unControle->getDate();

    // Récupérer le nom du dossier qui sera zippé puis télécharger au client
    $nomDossier = $unControle->getNomDossierGeneration();

    $nbEnseignantsRef = count($unControle->getMesEnseignantsReferents());
    $nbEnseignantsSurveillants = count($unControle->getMesEnseignantsSurveillants());
    $nbSalles = count($unControle->getMesSalles());

    // Cas où le contrôle n'a pas toutes les informations nécessaires
    if($unControle->getEtatPDP()!=2){
        echo "
            <div class='alert alert-danger' role='alert'>
                <h4 class='alert-heading'>Plans de placements nécéssaires</h4>
                Les plans de placement pour le contrôle \"$controleNom\" n'ont pas encore été générés pour générer les feuilles d'émargement.<br>
                <p class='mb-0 mt-3'>Si le problème persiste, veuillez contacter l'administrateur.</p>
            </div>";
    }
    // Cas où le contrôle est généré et les informations sont completes
    elseif($nbEnseignantsRef == 0 || $nbEnseignantsSurveillants == 0){
        echo "
            <div class='alert alert-danger' role='alert'>
                <h4 class='alert-heading'>Enseignants nécéssaires</h4>
                Les enseignants référents et surveillants pour le contrôle \"$controleNom\" n'ont pas encore été définis pour générer les feuilles d'émargement.<br>
                <p class='mb-0 mt-3'>Si le problème persiste, veuillez contacter l'administrateur.</p>
            </div>";
    }
    elseif($nbSalles != $nbEnseignantsSurveillants){
        echo "
            <div class='alert alert-danger' role='alert'>
                <h4 class='alert-heading'>Salles nécéssaires</h4>
                Il n'y a pas assez de surveillants pour le contrôle \"$controleNom\". Merci d'en rajouter<br>
                <p class='mb-0 mt-3'>Si le problème persiste, veuillez contacter l'administrateur.</p>
            </div>";
    }
    else {
        echo "
            <div class='alert alert-success' role='alert'>
                <h4 class='alert-heading'>Télécharger les feuilles d'émargement</h4>
                Les feuilles d'émargement pour le contrôle \"$controleNom\" sont disponibles en téléchagement !<br>
                Vous pouvez les télécharger en cliquant sur le bouton ci-dessous.<br><br>
                <form>
                    <input type='hidden' id='id' value='$idControle'>
                    <button type='button' id='download-button' class='btn btn-primary btn-lg w-100'>Télécharger</button>
                </form>
                <p class='mb-0 mt-3'>Si le bouton ci-dessus ne fonctionne pas cliquez <a href='downloadFE.php?id=$idControle'>ici</a>.</p>
            </div>";

            // Script pour télécharger le fichier
            echo '<script>
            document.getElementById("download-button").addEventListener("click", async function(){
                let id = document.getElementById("id").value;
                let response = await fetch("downloadFE.php?id="+id);
                let file_name = response.headers.get("Content-Disposition").split("=")[1];
                let blob = await response.blob();
                let link = document.createElement("a");
                link.href = window.URL.createObjectURL(blob);
                link.download = file_name;
                link.click();
            });
            </script>
            ';
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