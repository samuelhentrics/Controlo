<div class="container">
    <div class="col-12">
        <br>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
        <?php

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
            if ($heureNonTT != null && $dureeNonTT != null) {
                $infoHeureNonTT = $heureNonTT . " - " . ajouterMinutesHeure($heureNonTT, $dureeNonTT);
            }

            $heureTT = $unControle->getHeureTT();
            $dureeTT = $unControle->getDuree();

            $infoHeureTT = "Non renseignée";
            if ($heureTT != null && $dureeTT != null) {
                $infoHeureTT = $heureTT . " - " . ajouterMinutesHeure($heureTT, $dureeTT);
            }

            $listePromotions = $unControle->getMesPromotions();

            $promotions = "";
            if ($listePromotions != null) {
                foreach ($listePromotions as $unePromotion) {
                    $promotions .= $unePromotion->getNom() . ", ";
                }
                $promotions = substr($promotions, 0, -2);
            } else {
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
            } else {
                $salles = "Non renseignée";
            }

            $enseignantsRef = "";
            $listeEnseignantsRef = $unControle->getMesEnseignantsReferents();
            if ($listeEnseignantsRef != null) {
                foreach ($listeEnseignantsRef as $unEnseignantRef) {
                    $enseignantsRef .= $unEnseignantRef . ", ";
                }
                $enseignantsRef = substr($enseignantsRef, 0, -2);
            } else {
                $enseignantsRef = "Non renseignée";
            }

            $enseignantsSurveillants = "";
            $listeEnseignantsSurveillants = $unControle->getMesEnseignantsSurveillants();
            if ($listeEnseignantsSurveillants != null) {
                foreach ($listeEnseignantsSurveillants as $unEnseignantSurveillant) {
                    $enseignantsSurveillants .= $unEnseignantSurveillant . ", ";
                }
                $enseignantsSurveillants = substr($enseignantsSurveillants, 0, -2);
            } else {
                $enseignantsSurveillants = "Non renseignée";
            }



            // Affichage
        
            // Centrer les infos du contrôle
            echo "<div class='text-center'>";
            echo "<h2>$nomControle";
            // Etat du controle
        
            // Etat des PDP
            switch ($unControle->getEtatPDP()) {
                case 0:
                    print('
                    <i class="fa-solid fa-circle text-danger"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="' . $unControle->infoManquant() . '">
                    </i>
                    ');
                    break;

                case 1:
                    print('
                    <i class="fa-solid fa-circle text-warning"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="Plans de placement générables">
                    </i>
                    ');
                    break;

                case 2:
                    print('
                    <i class="fa-solid fa-circle text-success"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="Plans de placement générés">
                    </i>
                    ');
                    break;
            }

            // Etat des FE
            switch ($unControle->getEtatFE()) {
                case 0:
                    print('
                    <i class="fa-solid fa-circle text-danger"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="Feuilles d\'émargement non générables">
                    </i>
                    ');
                    break;

                case 1:
                    print('
                    <i class="fa-solid fa-circle text-warning"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="Feuilles d\'émargement générables">
                    </i>
                    ');
                    break;

                case 2:
                    print('
                    <i class="fa-solid fa-circle text-success"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="Feuilles d\'émargement générées">
                    </i>
                    ');
                    break;
            }

            // Etat des mails
            switch ($unControle->getEtatMail()) {
                case 0:
                    print('
                    <i class="fa-solid fa-circle text-danger"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="Mails non envoyés">
                    </i>
                    ');
                    break;

                case 1:
                    print('
                    <i class="fa-solid fa-circle text-warning"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="Mails envoyables">
                    </i>
                    ');
                    break;

                case 2:
                    print('
                    <i class="fa-solid fa-circle text-success"
                        data-toggle="tooltip"
                        data-bs-html="true"
                        title="Mails envoyés">
                    </i>
                    ');
                    break;
            }

            echo "</h2>";
            echo "<h3>$nomCourt</h3>";


            // Afficher les informations du contrôle
            echo "<a>
            Date : $date - Heure : $infoHeureNonTT - TT : $infoHeureTT - Promotion(s) : $promotions<br>
            Enseignant(s) référent(s) : $enseignantsRef - Enseignant(s) surveillant(s) : $enseignantsSurveillants<br>
            Salles : $salles
            
            </a>";

            echo "</div>";


            echo '<div class="container-fluid">';
            echo '
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <form id="modifier" action="' . PAGE_MODIFIER_CONTROLE_PATH . '" method="POST">
                                <input type="hidden" name="idControle" value="' . $idControle . '">
                                <a onClick="document.getElementById(\'modifier\').submit();">
                                    <div class="card text-white bg-primary text-center">
                                        <div class="card-body text-center">
                                        <i class="fa fa-pen fa-3x"></i><br>
                                        <h5> Editer les informations du contrôle </h5>
                                        </div>
                                    </div>
                                </a>
                            </form>

                            <form id="supprimer" action="' . PAGE_SUPPRIMER_CONTROLE_PATH . '" method="POST">
                                <input type="hidden" name="idControle" value="' . $idControle . '">
                                <a onClick="
                                if(confirm(\'Confirmer la suppression de: ' . $nomControle . ' ?\')){ 
                                    document.getElementById(\'supprimer\').submit();
                                }
                                ">
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
                            <form id="placerAuto" action="' . PAGE_PLACEMENT_AUTO_PATH . '" method="POST">
                                <input type="hidden" name="idControle" value="' . $idControle . '">
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
                                        <i class="fa fa-chalkboard-user fa-3x"></i>
                                        <h5>Générer feuilles d\'émargement</h5>
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5">
                        
                            <form id="telechargerPDP" action="' . PAGE_TELECHARGER_PDP_CONTROLE_PATH . '" method="POST">
                                <input type="hidden" name="idControle" value="' . $idControle . '">
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

                            <form id="telechargerFE" action="' . PAGE_TELECHARGER_FE_CONTROLE_PATH . '" method="POST">
                                <input type="hidden" name="idControle" value="' . $idControle . '">
                                <a onClick="document.getElementById(\'telechargerFE\').submit();">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                                <h5> <i class="fa fa-download fa-2x"></i> Télécharger feuilles d\'émargement</h5>   
                                        </div>
                                    </div>
                                </a>
                            </form>

                            <form id="envoyerMails" action="' . PAGE_ENVOYER_MAILS_CONTROLE_PATH . '" method="POST">
                                <input type="hidden" name="idControle" value="' . $idControle . '">
                                <a onClick="document.getElementById(\'envoyerMails\').submit();">
                                    <div class="card text-white bg-primary">
                                        <div class="card-body">
                                            <h5>
                                                <i class="fa fa-envelope fa-2x"></i>
                                                Envoyer un mail aux étudiants
                                            </h5>
                                        </div>
                                    </div>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ';
            echo '</div>';

        } else {
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