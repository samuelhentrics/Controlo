<?php
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

    public function setMonPlan($nouveauPlan)
    {
        $this->monPlan = $nouveauPlan;

    }

    public function getMonVoisin()
    {
        return $this->monVoisin;
    }

    public function setMonVoisin($nouveauVoisin)
    {
        $this->monVoisin = $nouveauVoisin;
    }
}



