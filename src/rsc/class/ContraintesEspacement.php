<?php
/**
 * Classe ContraintesEspacement permettant de définir les contraintes d'espacement
 */
class ContraintesEspacement
{

    //VARIABLES
    /**
     * nombre de rang d'une salle
     * 
     * @var int
     */
    private $nbRang;

    /**
     * Nombre de places dans la salle
     * 
     * @var int
     */
    private $nbPlaces;
    
    /**
     * Le plan de la salle
     * 
     * @var PlanDePlacement
     */
    private $monPlan;

    //ENCAPSULATION
    
    /**
     * Retourne le nombre de rangs de la salle
     * 
     * @return int
     */
    public function getNbRang()
    {
        return $this->nbRang;
    }

    /**
     * Permet d'affecter un nombre de rangs à une salle
     * 
     * @param int $nouveauNBRang
     */
    public function setNbRang($nouveauNbRang)
    {
        $this->nbRang = $nouveauNbRang;
    }

    /**
     * Retourne le nombre de places dans la salle
     * 
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Permet d'affecter un nombre de places à une salle
     * 
     * @param int $nouveauNBPlaces
     */
    public function setNbPlaces($nouveauNbPlaces)
    {
        $this->nbPlaces = $nouveauNbPlaces;

    }

    /**
     * Retourne le plan de la salle
     * 
     * @retrun PlanDePlacement
     */
    public function getMonPlan()
    {
        return $this->monPlan;
    }

    /**
     * Permet d'affecter un plan de salle à une salle
     * 
     * @param PlanDePlacement nouveauPlan
     */
    public function setMonPlan($nouveauPlan)
    {
        $this->monPlan = $nouveauPlan;
    }
}
