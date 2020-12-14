# Structure du projet

## Web : 

==/!\ D'abord designer le site pour téléphone avant de l'adapter sur PC /!\==

- Quand on arrive sur le site, on est sur une page d'acceuil, qui nous permet de nous connecter
(On pourra aussi se créer un compte, mais normalement, sur les sites scolaires, tous les comptes pour tous les étudiants sont déjà créés)
Option pour rester connecter (on utilisera des cookies)

- Se connecter
    On ne change pas de page, mais une div apparait fluidement
    => Requete PHP, avec un POST

- S'inscrire
    Pareil que pour se connecter,
    => Requete PHP, avec un POST

- Page d'accueil quand on est connecté 
    Il faut une page d'accueil fluide, agréable
    Onglets : 
      - Notifications (nouveaux messages, nouvelles notes, )

    - Menu Notes
    - Menu Devoirs
    - Menu Messagerie

## SQL :

Il faut plusieurs bases de données pour tout structurer

### Compte :

TABLE `comptes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* :
 - `type_` _TEXT_ : "*administrateur*", "*eleve*", "*prof*" ou "*parent*"
 - `etablissement` _INT_ : Identifiant de l'établissement de l'élève
 - `pseudo` _TEXT_ : Le pseudo utilisé pour se connecter
 - `password_` _TEXT_ : Le mot de passe utilisé pour se connecter
 - `nom` _TEXT_ : Le nom de famille de l'élève
 - `prenom` _TEXT_ : Le prénom de l'élève
 - `naissance` _DATE_ : La date de naissance de la personne
 - `classe` _INT_ (juste pour *eleve*) : l'identifiant de la classe de l'élève (pour pouvoir faire des innerjoins ou des trucs du genre)
 - `classes` _TEXT_ (juste pour *prof*) : la liste des classes que le prof a, en format JSON
 - `profs` _TEXT_ (juste pour *eleve*) : La liste des id des comptes des profs de l'eleve par matères, en format JSON
 - `amis` _TEXT_ : La liste des id des comptes des amis de ce compte, en format JSON
 - `devoirs_faits` _TEXT_ : La liste des devoirs faits, en format JSON
 - `abscences` _TEXT_ : La liste des abscences déclarées de ce compte, en format JSON

### Matère :

TABLE `matieres`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : l'identifiant unique de la matière
 - `nom` _TEXT_ : Nom de la matière
 - `couleur` _TEXT_ : code HEX de la couleur de la matière

TABLE `prof_matieres`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : l'identifiant unique de cette ligne
 - `id_prof` _INT_ : Identifiant du prof
 - `id_matiere` _INT_ : Identifiant de la matiere

### Classe :

TABLE `classes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : Identifiant unique de la classe
 - `nom` _TEXT_ : Nom de la classe
 - `niveau` _TEXT_ : niveau de la classe "*seconde*", "*premiere*", "*terminale*"
 - `eleves` _TEXT_ : liste des id des comptes des élèves de cette classe, en format JSON

### Note :

TABLE `notes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : identifiant unique de ce devoir
 - `matiere` _INT_ : Identifiant de la matère
 - `prof` _INT_ : Identifiant du prof
 - `classe` _INT_ : Identifiant de la classe
 - `coef` _FLOAT_ : Coefficient de la note de ce devoir
 - `jour` _DATE_ : Jour de la mise de la note sur pronote
 - `jour_visible` _DATE_ : Jour où les élèves pourront voir cette note
 - `trimestre` _INT_ : Trimèstre de la note (1, 2, 3)
 - `titre` _TEXT_ : Titre/Nom de la note
 - `description_` _TEXT_ : Description de la note
 - `notes` _TEXT_ : Liste des notes par élèves, en format JSON

### Devoir :

TABLE `devoirs`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : Identifiant unique du devoir
 - `prof` _INT_ : Identifiant du professeur qui a posté ce devoir
 - `type_` _TEXT_ : Type du devoir "*lecon*", "*exercices*", "*ds*", "*dm*"
 - `titre` _TEXT_ : Titre du devoir
 - `description_` _TEXT_ : Description du devoir
 - `jour` _DATE_ : Jour où il faut faire ce devoir
 - `fichiers` _TEXT_ : Liste des identifiants des fichiers, sous format JSON

### Etablissement :

TABLE `etablissements`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : Identifiant unique de l'établissement
 - `nom` _TEXT_ : Nom de l'établissement
 - `pays` _TEXT_ : Pays de l'établissement
 - `region` _TEXT_ : Région de l'établissement
 - `ville` _TEXT_ : Ville de l'établissement
 - `adresse` _TEXT_ : Adresse de l'établissement
 - `lien_maps` _TEXT_ : Proposer un lien vers google maps directement
 - `email` _TEXT_ : adresse mail pour contacter l'établissement
 - `phone` _TEXT_ : numéro de téléphone pour contacter l'établissement
 - `academie` _TEXT_ : Nom de l'académie de l'établissement
 - `membres` _TEXT_ : Liste des id de touts les personnes qui y sont (élèves et professeurs), en format JSON

### Pièces jointes :

TABLE `fichiers`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : l'identifiant unique du fichier
 - `nom` _TEXT_ : Nom du fichier
 - `fichier` _BINARY_ : fichier

### Messagerie :

TABLE `messages`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : l'identifiant unique du message
 - `auteur` _INT_ : identifiant du compte qui a écrit le message
 - `texte` _TEXT_ : Message envoyé
 - `salon` _ID_ : Identifiant du salon si ce message est envoyé dans un salon
 - `cible` _TEXT_ : liste des identifiants des comptes auquels le message a été envoyé, en format JSON
 - `important` _BOOLEAN_ : si le message est important ou pas
 - `fichiers` _TEXT_ : Liste des identifiants des fichiers, sous format JSON

### Salon de discussion :

TABLE `salons`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : l'identifiant unique du salon
 - `nom` _TEXT_ : Nom du salon
 - `membres` _TEXT_ : Membres du salon, avec leurs roles
