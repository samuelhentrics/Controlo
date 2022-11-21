<?php

/**
 * Retourne une nouvelle heure avec X minutes ajoutées à une heure de départ
 *
 * @param string $heure
 * @param int $minutesAAjouter
 * @return string
 */
function ajouterMinutesHeure($heureDepart,$minutesAAjouter)
{
$timestamp = strtotime("$heureDepart");
$heureFinale = strtotime("+$minutesAAjouter minutes", $timestamp);
return $heureFinale = date('H:i', $heureFinale);
}

?>