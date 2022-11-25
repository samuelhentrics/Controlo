    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Controlo</title>
        <?php include("config.php"); ?>
        <link href="<?php echo $CSS_FOLDER; ?>bootstrap.min.css" rel="stylesheet" >
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
                $i ='controle';
                switch ($i) {
                    case 'controle':
                        // echo "<h1> Affichage Controle </h1>";
                        afficherControle();
                        break;
                    case 1:
                        echo "i égal 1";
                        break;
                    case 2:
                        echo "i égal 2";
                        break;
                }

                function afficherControle(){
                    include("config.php");
                    echo '<main>
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
                             <tbody>';
                                include($FONCTION_CREER_LISTE_CONTROLES);
                                include($FONCTION_AJOUTER_MINUTES_HEURE);
                                
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
                                    echo '
                            </tbody>
                        </table>
            
                    </section>
                </main>';
                }
                ?>
                
            </div>
        </div>

        <footer>
            Controlo | Mentions Légales | Politique de Confidentialité
        </footer>

        <!-- Javascript -->
        <script src="<?php echo $JS_FOLDER; ?>jquery.min.js"></script>
        <script src="<?php echo $JS_FOLDER; ?>bootstrap.bundle.min.js">
        </script>
    </body>

    </html>