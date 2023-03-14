<div class="container">
    <div class="col-3"></div>
    <div class="col-6 m-auto text-center">
    <?php       

        // ------------------------------------------------------
        // -------------Modifier contrôle si id------------------
        // ------------------------------------------------------
        if (isset($_POST["idControle"])) {

            // Formulaire avec bouton de retour
            $id = htmlspecialchars($_POST["idControle"]);
            echo '
            <h2>
                <form action="'.PAGE_PANEL_CONTROLE_PATH.'" method="post" style="display:inline;">
                        <input type="hidden" name="idControle" value="' . $id . '">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </button>
                </form>
                Modifier un contrôle
            </h2>';


            include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
            include_once(FONCTION_CRUD_CONTROLE_PATH);

            // Variables du formulaire
            
            $unControle = recupererUnControle($id);
            $nomLong = $unControle->getNomLong();
            $nomCourt = $unControle->getNomCourt();
            $dureeTotale = $unControle->getDuree();
            $dateControle = $unControle->getDate();
            $heureNonTT = $unControle->getHeureNonTT();
            $heureTT = $unControle->getHeureTT();
            $listePromotions = $unControle->getMesPromotions();
            $listeSalles = $unControle->getMesSalles();
            $mesReferents = $unControle->getMesEnseignantsReferents();
            $mesSurveillants = $unControle->getMesEnseignantsSurveillants();

            // Récupérer les noms des promotions
            $nomsPromos = "";
            foreach ($listePromotions as $keys => $unePromotion) {
                $nomsPromos .= $unePromotion->getNom() . ", ";
            }
            $nomsPromos = substr($nomsPromos, 0, -2);

            // Récupérer les noms des salles
            $nomsSalles = "";
            foreach ($listeSalles as $keys => $uneSalle) {
                $nomsSalles .= $uneSalle->getNom() . ", ";
            }
            $nomsSalles = substr($nomsSalles, 0, -2);

            // Récupérer les noms des referents
            $nomsReferents = "";
            foreach ($mesReferents as $keys => $unReferent) {
                $nomsReferents .= $unReferent . ", ";
            }
            $nomsReferents = substr($nomsReferents, 0, -2);

            // Récupérer les noms des surveillants
            $nomsSurveillants = "";
            foreach ($mesSurveillants as $keys => $unSurveillant) {
                $nomsSurveillants .= $unSurveillant . ", ";
            }
            $nomsSurveillants = substr($nomsSurveillants, 0, -2);

            // Récuperer le controle
            $unControle = recupererUnControle($id);

            // ------------------------------------------------------
            // --------------------- Formulaire ---------------------
            // ------------------------------------------------------
            if (
                isset($_POST["promotion"]) && isset($_POST["controleNomLong"]) &&
                isset($_POST["controleNomCourt"]) && isset($_POST["dateDebutControle"])
                && isset($_POST["dureeTotale"]) && isset($_POST["heureNonTT"])
                && isset($_POST["heureTT"]) && isset($_POST["enseignant"]) && isset($_POST["surveillant"]) && isset($_POST["choixSalles"])
            ) {
                try {
                    // Variables
                    $nomsPromos = $_POST["promotion"];
                    $nomsSalles = $_POST["choixSalles"];
                    $nomLong = $_POST['controleNomLong'];
                    $nomCourt = $_POST['controleNomCourt'];
                    $dureeTotale = $_POST['dureeTotale'];
                    $heureNonTT = $_POST['heureNonTT'];
                    $heureTT = $_POST['heureTT'];
                    $dateControle = $_POST['dateDebutControle'];
                    $mesReferents = $_POST['enseignant'];
                    $mesSurveillants = $_POST['surveillant'];
                    
                    //xss 
                    $nomsPromos = htmlspecialchars($_POST["promotion"]);
                    $nomsSalles = htmlspecialchars($_POST["choixSalles"]);
                    $nomLong = htmlspecialchars($_POST['controleNomLong']);
                    $nomCourt = htmlspecialchars($_POST['controleNomCourt']);
                    $dureeTotale = htmlspecialchars($_POST['dureeTotale']);
                    $heureNonTT = htmlspecialchars($_POST['heureNonTT']);
                    $heureTT = htmlspecialchars($_POST['heureTT']);
                    $dateControle = htmlspecialchars($_POST['dateDebutControle']);
                    $mesReferents = htmlspecialchars($_POST['enseignant']);
                    $mesSurveillants = htmlspecialchars($_POST['surveillant']);

                    // Transformer la date au format DD/MM/YYYY si elle est au format YYYY-MM-DD
                    if (preg_match("#[0-9]{4}-[0-9]{2}-[0-9]{2}#", $dateControle)) {
                        $dateControle = date("d/m/Y", strtotime($dateControle));
                    }

                    // Créer l'objet controle
                    $nouveauControle = new Controle($nomLong, $nomCourt, $dureeTotale, $dateControle, $heureNonTT, $heureTT);

                    // Ajouter les promotions
                    $nomsPromos = trim($nomsPromos);
                    if ($nomsPromos != "" || $nomsPromos != null) {
                        $listeNomPromotion = explode(",", $nomsPromos);
                        foreach ($listeNomPromotion as $key => $nomPromo) {
                            try{
                            $unePromotion = creerUnePromotion(trim($nomPromo));
                            }
                            catch (Exception $e){
                                throw new Exception("La promotion " . trim($nomPromo) . " n'existe pas.
                                Veuillez la créer avant de l'ajouter à un contrôle.");
                            }
                            $nouveauControle->ajouterPromotion($unePromotion);
                        }
                    }

                    // Ajouter les salles
                    $nomsSalles = trim($nomsSalles);
                    if ($nomsSalles != "" || $nomsSalles != null) {
                        $listeNomSalle = explode(",", $nomsSalles);
                        foreach ($listeNomSalle as $key => $nomSalle) {
                            $uneSalle = creerUneSalle(trim($nomSalle));
                            if ($uneSalle == null) {
                                throw new Exception("La salle " . trim($nomSalle) . " n'existe pas. Veuillez la créer avant de l'ajouter à un contrôle.");
                            }
                            $nouveauControle->ajouterSalle($uneSalle);
                        }
                    }

                    // Ajouter les enseignants référents
                    $mesReferents = trim($mesReferents);
                    if ($mesReferents != "" || $mesReferents != null) {
                        $listeMesReferents = explode(",", $mesReferents);
                        foreach ($listeMesReferents as $monReferent) {
                            $nouveauControle->ajouterEnseignantReferent($monReferent);
                        }
                    }
                    // Ajouter les surveillants
                    $mesSurveillants = trim($mesSurveillants);
                    if ($mesSurveillants != "" || $mesSurveillants != null) {
                        $listeMesSurveillants= explode(",", $mesSurveillants);
                        foreach ($listeMesSurveillants as $monSurveillant) {
                            $nouveauControle->ajouterEnseignantSurveillant($monSurveillant);
                        }
                    }

                    modifierControle($id, $nouveauControle);


                    // Mettre à jour les variables (pour afficher les nouvelles valeurs)
                    $unControle = recupererUnControle($id);
                    $nomLong = $unControle->getNomLong();
                    $nomCourt = $unControle->getNomCourt();
                    $dureeTotale = $unControle->getDuree();
                    $dateControle = $unControle->getDate();
                    $heureNonTT = $unControle->getHeureNonTT();
                    $heureTT = $unControle->getHeureTT();
                    $listePromotions = $unControle->getMesPromotions();
                    $listeSalles = $unControle->getMesSalles();
                    $mesReferents = $unControle->getMesEnseignantsReferents();
                    $mesSurveillants = $unControle->getMesEnseignantsSurveillants();

                    // Récupérer les noms des promotions
                    $nomsPromos = "";
                    foreach ($listePromotions as $keys => $unePromotion) {
                        $nomsPromos .= $unePromotion->getNom() . ", ";
                    }
                    $nomsPromos = substr($nomsPromos, 0, -2);

                    // Récupérer les noms des salles
                    $nomsSalles = "";
                    foreach ($listeSalles as $keys => $uneSalle) {
                        $nomsSalles .= $uneSalle->getNom() . ", ";
                    }
                    $nomsSalles = substr($nomsSalles, 0, -2);

                    // Récupérer les noms des referents
                    $nomsReferents = "";
                    foreach ($mesReferents as $keys => $unReferent) {
                        $nomsReferents .= $unReferent . ", ";
                    }
                    $nomsReferents = substr($nomsReferents, 0, -2);

                    // Récupérer les noms des surveillants
                    $nomsSurveillants = "";
                    foreach ($mesSurveillants as $keys => $unSurveillant) {
                        $nomsSurveillants .= $unSurveillant . ", ";
                    }
                    $nomsSurveillants = substr($nomsSurveillants, 0, -2);

                
                    echo "<div class='alert alert-success' role='alert'>Le contrôle a bien été modifié.</div>";
                } catch (Exception $e) {
                    echo "<div class='alert alert-danger' role='alert'>
        Le contrôle n'a pas été ajouté : " . $e->getMessage() . "</div>";
                }
            }

            // Transformer la date actuellement au format DD/MM/YYYY en YYYY-MM-DD
            if (preg_match("#[0-9]{2}/[0-9]{2}/[0-9]{4}#", $dateControle)) {
                trim($dateControle);
                $dateControle = str_replace("/", "-", $dateControle);
                $dateControle = date("Y-m-d", strtotime($dateControle));
            }
            

            echo '
        <br>
        <form action="'.PAGE_MODIFIER_CONTROLE_PATH.'" method="POST">
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Promotion(s)*</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="promotion" name="promotion" placeholder="ex: Info semestre 1, Info semestre 3"
                        value="'.$nomsPromos.'" type="text" class="form-control" required="">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <input type="hidden" name="idControle" value="'. $id .'">
                <label for="nom" class="col-4 col-form-label">Nom long*</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomLong" value="'. $nomLong .'"
                            name="controleNomLong"
                            placeholder="Ex: R2.01 - Développement orienté objets - Programmation" type="text"
                            class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="controleNomCourt" class="col-4 col-form-label">Nom Court*</label>
                <div class="col-8">
                    <div class="input-group">
                        <input id="controleNomCourt" value="'. $nomCourt .'"
                            name="controleNomCourt" placeholder="Ex: R2.01 - Dév. objets - Programmation" type="text"
                            class="form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="promo" class="col-4 col-form-label">Date</label>
                <div class="col-8">
                    <input type="date" value="'. $dateControle .'" name="dateDebutControle"
                        id="dateDebutControle" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="Durée" class="col-4 col-form-label">Durée totale (en min)</label>
                <div class="col-8">
                    <input id="Durée" name="dureeTotale" value="'. $dureeTotale .'"
                        placeholder="Ex: 120, 60" type="number" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="heureNonTT" class="col-4 col-form-label">Heure début Non TT</label>
                <div class="col-8">
                    <input id="heureNonTT" name="heureNonTT" value="'. $heureNonTT .'"
                        placeholder="Ex: 14:00" type="time" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="heureTT" class="col-4 col-form-label">Heure début TT</label>
                <div class="col-8">
                    <input id="heureTT" name="heureTT" value="'. $heureTT .'"
                        placeholder="Ex: 14:00" type="time" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Enseignant(s) référent(s)</label>
                <div class="col-8">
                    <div>
                        <input id="enseignant" name="enseignant" value="'. $nomsReferents .'" placeholder="Dupont" type="text" class="form-control">
                    </div>
                    <!-- <input id="controleNomLong" name="controleNomLong" placeholder="ex: Cordova,Futrell" type="text" class="form-control" required="required"> -->
                </div>
            </div>
            <div class="form-group row">
                <label for="nom" class="col-4 col-form-label">Surveillant(s)</label>
                <div class="col-8">
                    <div>
                        <input id="surveillant" name="surveillant" value="'. $nomsSurveillants .'" placeholder="Dupont, Lamarque" type="text"
                            class="form-control">
                    </div>
                    <!-- <input id="controleNomLong" name="controleNomLong" placeholder="ex: Cordova,Futrell" type="text" class="form-control" required="required"> -->
                </div>
            </div>

            <div class="form-group row">
                <label for="choixSalles" class="col-4 col-form-label">Salles</label>
                <div class="col-8">
                    <input id="choixSalles" name="choixSalles" placeholder="Ex : S124, S125" class="form-control"
                        value="'. $nomsSalles .'">
                </div>
                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </div>
        </form>
    </div>
    <div class="col-3"></div>
</div>
<p> (*) signifie obligatoire</p>
</div>
';

        }
    else{
        echo "<div class='alert alert-danger' role='alert'>
        Le contrôle n'a pas été trouvé</div>";

    }
?>