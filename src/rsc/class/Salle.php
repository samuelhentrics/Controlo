<?php
/**
 * Classe Salle permettant de définir le nom de la Salle, son plan et son voisin s'il existe
 */
class Salle
{

    //VARIABLES

    /**
     * Nom de la Salle
     *
     * @var string
     */
    private $nom;

    /**
     * Plan appartenant à la Salle
     *
     * @var Plan
     */
    private $monPlan;

    /**
     * Voisin de la Salle s'il en existe un (Salle double)
     *
     * @var Salle
     */
    private $monVoisin;

    //ENCAPSULATION

    /**
     * Retourne le nom de la Salle
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Affecte un nom à la Salle
     *
     * @param string $nouveauNom
     */
    public function setNom($nouveauNom)
    {
        $this->nom = $nouveauNom;
    }

    /**
     * Retourne le Plan de la Salle
     *
     * @return Plan
     */
    public function getMonPlan()
    {
        return $this->monPlan;
    }

    /**
     * Affecte un Plan à la Salle
     *
     * @param Plan $nouveauPlan
     */
    private function setMonPlan($nouveauPlan)
    {
        $this->monPlan = $nouveauPlan;

    }

    /**
     * Retourne le voisin de la Salle s'il existe
     *
     * @return Salle
     */
    public function getMonVoisin()
    {
        return $this->monVoisin;
    }

    /**
     * Affecte un voisin à la Salle
     *
     * @param Salle $nouveauVoisin
     */
    public function setMonVoisin($nouveauVoisin)
    {
        $this->monVoisin = $nouveauVoisin;
    }

    /**
     * Permet de lier un voisin à une Salle
     *
     * @param Salle $unVoisin
     */
    public function lierVoisin($unVoisin){
        if ($unVoisin!=null){
            $this->delierVoisin();
            $unVoisin->delierVoisin();
            $this->setMonVoisin($unVoisin);
            $unVoisin->setMonVoisin($this);
        }
    }

    /**
     * Permet de délier le voisin actuellement lié à la Salle
     *
     */
    public function delierVoisin(){
        if ($this->monVoisin != null){
            $this->monVoisin->setMonVoisin(null);
            $this->setMonVoisin(null);
        } 
    }

}



