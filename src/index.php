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
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo $IMG_FOLDER . 'logo.png'; ?>" alt="Logo de Controlo" height="24" class="d-inline-block align-text-top">
                        Controlo
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarColor01">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo $PATH; ?>">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $CONTROLES; ?>">Controles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $ETUDIANTS; ?>">Etudiants</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $SALLES; ?>">Salles</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <div class="col-12">
                <br>
                <?php
                // Ce switch:
                $i = 'controle';
                switch ($i) {
                    case 'controle':
                        // echo "<h1> Affichage Controle </h1>";
                        include($BACK_FOLDER . "Controles.php");
                        break;
                    case 1:
                        echo "i égal 1";
                        break;
                    case 2:
                        echo "i égal 2";
                        break;
                }
                ?>

            </div>
        </div>

        <footer>
            Controlo | Mentions Légales | Politique de Confidentialité
        </footer>


    </body>

    </html>