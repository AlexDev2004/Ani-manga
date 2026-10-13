INSERT INTO saison_parution (nom_saison_parution) VALUE
	("Printemps"),("Été"),("Automne"),("Hiver");
    
INSERT INTO pays (nom_pays) VALUE
	("Japon"),("France"),("États-Unis");
    
INSERT INTO classification (nom_classification) VALUE 
	("Shōnen"),("Seinen"),("Shōjo"),("Josei"),("Kodomo");
    
INSERT INTO genre (nom_genre , image_genre) VALUE
	("Action","../img/genres/action.jpg"),
    ("Aventure","../img/genres/aventure.png"),
    ("Comédie","../img/genres/comedie.jpg"),
    ("Drame","../img/genres/drame.jpg"),
    ("Ecchi","../img/genres/ecchi.jpg"),
    ("Fantastique","../img/genres/fantasy.jpg"),
    ("Historique","../img/genres/historique.jpg"),
    ("Horreur","../img/genres/horreur.jpg"),
    ("Isekai","../img/genres/isekai.jpg"),
    ("Nekketsu","../img/genres/nekketsu.jpg"),
    ("Psychologique","../img/genres/psychologique.jpg"),
    ("Romance","../img/genres/romance.jpg"),
    ("Slice of Life","../img/genres/sliceOfLife.jpg"),
    ("Science-Fiction","../img/genres/sciencesFiction.jpg"),
    ("Surnaturel","../img/genres/surnaturel.jpg"),
    ("Thriller","../img/genres/thriller.jpg"),
    ("Yonkoma","../img/genres/Yonkoma.jpg");
    
INSERT INTO theme (nom_theme) VALUE
	("Adolescence"),("Aliens / Extra-terrestres"),("Amitié"),("Amour"),("Animaux"),("Apprentissage"),("Arcade"),("Arts martiaux"),("Assassinat"),("Autre monde"),
	("Badminton"),("Bains"),("Basketball"),
	("Club"),("Combats"),("Comédie musicale"),("Compétition"),("Crime"),("Cross-play"),
	("Détective"),("Dragons"),
	("École"),("Espionnage"),
	("Famille"),("Fantômes"),("Futur"),
	("Gastronomie"),("Gore"),("Guerre"),
	("Harem"),("Homme au foyer"),("Homme-Bête"),
	("Identité"),("Jeux-vidéo"),("LGBT+"),
	("Magie"),("Maid"),("Malédiction"),("Mariage"),("Mature"),("Médium"),("Mensonges"),("Monde virtuel"),("Mort"),("Monster Girl"),("Monstres"),("Musique"),("Mystère"),
	("Organisations secrètes"),("Otaku"),
	("Poésie"),("Police"),("Politique"),("Post-apocalyptique"),("Pouvoirs psychiques"),
	("Réincarnation"),("Royauté"),
	("School life"),("Scientifique"),("Shinigami"),("Shōjo-aï"),("Solitude"),("Sorcellerie"),("Société"),("Sources chaudes"),("Sport"),("Succube/Incube"),("Super pouvoirs"),("Survie"),("Survival game"),
	("Tabac"),("Terrorisme"),("Tragique"),("Transformation"),("Travail"),
	("Vengeance"),("Voyage temporel"),
	("Yakuza"),("Yuri");
    
    SELECT * FROM 