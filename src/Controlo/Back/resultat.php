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

//trie des listes en fonctions du choix utilisateur
switch ($contraintesGenerales->getAlgoRemplissage()) {
    case 'aléatoire':
        trieAlea();
        break;
    case 'descendant':
        trieDesc();
        break;
    default:
        trieAsce();
        echo "filtre acscendant";
        break;
}
var_dump($listeTTSansOrdi);
function trieAlea()
{
   shuffle($listeTTSansOrdi);
   shuffle($listeOrdi);
   shuffle($listeEtud);
}
function trieDesc()
{
        usort($listeTTSansOrdi, function ($a, $b) {
            return strcmp($b->getNom(), $a->getNom());
        });
        usort($listeOrdi, function ($a, $b) {
            return strcmp($b->getNom(), $a->getNom());
        });
        usort($listeEtud, function ($a, $b) {
            return strcmp($b->getNom(), $a->getNom());
        });
}
function trieAsce()
{
        usort($listeTTSansOrdi, function ($a, $b) {
            return strcmp($a->getNom(), $b->getNom());
        });
        usort($listeOrdi, function ($a, $b) {
            return strcmp($a->getNom(), $b->getNom());
        });
        usort($listeEtud, function ($a, $b) {
            return strcmp($a->getNom(), $b->getNom());
        });
}


// genererPDF($unControle);
//aaficher controle
// var_dump( $unControle);

print("contrle id: " . $_GET["id"] . "<br>")
    // include("test.php");
    ?>
<html>page resultat

</html>