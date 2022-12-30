<?php
/**
 * @file ContraintesEspacement.php
 * @author Cédric ETCHEPARE
 * @brief Spécification de la classe Contraintes Espacement
 * @details Represente les contraintes d'espacement d'un contrôle pour une salle
 * avec le nombre de rangées et de places d'espacement entre chaque étudiant
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 */


/**
 * @brief Classe ContraintesEspacement permettant de définir les contraintes d'espacement
 * @todo Constructeur
 */
class ContraintesEspacement
{

    //VARIABLES
    /**
     * Nombre de rangées espaçant chaque Etudiant dans une Salle
     * 
     * @var int
     */
    private $nbRangs;

    /**
     * Nombre de places espaçant chaque Etudiant dans une Salle
     * 
     * @var int
     */
    private $nbPlaces;
    

    // Constructeur

    /**
     * @brief Constructeur de ContraintesEspacement
     *
     * @param int $unNbDeRang Nombre de rang dans la Salle
     * @param int $unNbDePlaces Nombre de place dans la Salle
     */
    function __construct($unNbDeRang, $unNbDePlaces)
    {
        $this->setNbRangs($unNbDeRang);
        $this->setNbPlaces($unNbDePlaces);
    }








    //ENCAPSULATION

    /**
     * Retourne le nombre de rangs séparant les étudiants dans une Salle pour un
     * PlanDePlacement d'un Controle
     * 
     * @return int
     */
    public function getNbRangs()
    {
        return $this->nbRangs;
    }

    /**
     * Permet d'affecter le nombre de rangs séparant les étudiants dans une Salle pour un
     * PlanDePlacement d'un Controle
     * 
     * @param int $nouveauNbRangs Nombre de rangées qui sépare les étudiants
     */
    public function setNbRangs($nouveauNbRangs)
    {
        $this->nbRangs = $nouveauNbRangs;
    }

    /**
     * Retourne le nombre de places séparant les étudiants dans une Salle pour un
     * PlanDePlacement d'un Controle
     * 
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Permet d'affecter le nombre de places séparant les étudiants dans une Salle pour un
     * PlanDePlacement d'un Controle
     * 
     * @param int $nouveauNbPlaces Nombre de places qui sépare les étudiants
     */
    public function setNbPlaces($nouveauNbPlaces)
    {
        $this->nbPlaces = $nouveauNbPlaces;
    }

}
