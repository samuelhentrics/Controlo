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
        private $estDemissionaire;



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

        function getMail()
        {
            return $this->email;
        }
        function setMail($nouveauMail)
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
        function setEstDemissionaire($bool)
        {
            $this->estDemissionaire = $bool;
        }

        function getEstDemissionaire()
        {
            return $this->estDemissionaire;
        }

        
    }