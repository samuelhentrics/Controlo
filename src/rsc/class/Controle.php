<?php
/**
 * Classe Controle permettant de définir un contrôle
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
     * @param string $nouveauNomLong
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
     * @param string $nouveauNomCourt
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
     * @param string $nouvelleDate
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
     * @param int $nouvelleDuree
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
     * @param string $nouvelleHeureNonTT
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
     * @param string $nouvelleHeureTT
     */
    public function setHeureTT($nouvelleHeureTT)
    {
        $this->heureTT = $nouvelleHeureTT;
    }

    // Méthodes usuelles


    /**
     * Permet d'ajouter une Promotion à la liste de promotions participant au Controle
     *
     * @param Promotion $unePromotion
     */
    public function ajouterPromotion($unePromotion)
    {
        array_push($this->mesPromotions, $unePromotion);
    }

    /**
     * Permet de supprimer une Promotion de la liste de promotions participant au Controle
     *
     * @param Promotion $unePromotion
     */
    public function supprimerPromotion($unePromotion)
    {
        if (array_key_exists($unePromotion, $this->mesPromotions)) {
            unset($this->mesPromotions[$unePromotion]);
        }
    }

    /**
     * Permet d'ajouter une Salle à la liste des salles du Controle
     *
     * @param Salle $uneSalle
     */
    public function ajouterSalle($uneSalle)
    {
        array_push($this->mesSalles, $uneSalle);
    }

    /**
     * Permet de supprimer une Salle de la liste des salles du Controle
     *
     * @param Salle $uneSalle
     */
    public function supprimerSalle($uneSalle)
    {
        if (array_key_exists($uneSalle, $this->mesSalles)) {
            unset($this->mesSalles[$uneSalle]);
        }
    }

    /**
     * Permet d'ajouter un PlanDePlacement à la liste des plans de placement du Controle
     *
     * @param PlanDePlacement $unPlanDePlacement
     */
    public function ajouterPlanDePlacement($unPlanDePlacement)
    {
        array_push($this->mesPlansDePlacement, $unPlanDePlacement);
    }

    /**
     * Permet de supprimer un PlanDePlacement de la liste des plans de placement du Controle
     *
     * @param PlanDePlacement $unPlanDePlacement
     */
    public function supprimerPlanDePlacement($unPlanDePlacement)
    {
        if (array_key_exists($unPlanDePlacement, $this->mesPlansDePlacement)) {
            unset($this->mesPlansDePlacement[$unPlanDePlacement]);
        }
    }

    // METHODES SPECIFIQUES
    public function getDureeNonTT(){
        return ($this->duree)*2/3;
    }

}
