<div class="container">
    <div class="col-12">
        <br>

        <script>
        var lien = "<?php echo JS_PATH ?>";
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

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        
        </script>
        <section>
            <!-- Mettre un titre à gauche et un bouton à droite -->
            <div class="row">
                <div class="col-10">
                    <h1>Liste des contrôles</h1>
                </div>
                <div class="col-2">
                    <a href="<?php echo PAGE_AJOUTER_CONTROLE_PATH;?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Ajouter
                    </a>
                </div>
            </div>

            
            <table id="controles" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Statut</th>
                        <th>Nom long</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Tiers-temps</th>
                        <th>Promotion(s)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
            include(FONCTION_CREER_LISTE_CONTROLES_PATH);
            include(FONCTION_AJOUTER_MINUTES_HEURE_PATH);

            $listeControles = creerListeControles();

            for ($numControle = 0; $numControle <= count($listeControles) - 1; $numControle++) {

            // Bouton pour Générer

            print("<tr><td class='text-center'>");
            if ($listeControles[$numControle]->controleInfoComplet()){
                            print('
                <i class="fa-solid fa-circle text-success"
                    data-toggle="tooltip"
                    data-bs-html="true"
                    title="PDP Générable">
                </i>
                ');
            }
            else{
                print('
                <i class="fa-solid fa-circle text-danger"
                    data-toggle="tooltip"
                    data-bs-html="true"
                    title="'.$listeControles[$numControle]->infoManquant().'">
                </i>
                
                ');
                
            }

            print("</td>");

                // Nom long du contrôle
                print("
                    <td>
                        {$listeControles[$numControle]->getNomLong()}
                    </td>
                    <td>
                ");


                // Date du contrôle
                if ($listeControles[$numControle]->getDate() != null) {
                    print("{$listeControles[$numControle]->getDate()}");
                } else {
                    print("Non définie");
                }
                print("
                    </td>
                    <td>
                ");


                // Heure Non TT
                if ($listeControles[$numControle]->getHeureNonTT() != null) {
                    echo $listeControles[$numControle]->getHeureNonTT(), "-", ajouterMinutesHeure($listeControles[$numControle]->getHeureNonTT(), $listeControles[$numControle]->getDureeNonTT());
                } else {
                    print("Non définie");
                }
                print("
                    </td>
                    <td>
                ");


                // Heure TT
                if ($listeControles[$numControle]->getHeureTT() != null) {
                    echo $listeControles[$numControle]->getHeureTT(), "-", ajouterMinutesHeure($listeControles[$numControle]->getHeureTT(), $listeControles[$numControle]->getDuree());
                } else {
                    print("Non définie");
                }
                print("
                    </td>
                    <td>
                ");


                // Promotions du contrôles
                $lesPromotions = $listeControles[$numControle]->getMesPromotions();
                if ($lesPromotions != null) {
                    $affichagePromo = "";
                    foreach ($lesPromotions as $key => $promo) {
                        $affichagePromo .= $promo->getNom() . ", ";
                    }
                    $affichagePromo = substr($affichagePromo, 0, -2);
                    print($affichagePromo);
                }
                else{
                    print("Aucune promotion");
                }
                print("
                    </td>
                    <td class='text-center'>
                ");

                // Bouton pour gérer le contrôle
                        print("
                <form action=\"" . PAGE_PANEL_CONTROLE_PATH . "\" method=\"post\">
                    <input type=\"hidden\" name=\"idControle\" value=\"$numControle\">
                    <button type=\"submit\" class=\"btn btn-primary\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Gérer\">
                        <i class=\"fa-solid fa-pencil text-white\"></i>
                    </button>
                </form>
                ");
                


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