

-- Ajout de toutes les matières dans la base de données

INSERT INTO matieres (nom, couleur) VALUES ("Mathématiques", "#bd0404"); -- 1
INSERT INTO matieres (nom, couleur) VALUES ("Mathématiques Expertes", "#ff0000"); -- 2
INSERT INTO matieres (nom, couleur) VALUES ("Mathématiques Complémentaires", "#ff3636"); -- 3
INSERT INTO matieres (nom, couleur) VALUES ("NSI", "#0b4685"); -- 4
INSERT INTO matieres (nom, couleur) VALUES ("Physique-Chimie", "#2fccb2"); -- 5
INSERT INTO matieres (nom, couleur) VALUES ("SVT", "#0cfa7f"); -- 6
INSERT INTO matieres (nom, couleur) VALUES ("Histoire-Géo", "#fabe0c"); -- 7
INSERT INTO matieres (nom, couleur) VALUES ("Spé Géopo", "#fae034"); -- 8
INSERT INTO matieres (nom, couleur) VALUES ("SVT", "#0cfa7f"); -- 9
INSERT INTO matieres (nom, couleur) VALUES ("Francais", "#00b7ff"); -- 10
INSERT INTO matieres (nom, couleur) VALUES ("Philosophie", "#080bbd"); -- 11
INSERT INTO matieres (nom, couleur) VALUES ("Anglais", "#5ea7db"); -- 12
INSERT INTO matieres (nom, couleur) VALUES ("Spé Anglais", "#5e92b8"); -- 13
INSERT INTO matieres (nom, couleur) VALUES ("Espagnol", "#ffe100"); -- 14
INSERT INTO matieres (nom, couleur) VALUES ("Allemand", "#821032"); -- 15
INSERT INTO matieres (nom, couleur) VALUES ("ES-physique", "#609c8f"); -- 16
INSERT INTO matieres (nom, couleur) VALUES ("ES-SVT", "#609c81"); -- 17
INSERT INTO matieres (nom, couleur) VALUES ("EPS", "#d6baf5"); -- 18
INSERT INTO matieres (nom, couleur) VALUES ("Histoire des Arts", "#f2821f"); -- 19
INSERT INTO matieres (nom, couleur) VALUES ("Musique", "#aff21f"); -- 20
INSERT INTO matieres (nom, couleur) VALUES ("Grec", "#055eb0"); -- 21
INSERT INTO matieres (nom, couleur) VALUES ("Latin", "#e0bb96"); -- 22
INSERT INTO matieres (nom, couleur) VALUES ("Hébreux", "#f4ba7e"); -- 23
INSERT INTO matieres (nom, couleur) VALUES ("", "#ffffff"); -- 24



/*
 Etablissement
*/

INSERT INTO etablissements (nom, pays, region, ville, adresse, lien_maps, email, phone, academie)
       VALUES ("Lycée Henri Poincaré", "France", "Grand-Est", "Nancy", "2 Rue de la Visitation, 54000 Nancy", "https://www.google.fr/maps/place/2+Rue+de+la+Visitation,+54000+Nancy/@48.6910198,6.1775567,18z/data=!3m1!4b1!4m5!3m4!1s0x479498727bb0495b:0xb68f2f7a82969331!8m2!3d48.6909808!4d6.1781678",
               "ce.0540038@ac-nancy-metz.fr", "03 83 17 39 40", "Nancy-Metz");


INSERT INTO etablissements (nom, pays, region, ville, adresse, lien_maps, email, phone, academie)
       VALUES ("Lycée Kléber", "France", "Grand-Est", "Strasbourg", "25 Place de Bordeaux, 67000 Strasbourg", "https://www.google.com/maps/place/LYC%C3%89E+KL%C3%89BER/@48.5943358,7.7566346,17z/data=!4m5!3m4!1s0x4796c85c6c68f257:0xe371bea3a2a57f13!8m2!3d48.5942152!4d7.7565702",
               "ce.0670080Y@ac-strasbourg.fr", "03 88 14 31 00", "Strasbourg");


/*
 Classes
*/

-- poinca :

INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("aucune", "aucun", 1); /*1*/
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TA", "terminale", 1); /*2*/
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TB", "terminale", 1); /*3*/

INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("aucun", "aucun", 1); /*1*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("terminale TA", "terminale", 1); /*2*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("terminale TB", "terminale", 1); /*3*/

-- kleber :

INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("aucune", "aucun", 2); /*4*/
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TA", "terminale", 2); /*5*/
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TB", "terminale", 2); /*6*/

INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("aucun", "aucun", 2); /*4*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("terminale TA", "terminale", 2); /*5*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("terminale TB", "terminale", 2); /*6*/

-- GROUPES

INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("NSI", "terminale", 1); /*7*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("MATH grp1", "terminale", 1); /*8*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("Physique-Chimie", "terminale", 1); /*9*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("MATH grp2", "terminale", 1); /*10*/

INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("NSI", "terminale", 2); /*11*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("MATH", "terminale", 2); /*12*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("Physique-Chimie", "terminale", 2); /*13*/
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("MATH grp2", "terminale", 2); /*14*/

-- emplois du temps :

-- INSERT INTO cours SET id_matiere=

-- emplois du temps :


