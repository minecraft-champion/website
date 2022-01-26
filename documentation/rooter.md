# Utilisation du Rooter
## Intro
Ici, vous allez apprendre à utiliser le Rooter ainsi que nombreuses de ses fonctionnalités.

## Paramétrage
La méthode `setSiteName` permet de changer le nom du site (notamment le titre de la page).
Il peut être changer dynamiquement pour différentes parties du site.


## Création d'une page
### Intro
Un rooter permet de protéger le code source ainsi que de générer le même format de page sans se préoccuper des balises classiques (`<head>`, `<body>`, `<html>`, etc).
Par son utilisation, vous allez donc devoir coder seulement le `<body>` dans le fichier.

### Création du fichier
Le fichier devra être dans le dossier `/elements/` et il devra être composer du titre de la page, ex:
> Nom du fichier = `partenaires.php` 
>
> Titre de la page = `Partenaires`
>
> Lien vers la page = `/partenaires`

/!\ Merci d'utiliser que ces caractères : `abcdefghijklmnopqrstuvwxyz`

### Code dans ce fichier
Comme dit si dessous, vous allez devoir coder seulement ce qu'il se passe dans le `body`, ex:
> `<h1>TITRE TROP DRÔLE</h1>`
> 
> `<p>ceci est un paragraphe</p>`
> 
> `<script src='./app.js'></script>`

Sachez que tous les fichiers de configuration sont dans le dossier `/public/` et non dans `/elements/` (notamment pour le CSS, les IMG, les données à télécharger, ainsi que le JS).