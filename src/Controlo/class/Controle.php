<?php
/**
 * @file Controle.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la classe Controle
 * @details Represente une Plan par son nom long, court, sa date, son heure tiers-temps,
 * son heure non tiers-temps, sa durée totale (TT), ses Promotion, ses Salle,
 * ses PlanDePlacement
 * 
 * @version 1.1
 * @date 2022-12-18
 * 
 */

/**
 * @brief Classe Controle permettant de définir un contrôle
 */
class Controle
{
    // Variables
    /**
     * @brief Nom long du Controle
     *
     * @var string
     */

    private $nomLong;

    /**
     * @brief Nom court du Controle
     *
     * @var string
     */
    private $nomCourt;

    /**
     * @brief Date de quand se passe le Controle
     *
     * @var string
     */
    private $date;

    /**
     * @brief Durée totale du Controle (tiers temps compris) exprimée en minutes
     *
     * @var int
     */
    private $duree;

    /**
     * @brief Heure à laquelle les tiers-temps débutent leur Controle
     *
     * @var string
     */
    private $heureTT;

    /**
     * @brief Heure à laquelle les non tiers-temps débutent leur Controle
     *
     * @var string
     */
    private $heureNonTT;

    /**
     * @brief Liste des Promotion qui participent à ce Controle
     *
     * @var array
     */
    private $mesPromotions = array();

    /**
     * @brief Liste des Salle où se déroulent le Controle
     *
     * @var array
     */
    private $mesSalles = array();

    /**
     * @brief Liste des PlanDePlacement générée par le Controle
     *
     * @var array
     */
    private $mesPlansDePlacement = array();

    // Constructeur

    /**
     * @brief Constructeur du Controle
     *
     * @param string $unNomLong Nom long du Controle
     * @param string $unNomCourt Nom court du Controle
     * @param int $uneDuree Durée du Controle
     * @param string $uneDate Date du Controle (au format YYYY-MM-DD)
     * @param string $uneHeureNonTT Heure non tiers-temps (au format HH:MM)
     * @param string $uneHeureTT Heure tiers-temps (au format HH:MM)
     */
    function __construct($unNomLong, $unNomCourt, $uneDuree, $uneDate, $uneHeureNonTT, $uneHeureTT)
    {
        $this->setNomLong($unNomLong);
        $this->setNomCourt($unNomCourt);
        $this->setDuree($uneDuree);
        $this->setDate($uneDate);
        $this->setHeureNonTT($uneHeureNonTT);
        $this->setHeureTT($uneHeureTT);
    }


    // Encapsulation

    /**
     * @brief Retourne le nom long du Controle
     *
     * @return string
     */
    public function getNomLong()
    {
        return $this->nomLong;
    }

    /**
     * @brief Permet d'affecter un nom long à un Controle
     *
     * @param string $nouveauNomLong Nom long du contrôle à affecter
     */
    public function setNomLong($nouveauNomLong)
    {
        $this->nomLong = $nouveauNomLong;
    }

    /**
     * @brief Retourne le nom court du Controle
     *
     * @return string
     */
    public function getNomCourt()
    {
        return $this->nomCourt;
    }

    /**
     * @brief Permet d'affecter un nom court à un Controle
     *
     * @param string $nouveauNomCourt Nom court du contrôle à affecter
     */
    public function setNomCourt($nouveauNomCourt)
    {
        $this->nomCourt = $nouveauNomCourt;
    }

    /**
     * @brief Retourne la date du Controle
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @brief Permet d'affecter une date à un Controle
     *
     * @param string $nouvelleDate Date du contrôle à affecter
     */
    public function setDate($nouvelleDate)
    {
        $this->date = $nouvelleDate;
    }

    /**
     * @brief Retourne la durée totale (tiers-temps compris) du Controle
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @brief Permet d'affecter une durée à un Controle
     *
     * @param int $nouvelleDuree Durée totale du contrôle à affecter
     */
    public function setDuree($nouvelleDuree)
    {
        $this->duree = $nouvelleDuree;
    }

    /**
     * @brief Retourne l'heure de quand commence un étudiant non tiers-temps
     *
     * @return string 
     */
    public function getHeureNonTT()
    {
        return $this->heureNonTT;
    }

    /**
     * @brief Permet d'affecter l'heure du début du Controle pour un étudiant non tiers-temps
     *
     * @param string $nouvelleHeureNonTT Heure non tiers temps du contrôle à affecter
     */
    public function setHeureNonTT($nouvelleHeureNonTT)
    {
        $this->heureNonTT = $nouvelleHeureNonTT;
    }

    /**
     * @brief Retourne l'heure de quand commence un étudiant tiers-temps
     *
     * @return string 
     */
    public function getHeureTT()
    {
        return $this->heureTT;
    }

    /**
     * @brief Permet d'affecter l'heure du début du Controle pour un étudiant tiers-temps
     *
     * @param string $nouvelleHeureTT Heure tiers-temps du contrôle à affecter
     */
    public function setHeureTT($nouvelleHeureTT)
    {
        $this->heureTT = $nouvelleHeureTT;
    }

