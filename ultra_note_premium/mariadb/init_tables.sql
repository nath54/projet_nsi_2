
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
                                            id_eleve INT);

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


CREATE TABLE IF NOT EXISTS `eleves_notes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                           id_note INT,
                                           id_eleve INT,
                                           note FLOAT,
                                           appreciation TEXT);


CREATE TABLE IF NOT EXISTS `devoirs` (id INT PRIMARY KEY AUTO_INCREMENT,
                                      id_prof INT,
                                      id_classe INT,
                                      type_ TEXT,
                                      titre TEXT,
                                      description_ TEXT,
                                      jour DATE);


CREATE TABLE IF NOT EXISTS `fichiers_devoirs` (id INT PRIMARY KEY AUTO_INCREMENT,
                                               id_devoir INT,
                                               id_fichier INT);


CREATE TABLE IF NOT EXISTS `etablissements` (id INT PRIMARY KEY AUTO_INCREMENT,
                                             nom TEXT,
                                             pays TEXT,
                                             region TEXT,
                                             ville TEXT,
                                             adresse TEXT,
                                             lien_maps TEXT,
                                             email TEXT,
                                             phone TEXT,
                                             academie TEXT);

CREATE TABLE IF NOT EXISTS `membres_etablissements` (id INT PRIMARY KEY AUTO_INCREMENT,
                                                     id_etablissement INT,
                                                     id_compte INT);


CREATE TABLE IF NOT EXISTS `fichiers` (id INT PRIMARY KEY AUTO_INCREMENT,
                                       nom TEXT,
                                       fichier BINARY);


CREATE TABLE IF NOT EXISTS `messages` (id INT PRIMARY KEY AUTO_INCREMENT,
                                       auteur INT,
                                       texte TEXT,
                                       salon INT,
                                       important BOOLEAN);


CREATE TABLE IF NOT EXISTS `fichiers_messagerie` (id INT PRIMARY KEY AUTO_INCREMENT,
                                                  id_fichier INT,
                                                  id_message INT);


CREATE TABLE IF NOT EXISTS `cibles_messages` (id INT PRIMARY KEY AUTO_INCREMENT,
                                              id_message INT,
                                              id_compte INT,
                                              vu BOOLEAN);


CREATE TABLE IF NOT EXISTS `salons` (id INT PRIMARY KEY AUTO_INCREMENT,
                                     nom TEXT);

CREATE TABLE IF NOT EXISTS `membres salons` (id INT PRIMARY KEY AUTO_INCREMENT,
                                             id_salon INT,
                                             id_compte INT);

CREATE TABLE IF NOT EXISTS `menu_cantine` (id INT PRIMARY KEY AUTO_INCREMENT,
                                           jour DATE,
                                           menu TEXT);


