<?php
session_start();
include("config.php");
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controlo</title>

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
    <script src="<?php echo JS_PATH; ?>controlo.js"></script>
</head>

<body>
    <?php 
    // Retirer les messages d'erreur PHP (par défaut on est en mode dév)
    // ini_set('display_errors', 'off');
    include_once(IMPORT_PATH."connexion.php");

    require(BACK_PATH . "header.php"); 

    $demandePageConnexion = false;


    // Traiter la demande de page
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $estConnecte = estConnecte();
        if($estConnecte)
            $role = $_SESSION["role"];

        switch ($page) {

            // Cas ou l'utilisateur souhaite ajouter une promotion
            case 'promotions':
                // Vérifier si l'utilisateur est connecté
                if (!$estConnecte) {
                    $demandePageConnexion = true;
                    break;
                }

                if (isset($_GET["action"])) {
                    $action = $_GET["action"];
                    switch ($action) {
                        case "ajouter":
                            require(BACK_PATH . "Promotions/ajouterPromotion.php");
                            break;

                        case "importer":
                            require(BACK_PATH. "Promotions/importerPromotion.php");
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
                // Vérifier si l'utilisateur est connecté
                if (!$estConnecte) {
                    $demandePageConnexion = true;
                    break;
                }

                if (isset($_GET["action"])) {
                    $action = $_GET["action"];
                    switch ($action) {
                        case "panel":
                            require(BACK_PATH . "Controles/panelControle.php");
                            break;

                        case "ajouter":
                            require(BACK_PATH . "Controles/ajouterControle.php");
                            break;
                        case "importer":
                            require(BACK_PATH . "Controles/importerControle.php");
                            break;

                        case "modifier":
                            require(BACK_PATH . "Controles/modifierControle.php");
                            break;

                        case "supprimer":
                            require(BACK_PATH . "Controles/supprimerControle.php");
                            break;

                        case "placementAuto":
                            require(BACK_PATH . "Controles/placementAuto.php");
                            break;

                        case "telechargerPDP":
                            require(BACK_PATH . "Controles/telechargerPDP.php");
                            break;

                        case "genererFE":
                            require(BACK_PATH . "Controles/genererFE.php");
                            break;

                        case "telechargerFE":
                            require(BACK_PATH . "Controles/telechargerFE.php");
                            break;

                        case "envoyerMails":
                            require(BACK_PATH . "Controles/envoyerMails.php");
                            break;

                        default:
                            require(BACK_PATH . "404.php");
                            break;
                    }
                } else {
                    require(BACK_PATH . "Controles/listeControles.php");
                }
                break;



            // Cas où l'utilisateur souhaite s'occuper des étudiants
            case 'etudiants':
                // Vérifier si l'utilisateur est connecté
                if (!$estConnecte) {
                    $demandePageConnexion = true;
                    break;
                }

                if (isset($_GET['action'])) {
                    $action = $_GET["action"];
                    switch ($action) {
                        case "ajouter":
                            require(BACK_PATH . "Etudiants/ajouterEtudiant.php");
                            break;

                        case "modifier":
                            require(BACK_PATH . "Etudiants/modifierEtudiant.php");
                            break;

                        case "supprimer":
                            require(BACK_PATH . "Etudiants/supprimerEtudiant.php");
                            break;

                        default:
                            require(BACK_PATH . "404.php");
                            break;
                    }
                }
                // Cas où il veut voir la liste des étudiants
                else {
                    require(BACK_PATH . "Etudiants/listeEtudiants.php");
                }
                break;

            case 'enseignants':
                // Vérifier si l'utilisateur est connecté
                if (!$estConnecte) {
                    $demandePageConnexion = true;
                    break;
                }

                if (isset($_GET['action'])) {
                    $action = $_GET["action"];
                    switch ($action) {
                        case "ajouter":
                            require(BACK_PATH . "Enseignants/ajouterEnseignant.php");
                            break;

                        case "modifier":
                            require(BACK_PATH . "Enseignants/modifierEnseignant.php");
                            break;

                        case "supprimer":
                            require(BACK_PATH . "Enseignants/supprimerEnseignant.php");
                            break;

                        default:
                            require(BACK_PATH . "404.php");
                            break;
                    }
                }
                // Cas où il veut voir la liste des enseignants
                else {
                    require(BACK_PATH . "Enseignants/listeEnseignants.php");
                }
                break;

            // Cas où l'utilisateur souhaite voir la liste des salles
            case 'salles':
                // Vérifier si l'utilisateur est connecté
                if (!$estConnecte) {
                    $demandePageConnexion = true;
                    break;
                }

                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                    switch ($action) {
                        case "modifier":
                            require(BACK_PATH . "Salles/modifierSalle.php");
                            break;
                        case "ajouter":
                            require(BACK_PATH . "Salles/ajouterSalle.php");
                            break;
                        case "ajouter2":
                            require(BACK_PATH . "Salles/creerPlanDeSalle.php");
                            break;

                        case "supprimer":
                            require(BACK_PATH . "Salles/supprimerSalle.php");
                            break;
                            
                        case "importer":
                            require(BACK_PATH . "Salles/importerSalles.php");
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
                    require(BACK_PATH . "Salles/listeSalles.php");
                }
                break;


            case 'politiqueDeConfidentialite':
                require(BACK_PATH . "politiqueDeConfidentialite.php");
                break;

            case 'mentionsLegales':
                require(BACK_PATH . "mentionsLegales.php");
                break;

            case 'manuelUtilisateur':
                // Vérifier si l'utilisateur est connecté
                if (!$estConnecte) {
                    $demandePageConnexion = true;
                    break;
                }

                require(BACK_PATH . "manuelUtilisateur.php");
                break;


            // Test générer PDP 2
            case 'genererPDP2Test':
                require(BACK_PATH . "genererPDP2Test.php");
                break;

            case 'utilisateurs':
                // Vérifier si l'utilisateur est connecté
                if (!$estConnecte) {
                    $demandePageConnexion = true;
                    break;
                }

                if(isset($_GET['action'])){
                    if($_GET['action'] == "profil"){
                        require(BACK_PATH . "Utilisateurs/profil.php");
                        break;
                    }
                }

                if(!(estSecretaireAdmin() || estAdmin())){
                    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
                    break;
                }

                if (isset($_GET['action'])) {
                    $action = $_GET['action'];
                    switch ($action) {
                        case "modifier":
                            require(BACK_PATH . "Utilisateurs/modifierUtilisateur.php");
                            break;
                        case "ajouter":
                            require(BACK_PATH . "Utilisateurs/ajouterUtilisateur.php");
                            break;
                        case "supprimer":
                            require(BACK_PATH . "Utilisateurs/supprimerUtilisateur.php");
                            break;
                        default:
                            require(BACK_PATH . "404.php");
                            break;
                    }
                }
                else{
                    require(BACK_PATH . "Utilisateurs/listeUtilisateurs.php");
                }
                break;

            case 'login':
                // Vérifier si l'utilisateur est connecté
                if (!$estConnecte){
                require(BACK_PATH . "Connexion/seConnecter.php");
                }
                else{
                    require(BACK_PATH . "accueil.php");
                }
                break;

            case 'logout':
                // Vérifier si l'utilisateur est connecté
                if ($estConnecte) {
                    seDeconnecter();
                    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
                }
                break;

            case '404':
                require(BACK_PATH . "404.php");
                break;

            default:
                // Cas où la demande est incorrecte, on retourne un message 404
                require(BACK_PATH . "404.php");
                break;
        }
    }
    else{
        // Cas où l'utilisateur est sur la page d'accueil
        require(BACK_PATH . "accueil.php");
    }

    if($demandePageConnexion){
        require(BACK_PATH . "Connexion/seConnecter.php");
    }


    require(BACK_PATH . "footer.php");
    

    // Lancement de la sauvegarde
    include_once(IMPORT_PATH."sauvegarde.php");
    sauvegarde();
    ?>

</body>

</html>