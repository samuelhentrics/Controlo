<?php
/**
 * @file Etudiant.php
 * @author Benjamin PEYRE, Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Spécification de la classe Etudiant
 * @details Represente une Etudiant par son nom, prenom, td, tp, mail et ses statuts
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 */

/**
 * @brief Classe Etudiant permettant de définir un Etudiant
 * par son nom, prenom, td, tp, mail et ses statuts
 */
class Etudiant
{

    /* Attributs */

    /**
     * @brief Nom de l'Etudiant
     * @var string
     */
    private $nom;

    /**
     * @brief Prenom de l'Etudiant
     * @var string
     */
    private $prenom;

    /**
     * @brief TD de l'Etudiant
     * @var int
     */
    private $td;

    /**
     * @brief TP de l'Etudiant
     * @var int
     */
    private $tp;

    /**
     * @brief Mail de l'Etudiant
     * @var string
     */
    private $email;

    /**
     * @brief Informe si l'Etudiant dispose d'un tiers temps
     * Vrai s'il en dispose
     * Faux sinon
     * @var bool
     */
    private $estTT;

    /**
     * @brief Informe si l'Etudiant dispose d'un ordinateur
     * Vrai s'il en dispose
     * Faux sinon
     * @var bool
     */

    private $aOrdi;

    /**
     * @brief Informe si l'Etudiant est demissionnaire
     * Vrai s'il est démissionnaire
     * Faux sinon
     * @var bool
     */
    private $estDemissionnaire;


    /* CONSTRUCTEUR */

    /**
     * @brief Constructeur de la classe Etudiant
     * @param string $nom Nom de l'étudiant
     * @param string $prenom Prénom de l'étudiant
     * @param int $td TD de l'étudiant
     * @param int $tp TP de l'étudiant
     * @param string $email Mail de l'étudiant
     */
    public function __construct($nom, $prenom, $td, $tp, $email)
    {
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setTd($td);
        $this->setTp($tp);
        $this->setEmail($email);
    }

    /* Encapsulation */

    /**
     * @brief Affecte un nom à l'Etudiant
     * @param string $nouveauNom Nouveau nom de l'Etudiant
     * @return void
     */
    public function setNom($nouveauNom)
    {
        $this->nom = $nouveauNom;
    }

    /**
     * @brief Retourne le nom de l'Etudiant
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @brief Affecte un nom à l'Etudiant
     * @param string $nouveauPrenom Nouveau prénom de l'Etudiant
     * @return void
     */
    public function setPrenom($nouveauPrenom)
    {
        $this->prenom = $nouveauPrenom;
    }

    /**
     * @brief Retourne le prénom de l'Etudiant
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @brief Affecte un TD à l'Etudiant
     * @param int $nouveauTd Nouveau TD de l'Etudiant
     * @return void
     */
    public function setTd($nouveauTd)
    {
        $this->td = $nouveauTd;
    }

    /**
     * @brief Retourne le TD de l'Etudiant
     * @return int
     */
    public function getTd()
    {
        return $this->td;
    }

    /**
     * @brief Affecte un TP à l'Etudiant
     * @param int $nouveauTP Nouveau TP de l'Etudiant
     * @return void
     */
    public function setTp($nouveauTP)
    {
        $this->tp = $nouveauTP;
    }

    /**
     * @brief Retourne le TP de l'Etudiant
     * @return int
     */
    public function getTp()
    {
        return $this->tp;
    }

    /**
     * @brief Affecte l'email de l'Etudiant
     * @param string $nouveauMail Nouveau mail de l'Etudiant
     * @return void
     */
    public function setEmail($nouveauMail)
    {
        $this->email = $nouveauMail;
    }

    /**
     * @brief Retourne le mail de l'Etudiant
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @brief Affecter le statut tier-temps de l'Etudiant (Vrai si TT, Faux sinon)
     * @param bool $bool
     * @return void
     */
    public function setEstTT($bool)
    {
        $this->estTT = $bool;
    }

    /**
     * @brief Retourne si l'Etudiant dispose d'un tiers-temps (Retourne vrai si TT, Faux sinon)
     * @return bool
     */
    public function getEstTT()
    {
        return $this->estTT;
    }

    /**
     * @brief Affecte le statut sur l'ordinateur de l'Etudiant (Vrai s'il en dispose, faux sinon)
     * @param bool $bool
     * @return void
     */
    public function setAOrdi($bool)
    {
        $this->aOrdi = $bool;
    }

    /**
     * @brief Retourne vrai si l'Etudiant a un ordinateur, Faux sinon
     * @return bool
     */
    public function getAOrdi()
    {
        return $this->aOrdi;
    }

    /**
     * @brief Affecte le statut de l'Etudiant (démissionnaire ou non) (Vrai si démissionnaire, Faux sinon)
     * @param bool $bool
     * @return void
     */
    public function setEstDemissionnaire($bool)
    {
        $this->estDemissionnaire = $bool;
    }

    /**
     * @brief Retourne vrai si l'Etudiant est démissionnaire, faux sinon
     * @return bool
     */
    public function getEstDemissionnaire()
    {
        return $this->estDemissionnaire;
    }
}