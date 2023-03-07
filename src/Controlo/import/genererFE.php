<?php
/**
 * @file genererFE.php
 * @author Samuel HENTRICS LOISTINE <
 * @brief Fichier contenant la fonction genererFE qui
 * genere les feuilles d'émargement
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

    function LoadPlanSalle($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line) {
            $data[] = explode(';', trim($line));
        }

        // Remplacer les 0 par des espaces
        foreach ($data as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($value2 == 0) {
                    $data[$key][$key2] = " ";
                }
            }
        }

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
 * @brief Fonction permettant de générer le PDF des feuilles d'émargement
 */
function genererFE(){
    // TO DO

}