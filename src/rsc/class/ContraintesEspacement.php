<?php

/**
 * Classe ContraintesEspacement permettant de définir les contraintes d'espacement
 */
class ContraintesEspacement
{

    //VARIABLES
    /**
     * Nombre de rangées espaçant chaque Etudiant dans une Salle
     * 
     * @var int
     */
    private $nbRangs;

    /**
     * Nombre de places espaçant chaque Etudiant dans une Salle
     * 
     * @var int
     */
    private $nbPlaces;

    /**
     * PlanDePlacement relié aux ContraintesEspacement
     * 
     * @var PlanDePlacement
     */
    private $monPlanDePlacement;

    //ENCAPSULATION

    /**
     * Retourne le nombre de rangs séparant les étudiants dans une Salle pour un
     * PlanDePlacement d'un Controle
     * 
     * @return int
     */
    public function getNbRangs()
    {
        return $this->nbRangs;
    }

    /**
     * Permet d'affecter le nombre de rangs séparant les étudiants dans une Salle pour un
     * PlanDePlacement d'un Controle
     * 
     * @param int $nouveauNbRangs Nombre de rangées qui sépare les étudiants
     */
    public function setNbRangs($nouveauNbRangs)
    {
        $this->nbRangs = $nouveauNbRangs;
    }

    /**
     * Retourne le nombre de places séparant les étudiants dans une Salle pour un
     * PlanDePlacement d'un Controle
     * 
     * @return int
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
    }

    /**
     * Permet d'affecter le nombre de places séparant les étudiants dans une Salle pour un
     * PlanDePlacement d'un Controle
     * 
     * @param int $nouveauNbPlaces Nombre de places qui sépare les étudiants
     */
    public function setNbPlaces($nouveauNbPlaces)
    {
        $this->nbPlaces = $nouveauNbPlaces;
    }

    /**
     * Retourne le PlanDePlacement affecté à ces ContraintesEspacement
     * 
     * @return PlanDePlacement
     */
    public function getMonPlanDePlacement()
    {
        return $this->monPlanDePlacement;
    }

    /**
     * Permet de mettre à jour un PlanDePlacement d'une Salle pour un Controle
     * à ContraintesEspacement
     *
     * @param PlanDePlacement nouveauPlan PlanDePlacement correspondant aux ContraintesEspacement.
     */
    public function majMonPlanDePlacement($nouveauPlan)
    {
        $this->monPlanDePlacement = $nouveauPlan;
    }


    // METHODES SPECIFIQUES

    /**
     * Supprime le lien entre le PlanDePlacement et les ContraintesEspacement
     *
     */
    public function supprimerMonPlanDePlacement()
    {
        if ($this->getMonPlanDePlacement() != null) {
            $this->getMonPlanDePlacement()->majMesContraintesEspacement(null);
            $this->majMonPlanDePlacement(null);
        }
    }

    /**
     * Définit le PlanDePlacement des ContraintesEspacement
     *
     * @param PlanDePlacement $unPlanDePlacement PlanDePlacement correspondant aux ContraintesEspacement
     * @return void
     */
    public function setMonPlanDePlacement($unPlanDePlacement)
    {
        $this->supprimerMonPlanDePlacement();

        if ($this->getMonPlanDePlacement() != null) {
            // Construire le nouveau lien
            // Supprimer l'éventuel lien actuel de mon nouveau PlanDePlacement
            $unPlanDePlacement->supprimerMesContraintesGenerales();

            // Établir le lien croisé avec mon correspondant
            $unPlanDePlacement->majMesContraintesGenerales($this); // Il pointe sur moi
            $this->majMonPlanDePlacement($unPlanDePlacement);       // Je pointe sur lui
        }
    }
}
