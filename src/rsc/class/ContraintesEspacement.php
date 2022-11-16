<?php

class ContraintesEspacement
{

    //VARIABLES
    
    private $nbRang;
    private $nbPlaces;
    private $monPlan;

    //ENCAPSULATION

    public function getNbRang()
    {
        return $this->nbRang;
    }

    public function setNbRang($nouveauNbRang)
    {
        $this->nbRang = $nouveauNbRang;
    }

    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces($nouveauNbPlaces)
    {
        $this->nbPlaces = $nouveauNbPlaces;

    }

    public function getMonPlan()
    {
        return $this->monPlan;
    }

    public function setMonPlan($nouveauPlan)
    {
        $this->monPlan = $nouveauPlan;
    }
}
