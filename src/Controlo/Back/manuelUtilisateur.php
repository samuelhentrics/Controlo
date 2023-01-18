<div class="container">
    <br>
    <!-- Afficher une alerte en warning  -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Attention !</strong>
        <p>Cette page est en cours de développement.</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <h2>Manuel Utilisateur</h2>
    <p>Vous trouverez ci-dessous les informations nécessaires pour utiliser l'application Controlo.</p>
    <div class="d-flex align-items-start">
    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link active" id="v-v-pills-genererControle-tab" data-bs-toggle="pill" data-bs-target="#v-pills-genererControle" type="button" role="tab" aria-controls="v-pills-genererControle" aria-selected="true">
            Comment générer un <br>
            plan de placement ?
        </button>
        <button class="nav-link" id="v-pills-parametrer-tab" data-bs-toggle="pill" data-bs-target="#v-pills-parametrer" type="button" role="tab" aria-controls="v-pills-parametrer" aria-selected="false">
            Comment changer le <br>
            repertoire de l'application ?
        </button>
        <button class="nav-link" id="v-pills-repertoires-tab" data-bs-toggle="pill" data-bs-target="#v-pills-repertoires" type="button" role="tab" aria-controls="v-pills-repertoires" aria-selected="false">
            Informations sur les repertoires
        </button>
        <button class="nav-link" id="v-pills-nomenclature-tab" data-bs-toggle="pill" data-bs-target="#v-pills-nomenclature" type="button" role="tab" aria-controls="v-pills-nomenclature" aria-selected="false">
            Informations nomenclature
        </button>
    </div>
    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-genererControle" role="tabpanel" aria-labelledby="v-pills-genererControle-tab" tabindex="0">
            <h3>Comment générer un plan de placement ?</h3>
            <p>1. Sélectionner un contrôle</p>
            <p>2. Sélectionner les contraintes</p>
            <p>3. Générer le plan</p>
            <p>4. Télécharger le plan</p>
            <br>
            <p>Exemple avec une vidéo</p>
            <iframe width="560" height="315" src="<?php echo VIDEOS_PATH."genererPDF.mp4" ?>" title="Video de comment générer des plans de placement" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            <br>
        </div>
        <div class="tab-pane fade" id="v-pills-parametrer" role="tabpanel" aria-labelledby="v-pills-parametrer-tab" tabindex="0">
            <h3>Comment changer le repertoire de l'application ?</h3>
            <p>Dans le cas où vous devez changer le repertoire "src" (par défaut) par un autre répertoire, rendez-vous
                dans le fichier de configuration (config.php) et modifiez la constante NOM_DOSSIER_PROJET par le repertoire
                que vous souhaitez.</p>
            
            <br>
        </div>
        <div class="tab-pane fade" id="v-pills-repertoires" role="tabpanel" aria-labelledby="v-pills-repertoires-tab" tabindex="0">
            <h3>Informations sur les repertoires</h3>

            <h4>Répertoire <?php echo CSV_CONTROLES_FOLDER_NAME; ?></h4>
            <p>Le fichier <?php echo LISTE_CONTROLES_FILE_NAME; ?> contient la liste des contrôles.</p>


            <h4>Répertoire <?php echo CSV_ETUDIANTS_FOLDER_NAME; ?></h4>
            <p>Chaque fichier CSV contiennent une promotion (le nom de la promotion est celle du fichier).</p>

            <h4>Répertoire <?php echo CSV_SALLES_FOLDER_NAME; ?></h4>
            <p>Le fichier <?php echo LISTE_SALLES_FILE_NAME; ?> contient la liste des salles ainsi que la salle voisine d'une salle si celle-ci existe.</p>
            <p>Chaque fichier CSV contiennt le plan d'une salle (le nom la salle est celle du fichier).</p>

            <h4>Répertoire <?php echo PLANS_DE_PLACEMENT_FOLDER_NAME; ?></h4>
            <p>Vous retrouvez dans ce dossier, chaque plan de placement généré d'un contrôle.</p>
            <p>La nomenclature de chaque fichier est la suivante (exemple) :</p>
            <img src="<?php echo IMG_PATH;?>nomenclature_fic.png" alt="Nomenclature des fichiers">
            
            <br>
        </div>
        <div class="tab-pane fade" id="v-pills-nomenclature" role="tabpanel" aria-labelledby="v-pills-nomenclature-tab" tabindex="0">
            <h3>Informations nomenclature</h3><br>
            <h4>Le fichier <?php echo LISTE_CONTROLES_FILE_NAME; ?></h4>
            <p>Il est important de rajouter les colonnes suivantes dans le fichier CSV exporté depuis le logiciel de scolarité :</p>
            <ul>
                <li><?php echo DATE_NOM_COLONNE_CONTROLE ?></li>
                <li><?php echo HEURE_NOM_COLONNE_CONTROLE ?></li>
                <li><?php echo HEURE_TT_NOM_COLONNE_CONTROLE ?></li>
                <li><?php echo SALLES_NOM_COLONNE_CONTROLE ?></li>
                <li><?php echo SURVEILLANTS_NOM_COLONNE_CONTROLE ?></li>
            </ul>
            <p> Voici un tableau informatif sur les <b>noms de champs obligatoires</b> dans le fichier : 
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#tabControles" role="button" aria-expanded="false" aria-controls="tabControles">
                Afficher/Réduire tableau
            </a>
            </p>
            <div class="collapse" id="tabControles">
                <div class="card card-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <td><?php echo PROMOTION_NOM_COLONNE_CONTROLE ?></td>
                        <td>Doit obligatoirement avoir le <b>même nom</b> que celui des <b>fichiers étudiants</b> exportés</td>
                    </tr>
                    <tr>
                        <td><?php echo NOM_LONG_NOM_COLONNE_CONTROLE ?></td>
                        <td>Le code ressource et le nom du contrôle sont séparés par un -</td>
                    </tr>
                    <tr>
                        <td><?php echo NOM_COURT_NOM_COLONNE_CONTROLE ?></td>
                        <td>Le code ressource et le nom du contrôle sont séparés par un -</td>
                    </tr>
                    <tr>
                        <td><?php echo ENSEIGNANT_REF_NOM_COLONNE_CONTROLE ?></td>
                        <td>
                            Informe de l’enseignant tuteur/des enseignants tuteurs.<br>
                            En cas de plusieurs professeurs tuteurs, on utilise la nomenclature suivante :
                            <b>Nomprofesseur1, Nomprofesseur2</b><br>
                            Une virgule est ainsi utilisée.
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo DUREE_NOM_COLONNE_CONTROLE ?></td>
                        <td>
                            Informe de la durée totale (tiers-temps compris).<br>
                            La durée est <b>exprimée en minutes</b>.
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo DATE_NOM_COLONNE_CONTROLE ?></td>
                        <td>
                            La date est exprimée <b>en JJ/MM/YYYY</b>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo HEURE_NOM_COLONNE_CONTROLE ?></td>
                        <td>
                            L’heure (non tiers-temps) à laquelle commence le contrôle est exprimée sous la forme <b>HH:MM</b>.
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo HEURE_TT_NOM_COLONNE_CONTROLE ?></td>
                        <td>
                            L’heure (tiers-temps) à laquelle commence le contrôle est exprimée sous la forme <b>HH:MM</b>.
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo SALLES_NOM_COLONNE_CONTROLE ?></td>
                        <td>
                            On sépare chaque salle par une virgule :<br>
                            <b>NOMSALLE1, NOMSALLE2, NOMSALLE3, NOMSALLE4</b><br>
                            On met la salle principale qui doit accueillir les tiers-temps/ordi en premier.
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo SURVEILLANTS_NOM_COLONNE_CONTROLE ?></td>
                        <td>
                            En cas d’un enseignant, on insère uniquement le nom du surveillant.<br>
                            Dans le cas de plusieurs enseignants, on utilise la virgule pour séparer les enseignants. On utilise la nomenclature suivante :<br>
                            <b>Nomprofesseur1, Nomprofesseur2</b>

                        </td>
                    </tr>
                </table>
                </div>
            </div>




            <h4>Les fichiers de Promotions</h4>
            <p>Pour chaque fichier de promotion, un étudiant est caractérisé par <b>les champs suivants</b> :</p>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#tabEtud" role="button" aria-expanded="false" aria-controls="tabEtud">
                Afficher/Réduire tableau
            </a>
            </p>
            <div class="collapse" id="tabEtud">
                <div class="card card-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <td><?php echo PRENOM_NOM_COLONNE_ETUDIANT ?></td>
                        <td>Contient le nom de l'étudiant</td>
                    </tr>
                    <tr>
                        <td><?php echo NOM_NOM_COLONNE_ETUDIANT ?></td>
                        <td>Contient le prénom de l'étudiant</td>
                    </tr>
                    <tr>
                        <td><?php echo TD_NOM_COLONNE_ETUDIANT ?></td>
                        <td>Contient le TD de l'étudiant</td>
                    </tr>
                    <tr>
                        <td><?php echo TP_NOM_COLONNE_ETUDIANT ?></td>
                        <td>
                            Contient le TP de l'étudiant
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo STATUTS_NOM_COLONNE_ETUDIANT ?></td>
                        <td>
                            Contient les informations sur l'étudiant.<br>
                            Pour un étudiant tiers-temps les mots-clés détectés sont :<br>
                            <b>TiersTemps | Tiers-temps</b><br><br>
                            Pour un étudiant avec ordinateur les mots-clés détectés sont :<br>
                            <b>Ordinateur | PC</b><br><br>
                            Pour un étudiant démissionnaire les mots-clés détectés sont :<br>
                            <b>Demission | DÃ©mission | Démission</b><br>

                        </td>
                    </tr>
                    <tr>
                        <td><?php echo MAIL_NOM_COLONNE_ETUDIANT ?></td>
                        <td>
                            Contient le mail de l'étudiant
                        </td>
                    </tr>
                </table>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">...</div>
    </div>
    </div>
    <br>
</div>