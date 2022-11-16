<?php
    class Etudiant{

        /* Member variables */
        private $nom;
        private $prenom;
        private $td;
        private $tp;
        private $estTT;//est TierTemps
        private $aOrdi; //bool
        private $estDemissionaire;



        /* Member functions */
        function setnom($nouveauNom)
        {
            $this->nom = $nouveauNom;
        }

        function getnom()
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
        function setAordi($bool)
        {
            $this->aOrdi = $bool;
        }

        function getAordi()
        {
            return $this->aOrdi;
        }
        function setEstdemissionaire($bool)
        {
            $this->estDemissionaire = $bool;
        }

        function getEstdemissionaire()
        {
            return $this->estDemissionaire;
        }

        
    }