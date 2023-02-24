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
     * @brief Détermine si l'affichage se fait sur la même page (vrai) ou non (faux)
     *
     * @var boolean
     */
    private $affichageMemePage;

    /**
     * @brief Les placements relié au PlanDePlacement
     *
     * @var array
     */
    private $mesPlacements = array();


    // Constructeur

    /**
     * @brief Constructeur du PlanDePlacement
     * @param ContraintesGenerales $uneContrainteGenerale ContraintesGenerales pour le Controle
     * @param ContraintesEspacement $uneContrainteEspacement ContraintesEspacements pour la Salle
     * @param Salle $uneSalle Salle du PlanDePlacement
     */
    public function __construct($uneContrainteGenerale, $uneContrainteEspacement, $uneSalle, $affichageMemePage = false){
        $this->setMaContrainteGenerale($uneContrainteGenerale);
        $this->setMaContrainteEspacement($uneContrainteEspacement);
        $this->setMaSalle($uneSalle);
        $this->setAffichageMemePage($affichageMemePage);
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
     * @brief Retourne vrai si la place existe dans la liste des Placement
     * @param mixed $unePlace Place recherché
     * @return bool
     */
    public function existePlace($unePlace){
        $mesPlacements = $this->getMesPlacements();

        foreach($mesPlacements as $numLigne => $ligne){
            foreach($ligne as $numCol => $col){
                if($unePlace == $mesPlacements[$numLigne][$numCol]->getMaZone()){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @brief Fonction permettant de vérifier si UnPlacement existe dans la liste des Placement
     * Retourne vrai s'il existe dans la liste, faux sinon
     * @param UnPlacement $unPlacement place recherché
     * @return bool Information si la place est dans la liste
     */
    public function existePlacement($unPlacement)
    {
        $mesPlacements = $this->getMesPlacements();
        foreach($mesPlacements as $numLigne => $ligne){
            foreach($ligne as $numCol => $col){
                if($unPlacement == $mesPlacements[$numLigne][$numCol]){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @brief Permet d'ajouter une place à la liste
     * 
     * @param UnPlacement $unPlacement
     */
    public function ajouterPlacement($unPlacement)
    {
        if (!$this->existePlacement($unPlacement)) {
            $maZone = $unPlacement->getMaZone();
            $this->mesPlacements[$maZone->getNumLigne()][$maZone->getNumCol()] = $unPlacement;
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
            $maZone = $unPlacement->getMaZone();
            unset($this->mesPlacements[$maZone->getNumLigne()][$maZone->getNumCol()]);
        }
    }


	/**
	 * @brief Retourne vrai si l'affichage se fait sur la même page (vrai) ou non (faux)
	 * @return boolean
	 */
	public function getAffichageMemePage() {
		return $this->affichageMemePage;
	}
	
	/**
	 * @brief Affecte vrai à affichageMemePage si l'affichage se fait sur la même page (vrai) ou non (faux)
	 * @param boolean $affichageMemePage 
	 * @return void
	 */
	public function setAffichageMemePage($affichageMemePage){
		$this->affichageMemePage = $affichageMemePage;
	}
}