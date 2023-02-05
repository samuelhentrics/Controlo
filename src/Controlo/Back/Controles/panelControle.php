<div class="container">
    <div class="col-12">
        <br>

        <?php
        echo "<div class='alert alert-warning' role='alert'>";
        echo "Cette page est en cours de développement.";
        echo "</div>";

        if (isset($_POST["idControle"])) {
            include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
            include_once(FONCTION_AJOUTER_MINUTES_HEURE_PATH);

            // Préparation infos contrôle

            $idControle = $_POST["idControle"];
            $unControle = recupererUnControle($idControle);

            $nomControle = $unControle->getNomLong();
            $nomCourt = $unControle->getNomCourt();
            $date = $unControle->getDate();
            $heureNonTT = $unControle->getHeureNonTT();
            $dureeNonTT = $unControle->getDureeNonTT();

            $infoHeureNonTT = "Non renseignée";
            if($heureNonTT != null && $dureeNonTT != null){
                $infoHeureNonTT = $heureNonTT . " - " . ajouterMinutesHeure($heureNonTT, $dureeNonTT);
            }

            $heureTT = $unControle->getHeureTT();
            $dureeTT = $unControle->getDuree();

            $infoHeureTT = "Non renseignée";
            if($heureTT != null && $dureeTT != null){
                $infoHeureTT = $heureTT . " - " . ajouterMinutesHeure($heureTT, $dureeTT);
            }

            $listePromotions = $unControle->getMesPromotions();

            $promotions = "";
            if($listePromotions != null){
                foreach ($listePromotions as $unePromotion) {
                    $promotions .= $unePromotion->getNom() . ", ";
                }
                $promotions = substr($promotions, 0, -2);
            }
            else {
                $promotions = "Non renseignée";
            }

            // Enseignants ref
            // Enseignants surveillants
        
            $salles = "";
            $listeSalles = $unControle->getMesSalles();
            if ($listeSalles != null) {
                foreach ($listeSalles as $uneSalle) {
                    $salles .= $uneSalle->getNom() . ", ";
                }
                $salles = substr($salles, 0, -2);
            }
            else {
                $salles = "Non renseignée";
            }


            // Affichage

            // Centrer les infos du contrôle
            echo "<div class='text-center'>";
            echo "<h2>$nomControle</h2>";
            echo "<h3>$nomCourt</h3>";

            // Afficher les informations du contrôle
            echo "<a>
            Date : $date - Heure : $infoHeureNonTT - TT : $infoHeureTT - Promotion(s) : $promotions<br>
            Enseignant(s) référent(s) : ...   Enseignant(s) surveillant(s) : ...<br>
            Salles : $salles
            
            </a>";

            echo "</div>";

            // Afficher les informations du contrôle
            echo "<div class='alert alert-primary' role='alert'>";
            echo "<h4>Informations du contrôle</h4>";
            echo "<p>";
            echo "Nom long : ", $unControle->getNomLong(), "<br>";
            echo "Nom court : ", $unControle->getNomCourt(), "<br>";
            echo "Date : ", $unControle->getDate(), "<br>";
            echo "</p>";

        }
        else {
            // Afficher un message d'erreur (boostrap)
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Aucun contrôle n'a été sélectionné.<br>";
            echo "Veuillez sélectionner un contrôle dans la liste des contrôles.<br>";
            echo "Si le problème persiste, veuillez contacter l'administrateur du site.";
            echo "</div>";

        }

    ?>

    </div>
</div>