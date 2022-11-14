<?php
class Salle
{

    //VARIABLES
    private $nom;
    private $monPlan;
    private $monVoisin;

    //ENCAPSULATION
    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nouveauNom)
    {
        $this->$nom = $nouveauNom;
    }

    public function getMonPlan()
    {
        return $this->monPlan;
    }

    public function setMonPlan($nouveauPlan)
    {
        $this->$monPlan = $nouveauPlan;

    }

    public function getMonVoisin()
    {
        return $this->monVoisin;
    }

    public function setMonVoisin($nouveauVoisin)
    {
        $this->$monVoisin = $nouveauVoisin;
    }
}



