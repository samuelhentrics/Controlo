<?php
include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
include_once(CLASS_PATH . CLASS_CONTRAINTES_ESPACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_CONTRAINTES_GENERALES_FILE_NAME);
include_once(CLASS_PATH . CLASS_PLAN_PLACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_UN_PLACEMENT_FILE_NAME);
include_once(IMPORT_PATH . "genererPDF.php");

?>

<?php
//recup controle
$unControle = recupererUnControle($_GET["id"]);
//recupe contraintes saisie par l'utilisateur
$contraintesGenerales = new ContraintesGenerales($_POST["typePlacement"], $_POST["typeSeparation"]);
$listeDeSalles = $unControle->getMesSalles();




//ajout des contraintes au controle
foreach ($listeDeSalles as $nom => $uneSalle) {
    $nbPlaceSeparant = $_POST["nbPlaceSeparant-" . $nom];
    $nbRangeeSeparant = $_POST["nbRangeeSeparant-" . $nom];
    $contraintesSalle = new ContraintesEspacement($nbRangeeSeparant, $nbPlaceSeparant);
    $unPDP = new PlanDePlacement($contraintesGenerales, $contraintesSalle, $uneSalle);
    $unControle->ajouterPlanDePlacement($unPDP);

}
//recuperer la listes des promotions 
$listePromos = $unControle->getMesPromotions();

$listeTTSansOrdi = array();
$listeOrdi = array();
$listeEtud = array();

foreach ($listePromos as $key => $unePromo) {
    $listeTTSansOrdi = array_merge($listeTTSansOrdi, $unePromo->recupererListeEtudiantsTTSansOrdi());
    $listeOrdi = array_merge($listeOrdi, $unePromo->recupererListeEtudiantsOrdi());
    $listeEtud = array_merge($listeEtud, $unePromo->recupererListeEtudiantsNonTT());

}
function trieListes($array, $algo) {
  switch ($algo) {
    case 'aléatoire':
      shuffle($array);
      break;
    case 'descendant':
      usort($array, function($a, $b) {
        return strcmp($b->getNom(), $a->getNom());
      });
      break;
    //ascendant
    default:
      usort($array, function($a, $b) {
        return strcmp($a->getNom(), $b->getNom());
      });
      break;
  }
  return $array;
}

$listeTTSansOrdi = trieListes($listeTTSansOrdi, $contraintesGenerales->getAlgoRemplissage());
$listeOrdi = trieListes($listeOrdi, $contraintesGenerales->getAlgoRemplissage());
$listeEtud = trieListes($listeEtud, $contraintesGenerales->getAlgoRemplissage());

// var_dump($listeTTSansOrdi);

// genererPDF($unControle);
//aaficher controle
// var_dump( $unControle);

print("contrle id: " . $_GET["id"] . "<br>")
    ?>
<html>page resultat

</html>