<div class="container">
    <div class="col-12">
        <br>

        <section>


        <?php

        if (isset($_POST["nomSalle"])) {
            include(FONCTION_CREER_PLAN_SALLE_PATH);

            $nomSalle = $_POST["nomSalle"];

            echo '
            <h2>
                <form action="' . PAGE_SALLES_PATH . '" method="post" style="display:inline;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </button>
                </form>
                Plan de la salle ' . $nomSalle . '
            </h2><br>';


            echo '
            <table class="table table-striped table-bordered">';

                

                $plan = creerPlanSalle($nomSalle)->getMesZones();

                for ($lig = 0; $lig <= count($plan) - 1; $lig++) {
                    print("<tr>");
                    for ($col = 0; $col <= count($plan[0]) - 1; $col++) {
                        $placeActuelle = $plan[$lig][$col];

                        print("<td>");

                        // Affichage de la place ou de la mention tableau
                        if($placeActuelle->getType() == "tableau"){
                            print("T");
                        }
                        else if ($placeActuelle->getType() == "place"){
                            echo $plan[$lig][$col]->getNumero();
                            // S'il s'agit d'une place avec prise on rajoute un E
                            if($placeActuelle->getInfoPrise()){
                                print("E");
                            }
                        }
                        else{
                            // Ajout d'un caractère ‎ afin de pouvoir avoir un
                            // tableau ayant la même taille d'hauteur sur chaque case
                            // (cause : bootstrap)
                            print("‎");
                        }
                        print("</td>");
                    }
                    print("</tr>");
                }

            echo '</table>';


            }
            else{
                // Afficher un message d'erreur en bootstrap
            echo '
                <div class="alert alert-danger" role="alert">
                    Une erreur est survenue, veuillez réessayer.<br>
                    Le nom de la salle n\'a pas été transmis.<br>
                    Si le problème persiste, veuillez contacter l\'administrateur.
                </div>';
            }
            
            ?>
        </section>

    </div>
</div>