/*
 Professeurs
*/

-- poinca :

INSERT INTO comptes SET type_='prof', id_etablissement=1, nom='Torvalds', prenom='Linus', pseudo='linus.torvalds', password_='linustorvalds', naissance='1969-12-28'; /*1*/
INSERT INTO profs_matieres SET id_prof=1, id_matiere=4;
INSERT INTO profs_groupes SET id_prof=1, id_groupe=2;
INSERT INTO comptes SET type_='prof', id_etablissement=1, nom='Descartes', prenom='René', pseudo='rene.descartes', password_='renedescartes', naissance='1596-03-31'; /*2*/
INSERT INTO profs_matieres SET id_prof=2, id_matiere=1;
INSERT INTO profs_matieres SET id_prof=2, id_matiere=11;
INSERT INTO profs_groupes SET id_prof=2, id_groupe=2;
INSERT INTO profs_groupes SET id_prof=2, id_groupe=3;
INSERT INTO comptes SET type_='prof', id_etablissement=1, nom='Poincaré', prenom='Henri', pseudo='henri.poincare', password_='henripoincare', naissance='1854-04-29'; /*3*/
INSERT INTO profs_matieres SET id_prof=3, id_matiere=1;
INSERT INTO profs_groupes SET id_prof=3, id_groupe=3;

-- kleber :

INSERT INTO comptes SET type_='prof', id_etablissement=2, nom='Enstein', prenom='Albert', pseudo='albert.einstein', password_='alberteinstein', naissance='1879-03-14'; /*4*/
INSERT INTO profs_matieres SET id_prof=4, id_matiere=1;
INSERT INTO profs_matieres SET id_prof=4, id_matiere=5;
INSERT INTO comptes SET type_='prof', id_etablissement=2, nom='Lovelace', prenom='Ada', pseudo='ada.lovelace', password_='adalovelace', naissance='1815-12-10'; /*5*/
INSERT INTO profs_matieres SET id_prof=5, id_matiere=4;


/*

admins :

*/

-- poinca :

INSERT INTO comptes (type_, id_etablissement, pseudo, password_, nom, prenom, naissance) /*6*/
       VALUES ("admin", 1, "adminhp", MD5("adminhp"), "Admin", "Poinca", "01-01-2001");

-- kleber

INSERT INTO comptes (type_, id_etablissement, pseudo, password_, nom, prenom, naissance) /*7*/
       VALUES ("admin", 2, "adminkl", MD5("adminkl"), "Admin", "Kleber", "01-01-2001");

/*
ELEVES
*/

-- poinca

INSERT INTO comptes SET type_="eleve", id_etablissement=1, nom="GHOTN", prenom="Fred", pseudo="fred.ghotn", password_="fredghotn", naissance="2003-05-12"; /*8*/
INSERT INTO eleves_classes SET id_eleve=8, id_classe=2;
INSERT INTO eleves_groupes SET id_eleve=8, id_groupe=2;
INSERT INTO eleves_groupes SET id_eleve=8, id_groupe=7;
INSERT INTO eleves_groupes SET id_eleve=8, id_groupe=8;

INSERT INTO comptes SET type_="eleve", id_etablissement=1, nom="PICHUN", prenom="Michelle", pseudo="michelle.pichun", password_="michellepichun", naissance="2003-02-21"; /*9*/
INSERT INTO eleves_classes SET id_eleve=9, id_classe=2;
INSERT INTO eleves_groupes SET id_eleve=9, id_groupe=2;
INSERT INTO eleves_groupes SET id_eleve=9, id_groupe=7;
INSERT INTO eleves_groupes SET id_eleve=9, id_groupe=9;

INSERT INTO comptes SET type_="eleve", id_etablissement=1, nom="CARASE", prenom="Pierre", pseudo="pierre.carase", password_="pierrecarase", naissance="2003-11-09"; /*10*/
INSERT INTO eleves_classes SET id_eleve=10, id_classe=2;
INSERT INTO eleves_groupes SET id_eleve=10, id_groupe=2;
INSERT INTO eleves_groupes SET id_eleve=10, id_groupe=7;
INSERT INTO eleves_groupes SET id_eleve=10, id_groupe=8;

INSERT INTO comptes SET type_="eleve", id_etablissement=1, nom="GODON", prenom="Lilou", pseudo="lilou.godon", password_="lilougodon", naissance="2003-01-01"; /*11*/
INSERT INTO eleves_classes SET id_eleve=11, id_classe=2;
INSERT INTO eleves_groupes SET id_eleve=11, id_groupe=2;
INSERT INTO eleves_groupes SET id_eleve=11, id_groupe=7;
INSERT INTO eleves_groupes SET id_eleve=11, id_groupe=9;

INSERT INTO comptes SET type_="eleve", id_etablissement=1, nom="DESSA", prenom="Didier", pseudo="didier.dessa", password_="didierdessa", naissance="2003-08-09"; /*12*/
INSERT INTO eleves_classes SET id_eleve=12, id_classe=2;
INSERT INTO eleves_groupes SET id_eleve=12, id_groupe=2;
INSERT INTO eleves_groupes SET id_eleve=12, id_groupe=7;
INSERT INTO eleves_groupes SET id_eleve=12, id_groupe=9;

-- kleber

