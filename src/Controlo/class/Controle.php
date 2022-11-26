<?php
/**
 * @brief Classe Controle permettant de définir un contrôle
 */
class Controle
{
    // Variables
    /**
     * Nom long du Controle
     *
     * @var string
     */

    private $nomLong;

    /**
     * Nom court du Controle
     *
     * @var string
     */
    private $nomCourt;

    /**
     * Date de quand se passe le Controle
     *
     * @var string
     */
    private $date;

    /**
     * Durée totale du Controle (tiers temps compris) exprimée en minutes
     *
     * @var int
     */
    private $duree;

    /**
     * Heure à laquelle les tiers-temps débutent leur Controle
     *
     * @var string
     */
    private $heureTT;

    /**
     * Heure à laquelle les non tiers-temps débutent leur Controle
     *
     * @var string
     */
    private $heureNonTT;

    /**
     * Liste des promotions qui participent à ce Controle
     *
     * @var array
     */
    private $mesPromotions = array();

    /**
     * Liste des salles où se déroulent le Controle
     *
     * @var array
     */
    private $mesSalles = array();

    /**
     * Liste des plans de placement générés par le Controle
     *
     * @var array
     */
    private $mesPlansDePlacement = array();

    // Encapsulation

    /**
     * Retourne le nom long du Controle
     *
     * @return string
     */
    public function getNomLong()
    {
        return $this->nomLong;
    }

    /**
     * Permet d'affecter un nom long à un Controle
     *
     * @param string $nouveauNomLong Nom long du contrôle à affecter
     */
    public function setNomLong($nouveauNomLong)
    {
        $this->nomLong = $nouveauNomLong;
    }

    /**
     * Retourne le nom court du Controle
     *
     * @return string
     */
    public function getNomCourt()
    {
        return $this->nomCourt;
    }

    /**
     * Permet d'affecter un nom court à un Controle
     *
     * @param string $nouveauNomCourt Nom court du contrôle à affecter
     */
    public function setNomCourt($nouveauNomCourt)
    {
        $this->nomCourt = $nouveauNomCourt;
    }

    /**
     * Retourne la date du Controle
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Permet d'affecter une date à un Controle
     *
     * @param string $nouvelleDate Date du contrôle à affecter
     */
    public function setDate($nouvelleDate)
    {
        $this->date = $nouvelleDate;
    }

    /**
     * Retourne la durée totale (tiers-temps compris) du Controle
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Permet d'affecter une durée à un Controle
     *
     * @param int $nouvelleDuree Durée totale du contrôle à affecter
     */
    public function setDuree($nouvelleDuree)
    {
        $this->duree = $nouvelleDuree;
    }

    /**
     * Retourne l'heure de quand commence un étudiant non tiers-temps
     *
     * @return string 
     */
    public function getHeureNonTT()
    {
        return $this->heureNonTT;
    }

    /**
     * Permet d'affecter l'heure du début du Controle pour un étudiant non tiers-temps
     *
     * @param string $nouvelleHeureNonTT Heure non tiers temps du contrôle à affecter
     */
    public function setHeureNonTT($nouvelleHeureNonTT)
    {
        $this->heureNonTT = $nouvelleHeureNonTT;
    }

    /**
     * Retourne l'heure de quand commence un étudiant tiers-temps
     *
     * @return string 
     */
    public function getHeureTT()
    {
        return $this->heureTT;
    }

    /**
     * Permet d'affecter l'heure du début du Controle pour un étudiant tiers-temps
     *
     * @param string $nouvelleHeureTT Heure tiers-temps du contrôle à affecter
     */
    public function setHeureTT($nouvelleHeureTT)
    {
        $this->heureTT = $nouvelleHeureTT;
    }

    // Méthodes usuelles


    /**
     * Permet d'ajouter une Promotion à la liste de promotions participant au Controle
     *
     * @param Promotion $unePromotion Promotion participant au contrôle à ajouter
     */
    public function ajouterPromotion($unePromotion)
    {
        if (array_key_exists($unePromotion, $this->getMesPromotions())) {
            array_push($this->mesPromotions, $unePromotion);
        }
    }

    /**
     * Permet de supprimer une Promotion de la liste de promotions participant au Controle
     *
     * @param Promotion $unePromotion Promotion participant au contrôle à supprimer
     */
    public function supprimerPromotion($unePromotion)
    {
        if (array_key_exists($unePromotion, $this->getMesPromotions())) {
            unset($this->getMesPromotions()[array_search($unePromotion, $this->getMesPromotions())]);
        }
    }

    /**
     * Retourne les Promotion du Controle
     *
     * @return array
     */
    public function getMesPromotions(){
        return $this->mesPromotions;
    }

    /**
     * Permet d'ajouter une Salle à la liste des salles du Controle
     *
     * @param Salle $uneSalle Salle participant au contrôle à ajouter
     */
    public function ajouterSalle($uneSalle)
    {
        if (array_key_exists($uneSalle, $this->getMesSalles())) {
            array_push($this->getMesSalles(), $uneSalle);
        }
    }

    /**
     * Permet de supprimer une Salle de la liste des salles du Controle
     *
     * @param Salle $uneSalle Salle participant au contrôle à supprimer
     */
    public function supprimerSalle($uneSalle)
    {
        if (array_key_exists($uneSalle, $this->getMesSalles())) {
            unset($this->getMesSalles()[array_search($uneSalle, $this->getMesSalles())]);
        }
    }

    /**
     * Retourne la liste des Salle affectés au Controle
     *
     */
    public function getMesSalles(){
        return $this->mesSalles;
    }

    /**
     * Permet d'ajouter un PlanDePlacement à la liste des plans de placement du Controle
     *
     * @param PlanDePlacement $unPlanDePlacement Plan de Placement du contrôle à ajouter
     */
    public function ajouterPlanDePlacement($unPlanDePlacement)
    {
        if (array_key_exists($unPlanDePlacement, $this->getMesPlansDePlacement())) {
            array_push($this->getMesSalles(), $unPlanDePlacement);
        }
    }

    /**
     * Permet de supprimer un PlanDePlacement de la liste des plans de placement du Controle
     *
     * @param PlanDePlacement $unPlanDePlacement Plan de Placement du contrôle à supprimer
     */
    public function supprimerPlanDePlacement($unPlanDePlacement)
    {
        if (array_key_exists($unPlanDePlacement, $this->getMesPlansDePlacement())) {
            unset($this->getMesPlansDePlacement()[array_search($unPlanDePlacement, $this->getMesPlansDePlacement())]);
        }
    }

    public function getMesPlansDePlacement(){
        return $this->mesPlansDePlacement;
    }

    // METHODES SPECIFIQUES
    
    /**
     * Retourne la durée totale pour un étudiant non tiers temps
     *
     * @return int
     */
    public function getDureeNonTT(){
        return ($this->duree)*3/4;
    }

}
