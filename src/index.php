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
        <link href="<?php echo CSS_PATH; ?>fontawesome.css" rel="stylesheet">
        <link href="<?php echo CSS_PATH; ?>brands.css" rel="stylesheet">
        <link href="<?php echo CSS_PATH; ?>solid.css" rel="stylesheet">

        <!-- Javascript -->
        <script src="<?php echo JS_PATH; ?>popper.min.js"></script>
        <script src="<?php echo JS_PATH; ?>bootstrap.min.js"></script>
        <script src="<?php echo JS_PATH; ?>jquery.min.js"></script>
        <script src="<?php echo JS_PATH; ?>jquery.dataTables.min.js"></script>
        <script src="<?php echo JS_PATH; ?>datatables.bootstrap5.js"></script>       

    </head>

    <body>
        <?php require(BACK_PATH."header.php"); ?>


        <?php

            // Retirer les messages d'erreur PHP (par défaut on est en mode dév)
            //ini_set('display_errors', 'off');

            // Traiter la demande de page
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
   
                switch ($page) {
                    // Cas où l'utilisateur souhaite voir la liste des contrôles
                    case 'controles':
                        require(BACK_PATH."controles.php");
                        # code...
                        break;

                    case 'choixGeneration':
                        require(BACK_PATH."choixGeneration.php");
                        # code...
                        break;


                    // Cas où l'utilisateur souhaite voir la liste des étudiants
                    case 'etudiants':
                        require(BACK_PATH."etudiants.php");
                        break;
                    
                    // Cas où l'utilisateur souhaite voir la liste des salles
                    case 'salles':
                        if (isset($_GET['salle'])) {
                            require(BACK_PATH."planSalle.php");
                        }
                        // Ou plus précisement le plan d'une salle
                        else{
                            require(BACK_PATH."salles.php");
                        }
                        break;

                    // Mode développement
                    case 'test':
                        require(BACK_PATH."test.php");
                        break;

                    // Générer les plans de placement
                    case 'generer':
                        require(IMPORT_PATH."generer.php");
                        break;

                    // Page de résultat de génération plans de placement
                    case 'resultat':
                        require(BACK_PATH."resultat.php");
                        break;


                    default:
                    // Cas où la demande est incorrecte, on retourne un message 404
                        require(BACK_PATH."404.php");
                        break;
                }
            }
            else 
            // Cas où l'utilisateur est sur la page d'accueil
            require(BACK_PATH."accueil.php");


        ?>

        <?php require(BACK_PATH."footer.php"); ?>

    </body>

    </html>