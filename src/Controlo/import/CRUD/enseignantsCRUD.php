<?php


/**
 * @brief Fonction qui ajoute un enseignant dans le fichier CSV des enseignants
 * @param Enseignant $unEnseignant L'enseignant à ajouter
 * @throws Exception
 * @return void
 */
function ajouterEnseignant($unEnseignant){
    try{
        // Ouvrir le fichier CSV des liste-enseignants
        $monFichier = fopen(CSV_ENSEIGNANTS_FOLDER_NAME . LISTE_ENSEIGNANTS_FILE_NAME, 'a');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des enseignants");
        }

        // Ajouter l'enseignant à la fin du fichier CSV
        $nom = $unEnseignant->getNom();
        $prenom = $unEnseignant->getPrenom();
        $statut = $unEnseignant->getEstTitulaire();

        $statutEcrit = "";
        if($statut){
            $statutEcrit = "Titulaire";
        }
        else{
            $statutEcrit = "Vacataire";
        }

        $ligne = array($nom, $prenom, $statut);
        fputcsv($monFichier, $ligne, ";");

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}

/**
 * @brief Fonction qui supprime un enseignant dans le fichier CSV des enseignants
 * @param Enseignant $unEnseignant L'enseignant à supprimer
 * @throws Exception
 * @return void
 */
function modifierEnseignant($unEnseignant){
    $idEnseignant = $unEnseignant->getId();
    $nom = $unEnseignant->getNom();
    $prenom = $unEnseignant->getPrenom();
    $statut = $unEnseignant->getEstTitulaire();

    try{
        // Ouvrir le fichier CSV des liste-enseignants
        $monFichier = fopen(CSV_ENSEIGNANTS_FOLDER_NAME . LISTE_ENSEIGNANTS_FILE_NAME, 'r');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des enseignants");
        }

        // Lire le fichier CSV
        $listeEnseignants = array();

        // Ajouter l'en-tête du fichier CSV
        $entete = fgetcsv($monFichier, 0, ";");

        // Lire le fichier CSV
        while(!feof($monFichier)){
            $ligne = fgetcsv($monFichier, 0, ";");

            $id = 0;
            // Si la ligne n'est pas vide
            if($ligne != false){
                // Récupérer les informations de l'enseignant
                $nom = $ligne[0];
                $prenom = $ligne[1];
                $statut = $ligne[2];

                // Créer l'objet Enseignant
                $enseignant = new Enseignant($id, $nom, $prenom, $statut);

                // Ajouter l'objet Enseignant à la liste
                array_push($listeEnseignants, $enseignant);

                // Incrémenter l'id
                $id++;
            }
        }

        // Fermer le fichier CSV

        fclose($monFichier);

        // Modifier l'enseignant dans la liste
        $listeEnseignants[$idEnseignant] = $unEnseignant;

        // Réécrire le fichier CSV
        $monFichier = fopen(CSV_ENSEIGNANTS_FOLDER_NAME . LISTE_ENSEIGNANTS_FILE_NAME, 'w');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des enseignants");
        }

        // Ajouter l'entête du fichier CSV
        fputcsv($monFichier, $entete, ";");

        // Ajouter les enseignants dans le fichier CSV
        foreach($listeEnseignants as $unEnseignant){
            $nom = $unEnseignant->getNom();
            $prenom = $unEnseignant->getPrenom();
            $statut = $unEnseignant->getEstTitulaire();

            $ligne = array($nom, $prenom, $statut);
            fputcsv($monFichier, $ligne, ";");
        }

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}

function supprimerEnseignant($idEnseignant){
    try{
        // Ouvrir le fichier CSV des liste-enseignants
        $monFichier = fopen(CSV_ENSEIGNANTS_FOLDER_NAME . LISTE_ENSEIGNANTS_FILE_NAME, 'r');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des enseignants");
        }

        // Lire le fichier CSV
        $listeEnseignants = array();

        // Ajouter l'en-tête du fichier CSV
        $entete = fgetcsv($monFichier, 0, ";");

        // Lire le fichier CSV
        while(!feof($monFichier)){
            $ligne = fgetcsv($monFichier, 0, ";");

            $id = 0;
            // Si la ligne n'est pas vide
            if($ligne != false){
                // Récupérer les informations de l'enseignant
                $nom = $ligne[0];
                $prenom = $ligne[1];
                $statut = $ligne[2];

                if ($statut == "Titulaire"){
                    $statut = true;
                }
                else{
                    $statut = false;
                }

                // Créer l'objet Enseignant
                $enseignant = new Enseignant($id, $nom, $prenom, $statut);

                // Ajouter l'objet Enseignant à la liste
                array_push($listeEnseignants, $enseignant);

                // Incrémenter l'id
                $id++;
            }
        }

        // Fermer le fichier CSV

        fclose($monFichier);

        // Supprimer l'enseignant dans la liste
        unset($listeEnseignants[$idEnseignant]);

        // Réécrire le fichier CSV
        $monFichier = fopen(CSV_ENSEIGNANTS_FOLDER_NAME . LISTE_ENSEIGNANTS_FILE_NAME, 'w');

        if(!$monFichier){
            throw new Exception("Impossible d'ouvrir le fichier CSV des enseignants");
        }

        // Ajouter l'entête du fichier CSV
        fputcsv($monFichier, $entete, ";");

        // Ajouter les enseignants dans le fichier CSV
        foreach ($listeEnseignants as $unEnseignant) {
            $nom = $unEnseignant->getNom();
            $prenom = $unEnseignant->getPrenom();
            $statut = $unEnseignant->getEstTitulaire();

            // Transformer le statut en chaîne de caractères
            if ($statut == true) {
                $statut = "Titulaire";
            } else {
                $statut = "Vacataire";
            }

            $ligne = array($nom, $prenom, $statut);
            fputcsv($monFichier, $ligne, ";");
        }

        // Fermer le fichier CSV
        fclose($monFichier);
    }
    catch(Exception $e){
        throw new Exception($e->getMessage());
    }
}