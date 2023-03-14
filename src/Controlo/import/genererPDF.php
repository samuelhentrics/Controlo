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
include_once(FONCTION_AJOUTER_MINUTES_HEURE_PATH);


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

    function TableListeEmarg($header, $data)
    {
        //En-tête
        $taille = 20;
        $num = 0;
        foreach ($header as $col) {
            $this->Cell($taille, 6, $col, 1);
            if($num == 0){
                $taille *= 2.85;
                $num++;
            }
        }
        $this->Ln();
        //Données
        foreach ($data as $row) {
            $taille = 20;
            $num = 0;
            foreach ($row as $col) {
                $this->Cell($taille, 10, $col, 1);
                if($num == 0){
                    $taille *= 2.85;
                    $num++;
                }
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
function genererPDFPDP($unControle)
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
    $date = $unControle->getDate();
    // $date = date('d/m/Y', strtotime($dateControle));

    // Récupération de la durée du contrôle
    $dureeTT = $unControle->getDuree();
    $dureeTT = sprintf("%02dh%02d", floor($dureeTT / 60), ($dureeTT % 60));
    $dureeNonTT = $unControle->getDureeNonTT();
    $dureeNonTT = sprintf("%02dh%02d", floor($dureeNonTT / 60), ($dureeNonTT % 60));

    // Récupération de l'heure du contrôle
    $heureTT = str_replace(":", "h", $unControle->getHeureTT());
    $heureNonTT = str_replace(":", "h", $unControle->getHeureNonTT());

    $heureFinTT = str_replace(":", "h", ajouterMinutesHeure($unControle->getHeureTT(), $unControle->getDuree()));
    $heureFinNonTT = str_replace(":", "h", ajouterMinutesHeure($unControle->getHeureNonTT(), $unControle->getDureeNonTT()));

    if (count($unControle->getMesPromotions()) > 1) {
        $affichagePromotion = "Promotions";
    } else {
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
    if (!file_exists(GENERATIONS_FOLDER_NAME)) {
        mkdir(GENERATIONS_FOLDER_NAME);
    }

    // Crée le dossier du contrôle s'il n'existe pas/plus
    if (!file_exists($cheminDossierControle)) {
        mkdir($cheminDossierControle);
    }

    // Créer le fichier "mail.txt" s'il n'existe pas/plus et lui mettre 0 en première ligne
    if (!file_exists($cheminDossierControle . "/mails.txt")) {
        $fichier = fopen($cheminDossierControle . "/mails.txt", "w");
        fwrite($fichier, "0");
        fclose($fichier);
    }

    // Crée le dossier des plans de placement s'il n'existe pas/plus
    if (!file_exists($cheminDossierPDP)) {
        mkdir($cheminDossierPDP);
    }

    // Crée le dossier des plans de placement PDF s'il n'existe pas/plus
    if (!file_exists($cheminDossierPDPPDF)) {
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
            foreach ($ligne as $unPlacement) {

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
                } elseif ($etudiant->getAOrdi()) {
                    $nomCompletEtudiant .= " (Ordi)";
                } elseif ($etudiant->getEstTT()) {
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
            '<u>' . $affichagePromotion . '</u> : ' . $lesPromotions . '            ' .
            '<u>Nombre d\'étudiants</u> : ' . $totalEtudiants . '<br>' .
            '<u>Date</u> : ' . $date . '            ' .
            '<u>Heure</u> : ' . $heureNonTT . '-' . $heureFinNonTT .' (' . $dureeNonTT . ')' . '            ' .
            '<u>TT</u> : ' . $heureTT . '-' . $heureFinTT . ' (' . $dureeTT . ')';


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
        $planSalle = $pdf->LoadPlanSalle(CSV_SALLES_FOLDER_NAME . $nomSalle . ".csv");
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
        if ($sautDePageListeEtudiants) {
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


function genererCSVPDP($unControle)
{

    // Récupérer les infos du contrôle
    $listePDP = $unControle->getMesPlansDePlacement();

    $nomFichierGeneration = $unControle->getNomDossierGeneration();
    $cheminDossierPDPCSV = GENERATIONS_FOLDER_NAME . $nomFichierGeneration . "/" . PLANS_DE_PLACEMENT_CSV_PATH;

    // Créer le dossier CSV s'il n'existe pas
    if (!file_exists($cheminDossierPDPCSV)) {
        mkdir($cheminDossierPDPCSV);
    }

    $csvPDP = array();
    
    // Ajout de l'entête
    $entete = array("Salle",
    "NumeroPlace",
    "Nom",
    "Prenom",
    "Statut",
    "Mail");

    array_push($csvPDP, $entete);

    // Pour chaque plan de placement
    foreach ($listePDP as $unPDP) {

        // Récupérer les infos du plan de placement
        $nomSalle = $unPDP->getMaSalle()->getNom();
        $listePlaces = $unPDP->getMesPlacements();

        // Pour chaque place
        foreach ($listePlaces as $uneLigne) {
            foreach ($uneLigne as $unPlacement) {
                // Récupérer les infos de la place
                $unePlace = $unPlacement->getMaZone();

                $numeroPlace = $unePlace->getNumero();
                $etudiant = $unPlacement->getMonEtudiant();

                // Si l'étudiant est null, on ne fait rien
                if ($etudiant != null) {

                    // Récupérer les infos de l'étudiant
                    $nom = $etudiant->getNom();
                    $prenom = $etudiant->getPrenom();
                    // Ajouter (TT) si l'étudiant a un tiers-temps ou
                    // (TT + Ordi) si l'étudiant a un tiers-temps et un ordinateur ou
                    // (Ordi) si l'étudiant a un ordi
                    if ($etudiant->getEstTT()) {
                        $statut = "TT";
                    } else {
                        $statut = "";
                    }

                    // Mail étudiant
                    $mailEtudiant = $etudiant->getEmail();


                    $infoUnePlace = array();
                    array_push($infoUnePlace, $nomSalle);
                    array_push($infoUnePlace, $numeroPlace);
                    array_push($infoUnePlace, $nom);
                    array_push($infoUnePlace, $prenom);
                    array_push($infoUnePlace, $statut);
                    array_push($infoUnePlace, $mailEtudiant);


                    // Ajouter les infos de la place au tableau
                    array_push($csvPDP, $infoUnePlace);
                }
            }
        }

    }

    // Création du CSV
    $nomFichier =  "listeEtudiants.csv";

    // Si le fichier existe déjà, on le supprime
    if (file_exists($cheminDossierPDPCSV . $nomFichier)) {
        unlink($cheminDossierPDPCSV . $nomFichier);
    }

    // Création du fichier CSV
    $fichierCSV = fopen($cheminDossierPDPCSV . $nomFichier, 'w');

    // Ajout des infos dans le fichier CSV
    foreach ($csvPDP as $uneLigne) {
        fputcsv($fichierCSV, $uneLigne, ";");
    }

    // Fermeture du fichier CSV
    fclose($fichierCSV);

}



/**
 * @brief Fonction qui génère le PDF des feuilles d'émargement
 * @param $unControle Controle
 */
function genererPDFFE($unControle, $anneeUniversitaire)
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
    $date = $unControle->getDate();
    // $date = date('d/m/Y', strtotime($dateControle));

    // Récupération de la durée du contrôle
    $dureeTT = $unControle->getDuree();
    $dureeTT = sprintf("%02dh%02d", floor($dureeTT / 60), ($dureeTT % 60));
    $dureeNonTT = $unControle->getDureeNonTT();
    $dureeNonTT = sprintf("%02dh%02d", floor($dureeNonTT / 60), ($dureeNonTT % 60));


    // Enseignants référents
    $listeEnseignants = $unControle->getMesEnseignantsReferents();
    $enseignants = "";
    foreach($listeEnseignants as $unEnseignant) {
        $enseignants .= $unEnseignant . ", ";
    }
    $enseignants = substr($enseignants, 0, -2);


    // Surveillants
    $listeSurveillants = $unControle->obtenirEnsSalles();

    // Récupération de l'heure du contrôle
    $heureTT = str_replace(":", "h", $unControle->getHeureTT());
    $heureNonTT = str_replace(":", "h", $unControle->getHeureNonTT());

    $heureFinTT = str_replace(":", "h", ajouterMinutesHeure($unControle->getHeureTT(), $unControle->getDuree()));
    $heureFinNonTT = str_replace(":", "h", ajouterMinutesHeure($unControle->getHeureNonTT(), $unControle->getDureeNonTT()));

    if (count($unControle->getMesPromotions()) > 1) {
        $affichagePromotion = "Promotions";
    } else {
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
    $cheminDossierPDPCSV = $cheminDossierPDP . PLANS_DE_PLACEMENT_CSV_FOLDER_NAME;
    $fichierListeEtudiants = $cheminDossierPDPCSV . "listeEtudiants.csv";
    $cheminDossierFE = $cheminDossierControle . "/" . FEUILLES_EMARGEMENT_FOLDER_NAME;

    // Crée le dossier Générations s'il n'existe pas/plus
    if (!file_exists(GENERATIONS_FOLDER_NAME)) {
        mkdir(GENERATIONS_FOLDER_NAME);
    }

    // Crée le dossier du contrôle s'il n'existe pas/plus
    if (!file_exists($cheminDossierControle)) {
        mkdir($cheminDossierControle);
    }

    // Crée le dossier des plans de placement en csv s'il n'existe pas/plus
    if (!file_exists($cheminDossierPDPCSV)) {
        mkdir($cheminDossierPDPCSV);
    }

    // Arret du code si le dossier n'existe pas
    if (!file_exists($cheminDossierPDPCSV)) {
        return;
    }

    if (!file_exists($cheminDossierFE)) {
        mkdir($cheminDossierFE);
    }

    // Tentative ouverture du fichier CSV
    if (($fichierCSV = fopen($fichierListeEtudiants, "r")) !== FALSE) {
        // Enlever l'entete
        fgetcsv($fichierCSV, 1000, ";");
        // Récupération des données du fichier CSV
        $csvPDP = array();
        while (($uneLigne = fgetcsv($fichierCSV, 1000, ";")) !== FALSE) {
            $infoPlace = array();
            // Récupération des informations de la place
            $infoPlace["NumeroPlace"] = $uneLigne[1];
            $infoPlace["Nom"] = $uneLigne[2];
            $infoPlace["Prenom"] = $uneLigne[3];
            $infoPlace["emargement"] = null;

            // Vérifier que l'id de la salle existe
            if (!array_key_exists($uneLigne[0], $csvPDP)) {
                $csvPDP[$uneLigne[0]] = array();
            }

            array_push($csvPDP[$uneLigne[0]], $infoPlace);
        }

        // Fermeture du fichier CSV
        fclose($fichierCSV);

        // Trier les places
        foreach ($csvPDP as $nomSalle => $placesSalle) {
            // Trier les places par numéro de place
            usort($csvPDP[$nomSalle], function($a, $b) {
                return $a['NumeroPlace'] - $b['NumeroPlace'];
            });
        }
    }

    foreach ($csvPDP as $nomSalle => $placesSalle) {
        // Création du PDF
        $pdf = new PDF();
        $pdf->AliasNbPages();
        // Créer une nouvelle page
        $pdf->AddPage();

        // Création de l'entête n°1
        $entete1 = 
        NOM_IUT.'<br>'.
        DEPARTEMENT.'<br>'.
        'Année Universitaire '.$anneeUniversitaire.'<br>'.
        'Feuille d\'émargement de contrôle';

        $pdf->SetFont('Arial', '', 12);
        $pdf->WriteHTML(utf8_decode($entete1));
        $pdf->Ln(10);

        // Affichage du titre
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode($nomSalle), 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        // Création de l'entête n°2
        $totalEtudiants = count($placesSalle);

        $entete2 =
            '<u>Nom du contrôle</u> : ' . $nomTotalControle . '<br>' .
            '<u>' . $affichagePromotion . '</u> : ' . $lesPromotions . '            ' .
            '<u>Nombre d\'étudiants</u> : ' . $totalEtudiants . '<br>' .
            '<u>Date</u> : ' . $date . '            ' .
            '<u>Heure</u> : ' . $heureNonTT . '-' . $heureFinNonTT .' (' . $dureeNonTT . ')' . '            ' .
            '<u>TT</u> : ' . $heureTT . '-' . $heureFinTT . ' (' . $dureeTT . ')<br>'.
            '<u>Enseignant(s)</u> : ' . $enseignants . '<br>' .
            '<u>Surveillant(s)</u> : ' . $listeSurveillants[$nomSalle];
            ;


        // Affichage de l'entête
        $pdf->SetFont('Arial', '', 12);
        $pdf->WriteHTML(utf8_decode($entete2));
        $pdf->Ln(15);


        $pdf->SetFont('Arial', '', 12);

        // Affichage du tableau avec les infos sur les étudiants et leurs places
        $header = array(utf8_decode("N° Place"), utf8_decode("Nom"), utf8_decode("Prénom"), utf8_decode("Signature"));
        $pdf->TableListeEmarg($header, $placesSalle);
        $pdf->Ln(15);


        
        // Enregistrer le PDF du PlanDePlacement actuel dans le dossier
        $nomFichier = $nomFichierGeneration . "_Feuille_Emargement_".$nomSalle.".pdf";

        // Si le fichier existe déjà, on le supprime
        if (file_exists($cheminDossierFE . $nomFichier)) {
            unlink($cheminDossierFE . $nomFichier);
        }

        $pdf->Output($cheminDossierFE . $nomFichier, 'F');
    }
}