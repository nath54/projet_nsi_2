
/*
 Etablissement
*/

INSERT INTO etablissements (nom, pays, region, ville, adresse, lien_maps, email, phone, academie)
       VALUES ("Lycée Henri Poincaré", "France", "Grand-Est", "Nancy", "2 Rue de la Visitation, 54000 Nancy", "https://www.google.fr/maps/place/2+Rue+de+la+Visitation,+54000+Nancy/@48.6910198,6.1775567,18z/data=!3m1!4b1!4m5!3m4!1s0x479498727bb0495b:0xb68f2f7a82969331!8m2!3d48.6909808!4d6.1781678",
               "ce.0540038@ac-nancy-metz.fr", "03 83 17 39 40", "Nancy-Metz");

/*
 Professeurs
*/

/*
 id_etablissement
*/

/*
 Classes
*/

INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("2A", "seconde", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("2B", "seconde", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("2C", "seconde", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("2D", "seconde", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("2E", "seconde", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("2F", "seconde", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("1A", "premiere", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("1B", "premiere", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("1C", "premiere", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("1D", "premiere", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("1E", "premiere", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TA", "terminale", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TB", "terminale", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TC", "terminale", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TD", "terminale", 1);
INSERT INTO classes (nom, niveau, id_etablissement) VALUES ("TE", "terminale", 1);

