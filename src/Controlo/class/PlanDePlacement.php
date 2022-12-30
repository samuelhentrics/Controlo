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
class PlanDePlacement
{

    //Variables

    /**
     * @brief Salle relié au PlanDePlacement
     *
     * @var Salle
     */
    private $maSalle;

    /**
     * @brief ContraintesGenerales relié au PlanDePlacement
     *
     * @var ContraintesGenerales
     */
    private $maContrainteGenerale;

    /**
     * @brief ContraintesEspacement relié au PlanDePlacement
     *
     * @var ContraintesEspacement
     */
    private $maContrainteEspacement;

    /**
     * @brief Les placements relié au PlanDePlacement
     *
     * @var array
     */
    private $mesPlacements = array();

    // Constructeur

    /**
     * @brief Constructeur du PlanDePlacement
     * @param ContraintesGenerales $uneContrainteGenerale
     * @param ContraintesEspacement $uneContrainteEspacement
     * @param Salle $uneSalle
     */
    public function __construct($uneContrainteGenerale, $uneContrainteEspacement, $uneSalle){
        $this->setMaContrainteGenerale($uneContrainteGenerale);
        $this->setMaContrainteEspacement($uneContrainteEspacement);
        $this->setMaSalle($uneSalle);
    }



    //Encapsulation


    /**
     * @brief Retourne la Salle relié au PlanDePlacement
     *
     * @return Salle
     */
    public function getMaSalle()
    {
        return $this->maSalle;
    }

    /**
     * @brief Affecte une Salle au PlanDePlacement
     *
     * @param Salle $uneSalle
     */
    public function setMaSalle($uneSalle)
    {
        $this->maSalle = $uneSalle;
    }


    /**
     * @brief Retourne la ContraintesGenerales au PlanDePlacement
     *
     * @return ContraintesGenerales
     */
    public function getMaContrainteGenerale()
    {
        return $this->maContrainteGenerale;
    }

    /**
     * @brief Affecte une ContraintesGenerales au PlanDePlacement
     *
     * @param ContraintesGenerales $uneContrainteGenerale
     */
    public function setMaContrainteGenerale($uneContrainteGenerale)
    {
        $this->maContrainteGenerale = $uneContrainteGenerale;
    }

    /**
     * @brief Retourne la ContraintesEspacement
     *
     * @return ContraintesEspacement
     */
    public function getMaContrainteEspacement()
    {
        return $this->maContrainteEspacement;
    }

    /**
     * @brief Affecte une ContraintesEspacement
     *
     * @param ContraintesEspacement $uneContrainteEspacement
     */
    public function setMaContrainteEspacement($uneContrainteEspacement)
    {
        $this->maContrainteEspacement = $uneContrainteEspacement;
    }


    /**
     * @brief Retourne les UnPlacement
     *
     * @return array
     */
    public function getMesPlacements()
    {
        return $this->mesPlacements;
    }


    // Méthodes usuelles

    /**
     * @brief Fonction permettant de vérifier si une place existe dans la lise des places
     * Retourne vrai s'il existe dans la liste, faux sinon
     * @param UnPlacement $unPlacement place recherché
     * @return bool Information si la place est dans la liste
     */
    public function existePlacement($unPlacement)
    {
        if (in_array($unPlacement, $this->getMesPlacements())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Permet d'ajouter une place à la liste
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
     * @brief Permet de supprimer une place de la liste
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