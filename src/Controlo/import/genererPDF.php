<?php
/**
 * @file genererPDF.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Fichier contenant la fonction genererPDF qui
 * genere plusieurs PDF à partir des PlanDePlacement d'un Controle
 * 
 * @version 1.0
 * @date 2022-12-29
 * 
 * 
 */

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
//                                 INCLUSIONS
// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
include_once(IMPORT_PATH . "fpdf.php");

include_once(FONCTION_CREER_LISTE_CONTROLES_PATH);
include_once(CLASS_PATH . CLASS_PLAN_PLACEMENT_FILE_NAME);
include_once(CLASS_PATH . CLASS_UN_PLACEMENT_FILE_NAME);


// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
//                      PARAMETRES SUPPLEMENTAIRES PDF
// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
class PDF extends FPDF
{
    /*
    ---------------------------------------------------------------
    Extension HTML (pour le soulignement plus facile de l'entête)
    ---------------------------------------------------------------
    */
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    function WriteHTML($html)
    {
        // Parseur HTML
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                // Texte
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                else
                    $this->Write(5, $e);
            } else {
                // Balise
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    // Extraction des attributs
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Balise ouvrante
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, true);
        if ($tag == 'A')
            $this->HREF = $attr['HREF'];
        if ($tag == 'BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Balise fermante
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, false);
        if ($tag == 'A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modifie le style et sélectionne la police correspondante
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach (array('B', 'I', 'U') as $s) {
            if ($this->$s > 0)
                $style .= $s;
        }
        $this->SetFont('', $style);
    }

    function PutLink($URL, $txt)
    {
        // Place un hyperlien
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }

    /*
    ---------------------------------------------------------------
    Extension Table (pour l'affichage du plan de Salle)
    ---------------------------------------------------------------
    */

    function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

    // Simple table
    function BasicTable($header, $data)
    {
        //En-tête
        $taille = 20;
        foreach ($header as $col) {
            $this->Cell($taille, 7, $col, 1);
            $taille *= 8;
        }
        $this->Ln();
        //Données
        foreach ($data as $row) {
            $taille = 20;
            foreach ($row as $col) {
                $this->Cell($taille, 6, $col, 1);
                $taille *= 8;
            }
            $this->Ln();
        }
    }

    // Table spéciale Salle
    function Salle($plan, $listePlacesPrises)
    {
        // Data
        foreach ($plan as $row) {
            $this->Cell(20);
            foreach ($row as $col) {
                if (in_array($col, $listePlacesPrises)) {
                    $this->SetFillColor(175, 175, 175);
                    $this->SetFont('Arial', 'B', 10);
                    $this->Cell(10, 5, $col, 1, 0, "C", true);
                    $this->SetFont('Arial', '', 10);
                } else {
                    $this->SetFillColor(255, 255, 255);
                    $this->Cell(10, 5, $col, 1, 0, "C", true);
                }
            }
            $this->Ln();
        }
    }


