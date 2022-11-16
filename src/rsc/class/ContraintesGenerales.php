<?php

class ContraintesGenerales
{

    //VARIABLES
    
    private $algoRemplissage;
    private $coteACote;
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

    public function getCoteACote()
    {
        return $this->coteACote;
    }

    public function setNbPlaces($nouveauCoteACote)
    {
        $this->coteACote = $nouveauCoteACote;

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