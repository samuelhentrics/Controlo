<?php
    class Etudiant{

        /* Member variables */
        private $nom;
        private $prenom;
        private $td;
        private $tp;
        private $email;
        private $estTT;//est TierTemps
        private $aOrdi; //bool
        private $estDemissionnaire;

        function __construct($nom, $prenom, $td, $tp, $email) {
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setTd($td);
            $this->setTp($tp);
            $this->setEmail($email);
        }

        /* Member functions */
        function setNom($nouveauNom)
        {
            $this->nom = $nouveauNom;
        }

        function getNom()
        {
            return $this->nom;
        }
        function setPrenom($nouveauPrenom)
        {
            $this->prenom = $nouveauPrenom;
        }

        function getPrenom()
        {
            return $this->prenom;
        }
        function setTd($nouveauTd)
        {
            $this->td = $nouveauTd;
        }

        function getTd()
        {
            return $this->td;
        }
        function setTp($nouveauTd)
        {
            $this->tp = $nouveauTd;
        }

        function getEmail()
        {
            return $this->email;
        }
        function setEmail($nouveauMail)
        {
            $this->email = $nouveauMail;
        }

        function getTp()
        {
            return $this->tp;
        }
        function setEstTT($bool)
        {
            $this->estTT = $bool;
        }

        function getEstTT()
        {
            return $this->estTT;
        }
        function setAOrdi($bool)
        {
            $this->aOrdi = $bool;
        }

        function getAOrdi()
        {
            return $this->aOrdi;
        }
        function setEstDemissionnaire($bool)
        {
            $this->estDemissionnaire = $bool;
        }

        function getEstDemissionnaire()
        {
            return $this->estDemissionnaire;
        }

        
    }