<div class="container">
    <div class="col-12">
        <br>

        <script>
        var lien = "<?php echo JS_PATH ?>";
        $(document).ready(function() {
            $('#salles').DataTable({
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
            <h1>Liste des salles</h1>
            <a href="<?php echo PAGE_AJOUTER_SALLE_PATH;?>" class="btn btn-primary" >Ajouter salle</a>
            <a href="<?php echo PAGE_IMPORTER_SALLE_PATH; ?>" class="btn btn-primary" >Importer salle</a>
            <table id="salles" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom de la Salle</th>
                        <th>Salle voisine</th>
                        <th>Etat du plan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include(FONCTION_CREER_LISTE_SALLES_PATH);

                    $listeSalles = creerListeSalles();

                    foreach ($listeSalles as $nomSalle => $uneSalle) {
                        print("
                            <tr>
                            <td>
                        ");


                        // Afficher le nom de la salle
                        print("{$uneSalle->getNom()}");
                        print("
                            </td>
                            <td>
                        ");


                        // Afficher le voisin de la salle
                        if ($uneSalle->getMonVoisin() != null) {
                            print("{$uneSalle->getMonVoisin()->getNom()}");
                        }
                        print("
                            </td>
                            <td>
                        ");


                        // Afficher si le plan existe ou non
                        if ($uneSalle->getMonPlan() != null) {
                            print("<i class=\"fa-solid fa-circle text-success\"></i> ");
                        } else {
                            print("<i class=\"fa-solid fa-circle text-danger\"></i>");
                        }
                        print("

                            </td>
                            <td>
                        ");

                        // Afficher les actions de la salle
                        if ($uneSalle->getMonPlan() != null) {
                            print(" <a href=\"".PAGE_PLAN_SALLE_PATH."&nom=".$uneSalle->getNom()."\" class=\"btn btn-primary\">Aperçu</a>");
                        }
                        print(" <a href=\".PAGE_MODIFIER_SALLE_PATH.\" class=\"btn btn-primary\">Modifier salle</a>");
                        print(" <a href=\".PAGE_MODIFIER_SALLE_PATH.\" class=\"btn btn-primary\">Supprimer salle</a>");
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