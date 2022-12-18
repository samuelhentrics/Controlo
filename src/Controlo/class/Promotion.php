<?php
/**
 * @file Salle.php
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
     * Nom de la promotion
     * 
     * @var string
     */
    private $nom;

    /**
     * Liste des Etudiants qui appartient à cette promotion
     * 
     * @var array
     */
    private $mesEtudiants = array();

    // Constructeur

    /**
     * Constructeur de la classe Promotion
     *
     * @param string $nom Nom de la promotion
     */
    public function __construct($nom)
    {
        $this->setNom($nom);
    }


    // Encapsulation

    /**
     * Retourne le nom de la promotion
     * 
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Permet d'affecter un nom à une Promotion
     * 
     * @param string $nouveauNom
     */
    public function setNom($nouveauNom)
    {
        $this->nom=$nouveauNom;
    }

    public function getMesEtudiants(){
        return $this->mesEtudiants;
    }

    // Méthodes usuelles

    /**
     * Fonction permettant de vérifier si un étudiant existe dans la promotion
     * Retourne vrai s'il existe dans la liste, faux sinon
     * @param Etudiant $unEtudiant Etudiant recherché
     * @return bool Information si l'étudiant est dans la liste
     */
    public function existeEtudiant($unEtudiant){
        if (in_array($unEtudiant, $this->getMesEtudiants())) {
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Permet d'ajouter un étudiant à la promotion
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
     * Permet de supprimer un Etudiant de la Promotion
     * 
     * @param Etudiant $unEtudiant
     */
    public function supprimerEtudiant($unEtudiant)
    {
        if ($this->existeEtudiant($unEtudiant)) {
            unset($this->mesEtudiants[array_search($unEtudiant, $this->getMesEtudiants())]);
        }
    }

}
?>