<?php
/**
 * @file PlanDePlacement.php
 * @author Ahmed FAKHFAKH <fakhfakhahmed45@gmail.com>
 * @brief Spécification de la classe PlanDePlacement
 * @details Represente un Plan de placement par sa salle, son contrôle, sa contrainte
 * générale, sa contrainte d'éspacement et ses placements.
 * 
 * @version 2.0
 * @date 2022-12-27
 * 
 * 
 */

 /**
 * @brief Classe PlanDePlacement permettant de définir la sallen le contrôle, la contrainte 
 * générale, la contrainte d'éspacement choisis et ses placements.
 */
class PlanDePlacement{

    //Variables

    /**
     * @brief salle
     *
     * @var Salle
     */
    private $maSalle;

    /**
     * @brief Contrôle
     *
     * @var Controle
     */
    private $monControle;

    /**
     * @brief contrainte générale
     *
     * @var ContraintesGenerales
     */
    private $maContrainteGenerale;

    /**
     * @brief contrainte d'espacement
     *
     * @var ContraintesEspacement
     */
    private $maContrainteEspacement;

    /**
     * @brief Les placements
     *
     * @var array
     */
    private $mesPlacements = array();

    //Encapsulation


    /**
     * @brief Retourne la salle
     *
     * @return Salle
     */
    public function getMaSalle(){
        return $this->maSalle;
    }

    /**
     * @brief Affecte une salle
     *
     * @param Salle $uneSalle
     */
    public function setMaSalle($uneSalle)
    {
        $this->maSalle = $uneSalle;
    }


    /**
     * @brief Retourne le contrôle
     *
     * @return Controle
     */
    public function getMonControle(){
        return $this->monControle;
    }

    /**
     * @brief Affecte un contrôle
     *
     * @param Controle $unControle
     */
    public function setMonControle($unControle)
    {
        $this->monControle = $unControle;
    }


    /**
     * @brief Retourne la contrainte générale
     *
     * @return ContraintesGenerales
     */
    public function getMaContrainteGenerale(){
        return $this->maContrainteGenerale;
    }

    /**
     * @brief Affecte une contrainte générale
     *
     * @param ContraintesGenerales $uneContrainteGenerale
     */
    public function setMaContrainteGenerale($uneContrainteGenerale)
    {
        $this->maContrainteGenerale = $uneContrainteGenerale;
    }

    /**
     * @brief Retourne la contrainte d'espacement
     *
     * @return ContraintesEspacement
     */
    public function getMaContrainteEspacement(){
        return $this->maContrainteEspacement;
    }

    /**
     * @brief Affecte une contrainte d'espacement
     *
     * @param ContraintesEspacement $uneContrainteEspacement
     */
    public function setMaContrainteEspacement($uneContrainteEspacement)
    {
        $this->maContrainteEspacement = $uneContrainteEspacement;
    }


    /**
     * @brief Retourne les places
     *
     * @return array
     */
    public function getMesPlacements(){
        return $this->mesPlacements;
    }


    // Méthodes usuelles

    /**
     * Fonction permettant de vérifier si une place existe dans la lise des places
     * Retourne vrai s'il existe dans la liste, faux sinon
     * @param UnPlacement $unPlacement place recherché
     * @return bool Information si la place est dans la liste
     */
    public function existePlacement($unPlacement){
        if (in_array($unPlacement, $this->getMesPlacements())) {
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Permet d'ajouter une place à la liste
     * 
     * @param UnPlacement $unPlacement
     */
    public function ajouterPlacement($unPlacement)
    {
        if (!$this->existePlacement($unPlacement)) {
            array_push($this->mesPlacements, $unPlacement);
        }
    }

    /**
     * Permet de supprimer une place de la liste
     * 
     * @param UnPlacement $unPlacement
     */
    public function supprimerPlacement($unPlacement)
    {
        if ($this->existePlacement($unPlacement)) {
            unset($this->mesPlacements[array_search($unPlacement, $this->getMesPlacements())]);
        }
    }

 }