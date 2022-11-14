<?php

class Controle
{
    // Variables
    private $nomLong;
    private $nomCourt;
    private $date;
    private $duree;
    private $heureTT;
    private $heureNonTT;
    private $mesPromotions = array();
    private $mesSalles = array();
    private $mesPlansDePlacement = array();

    // Encapsulation

    public function getNomLong()
    {
        return $this->nomLong;
    }

    public function setNomLong($nouveauNomLong)
    {
        $this->nomLong = $nouveauNomLong;
    }

    public function getNomCourt()
    {
        return $this->nomCourt;
    }

    public function setNomCourt($nouveauNomCourt)
    {
        $this->nomCourt = $nouveauNomCourt;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($nouvelleDate)
    {
        $this->date = $nouvelleDate;
    }

    public function getDuree()
    {
        return $this->duree;
    }

    public function setDuree($nouvelleDuree)
    {
        $this->duree = $nouvelleDuree;
    }

    public function getHeureNonTT()
    {
        return $this->heureNonTT;
    }

    public function setHeureNonTT($nouvelleHeureNonTT)
    {
        $this->heureNonTT = $nouvelleHeureNonTT;
    }

    public function getHeureTT()
    {
        return $this->heureTT;
    }

    public function setHeureTT($nouvelleHeureTT)
    {
        $this->heureTT = $nouvelleHeureTT;
    }

    // Méthodes usuelles

    public function ajouterPromotion($unePromotion)
    {
        array_push($this->mesPromotions, $unePromotion);
    }

    public function supprimerPromotion($unePromotion)
    {
        if (array_key_exists($unePromotion, $this->mesPromotions)) {
            unset($this->mesPromotions[$unePromotion]);
        }
    }

    public function ajouterSalle($uneSalle)
    {
        array_push($this->mesSalles, $uneSalle);
    }

    public function supprimerSalle($uneSalle)
    {
        if (array_key_exists($uneSalle, $this->mesSalles)) {
            unset($this->mesSalles[$uneSalle]);
        }
    }

    public function ajouterPlanDePlacement($unPlanDePlacement)
    {
        array_push($this->mesPlansDePlacement, $unPlanDePlacement);
    }

    public function supprimerPlanDePlacement($unPlanDePlacement)
    {
        if (array_key_exists($unPlanDePlacement, $this->mesPlansDePlacement)) {
            unset($this->mesPlansDePlacement[$unPlanDePlacement]);
        }
    }

}
