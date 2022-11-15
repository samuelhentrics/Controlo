<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    include("../rsc/template/head2.php");
    ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="css/datatables.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/datatables.js"></script>
    <script>
        $(document).ready(function() {
            $('#controles').DataTable({
                "language": {
                    "url": "js/French.json"
                }
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
                    <tr>
                        <td>R2.03 Qualité de développement</td>
                        <td>09/03/2022</td>
                        <td>14h30-16h00</td>
                        <td>14h00-16h00</td>
                        <td>BUT INFO S2</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>R2.10 Gestion de projet</td>
                        <td>10/03/2022</td>
                        <td>16h30-18h00</td>
                        <td>16h30-18h00</td>
                        <td>BUT INFO S2</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>R2.11 Droits des contrats et du numérique</td>
                        <td>11/03/2022</td>
                        <td>15h30-17h00</td>
                        <td>15h30-17h30</td>
                        <td>BUT INFO S2</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </section>
    </main>
    <?php
    include("../rsc/template/footer2.php");
    ?>
</body>

</html>