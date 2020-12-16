
/*

CREATION DE TOUTES LES TABLES DU PROJET

*/

CREATE TABLE IF NOT EXISTS `comptes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                      type_ TEXT,
                                      etablissement TEXT,
                                      pseudo TEXT,
                                      password_ TEXT,
                                      nom TEXT,
                                      prenom TEXT,
                                      classe TEXT,
                                      classes TEXT,
                                      matiere INT,
                                      profs TEXT,
                                      amis TEXT,
                                      devoirs_faits TEXT,
                                      absences TEXT);
CREATE TABLE IF NOT EXISTS `matieres` (id INT PRIMARY KEY AUTO_INCREMENT,
                                       nom TEXT,
                                       couleur TEXT);
CREATE TABLE IF NOT EXISTS `prof_matieres` (id INT PRIMARY KEY AUTO_INCREMENT,
                                       id_prof INT,
                                       id_matiere INT);
CREATE TABLE IF NOT EXISTS `classes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                      nom TEXT,
                                      niveau TEXT,
                                      eleves TEXT);
CREATE TABLE IF NOT EXISTS `notes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                    matiere INT,
                                    prof INT,
                                    classe INT,
                                    coef FLOAT,
                                    jour DATE,
                                    jour_visible DATE,
                                    trimestre INT,
                                    titre TEXT,
                                    description_ TEXT,
                                    notes TEXT);
CREATE TABLE IF NOT EXISTS `devoirs` (id INT PRIMARY KEY AUTO_INCREMENT,
                                      prof INT,
                                      type_ TEXT,
                                      titre TEXT,
                                      description_ TEXT,
                                      jour DATE,
                                      fichiers TEXT);
CREATE TABLE IF NOT EXISTS `etablissements` (id INT PRIMARY KEY AUTO_INCREMENT,
                                             nom TEXT,
                                             pays TEXT,
                                             region TEXT,
                                             ville TEXT,
                                             adresse TEXT,
                                             lien_maps TEXT,
                                             email TEXT,
                                             phone TEXT,
                                             academie TEXT,
                                             membres TEXT);
CREATE TABLE IF NOT EXISTS `fichiers` (id INT PRIMARY KEY AUTO_INCREMENT,
                                       nom TEXT,
                                       fichier MEDIUMBLOB);
CREATE TABLE IF NOT EXISTS `messages` (id INT PRIMARY KEY AUTO_INCREMENT,
                                       auteur INT,
                                       texte TEXT,
                                       salon INT,
                                       cible TEXT,
                                       important BOOLEAN,
                                       fichiers TEXT);
CREATE TABLE IF NOT EXISTS `salons` (id INT PRIMARY KEY AUTO_INCREMENT,
                                     nom TEXT,
                                     membres TEXT);
