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
                    [0, 'asc']
                ]

            });
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        </script>
        <section>
            <div class="row">
                <div class="col-8">
                    <h1>Liste des salles</h1>
                </div>
                <div class="col-4 text-end">
                    <a href="<?php echo PAGE_AJOUTER_SALLE_PATH; ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Ajouter
                    </a>
                    <a href="<?php echo PAGE_IMPORTER_SALLE_PATH; ?>" class="btn btn-primary">
                        <i class="fas fa-file-import"></i>
                        Importer
                    </a>
                </div>
            </div>

            <table id="salles" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom de la Salle</th>
                        <th>Salle voisine</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include(FONCTION_CREER_LISTE_SALLES_PATH);

                    $listeSalles = creerListeSalles();

                    foreach ($listeSalles as $uneSalle) {
                        $nomSalle = $uneSalle->getNom();

                        print("
                            <tr>
                            <td>
                        ");


                        // Afficher le nom de la salle
                        print($nomSalle);
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
                            <td class='text-center'>
                        ");

                        // Afficher les actions de la salle
                        if ($uneSalle->getMonPlan() != null) {
                            print("
                            <form style='display:inline;' method=\"post\" action=" . PAGE_PLAN_SALLE_PATH . ">
                                <input type=\"hidden\" name=\"nomSalle\" value=\"".$nomSalle."\">
                                <button type=\"submit\" class=\"btn btn-primary\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Visualiser\">
                                    <i class=\"fas fa-eye\"></i>
                                </button>
                            </form>      
                        ");
                        }
                        print("
                        
                            <form  style='display:inline;' method=\"post\" action=" . PAGE_MODIFIER_SALLE_PATH . ">
                                <input type=\"hidden\" name=\"nomSalle\" value=\"$nomSalle\">
                                <button type=\"submit\" class=\"btn btn-primary\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Modifier\">
                                    <i class=\"fas fa-edit\"></i>
                                </button>
                            </form>
                            <form style='display:inline;' method=\"post\" action=" . PAGE_SUPPRIMER_SALLE_PATH . ">
                                <input type=\"hidden\" name=\"nomSalle\" value=\"" . $nomSalle . "\">

                                <button type=\"submit\" onclick=\"return confirm('Confirmer la suppression de: ".$nomSalle."')\" name=\"action\" class=\"btn btn-danger\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Supprimer\">
                                    <i class=\"fas fa-trash-alt\"></i>
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