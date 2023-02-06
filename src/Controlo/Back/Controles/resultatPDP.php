<?php

include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);

echo "<div class='container'>";
echo "  <div class='col-12'>";


if (isset($_POST['idControle'])) {
    // -- Récupération du contrôle passé en paramètre
    $idControle = $_POST['idControle'];
    $unControle = recupererUnControle($idControle);
    $controleNom = $unControle->getNomLong();

    try{
        genererPDPControle($unControle);

        echo "
            <div class='alert alert-success' role='alert'>
                <h4 class='alert-heading'>Plans générés</h4>
                Les plans de placement pour le contrôle \"$controleNom\" ont été générés avec succès.<br>
                Vous pouvez les télécharger en cliquant sur le bouton ci-dessous.<br><br>
                <form>
                    <input type='hidden' id='id' value='$idControle'>
                    <button type='button' id='download-button' class='btn btn-primary btn-lg w-100'>Télécharger</button>
                </form>
                <p class='mb-0 mt-3'>Si le bouton ci-dessus ne fonctionne pas cliquez <a href='download.php?id=$idControle'>ici</a>.</p>
            </div>";
    }
    catch(Exception $e){
        echo "<div class='alert alert-danger' role='alert'>
            <h4 class='alert-heading'>Erreur</h4>
            Les contraintes choisies ne semblent pas permettre le placement des étudiants.
            Veuillez réessayer avec d'autres contraintes.
            </div>";
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
echo '<script>
document.getElementById("download-button").addEventListener("click", async function(){
    let id = document.getElementById("id").value;
    let response = await fetch("download.php?id="+id);
    let file_name = response.headers.get("Content-Disposition").split("=")[1];
    let blob = await response.blob();
    let link = document.createElement("a");
    link.href = window.URL.createObjectURL(blob);
    link.download = file_name;
    link.click();
  });
</script>
';


?>