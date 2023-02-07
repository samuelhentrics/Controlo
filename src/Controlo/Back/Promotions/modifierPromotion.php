<div class="container">
  <div class="col-3"></div>
  <div class="col-6 m-auto">
    <h2>Modifier une promotion</h2>

    <?php
    include_once(FONCTION_CRUD_PROMOTIONS_FILE_NAME);

    if (isset($_POST["idPromotion"])) {
        $idPromotion = $_POST["idPromotion"];

        if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["statut"])){
            include_once(FONCTION_CRUD_ENSEIGNANTS_PATH);
            $nouveauNomGeneration = $_POST["nouveauNomGeneration"];
            $nouveauNomAffichage = $_POST["nouveauNomAffichage"];

            try {
                
                ajouterNomPromotion($nouveauNomGeneration, $nouveauNomAffichage);
                
                print("
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Succès !</strong>
                        <p>L'enseignant a bien été modifié.</p>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ");
            } catch (Exception $e) {
                // Afficher l'erreur      
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                echo $e->getMessage();
                echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo '</div>';
            }
        }


        $promotion = recupererUnePromotion($idPromotion);
        
        $nomAnciennePromo = $promotion->getNom();


         // Ouvrir le fichier liste-promotions en lecture afin de vérifier si le nom de la promotion existe
         $fichierListePromo = fopen(CSV_ETUDIANTS_FOLDER_NAME . LISTE_PROMOTIONS_FILE_NAME, "r");
         if ($fichierListePromo == false) {
             throw new Exception("Impossible d'ouvrir le fichier de liste de promotions.");
         }

         $infoFichierListePromo = array();

         $indicePromoCherche = null;
         $i = 0;
         while (($data = fgetcsv($fichierListePromo, 1000, ";")) !== FALSE) {
            if($data[0]==$nomAnciennePromo){
                $indicePromoCherche = $i;
            }
            $infoFichierListePromo[] = $data;
            $i++;
         }

         $infoFichierListePromo[$indicePromoCherche][0]=$nouveauNomGeneration;
         $infoFichierListePromo[$indicePromoCherche][1] =$nouveauNomAffichage;


         // On parcours le tableau qui contient les informations du fichier liste-promotions
         foreach ($infoFichierListePromo as $info) {

            // On vérifie si le nom de la promotion existe
            if ($info[0] != $promotion->getNom()) {
                // On ajoute les informations du fichier dans le tableau
                fputcsv($fichierListePromo, $info, ";");
            }
        }
         




        echo '
        <form action="' . PAGE_MODIFIER_ENSEIGNANT_PATH . '" method="post">
        <div class="form-group row">
            <label for="nom" class="col-4 col-form-label">Nom</label>
            <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fa fa-address-card"></i>
                </div>
                </div>
                <input id="nouveauNomGeneration" name="nouveauNomGeneration" placeholder="ex : Info semestre 1" type="text" 
                class="form-control" value="' . $promotion->getNom() . '"
                required="required">
            </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="prenom" class="col-4 col-form-label">Prénom</label>
            <div class="col-8">
            <div class="input-group">
                <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fa fa-address-card"></i>
                </div>
                </div>
                <input id="prenom" name="prenom" placeholder="ex : Paul" type="text"
                class="form-control" value="' . $enseignan->getPrenom() . '"
                required="required">
            </div>
            </div>
        </div>';

        // Statut
        if ($enseignant->getEstTitulaire()){
            echo '
            <div class="form-group row">
                <label for="statut" class="col-4 col-form-label">Statut</label>
                <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-address-card"></i>
                    </div>
                    </div>
                    <select id="statut" name="statut" class="custom-select" required="required">
                        <option value="Titulaire" selected>Titulaire</option>
                        <option value="Vacataire">Vacataire</option>
                    </select>
                </div>
                </div>
            </div>';
        }
        else{
            echo '
            <div class="form-group row">
                <label for="statut" class="col-4 col-form-label">Statut</label>
                <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-address-card"></i>
                    </div>
                    </div>
                    <select id="statut" name="statut" class="custom-select" required="required">
                        <option value="Titulaire">Titulaire</option>
                        <option value="Vacataire" selected>Vacataire</option>
                    </select>
                </div>
                </div>
            </div>';
        }
        
echo '
        <div class="form-group row">
            <input name="idEnseignant" value="' . $idEnseignant . '" hidden></input>
        </div>
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Modifier</button>
        </div>
        
        </form>

        ';
    }
    else{
        echo "Aucun étudiant n'a été renseigné. Veuillez-réessayer";    
    }
    ?>


  </div>
  <div class="col-3"></div>
</div>