    // Méthodes usuelles


    /**
     * @brief Permet d'ajouter une Promotion à la liste de promotions participant au Controle
     *
     * @param Promotion $unePromotion Promotion participant au contrôle à ajouter
     */
    public function ajouterPromotion($unePromotion)
    {
        if (!$this->existePromotion($unePromotion)) {
            array_push($this->mesPromotions, $unePromotion);
        }
    }

    /**
     * @brief Permet de supprimer une Promotion de la liste de promotions participant au Controle
     *
     * @param Promotion $unePromotion Promotion participant au contrôle à supprimer
     */
    public function supprimerPromotion($unePromotion)
    {
        if ($this->existePromotion($unePromotion)) {
            unset($this->mesPromotions[array_search($unePromotion, $this->mesPromotions)]);
        }
    }

    /**
     * Retourne vrai si la Promotion appartient au contrôle, Faux sinon
     * @param Promotion $unePromotion
     * @return bool
     */
    public function existePromotion($unePromotion)
    {
        if (in_array($unePromotion, $this->getMesPromotions())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Retourne les Promotion du Controle
     *
     * @return array
     */
    public function getMesPromotions()
    {
        return $this->mesPromotions;
    }

    /**
     * @brief Permet d'ajouter une Salle à la liste des salles du Controle
     *
     * @param Salle $uneSalle Salle participant au contrôle à ajouter
     */
    public function ajouterSalle($uneSalle)
    {
        if (!$this->existeSalle($uneSalle)) {
            $nomSalle = $uneSalle->getNom();
            $this->mesSalles[$nomSalle] = $uneSalle;
        }
    }

    /**
     * @brief Permet de supprimer une Salle de la liste des salles du Controle
     *
     * @param Salle $uneSalle Salle participant au contrôle à supprimer
     */
    public function supprimerSalle($uneSalle)
    {
        if ($this->existeSalle($uneSalle)) {
            $nomSalle = $uneSalle->getNom();
            unset($this->mesSalles[$nomSalle]);
        }
    }

    /**
     * @brief Retourne vrai si la Salle appartient au contrôle, Faux sinon
     * @param Salle $uneSalle Salle qu'on veut verifier
     * @return bool
     */
    public function existeSalle($uneSalle)
    {
        $nomSalle = $uneSalle->getNom();
        if (array_key_exists($nomSalle, $this->mesSalles)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @brief Retourne la liste des Salle affectés au Controle
     *
     */
    public function getMesSalles()
    {
        return $this->mesSalles;
    }

    /**
     * @brief Permet d'ajouter un PlanDePlacement à la liste des plans de placement du Controle
     *
     * @param PlanDePlacement $unPlanDePlacement Plan de Placement du contrôle à ajouter
     */
    public function ajouterPlanDePlacement($unPlanDePlacement)
    {
        if (!$this->existePlanDePlacement($unPlanDePlacement)) {
            $nomSalle = $unPlanDePlacement->getMaSalle()->getNom();
            $this->mesPlansDePlacement[$nomSalle] = $unPlanDePlacement;
        }
    }

    /**
     * @brief Permet de supprimer un PlanDePlacement de la liste des plans de placement du Controle
     *
     * @param PlanDePlacement $unPlanDePlacement Plan de Placement du contrôle à supprimer
     */
    public function supprimerPlanDePlacement($unPlanDePlacement)
    {
        if ($this->existePlanDePlacement($unPlanDePlacement)) {
            unset($this->mesPlansDePlacement[$unPlanDePlacement->getMaSalle()->getNom()]);
        }
    }

    /**
     * Retourne vrai si le PlanDePlacement est celui du Controle, faux sinon
     * @param PlanDePlacement $unPlanDePlacement Un PlanDePlacement
     * @return bool
     */
    public function existePlanDePlacement($unPlanDePlacement)
    {
        $nomSalle = $unPlanDePlacement->getMaSalle()->getNom();
        if (array_key_exists($nomSalle, $this->mesPlansDePlacement)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retourne la liste des PlanDePlacement
     * @return array
     */
    public function getMesPlansDePlacement()
    {
        return $this->mesPlansDePlacement;
    }

    // METHODES SPECIFIQUES

    /**
     * @brief Retourne la durée totale pour un étudiant non tiers temps
     *
     * @return int
     */
    public function getDureeNonTT()
    {
        return ($this->duree) * 3 / 4;
    }

    /**
     * @brief Retourne vrai si le Controle a toutes les informations, faux sinon
     *
     * @return bool
     */
    public function controleInfoComplet()
    {
        if (
            $this->getNomLong() != null and $this->getNomCourt() != null
            and $this->getDate() != null and $this->getDuree() != null
            and $this->getHeureTT() != null and $this->getHeureNonTT() != null
            and $this->getMesPromotions() != null and $this->getMesSalles() != null
        ) {
            return true;
        } else {
            return false;
        }
    }

}