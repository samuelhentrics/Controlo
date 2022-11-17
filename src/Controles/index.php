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
                        <th>Promotion(s)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("../rsc/fonctions/creationObjets/creerListeControles.php");
                    include("../rsc/fonctions/ajouterMinutesHeure.php");

                    $listeControles = creerListeControles();

                    for ($i = 0; $i <= count($listeControles) - 1; $i++) {
                        // Nom long du contrôle
                        print("<tr>
                            <td>
                                {$listeControles[$i]->getNomLong()}
                            </td>
                        <td>");

                        // Date du contrôle
                        if ($listeControles[$i]->getDate()!=null){
                            print("{$listeControles[$i]->getDate()}");
                        }
                        else{
                            print("Non définie");
                        }

                        print("</td>
                            <td>");

                        // Heure Non TT
                        if ($listeControles[$i]->getHeureNonTT() != null) {
                            echo $listeControles[$i]->getHeureNonTT(), "-", ajouterMinutesHeure($listeControles[$i]->getHeureNonTT(), $listeControles[$i]->getDureeNonTT());
                        } else {
                            print("Non définie");
                        }

                        print("</td>
                            <td>");

                        // Heure TT
                        if ($listeControles[$i]->getHeureTT() != null) {
                            echo $listeControles[$i]->getHeureTT(), "-", ajouterMinutesHeure($listeControles[$i]->getHeureTT(), $listeControles[$i]->getDuree());
                        } else {
                            print("Non définie");
                        }

                        print("</td>
                            <td>");

                        // Promotions du contrôles
                        print("Pas encore programmé");

                        print("</td>
                            <td>");

                        // Bouton pour Générer

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