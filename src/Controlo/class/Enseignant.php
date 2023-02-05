<?php
/**
 * @file Enseignant.php
 * @brief Contient la classe Enseignant
 * @details Cette classe permet de créer des objets Enseignant
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @version 1.0
 * @ate 2023-02-01
 */


 /**
  * @brief Classe Enseignant
  * @details Cette classe permet de créer des objets Enseignant à partir de son identifiant, de son nom, de son prénom et de son statut (titulaire ou non)
  */
class Enseignant{
    // ATTRIBUTS

    /**
     * @brief Identifiant de l'enseignant
     * @var int
     */
    public $id;

    /**
     * @brief Nom de l'enseignant
     * @var string
     */
    public $nom;

    /**
     * @brief Prénom de l'enseignant
     * @var string
     */
    public $prenom;

    /**
     * @brief Informe si l'enseignant est titulaire (vrai) ou non (faux par défaut)
     * @var bool
     */
    public $estTitulaire;

    // CONSTRUCTEUR

    /**
     * @brief Constructeur de la classe Enseignant
     * @param int $id Identifiant de l'enseignant
     * @param string $nom Nom de l'enseignant
     * @param string $prenom Prénom de l'enseignant
     * @param bool $estTitulaire Informe si l'enseignant est titulaire (vrai) ou non (faux par défaut)
     */
    public function __construct($id, $nom, $prenom, $estTitulaire = false){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->estTitulaire = $estTitulaire;
    }

    // ENCAPSULATION
    /**
     * @brief Retourne l'identifiant de l'enseignant
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @brief Modifie l'identifiant de l'enseignant
     * @param int $id
     * @return void
     */
    public function setId($id){
        $this->id = $id;
    }

    /**
     * @brief Retourne le nom de l'enseignant
     * @return string
     */
    public function getNom(){
        return $this->nom;
    }

    /**
     * @brief Modifie le nom de l'enseignant
     * @param string $nom
     * @return void
     */
    public function setNom($nom){
        $this->nom = $nom;
    }

    /**
     * @brief Retourne le prénom de l'enseignant
     * @return string
     */
    public function getPrenom(){
        return $this->prenom;
    }

    /**
     * @brief Modifie le prénom de l'enseignant
     * @param string $prenom
     * @return void
     */
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    /**
     * @brief Retourne si l'enseignant est titulaire (vrai) ou non (faux)
     * @return bool
     */
    public function getEstTitulaire(){
        return $this->estTitulaire;
    }

    /**
     * @brief Modifie si l'enseignant est titulaire (vrai) ou non (faux)
     * @param bool $estTitulaire
     * @return void
     */
    public function setEstTitulaire($estTitulaire){
        $this->estTitulaire = $estTitulaire;
    }

    // METHODES
}