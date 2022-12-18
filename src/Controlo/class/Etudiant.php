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
     * Nom de l'étudiant
     * @var String
     */
    private $nom;

    /**
     * Prenom de l'étudiant
     * @var String
     */
    private $prenom;

    /**
     * TD de l'étudiant
     * @var int
     */
    private $td;

    /**
     * TP de l'étudiant
     * @var mixed
     */
    private $tp;

    /**
     * Mail de l'étudiant
     * @var mixed
     */
    private $email;

    /**
     * Informe si l'étudiant dispose d'un tiers temps
     * Vrai s'il en dispose
     * Faux sinon
     * @var bool
     */
    private $estTT;

    /**
     * Informe si l'étudiant dispose d'un ordinateur
     * Vrai s'il en dispose
     * Faux sinon
     * @var bool
     */
    
    private $aOrdi;

    /**
     * Informe si l'étudiant est demissionnaire
     * Vrai s'il est démissionnaire
     * Faux sinon
     */
    private $estDemissionnaire;


    /* CONSTRUCTEUR */

    /**
     * Constructeur de la classe Etudiant
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
     * Affecte un nom à l'Etudiant
     * @param String $nouveauNom Nouveau nom de l'Etudiant
     * @return void
     */
    public function setNom($nouveauNom)
    {
        $this->nom = $nouveauNom;
    }

    /**
     * Retourne le nom de l'Etudiant
     * @return String
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Affecte un nom à l'Etudiant
     * @param String $nouveauPrenom Nouveau prénom de l'Etudiant
     * @return void
     */
    public function setPrenom($nouveauPrenom)
    {
        $this->prenom = $nouveauPrenom;
    }

    /**
     * Retourne le prénom de l'Etudiant
     * @return String 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Affecte un TD à l'Etudiant
     * @param int $nouveauTd Nouveau TD de l'Etudiant
     * @return void
     */
    public function setTd($nouveauTd)
    {
        $this->td = $nouveauTd;
    }

    /**
     * Retourne le TD de l'Etudiant
     * @return int
     */
    public function getTd()
    {
        return $this->td;
    }

    /**
     * Affecte un TP à l'Etudiant
     * @param int $nouveauTP Nouveau TP de l'Etudiant
     * @return void
     */
    public function setTp($nouveauTP)
    {
        $this->tp = $nouveauTP;
    }

    /**
     * Retourne le TP de l'Etudiant
     * @return int
     */
    public function getTp()
    {
        return $this->tp;
    }

    /**
     * Affecte l'email de l'Etudiant
     * @param String $nouveauMail Nouveau mail de l'Etudiant
     * @return void
     */
    public function setEmail($nouveauMail)
    {
        $this->email = $nouveauMail;
    }

    /**
     * Retourne le mail de l'Etudiant
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Affecter le statut tier-temps de l'Etudiant (Vrai si TT, Faux sinon)
     * @param bool $bool
     * @return void
     */
    public function setEstTT($bool)
    {
        $this->estTT = $bool;
    }

    /**
     * Retourne si l'Etudiant dispose d'un tiers-temps (Retourne vrai si TT, Faux sinon)
     * @return bool
     */
    public function getEstTT()
    {
        return $this->estTT;
    }

    /**
     * Affecte le statut sur l'ordinateur de l'Etudiant (Vrai s'il en dispose, faux sinon)
     * @param bool $bool
     * @return void
     */
    public function setAOrdi($bool)
    {
        $this->aOrdi = $bool;
    }

    /**
     * Retourne vrai si l'Etudiant a un ordinateur, Faux sinon
     * @return bool
     */
    public function getAOrdi()
    {
        return $this->aOrdi;
    }

    /**
     * Affecte le statut de l'Etudiant (démissionnaire ou non) (Vrai si démissionnaire, Faux sinon)
     * @param bool $bool
     * @return void
     */
    public function setEstDemissionnaire($bool)
    {
        $this->estDemissionnaire = $bool;
    }

    /**
     * Retourne vrai si l'Etudiant est démissionnaire, faux sinon
     * @return bool
     */
    public function getEstDemissionnaire()
    {
        return $this->estDemissionnaire;
    }
}
