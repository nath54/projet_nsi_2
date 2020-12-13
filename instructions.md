# Comment Initialiser ce projet pour pouvoir le lancer sur ma propre machine ?

## Prérequis :

Il faut avoir déjà avoir installé un serveur web local (sous Windows, vous pouvez utiliser *WampServer* par exemple), avec PHP et mariadb d'installés

**La suite des opérations suivantes devront être effectuées depuis un accès à _mariadb_ depuis un _terminal_ ou depuis _phpMyAdmin_.**

## Création de la base de donnée :

Elle devra s'appeler "*ultranote*", et de préférence en encodage utf-8

```mariadb
CREATE DATABASE projet_nsi_1 CHARACTER SET 'utf8';
```

## Création de l'utilisateur :

Il faut donc ensuite créer un utilisateur pour que le site puisse accéder à sa base de donnée

- Création de l'utilisateur :

```mariadb
CREATE USER ultranote@localhost IDENTIFIED BY "muimerp++etonartlu";
```

- On lui accorde les droits pour qu'il ait accès à la base de donnée :

```mariadb
GRANT ALL PRIVILEGES ON ultranote.* TO ultranote@localhost;
```

## Initialisation de la base de donnée :

2 possibilités s'offrent à vous :

### 1ere possibilité (recommandée) : Importer le fichier SQL de la base de donnée