    /*
    ---------------------------------------------------------------
    Pied de page
    ---------------------------------------------------------------
    */
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial', 'I', 8);
        // Numéro de page
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------
//                             FONCTION PRINCIPALE
// ----------------------------------------------------------------------------
// ----------------------------------------------------------------------------

/**
 * @brief Fonction permettant de générer les PDF des PlanDePlacement d'un Controle donnée
 * @param Controle $unControle Controle auquel nous souhaitons générer un PlanDePlacement
 * @return void
 */
function genererPDF($unControle)
{
    // Données de l'entête pour chaque page
    //      Récupération des variables importantes pour l'entête
    $nomTotalControle = $unControle->getNomLong();
    $nomCourtControle = $unControle->getNomCourt();

    // Prendre le code ressource du controle (partie avant le -)
    $codeRessource = explode("-", $nomTotalControle)[0];
    // Prendre le nom du contrôle
    $premierTiret = strpos($nomTotalControle, "-");
    $nomControle = substr($nomTotalControle, $premierTiret + 1);

    // Récupération de la date du contrôle
    $dateControle = $unControle->getDate();
    $date = date('d/m/Y', strtotime($dateControle));

    // Récupération de l'heure du contrôle
    $heureTT = str_replace(":", "h", $unControle->getHeureTT());
    $heureNonTT = str_replace(":", "h", $unControle->getHeureNonTT());

    // Récupération de la durée du contrôle
    $dureeTT = $unControle->getDuree();
    $dureeTT = sprintf("%02dh%02d", floor($dureeTT / 60), ($dureeTT % 60));
    $dureeNonTT = $unControle->getDureeNonTT();
    $dureeNonTT = sprintf("%02dh%02d", floor($dureeNonTT / 60), ($dureeNonTT % 60));

    if(count($unControle->getMesPromotions()) > 1) {
        $affichagePromotion = "Promotions";
    }
    else{
        $affichagePromotion = "Promotion";
    }

    // Récupération des promotions du contrôle
    $lesPromotions = "";
    foreach ($unControle->getMesPromotions() as $numPromo => $unePromotion) {
        $lesPromotions .= $unePromotion->getNomAffichage() . " - ";
    }
    $lesPromotions = substr($lesPromotions, 0, -2);


    // Création du dossier dans le dossier des plans de placement
    $nomFichierGeneration = $unControle->getNomDossierGeneration();

    $cheminDossierControle = GENERATIONS_FOLDER_NAME . $nomFichierGeneration;
    $cheminDossierPDP = $cheminDossierControle . "/" . PLANS_DE_PLACEMENT_FOLDER_NAME;
    $cheminDossierPDPPDF = $cheminDossierPDP . PLANS_DE_PLACEMENT_PDF_FOLDER_NAME;

    // Crée le dossier Générations s'il n'existe pas/plus
    if(!file_exists(GENERATIONS_FOLDER_NAME)){
        mkdir(GENERATIONS_FOLDER_NAME);
    }

    // Crée le dossier du contrôle s'il n'existe pas/plus
    if(!file_exists($cheminDossierControle)){
        mkdir($cheminDossierControle);
    }

    // Crée le dossier des plans de placement s'il n'existe pas/plus
    if(!file_exists($cheminDossierPDP)){
        mkdir($cheminDossierPDP);
    }

    // Crée le dossier des plans de placement PDF s'il n'existe pas/plus
    if(!file_exists($cheminDossierPDPPDF)){
        mkdir($cheminDossierPDPPDF);
    }

    foreach ($unControle->getMesSalles() as $nomSalle => $uneSalle) {
        // Informations sur le PDP
        // Plan de Placement de la salle actuelle
        $pdpActuelle = $unControle->getMesPlansDePlacement()[$nomSalle];
        $listePlacementsPDP = $pdpActuelle->getMesPlacements();
        $sautDePageListeEtudiants = $pdpActuelle->getAffichageMemePage();

        $listePlaces = array();
        $numeroPlacesPrises = array();

        // Récupérer sous forme de liste ( (NUM_PLACE), (NOM_ETUDIANT) ) la liste
        // des places attribués dans listePlaces

        foreach ($listePlacementsPDP as $ligne) {
            foreach($ligne as $unPlacement) {

                $place = $unPlacement->getMaZone();
                $etudiant = $unPlacement->getMonEtudiant();

                $numeroPlace = $place->getNumero();
                // Afficher (E) si la place est une prise
                if ($place->getInfoPrise()) {
                    $numeroPlace .= "E";
                }
                
                // Ajouter le numéro de place si celle-ci est prise
                array_push($numeroPlacesPrises, $numeroPlace);


                $nomCompletEtudiant = $etudiant->getNom() . " " . $etudiant->getPrenom();
                // Ajouter (TT) si l'étudiant a un tiers-temps ou
                // (TT + Ordi) si l'étudiant a un tiers-temps et un ordinateur ou
                // (Ordi) si l'étudiant a un ordi
                if ($etudiant->getEstTT() and $etudiant->getAOrdi()) {
                    $nomCompletEtudiant .= " (TT + Ordi)";
                }
                elseif($etudiant->getAOrdi()){
                    $nomCompletEtudiant .= " (Ordi)";
                }
                elseif($etudiant->getEstTT()){
                    $nomCompletEtudiant .= " (TT)";
                }


                $infoUnePlace = array();
                array_push($infoUnePlace, $numeroPlace);
                array_push($infoUnePlace, $nomCompletEtudiant);

                $listePlaces[$place->getNumero()] = $infoUnePlace;
            }
        }

        // Tri du tableau par numéro de place
        ksort($listePlaces);


        // Instanciation de la classe dérivée
        $pdf = new PDF();
        $pdf->AliasNbPages();

        // Créer une nouvelle page
        $pdf->AddPage();

        // Titre de la page (Nom du contrôle)
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(80);
        $titre = utf8_decode("Contrôle");
        $pdf->Cell(30, 10, $titre, 0, 0, 'C');

        // Deuxieme ligne (Code du contrôle)
        $pdf->Ln(7);
        $pdf->Cell(80);
        $titre = utf8_decode($codeRessource);
        $pdf->Cell(30, 10, $titre, 0, 0, 'C');

        // Troisieme ligne (Nom du contrôle)
        $pdf->Ln(7);
        $pdf->Cell(80);
        $titre = utf8_decode($nomControle);
        $pdf->Cell(30, 10, $titre, 0, 0, 'C');

        $pdf->Ln(15);

        // Création de l'entête
        $totalEtudiants = count($listePlaces);

        $entete = '<u>Nom du contrôle</u> : ' . $nomTotalControle . '<br>' .
        '<u>'.$affichagePromotion.'</u> : ' . $lesPromotions . '            '.
        '<u>Nombre d\'étudiants</u> : ' . $totalEtudiants . '<br>'  .
        '<u>Date</u> : ' . $date . '            ' .
        '<u>Heure</u> : ' . $heureNonTT . ' (TT : ' . $heureTT . ')' . '            ' .
        '<u>Durée</u> : ' . $dureeNonTT . ' (TT : ' . $dureeTT . ')';


        // Affichage de l'entête
        $pdf->SetFont('Arial', '', 12);
        $pdf->WriteHTML(utf8_decode($entete));
        $pdf->Ln(15);

        // Affichage du nom de la salle
        $pdf->SetFont('Arial', 'U', 13);
        $pdf->Cell(80);
        $titre = utf8_decode("Salle " . $nomSalle);
        $pdf->Cell(30, 10, $titre, 0, 0, 'C');
        $pdf->Ln(15);

        // Affichage du plan de la salle
        $pdf->SetFont('Arial', '', 12);
        $planSalle = $pdf->LoadData(CSV_SALLES_FOLDER_NAME . $nomSalle . ".csv");
        $pdf->Salle($planSalle, $numeroPlacesPrises);
        $pdf->Ln(15);

        // Affichage de la nomenclature 
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Write(5, utf8_decode("Légende :"));
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(20, 10, "T", 1, 0, "C");
        $pdf->Cell(5, 10);
        $pdf->Cell(30, 10, "Tableau", 0, 0);
        $pdf->Cell(5, 10);

        $pdf->Cell(20, 10, "E", 1, 0, "C");
        $pdf->Cell(5, 10);
        $pdf->Cell(35, 10, "Place avec prise", 0, 0);
        $pdf->Cell(5, 10);

        $pdf->SetFillColor(175, 175, 175);
        $pdf->Cell(20, 10, "", 1, 0, "C", true);
        $pdf->Cell(5, 10);
        $pdf->Cell(35, 10, utf8_decode("Place occupée"), 0, 0);
        $pdf->Ln(15);

        // Saut de page si demandé
        if ($sautDePageListeEtudiants){
            $pdf->AddPage();
        }

        // Affichage du tableau avec les infos sur les étudiants et leurs places
        $header = array(utf8_decode("N° Place"), utf8_decode("Étudiant"));
        $pdf->BasicTable($header, $listePlaces);
        $pdf->Ln(15);

        // Enregistrer le PDF du PlanDePlacement actuel dans le dossier
        $nomFichier = $nomFichierGeneration . "_Plan_Placement_" . $nomSalle . ".pdf";

        // Si le fichier existe déjà, on le supprime
        if (file_exists($cheminDossierPDPPDF . $nomFichier)) {
            unlink($cheminDossierPDPPDF . $nomFichier);
        }

        $pdf->Output($cheminDossierPDPPDF . $nomFichier, 'F');
    }
}