<div class="container">
    <div class="col-12">
        <br>

        <script>
        var lien = "<?php echo $JS_PATH ?>";
        $(document).ready(function() {
            $('#controles').DataTable({
                "language": {
                    "url": lien + "/French.json"
                },

                order: [
                    [1, 'asc'],
                    [2, 'asc']
                ]

            });
        });
        </script>
        <section>
            <h1>Liste des contrôles</h1>
            <table id="controles" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom long</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Tiers-temps</th>
                        <th>Promotion(s)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
            include($FONCTION_CREER_LISTE_CONTROLES_PATH);
            include($FONCTION_AJOUTER_MINUTES_HEURE_PATH);

            $listeControles = creerListeControles();

            for ($i = 0; $i <= count($listeControles) - 1; $i++) {


                // Nom long du contrôle
                print("
                    <tr>
                    <td>
                        {$listeControles[$i]->getNomLong()}
                    </td>
                    <td>
                ");


                // Date du contrôle
                if ($listeControles[$i]->getDate() != null) {
                    print("{$listeControles[$i]->getDate()}");
                } else {
                    print("Non définie");
                }
                print("
                    </td>
                    <td>
                ");


                // Heure Non TT
                if ($listeControles[$i]->getHeureNonTT() != null) {
                    echo $listeControles[$i]->getHeureNonTT(), "-", ajouterMinutesHeure($listeControles[$i]->getHeureNonTT(), $listeControles[$i]->getDureeNonTT());
                } else {
                    print("Non définie");
                }
                print("
                    </td>
                    <td>
                ");


                // Heure TT
                if ($listeControles[$i]->getHeureTT() != null) {
                    echo $listeControles[$i]->getHeureTT(), "-", ajouterMinutesHeure($listeControles[$i]->getHeureTT(), $listeControles[$i]->getDuree());
                } else {
                    print("Non définie");
                }
                print("
                    </td>
                    <td>
                ");


                // Promotions du contrôles
                print("Pas encore programmé");
                print("
                    </td>
                    <td>
                ");


                // Bouton pour Générer

                if ($listeControles[$i]->controleInfoComplet()){
                    print("
                    <a href=\"\">
                        <i class=\"fa-solid fa-arrow-rotate-right text-dark\"></i>
                    </a>");
                }
                else{
                    print("<i class=\"fa-solid fa-circle text-danger\"></i>");
                }
                


                print("
                        </td>
                        </tr>
                ");
            }
            ?>
                </tbody>
            </table>
        </section>

    </div>
</div>