<div class="container">
    <div class="col-3"></div>
    <div class="col-6">
        <form>
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Nom long</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomLong" name="controleNomLong" placeholder="ex: R2.01 - Développement orienté objets - Programmation" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="controleNomCourt" class="col-4 col-form-label">Nom Court</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomCourt" name="controleNomCourt" placeholder="ex: R2.01 - Dév. objets - Programmation" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="promo" class="col-4 col-form-label">Date</label>
                <div class="col-8">
                    <input type="date" name="dateDebutControle" id="dateDebutControle">
                </div>
            </div>
            <div class="form-group row">
                <label for="Durée" class="col-4 col-form-label">Durée Totale du controle</label>
                <div class="col-8">
                    <input id="Durée" name="DuréeTotale" placeholder="ex: 120, 60 en min" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="heureTT" class="col-4 col-form-label">heureTT</label>
                <div class="col-8">
                    <input id="heureTT" name="heureTT" placeholder="ex: 14:00" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Enseignant - Surveillant</label>
                <div class="col-8">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-address-card"></i>
                            </div>
                        </div>
                        <input id="controleNomLong" name="controleNomLong" placeholder="ex: Cordova,Futrell" type="text" class="form-control" required="required">
                    </div>
                </div>
            </div>

            
            <div class="form-group row">
            <label for="select" class="col-4 col-form-label">Salles</label> 
                <div class="col-8">
                <select id="select" name="checkbox" class="custom-select" multiple="multiple">
                    <?php
                    //ajouter la liste de salles
            $directory = CSV_SALLES_FOLDER_NAME;
            $files = scandir($directory);
            echo "<p style='color:green'>";

            foreach ($files as $file) {
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                if ($extension === "csv" && $file != LISTE_SALLES_FILE_NAME){
                    print(' <div class="custom-control custom-checkbox custom-control-inline">
                    <option value="'.$file.'">'.$file.'</option>');
                }
            }
            ?>
                  </select>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>