<?php
/**
 * Classe permettant de déterminer une zone dans un plan (s'il s'agit d'une place,
 * d'un tableau ou bien d'une zone vide)
 */
class Zone{
    // ATTRIBUTS

    /**
     * Type de Zone (vide, place, tableau )
     *
     * @var [type]
     */
    private $type;

    /**
     * Numéro de la place (uniquement possible s'il s'agit d'une place)
     *
     * @var int
     */
    private $numero = null;

    /**
     * Informe si la place dispose d'une prise (true) ou non (false) (uniquement possible s'il s'agit d'une place)
     *
     * @var bool
     */
    private $avoirPrise = false;

    /**
     * Informe la position selon le numéro de la ligne sur le Plan
     *
     * @var int
     */
    private $numLigne;

    /**
     * Informe la position selon le numéro de la colonne sur le Plan
     *
     * @var int
     */
    private $numCol;

    /**
     * Informe à quel Plan, la Zone appartient
     *
     * @var Plan
     */
    private $monPlan;

    // ENCAPSULATION

    /**
     * Retourne le type de la Zone
     *
     * @return string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * Permet d'affecter un type à une Zone
     *
     * @param string $monType
     */
    public function setType($unType){
        switch($unType){
            case "tableau":
                $this->type=$unType;
                break;

            case "place":
                $this->type=$unType;
                break;

            default:
                $this->type="vide";
                break;
        }
    }

    /**
     * Retourne le numéro de la place s'il y en a un
     *
     * @return int
     */
    public function getNumero(){
        return $this->numero;
    }

    /**
     * Affecte un numéro à une place (uniquement s'il s'agit d'une place)
     *
     * @param int $unNumero
     */
    public function setNumero($unNumero){
        if ($this->getType()=="place"){
            $this->numero=$unNumero;
        }
        else{
            $this->numero=null;
        }
    }

    /**
     * Retourne vrai si la Zone dispose d'une prise, sinon non
     *
     * @return bool
     */
    public function getInfoPrise(){
        return $this->avoirPrise;
    }

    /**
     * Affecte vrai/faux si une prise est proche de la place
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
     * Retourne le numéro de ligne du Plan où se trouve la Zone
     *
     * @return int
     */
    public function getNumLigne(){
        return $this->numLigne;
    }

    /**
     * Affecte un numéro de ligne du Plan où se trouve la Zone
     *
     * @param int $unNumLigne
     */
    public function setNumLigne($unNumLigne){
        $this->numLigne=$unNumLigne;
    }
    
    /**
     * Retourne le numéro de colonne du Plan où se trouve la Zone
     *
     * @return int
     */
    public function getNumCol(){
        return $this->numCol;
    }

    /**
     * Affecte un numéro de colonne du Plan où se trouve la Zone
     *
     * @param int $unNumCol
     */
    public function setNumCol($unNumCol){
        $this->numCol=$unNumCol;
    }

    /**
     * Retourne le Plan de la Zone
     *
     * @return void
     */
    public function getMonPlan(){
        return $this->monPlan;
    }

    /**
     * Affecte un Plan à la Zone
     *
     * @param Plan $unPlan
     */
    public function setMonPlan($unPlan){
        // délier avec le Plan (à faire)
        $this->monPlan= $unPlan;
    }


    // METHODES SPECIFIQUES

    /**
     * Lie la Zone dans le Plan d'une Salle
     *
     * @param Plan $unPlan
     */
    public function lierPlan($unPlan){
        if ($this->monPlan != null){
            $this->monPlan->delierUneZone($this->numLigne, $this->numCol);
        }
        $this->setMonPlan($unPlan);
        $unPlan->lierUneZone($this);
    }

    /**
     * Delie la Zone du Plan courant d'une Salle
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