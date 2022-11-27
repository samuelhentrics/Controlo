<?php
/**
 * @brief Classe Promotion permettant de définir une Promotion
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
     * Permet d'ajouter un étudiant à la promotion
     * 
     * @param Etudiant $unEtudiant
     */
    public function ajouterEtudiant($unEtudiant)
    {
        array_push($this->mesEtudiants, $unEtudiant);
    }

    /**
     * Permet de supprimer un étudiant de la promotion
     * 
     * @param Etudiant $unEtudiant
     */
    public function supprimerEtudiant($unEtudiant)
    {
        if (array_key_exists($unEtudiant, $this->mesEtudiants)) {
            unset($this->mesEtudiants[$unEtudiant]);
        }
    }
}
?>