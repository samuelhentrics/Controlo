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
            <a href="index.php?page=promotions&action=ajouter" class="btn btn-primary">Ajouter</a>
            <table id="promotions" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom pour Génération</th>
                        <th>Nom de la promotion</th>
                        <th>Statut</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    include(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

                    $listePromotions = creerListePromotions();

                    foreach ($listePromotions as $unePromotion) {

                    print("
                        <tr>
                            <td>".$unePromotion->getNom()."</td>
                            <td>".$unePromotion->getNom()."</td>
                        <td class=\"text-center\">
                            <form method=\"post\" action=" . PAGE_MODIFIER_ETUDIANTS_PATH . ">
                                <input type=\"submit\" name=\"action\" value=\"supprimer\" class=\"btn btn-primary\">
                                <input type=\"submit\" name=\"action\" value=\"modifier\" class=\"btn btn-primary\">
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