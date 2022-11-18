<?php

class ContraintesGenerales
{

    //VARIABLES
    
    private $algoRemplissage;
    private $coteACote;
    private $monPlan;

    //ENCAPSULATION

    public function getAlgoRemplissage()
    {
        return $this->algoRemplissage; 
    }

    public function setAlgoRemplissage($nouveauAlgoRemplissage)
    {
        if ($nouveauAlgoRemplissage = "aléatoire" or $nouveauAlgoRemplissage == "ascendant" or $nouveauAlgoRemplissage =="descendant"){
            $this->algoRemplissage = $nouveauAlgoRemplissage;
        }
        else{
            $this->algoRemplissage ="ascendant";
        }
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