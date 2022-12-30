<?php
/**
 * @file UnPlacement.php
 * @author Cédric ETCHEPARE <etcheparecedric@gmail.com>
 * @brief Spécification de la classe UnPlacement
 * @details Represente un placement par sa Zone et son Etudiant
 * 
 * @version 1.0
 * @date 2022-12-26
 * 
 * 
 */

/**
 * @brief Classe UnPlacement permettant de définir la Zone du placement choisi et son Etudiant
 */
class UnPlacement
{
    //VARIABLES

    /**
     * @brief Zone du placement
     *
     * @var Zone
     */

    private $maZone;

    /**
     * @brief Etudiant placé dans la Zone
     *
     * @var Etudiant
     */
    private $monEtudiant;



    //ENCAPSULATION

    /**
     * @brief Retourne la Zone de placement
     *
     * @return Zone
     */
    public function getMaZone()
    {
        return $this->maZone;
    }


    /**
     * @brief Affecte une Zone de placement 
     *
     * @param Zone $nouvelleZone
     */
    public function setMaZone($nouvelleZone)
    {
        $this->maZone = $nouvelleZone;
    }


    /**
     * @brief Retourne l'Etudiant placé dans la Zone
     *
     * @return Etudiant
     */
    public function getMonEtudiant()
    {
        return $this->monEtudiant;
    }

    /**
     * @brief Affecte un Etudiant dans la Zone
     *
     * @param Etudiant $nouveauEtudiant
     */
    public function setMonEtudiant($nouveauEtudiant)
    {
        $this->monEtudiant = $nouveauEtudiant;
    }

}

?>