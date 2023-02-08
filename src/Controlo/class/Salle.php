<?php
/**
 * @file Salle.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la classe Salle
 * @details Represente une Salle par son nom et son Plan
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 */

/**
 * @brief Classe Salle permettant de définir le nom de la Salle, son Plan et son voisin s'il existe
 */
class Salle
{

    //VARIABLES

    /**
     * @brief Nom de la Salle
     *
     * @var string
     */
    private $nom;

    /**
     * @brief Plan appartenant à la Salle
     *
     * @var Plan
     */
    private $monPlan;

    /**
     * @brief Voisin de la Salle s'il en existe un (Salle double)
     *
     * @var Salle
     */
    private $monVoisin;

    // CONSTRUCTEUR

    /**
     * @brief Constructeur de la classe Salle
     * @param string $nomSalle Nom de la Salle a attribué
     */
    public function __construct($nomSalle)
    {
        $this->setNom($nomSalle);
    }

    //ENCAPSULATION

    /**
     * @brief Retourne le nom de la Salle
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @brief Affecte un nom à la Salle
     *
     * @param string $nouveauNom
     */
    public function setNom($nouveauNom)
    {
        $this->nom = $nouveauNom;
    }

    /**
     * @brief Retourne le Plan de la Salle
     *
     * @return Plan
     */
    public function getMonPlan()
    {
        return $this->monPlan;
    }

    /**
     * @brief Affecte un Plan à la Salle
     *
     * @param Plan $nouveauPlan
     */
    public function setMonPlan($nouveauPlan)
    {
        $this->monPlan = $nouveauPlan;

    }

    /**
     * @brief Retourne le voisin de la Salle s'il existe
     *
     * @return Salle
     */
    public function getMonVoisin()
    {
        return $this->monVoisin;
    }

    /**
     * @brief Affecte un voisin à la Salle
     *
     * @param Salle|null $nouveauVoisin
     */
    public function setMonVoisin($nouveauVoisin)
    {
        $this->monVoisin = $nouveauVoisin;
    }

    /**
     * @brief Permet de lier un voisin à une Salle
     *
     * @param Salle $unVoisin
     */
    public function lierVoisin($unVoisin)
    {
        if ($unVoisin != null) {
            $this->delierVoisin();
            $unVoisin->delierVoisin();
            $this->setMonVoisin($unVoisin);
            $unVoisin->setMonVoisin($this);
        }
    }

    /**
     * @brief Permet de délier le voisin actuellement lié à la Salle
     *
     */
    public function delierVoisin()
    {
        if ($this->monVoisin != null) {
            $this->monVoisin->setMonVoisin(null);
            $this->setMonVoisin(null);
        }
    }

}