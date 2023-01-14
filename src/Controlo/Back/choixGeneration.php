<div class="container">
    <div class="row">
        <div class="col-12">

            <?php print('<form action="' . PAGE_GENERER_PATH . '" method="post">'); ?>

            <?php
            include(FONCTION_CREER_LISTE_CONTROLES_PATH);

            $numControle = $_GET["numControle"];
            $leControle = recupererUnControle($numControle);

            echo '<br>';

            print("<h2>Placer automatiquement</h2>");

            echo "<input type='hidden' name='id' value='" . $numControle . "'>";

            echo '<br>';

            demanderContraintesSalles($leControle);

            demanderContraintesGenerales();
            ?>
            <br>

            <input type="submit" class="btn btn-primary btn-lg w-100" value="Générer"></button>
            </form>

            <?php

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

            function demanderContraintesSalles($leControle)
            {
                print("<h3>Contraintes par salles</h3>");
                print('<table class="table table-striped table-bordered">');
                print("<tr>
                    <th>Salles</th>
                    <th>Nombre de places séparant les étudiants</th>
                    <th>Nombre de rangées séparant les étudiants</th>
                </tr>");
                foreach ($leControle->getMesSalles() as $key => $uneSalle) {
                    print("<tr>");
                    print("<td>" . $uneSalle->getNom() . "</td>");
                    print("<td> <input type='number' id='nbPlacesSeparant' min='0' max='999' value=1 name='nbPlacesSeparant-" . $uneSalle->getNom() . "' value='0'></td>");
                    print("<td> <input type='number' id='nbRangeesSeparant' min='0' max='999' value=0    name='nbRangeesSeparant-" . $uneSalle->getNom() . "' value='0'></td>");
                    print("</tr>");
                }
                print("</table>");
            }

            ?>

        </div>
    </div>
</div>