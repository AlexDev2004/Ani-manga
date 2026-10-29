CREATE DATABASE IF NOT EXISTS ani_manga CHARSET utf8mb4;
USE ani_manga;

-- Structure générale -------------------------------------
CREATE TABLE IF NOT EXISTS compte(
	id_compte INT PRIMARY KEY AUTO_INCREMENT,
    email_compte VARCHAR(100) NOT NULL UNIQUE,
    mdp_compte VARCHAR(100) NOT NULL,
    date_creation_compte DATETIME NOT NULL DEFAULT (CURRENT_TIMESTAMP)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS support(
	id_support INT PRIMARY KEY AUTO_INCREMENT,
    nom_support VARCHAR(20) NOT NULL UNIQUE
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

CREATE TABLE IF NOT EXISTS pays(
	id_pays INT PRIMARY KEY AUTO_INCREMENT,
    nom_pays VARCHAR(60) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS arc(
	id_arc INT PRIMARY KEY AUTO_INCREMENT,
    nom_arc VARCHAR(100) NOT NULL,
    numero_arc INT NOT NULL,
    id_manga INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS tomes(
	id_tomes INT PRIMARY KEY AUTO_INCREMENT,
    image_tomes VARCHAR(255) NOT NULL,
    synopsis_tomes TEXT,
    numero_tomes INT NOT NULL,
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
    episodes_saisons INT NOT NULL,
    numero_saisons INT NOT NULL,
    id_anime INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS autor(
	id_autor INT PRIMARY KEY AUTO_INCREMENT,
    nom_autor VARCHAR(50) NOT NULL,
    image_autor VARCHAR(255),
    historique_autor TEXT,
    lien_autor VARCHAR(255) NOT NULL,
    id_type_autor INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS type_autor(
	id_type_autor INT PRIMARY KEY AUTO_INCREMENT,
    nom_type_autor VARCHAR(20) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS type_relation(
	id_type_relation INT PRIMARY KEY AUTO_INCREMENT,
    nom_type_relation VARCHAR(20) NOT NULL UNIQUE
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS type_liste(
	id_type_liste INT PRIMARY KEY AUTO_INCREMENT,
    nom_type_liste VARCHAR(20) NOT NULL UNIQUE
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
    annee_vf_manga INT,
    annee_vo_manga INT NOT NULL,
    image_manga VARCHAR(255) NOT NULL,
    arriere_plan_manga VARCHAR(255) NOT NULL,
    synopsis_manga TEXT,
    id_pays INT NOT NULL,
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
	annee_anime INT NOT NULL,
    image_anime VARCHAR(255) NOT NULL,
    arriere_plan_anime VARCHAR(255) NOT NULL,
    synopsis_anime TEXT,
    id_saison_parution INT NOT NULL,
    id_statut INT NOT NULL,
    id_support INT NOT NULL,
    id_classification INT NOT NULL,
    id_type_anime INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS annexe (
	id_annexe INT PRIMARY KEY AUTO_INCREMENT,
    nom_annexe VARCHAR(255) NOT NULL,
    image_annexe VARCHAR(255) NOT NULL,
    lien_annexe VARCHAR(255) NOT NULL,
    id_type_annexe INT NOT NULL
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS type_annexe (
	id_type_annexe INT PRIMARY KEY AUTO_INCREMENT,
    nom_type_annexe VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innodb;

-- Tables d'association ------------------------------------------------

CREATE TABLE IF NOT EXISTS theme_manga(
	id_theme INT NOT NULL,
    id_manga INT NOT NULL,
    CONSTRAINT fk_theme_manga_theme FOREIGN KEY (id_theme) REFERENCES theme(id_theme) ON DELETE CASCADE,
    CONSTRAINT fk_theme_manga_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    PRIMARY KEY (id_theme , id_manga)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS theme_anime(
	id_theme INT NOT NULL,
    id_anime INT NOT NULL,
    CONSTRAINT fk_theme_anime_theme FOREIGN KEY (id_theme) REFERENCES theme(id_theme) ON DELETE CASCADE,
    CONSTRAINT fk_theme_anime_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE,
    PRIMARY KEY (id_theme , id_anime)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS genre_manga(
	id_genre INT NOT NULL,
    id_manga INT NOT NULL,
    CONSTRAINT fk_genre_manga_genre FOREIGN KEY (id_genre) REFERENCES genre(id_genre) ON DELETE CASCADE,
    CONSTRAINT fk_genre_manga_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    PRIMARY KEY (id_genre , id_manga)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS genre_anime(
	id_genre INT NOT NULL,
    id_anime INT NOT NULL,
    CONSTRAINT fk_genre_anime_genre FOREIGN KEY (id_genre) REFERENCES genre(id_genre) ON DELETE CASCADE,
    CONSTRAINT fk_genre_anime_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE,
    PRIMARY KEY (id_genre , id_anime)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS autor_manga(
	id_autor INT NOT NULL,
    id_manga INT NOT NULL,
    CONSTRAINT fk_autor_manga_autor FOREIGN KEY (id_autor) REFERENCES autor(id_autor) ON DELETE CASCADE,
    CONSTRAINT fk_autor_manga_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    PRIMARY KEY (id_autor , id_manga)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS autor_anime(
	id_autor INT NOT NULL,
    id_anime INT NOT NULL,
    CONSTRAINT fk_autor_anime_autor FOREIGN KEY (id_autor) REFERENCES autor(id_autor) ON DELETE CASCADE,
    CONSTRAINT fk_autor_anime_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE,
    PRIMARY KEY (id_autor , id_anime)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS manga_manga(
	id_manga_preneur INT NOT NULL,
    id_manga_donneur INT NOT NULL,
    id_type_relation INT NOT NULL,
    id_type_relation_inverse INT NOT NULL,
    CONSTRAINT fk_manga_manga_preneur FOREIGN KEY (id_manga_preneur) REFERENCES manga(id_manga) ON DELETE CASCADE,
    CONSTRAINT fk_manga_manga_donneur FOREIGN KEY (id_manga_donneur) REFERENCES manga(id_manga) ON DELETE CASCADE,
    CONSTRAINT fk_manga_manga_type FOREIGN KEY (id_type_relation) REFERENCES type_relation(id_type_relation) ON DELETE CASCADE,
    CONSTRAINT fk_manga_manga_type_inverse FOREIGN KEY (id_type_relation_inverse) REFERENCES type_relation(id_type_relation) ON DELETE CASCADE,
    PRIMARY KEY (id_manga_preneur , id_manga_donneur)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS manga_anime(
	id_manga INT NOT NULL,
    id_anime INT NOT NULL,
    id_type_relation INT NOT NULL,
    id_type_relation_inverse INT NOT NULL,
    CONSTRAINT fk_manga_anime_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    CONSTRAINT fk_manga_anime_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE,
	CONSTRAINT fk_manga_anime_type FOREIGN KEY (id_type_relation) REFERENCES type_relation(id_type_relation) ON DELETE CASCADE,
    CONSTRAINT fk_manga_anime_type_inverse FOREIGN KEY (id_type_relation_inverse) REFERENCES type_relation(id_type_relation) ON DELETE CASCADE,
    PRIMARY KEY (id_manga , id_anime)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS anime_anime(
	id_anime_preneur INT NOT NULL,
    id_anime_donneur INT NOT NULL,
    id_type_relation INT NOT NULL,
    id_type_relation_inverse INT NOT NULL,
    CONSTRAINT fk_anime_anime_preneur FOREIGN KEY (id_anime_preneur) REFERENCES anime(id_anime) ON DELETE CASCADE,
    CONSTRAINT fk_anime_anime_donneur FOREIGN KEY (id_anime_donneur) REFERENCES anime(id_anime) ON DELETE CASCADE,
    CONSTRAINT fk_anime_anime_type FOREIGN KEY (id_type_relation) REFERENCES type_relation(id_type_relation) ON DELETE CASCADE,
    CONSTRAINT fk_anime_anime_type_inverse FOREIGN KEY (id_type_relation_inverse) REFERENCES type_relation(id_type_relation) ON DELETE CASCADE,
    PRIMARY KEY (id_anime_preneur , id_anime_donneur)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS manga_annexe(
	id_manga INT NOT NULL,
    id_annexe INT NOT NULL,
    id_type_relation INT NOT NULL,
    CONSTRAINT fk_manga_annexe_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    CONSTRAINT fk_manga_annexe_annexe FOREIGN KEY (id_annexe) REFERENCES annexe(id_annexe) ON DELETE CASCADE,
	CONSTRAINT fk_manga_annexe_type FOREIGN KEY (id_type_relation) REFERENCES type_relation(id_type_relation) ON DELETE CASCADE,
    PRIMARY KEY (id_manga , id_annexe)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS anime_annexe(
	id_anime INT NOT NULL,
    id_annexe INT NOT NULL,
    id_type_relation INT NOT NULL,
    CONSTRAINT fk_anime_annexe_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE,
    CONSTRAINT fk_anime_annexe_annexe FOREIGN KEY (id_annexe) REFERENCES annexe(id_annexe) ON DELETE CASCADE,
	CONSTRAINT fk_anime_annexe_type FOREIGN KEY (id_type_relation) REFERENCES type_relation(id_type_relation) ON DELETE CASCADE,
    PRIMARY KEY (id_anime , id_annexe)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS manga_compte_note(
	id_manga INT NOT NULL,
    id_compte INT NOT NULL,
    note_compte INT NOT NULL,
    CONSTRAINT fk_manga_note_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    CONSTRAINT fk_manga_note_compte FOREIGN KEY (id_compte) REFERENCES compte(id_compte) ON DELETE CASCADE,
    PRIMARY KEY (id_manga , id_compte)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS anime_compte_note(
	id_anime INT NOT NULL,
    id_compte INT NOT NULL,
    note_compte INT NOT NULL,
    CONSTRAINT fk_anime_note_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE,
    CONSTRAINT fk_anime_note_compte FOREIGN KEY (id_compte) REFERENCES compte(id_compte) ON DELETE CASCADE,
    PRIMARY KEY (id_anime , id_compte)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS manga_compte_liste(
	id_manga INT NOT NULL,
    id_compte INT NOT NULL,
    id_type_liste INT NOT NULL,
    CONSTRAINT fk_manga_liste_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    CONSTRAINT fk_manga_liste_compte FOREIGN KEY (id_compte) REFERENCES compte(id_compte) ON DELETE CASCADE,
    CONSTRAINT fk_manga_liste_type FOREIGN KEY (id_type_liste) REFERENCES type_liste(id_type_liste) ON DELETE CASCADE,
    PRIMARY KEY (id_manga , id_compte , id_type_liste)
)ENGINE=innodb;

CREATE TABLE IF NOT EXISTS anime_compte_liste(
	id_anime INT NOT NULL,
    id_compte INT NOT NULL,
    id_type_liste INT NOT NULL,
    CONSTRAINT fk_anime_liste_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE,
    CONSTRAINT fk_anime_liste_compte FOREIGN KEY (id_compte) REFERENCES compte(id_compte) ON DELETE CASCADE,
    CONSTRAINT fk_anime_liste_type FOREIGN KEY (id_type_liste) REFERENCES type_liste(id_type_liste) ON DELETE CASCADE,
    PRIMARY KEY (id_anime , id_compte , id_type_liste)
)ENGINE=innodb;

-- Clés étrangères --------------------------------------------------------------------
ALTER TABLE arc
	ADD CONSTRAINT fk_arc_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    ADD CONSTRAINT uq_numero_arc UNIQUE (id_manga , numero_arc),
	ADD CONSTRAINT uq_arc_manga UNIQUE (id_arc , id_manga);

ALTER TABLE tomes
	ADD CONSTRAINT fk_tomes_manga FOREIGN KEY (id_manga) REFERENCES manga(id_manga) ON DELETE CASCADE,
    ADD CONSTRAINT fk_tomes_arc_manga FOREIGN KEY (id_arc , id_manga) REFERENCES arc(id_arc , id_manga),
    ADD CONSTRAINT uq_numero_tomes UNIQUE (numero_tomes , id_arc);
    
ALTER TABLE saisons
	ADD CONSTRAINT fk_saisons_anime FOREIGN KEY (id_anime) REFERENCES anime(id_anime) ON DELETE CASCADE,
    ADD CONSTRAINT uq_numero_saisons UNIQUE (id_anime , numero_saisons);
    
ALTER TABLE autor
	ADD CONSTRAINT fk_autor_type FOREIGN KEY (id_type_autor) REFERENCES type_autor(id_type_autor) ON DELETE CASCADE;
    
ALTER TABLE manga
	ADD CONSTRAINT fk_manga_pays FOREIGN KEY (id_pays) REFERENCES pays(id_pays),
	ADD CONSTRAINT fk_manga_statut_vf FOREIGN KEY (id_statut_vf) REFERENCES statut(id_statut),
	ADD CONSTRAINT fk_manga_statut_vo FOREIGN KEY (id_statut_vo) REFERENCES statut(id_statut),
	ADD CONSTRAINT fk_manga_support FOREIGN KEY (id_support) REFERENCES support(id_support),
	ADD CONSTRAINT fk_manga_classification FOREIGN KEY (id_classification) REFERENCES classification(id_classification);
    
ALTER TABLE anime
	ADD CONSTRAINT fk_anime_saison_parution FOREIGN KEY (id_saison_parution) REFERENCES saison_parution(id_saison_parution),
	ADD CONSTRAINT fk_anime_statut FOREIGN KEY (id_statut) REFERENCES statut(id_statut),
	ADD CONSTRAINT fk_anime_support FOREIGN KEY (id_support) REFERENCES support(id_support),
	ADD CONSTRAINT fk_anime_classification FOREIGN KEY (id_classification) REFERENCES classification(id_classification),
	ADD CONSTRAINT fk_anime_type FOREIGN KEY (id_type_anime) REFERENCES type_anime(id_type_anime);
    
ALTER TABLE annexe
	ADD CONSTRAINT fk_annexe_type FOREIGN KEY (id_type_annexe) REFERENCES type_annexe(id_type_annexe);