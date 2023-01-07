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
    function Salle($data)
    {
        // Data
        foreach ($data as $row) {
            $this->Cell(20);
            foreach ($row as $col) {
                $this->Cell(10, 5, $col, 1, 0, "C");
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
    // Création de l'entête pour chaque page
    //      Récupération des variables importantes pour l'entête
    $nomControle = $unControle->getNomLong();
    $nomCourtControle = $unControle->getNomCourt();

    $dateControle = $unControle->getDate();
    $date = date('d/m/Y', strtotime($dateControle));

    $heureTT = str_replace(":", "h", $unControle->getHeureTT());

    $heureNonTT = str_replace(":", "h", $unControle->getHeureNonTT());

    $dureeTT = $unControle->getDuree();
    $dureeTT = sprintf("%02dh%02d", floor($dureeTT / 60), ($dureeTT % 60));

    $dureeNonTT = $unControle->getDureeNonTT();
    $dureeNonTT = sprintf("%02dh%02d", floor($dureeNonTT / 60), ($dureeNonTT % 60));

    $lesPromotions = "";
    foreach ($unControle->getMesPromotions() as $numPromo => $unePromotion) {
        $lesPromotions .= $unePromotion->getNom() . " - ";
    }
    $lesPromotions = substr($lesPromotions, 0, -2);


    $entete = '<u>Nom du contrôle</u> : ' . $nomControle . '<br>' .
        '<u>Promotion(s)</u> : ' . $lesPromotions . '<br>' .
        '<u>Date</u> : ' . $date . '            ' .
        '<u>Heure</u> : ' . $heureNonTT . ' (TT : ' . $heureTT . ')' . '            ' .
        '<u>Durée</u> : ' . $dureeNonTT . ' (TT : ' . $dureeTT . ')';


    // Création du dossier dans le dossier des plans de placement
    $dateFormatDossier = date('Y-m-d', strtotime($dateControle));

    $nomFormatDossier = str_replace("-", "", $nomCourtControle);
    $nomFormatDossier = str_replace(".", "-", $nomFormatDossier);
    $nomFormatDossier = preg_replace("/\s+/", " ", $nomFormatDossier);
    $nomFormatDossier = trim($nomFormatDossier);
    $nomFormatDossier = str_replace("/", "-", $nomFormatDossier);
    $nomFormatDossier = str_replace(" ", "-", $nomFormatDossier);

    $nomDossier = PLANS_DE_PLACEMENT_FOLDER_NAME . $dateFormatDossier . "_" . $nomFormatDossier . "/";

    // Crée le dossier PlansPlacement s'il n'existe pas/plus
    if(!file_exists(PLANS_DE_PLACEMENT_FOLDER_NAME)){
        mkdir(PLANS_DE_PLACEMENT_FOLDER_NAME);
    }

    // Crée le dossier du contrôle s'il n'existe pas
    if (!file_exists($nomDossier)) {
        mkdir($nomDossier);
    }

    foreach ($unControle->getMesSalles() as $nomSalle => $uneSalle) {
        // Instanciation de la classe dérivée
        $pdf = new PDF();
        $pdf->AliasNbPages();
        // Créer une nouvelle page
        $pdf->AddPage();

        // Titre de la page (Nom du contrôle)
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(80);
        $titre = utf8_decode($nomCourtControle . " - Contrôle");
        $pdf->Cell(30, 10, $titre, 0, 0, 'C');
        $pdf->Ln(15);

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
        $data = $pdf->LoadData(CSV_SALLES_PATH . $nomSalle . ".csv");
        $pdf->Salle($data);
        $pdf->Ln(15);

        // Affichage de la nomenclature 
        $pdf->SetFont('Arial', 'U', 12);
        $pdf->Write(5, utf8_decode("Légende (X est un entier naturel) :"));
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(20, 10, "T", 1, 0, "C");
        $pdf->Cell(5, 10);
        $pdf->Cell(30, 10, "Tableau", 0, 0);
        $pdf->Cell(5, 10);

        $pdf->Cell(20, 10, "E", 1, 0, "C");
        $pdf->Cell(5, 10);
        $pdf->Cell(40, 10, "Place avec prise", 0, 0);
        $pdf->Cell(5, 10);

        $pdf->Cell(20, 10, "X", 1, 0, "C");
        $pdf->Cell(5, 10);
        $pdf->Cell(30, 10, "Place", 0, 0);
        $pdf->Ln(15);

        // Plan de Placement de la salle actuelle
        $pdpActuelle = $unControle->getMesPlansDePlacement()[$nomSalle];
        $listePlacementsPDP = $pdpActuelle->getMesPlacements();

        $arrayPlaces = array();

        // Récupérer sous forme de liste ( (NUM_PLACE), (NOM_ETUDIANT) ) la liste
        // des places attribués dans arrayPlaces

        foreach ($listePlacementsPDP as $ligne) {
            foreach($ligne as $unPlacement) {

                $place = $unPlacement->getMaZone();
                $etudiant = $unPlacement->getMonEtudiant();

                $numeroPlace = $place->getNumero();
                // Afficher (E) si la place est une prise
                if ($place->getInfoPrise()) {
                    $numeroPlace .= "E";
                }

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

                $arrayPlaces[$place->getNumero()] = $infoUnePlace;
            }
        }

        // Tri du tableau par numéro de place
        ksort($arrayPlaces);

        // Affichage du tableau avec les infos sur les étudiants et leurs places
        $header = array(utf8_decode("N° Place"), utf8_decode("Étudiant"));
        $pdf->BasicTable($header, $arrayPlaces);
        $pdf->Ln(15);

        // Enregistrer le PDF du PlanDePlacement actuel dans le dossier
        $nomFichier = $dateFormatDossier . "_" . $nomFormatDossier . "_Plan_Placement_" . $nomSalle . ".pdf";
        $pdf->Output($nomDossier . $nomFichier, 'F');
    }
}