<?php
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

    public function setNom($nouveauNom)
    {
        $this->nom = $nouveauNom;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setPrenom($nouveauPrenom)
    {
        $this->prenom = $nouveauPrenom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setTd($nouveauTd)
    {
        $this->td = $nouveauTd;
    }

    public function getTd()
    {
        return $this->td;
    }
    public function setTp($nouveauTd)
    {
        $this->tp = $nouveauTd;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($nouveauMail)
    {
        $this->email = $nouveauMail;
    }

    public function getTp()
    {
        return $this->tp;
    }
    public function setEstTT($bool)
    {
        $this->estTT = $bool;
    }

    public function getEstTT()
    {
        return $this->estTT;
    }
    public function setAOrdi($bool)
    {
        $this->aOrdi = $bool;
    }

    public function getAOrdi()
    {
        return $this->aOrdi;
    }
    public function setEstDemissionnaire($bool)
    {
        $this->estDemissionnaire = $bool;
    }

    public function getEstDemissionnaire()
    {
        return $this->estDemissionnaire;
    }
}
