<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include("../rsc/template/head2.php");
    ?>
    <script>
        $(document).ready(function() {
            $('#salles').DataTable({
                "language": {
                    "url": "../rsc/js/French.json"
                }
            });
        });
    </script>
    <title>Salles - Controlo</title>
</head>

<body>
    <?php
    include("../rsc/template/header2.php");
    ?>
    <main>
        <section>
        <h1>Liste des salles</h1>
            <table id="salles" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom de la Salle</th>
                        <th>Salle voisine</th>
                        <th>Etat du plan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include("../rsc/fonctions/creationObjets/creerListeSalles.php");

                        $listeSalles = creerListeSalles();

                        for ($i = 0; $i <= count($listeSalles)-1; $i++){
                            print("<tr>
                            <td>");

                            // Afficher le nom de la salle
                            echo $listeSalles[$i]->getNom();

                            print("</td>
                            <td>");

                            // Afficher le voisin de la salle
                            if ($listeSalles[$i]->getMonVoisin() != null){
                                echo $listeSalles[$i]->getMonVoisin()->getNom();
                            }

                            print("</td>
                            <td>");
                            // Afficher si le plan existe ou non
                            if ($listeSalles[$i]->getMonPlan() != null){
                                echo "Plan existant";
                            }
                            else{
                                echo "Plan inexistant";
                            }

                            print("</td>
                            </tr>");
                        }
                    ?>
                    
                </tbody>
            </table>
        </section>
    </main>
    <?php
    include("../rsc/template/footer2.php");
    ?>
</body>

</html>