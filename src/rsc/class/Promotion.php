<?php
class Promotion
{
    // Variables

    private $nom;
    private $mesControles = array();
    private $mesEtudiants = array();

    // Encapsulation

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nouveauNom)
    {
        $this->nom=$nouveauNom;
    }

    public function ajouterControle($unControle)
    {
        array_push($this->mesControles, $unControle);
    }

    public function supprimerControle($unControle)
    {
        if (array_key_exists($unControle, $this->mesControles)) {
            unset($this->mesControles[$unControle]);
        }
    }

    public function ajouterEtudiant($unEtudiant)
    {
        array_push($this->mesEtudiants, $unEtudiant);
    }

    public function supprimerEtudiant($unEtudiant)
    {
        if (array_key_exists($unEtudiant, $this->mesEtudiants)) {
            unset($this->mesEtudiants[$unEtudiant]);
        }
    }
}
?>