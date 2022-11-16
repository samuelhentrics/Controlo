<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include("../rsc/template/head2.php");
    ?>
    <script>
        $(document).ready(function() {
            $('#controles').DataTable({
                "language": {
                    "url": "../rsc/js/French.json"
                },

                order: [
                    [1, 'asc'],
                    [2, 'asc']
                ]

            });
        });
    </script>
    <title>Controles - Controlo</title>
</head>

<body>
    <?php
    include("../rsc/template/header2.php");
    ?>
    <main>
        <section>
            <h1>Liste des contrôles</h1>
            <table id="controles" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom long</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Tiers-temps</th>
                        <th>Promotion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("../rsc/fonctions/creationObjets/creerListeControles.php");
                    include("../rsc/fonctions/ajouterMinutesHeure.php");

                    $listeControles = creerListeControles();

                    for ($i = 0; $i <= count($listeControles) - 1; $i++) {
                        print("<tr>
                            <td>");

                        echo $listeControles[$i]->getNomLong();

                        print("</td>
                            <td>");

                        if ($listeControles[$i]->getDate()!=null){
                            echo $listeControles[$i]->getDate();
                        }
                        else{
                            echo "Non définie";
                        }


                        print("</td>
                            <td>");

                        if ($listeControles[$i]->getHeureNonTT() != null) {
                            echo $listeControles[$i]->getHeureNonTT(), "-", ajouterMinutesHeure($listeControles[$i]->getHeureNonTT(), $listeControles[$i]->getDureeNonTT());
                        } else {
                            echo "Non définie";
                        }

                        print("</td>
                            <td>");

                        if ($listeControles[$i]->getHeureTT() != null) {
                            echo $listeControles[$i]->getHeureTT(), "-", ajouterMinutesHeure($listeControles[$i]->getHeureTT(), $listeControles[$i]->getDuree());
                        } else {
                            echo "Non définie";
                        }

                        print("</td>
                            <td>");

                        echo "Pas encore programmé";

                        print("</td>
                            <td>");


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