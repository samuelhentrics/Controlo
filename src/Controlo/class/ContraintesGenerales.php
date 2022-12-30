<?php
/**
 * @file ContraintesGenerales.php
 * @author Cédric ETCHEPARE
 * @brief Spécification de la classe ContraintesGenerales
 * @details Represente les contraintes generales d'un contrôle
 * avec la méthode de remplissage.
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 */


/**
 * @brief Classe ContraintesEspacement permettant de définir les contraintes d'espacement
 * @todo Constructeur
 */
class ContraintesGenerales
{

    //VARIABLES
    /**
     * @brief Ordre de tri des étudiants pour le placement.
     * 
     * @var string
     */
    private $algoRemplissage;

    /**
     * @brief Information sur qui peut rester à coté d'un Etudiant
     * 
     * @var string
     */
    private $coteACote;


    // Constructeur

    /**
     * @brief Constructeur de ContraintesGenerales
     *
     * @param string $unAlgoRemplissage Ordre de tri des étudiants pour le placement.
     * @param string $unCoteACote Information sur qui peut rester à coté d'un Etudiant
     */
    function __construct($unAlgoRemplissage, $unCoteACote)
    {
        $this->setAlgoRemplissage($unAlgoRemplissage);
        $this->setCoteACote($unCoteACote);
    }





    //ENCAPSULATION

    /**
     * @brief Retourne l'ordre de tri des étudiants pour le placement
     * 
     * @return string
     */
    public function getAlgoRemplissage()
    {
        return $this->algoRemplissage;
    }

    /**
     * @brief Affecte un algo de remplissage aux ContraintesGenerales 
     * 
     * @param string $nouveauAlgoRemplissage Algorithme de remplissage (aléatoire, ascendant, descendant)
     */
    public function setAlgoRemplissage($nouveauAlgoRemplissage)
    {
        if ($nouveauAlgoRemplissage = "aléatoire" or $nouveauAlgoRemplissage == "ascendant" or $nouveauAlgoRemplissage == "descendant") {
            $this->algoRemplissage = $nouveauAlgoRemplissage;
        } else {
            $this->algoRemplissage = "ascendant";
        }
    }

    /**
     * @brief Retourne une information sur qui peut rester à coté d'un étudiant
     * 
     * @return string
     */
    public function getCoteACote()
    {
        return $this->coteACote;
    }

    /**
     * @brief Permet d'affecter l'information qui identifie qui peut rester à coté d'un étudiant
     * 
     * @param string $nouveauCoteACote Information pour placer un Etudiant à côté d'un autre Etudiant
     */
    public function setCoteACote($nouveauCoteACote)
    {
        if ($nouveauCoteACote == "tdDifférent" or $nouveauCoteACote == "tpDifférent" or $nouveauCoteACote == "alphabétique") {
            $this->coteACote = $nouveauCoteACote;
        } else {
            $this->coteACote = "alphabétique";
        }
    }

}