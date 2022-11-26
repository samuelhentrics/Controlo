    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Controlo</title>
        <?php include("config.php"); ?>

        <!-- CSS -->
        <link href="<?php echo $CSS_FOLDER; ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $CSS_FOLDER; ?>datatables.bootstrap5.css" rel="stylesheet">

        <!-- Javascript -->
        <script src="<?php echo $JS_FOLDER; ?>jquery.min.js"></script>
        <script src="<?php echo $JS_FOLDER; ?>jquery.dataTables.min.js"></script>
        <script src="<?php echo $JS_FOLDER; ?>bootstrap.bundle.min.js"></script>
        <script src="<?php echo $JS_FOLDER; ?>datatables.bootstrap5.js"></script>

    </head>

    <body>
        <?php include($BACK_FOLDER."header.php"); ?>

        <div class="container">
            <div class="col-12">
                <br>
                <?php

                // Retirer les messages d'erreur PHP (par défaut on est en mode dév)
                //ini_set('display_errors', 'off');

                // Traiter la demande de page
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];

                    // Cas où l'utilisateur souhaite voir la liste des contrôles
                    if ($page == "controles") {
                        include($BACK_FOLDER."controles.php");
                    }

                    // Cas où l'utilisateur souhaite voir la liste des étudiants
                    else if ($page == "etudiants") {
                        include($BACK_FOLDER."etudiants.php");
                    }

                    // Cas où l'utilisateur souhaite voir la liste des salles
                    else if ($page == "salles") {

                        // Ou plus précisement le plan d'une salle
                        if (isset($_GET['salle'])) {
                            include($BACK_FOLDER."planSalle.php");
                        }

                        else{
                            include($BACK_FOLDER."salles.php");
                        }
                    }

                    // Cas où la demande est incorrecte, on retourne un message 404
                    else {
                        include($BACK_FOLDER."404.php");
                    }
                }
                // Cas où l'utilisateur est sur la page d'accueil
                else {
                    include($BACK_FOLDER."accueil.php");
                }

                ?>

            </div>
        </div>

        <?php include($BACK_FOLDER."footer.php"); ?>

    </body>

    </html>