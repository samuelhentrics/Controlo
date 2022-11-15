<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
        include("rsc/template/head.php");
    ?>
    <title>Accueil | Controlo</title>
</head>

<body>
    <?php
        include("rsc/template/header.php");
    ?>
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
                <strong>/PlansPlacement/NOM_DU_CONTROLE</strong> au format PDF.
            </p>


            <p>Lien Github du projet : <a
                    href="https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet">https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet</a>
            </p>
        </section>
    </main>
    <?php
        include("rsc/template/footer.php");
    ?>
</body>

</html>