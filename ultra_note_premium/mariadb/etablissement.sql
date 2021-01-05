
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

INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("aucune", "aucun", 1); --1
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TA", "terminale", 1); --2
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TB", "terminale", 1); --3

INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("aucun", "aucun", 1); --1
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("terminale TA", "terminale", 1); --2
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("terminale TB", "terminale", 1); --3

-- emplois du temps :

-- kleber :

INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("aucune", "aucun", 2); --4
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TA", "terminale", 2); --5
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TB", "terminale", 2); --6

INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("aucun", "aucun", 2); --4
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("terminale TA", "terminale", 2); --5
INSERT INTO groupes (nom, niveau, id_etablissement) VALUES ("terminale TB", "terminale", 2); --6

-- emplois du temps :


/*
 Professeurs
*/

-- poinca :

INSERT INTO comptes SET type_='prof', id_etablissement=1, nom='Torvalds' prenom='Linus' pseudo='linus.torvalds' password_='linustorvalds' naissance='1969-12-28'; --1
INSERT INTO profs_matieres SET id_prof=1 id_matiere=4;
INSERT INTO profs_groupes SET id_prof=1 id_groupe=2;
INSERT INTO comptes SET type_='prof', id_etablissement=1, nom='Descartes' prenom='René' pseudo='rene.descartes' password_='renedescartes' naissance='1596-03-31'; --2
INSERT INTO profs_matieres SET id_prof=2 id_matiere=1;
INSERT INTO profs_matieres SET id_prof=2 id_matiere=11;
INSERT INTO profs_groupes SET id_prof=2 id_groupe=2;
INSERT INTO profs_groupes SET id_prof=2 id_groupe=3;
INSERT INTO comptes SET type_='prof', id_etablissement=1, nom='Poincaré' prenom='Henri' pseudo='henri.poincare' password_='henripoincare' naissance='1854-04-29'; --3
INSERT INTO profs_matieres SET id_prof=3 id_matiere=1;
INSERT INTO profs_groupes SET id_prof=2 id_groupe=3;

-- kleber :

INSERT INTO comptes SET type_='prof', id_etablissement=2, nom='Enstein' prenom='Albert' pseudo='albert.einstein' password_='alberteinstein' naissance='1879-03-14'; --4INSERT INTO profs_matieres SET id_prof=4 id_matiere=1;
INSERT INTO profs_matieres SET id_prof=4 id_matiere=5;
INSERT INTO comptes SET type_='prof', id_etablissement=2, nom='Lovelace' prenom='Ada' pseudo='ada.lovelace' password_='adalovelace' naissance='1815-12-10'; --5
INSERT INTO profs_matieres SET id_prof=5 id_matiere=4;


/*

admins :

*/

-- poinca :

INSERT INTO comptes (type_, id_etablissement, pseudo, password_, nom, prenom, naissance)
       VALUES ("adminhp", 1, "adminhp", MD5("adminhp"), "Admin", "Poinca", "01-01-2001");

-- kleber

INSERT INTO comptes (type_, id_etablissement, pseudo, password_, nom, prenom, naissance)
       VALUES ("adminkl", 2, "adminkl", MD5("adminkl"), "Admin", "Kleber", "01-01-2001");

/*
ELEVES
*/

-- poinca



-- kleber