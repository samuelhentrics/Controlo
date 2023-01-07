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
            <h3>Contraintes générales</h3>
            <p>Etudiants separés par
                <select name="typeSeparation" id="">
                    <option value="TD">TD</option>
                    <option value="TP">TP</option>
                </select>
            
            </p>
            <p>Etudiants placés par
                <select name="typePlacement" id="">
                    <option value="aléatoire">aléatoire</option>
                    <option value="ascendant">ascendant</option>
                    <option value="descendant">descendant</option>
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
                    <th>Nombre de place séparent les étudiants</th>
                    <th>Nombre de rangées séparent les étudiants</th>
                </tr>");
                foreach ($leControle->getMesSalles() as $key => $uneSalle) {
                    print("<tr>");
                    print("<td>" . $uneSalle->getNom() . "</td>");
                    print("<td> <input type='number' id='nbPlaceSeparant' min='0' max='999' value=1 name='nbPlaceSeparant-" . $uneSalle->getNom() . "' value='0'></td>");
                    print("<td> <input type='number' id='nbRangeeSeparant' min='0' max='999' value=0    name='nbRangeeSeparant-" . $uneSalle->getNom() . "' value='0'></td>");
                    print("</tr>");
                }
                print("</table>");
            }

            ?>

        </div>
    </div>
</div>