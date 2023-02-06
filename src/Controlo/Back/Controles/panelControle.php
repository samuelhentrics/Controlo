<div class="container">
    <div class="col-12">
        <br>

        <?php
        echo "<div class='alert alert-warning' role='alert'>";
        echo "Cette page est en cours de développement.<br>";
        echo "Certaines fonctionnalités ne sont pas encore disponibles.<br>";
        echo "Les fonctions disponibles sont en bleues/rouges et les fonctions non disponibles sont en grises.";
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


            echo '<div class="container-fluid">';
            echo '
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <form id="modifier" action="'.PAGE_MODIFIER_CONTROLE_PATH.'" method="POST">
                                <input type="hidden" name="idControle" value="'.$idControle.'">
                                <a onClick="document.getElementById(\'modifier\').submit();">
                                    <div class="card text-white bg-primary text-center">
                                        <div class="card-body text-center">
                                        <i class="fa fa-pen fa-5x"></i><br>
                                        <h5> Editer les informations du contrôle </h5>
                                        </div>
                                    </div>
                                </a>
                            </form>

                            <form id="supprimer" action="'.PAGE_SUPPRIMER_CONTROLE_PATH.'" method="POST">
                                <input type="hidden" name="idControle" value="'.$idControle.'">
                                <a onClick="document.getElementById(\'supprimer\').submit();">
                                    <div class="card text-white bg-danger text-center">
                                        <div class="card-body text-center">
                                            <p class="card-text">
                                            <i class="fa fa-trash fa-3x"></i><br>
                                            <h5>Supprimer le contrôle</h5>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </form>


                        </div>
                        
                        <div class="col-md-4">
                            <form id="placerAuto" action="'.PAGE_PLACEMENT_AUTO_PATH.'" method="POST">
                                <input type="hidden" name="idControle" value="'.$idControle.'">
                                <a onClick="document.getElementById(\'placerAuto\').submit();">
                                    <div class="card text-white bg-primary text-center">
                                        <div class="card-body">
                                            <p class="card-text">
                                                <i class="fa fa-wand-magic fa-3x"></i><br>
                                                <h5>Placer automatiquement</h5>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </form>
                            

                            <div class="card bg-secondary">
                                <div class="card-body text-center">
                                    <p class="card-text">
                                        <i class="fa-solid fa-wand-magic fa-3x"></i>
                                        <h5>Placer manuellement</h5>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                        <h5> <i class="fa fa-download fa-2x"></i> Télécharger feuille d\'émargement</h5>   
                                </div>
                            </div>

                            <form id="telechargerPDP" action="'.PAGE_TELECHARGER_PDP_CONTROLE_PATH .'" method="POST">
                                <input type="hidden" name="idControle" value="'.$idControle.'">
                                <a onClick="document.getElementById(\'telechargerPDP\').submit();">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <h5>
                                            <i class="fa fa-download fa-2x"></i>
                                            Télécharger plans de placement
                                            </h5>
                                        </div>
                                    </div>
                                </a>
                            </form>


                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <h5>
                                        <i class="fa fa-envelope fa-2x"></i>
                                        Envoyer un mail aux étudiants
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            echo '</div>';

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