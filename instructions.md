# Comment Initialiser ce projet pour pouvoir le lancer sur ma propre machine ?

## Prérequis :

Il faut avoir déjà avoir installé un serveur web local (sous Windows, vous pouvez utiliser *WampServer* par exemple), avec PHP et mariadb d'installés

## Déplacer le dossier dans le répertoire localhost

Il faudra ensuite copier/déplacer le dossier projet_nsi_2 dans votre dossier localhost

Vous pourrez ainsi acceder au site grâce à ce lien :

 - http://localhost/projet_nsi_2/ultra_note_premium/index.php

**La suite des opérations suivantes devront être effectuées depuis un accès à _mariadb_ depuis un _terminal_ ou depuis _phpMyAdmin_.**

## Création de la base de donnée :

Elle devra s'appeler "*ultranote*", et de préférence en encodage utf-8

```mariadb
CREATE DATABASE ultranote CHARACTER SET 'utf8';
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

Il faudra que vous importiez le fichier sql `init_tables.sql` dans la base de données `ultranote`, 
le fichier se trouve dans le sous répertoire `mariadb/`
Il faudra ensuite importer le fichier sql `rempli_tables.sql`


## Utilisation

Maintenant, le site est prêt.
Pour vous connecter,
vous pourrez regarder dans le fichier `comptes_base.md`
Il y a dedans des identifiants déjà prêts pour tester des trucs

