<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil | Controlo</title>
</head>

<body>
    <header>
        <img src="img/logo.png" alt="Logo de Controlo">
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="controles.php">Controles</a></li>
                <li><a href="etudiants.php">Etudiants</a></li>
                <li><a href="salles.php">Salles</a></li>
                <li><a href="promotions.php">Promotions</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h1>Bienvenue sur Controlo</h1>

            <p>Bienvenue sur Controlo, cette plateforme permet de générer actuellement des plans de placement pour des
                contrôles.</p>

            <p>Dans le dossier <strong>/CSV/controles</strong>, le fichier liste_controle.csv contient la liste des
                contrôles.<br>
                Dans le dossier <strong>/CSV/etudiants</strong>, chaque fichier csv contiennent une promotion (le nom de
                la promotion est celle du fichier).<br>
                Dans le dossier <strong>/CSV/salles</strong>, le fichier liste_salles.csv contient la liste des salles
                ainsi que la salle voisine d'une salle si celle-ci existe.<br>
                Dans le dossier <strong>/CSV/plansSalles</strong>, chaque fichier csv contiennent le plan d'une salle
                (le nom de la salle est celle du fichier).</p>

            <p>Chaque plan de placement d'un controle se retrouve dans le dossier
                <strong>/PlansDePlacement/NOM_DU_CONTROLE</strong> au format PDF.
            </p>


            <p>Lien Github du projet : <a
                    href="https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet">https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet</a>
            </p>
        </section>
    </main>
    <footer>
        <p>© 2022 Controlo | <a href="mentions_legales.php">Mentions Légales</a> | <a
                href="politique_confidentialite.php">Politique de confidentialité</a></p>
    </footer>
</body>

</html>