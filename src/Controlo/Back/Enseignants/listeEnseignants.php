<div class="container">
    <div class="col-12">
        <br>

        <script>
        var lien = "<?php echo JS_PATH ?>";
        $(document).ready(function() {
            $('#enseignants').DataTable({
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
            <h1>Liste des enseignants</h1>
            <a href="<?php echo PAGE_AJOUTER_ENSEIGNANT_PATH;?>" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Ajouter
            </a>
            <table id="enseignants" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Titulaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
            include(FONCTION_CREER_LISTE_ENSEIGNANTS_PATH);

            $listeEnseignants = creerListeEnseignants();

            foreach ($listeEnseignants as $enseignant) {


                // Nom de l'enseignant
                print("
                    <tr>
                    <td>
                        {$enseignant->getNom()}
                    </td>
                    <td>
                ");


                // Prénom de l'enseignant
                        print("
                        {$enseignant->getPrenom()}
                    </td>
                    <td class='text-center'>");

                // Titulaire
                if ($enseignant->getEstTitulaire()) {
                    print("<i class=\"fa-solid fa-check\"></i>");
                } else {
                    print("<i class=\"fa-solid fa-times\"></i>");
                }

                print("
                    </td>
                    <td class='text-center'>
                ");


                // Boutons
                print("
                    <a href=\"todo\" class=\"btn btn-primary\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Modifier\">
                        <i class=\"fas fa-edit\"></i>
                    </a>
                    <a href=\"todo\" class=\"btn btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Supprimer\">
                        <i class=\"fas fa-trash-alt\"></i>
                    </a>
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