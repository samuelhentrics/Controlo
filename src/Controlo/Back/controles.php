<?php

echo '<main>
        <section>
            <h1>Liste des contrôles</h1>
            <table id="controles" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom long</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Tiers-temps</th>
                        <th>Promotion(s)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';
include($FONCTION_CREER_LISTE_CONTROLES);
include($FONCTION_AJOUTER_MINUTES_HEURE);

$listeControles = creerListeControles();

for ($i = 0; $i <= count($listeControles) - 1; $i++) {
    // Nom long du contrôle
    print("<tr>
                                <td>
                                    {$listeControles[$i]->getNomLong()}
                                </td>
                            <td>");

    // Date du contrôle
    if ($listeControles[$i]->getDate() != null) {
        print("{$listeControles[$i]->getDate()}");
    } else {
        print("Non définie");
    }

    print("</td>
                    <td>");

    // Heure Non TT
    if ($listeControles[$i]->getHeureNonTT() != null) {
        echo $listeControles[$i]->getHeureNonTT(), "-", ajouterMinutesHeure($listeControles[$i]->getHeureNonTT(), $listeControles[$i]->getDureeNonTT());
    } else {
        print("Non définie");
    }

    print("</td>
                                        <td>");

    // Heure TT
    if ($listeControles[$i]->getHeureTT() != null) {
        echo $listeControles[$i]->getHeureTT(), "-", ajouterMinutesHeure($listeControles[$i]->getHeureTT(), $listeControles[$i]->getDuree());
    } else {
        print("Non définie");
    }

    print("</td>
                                        <td>");

    // Promotions du contrôles
    print("Pas encore programmé");

    print("</td>
                                        <td>");

    // Bouton pour Générer

    print("</td>
                                        </tr>");
}
echo '
                            </tbody>
                        </table>
            
                    </section>
                </main>';
