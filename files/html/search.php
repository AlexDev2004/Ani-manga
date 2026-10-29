<?php require_once __DIR__ . '/../php/searchData.php'; ?>

<?php include '../includes/header.php';?>
    <main>
        <h1>Résultats de recherche</h1>
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