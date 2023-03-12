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
     * @brief Retourne vrai s'il existe une Zone dans le Plan
     * @param Zone $uneZone Zone d'une Salle
     * @return bool
     */
    function existeUneZone($uneZone){
        $existe = false;
        if ($this->mesZones[$uneZone->getNumLigne()][$uneZone->getNumCol()] == $uneZone) {
            $existe = true;
        }
        return $existe;
    }

    /**
     * @brief Ajoute une Zone au Plan
     *
     * @param Zone $uneZone Zone d'une Salle
     */

    public function ajouterUneZone($uneZone)
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
    public function supprimerUneZone($numLigne, $numCol)
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

    /**
     * @brief Retourne un Plan contenant uniquement les Zones de type place
     * @return Plan 
     */
    public function planAvecPlacesUniquement(){
        $plan = new Plan();
        for ($numLigne = 0; $numLigne <= count($this->mesZones) - 1; $numLigne++) {
            $placeVide = true;
            for ($numCol = 0; $numCol <= count($this->mesZones[$numLigne]) - 1; $numCol++) {
                $uneZone = $this->mesZones[$numLigne][$numCol];
                if ($uneZone->getType() == "vide") {
                    if($placeVide){
                        $plan->ajouterUneZone($uneZone);
                    }
                    $placeVide = true;
                }

                if ($uneZone->getType() == "place") {
                    $placeVide = false;
                    $plan->ajouterUneZone($uneZone);
                }
            }
        }

        return $plan;
    }


    /**
     * @brief Retourne vrai si les numéros de place sont uniques (aucun doublon)
     * @return bool 
     */
    public function verifierPlacesUniques(){
        $placesUniques = true;
        $listeNumeroDePlace = array();
        for ($numLigne = 0; $numLigne <= count($this->mesZones) - 1; $numLigne++) {
            for ($numCol = 0; $numCol <= count($this->mesZones[$numLigne]) - 1; $numCol++) {
                $uneZone = $this->mesZones[$numLigne][$numCol];
                if ($uneZone->getType() == "place") {
                    $numeroDePlace = $uneZone->getNumero();
                    if (in_array($numeroDePlace, $listeNumeroDePlace)) {
                        $placesUniques = false;
                    } else {
                        array_push($listeNumeroDePlace, $numeroDePlace);
                    }
                }
            }

        }
        return $placesUniques;
    }

    public function ligneAvecPlace($numLigne){
        $ligneAvecPlace = false;
        for ($numCol = 0; $numCol <= count($this->mesZones[$numLigne]) - 1; $numCol++) {
            $uneZone = $this->mesZones[$numLigne][$numCol];
            if ($uneZone->getType() == "place") {
                $ligneAvecPlace = true;
                break;
            }
        }
        return $ligneAvecPlace;
    }

}