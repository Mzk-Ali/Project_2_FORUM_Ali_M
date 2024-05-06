# Projet Forum (EN COURS)
_Il s'agit du 3eme projet en PHP chez ELAN Formation_

![forthebadge](https://forthebadge.com/images/badges/made-with-php.svg)
![forthebadge](https://forthebadge.com/images/badges/uses-html.svg)
![forthebadge](https://forthebadge.com/images/badges/uses-css.svg)
![forthebadge](https://forthebadge.com/images/badges/uses-js.svg)
![forthebadge](https://forthebadge.com/images/badges/uses-git.svg)


Le projet Forum est un site WEB responsive qui est un forum avec plusieurs catégories auquel un utilisateur peut ajouter des topics et des posts. Le forum a un système d'inscription et d'authentification permettant d'accéder ou de restreindre certaines possibilités selon le rôle de l'utilisateur dans le forum.
Il y a possiblité d'ajouter, modifier ou encore supprimé des topics et posts. De plus, un utilisateur ou un modérateur peut verrouillé un topic.


![image](https://github.com/Mzk-Ali/Project_2_FORUM_Ali_M/assets/161448982/69640a2b-e779-4100-a943-56f7d16394d4)



## Pour commencer


### Pré-requis

Pour commencer le projet, il est requis d'avoir

- Editeur de code (VS Code)
- Environnement de développement (Laragon)

### Installation

Tout d'abord, télécharger le projet dans le dossier C:\laragon\www

Ensuite, il faut mettre en place la base de données :
- Vous trouverez le fichier SQL dans le dossier Model
- Ouvrir le logiciel laragon, cliquer sur Démarer puis sur Base de données.
- Charger le fichier SQL puis l'éxécuter

Votre base de donnée est mise en place

## Démarrage

Pour lancer votre projet :
- Sur votre navigateur web, aller sur l'url suivant : http://localhost/project_2_Forum_Ali_M/index.php?ctrl=home&action=index

## Construction du projet

### Modélisation Conceptuelle de Donnée




### Design : MockUp

Utilisation de figma pour la création de mockup.


![image](https://github.com/Mzk-Ali/Project_2_FORUM_Ali_M/assets/161448982/64474ced-9988-4621-8e2e-ce61af619ef3)


### Arborescence du projet

Pour le Design Pattern du projet, nous avons utilisé l'architecture MVC (Modèle-Vue-Controller) permettant l'agencement du code.

- App
- Controller
  - ForumController.php
  - HomeController.php
  - SecurityController.php
- Model
  - Connect.php
- Public
  - CSS
    - style.css
  - JS
    - main.js
- View
  - _Ensemble des vues du site_
- index.php

### Gestion des failles

- Injection SQL
- Faille de sécurité XSS
- 

## Fabriqué avec

* [Looping](https://www.looping-mcd.fr/) - Modelisation Conceptuelle de Données
* [Figma](https://www.figma.com/fr-fr/) - Outil de design à interface collaborative

* [RemixIcon](https://remixicon.com/) - Open-Source Icon Library (front-end)
* [VS Code](https://code.visualstudio.com/) - Editeur de textes
* [Laragon](https://laragon.org/index.html) - Environnement de développement


## Versions

**Dernière version stable**

## Auteurs

* **Ali MARZAK** _alias_ [@Ali-Mzk](https://github.com/Mzk-Ali)

## License

Ce projet n'est pas sous license.
