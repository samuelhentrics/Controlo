<div class="container">
    <div class="col-12">
        <br>

        <script>
            var lien = "<?php echo JS_PATH ?>";
            $(document).ready(function() {
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
        </script>
        <section>
            <h1>Liste des étudiants</h1>
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
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

                    $listePromotions = creerListePromotions();

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

                        if($unEtudiant->getEstTT()){
                            print("<i class=\"fa-solid fa-check\"></i>");
                        }
                        else{
                            print("<i class=\"fa-solid fa-times\"></i>");
                        }

                        print("</td>");

                            // Ordinateur Etudiant
                        print("
                        <td class=\"text-center\">");
    
                        if($unEtudiant->getAOrdi()){
                            print("<i class=\"fa-solid fa-check\"></i>");
                        }
                        else{
                            print("<i class=\"fa-solid fa-times\"></i>");
                        }
    
                        print("</td>");

                            // Démissionnaire Etudiant
                            print("
                        <td class=\"text-center\">");

                            if($unEtudiant->getEstDemissionnaire()){
                                print("<i class=\"fa-solid fa-check\"></i>");
                            }
                            else{
                                print("<i class=\"fa-solid fa-times\"></i>");
                            }

                        print("</td>
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