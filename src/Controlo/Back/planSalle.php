<div class="container">
    <div class="col-12">
        <br>

        <section>
            <h1>Plan de la salle <?php print($_GET["salle"]); ?></h1>
            <table class="table table-striped table-bordered">
                <?php
                include(FONCTION_CREER_PLAN_SALLE_PATH);

                $plan = creerPlanSalle($_GET["salle"])->getMesZones();

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
                ?>
            </table>
        </section>

    </div>
</div>