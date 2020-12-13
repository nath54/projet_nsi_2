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

 - Type : *"eleve"* ou *"prof"*
 - Nom : *str*
 - Prénom : *str*
 - Classe (si élève) : *Id de la classe*
 - Classes (si prof) : *liste de toutes les classes qu'il a*
 - Matière (si prof) : *Matière du prof*
 - Liste profs (si élève) : *Liste de tous les profs qu'il a*

### Classe :
 
 - Nom de la classe
 - Niveau 
 - Liste des élèves *(par clés)*

### Devoir :
 
 - Matière : *str*
 - Prof : *id prof*
 - Classe : *id classe*
 - Coefficient : *float*
 - Date : *Date*
 - Trimèstre : *int* (1, 2, 3)
 - Notes :
   - *Id élève*, *valeur*

### Etablissement :

 - Nom de l'établissement : *Nom de l'établissement*
 - Adresse : *Adresse de l'établissement*
 - Lien maps : *Proposer un lien vers google maps directement*
 - Mail : *adresse mail pour contacter l'établissement*
 - Phone : *numéro de téléphone pour contacter l'établissement*
 - Académie : *Nom de l'académie de l'établissement*
 - Membres : *Liste des id de touts les personnes qui y sont (élèves et professeurs)*

