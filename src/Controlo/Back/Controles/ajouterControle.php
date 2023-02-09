<div class="container">
<div class="col-3"></div>
  <div class="col-6 m-auto text-center">
    <h2>Ajouter un contrôle</h2>
    <br>

    <?php

            if (isset($_POST["controleNomLong"]) && isset($_POST["controleNomCourt"]) && isset($_POST["dateDebutControle"]) && isset($_POST["dureeTotale"]) && isset($_POST["heureNonTT"]) && isset($_POST["heureTT"])) {
                include_once(FONCTION_CRUD_CONTROLE_PATH);
                include_once(CLASS_PATH . CLASS_CONTROLE_FILE_NAME);
    
                $nomLong= $_POST['controleNomLong'];
                $nomCourt = $_POST['controleNomCourt'];
                $dureeNonTT= $_POST['dureeTotale'];
                $dateControle = $_POST['dateDebutControle'];
                // Transformer la date en DD/MM/YYYY si la date est au format YYYY-MM-DD
                if (preg_match("#[0-9]{4}-[0-9]{2}-[0-9]{2}#", $dateControle)) {
                    $dateControle = date("d/m/Y", strtotime($dateControle));
                }

                $heureNonTT = $_POST['heureNonTT'];
                $heureTT = $_POST['heureTT'];
    
                try {
                    $nouveauControle = new Controle($nomLong, $nomCourt, $dureeNonTT, $dateControle, $heureNonTT, $heureTT);
                    ajouterControle($nouveauControle);
                    echo "<div class='alert alert-success' role='alert'>Le contrôle a bien été ajouté.</div>";
                } catch (Exception $e) {
                    echo "<div class='alert alert-danger' role='alert'>
                    Le contrôle n'a pas été ajouté : " . $e->getMessage() . "</div>";
                }
            }
            
            ?>
        <form action="<?php echo PAGE_AJOUTER_CONTROLE_PATH ?>" method="POST">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom long *</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomLong" name="controleNomLong" placeholder="Ex: R2.01 - Développement orienté objets - Programmation" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="controleNomCourt" class="col-4 col-form-label">Nom Court *</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomCourt" name="controleNomCourt" placeholder="Ex: R2.01 - Dév. objets - Programmation" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="promo" class="col-4 col-form-label">Date</label>
                <div class="col-8">
                    <input type="date" name="dateDebutControle" id="dateDebutControle" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="Durée" class="col-4 col-form-label">Durée totale (en min)</label>
                <div class="col-8">
                    <input id="Durée" name="dureeTotale" placeholder="Ex: 120, 60" type="number" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="heureTT" class="col-4 col-form-label">Heure début Non TT</label>
                <div class="col-8">
                    <input id="heureTT" name="heureNonTT" placeholder="Ex: 14:00" type="time" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="heureTT" class="col-4 col-form-label">Heure début TT</label>
                <div class="col-8">
                    <input id="heureTT" name="heureTT" placeholder="Ex: 14:00" type="time" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Enseignant référent</label>
                <div class="col-8">
                        <div>
                            <input id="enseignant" name="enseignant" placeholder="Ex : Dupont" type="text" class="form-control" disabled>
                        </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Surveillant(s)</label>
                <div class="col-8">
                        <div>
                            <input id="surveillant" name="surveillant" placeholder="Ex : Dupont, Lamarque" type="text" class="form-control" disabled>
                        </div>
                </div>
            </div>

            
            <div class="form-group row">
            <label for="choixSalle" class="col-4 col-form-label">Salles</label> 
                <div class="col-8">
                <input id="choixSalle" name="choixSalle" placeholder="Ex : S124" class="form-control">
                    <?php
                //ajouter la liste de salles

            /*$directory = CSV_SALLES_FOLDER_NAME;
            $files = scandir($directory);
            echo "<p style='color:green'>";

            foreach ($files as $file) {
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                if ($extension === "csv" && $file != LISTE_SALLES_FILE_NAME){
                    print('Taboulet');
                    $nomSalle = $_POST["choixSalle"];
                }
            }*/
            ?>
                  </select>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>
(*) signifie obligatoire