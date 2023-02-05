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
    <script src="<?php echo JS_PATH; ?>bootstrap.bundle.min.js"></script>
    <script src="<?php echo JS_PATH; ?>jquery.min.js"></script>
    <script src="<?php echo JS_PATH; ?>jquery.dataTables.min.js"></script>
    <script src="<?php echo JS_PATH; ?>datatables.bootstrap5.js"></script>

</head>

<body>
    <?php require(BACK_PATH . "header.php"); ?>


    <?php

    // Retirer les messages d'erreur PHP (par défaut on est en mode dév)
    //ini_set('display_errors', 'off');
    
    // Traiter la demande de page
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {

            // Cas ou l'utilisateur souhaite ajouter une promotion
            case 'promotions':
                if (isset($_GET["action"])) {
                    $action = $_GET["action"];
                    switch ($action) {
                        case "ajouter":
                            require(BACK_PATH . "Promotions/ajouterPromotion.php");
                            break;

                        case "modifier":
                            require(BACK_PATH . "Promotions/modifierPromotion.php");
                            break;

                        case "supprimer":
                            require(BACK_PATH . "Promotions/supprimerPromotion.php");
                            break;

                        default:
                            require(BACK_PATH . "404.php");
                            break;
                    }
                } else {
                    require(BACK_PATH . "Promotions/listePromotions.php");
                }

                break;


            // Cas où l'utilisateur souhaite voir la liste des contrôles
            case 'controles':
                if (isset($_GET["action"])) {
                    $action = $_GET["action"];
                    switch ($action) {
                        case "panel":
                            require(BACK_PATH . "Controles/panelControle.php");
                            break;

                        case "ajouter":
                            require(BACK_PATH . "Controles/ajouterControle.php");
                            break;

                        case "modifier":
                            require(BACK_PATH . "Controles/modifierControle.php");
                            break;

                        case "supprimer":
                            require(BACK_PATH . "Controles/supprimerControle.php");
                            break;

                        default:
                            require(BACK_PATH . "404.php");
                            break;
                    }
                } else {
                    require(BACK_PATH . "Controles/listeControles.php");
                }
                break;

            case 'choixGeneration':
                require(BACK_PATH . "Controles/choixGeneration.php");
                break;

            // Générer les plans de placement
            case 'generer':
                require(IMPORT_PATH . "generer.php");
                break;

            // Page de résultat de génération plans de placement
            case 'resultat':
                require(BACK_PATH . "Controles/resultat.php");
                break;



            // Cas où l'utilisateur souhaite s'occuper des étudiants
            case 'etudiants':
                if (isset($_GET['action'])) {
                    // Cas où l'utilisateur veut ajouter un étudiant
                    if ($_GET['action'] == "ajouter") {
                        require(BACK_PATH . "Etudiants/ajouterEtudiant.php");
                    }
                    // Cas où l'utilisateur veut modifier un étudiant
                    else if ($_GET['action'] == "modifier") {
                        require(BACK_PATH . "Etudiants/modifierEtudiant.php");
                    }
                    // Cas où l'utilisateur veut supprimer un étudiant
                    else if ($_GET['action'] == "supprimer") {
                        require(BACK_PATH . "Etudiants/supprimerEtudiant.php");
                    }
                    // Cas où une action n'est pas reconnue
                    else {
                        require(BACK_PATH . "404.php");
                    }
                }
                // Cas où il veut voir la liste des étudiants
                else {
                    require(BACK_PATH . "Etudiants/listeEtudiants.php");
                }
                break;

            case 'enseignants':
                if (isset($_GET['action'])) {
                    // Cas où l'utilisateur veut ajouter un enseignant
                    if ($_GET['action'] == "ajouter") {
                        require(BACK_PATH . "Enseignants/ajouterEnseignant.php");
                    }
                    // Cas où l'utilisateur veut modifier un enseignant
                    else if ($_GET['action'] == "modifier") {
                        require(BACK_PATH . "Enseignants/modifierEnseignant.php");
                    }
                    // Cas où l'utilisateur veut supprimer un enseignant
                    else if ($_GET['action'] == "supprimer") {
                        require(BACK_PATH . "Enseignants/supprimerEnseignant.php");
                    }
                    // Cas où une action n'est pas reconnue
                    else {
                        require(BACK_PATH . "404.php");
                    }
                }
                // Cas où il veut voir la liste des enseignants
                else {
                    require(BACK_PATH . "Enseignants/listeEnseignants.php");
                }
                break;

            // Cas où l'utilisateur souhaite voir la liste des salles
            case 'salles':
                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                    switch ($action) {
                        case "modifier":
                            require(BACK_PATH . "Salles/planSalle.php");
                            break;
                        case "ajouter":
                            require(BACK_PATH . "Salles/ajouterSalle.php");
                            break;
                        case "ajouter2":
                            require(BACK_PATH . "Salles/creerPlanDeSalle.php");
                            break;
                        case "importer":
                            require(BACK_PATH . "Salles/planSalle.php");
                            break;
                        case "plan":
                            require(BACK_PATH . "Salles/planSalle.php");
                            break;
                        default:
                            require(BACK_PATH . "404.php");
                            break;
                    }
                }
                // Ou plus précisement le plan d'une salle
                else {
                    require(BACK_PATH . "Salles/salles.php");
                }
                break;



            // Mode développement
            case 'test':
                require(BACK_PATH . "test.php");
                break;



            case 'politiqueDeConfidentialite':
                require(BACK_PATH . "politiqueDeConfidentialite.php");
                break;

            case 'mentionsLegales':
                require(BACK_PATH . "mentionsLegales.php");
                break;

            case 'manuelUtilisateur':
                require(BACK_PATH . "manuelUtilisateur.php");
                break;

            default:
                // Cas où la demande est incorrecte, on retourne un message 404
                require(BACK_PATH . "404.php");
                break;
        }
    } else
        // Cas où l'utilisateur est sur la page d'accueil
        require(BACK_PATH . "accueil.php");


    ?>

    <?php require(BACK_PATH . "footer.php"); ?>

</body>

</html>