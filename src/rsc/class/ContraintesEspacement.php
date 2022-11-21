<?php

/**
 * Classe ContraintesEspacement permettant de définir les contraintes d'espacement
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
