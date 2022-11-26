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
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == "controles") {
                        include($BACK_FOLDER."controles.php");
                    }
                    else if ($page == "etudiants") {
                        include($BACK_FOLDER."etudiants.php");
                    }
                    else if ($page == "salles") {
                        include($BACK_FOLDER."salles.php");
                    }
                    else {
                        include($BACK_FOLDER."accueil.php");
                    }
                } else {
                    include($BACK_FOLDER."accueil.php");
                }

                ?>

            </div>
        </div>

        <?php include($BACK_FOLDER."footer.php"); ?>

    </body>

    </html>