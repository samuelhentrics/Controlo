<?php
class Promotion
{
    // Variables

    private $nom;

    // Encapsulation

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nouveauNom)
    {
        $this->nom=$nouveauNom;
    }
}
?>