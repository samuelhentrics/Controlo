<?php
/**
 * Classe contrôle permettant de définir un contrôle
 */
class Controle
{
    // Variables
    /**
     * Nom long du contrôle
     *
     * @var string
     */
    private $nomLong;

    /**
     * Nom court du contrôle
     *
     * @var string
     */
    private $nomCourt;

    /**
     * Date de quand se passe le contrôle
     *
     * @var string
     */
    private $date;

    /**
     * Durée totale du contrôle (tiers temps compris) exprimée en minutes
     *
     * @var int
     */
    private $duree;

    /**
     * Heure à laquelle les tiers-temps débutent leur contrôle
     *
     * @var string
     */
    private $heureTT;

    /**
     * Heure à laquelle les non tiers-temps débutent leur contrôle
     *
     * @var string
     */
    private $heureNonTT;

    /**
     * Liste des promotions qui participent à ce contrôle
     *
     * @var array
     */
    private $mesPromotions = array();

    /**
     * Liste des salles où se déroulent le contrôle
     *
     * @var array
     */
    private $mesSalles = array();

    /**
     * Liste des plans de salles générés par le contrôle
     *
     * @var array
     */
    private $mesPlansDePlacement = array();

    // Encapsulation

    /**
     * Retourne le nom long du contrôle
     *
     * @return string
     */
    public function getNomLong()
    {
        return $this->nomLong;
    }

    /**
     * Permet d'affecter un nom long à un contrôle
     *
     * @param string $nouveauNomLong
     */
    public function setNomLong($nouveauNomLong)
    {
        $this->nomLong = $nouveauNomLong;
    }

    /**
     * Retourne le nom court du contrôle
     *
     * @return string
     */
    public function getNomCourt()
    {
        return $this->nomCourt;
    }

    /**
     * Permet d'affecter un nom court à un contrôle
     *
     * @param string $nouveauNomCourt
     */
    public function setNomCourt($nouveauNomCourt)
    {
        $this->nomCourt = $nouveauNomCourt;
    }

    /**
     * Retourne la date du contrôle
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Permet d'affecter une date à un contrôle
     *
     * @param string $nouvelleDate
     */
    public function setDate($nouvelleDate)
    {
        $this->date = $nouvelleDate;
    }

    /**
     * Retourne la durée totale (tiers-temps compris) du contrôle
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Permet d'affecter une durée à un contrôle
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
     * Permet d'affecter l'heure du début du contrôle pour un étudiant non tiers-temps
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
     * Permet d'affecter l'heure du début du contrôle pour un étudiant tiers-temps
     *
     * @param string $nouvelleHeureTT
     */
    public function setHeureTT($nouvelleHeureTT)
    {
        $this->heureTT = $nouvelleHeureTT;
    }

    // Méthodes usuelles


    /**
     * Permet d'ajouter une promotion à la liste de promotions participant au contrôle
     *
     * @param Promotion $unePromotion
     */
    public function ajouterPromotion($unePromotion)
    {
        array_push($this->mesPromotions, $unePromotion);
    }

    /**
     * Permet de supprimer une promotion de la liste de promotions participant au contrôle
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
     * Permet d'ajouter une salle à la liste des salles du contrôle
     *
     * @param Salle $uneSalle
     */
    public function ajouterSalle($uneSalle)
    {
        array_push($this->mesSalles, $uneSalle);
    }

    /**
     * Permet de supprimer une salle de la liste des salles du contrôle
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
     * Permet d'ajouter un plan de placement à la liste des plans de placement du contrôle
     *
     * @param PlanDePlacement $unPlanDePlacement
     */
    public function ajouterPlanDePlacement($unPlanDePlacement)
    {
        array_push($this->mesPlansDePlacement, $unPlanDePlacement);
    }

    /**
     * Permet de supprimer un plan de placement de la liste des plans de placement du contrôle
     *
     * @param PlanDePlacement $unPlanDePlacement
     */
    public function supprimerPlanDePlacement($unPlanDePlacement)
    {
        if (array_key_exists($unPlanDePlacement, $this->mesPlansDePlacement)) {
            unset($this->mesPlansDePlacement[$unPlanDePlacement]);
        }
    }

}
