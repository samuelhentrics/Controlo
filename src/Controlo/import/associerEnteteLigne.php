<?php
/**
 * @file associerEnteteLigne.php
 * @author Samuel HENTRICS LOISTINE <samuel.hentrics@gmail.com>
 * @brief Fichier contenant la fonction associerEnteteLigne
 * qui permet d'associer proprement à une ligne informative les indices
 * de clés correspondant à l'entête
 * 
 * @version 1.0
 * @date 2023-01-25
 * 
 */

/**
 * Associe les indices de clés de l'entête à une ligne informative
 * @param array $entete Entête
 * @param array $uneLigne Ligne informative
 * @return array $uneLigneAssocieeEntete Ligne informative associée à l'entête
 */
function associerEnteteLigne($entete, $uneLigne)
{
    $min = min(count($entete), count($uneLigne));
    $enteteModif = array_slice($entete, 0, $min);
    $uneLigne = array_slice($uneLigne, 0, $min);
    $uneLigneAssocieeEntete = array_combine($enteteModif, $uneLigne);
    return $uneLigneAssocieeEntete;
}