<?php

/**
 * Plan d'une Salle composée de plusieurs zones
 */
class Plan{

    // ATTRIBUTS

    /**
     * Liste d'une liste de Zone (tableau à double dimension)
     *
     * @var array
     */
    private $monPlan = array(array());

    // ENCAPSULATION

    /**
     * Retourne le plan composé de Zone d'un objet Plan
     *
     * @return array
     */
    public function getPlan(){
        return $this->monPlan;
    }

    /**
     * Affecte un Plan à un plan de Zone
     *
     * @param array $unPlan Plan d'une Salle
     */
    public function setPlan($unPlan){
        $this->monPlan = $unPlan;
    }

    // Méthodes spécifiques

    /**
     * Ajoute une Zone au Plan
     *
     * @param Zone $uneZone Zone d'une Salle
     */
    
    public function lierUneZone($uneZone){
        $this->monPlan[$uneZone->getNumLigne()][$uneZone->getNumCol()] = $uneZone;
        $uneZone->lierPlan($this);
    }

    /**
     * Supprime une Zone à une ligne et une colonne
     *
     * @param int $numLigne Numéro de ligne de la Zone
     * @param int $numCol   Numéro de colonne de la Zone
     * @return void
     */
    public function delierUneZone($numLigne, $numCol){
        $this->monPlan[$numLigne][$numCol] = null;
    }

    /**
     * Retourne le nombre de rangées du Plan (= nombre de lignes)
     *
     * @return int
     */
    public function getNbRangees(){
        return count($this->monPlan);
    }

    /**
     * Retourne le nombre de colonnes du Plan
     *
     * @return void
     */
    public function getNbColonnes(){
        return count($this->monPlan[0]);
    }

    /**
     * Retourne le nombre de Zone de type place sur une ligne
     *
     * @return int
     */
    public function getNbPlacesLigne($numLigne){
        $nbPlaces = 0;
        for ($numCol=0; $numCol <= count($this->monPlan[$numLigne])-1; $numCol++){
            $uneZone = $this->monPlan[$numLigne][$numCol];
            if ($uneZone->getType()=="place"){
                $nbPlaces++;
            }
        }
        return $nbPlaces;
    }
}