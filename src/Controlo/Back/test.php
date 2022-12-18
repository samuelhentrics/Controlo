<?php

include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
include_once(FONCTION_CREER_LISTE_PROMOTIONS_PATH);

etudiantPromo();
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