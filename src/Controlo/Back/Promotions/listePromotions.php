<div class="container">
    <div class="col-12">
        <br>

        <script>
        var lien = "<?php echo JS_PATH ?>";
        $(document).ready(function() {
            $('#promotions').DataTable({
                "language": {
                    "url": lien + "/French.json"
                },

                order: [
                    [0, 'asc'],
                    [1, 'asc']
                ]
            });
        });
        </script>
        <section>
            <h1>Liste des promotions</h1>
            <!-- Bouton en haut à gauche pour ajouter une promotion -->
            <a href="<?php echo PAGE_AJOUTER_PROMOTION_PATH; ?>" class="btn btn-primary">Ajouter</a>
            <table id="promotions" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom pour génération</th>
                        <th>Nom de la promotion</th>
                        <th>Effectif de la promotion</th>
                        <th>Effectif d'étudiants avec tiers-temps</th>
                        <th>Nombre d'étudiants avec ordinateur</th>
                        <th>Nombre d'étudiants démisionnaires</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    include(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

                    $listePromotions = creerListePromotions(true);

                    foreach ($listePromotions as $unePromotion) {

                        // Récupérer le nom pour affichage de la promotion
                        $lienFichier = CSV_ETUDIANTS_FOLDER_NAME.LISTE_PROMOTIONS_FILE_NAME;
                        $file =  fopen($lienFichier  , "r");

                        $nomAffichage = null;
                        // Récupérer dans le fichier le nom pour affichage de la promotion
                        while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
                            if ($data[0] == $unePromotion->getNom()) {
                                $nomAffichage = $data[1];
                            }
                        }

                        // Compter le nombre d'étudiants dans la promotion
                        $nbEtudiant = count($unePromotion->getMesEtudiants());

                        // Compter le nombre d'étudiants avec ordinateur dans la promotion
                        $nbEtudiantsOrdi = count($unePromotion->recupererListeEtudiantsOrdi());

                        // Compter le nombre d'étudiants Tiers-Temps dans la promotion
                        $nbEtudiantTT= count($unePromotion->getMesEtudiants())-count($unePromotion->recupererListeEtudiantsNonTT());
                    
                        // Nom de la promotion
                        $nomPromotion = $unePromotion->getNom();
                    
                        print("

                        <tr>
                            <td>".$nomPromotion."</td>
                            <td>".$nomAffichage."</td>
                            <td>".$nbEtudiant."</td>
                            <td>".$nbEtudiantTT."</td>
                            <td>".$nbEtudiantsOrdi."</td>
                        <td class=\"text-center\">
                            <form method=\"post\" action=" . PAGE_MODIFIER_PROMOTION_PATH . ">
                                <input type=\"submit\" name=\"action\" value=\"Modifier\" class=\"btn btn-primary\">
                                </form>
                            <form method=\"post\" action=" . PAGE_SUPPRIMER_PROMOTION_PATH . ">
                                <input type=\"hidden\" name=\"nomPromotion\" value=\"".$nomPromotion."\">
                                <input type=\"submit\" onclick=\"return confirm('Confirmer la suppression de: ".$nomPromotion."')\" name=\"action\" value=\"Supprimer\" class=\"btn btn-danger\">
                            </form>
                        </td>



                        </tr>");
                        }
                    ?>
                </tbody>
            </table>
        </section>
        <br>
    </div>
</div>