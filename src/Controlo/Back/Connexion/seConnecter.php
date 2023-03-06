<div class="row justify-content-center">
    <div class="col-md-6">
        <?php
        if (isset($_POST['email']) && isset($_POST['pwd'])) {
            include_once(IMPORT_PATH . 'connexion.php');

            $email = $_POST['email'];
            $pwd = $_POST['pwd'];

            $seSouvenir = isset($_POST['rememberMe']) ? true : false;

            try {
                seConnecter($email, $pwd, $seSouvenir);

                if (estConnecte()) {
                    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
                } else {
                    echo '<div class="alert alert-danger" role="alert">
                            Votre adresse e-mail ou votre mot de passe est incorrect.
                            </div>';
                }
            } catch (Exception $e) {
                echo '<div class="alert alert-danger" role="alert">
                        ' . $e->getMessage() . '
                        </div>';
            }
        }

        ?>

        <!-- Message d'information -->
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Bienvenue sur Controlo</h4>
            <p>Controlo est un logiciel de placement des étudiants lors des contrôles.
                Il permet de générer des plans de placement, des feuilles d'émargement
                mais aussi d'envoyer des mails aux étudiants afin de leur informer des
                contrôles à venir.</p>
            <hr>
            <p class="mb-0">Pour vous connecter, veuillez saisir votre adresse e-mail et votre mot de passe.</p>
            <p>Si vous n'avez pas encore de compte, veuillez contacter votre administrateur.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Connexion</h4>
            </div>
            <div class="card-body">
                <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                    <div class="form-group">
                        <label for="email">Adresse e-mail</label>
                        <input type="email" class="form-control form-control-lg rounded-0" name="email" id="email"
                            required="">
                        <div class="invalid-feedback">Veuillez saisir votre adresse e-mail.</div>
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" class="form-control form-control-lg rounded-0" id="pwd" name="pwd"
                            required="">
                        <div class="invalid-feedback">Veuillez saisir votre mot de passe.</div>
                    </div>
                    <div>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description small text-dark">Se souvenir de moi sur cet
                                ordinateur (Non fonctionnel)</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg float-right" id="btnLogin">
                        Se connecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>