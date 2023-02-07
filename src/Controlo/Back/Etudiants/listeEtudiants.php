<div class="container">
    <div class="col-12">
        <br>

        <script>
            var lien = "<?php echo JS_PATH ?>";
            $(document).ready(function () {

                $('#etudiants').DataTable({
                    "language": {
                        "url": lien + "/French.json"
                    },

                    order: [
                        [0, 'asc'],
                        [1, 'asc']
                    ]
                });
            });

            $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <section>
            <div class="row">
                <div class="col-10">
                    <h1>Liste des étudiants</h1>
                </div>
                <div class="col-2 text-end">
                    <a href="<?php echo PAGE_AJOUTER_ETUDIANT_PATH;?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Ajouter
                    </a>
                </div>
            </div>

            <table id="etudiants" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Promotion</th>
                        <th>TD</th>
                        <th>TP</th>
                        <th>Email</th>
                        <th>Tiers-temps</th>
                        <th>Ordinateur</th>
                        <th>Démissionnaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

                    $listePromotions = creerListePromotions(true);

                    foreach ($listePromotions as $unePromotion) {
                        foreach ($unePromotion->getMesEtudiants() as $unEtudiant) {

                            // Nom de l'étudiant
                            print("
                        <tr>
                        <td>
                            {$unEtudiant->getNom()}
                        </td>
                        <td>
                    ");

                            // Prénom de l'étudiant
                            print("
                        {$unEtudiant->getPrenom()}
                    </td>");

                            // Promotion de l'étudiant
                            print("
                        <td>
                            {$unePromotion->getNom()}
                        </td>");

                            // TD Etudiant
                            print("
                        <td>
                            {$unEtudiant->getTD()}
                        </td>");

                            // TP Etudiant
                            print("
                        <td>
                            {$unEtudiant->getTP()}
                        </td>");

                            // Email Etudiant
                            print("
                        <td>
                            {$unEtudiant->getEmail()}
                        </td>");

                            // Tiers-temps Etudiant
                            print("
                        <td class=\"text-center\">");

                            if ($unEtudiant->getEstTT()) {
                                print("<a style=\"display:none;\">Oui</a><i class=\"fa-solid fa-check\"></i>");
                            } else {
                                print("<a style=\"display:none;\">Non</a><i class=\"fa-solid fa-times\"></i>");
                            }

                            print("</td>");

                            // Ordinateur Etudiant
                            print("
                        <td class=\"text-center\">");

                            if ($unEtudiant->getAOrdi()) {
                                print("<a style=\"display:none;\">Oui</a><i class=\"fa-solid fa-check\"></i>");
                            } else {
                                print("<a style=\"display:none;\">Non</a><i class=\"fa-solid fa-times\"></i>");
                            }

                            print("</td>");

                            // Démissionnaire Etudiant
                            print("
                        <td class=\"text-center\">");

                            if ($unEtudiant->getEstDemissionnaire()) {
                                print("<a style=\"display:none;\">Oui</a><i class=\"fa-solid fa-check\"></i>");
                            } else {
                                print("<a style=\"display:none;\">Non</a><i class=\"fa-solid fa-times\"></i>");
                            }

                            print("</td>


                        <td class=\"text-center\">
                            <form method=\"post\" action=" . PAGE_MODIFIER_ETUDIANT_PATH . ">
                                <input type=\"hidden\" name=\"idEtudiant\" value=\"{$unEtudiant->getId()}\">
                                <input type=\"hidden\" name=\"nomPromotion\" value=\"{$unePromotion->getNom()}\">

                                <button type=\"submit\" class=\"btn btn-primary\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Modifier\">
                                    <i class=\"fas fa-edit\"></i>
                                </button>
                                
                            </form>
                            <form method=\"post\" action=" . PAGE_SUPPRIMER_ETUDIANT_PATH . ">
                                <input type=\"hidden\" name=\"idEtudiant\" value=\"{$unEtudiant->getId()}\">
                                <input type=\"hidden\" name=\"nomPromotion\" value=\"{$unePromotion->getNom()}\">
                                <button type=\"submit\" onclick=\"return confirm('Confirmer la suppression de: ".$unEtudiant->getNom(). "  " .$unEtudiant->getPrenom()."')\" name=\"action\" class=\"btn btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Supprimer\">
                                    <i class=\"fas fa-trash-alt\"></i>
                                </button>
                            </form>
                        </td>


                        </tr>");
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <br>
    </div>
</div>