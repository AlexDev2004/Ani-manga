-- -------------------------- Sword Art Online -------------------------------
INSERT INTO manga_manga (id_manga_preneur , id_manga_donneur , id_type_relation , id_type_relation_inverse) VALUE -- 1/4
	(1,2,1,2),(1,3,8,1),(1,4,8,1),(2,3,8,1),(2,4,8,1),(3,4,1,2);
INSERT INTO anime_anime (id_anime_preneur , id_anime_donneur , id_type_relation , id_type_relation_inverse) VALUE -- 1/7
	(1,2,9,1),(1,3,5,6),(1,4,8,1),(1,5,8,1),(1,6,4,1),(1,7,7,1),(2,3,5,10),(2,4,10,10),(2,5,10,10),(2,6,4,1),(2,7,10,10),(3,4,6,5),(3,5,6,5),(3,6,4,1),(3,7,10,10),(4,5,5,6),(4,6,10,10),(4,7,10,10),(5,6,10,10),(5,7,10,10),(6,7,10,10);
INSERT INTO manga_anime (id_manga , id_anime , id_type_relation , id_type_relation_inverse) VALUE -- 1/4 - 1/7
	(1,1,2,1),(1,2,9,1),(1,3,2,1),(1,4,8,1),(1,5,8,1),(1,6,4,1),(1,7,7,1),
	(2,1,2,1),(2,2,9,1),(2,3,2,1),(2,4,8,1),(2,5,8,1),(2,6,4,1),(2,7,7,1),
    (3,1,10,8),(3,2,10,10),(3,3,10,10),(3,4,2,1),(3,5,2,1),(3,6,10,10),(3,7,10,10),
    (4,1,10,8),(4,2,10,10),(4,3,10,10),(4,4,2,1),(4,5,2,1),(4,6,10,10),(4,7,10,10);
-- INSERT INTO manga_annexe (id_manga , id_annexe , id_type_relation) VALUE;
-- INSERT INTO anime_annexe (id_anime , id_annexe , id_type_relation) VALUE;