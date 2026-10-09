CREATE DATABASE IF NOT EXISTS ani_manga CHARSET utf8mb4;
USE ani_manga;

-- Structure générale -------------------------------------

CREATE TABLE IF NOT EXISTS support(
	id_support INT PRIMARY KEY AUTO_INCREMENT,
    nom_support VARCHAR(10) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS statut(
	id_statut INT PRIMARY KEY AUTO_INCREMENT,
    nom_statut VARCHAR(20) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS classification(
	id_classification INT PRIMARY KEY AUTO_INCREMENT,
    nom_classification VARCHAR(10) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS genre(
	id_genre INT PRIMARY KEY AUTO_INCREMENT,
    nom_genre VARCHAR(50) NOT NULL UNIQUE,
    image_genre VARCHAR(255) NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS theme(
	id_theme INT PRIMARY KEY AUTO_INCREMENT,
    nom_theme VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS type_anime(
	id_type_anime INT PRIMARY KEY AUTO_INCREMENT,
    nom_type_anime VARCHAR(10) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS annee(
	id_annee INT PRIMARY KEY AUTO_INCREMENT,
    valeur_annee INT NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS pays(
	id_pays INT PRIMARY KEY AUTO_INCREMENT,
    nom_pays VARCHAR(60) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS arc(
	id_arc INT PRIMARY KEY AUTO_INCREMENT,
    nom_arc VARCHAR(100) NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS tomes(
	id_tomes INT PRIMARY KEY AUTO_INCREMENT,
    image_tomes VARCHAR(255) NOT NULL,
    synopsis_tomes TEXT,
    id_manga INT NOT NULL,
    id_arc INT
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS saison_parution(
	id_saison_parution INT PRIMARY KEY AUTO_INCREMENT,
    nom_saison_parution VARCHAR(20) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS saisons(
	id_saisons INT PRIMARY KEY AUTO_INCREMENT,
    nom_saisons VARCHAR(50) NOT NULL,
    image_saisons VARCHAR(255) NOT NULL,
    synopsis_saisons TEXT,
    episodes_saisons INT,
    id_anime INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS autor(
	id_autor INT PRIMARY KEY AUTO_INCREMENT,
    nom_autor VARCHAR(50) NOT NULL,
    image_autor VARCHAR(255),
    historique_autor TEXT,
    id_type_autor INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS type_autor(
	id_type_autor INT PRIMARY KEY AUTO_INCREMENT,
    nom_type_autor VARCHAR(20) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS manga(
	id_manga INT PRIMARY KEY AUTO_INCREMENT,
    nom_manga VARCHAR(255) NOT NULL UNIQUE,
    titre_manga VARCHAR(255) NOT NULL,
    titre_original_manga VARCHAR(255) NOT NULL,
    titres_alternatifs_manga VARCHAR(255),
    date_maj_manga DATE NOT NULL,
    tomes_vf_manga INT,
    tomes_vo_manga INT NOT NULL,
    image_manga VARCHAR(255) NOT NULL,
    arriere_plan_manga VARCHAR(255) NOT NULL,
    synopsis_manga TEXT,
    id_pays INT NOT NULL,
    id_annee_vf INT,
    id_annee_vo INT NOT NULL,
    id_statut_vf INT NOT NULL,
    id_statut_vo INT NOT NULL,
    id_support INT NOT NULL,
    id_classification INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS anime(
	id_anime INT PRIMARY KEY AUTO_INCREMENT,
    nom_anime VARCHAR(255) NOT NULL UNIQUE,
    titre_anime VARCHAR(255) NOT NULL,
    titre_original_anime VARCHAR(255) NOT NULL,
    titres_alternatifs_anime VARCHAR(255),
    date_maj_anime DATE NOT NULL,
    saisons_anime INT,
    episodes_anime INT NOT NULL,
    image_anime VARCHAR(255) NOT NULL,
    arriere_plan_anime VARCHAR(255) NOT NULL,
    synopsis_anime TEXT,
    id_annee INT NOT NULL,
    id_saison_parution INT NOT NULL,
    id_statut INT NOT NULL,
    id_support INT NOT NULL,
    id_classification INT NOT NULL,
    id_type_anime INT NOT NULL
)ENGINE=innodb;

-- Tables d'association ------------------------------------------------

CREATE TABLE IF NOT EXISTS theme_manga(
	id_theme INT NOT NULL,
    id_manga INT NOT NULL,
    CONSTRAINT fk_theme_manga_theme FOREIGN KEY (id_theme) REFERENCES theme(id_theme) ON DELETE CASCADE,
    CONSTRAINT fk_theme_manga_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS theme_anime(
	id_theme INT NOT NULL,
    id_anime INT NOT NULL,
    CONSTRAINT fk_theme_anime_theme FOREIGN KEY (id_theme) REFERENCES theme(id_theme) ON DELETE CASCADE,
    CONSTRAINT fk_theme_anime_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS genre_manga(
	id_genre INT NOT NULL,
    id_manga INT NOT NULL,
    CONSTRAINT fk_genre_manga_genre FOREIGN KEY (id_genre) REFERENCES genre(id_genre) ON DELETE CASCADE,
    CONSTRAINT fk_genre_manga_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS genre_anime(
	id_genre INT NOT NULL,
    id_anime INT NOT NULL,
    CONSTRAINT fk_genre_anime_genre FOREIGN KEY (id_genre) REFERENCES genre(id_genre) ON DELETE CASCADE,
    CONSTRAINT fk_genre_anime_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS autor_manga(
	id_autor INT NOT NULL,
    id_manga INT NOT NULL,
    CONSTRAINT fk_autor_manga_autor FOREIGN KEY (id_autor) REFERENCES autor(id_autor) ON DELETE CASCADE,
    CONSTRAINT fk_autor_manga_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS autor_anime(
	id_autor INT NOT NULL,
    id_anime INT NOT NULL,
    CONSTRAINT fk_autor_anime_autor FOREIGN KEY (id_autor) REFERENCES autor(id_autor) ON DELETE CASCADE,
    CONSTRAINT fk_autor_anime_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS manga_manga(
	id_manga_preneur INT,
    id_manga_donneur INT,
    CONSTRAINT fk_manga_manga_preneur FOREIGN KEY (id_manga_preneur) REFERENCES manga(id_manga),
    CONSTRAINT fk_manga_manga_donneur FOREIGN KEY (id_manga_donneur) REFERENCES manga(id_manga)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS manga_anime(
	id_manga INT,
    id_anime INT,
    CONSTRAINT fk_manga_anime_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga),
    CONSTRAINT fk_manga_anime_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS anime_anime(
	id_anime_preneur INT,
    id_anime_donneur INT,
    CONSTRAINT fk_anime_anime_preneur FOREIGN KEY (id_anime_preneur) REFERENCES anime(id_anime),
    CONSTRAINT fk_anime_anime_donneur FOREIGN KEY (id_anime_donneur) REFERENCES anime(id_anime)
)ENGINE=innodb;

-- Clés étrangères --------------------------------------------------------------------

ALTER TABLE tomes
	ADD CONSTRAINT fk_tomes_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
	ADD CONSTRAINT fk_tomes_arc FOREIGN KEY (id_arc) REFERENCES arc(id_arc);
    
ALTER TABLE saisons
	ADD CONSTRAINT fk_saisons_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE;
    
ALTER TABLE manga
	ADD CONSTRAINT fk_manga_pays FOREIGN KEY (id_pays) REFERENCES pays(id_pays) ON DELETE CASCADE,
	ADD CONSTRAINT fk_manga_annee_vf FOREIGN KEY (id_annee_vf) REFERENCES annee(id_annee),
	ADD CONSTRAINT fk_manga_annee_vo FOREIGN KEY (id_annee_vo) REFERENCES annee(id_annee) ON DELETE CASCADE,
	ADD CONSTRAINT fk_manga_statut_vf FOREIGN KEY (id_statut_vf) REFERENCES statut(id_statut) ON DELETE CASCADE,
	ADD CONSTRAINT fk_manga_statut_vo FOREIGN KEY (id_statut_vo) REFERENCES statut(id_statut) ON DELETE CASCADE,
	ADD CONSTRAINT fk_manga_support FOREIGN KEY (id_support) REFERENCES support(id_support) ON DELETE CASCADE,
	ADD CONSTRAINT fk_manga_classification FOREIGN KEY (id_classification) REFERENCES classification(id_classification) ON DELETE CASCADE;
    
ALTER TABLE anime
	ADD CONSTRAINT fk_anime_saison_parution FOREIGN KEY (id_saison_parution) REFERENCES saison_parution(id_saison_parution) ON DELETE CASCADE,
	ADD CONSTRAINT fk_anime_annee FOREIGN KEY (id_annee) REFERENCES annee(id_annee) ON DELETE CASCADE,
	ADD CONSTRAINT fk_anime_statut FOREIGN KEY (id_statut) REFERENCES statut(id_statut) ON DELETE CASCADE,
	ADD CONSTRAINT fk_anime_support FOREIGN KEY (id_support) REFERENCES support(id_support) ON DELETE CASCADE,
	ADD CONSTRAINT fk_anime_classification FOREIGN KEY (id_classification) REFERENCES classification(id_classification) ON DELETE CASCADE;
	ADD CONSTRAINT fk_anime_type FOREIGN KEY (id_type_anime) REFERENCES type_anime(id_type_anime) ON DELETE CASCADE;