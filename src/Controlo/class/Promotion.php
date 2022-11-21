<?php
/**
 * Classe Promotion permettant de définir une promotion
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
     * Liste des contrôles dont la promotion va  participer
     * 
     * @var array
     */
    private $mesControles = array();

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

    /**
     * Permet d'affecter un nom à une Promotion
     * 
     * @param string $nouveauNom
     */
    public function setNom($nouveauNom)
    {
        $this->nom=$nouveauNom;
    }

    // Méthodes usuelles
    
    /**
     * Permet d'ajouter un contrôle à la liste des contrôles dont la promotion va participer
     * 
     * @param Controle $unControle
     */
    public function ajouterControle($unControle)
    {
        array_push($this->mesControles, $unControle);
    }

    /**
     * Permet de supprimer un contrôle à la liste des contrôles dont la promotion va participer
     * 
     * @param Controle $unControle
     */
    public function supprimerControle($unControle)
    {
        if (array_key_exists($unControle, $this->mesControles)) {
            unset($this->mesControles[$unControle]);
        }
    }

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