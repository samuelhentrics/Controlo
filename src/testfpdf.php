<?php

// Include config
include("config.php");


// Include classe controle, salle...
include(FONCTION_CREER_LISTE_CONTROLES_PATH);
include(IMPORT_PATH . "fpdf.php");

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
        // Header
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

    // Better table
    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(40, 35, 40, 45);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Data
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R');
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 35, 40, 45);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
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

// Récupérer le contrôle
$unControle = creerListeControles()[0];


// Création de l'entête pour chaque page
//      Récupération des variables importantes pour l'entête
$nomControle = $unControle->getNomLong();

$date = $unControle->getDate();
$date = date('d/m/Y', strtotime($date));

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

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();

foreach ($unControle->getMesSalles() as $nomSalle => $uneSalle) {
    // Créer une nouvelle page
    $pdf->AddPage();

    // Police Arial gras 15
    $pdf->SetFont('Arial', 'B', 15);
    // Décalage à droite
    $pdf->Cell(80);
    // Titre
    $titre = utf8_decode($unControle->getNomCourt() . " - Contrôle");
    $pdf->Cell(30, 10, $titre, 0, 0, 'C');
    // Saut de ligne
    $pdf->Ln(15);

    // Affichage de l'entête
    $pdf->SetFont('Arial', '', 12);
    $pdf->WriteHTML(utf8_decode($entete));
    $pdf->Ln(15);

    // Affichage du nom de la salle
    $pdf->SetFont('Arial', 'U', 13);
    $pdf->Cell(80);
    $titre = utf8_decode("Salle " . $uneSalle->getNom());
    $pdf->Cell(30, 10, $titre, 0, 0, 'C');
    $pdf->Ln(20);

}

$pdf->Output();
