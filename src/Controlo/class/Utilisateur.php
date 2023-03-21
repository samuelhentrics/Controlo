<?php

class Utilisateur
{
    // Variables

    public $id;
    private $nom;
    private $prenom;
    private $role;
    private $mail;
    private $mdp;

    private $imgProfil;

    // Constructeur
    public function __construct($id, $nom, $prenom, $role, $mail, $mdp, $imgProfil = "profil/default.png")

    {
        $this->setId($id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setRole($role);
        $this->setMail($mail);
        $this->setMdp($mdp);
        $this->setImgProfil($imgProfil);
    }


    // Encapsulation
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nouveauNom)
    {
        $this->nom = $nouveauNom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($nouveauPrenom)
    {
        $this->prenom = $nouveauPrenom;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setRole($nouveauRole)
    {
        $this->role = $nouveauRole;
    }

    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($nouveauMail)
    {
        $this->mail = $nouveauMail;
    }

    public function getMdp()
    {
        return $this->mdp;
    }
    public function setMdp($nouveauMdp)
    {
        $this->mdp = $nouveauMdp;
    }

    public function getImgProfil()
    {
        return $this->imgProfil;
    }

    public function setImgProfil($nouveauImgProfil)
    {
        $this->imgProfil = $nouveauImgProfil;
    }
    
}
?>