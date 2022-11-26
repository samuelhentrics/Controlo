<?php
/**
 * @brief Classe ContraintesEspacement permettant de définir les contraintes d'espacement
 */
class ContraintesGenerales
{

    //VARIABLES
    /**
     * Ordre de tri des étudiants pour le placement.
     * 
     * @var string
     */
    private $algoRemplissage;

    /**
     * Information sur qui peut rester à coté d'un Etudiant
     * 
     * @var string
     */
    private $coteACote;

    //ENCAPSULATION

    /**
     * Retourne l'ordre de tri des étudiants pour le placement
     * 
     * @return string
     */
    public function getAlgoRemplissage()
    {
        return $this->algoRemplissage; 
    }

    /**
     * Affecte un algo de remplissage aux ContraintesGenerales 
     * 
     * @param  string $nouveauAlgoRemplissage Algorithme de remplissage (aléatoire, ascendant, descendant)
     */
    public function setAlgoRemplissage($nouveauAlgoRemplissage)
    {
        if ($nouveauAlgoRemplissage = "aléatoire" or $nouveauAlgoRemplissage == "ascendant" or $nouveauAlgoRemplissage =="descendant"){
            $this->algoRemplissage = $nouveauAlgoRemplissage;
        }
        else{
            $this->algoRemplissage ="ascendant";
        }
    }

    /**
     * Retourne une information sur qui peut rester à coté d'un étudiant
     * 
     * @return string
     */
    public function getCoteACote()
    {
        return $this->coteACote;
    }

    /**
     * Permet d'affecter l'information qui identifie qui peut rester à coté d'un étudiant
     * 
     * @param string $nouveauCoteACote Information pour placer un Etudiant à côté d'un autre Etudiant
     */
    public function setCoteACote($nouveauCoteACote)
    {
        if ($nouveauCoteACote == "tdDifférent" or $nouveauCoteACote == "tpDifférent" or $nouveauCoteACote == "alphabétique"){
            $this->coteACote = $nouveauCoteACote;
        }
        else{
            $this->coteACote ="alphabétique";
        }
    }

}