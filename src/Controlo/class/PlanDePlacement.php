<?php
class PlanDePlacement{

    private $maSalle = array();
    private $monControle = array();
    private $maContrainteGenerale = array();
    private $maContrainteEspacement = array();

    public function getMaSalle(){
        return $this->maSalle;
    }

    public function getMonControle(){
        return $this->monControle;
    }

    public function getMaContrainteGenerale(){
        return $this->maContrainteGenerale;
    }

    public function getMaContrainteEspacement(){
        return $this->maContrainteEspacement;
    }

    public function existeSalle($uneSalle){
        if (in_array($uneSalle, $this->getMaSalle())) {
            return true;
        }
        else{
            return false;
        }
    }

    public function ajouterSalle($uneSalle)
    {
        if (!$this->existeSalle($uneSalle)) {
            array_push($this->maSalle, $uneSalle);
        }
    }

    public function supprimerSalle($uneSalle)
    {
        if ($this->existeSalle($uneSalle)) {
            unset($this->maSalle[array_search($uneSalle, $this->getMaSalle())]);
        }
    }

    public function existeControle($unControle){
        if (in_array($unControle, $this->getMonControle())) {
            return true;
        }
        else{
            return false;
        }
    }

    public function ajouterControle($unControle)
    {
        if (!$this->existeControle($unControle)) {
            array_push($this->monControle, $unControle);
        }
    }

    public function supprimerControle($unControle)
    {
        if ($this->existeControle($unControle)) {
            unset($this->monControle[array_search($unControle, $this->getMonControle())]);
        }
    }

    public function existeContrainteGenerale($unContrainteGenerale){
        if (in_array($unContrainteGenerale, $this->getMaContrainteGenerale())) {
            return true;
        }
        else{
            return false;
        }
    }

    public function ajouterContrainteGenerale($unContrainteGenerale)
    {
        if (!$this->existeContrainteGenerale($unContrainteGenerale)) {
            array_push($this->maContrainteGenerale, $unContrainteGenerale);
        }
    }

    public function supprimerContrainteGenerale($unContrainteGenerale)
    {
        if ($this->existeContrainteGenerale($unContrainteGenerale)) {
            unset($this->maContrainteGenerale[array_search($unContrainteGenerale, $this->getMaContrainteGenerale())]);
        }
    }
    
    public function existeContrainteEspacement($unContrainteEspacement){
        if (in_array($unContrainteEspacement, $this->getMaContrainteEspacement())) {
            return true;
        }
        else{
            return false;
        }
    }

    public function ajouterContrainteEspacement($unContrainteEspacement)
    {
        if (!$this->existeContrainteEspacement($unContrainteEspacement)) {
            array_push($this->maContrainteEspacement, $unContrainteEspacement);
        }
    }

    public function supprimerContrainteEspacement($unContrainteEspacement)
    {
        if ($this->existeContrainteEspacement($unContrainteEspacement)) {
            unset($this->maContrainteEspacement[array_search($unContrainteEspacement, $this->getMaContrainteEspacement())]);
        }
    }

}