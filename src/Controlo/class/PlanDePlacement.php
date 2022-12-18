<?php
class PlanDePlacement{

    private $maSalle;
    private $monControle;
    private $maContrainteGenerale;
    private $maContrainteEspacement;

    public function getMaSalle(){
        return $this->maSalle;
    }
    public function setMaSalle($uneSalle){
        $this->maSalle = $uneSalle;
    }

    public function getMonControle(){
        return $this->monControle;
    }
    public function setMonControle($unControle){
        $this->monControle = $unControle;
    }

    public function getMaContrainteGenerale(){
        return $this->maContrainteGenerale;
    }
    public function setMaContrainteGenerale($uneContrainteGenerale){
        $this->maContrainteGenerale = $uneContrainteGenerale;
    }

    public function getMaContrainteEspacement(){
        return $this->maContrainteEspacement;
    }
    public function setMaContrainteEspacement($uneContrainteEspacement){
        $this->maContrainteEspacement = $uneContrainteEspacement;
    }

}