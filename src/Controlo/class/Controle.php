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

    /**
     * @brief Liste des enseignants qui référent le Controle
     *
     * @var array
     */
    private $mesReferents = array();

    /**
     * @brief Liste des enseignants qui surveillent le Controle
     *
     * @var array
     */
    private $mesSurveillants = array();

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
     * @param string $nouvelleDate Date du contrôle à affecter (au format DD/MM/YYYY)
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

    /**
     * @brief Permet d'ajouter un EnseignantReferant à la liste des enseignants référents du Controle
     *
     * @param string $unEnseignantReferent Enseignant référent du contrôle à ajouter
     */
    public function ajouterEnseignantReferent($unEnseignantReferent)
    {
        if (!$this->existeEnseignantReferent($unEnseignantReferent)) {
            $this->mesReferents[] = $unEnseignantReferent;
        }
    }

    /**
     * @brief Permet de supprimer un EnseignantReferant de la liste des enseignants référents du Controle
     *
     * @param string $unEnseignantReferent Enseignant référent du contrôle à supprimer
     */
    public function supprimerEnseignantReferent($unEnseignantReferent)
    {
        if ($this->existeEnseignantReferent($unEnseignantReferent)) {
            unset($this->mesReferents[array_search($unEnseignantReferent, $this->mesReferents)]);
        }
    }

    /**
     * Retourne vrai si l'Enseignant référent est celui du Controle, faux sinon
     * @param string $unEnseignantReferent Enseignant référent
     * @return bool
     */
    public function existeEnseignantReferent($unEnseignantReferent)
    {
        if (in_array($unEnseignantReferent, $this->getMesEnseignantsReferents())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retourne la liste des enseignantes référents
     * @return array
     */
    public function getMesEnseignantsReferents()
    {
        return $this->mesReferents;
    }

    /**
     * @brief Permet d'ajouter un EnseignantSurveillant à la liste des enseignants surveillants du Controle
     *
     * @param string $unEnseignantSurveillant Enseignant surveillant du contrôle à ajouter
     */
    public function ajouterEnseignantSurveillant($unEnseignantSurveillant)
    {
        if (!$this->existeEnseignantSurveillant($unEnseignantSurveillant)) {
            $this->mesSurveillants[] = $unEnseignantSurveillant;
        }
    }

    /**
     * @brief Permet de supprimer un EnseignantSurveillant de la liste des enseignants surveillants du Controle
     *
     * @param string $unEnseignantSurveillant Enseignant surveillant du contrôle à supprimer
     */
    public function supprimerEnseignantSurveillant($unEnseignantSurveillant)
    {
        if ($this->existeEnseignantSurveillant($unEnseignantSurveillant)) {
            unset($this->mesSurveillants[array_search($unEnseignantSurveillant, $this->mesSurveillants)]);
        }
    }

    /**
     * Retourne vrai si l'Enseignant surveillant est celui du Controle, faux sinon
     * @param string $unEnseignantSurveillant Enseignant surveillant
     * @return bool
     */
    public function existeEnseignantSurveillant($unEnseignantSurveillant)
    {
        if (in_array($unEnseignantSurveillant, $this->getMesEnseignantsSurveillants())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Retourne la liste des Enseignants Surveillants
     * @return array
     */
    public function getMesEnseignantsSurveillants()
    {
        return $this->mesSurveillants;
    }
    // METHODES SPECIFIQUES

    /**
     * @brief Retourne la durée totale pour un étudiant non tiers temps
     *
     * @return int|null
     */
    public function getDureeNonTT()
    {
        if ($this->duree == null)
            return null;
        else
            return round(($this->duree) * 3 / 4);
    }

    /**
     * @brief Retourne vrai si le Controle a toutes les informations, faux sinon
     *
     * @return bool
     */
    public function controleInfoComplet()
    {
        return ($this->getNomLong() != null and $this->getNomCourt() != null
            and $this->getDate() != null and $this->getDuree() != null
            and $this->getHeureTT() != null and $this->getHeureNonTT() != null
            and $this->getMesPromotions() != null and $this->getMesSalles() != null
        );
    }

    /**
     * @brief Retourne une chaîne de caractères informant des informations manquantes
     * @return string
     */
    public function infoManquant(){
        $infoManquant = "Manquant : <br>";
        if ($this->getNomLong() == null){
            $infoManquant .= "• Nom long<br>";
        }
        if ($this->getNomCourt() == null){
            $infoManquant .= "• Nom court<br>";
        }
        if ($this->getDate() == null){
            $infoManquant .= "• Date<br>";
        }
        if ($this->getDuree() == null){
            $infoManquant .= "• Durée<br>";
        }
        if ($this->getHeureTT() == null){
            $infoManquant .= "• Heure début TT<br>";
        }
        if ($this->getHeureNonTT() == null){
            $infoManquant .= "• Heure début non TT<br>";
        }
        if ($this->getMesPromotions() == null){
            $infoManquant .= "• Promotions<br>";
        }
        if ($this->getMesSalles() == null){
            $infoManquant .= "• Salles<br>";
        }
        return $infoManquant;
    }

    /**
     * @brief Retourne le nom du dossier de génération
     * @return string
     * @example 2023-02-03_R1-01-Test
     */
    public function getNomDossierGeneration(){
        $date = $this->getDate();
        // Date actuellement au format DD/MM/YYYY en YYYY-MM-DD
        $date = str_replace("/", "-", $date);
        $date = date('Y-m-d', strtotime($date));
        $nomDossier = str_replace("-", "", $this->getNomCourt());
        $nomDossier = str_replace(".", "-", $nomDossier);
        $nomDossier = preg_replace("/\s+/", " ", $nomDossier);
        $nomDossier = trim($nomDossier);
        $nomDossier = str_replace("/", "-", $nomDossier);
        $nomDossier = str_replace(" ", "-", $nomDossier);

        $nomDossier = $date . "_" . $nomDossier;

        return $nomDossier;
    }

    /**
     * @brief Retourne l'état sur la génération du PDP, 0 si incomplet, 1 si générable, 2 si généré
     * @return int
     */
    public function getEtatPDP(){
        if($this->controleInfoComplet()){
            // Vérifier que le dossier existe
            $nomDossier = $this->getNomDossierGeneration();
            $cheminDossier = GENERATIONS_FOLDER_NAME . $nomDossier . "/" . PLANS_DE_PLACEMENT_PDF_PATH;
            if (file_exists($cheminDossier)){
                return 2;
            }
            else{
                return 1;
            }
        }
        else{
            return 0;
        }

    }

    public function getEtatFE(){
        if($this->controleInfoComplet()){
            // Vérifier que le dossier existe
            $nomDossier = $this->getNomDossierGeneration();
            $cheminDossier = GENERATIONS_FOLDER_NAME . $nomDossier . "/" . FEUILLES_EMARGEMENT_FOLDER_NAME;
            if (file_exists($cheminDossier)){
                // Dossier existe
                return 2;
            }
            // S'il y a un enseignant référent et qu'il y a autant de salles que d'enseignants surveillants
            elseif(
                $this->getMesEnseignantsReferents() != null 
                && count($this->getMesSalles()) == count($this->getMesEnseignantsSurveillants())
                && $this->getEtatPDP() == 2)
            {
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }

    }

    public function getEtatMail(){
        if($this->getEtatPDP() == 2){
            // Ouvrir le fichier "mails.txt"
            $nomDossier = $this->getNomDossierGeneration();
            $cheminDossier = GENERATIONS_FOLDER_NAME . $nomDossier . "/mails.txt";
            if (file_exists($cheminDossier)){
                // Si la première ligne est "1", alors le mail a été envoyé
                $fichier = fopen($cheminDossier, "r");
                $ligne = fgets($fichier);
                if ($ligne == "1"){
                    return 2;
                }
                else{
                    return 1;
                }
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }




    /**
     * Retourne la liste des enseignants associés a leurs salles ou false
     * @return array|null
     */
    public function obtenirEnsSalles()
    {
        $ensSalles = array();
        $salles = $this->getMesSalles();
        $surveillants = $this->getMesEnseignantsSurveillants();
        if (count($salles)== count($surveillants)){
        $i = 0;
        foreach ($salles as $uneSalle) {
            $nomSalle = $uneSalle->getNom();
            $ensSalles[$nomSalle]=$surveillants[$i];
            $i++;
        }
        return $ensSalles;
    }
        return null;
    }

}