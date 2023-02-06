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
            <h1>Liste des contrôles</h1>
            <a href="<?php echo PAGE_AJOUTER_CONTROLE_PATH;?>" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Ajouter
            </a>
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
            include(FONCTION_CREER_LISTE_CONTROLES_PATH);
            include(FONCTION_AJOUTER_MINUTES_HEURE_PATH);

            $listeControles = creerListeControles();

            for ($numControle = 0; $numControle <= count($listeControles) - 1; $numControle++) {


                // Nom long du contrôle
                print("
                    <tr>
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
                    <td>
                ");


                // Bouton pour Générer

                if ($listeControles[$numControle]->controleInfoComplet()){
                    print("
                    <a href=\"&numControle=$numControle\">
                        <i class=\"fa-solid fa-arrow-rotate-right text-dark\"></i>
                    </a>");
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

                // Bouton pour gérer le contrôle
                        print("
                <form action=\"" . PAGE_PANEL_CONTROLE_PATH . "\" method=\"post\">
                    <input type=\"hidden\" name=\"idControle\" value=\"$numControle\">
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <i class=\"fa-solid fa-pencil text-white\"></i> Gérer
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