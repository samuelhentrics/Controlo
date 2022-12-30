<?php
/**
 * @file ajouterMinutesHeure.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Fichier contenant la fonction ajouterMinutesHeure
 * qui permet d'ajouter à une heure donnée, des minutes supplémentaires
 * 
 * @version 1.0
 * @date 2022-11-26
 * 
 * 
 */


/**
 * @brief Retourne une nouvelle heure avec X minutes ajoutées à une heure de départ
 *
 * @param string $heure
 * @param int $minutesAAjouter
 * @return string
 */
function ajouterMinutesHeure($heureDepart, $minutesAAjouter)
{
    $timestamp = strtotime("$heureDepart");
    $heureFinale = strtotime("+$minutesAAjouter minutes", $timestamp);
    return $heureFinale = date('H:i', $heureFinale);
}

?>