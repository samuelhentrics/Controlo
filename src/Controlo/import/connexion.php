<?php 

include_once(FONCTION_ASSOCIER_ENTETE_LIGNE_PATH);

/**
 * @brief Fonction qui permet de se déconnecter
 * 
 */
function seDeconnecter(){
    session_destroy();

    // Supprimer les cookies de sauvegarde de connexion

    // Non codé

    // Redirection vers la page d'accueil
    echo "<script>window.location.replace('index.php');</script>";
}

/**
 * @brief Fonction qui permet de se connecter
 * @param string $email L'email de l'utilisateur
 * @param string $pwd Le mot de passe de l'utilisateur
 * @param bool $garderSession Si l'utilisateur souhaite garder sa session (vrai si oui, faux sinon)
 */
function seConnecter($email, $pwd, $garderSession = false){
    $connexionOk = false;
    
    try{
        // On ouvre le fichier liste-utilisateurs.csv
        $fichier = fopen(CSV_UTILISATEURS_FOLDER_NAME . LISTE_UTILISATEURS_FILE_NAME, "r");

        // Cas d'erreur
        if($fichier === FALSE){
            throw new Exception("Erreur lors de l'ouverture du fichier");
        }


        // Récupérer l'entete
        $entete = fgetcsv($fichier, 1000, ";");

        // On lit le fichier ligne par ligne
        while (($ligne = fgetcsv($fichier, 1000, ";")) !== FALSE) {
            $ligne = associerEnteteLigne($entete, $ligne);

            // On vérifie si l'email et le mot de passe correspondent


            if (strtolower($email) == strtolower($ligne["email"]) && estMdpValide($ligne["mdp"], $pwd)) {
                // On crée la session
                $_SESSION["id"] = $ligne["id"];
                $_SESSION["nom"] = $ligne["nom"];
                $_SESSION["prenom"] = $ligne["prenom"];
                $_SESSION["email"] = strtolower($ligne["email"]);
                $_SESSION["role"] = $ligne["role"];
                $_SESSION["avatar"] = $ligne["src_pp"];

                // On vérifie si l'utilisateur souhaite garder sa session

                // Non codé


                $connexionOk = true;
                break;
            }
        }

        // On ferme le fichier
        fclose($fichier);

    }catch(Exception $e){
        echo $e->getMessage();
    }

    return $connexionOk;
}

/**
 * @brief Fonction qui permet de vérifier si l'utilisateur est connecté
 * @return bool Vrai si l'utilisateur est connecté, faux sinon
 */
function estConnecte(){
    return isset($_SESSION["id"]);
}

/**
 * @brief Fonction qui permet de vérifier si l'utilisateur est un administrateur
 * @return bool Vrai si l'utilisateur est un administrateur, faux sinon
 */
function estAdmin(){
    return isset($_SESSION["role"]) && $_SESSION["role"] == "0";
}

/**
 * @brief Fonction qui permet de vérifier si l'utilisateur est un secrétaire administratif
 * @return bool Vrai si l'utilisateur est un secrétaire administratif, faux sinon
 */
function estSecretaireAdmin(){
    return isset($_SESSION["role"]) && $_SESSION["role"] == "1";
}

/**
 * @brief Fonction qui permet de vérifier si l'utilisateur est un secrétaire
 * @return bool Vrai si l'utilisateur est un secrétaire, faux sinon
 */
function estSecretaire(){
    return isset($_SESSION["role"]) && $_SESSION["role"] == "2";
}

/**
 * @brief Fonction qui permet d'hasher un mot de passe avec haval256,5
 * @param string $password Le mot de passe à hasher
 * @return string Le mot de passe hashé
 */
function hashPassword($password){
    // Hasher le mot de passe avec haval256,5
    return hash("haval256,5", $password);
}

/**
 * @brief Fonction qui permet de vérifier si le mot de passe hashé correspond au mot de passe
 * @param string $passwordHashe Le mot de passe hashé
 * @param string $password Le mot de passe
 * @return bool Vrai si le mot de passe hashé correspond au mot de passe, faux sinon
 */
function estMdpValide($passwordHashe, $password){
    return $passwordHashe == hashPassword($password);
}