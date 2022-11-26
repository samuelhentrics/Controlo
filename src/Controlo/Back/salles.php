<div class="container">
    <div class="col-12">
        <br>

        <script>
        var lien = "<?php echo $JS_PATH ?>";
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
            <table id="salles" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom de la Salle</th>
                        <th>Salle voisine</th>
                        <th>Etat du plan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include($FONCTION_CREER_LISTE_SALLES_PATH);

                    $listeSalles = creerListeSalles();

                    for ($i = 0; $i <= count($listeSalles) - 1; $i++) {
                        print("
                            <tr>
                            <td>
                        ");


                        // Afficher le nom de la salle
                        print("{$listeSalles[$i]->getNom()}");
                        print("
                            </td>
                            <td>
                        ");


                        // Afficher le voisin de la salle
                        if ($listeSalles[$i]->getMonVoisin() != null) {
                            print("{$listeSalles[$i]->getMonVoisin()->getNom()}");
                        }
                        print("
                            </td>
                            <td>
                        ");


                        // Afficher si le plan existe ou non
                        if ($listeSalles[$i]->getMonPlan() != null) {
                            print("Plan existant");
                        } else {
                            print("Plan inexistant");
                        }
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