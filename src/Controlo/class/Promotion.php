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
     * @brief Nom de la promotion
     * 
     * @var string
     */
    private $nom;

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
    public function __construct($nom)
    {
        $this->setNom($nom);
    }


    // Encapsulation

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
            if (!$unEtudiant->getEstTT()){
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


}
?>