# Structure du projet

## Web :

- Quand on arrive sur le site, on est sur une page d’accueil, qui nous permet de nous connecter
(On pourra aussi se créer un compte, mais normalement, sur les sites scolaires, tous les comptes pour tous les étudiants sont déjà créés)

- Se connecter
    On ne change pas de page, mais une div apparait grâce à l'attribut `display:(none=caché, initial=visible)`
    => Requête PHP, avec un POST

- S'inscrire
    Pareil que pour se connecter,
    => Requête PHP, avec un POST

- Page d'accueil quand on est connecté 
    Elle n'est pas encore faite

Mais il y a plusieurs types de comptes : 

### Comptes Admin 

L'admin a acces a plusieurs pages pour l'instant :

 - La page Gestion Comptes, qui permet a l'utilisateur de gerer les comptes des utilisateurs de son lycée
 - La page Gestion Emploi du temps : Qui n'est pas encore faite
 - La page Gestion Etablissement Qui ne permet actuellement à l'admin que de créer/modifier/supprimer des groupes d'élèves

### Comptes Profs 

Le prof a acces a plusieurs pages pour l'instant :
 - La page Notes, qui n'est pas faite pour l'instant
 - La page Devoirs, qui permet au prof de pouvoir créer/modifier/supprimer des devoirs pour chacun des ses groupes d'élèves
  - La page Emploi du temps qui permet au prof de visualiser son emploi du temps

### Comptes Eleves

L'élève a acces a plusieurs pages pour l'instant :

