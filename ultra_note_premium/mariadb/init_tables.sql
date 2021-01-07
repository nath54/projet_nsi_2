
/*

CREATION DE TOUTES LES TABLES DU PROJET

*/

CREATE TABLE IF NOT EXISTS `comptes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                      type_ TEXT,
                                      id_etablissement INT,
                                      pseudo TEXT,
                                      password_ TEXT,
                                      nom TEXT,
                                      prenom TEXT,
                                      naissance DATE);

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
                                      niveau TEXT,
                                      id_etablissement INT);

CREATE TABLE IF NOT EXISTS `eleves_classes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                             id_classe INT,
                                             id_eleve INT);

-- CREATE TABLE IF NOT EXISTS `profs_classes` (id INT PRIMARY KEY AUTO_INCREMENT,
--                                            id_prof INT,
--                                            id_classe INT);


CREATE TABLE IF NOT EXISTS `groupes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                      nom TEXT,
                                      niveau TEXT,
                                      id_etablissement INT);

CREATE TABLE IF NOT EXISTS `eleves_groupes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                             id_groupe INT,
                                             id_eleve INT);

CREATE TABLE IF NOT EXISTS `profs_groupes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                           id_prof INT,
                                           id_groupe INT);

CREATE TABLE IF NOT EXISTS `notes` (id INT PRIMARY KEY AUTO_INCREMENT,
                                    id_matiere iNT,
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
                                      id_groupe INT,
                                      id_matiere INT,
                                      type_ TEXT,
                                      titre TEXT,
                                      description_ TEXT,
                                      jour DATE,
                                      temps_evalue INT DEFAULT NULL);


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
                                       id_auteur INT,
                                       texte TEXT,
                                       id_salon INT,
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

CREATE TABLE IF NOT EXISTS `membres_salons` (id INT PRIMARY KEY AUTO_INCREMENT,
                                             id_salon INT,
                                             id_compte INT);

CREATE TABLE IF NOT EXISTS `menu_cantine` (id INT PRIMARY KEY AUTO_INCREMENT,
                                           jour DATE,
                                           menu TEXT);


