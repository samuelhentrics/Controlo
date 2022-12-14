<?php
class UnPlacement{

    private $maZone;
    private $monPDP;
    private $monEtudiant;

    public function getMaZone(){
        return $this->maZone;
    }
    public function setMaZone($uneZone){
        $this->maZone = $uneZone;
    }

    public function getMonPDP(){
        return $this->monPDP;
    }
    public function setMonPDP($unPDP){
        $this->monPDP = $unPDP;
    }

    public function getMonEtudiant(){
        return $this->monEtudiant;
    }
    public function setMonEtudiant($unEtudiant){
        $this->monEtudiant = $unEtudiant;
    }
}