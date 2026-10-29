<?php require_once __DIR__ . '/../php/data.php';

if(!isset($_SESSION['id'])) {
    header('Location: compte.php');
    exit;
}
$id = $_SESSION['id'];
try{
    // Récupérer la liste des manga et animés et leurs données
    $rListe=$pdoAniManga->prepare("SELECT DISTINCT s.nom_support , c.nom_classification , m.titre_manga titre , m.id_manga , m.titre_manga , m.image_manga , m.tomes_vf_manga , m.tomes_vo_manga , p.nom_pays ,
        NULL id_anime , NULL titre_anime , NULL image_anime , NULL saisons_anime , NULL episodes_anime FROM manga m 
            JOIN support s ON s.id_support = m.id_support JOIN classification c ON c.id_classification = m.id_classification JOIN pays p ON p.id_pays = m.id_pays JOIN manga_compte_liste l ON l.id_manga = m.id_manga
                WHERE l.id_compte = ? AND l.id_type_liste = 1
        UNION ALL SELECT DISTINCT s.nom_support , c.nom_classification , a.titre_anime titre , NULL id_manga , NULL titre_manga , NULL image_manga , NULL tomes_vf_manga , NULL tomes_vo_manga , NULL nom_pays ,
            a.id_anime , a.titre_anime , a.image_anime , a.saisons_anime , a.episodes_anime FROM anime a
                JOIN support s ON s.id_support = a.id_support JOIN classification c ON c.id_classification = a.id_classification JOIN anime_compte_liste l ON l.id_anime = a.id_anime
        WHERE l.id_compte = ? AND l.id_type_liste = 1 ORDER BY titre");
    $rListe->bindParam(1,$id,PDO::PARAM_INT);
    $rListe->bindParam(2,$id,PDO::PARAM_INT);
    $rListe->execute();
    $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);
}catch(EXCEPTION $error){
    die($error->get_message());
}?>

<!-- --------------------------------------------------------------------------------------- -->

<?php include '../includes/header.php';?>
    <main id="searchGallery">
        <h1>Mes favoris</h1>
        <section id="gallerie">
            <?php
                foreach($listeOeuvres as $oeuvre){
                    if($oeuvre['nom_support'] == 'Anime') {
                        try{
                            $rNote=$pdoAniManga->prepare("SELECT ROUND(AVG(n.note_compte),1)note FROM anime_compte_note n WHERE n.id_anime = ?");
                            $rNote->bindParam(1,$oeuvre['id_anime'],PDO::PARAM_INT);
                            $rNote->execute();
                            $note = $rNote->fetch(PDO::FETCH_ASSOC);
                            $oeuvre['note'] = $note['note'];
                            $rGenres=$pdoAniManga->prepare("SELECT g.nom_genre FROM genre g JOIN genre_anime ga ON ga.id_genre = g.id_genre WHERE ga.id_anime = ?");
                            $rThemes=$pdoAniManga->prepare("SELECT t.nom_theme FROM theme t JOIN theme_anime ta ON ta.id_theme = t.id_theme WHERE ta.id_anime = ?");
                            $rGenres->bindParam(1,$oeuvre['id_anime'],PDO::PARAM_INT);
                            $rGenres->execute();
                            $genres = $rGenres->fetchAll(PDO::FETCH_ASSOC);
                            $rThemes->bindParam(1,$oeuvre['id_manga'],PDO::PARAM_INT);
                            $rThemes->execute();
                            $themes = $rThemes->fetchAll(PDO::FETCH_ASSOC);
                        }catch(EXCEPTION $error){die($error->get_message());}
                        createCardAnime($oeuvre , '../' , $genres , $themes);
                    }else{
                        try{
                            $rNote=$pdoAniManga->prepare("SELECT ROUND(AVG(n.note_compte),1)note FROM manga_compte_note n WHERE n.id_manga = ?");
                            $rNote->bindParam(1,$oeuvre['id_manga'],PDO::PARAM_INT);
                            $rNote->execute();
                            $note = $rNote->fetch(PDO::FETCH_ASSOC);
                            $oeuvre['note'] = $note['note'];
                            $rGenres=$pdoAniManga->prepare("SELECT g.nom_genre FROM genre g JOIN genre_manga gm ON gm.id_genre = g.id_genre WHERE gm.id_manga = ?");
                            $rThemes=$pdoAniManga->prepare("SELECT t.nom_theme FROM theme t JOIN theme_manga tm ON tm.id_theme = t.id_theme WHERE tm.id_manga = ?");
                            $rGenres->bindParam(1,$oeuvre['id_manga'],PDO::PARAM_INT);
                            $rGenres->execute();
                            $genres = $rGenres->fetchAll(PDO::FETCH_ASSOC);
                            $rThemes->bindParam(1,$oeuvre['id_manga'],PDO::PARAM_INT);
                            $rThemes->execute();
                            $themes = $rThemes->fetchAll(PDO::FETCH_ASSOC);
                        }catch(EXCEPTION $error){die($error->get_message());}
                        createCardManga($oeuvre , '../' , $genres , $themes);
                    }
                }
            ?>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>