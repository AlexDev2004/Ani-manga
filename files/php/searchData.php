 <?php require_once __DIR__ . '/data.php';
 
 switch(true){
        case isset($_GET['genre']) :
            $genre = $_GET['genre'];
            $rListe=$pdoAniManga->prepare("SELECT DISTINCT s.nom_support , c.nom_classification , m.titre_manga titre , m.id_manga , m.titre_manga , m.image_manga , m.tomes_vf_manga , m.tomes_vo_manga , p.nom_pays ,
                NULL id_anime , NULL titre_anime , NULL image_anime , NULL saisons_anime , NULL episodes_anime FROM manga m 
                    JOIN support s ON s.id_support = m.id_support JOIN classification c ON c.id_classification = m.id_classification JOIN pays p ON p.id_pays = m.id_pays JOIN genre_manga gm ON gm.id_manga = m.id_manga JOIN genre g ON g.id_genre = gm.id_genre
                        WHERE g.nom_genre = ?
                UNION ALL SELECT DISTINCT s.nom_support , c.nom_classification , a.titre_anime titre , NULL id_manga , NULL titre_manga , NULL image_manga , NULL tomes_vf_manga , NULL tomes_vo_manga , NULL nom_pays ,
                    a.id_anime , a.titre_anime , a.image_anime , a.saisons_anime , a.episodes_anime FROM anime a
                        JOIN support s ON s.id_support = a.id_support JOIN classification c ON c.id_classification = a.id_classification JOIN genre_anime ga ON ga.id_anime = a.id_anime JOIN genre g ON g.id_genre = ga.id_genre
                WHERE g.nom_genre = ? ORDER BY titre");
            $rListe->bindParam(1,$genre,PDO::PARAM_STR);
            $rListe->bindParam(2,$genre,PDO::PARAM_STR);
            $rListe->execute();
            $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);
            break;
        case isset($_GET['theme']) : 
            $theme = $_GET['theme'];
            $rListe=$pdoAniManga->prepare("SELECT DISTINCT s.nom_support , c.nom_classification , m.titre_manga titre , m.id_manga , m.titre_manga , m.image_manga , m.tomes_vf_manga , m.tomes_vo_manga , p.nom_pays ,
                NULL id_anime , NULL titre_anime , NULL image_anime , NULL saisons_anime , NULL episodes_anime FROM manga m 
                    JOIN support s ON s.id_support = m.id_support JOIN classification c ON c.id_classification = m.id_classification JOIN pays p ON p.id_pays = m.id_pays JOIN theme_manga tm ON tm.id_manga = m.id_manga JOIN theme t ON t.id_theme = tm.id_theme
                        WHERE t.nom_theme = ?
                UNION ALL SELECT DISTINCT s .nom_support , c.nom_classification , a.titre_anime titre , NULL id_manga , NULL titre_manga , NULL image_manga , NULL tomes_vf_manga , NULL tomes_vo_manga , NULL nom_pays ,
                    a.id_anime , a.titre_anime , a.image_anime , a.saisons_anime , a.episodes_anime FROM anime a
                        JOIN support s ON s.id_support = a.id_support JOIN classification c ON c.id_classification = a.id_classification JOIN theme_anime ta ON ta.id_anime = a.id_anime JOIN theme t ON t.id_theme = ta.id_theme
                WHERE t.nom_theme = ? ORDER BY titre");
            $rListe->bindParam(1,$theme,PDO::PARAM_STR);
            $rListe->bindParam(2,$theme,PDO::PARAM_STR);
            $rListe->execute();
            $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);
            break;
        case isset($_GET['classification']) :
            $classification = $_GET['classification'];
            $rListe=$pdoAniManga->prepare("SELECT DISTINCT s.nom_support , c.nom_classification , m.titre_manga titre , m.id_manga , m.titre_manga , m.image_manga , m.tomes_vf_manga , m.tomes_vo_manga , p.nom_pays ,
                NULL id_anime , NULL titre_anime , NULL image_anime , NULL saisons_anime , NULL episodes_anime FROM manga m 
                    JOIN support s ON s.id_support = m.id_support JOIN classification c ON c.id_classification = m.id_classification JOIN pays p ON p.id_pays = m.id_pays
                        WHERE c.nom_classification = ?
                UNION ALL SELECT DISTINCT s.nom_support , c.nom_classification , a.titre_anime titre , NULL id_manga , NULL titre_manga , NULL image_manga , NULL tomes_vf_manga , NULL tomes_vo_manga , NULL nom_pays ,
                    a.id_anime , a.titre_anime , a.image_anime , a.saisons_anime , a.episodes_anime FROM anime a
                        JOIN support s ON s.id_support = a.id_support JOIN classification c ON c.id_classification = a.id_classification
                WHERE c.nom_classification = ? ORDER BY titre");
            $rListe->bindParam(1,$classification,PDO::PARAM_STR);
            $rListe->bindParam(2,$classification,PDO::PARAM_STR);
            $rListe->execute();
            $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);
            break;
        case isset($_POST['multiTag']):
            $genres = $_POST['genres'] ?? []; $themes = $_POST['themes'] ?? []; $classifications = $_POST['classifications'] ?? [];
            $conditionsManga = [];
            $conditionsAnime = [];
            $paramsManga = [];
            $paramsAnime = [];
            // -------- GENRES --------
            foreach ($genres as $genre) {
                $conditionsManga[] = "EXISTS (
                    SELECT 1 FROM genre_manga gm
                    JOIN genre g ON g.id_genre = gm.id_genre
                    WHERE gm.id_manga = m.id_manga
                    AND g.nom_genre = ?
                )";
                $conditionsAnime[] = "EXISTS (
                    SELECT 1 FROM genre_anime ga
                    JOIN genre g ON g.id_genre = ga.id_genre
                    WHERE ga.id_anime = a.id_anime
                    AND g.nom_genre = ?
                )";
                $paramsManga[] = $genre;
                $paramsAnime[] = $genre;
            }
            // -------- THEMES --------
            foreach ($themes as $theme) {
                $conditionsManga[] = "EXISTS (
                    SELECT 1 FROM theme_manga tm
                    JOIN theme t ON t.id_theme = tm.id_theme
                    WHERE tm.id_manga = m.id_manga
                    AND t.nom_theme = ?
                )";
                $conditionsAnime[] = "EXISTS (
                    SELECT 1 FROM theme_anime ta
                    JOIN theme t ON t.id_theme = ta.id_theme
                    WHERE ta.id_anime = a.id_anime
                    AND t.nom_theme = ?
                )";
                $paramsManga[] = $theme;
                $paramsAnime[] = $theme;
            }
            // -------- CLASSIFICATIONS --------
            foreach ($classifications as $classification) {
                $conditionsManga[] = "c.nom_classification = ?";
                $conditionsAnime[] = "c.nom_classification = ?";
                $paramsManga[] = $classification;
                $paramsAnime[] = $classification;
            }
            // -------- CONSTRUCTION DES WHERE --------
            $whereManga = !empty($conditionsManga)
                ? "WHERE " . implode(" AND ", $conditionsManga) : "";
            $whereAnime = !empty($conditionsAnime) 
                ? "WHERE " . implode(" AND ", $conditionsAnime) : "";
            // -------- REQUETE SQL --------
            $rListe = $pdoAniManga->prepare("
                SELECT
                    s.nom_support, c.nom_classification, m.titre_manga titre, m.id_manga, m.titre_manga, m.image_manga, m.tomes_vf_manga, m.tomes_vo_manga, p.nom_pays,
                    NULL id_anime, NULL titre_anime, NULL image_anime, NULL saisons_anime, NULL episodes_anime
                        FROM manga m JOIN support s ON s.id_support = m.id_support JOIN classification c ON c.id_classification = m.id_classification JOIN pays p ON p.id_pays = m.id_pays
                        $whereManga
                UNION ALL SELECT
                    s.nom_support, c.nom_classification, a.titre_anime titre, NULL id_manga, NULL titre_manga, NULL image_manga, NULL tomes_vf_manga, NULL tomes_vo_manga, NULL nom_pays,
                    a.id_anime, a.titre_anime, a.image_anime, a.saisons_anime, a.episodes_anime
                        FROM anime a JOIN support s ON s.id_support = a.id_support JOIN classification c ON c.id_classification = a.id_classification
                        $whereAnime
                        ORDER BY titre
            ");
            // Paramètres dans le même ordre que les SELECT
            $params = array_merge($paramsManga, $paramsAnime);
            $rListe->execute($params);
            $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);
            break;        
    case isset($_GET['search']) :
            $search = '%'.$_GET['search'].'%';
            $rListe=$pdoAniManga->prepare("SELECT DISTINCT s.nom_support , c.nom_classification , m.titre_manga titre , m.id_manga , m.titre_manga , m.titre_original_manga , m.titres_alternatifs_manga , m.image_manga , m.tomes_vf_manga , m.tomes_vo_manga , p.nom_pays ,
                NULL id_anime , NULL titre_anime , NULL titre_original_anime , NULL titres_alternatifs_anime , NULL image_anime , NULL saisons_anime , NULL episodes_anime FROM manga m 
                    JOIN support s ON s.id_support = m.id_support JOIN classification c ON c.id_classification = m.id_classification JOIN pays p ON p.id_pays = m.id_pays
                        WHERE m.titre_manga LIKE ? OR m.titre_original_manga LIKE ? OR m.titres_alternatifs_manga LIKE ?
                UNION ALL SELECT DISTINCT s.nom_support , c.nom_classification , a.titre_anime titre , NULL id_manga , NULL titre_manga , NULL titre_original_manga , NULL titres_alternatifs_manga , NULL image_manga , NULL tomes_vf_manga , NULL tomes_vo_manga , NULL nom_pays ,
                    a.id_anime , a.titre_anime , a.titre_original_anime , a.titres_alternatifs_anime , a.image_anime , a.saisons_anime , a.episodes_anime FROM anime a
                        JOIN support s ON s.id_support = a.id_support JOIN classification c ON c.id_classification = a.id_classification
                WHERE a.titre_anime LIKE ? OR a.titre_original_anime LIKE ? OR a.titres_alternatifs_anime LIKE ? ORDER BY titre");
            $rListe->execute([$search , $search , $search , $search , $search , $search]);
            $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);
            break;
        default :
    }
?>
