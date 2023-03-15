<div class="container">

        <?php

        echo '
        <h2>
            <form action="'.PAGE_UTILISATEURS_PATH.'" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
            </form>
            Ajouter un utilisateur
        </h2><br>';

        if (isset($_POST['submit'])) {
            include_once(FONCTION_CRUD_UTILISATEURS_PATH);
            include_once(CLASS_PATH . CLASS_UTILISATEUR_FILE_NAME);
            include_once(IMPORT_PATH . "connexion.php");

            try {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $statut = htmlspecialchars($_POST['role']);

                if (empty($nom) || empty($prenom))
                    throw new Exception("Tous les champs doivent être remplis.");

                // Vérifier que le statut est bien "0", "1" ou "2" si c'est pas le cas
                // mettre le statut à 2 par défaut
                if ($statut != 0 && $statut != 1 && $statut != 2)
                    $statut = 2;

                if(estSecretaireAdmin() && $statut == 0)
                    throw new Exception("Vous n'avez pas les droits pour créer un administrateur.");

                if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
                    throw new Exception("L'adresse mail n'est pas valide.");

                $mail = htmlspecialchars($_POST['mail']);

                if (utilisateurMailExiste($mail))
                    throw new Exception("L'adresse mail est déjà utilisée.");

                $mdp = htmlspecialchars($_POST['password']);
                $mdp2 = htmlspecialchars($_POST['password2']);

                if ($mdp != $mdp2)
                    throw new Exception("Les mots de passe ne correspondent pas.");

                $mdp = hashPassword($mdp);

                $id = recupererIdMaxUtilisateurs() + 1;
                $unUtilisateur = new Utilisateur($id, $nom, $prenom, $statut, $mail, $mdp);
                ajouterUtilisateur($unUtilisateur);
                echo "<div class='alert alert-success' role='alert'>L'utilisateur a bien été ajouté.</div>";
            } catch (Exception $e) {
                echo "<div class='alert alert-danger' role='alert'>
                L'utilisateur n'a pas été ajouté : " . $e->getMessage() . "</div>";
            }
        }
        ?>


        <div class="col-3"></div>
        <div class="col-6 m-auto text-center">
            <form action="<?php echo PAGE_AJOUTER_UTILISATEUR_PATH; ?>" method="post">
                <div class="form-group row">
                    <label for="nom" class="col-4 col-form-label">Nom *</label>
                    <div class="col-8">
                        <div class="input-group">
                            <input id="nom" name="nom" placeholder="ex: Dupond" type="text" class="form-control"
                                required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="prenom" class="col-4 col-form-label">Prénom *</label>
                    <div class="col-8">
                        <div class="input-group">
                            <input id="prenom" name="prenom" placeholder="ex: Jean" type="text" class="form-control"
                                required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="statut" class="col-4 col-form-label">Statut *</label>
                    <div class="col-8">
                        <div class="form-check">
                            <select id="role" name="role">
                                <?php 

                                // Proposer les 3 statuts si l'utilisateur est un administrateur, sinon
                                // proposer seulement les 2 derniers
                                if (estAdmin()){
                                    echo '
                                <option value="0" selected>Administrateur</option>
                                <option value="1">Secrétaire/Administrateur</option>
                                <option value="2" selected>Secrétaire</option>';
                                }
                                elseif(estSecretaireAdmin()){
                                    echo '
                                        <option value="1">Secrétaire/Administrateur</option>
                                        <option value="2" selected>Secrétaire</option>
                                    ';
                                }


                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mail" class="col-4 col-form-label">Mail *</label>
                    <div class="col-8">
                        <div class="input-group">
                            <input id="mail" name="mail" placeholder="ex: sec-info@iutbayonne.univ-pau.fr" type="text" class="form-control"
                                required="required">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-4 col-form-label">Mot de passe *</label>
                    <div class="col-8">
                        <div class="input-group">
                            <input id="password" name="password" placeholder="ex: 1234" type="password" class="form-control"
                                required="required">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password2" class="col-4 col-form-label">Confirmation du mot de passe *</label>
                    <div class="col-8">
                        <div class="input-group">
                            <input id="password2" name="password2" placeholder="ex: 1234" type="password" class="form-control"
                                required="required">
                        </div>
                    </div>
                </div>

                <div class="offset-4 col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
    (*) signifie obligatoire
</div>
