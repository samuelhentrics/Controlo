<section>
    <h1>Plan de la salle <?php print($_GET["salle"]); ?></h1>
    <table class="table table-striped">
        <?php
                include($FONCTION_CREER_PLAN_SALLE);

                $plan = creerPlanSalle($_GET["salle"])->getPlan();

                for ($lig = 0; $lig <= count($plan) - 1; $lig++) {
                    print("<tr>");
                    for ($col = 0; $col <= count($plan[0]) - 1; $col++) {
                        $placeActuelle = $plan[$lig][$col];

                        // Affichage d'une bordure s'il s'agit d'une table ou d'un tableau
                        if($placeActuelle->getType() == "tableau" or $placeActuelle->getType() == "place" ){
                            print("<td class='bordure'>");
                        }
                        else{
                            print("<td>");
                        }

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
                        print("</td>");
                    }
                    print("</tr>");
                }
                ?>
    </table>
</section>