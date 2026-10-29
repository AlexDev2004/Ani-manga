-- ----------- Sword Art Online -----------------
INSERT INTO genre_manga (id_manga , id_genre) VALUE
	/*Manga*/ (1,1),(1,2),(1,3),(1,9),(1,12),(1,14),
    /*Light Novel*/ (2,1),(2,2),(2,3),(2,9),(2,12),(2,14),
    /*Progressive*/ (3,1),(3,2),(3,3),(3,9),(3,12),(3,14),
    /*Progressive light novel*/ (4,1),(4,2),(4,3),(4,9),(4,12),(4,14);
INSERT INTO theme_manga (id_manga , id_theme) VALUE
	/*Manga*/ (1,1),(1,4),(1,34),(1,43),
    /*Light novel*/ (2,1),(2,4),(2,34),(2,43),
    /*Progressive*/ (3,1),(3,4),(3,34),(3,43),
    /*Progressive light novel*/ (4,1),(4,4),(4,34),(4,43);
INSERT INTO genre_anime (id_anime , id_genre) VALUE
	/*Série*/ (1,1),(1,2),(1,3),(1,9),(1,12),(1,14),
    /*Extra*/ (2,1),(2,2),(2,3),(2,9),(2,12),(2,14),
    /*Ordinal scale*/ (3,1),(3,2),(3,3),(3,9),(3,12),(3,14),
    /*Progressive 1*/ (4,1),(4,2),(4,3),(4,9),(4,12),(4,14),
    /*Progressive 2*/ (5,1),(5,2),(5,3),(5,9),(5,12),(5,14),
    /*Offline*/ (6,1),(6,2),(6,3),(6,9),(6,12),(6,14),
    /*Echoe*/ (7,1),(7,2),(7,3),(7,9),(7,12),(7,14);
INSERT INTO theme_anime (id_anime , id_theme) VALUE
	/*Série*/ (1,1),(1,4),(1,34),(1,43),
    /*Extra*/ (2,1),(2,4),(2,34),(2,43),
    /*Ordinal scale*/ (3,1),(3,4),(3,34),(3,43),
    /*Progressive 1*/ (4,1),(4,4),(4,34),(4,43),
    /*Progressive 2*/ (5,1),(5,4),(5,34),(5,43),
    /*Offline*/ (6,1),(6,4),(6,34),(6,43),(6,80),(6,81),
    /*Echo*/ (7,1),(7,4),(7,34),(7,43);