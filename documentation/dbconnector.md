# DBConnector
## Intro
Ici, vous allez apprendre à utiliser la classe DBConnector pour la gestion des bases de donnée

## Paramétrage
Pour que la classe fonctionne, il faut que vous possédiez une base de donnée accessible, des identifiants valables.

## Méthodes
### Constructeur
Il a besoin des informations de connexion dans cet ordre là :
> Type de base de donnée (mysql, oracle, etc) _/!\ NE FONCTIONNE PAS AVEC LES FICHIERS (comme SQLite)_
> 
> IP de la base de donnée (localhost, 127.0.0.1, etc)
> 
> Port de la base de donnée (8123, 25565, etc)
> 
> Nom de la base de donnée (article, test, etc)
 
### connect
Méthode servant à se connecter à la base de donnée

Prend 2 paramètres :
> Utilisateur de la base de donnée (root, anhgelus, etc)
> 
> Mot de passe de l'utilisateur (pas besoin d'exemple mdr)

### getInformations
Méthode permettant de récupérer des informations dans la base de donnée

Prend 3 paramètres :
> Le selecteur (*, title, etc)
> 
> La table dans laquelle vous cherchez les informations (news, test, etc)
> 
> Autres informations en SQL (limite, ordre de trie, etc)

### putInformations
Méthode permettant d'envoyer et de stocker des informations dans la base de donnée

Prend 3 paramètres :
> Les données à envoyer (sous forme de tableau), première valeur doit obligatoirement être les noms des champs visés de la table visée, ex:
> > [
>   'titre_de_la_valeur' => 'Contenu de cette valeur', 'et'=>'ainsi de suite'
> ]
> 
> Liste des valeurs demandées (sous forme de tableau), doit obligatoirement être les noms des champs visés de la table visée, ex:
> > [
> 'title', 'content' 
> ]
> 
> Nom de la table dans laquelle vous souhaitez mettre des informations

### delInformations
Méthode permettant de supprimer des informations dans la base de donnée

Prend entre 2 et 5 paramètres :
> Le type (0 ou 1) : (OBLIGATOIRE)
> > 0 = tout supprimer ; 1 = chercher quelle valeur supprimée
> 
> Nom de la table dans laquelle vous souhaitez supprimer des informations (OBLIGATOIRE)
> 
> Signe de l'opération [valeur par défaut = "="] (que pour TYPE = 1)
> > "=" = cherchez une valeur identique ; ">" = cherchez une valeur supérieur ; "<" = cherchez une valeur inférieur ; "<=" = cherchez une valeur inférieur ou égale ; ">=" = cherchez une valeur supérieur ou égale
> 
> Zone dans laquelle chercher [valeur par défaut = "id"] (que pour TYPE = 1)
> > "id" = cherchez la valeur dans la colonne id
> 
> Valeur rechercher [aucune valeur par défaut] (que pour TYPE = 1)
> > "5" = recherchez toutes les valeurs en fonction de 5 suivant le signe et la colonne
> 
> EXEMPLE :
> > ->delInformations(1, "news", "=", "id", "5") = supprime dans la table "news" toutes les lignes ayant pour "id" = 5
