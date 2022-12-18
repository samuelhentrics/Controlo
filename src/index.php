    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Controlo</title>
        <?php include("config.php"); ?>

        <!-- CSS -->
        <link href="<?php echo CSS_PATH; ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo CSS_PATH; ?>datatables.bootstrap5.css" rel="stylesheet">

        <!-- Javascript -->
        <script src="<?php echo JS_PATH; ?>jquery.min.js"></script>
        <script src="<?php echo JS_PATH; ?>jquery.dataTables.min.js"></script>
        <script src="<?php echo JS_PATH; ?>bootstrap.bundle.min.js"></script>
        <script src="<?php echo JS_PATH; ?>datatables.bootstrap5.js"></script>
        <script src="https://kit.fontawesome.com/1c7be7f624.js" crossorigin="anonymous"></script>

    </head>

    <body>
        <?php include(BACK_PATH."header.php"); ?>


        <?php

            // Retirer les messages d'erreur PHP (par défaut on est en mode dév)
            //ini_set('display_errors', 'off');

            // Traiter la demande de page
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
   
                switch ($page) {
                    // Cas où l'utilisateur souhaite voir la liste des contrôles
                    case 'controles':
                        include(BACK_PATH."controles.php");
                        # code...
                        break;

                    case 'generer':
                        include(BACK_PATH."generer.php");
                        # code...
                        break;


                    // Cas où l'utilisateur souhaite voir la liste des étudiants
                    case 'etudiants':
                        include(BACK_PATH."etudiants.php");
                        break;
                    
                    // Cas où l'utilisateur souhaite voir la liste des salles
                    case 'salles':
                        if (isset($_GET['salle'])) {
                            include(BACK_PATH."planSalle.php");
                        }
                        // Ou plus précisement le plan d'une salle
                        else{
                            include(BACK_PATH."salles.php");
                        }
                        break;

                    // Mode développement
                    case 'test':
                        include(BACK_PATH."test.php");
                        break;

                    default:
                    // Cas où la demande est incorrecte, on retourne un message 404
                        include(BACK_PATH."404.php");
                        break;
                }
            }
            else 
            // Cas où l'utilisateur est sur la page d'accueil
            include(BACK_PATH."accueil.php");


        ?>

        <?php include(BACK_PATH."footer.php"); ?>

    </body>

    </html>