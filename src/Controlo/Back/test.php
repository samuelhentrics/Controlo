<?php

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
//                                 INCLUSIONS
// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);
include_once(CLASS_PATH . CLASS_CONTROLE_FILE_NAME);
include_once(CLASS_PATH . CLASS_PLAN_PLACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_SALLE_FILE_NAME);
include_once(IMPORT_PATH . "genererPDF.php");

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
//                                 APPEL DU TEST
// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

controlePDP();

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
//                                 FONCTIONS
// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

function genererPDPControle($id){
    // Récupérer le contrôle que l'on souhaite
    $unControle = recupererUnControle($id);

    // Simulation de places et d'étudiants
    foreach ($unControle->getMesSalles() as $nomSalle => $uneSalle) {
        $uneContrainteGenerale = new ContraintesGenerales("aléatoire","td");
        $uneContrainteEspacement = new ContraintesEspacement(1,2);
        $unPDP = new PlanDePlacement($uneContrainteGenerale, $uneContrainteEspacement, $uneSalle);
        for ($i = 1; $i < 21; $i++) {
            $unePlace = new Zone();
            $unePlace->setType("place");
            $unePlace->setNumero($i);

            $unEtudiant = new Etudiant("NOM" . $i, "PRENOM", 1, 2, "helloworld@gmail.com");

            $unPlacement = new UnPlacement();
            $unPlacement->setMonEtudiant($unEtudiant);
            $unPlacement->setMaZone($unePlace);

            $unPDP->ajouterPlacement($unPlacement);
            $unPDP->setMaSalle($uneSalle);
        }

        echo "<h2>Génération des PDP en PDF</h2>";
        $unControle->ajouterPlanDePlacement($unPDP);
        echo "ok";
    }

    genererPDF($unControle);
}


function controlePDP(){
    $uneContrainteGenerale = new ContraintesGenerales("aléatoire","td");
    $uneContrainteEspacement = new ContraintesEspacement(1,2);
    $uneSalle = new Salle("S124");
    $controle1 = new Controle("R1.01 Blabla", "R1.01", 90, "2022-04-10", "09:00", "09:00");
    $unPDP = new PlanDePlacement($uneContrainteGenerale, $uneContrainteEspacement, $uneSalle);
    

    $unPDP->setMaSalle($uneSalle);

    // Ajout d'un doublon de PlanDePlacement (il n'y en aura qu'un)
    $controle1->ajouterPlanDePlacement($unPDP);
    $controle1->ajouterPlanDePlacement($unPDP);

    echo "<h2>Ajout de deux fois d'un même PlanDePlacement</h2>";
    echo "<pre>";
    print_r($controle1);
    echo "</pre>";

    echo "<h2>Suppression d'un PlanDePlacement (celui ajouté)</h2>";
    $controle1->supprimerPlanDePlacement($unPDP);

    echo "<pre>";
    print_r($controle1);
    echo "</pre>";
}


function controlePromo(){
    print("<h2>Controle - Promo test</h2>");
    print("<br><br>");
    print("Création d'un controle, de deux promotions<br><br>");


    $promo2 = new Promotion("Info semestre 2");
    print("Promotion 2 : <br>");
    echo '<pre>'. var_export($promo2, true) . '</pre>';
    print("<br><br>");
    $promo3 = new Promotion("Info semestre 3");
    print("Promotion 3 : <br>");
    echo '<pre>'. var_export($promo3, true) . '</pre>';
    print("<br><br>");

    $controle1 = new Controle("R1.01 Blabla", "R1.01", 90, "2022-04-10", "09:00", "09:00");
    print("Controle : <br>");
    echo '<pre>'. var_export($controle1, true) . '</pre>';
    print("<br><br>");

    print("Associer 2 fois Promo2 au controle : <br>");
    $controle1->ajouterPromotion($promo2);
    $controle1->ajouterPromotion($promo2);
    echo '<pre>'. var_export($controle1, true) . '</pre>';
    print("<br><br>");

    print("Ajout promo 3 et supprimer 2 fois Promo2 au controle : <br>");
    $controle1->ajouterPromotion($promo3);
    $controle1->supprimerPromotion($promo2);
    $controle1->supprimerPromotion($promo2);
    echo '<pre>'. var_export($controle1, true) . '</pre>';
    print("<br><br>");


}




function etudiantPromo(){
    print("<h2></h2>");
    print("<br><br>");
    print("Création de deux étudiants et d'une promotion<br><br>");
    
    $etudiant1 = new Etudiant("HENTRICS","Samuel",1,1,"shloistine@iutbayonne.univ-pau.fr");
    print("Etudiant 1 : <br>");
    echo '<pre>'. var_export($etudiant1, true) . '</pre>';
    print("<br><br>");
    
    $etudiant2 = new Etudiant("ETCHEPARE","Cédric",1,1,"cetchepar001@iutbayonne.univ-pau.fr");
    print("Etudiant 2 : <br>");
    echo '<pre>'. var_export($etudiant2, true) . '</pre>';
    print("<br><br>");
    
    $promo1 = new Promotion("Info semestre 3");
    print("Promotion : <br>");
    echo '<pre>'. var_export($promo1, true) . '</pre>';
    print("<br><br>");
    
    print("Ajout d'un étudiant dans la liste : <br>");
    $promo1->ajouterEtudiant($etudiant1);
    echo '<pre>'. var_export($promo1, true) . '</pre>';
    print("<br><br>");
    
    print("Ajout une seconde fois du même étudiant : <br>");
    $promo1->ajouterEtudiant($etudiant1);
    echo '<pre>'. var_export($promo1, true) . '</pre>';
    print("<br><br>");

    print("Ajout du second etudiant : <br>");
    $promo1->ajouterEtudiant($etudiant2);
    echo '<pre>'. var_export($promo1, true) . '</pre>';
    print("<br><br>");
    
    print("Suppression de l'étudiant 1 : <br>");
    $promo1->supprimerEtudiant($etudiant1);
    echo '<pre>'. var_export($promo1, true) . '</pre>';
    print("<br><br>");

    print("Suppression encore de l'étudiant 1 : <br>");
    $promo1->supprimerEtudiant($etudiant1);
    echo '<pre>'. var_export($promo1, true) . '</pre>';
    print("<br><br>");
    
    
    print("<br><br>");
    print("<br><br>");
}



?>