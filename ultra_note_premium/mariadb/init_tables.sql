
/*

CREATION DE TOUTES LES TABLES DU PROJET

*/

CREATE TABLE IF NOT EXISTS `comptes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                      type_ TEXT,
                                      etablissement INT,
                                      pseudo TEXT,
                                      password_ TEXT,
                                      nom TEXT,
                                      prenom TEXT,
                                      naissance DATE,
                                      classe INT);

CREATE TABLE IF NOT EXISTS `prof_classes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                           id_prof INT,
                                           id_classe INT);

CREATE TABLE IF NOT EXISTS `amis` (id INT PRIMARY KEY AUTO_INCREMENT,
                                   id_compte INT,
                                   id_ami INT);

CREATE TABLE IF NOT EXISTS `devoirs_faits` (id INT PRIMARY KEY AUTO_INCREMENT,
                                            id_compte INT,
                                            id_devoir INT);

CREATE TABLE IF NOT EXISTS `absences` (id INT PRIMARY KEY AUTO_INCREMENT,
                                       id_compte INT,
                                       debut DATETIME,
                                       fin DATETIME);

CREATE TABLE IF NOT EXISTS `matieres` (id INT PRIMARY KEY AUTO_INCREMENT,
                                       nom TEXT,
                                       couleur TEXT);

CREATE TABLE IF NOT EXISTS `profs_matieres` (id INT PRIMARY KEY AUTO_INCREMENT,
                                             id_prof INT,
                                             id_matiere INT);

CREATE TABLE IF NOT EXISTS `classes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                      nom TEXT,
                                      niveau TEXT);

CREATE TABLE IF NOT EXISTS `eleves_classe` (id INT PRIMARY KEY AUTO_INCREMENT,
                                            id_classe INT,
                                            id_eleve);

CREATE TABLE IF NOT EXISTS `notes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                    matiere iNT,
                                    id_prof INT,
                                    id_classe INT,
                                    coef FLOAT,
                                    jour DATE,
                                    jour_visible DATE,
                                    trimestre INT,
                                    titre TEXT,
                                    description_ TEXT);
                                    