- La page note : Pas encore faite 
- La page devoirs : L'élève peut voir les devoirs qu'il doit faire
- La page Emploi du temps : L'élève peut voir son emploi du temps 
 (Réflexion pour plus tard : Pour les modifications de l'emploi du temps, je créerai sans doute une table `edt_modifs` où il y aura les informations de modifications des différents cours)

### Comptes Parents

Ils n'ont pour l'instant accès à rien

### Tous les comptes

Tous les comptes auront tous acces à la page messagerie **(qui n'est pas encore faite)**,
qui, inspirée de discord, contiendra des salons, chaque utilisateur pourra créer un nouveau salon et y inviter les personnes qu'il veut (d'ailleur, un compte pourra aussi avoir des "amis", pour pouvoir discuter avec eux plus facilement). J'aimerai aussi plus tard, mettre en place un systeme de vocal, pour pouvoir faire des appels audio, et qui sait un jour, pourra aussi permettre le stream d'écran.



### Comptes Parents

Pas encore travaillé dessus



## SQL :

Il faut plusieurs bases de données pour tout structurer

### Compte :

TABLE `comptes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `type_` _TEXT_ : "*administrateur*", "*élève*", "*prof*" ou "*parent*"
 - `id_etablissement` _INT_ : Identifiant de l'établissement de l'élève
 - `pseudo` _TEXT_ : Le pseudo utilisé pour se connecter
 - `password_` _TEXT_ : Le mot de passe utilisé pour se connecter
 - `nom` _TEXT_ : Le nom de famille de l'élève
 - `prenom` _TEXT_ : Le prénom de l'élève
 - `naissance` _DATE_ : La date de naissance de la personne

TABLE `parents_enfants`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_compte` _INT_ : identifiant du compte
 - `id_enfant` _INT_ : identifiant du compte de l'enfant

TABLE `amis`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_compte` _INT_ : identifiant du compte
 - `id_ami` _INT_ : identifiant du compte ami

TABLE `devoirs_faits`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_compte` _INT_ : id du compte
 - `id_devoir` _INT_ : id du devoir

TABLE `abscences`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_compte` _INT_ : id du compte
 - `debut` _DATETIME_ : début de l'absence
 - `fin` _DATETIME_ : fin de l'absence

### Matière :

TABLE `matieres`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : l'identifiant unique de la matière
 - `nom` _TEXT_ : Nom de la matière
 - `couleur` _TEXT_ : code HEX de la couleur de la matière

TABLE `profs_matieres`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : l'identifiant unique de cette ligne
 - `id_prof` _INT_ : Identifiant du prof
 - `id_matiere` _INT_ : Identifiant de la matière

### Classe :

TABLE `classes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : Identifiant unique de la classe
 - `nom` _TEXT_ : Nom de la classe
 - `niveau` _TEXT_ : niveau de la classe "*seconde*", "*premiere*", "*terminale*"
 - `id_etablissement` _INT_ : id de établissement

TABLE `eleves_classes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_classe` _INT_ : id de la classe
 - `id_eleve` _INT_ : id de élève qui est dans la classe

TABLE `cours`:
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : Identifiant unique de la classe
 - `id_matiere` _INT_ : Identifiant de la matière
 - `id_prof` _INT_ : Identifiant du prof
 - `id_groupe` _INT_ : Identifiant du groupe
 - `jour` _INT_ : Jour de la semaine du cours (1-6)
 - `heure_debut` : Heure du début du cours (8h10-17h15)
 - `heure_fin` : Heure de la fin du cours (9h10-18h15)
 - `semaine`: Si toutes les semaines (0), si juste semaine A(1), si juste semaine B(2)

TABLE `groupes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : Identifiant unique de la classe
 - `nom` _TEXT_ : Nom de la classe
 - `niveau` _TEXT_ : niveau de la classe "*seconde*", "*premiere*", "*terminale*"
 - `id_etablissement` _INT_ : id de établissement

TABLE `eleves_groupes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_groupe` _INT_ : id du groupe
 - `id_eleve` _INT_ : id de l’élève qui est dans la classe

TABLE `profs_groupes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_prof` _INT_ : id du prof
 - `id_groupe` _INT_ : id du groupe que le prof a

### Note :

TABLE `notes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : identifiant unique de ce devoir
 - `id_matiere` _INT_ : Identifiant de la matière
 - `id_prof` _INT_ : Identifiant du prof
 - `id_groupe` _INT_ : Identifiant du groupe
 - `coef` _FLOAT_ : Coefficient de la note de ce devoir
 - `jour` _DATE_ : Jour de la mise de la note sur le site
 - `jour_visible` _DATE_ : Jour où les élèves pourront voir cette note
 - `trimestre` _INT_ : Trimestre de la note (1, 2, 3)
 - `titre` _TEXT_ : Titre/Nom de la note
 - `description_` _TEXT_ : Description de la note

TABLE `eleves_notes`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_note` _INT_ : id du devoir/note
 - `id_eleve` _INT_ : id de l’élève
 - `note` _FLOAT_ : note de l'élève
 - `appreciation` _TEXT_ : appréciation du professeur

### Devoir :

TABLE `devoirs`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : Identifiant unique du devoir
 - `id_prof` _INT_ : Identifiant du professeur qui a posté ce devoir
 - `id_groupe` _INT_ : Identifiant du groupe pour le devoir
 - `id_matiere` _INT_ : Identifiant de la matiere du devoir
 - `type_` _TEXT_ : Type du devoir "*lecon*", "*exercices*", "*ds*", "*dm*"
 - `titre` _TEXT_ : Titre du devoir
 - `description_` _TEXT_ : Description du devoir
 - `jour` _DATE_ : Jour où il faut faire ce devoir
 - `temps_evalue` _FLOAT_ : Temps que cela va prendre de faire le devoir (à peu près), NULL s'il n'y a pas.

TABLE `fichiers_devoirs`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_devoir` _INT_ : id du devoir
 - `id_fichier` _INT_ : id du fichier

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

TABLE `membres_etablissements`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_etablissement` _INT_ : id de l'établissement
 - `id_compte` _INT_ : id du compte

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
 - `salon` _INT_ : Identifiant du salon si ce message est envoyé dans un salon
 - `important` _BOOLEAN_ : si le message est important ou pas

TABLE `fichiers_messagerie`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_fichier` _INT_ : id du fichier
 - `id_message` _INT_ : id du message

TABLE `cibles_messages`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_message` _INT_ : id du message
 - `id_compte` _INT_ : id du compte
 - `vu` _BOOLEAN_ : si l'utilisateur a vu le message

### Salon de discussion :

TABLE `salons`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : l'identifiant unique du salon
 - `nom` _TEXT_ : Nom du salon

TABLE `membres_salon`
 - `id` *INT PRIMARY KEY AUTO_INCREMENT* : id unique de la ligne
 - `id_salon` _INT_ : id du salon
 - `id_compte` _INT_ : id du compte

### Cantine

TABLE `menu_cantine`
 - `id_salon` _INT_ : id du salon
 - `jour` _DATE_ : jour du menu
 - `menu` _TEXT_ : texte descriptif du menu
