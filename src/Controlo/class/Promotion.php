<?php
/**
 * @file Promotion.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la classe Promotion
 * @details Represente une Promotion par son nom et ses Etudiant
 * 
 * @version 1.1
 * @date 2022-12-18
 * 
 */


/**
 * @brief Classe Promotion permettant de définir une Promotion
 * avec son nom et sa liste d'Etudiant
 */
class Promotion
{
    // Variables

    /**
     * @brief Identifiant de la promotion
     * @var int
     */
    public $id;


    /**
     * @brief Nom de la promotion
     * 
     * @var string
     */
    private $nom;

    /**
     * @brief Nom de la promotion pour affichage
     * 
     * @var string
     */
    private $nomAffichage;

    /**
     * @brief Liste des Etudiants qui appartient à cette promotion
     * 
     * @var array
     */
    private $mesEtudiants = array();

    // Constructeur

    /**
     * @brief Constructeur de la classe Promotion
     *
     * @param string $nom Nom de la promotion
     */
    public function __construct($nom, $nomAffichage = null)

    {
        $this->setNom($nom);
        $this->setNomAffichage($nomAffichage);
    }


    // Encapsulation

    /**
     * @brief Retourne l'id de la Promotion
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @brief Permet d'affecter un id a une Promotion

     * 
     * @param string $nouveauNom
     */
    public function setId($id)
    {
        $this->id = $id;
    }




    /**
     * @brief Retourne le nom de la Promotion
     * 
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @brief Permet d'affecter un nom à une Promotion
     * 
     * @param string $nouveauNom
     */
    public function setNom($nouveauNom)
    {
        $this->nom = $nouveauNom;
    }


    
    /**
     * @brief Retourne le nom de la Promotion pour affichage
     * 
     * @return string
     */
    public function getNomAffichage()
    {
        return $this->nomAffichage;
    }

    /**
     * @brief Permet d'affecter un nom d'affichage à une Promotion
     * 
     * @param string $nouveauNom
     */
    public function setNomAffichage($nouveauNomAffichage)
    {
        $this->nomAffichage = $nouveauNomAffichage;
    }


    /**
     * @brief Retourne la liste des Etudiant
     * @return array
     */
    public function getMesEtudiants()
    {
        return $this->mesEtudiants;
    }

    // Méthodes usuelles

    /**
     * @brief Fonction permettant de vérifier si un étudiant existe dans la promotion
     * Retourne vrai s'il existe dans la liste, faux sinon
     * @param Etudiant $unEtudiant Etudiant recherché
     * @return bool Information si l'étudiant est dans la liste
     */
    public function existeEtudiant($unEtudiant)
    {
        if (in_array($unEtudiant, $this->getMesEtudiants())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Permet d'ajouter un étudiant à la promotion
     * 
     * @param Etudiant $unEtudiant
     */
    public function ajouterEtudiant($unEtudiant)
    {
        if (!$this->existeEtudiant($unEtudiant)) {
            array_push($this->mesEtudiants, $unEtudiant);
        }
    }

    /**
     * @brief Permet de supprimer un Etudiant de la Promotion
     * 
     * @param Etudiant $unEtudiant
     */
    public function supprimerEtudiant($unEtudiant)
    {
        if ($this->existeEtudiant($unEtudiant)) {
            unset($this->mesEtudiants[array_search($unEtudiant, $this->getMesEtudiants())]);
        }
    }

    /**
     * @brief Retourne la liste des Etudiant non tiers-temps dans la Promotion
     * @return array Liste des Etudiant non tiers-temps
     */
    public function recupererListeEtudiantsNonTT()
    {
        $listeEtudiantsNonTT = array();
        foreach ($this->getMesEtudiants() as $key => $unEtudiant) {
            if (!$unEtudiant->getEstTT() and !$unEtudiant->getAOrdi()){
                array_push($listeEtudiantsNonTT, $unEtudiant);
            }
        }
        return $listeEtudiantsNonTT;
    }

    /**
     * @brief Retourne la liste des Etudiant tiers-temps sans ordinateur dans la Promotion
     * @return array Liste des Etudiant tiers-temps sans ordinateur
     */
    public function recupererListeEtudiantsTTSansOrdi()
    {
        $listeEtudiantsTTSansOrdi = array();
        foreach ($this->getMesEtudiants() as $key => $unEtudiant) {
            if ($unEtudiant->getEstTT() && !$unEtudiant->getAOrdi()){
                array_push($listeEtudiantsTTSansOrdi, $unEtudiant);
            }
        }
        return $listeEtudiantsTTSansOrdi;
    }

    /**
     * @brief Retourne la liste des Etudiant avec ordinateur dans la Promotion
     * @return array Liste des Etudiant avec ordinateur
     */
    public function recupererListeEtudiantsOrdi()
    {
        $listeEtudiantsOrdi = array();
        foreach ($this->getMesEtudiants() as $key => $unEtudiant) {
            if ($unEtudiant->getAOrdi()){
                array_push($listeEtudiantsOrdi, $unEtudiant);
            }
        }
        return $listeEtudiantsOrdi;
    }

    /**
     * @brief Retourne la liste des Etudiant démisionnaires dans la Promotion
     * @return array Liste des Etudiant démisionnaires
     */
    public function recupererListeEtudiantsDemisionnaire()
    {
        $listeEtudiantsDemisionnaire = array();
        foreach ($this->getMesEtudiants() as $key => $unEtudiant) {
            if ($unEtudiant->getEstDemissionnaire()){
                array_push($listeEtudiantsDemisionnaire, $unEtudiant);
            }
        }
        return $listeEtudiantsDemisionnaire;
    }

    /**
     * @brief Retourne la liste des Etudiant avec ordinateur dans la Promotion
     * @return array Liste des Etudiant avec ordinateur
     */
    public function recupererListeEtudiantsTT()
    {
        $listeEtudiantsTT = array();
        foreach ($this->getMesEtudiants() as $key => $unEtudiant) {
            if ($unEtudiant->getEstTT()){
                array_push($listeEtudiantsOrdi, $unEtudiant);
            }
        }
        return $listeEtudiantsTT;
    }

    /**
     * @brief Retourne le nom d'affichage de la Promotion
     * @return array Nom pour affichage de la promotion
     */
    public function recupererNomPromotionAffichage($unePromotion)
    {
    // Récupérer le nom pour affichage de la promotion
    $lienFichier = CSV_ETUDIANTS_FOLDER_NAME.LISTE_PROMOTIONS_FILE_NAME;
    $file =  fopen($lienFichier  , "r");

    $nomAffichage = $unePromotion->getNom();
    // Récupérer dans le fichier le nom pour affichage de la promotion
    while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
        if ($data[0] == $unePromotion->getNom()) {
            if($data[1]!=null){
                $nomAffichage = $data[1];
            }
        }
    }
    return $nomAffichage;
    }
}
?>