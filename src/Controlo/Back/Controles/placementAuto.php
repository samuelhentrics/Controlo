<div class="container">
    <div class="row">
        <div class="col-12">

            <?php
            include(FONCTION_CREER_LISTE_CONTROLES_PATH);

            function demanderContraintesGenerales()
            {
                echo '
                <h3>Contrainte générale</h3>
                <p>Trier les étudiants :
                    <select name="typePlacement" id="">
                        <option value="aléatoire">de façon aléatoire</option>
                        <option value="ascendant">de A à Z</option>
                        <option value="descendant">de Z à A</option>
                    </select>
                </p>
                <p style="visibility: hidden">Etudiants separés par
                    <select name="typeSeparation" id="">
                        <option value="TD">TD</option>
                        <option value="TP">TP</option>
                    </select>
                </p>
                
                ';
            }

            function demanderContraintesSalles($unControle)
            {
                print("<h3>Contraintes par salles</h3>");
                print('<table class="table table-striped table-bordered">');
                print("<tr>
                <th>Salles</th>
                <th>Nombre de places séparant les étudiants</th>
                <th>Nombre de rangées séparant les étudiants</th>
            </tr>");
                foreach ($unControle->getMesSalles() as $key => $uneSalle) {
                    print("<tr>");
                    print("<td>" . $uneSalle->getNom() . "</td>");
                    print("<td> <input type='number' id='nbPlacesSeparant' min='0' max='999' value=1 name='nbPlacesSeparant-" . $uneSalle->getNom() . "' value='0'></td>");
                    print("<td> <input type='number' id='nbRangeesSeparant' min='0' max='999' value=0    name='nbRangeesSeparant-" . $uneSalle->getNom() . "' value='0'></td>");
                    print("</tr>");
                }
                print("</table>");
            }

            $idControle = $_POST["idControle"];
            $unControle = recupererUnControle($idControle);
            $controleNom = $unControle->getNomLong();

            echo '<br>';

            print("<h2>Placer automatiquement</h2>");

            if (isset($_POST["typePlacement"])) {
                try {
                    include_once(FONCTION_GENERER_PDP_PATH);
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
                catch (Exception $e) {
                    echo "<div class='alert alert-danger' role='alert'>
                    <h4 class='alert-heading'>Erreur</h4>
                    <p class='mb-0'>Une erreur est survenue lors de la génération des plans de placement.</p>
                    <p>Les contraintes ne peuvent être respectées.</p>
                    </div>";
                }
            }

            // Formulaire de demande de contraintes
            if ($unControle->controleInfoComplet()) {
                print('<form action="' . PAGE_PLACEMENT_AUTO_PATH . '" method="post">');

                echo "<input type='hidden' name='idControle' id='idControle' value='" . $idControle . "'>";

                echo '<br>';

                demanderContraintesSalles($unControle);

                demanderContraintesGenerales();

                echo '<br>

            <input type="submit" class="btn btn-primary btn-lg w-100" value="Générer"></button>
            </form>';

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

            }
            else{
                echo "<div class='alert alert-danger' role='alert'>
                    <h4 class='alert-heading'>Erreur</h4>
                    <p class='mb-0'>Le contrôle ne peut être généré, certaines informations sont manquantes.</p>
                    <p> ". $unControle->infoManquant() . "</p>
                    </div>";
            }
            ?>

        </div>
    </div>
</div>