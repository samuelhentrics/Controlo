<div class="container">
    <div class="col-12">
        <br>
        <script src="<?php echo JS_PATH ?>moment.min.js"></script>
        <script src="<?php echo JS_PATH ?>datetime-moment.js"></script>

        <script>

        // Récupérer le chemin du fichier French.json
        var lien = "<?php echo JS_PATH ?>";
        
        $(document).ready(function() {            
            $('#controles').DataTable({
                // datetime-moment
                "createdRow": function ( row, data, index ) {
                    $('td', row).eq(2).html( moment(data[2]).format('DD/MM/YYYY') );
                },


                // Traduire le tableau
                "language": {
                    "url": lien + "/French.json"
                },

                // Tri par défaut
                order: [
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
                <div class="col-8">
                    <h1>Liste des contrôles</h1>
                </div>
                <div class="col-4 text-end">
                    <a href="<?php echo PAGE_AJOUTER_CONTROLE_PATH;?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Ajouter
                    </a>
                    <a href="<?php echo PAGE_IMPORTER_CONTROLE_PATH;?>" class="btn btn-primary">
                        <i class="fas fa-file-import"></i>
                        Importer
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

            switch($listeControles[$numControle]->getEtatPDP()){
                case 0:
                    print('
                    <i class="fa-solid fa-circle text-danger"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="'.$listeControles[$numControle]->infoManquant().'">
                    </i>
                
                    ');
                    break;
                case 1:
                    print('
                    <i class="fa-solid fa-circle text-warning"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="PDP Générable">
                    </i>
                    ');
                    break;
                case 2:
                    print('
                    <i class="fa-solid fa-circle text-success"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="PDP Généré">
                    </i>
                    ');
                    break;
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
                    // Date au format YYYY-MM-DD
                    $dateControle = $listeControles[$numControle]->getDate();
                    // Transformer la date EN yyyy-mm-dd
                    if (preg_match("#[0-9]{2}/[0-9]{2}/[0-9]{4}#", $dateControle)) {
                        trim($dateControle);
                        $dateControle = str_replace("/", "-", $dateControle);
                        $dateControle = date("Y-m-d", strtotime($dateControle));
                    }
                

                    print("$dateControle");
                } else {
                    print("Non définie");
                }
                print("
                    </td>
                    <td>
                ");


                // Heure Non TT
                if ($listeControles[$numControle]->getHeureNonTT() != null && $listeControles[$numControle]->getDuree() != null) {
                    echo $listeControles[$numControle]->getHeureNonTT(), "-", ajouterMinutesHeure($listeControles[$numControle]->getHeureNonTT(), $listeControles[$numControle]->getDureeNonTT());
                } else {
                    print("Non définie");
                }
                print("
                    </td>
                    <td>
                ");


                // Heure TT
                if ($listeControles[$numControle]->getHeureTT() != null && $listeControles[$numControle]->getDuree() != null) {
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
                        <i class=\"fa-sharp fa-solid fa-gears \"></i>
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