![header](https://capsule-render.vercel.app/api?type=waving&color=auto&height=300&section=header&text=Controlo&fontSize=90&animation=fadeIn&fontAlignY=38&desc=S3.01A%20Développement%20d'application%20et%20Gestion%20de%20projet&descAlignY=51&descAlign=62&customColorList=4)


<div id="top">

[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]

</div>
<!-- PROJECT LOGO -->
<br />
<br />
<div align="center">
  <!-- <img src="src/Controlo/Front/images/logo.png" alt="Logo" width="80" height="80" -->

  <h3 align="center">Controlo - L'application de placement des étudiants lors des contrôles</h3>

  <p align="center">
    S3.01A - Développement d'application et Gestion de projet
    <br />
    <a href="https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet/tree/master/docs"><strong>Voir les documents »</strong></a>
    <br />
    <br />
    <a href="https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet/issues/">Reporter un bug</a>
    ·
    <a href="https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet/discussions/6">Proposer des fonctionnalités</a>
  </p>
</div>



<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table des matières</summary>
  <ol>
    <li>
      <a href="#a-propos-du-projet">A propos du projet</a>
    </li>
    <li>
      <a href="#pitch-de-la-fonctionnalité-retenu">Pitch de la fonctionnalité retenue</a>
    </li>
    <li>
      <a href="#hierarchie-du-projet">Hiérarchie du projet</a>
    </li>
    <li>
      <a href="#contact">Contact</a>
    </li>
  </ol>
</details>



<!-- A PROPOS DU PROJET -->
## A Propos du projet

L'application que nous développons est une application web. Celle-ci permet gérer le placement des étudiants lors des contrôles à travers la création de plans de placement et de feuilles d’émargements, elle a un but professionnel puisqu'elle s'adresse à l'administration du département informatique de l'IUT de Bayonne et du Pays Basque. 

## Pitch de la fonctionnalité retenue

La fonctionnalité que nous avons retenue pour notre application est le placement automatique des étudiants. Celui-ci se base sur des plans de salles qui seront fournis en CSV où on va venir appliquer de nombreuses contraintes qui définiront le placement :
- Le nombre de places séparant les étudiants
- Le nombre de rangés séparant les étudiants (rare en salle, mais très fréquent en amphi)
- Les étudiants tier-temps qui doivent être dans des salles spécifiques avec des places précise selon l’utilisation d’un ordinateur ou non
- Le nombre d’étudiants à placer, l’application vérifiera à partir des plans de placements déjà établis les salles qui sont disponibles pour effectuer le              placement
- Si le nombre d’étudiants est trop grand par rapport aux salles disponibles, l’application enverra une notification à l'utilisateur en l’invitant à ajouter de           nouvelles salles.

On aura aussi des algorithmes différents afin de placer les étudiants :
- Un placement selon les groupes : TP ou TD ou indifférent
- Un placement par ordre alphabétique ascendant, descendant ou aléatoire

Pour ce qui est du résultat du placement automatique, les plans de placement seront générés par un PDF

<p align="right">(<a href="#top">Retour en haut</a>)</p>

<!-- -->
## Hierarchie du projet

Notre projet est constitué de 4 dossiers :
- Un dossier `Spécification` contenant les Spécifications Externes du Problème Algorithmique que nous traitons.
- Un dossier `Algorithme` contenant notre Algorithme et son Dictionnaire.
- Un dossier `src` qui héberge le Code correspondant à notre Algorithme.
- Un dossier `docs` qui contient la documentation Doxygen du code source.

<!-- CONTACT -->
## Contact

Samuel HENTRICS LOISTINE -  samuel.hentrics@gmail.com

Ahmed FAKHFAKH - fakhfakhahmed45@gmail.com

Cédric ETCHEPARE - cetchepar001@iutbayonne.univ-pau.fr

Benjamin PEYRE - bpeyre@iutbayonne.univ-pau.fr

Lien du projet: [https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet](https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet)

<p align="right">(<a href="#top">Retour en haut</a>)</p>


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet?style=for-the-badge
[contributors-url]: https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet.svg?style=for-the-badge
[forks-url]: https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet/network/members
[stars-shield]: https://img.shields.io/github/stars/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet.svg?style=for-the-badge
[stars-url]: https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet/stargazers
[issues-shield]: https://img.shields.io/github/issues/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet.svg?style=for-the-badge
[issues-url]: https://github.com/samuelhentrics/S3.01A-Developpement-d-application-et-Gestion-de-projet/issues
