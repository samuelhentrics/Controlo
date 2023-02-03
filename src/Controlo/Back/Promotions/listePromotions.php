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
            <table id="promotions" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom pour Génération</th>
                        <th>Nom de la promotion</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

                    $listePromotions = creerListePromotions();

                    foreach ($listePromotions as $unePromotion) {
                        
                        echo $unePromotion->getNom();

                    print("
                        <td class=\"text-center\">
                            <form method=\"post\" action=" . PAGE_MODIFIER_ETUDIANTS_PATH . ">
                                <input type=\"hidden\" name=\"idEtudiant\" value=\"{}\">
                                <input type=\"hidden\" name=\"nomPromotion\" value=\"{}\">
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