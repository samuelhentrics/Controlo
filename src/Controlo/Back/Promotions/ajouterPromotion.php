
<?php
print("coucou");
if (isset($_POST['nomGeneration']) && isset($_POST['nomFormation'])) {
                 
        $nomPromotion = $_POST["nomGeneration"];
        $nomPromotionRenomme = $_POST["nomFormation"];
        echo $nomPromotion;
        echo $nomPromotionRenomme;
        echo CSV_ETUDIANTS_PATH.$nomPromotion.".csv";
        $file =  fopen(CSV_ETUDIANTS_FOLDER_NAME.$nomPromotion.".csv" , "w");
        
        fgetcsv($file);
        fclose($file);
}
?>
