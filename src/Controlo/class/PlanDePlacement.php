<?php
class PlanDePlacement{

    private $maSalle;
    private $monControle;
    private $maContrainteGenerale;
    private $maContrainteEspacement;
    private $mesPlacements = array();


    public function getMaSalle(){
        return $this->maSalle;
    }

    public function setMaSalle($uneSalle)
    {
        $this->maSalle = $uneSalle;
    }

    public function getMonControle(){
        return $this->monControle;
    }

    public function setMonControle($unControle)
    {
        $this->monControle = $unControle;
    }

    public function getMaContrainteGenerale(){
        return $this->maContrainteGenerale;
    }

    public function setMaContrainteGenerale($uneContrainteGenerale)
    {
        $this->maContrainteGenerale = $uneContrainteGenerale;
    }

    public function getMaContrainteEspacement(){
        return $this->maContrainteEspacement;
    }

    public function setMaContrainteEspacement($uneContrainteEspacement)
    {
        $this->maContrainteEspacement = $uneContrainteEspacement;
    }

    public function getMesPlacements(){
        return $this->mesPlacements;
    }

    public function existePlacement($unPlacement){
        if (in_array($unPlacement, $this->getMesPlacements())) {
            return true;
        }
        else{
            return false;
        }
    }

    public function ajouterPlacement($unPlacement)
    {
        if (!$this->existePlacement($unPlacement)) {
            array_push($this->mesPlacements, $unPlacement);
        }
    }

    public function supprimerPlacement($unPlacement)
    {
        if ($this->existePlacement($unPlacement)) {
            unset($this->mesPlacements[array_search($unPlacement, $this->getMesPlacements())]);
        }
    }

 }