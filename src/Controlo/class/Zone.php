<?php
/**
 * @file Zone.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la classe Zone en relation réciproque avec son Plan
 * @details Represente une Zone par son type, son numero, si elle a une prise ou non,
 * son numéro de ligne, son numéro de colonne, son Plan
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 * 
 */


/**
 * @brief Classe permettant de déterminer une Zone dans un Plan (s'il s'agit d'une place,
 * d'un tableau ou bien d'une zone vide)
 */
class Zone{
    // ATTRIBUTS

    /**
     * @brief Type de Zone (vide, place, tableau )
     *
     * @var string
     */
    private $type;

    /**
     * @brief Numéro de la place (uniquement possible s'il s'agit d'une place)
     *
     * @var int
     */
    private $numero = null;

    /**
     * @brief Informe si la place dispose d'une prise (true) ou non (false) (uniquement possible s'il s'agit d'une place)
     *
     * @var bool
     */
    private $avoirPrise = false;

    /**
     * @brief Informe la position selon le numéro de la ligne sur le Plan
     *
     * @var int
     */
    private $numLigne;

    /**
     * @brief Informe la position selon le numéro de la colonne sur le Plan
     *
     * @var int
     */
    private $numCol;

    /**
     * @brief Informe à quel Plan, la Zone appartient
     *
     * @var Plan
     */
    private $monPlan;

    // ENCAPSULATION

    /**
     * @brief Retourne le type de la Zone
     *
     * @return string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * @brief Permet d'affecter un type à une Zone
     *
     * @param string $monType
     */
    public function setType($unType){
        switch($unType){
            case "tableau":
                $this->type=$unType;
                $this->setNumero(null);
                $this->setInfoPrise(false);
                break;

            case "place":
                $this->type=$unType;
                break;

            default:
                $this->type="vide";
                $this->setNumero(null);
                $this->setInfoPrise(false);
                break;
        }
    }

    /**
     * @brief Retourne le numéro de la place s'il y en a un
     *
     * @return int
     */
    public function getNumero(){
        return $this->numero;
    }

    /**
     * @brief Affecte un numéro à une place (uniquement s'il s'agit d'une place).
     * On récupére uniquement les nombres et non pas les caractères dans
     * la variable unNumero
     *
     * @param int $unNumero
     */
    public function setNumero($unNumero){
        if ($this->getType()=="place"){
            $this->numero= intval($unNumero);
        }
        else{
            $this->numero=null;
        }
    }

    /**
     * @brief Retourne vrai si la Zone dispose d'une prise, sinon non
     *
     * @return bool
     */
    public function getInfoPrise(){
        return $this->avoirPrise;
    }

    /**
     * @brief Affecte vrai/faux si une prise est proche d'une Zone place uniquement
     *
     * @param bool $infoPrisePlace
     */
    public function setInfoPrise($infoPrisePlace){
        if ($this->getType()=="place"){
            $this->avoirPrise=$infoPrisePlace;
        }
        else{
            $this->avoirPrise=false;
        }
    }

    /**
     * @brief Retourne le numéro de ligne du Plan où se trouve la Zone
     *
     * @return int
     */
    public function getNumLigne(){
        return $this->numLigne;
    }

    /**
     * @brief Affecte un numéro de ligne du Plan où se trouve la Zone
     *
     * @param int $unNumLigne
     */
    public function setNumLigne($unNumLigne){
        $this->numLigne= intval($unNumLigne);
    }
    
    /**
     * @brief Retourne le numéro de colonne du Plan où se trouve la Zone
     *
     * @return int
     */
    public function getNumCol(){
        return $this->numCol;
    }

    /**
     * @brief Affecte un numéro de colonne du Plan où se trouve la Zone
     *
     * @param int $unNumCol
     */
    public function setNumCol($unNumCol){
        $this->numCol= intval($unNumCol);
    }

    /**
     * @brief Retourne le Plan de la Zone
     *
     * @return void
     */
    public function getMonPlan(){
        return $this->monPlan;
    }

    /**
     * @brief Affecte un Plan à la Zone
     *
     * @param Plan $unPlan
     */
    public function setMonPlan($unPlan){
        // délier avec le Plan (à faire)
        $this->monPlan= $unPlan;
    }


    // METHODES SPECIFIQUES

    /**
     * @brief Lie la Zone dans le Plan d'une Salle
     *
     * @param Plan $unPlan
     */
    public function lierPlan($unPlan){
        $this->setMonPlan($unPlan);
    }

    /**
     * @brief Delie la Zone du Plan courant d'une Salle
     *
     */
    public function delierPlan(){
        if($this->monPlan != null){
            $this->monPlan->delierUneZone($this->numLigne, $this->numCol);
            $this->setMonPlan(null);
        }
    }
}

?>