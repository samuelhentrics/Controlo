    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Controlo</title>
        <?php include("config.php"); ?>
        <link href="<?php echo $CSS_FOLDER; ?>bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
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
                Contenu
                <?php echo $PATH; ?>
            </div>
        </div>

        <footer>
            Controlo | Mentions Légales | Politique de Confidentialité
        </footer>

        <!-- Javascript -->
        <script src="<?php echo $JS_FOLDER; ?>jquery.min.js"></script>
        <script src="<?php echo $JS_FOLDER; ?>bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
    </body>

    </html>