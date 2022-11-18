<?php
/**
 * Classe ContraintesEspacement permettant de définir les contraintes d'espacement
 */
class ContraintesGenerales
{

    //VARIABLES
    /**
     * Permet de connaitre l'ordre de tri des étudiants pour le placement.
     * 
     * @var string
     */
    private $algoRemplissage;

    /**
     * Permet de connaitre qui peut rester à coté d'un étudiant
     * 
     * @var string
     */
    private $coteACote;

    /**
     * Plan de placement d'un contrôle
     * 
     * @var PlanDePlacement
     */
    private $monPlan;

    //ENCAPSULATION

    /**
     * Retourne L'algo de remplissage 
     * 
     * @return string
     */
    public function getAlgoRemplissage()
    {
        return $this->algoRemplissage; 
    }

    /**
     * Permet d'affecter un algo de remplissage 
     * 
     * @param  string $nouveauAlgoRemplissage
     */
    public function setAlgoRemplissage($nouveauAlgoRemplissage)
    {
        if ($nouveauAlgoRemplissage = "aléatoire" or $nouveauAlgoRemplissage == "ascendant" or $nouveauAlgoRemplissage =="descendant"){
            $this->algoRemplissage = $nouveauAlgoRemplissage;
        }
        else{
            $this->algoRemplissage ="ascendant";
        }
    }

    /**
     * Retourne un variable qui identifie qui peut rester à coté d'un étudiant
     * 
     * @return string
     */
    public function getCoteACote()
    {
        return $this->coteACote;
    }

    /**
     * Permet d'affecter une variable qui identifie qui peut reste à coté d'un étudiant
     * 
     * @param string $nouveauCoteACote
     */
    public function setCoteACote($nouveauCoteACote)
    {
        if ($nouveauCoteACote = "tdDifférent" or $nouveauCoteACote == "tpDifférent" or$nouveauCoteACote =="alphabétique"){
            $this->coteACote = $nouveauCoteACote;
        }
        else{
            $this->coteACote ="alphabétique";
        }
    }

    /**
     * Retourne le plan de placement d'un contrôle
     * 
     * @return PlanDePlacement
     */
    public function getMonPlan()
    {
        return $this->monPlan;
    }

    /**
     * Permet d'affecter un plan de placement d'un contrôle
     * 
     * @param PlanDePlacement nouveauPlan
     */
    public function setMonPlan($nouveauPlan)
    {
        $this->monPlan = $nouveauPlan;
    }
}