<?php
class UnPlacement{

    private $maZone = array();
    private $monPDP = array();
    private $mesEtudiants = array();

    public function getMaZone(){
        return $this->maZone;
    }

    public function getMonPDP(){
        return $this->monPDP;
    }

    public function getMesEtudiants(){
        return $this->mesEtudiants;
    }

    public function existeZone($uneZone){
        if (in_array($uneZone, $this->getMaZone())) {
            return true;
        }
        else{
            return false;
        }
    }

    public function ajouterZone($uneZone)
    {
        if (!$this->existeZone($uneZone)) {
            array_push($this->maZone, $uneZone);
        }
    }

    public function supprimerZone($uneZone)
    {
        if ($this->existeZone($uneZone)) {
            unset($this->maZone[array_search($uneZone, $this->getMaZone())]);
        }
    }

    public function existePDP($unPDP){
        if (in_array($unPDP, $this->getMonPDP())) {
            return true;
        }
        else{
            return false;
        }
    }

    public function ajouterPDP($unPDP)
    {
        if (!$this->existePDP($unPDP)) {
            array_push($this->monPDP, $unPDP);
        }
    }

    public function supprimerPDP($unPDP)
    {
        if ($this->existePDP($unPDP)) {
            unset($this->monPDP[array_search($unPDP, $this->getMonPDP())]);
        }
    }

    public function existeEtudiant($unEtudiant){
        if (in_array($unEtudiant, $this->getMesEtudiants())) {
            return true;
        }
        else{
            return false;
        }
    }

    public function ajouterEtudiant($unEtudiant)
    {
        if (!$this->existeEtudiant($unEtudiant)) {
            array_push($this->mesEtudiants, $unEtudiant);
        }
    }

    public function supprimerEtudiant($unEtudiant)
    {
        if ($this->existeEtudiant($unEtudiant)) {
            unset($this->mesEtudiants[array_search($unEtudiant, $this->getMesEtudiants())]);
        }
    }
}