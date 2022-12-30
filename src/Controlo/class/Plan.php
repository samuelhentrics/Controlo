<?php
/**
 * @file Plan.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la classe Plan
 * @details Represente un Plan par ses Zone
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 * 
 */
/**
 * @brief Plan d'une Salle composée de plusieurs Zone
 */
class Plan
{

    // ATTRIBUTS

    /**
     * @brief Liste d'une liste de Zone (tableau à double dimension)
     *
     * @var array
     */
    private $mesZones = array(array());

    // ENCAPSULATION

    /**
     * @brief Retourne le plan composé de Zone d'un objet Plan
     *
     * @return array
     */
    public function getMesZones()
    {
        return $this->mesZones;
    }


    // Méthodes spécifiques

    /**
     * @brief Ajoute une Zone au Plan
     *
     * @param Zone $uneZone Zone d'une Salle
     */

    public function lierUneZone($uneZone)
    {
        $this->mesZones[$uneZone->getNumLigne()][$uneZone->getNumCol()] = $uneZone;
        $uneZone->lierPlan($this);
    }

    /**
     * @brief Supprime une Zone à une ligne et une colonne
     *
     * @param int $numLigne Numéro de ligne de la Zone
     * @param int $numCol   Numéro de colonne de la Zone
     */
    public function delierUneZone($numLigne, $numCol)
    {
        $this->mesZones[$numLigne][$numCol] = null;
    }

    /**
     * @brief Retourne le nombre de rangées du Plan (= nombre de lignes)
     *
     * @return int
     */
    public function getNbRangees()
    {
        return count($this->mesZones);
    }

    /**
     * @brief Retourne le nombre de colonnes du Plan
     *
     * @return int
     */
    public function getNbColonnes()
    {
        return count($this->mesZones[0]);
    }

    /**
     * @brief Retourne le nombre de Zone de type place sur une ligne
     *
     * @return int
     */
    public function getNbPlacesLigne($numLigne)
    {
        $nbPlaces = 0;
        for ($numCol = 0; $numCol <= count($this->mesZones[$numLigne]) - 1; $numCol++) {
            $uneZone = $this->mesZones[$numLigne][$numCol];
            if ($uneZone->getType() == "place") {
                $nbPlaces++;
            }
        }
        return $nbPlaces;
    }
}