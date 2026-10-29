<?php require_once __DIR__ . '/../php/data.php';
$id = $_GET['id']; 

try{
    // Récupérer les données autor
    $rAutor=$pdoAniManga->prepare("SELECT a.nom_autor , a.image_autor , a.historique_autor , a.lien_autor
        FROM autor a WHERE a.id_autor = ?");
    $rAutor->bindParam(1,$id,PDO::PARAM_INT);
    $rAutor->execute();
    $autor = $rAutor->fetch(PDO::FETCH_ASSOC);

    // Récupérer la liste des manga et animés et leurs données
    $rListe=$pdoAniManga->prepare("SELECT DISTINCT s.nom_support , c.nom_classification , m.titre_manga titre , m.id_manga , m.titre_manga , m.image_manga , m.tomes_vf_manga , m.tomes_vo_manga , p.nom_pays ,
        NULL id_anime , NULL titre_anime , NULL image_anime , NULL saisons_anime , NULL episodes_anime FROM manga m 
            JOIN support s ON s.id_support = m.id_support JOIN classification c ON c.id_classification = m.id_classification JOIN pays p ON p.id_pays = m.id_pays JOIN autor_manga am ON am.id_manga = m.id_manga
                WHERE am.id_autor = ?
        UNION ALL SELECT DISTINCT s.nom_support , c.nom_classification , a.titre_anime titre , NULL id_manga , NULL titre_manga , NULL image_manga , NULL tomes_vf_manga , NULL tomes_vo_manga , NULL nom_pays ,
            a.id_anime , a.titre_anime , a.image_anime , a.saisons_anime , a.episodes_anime FROM anime a
                JOIN support s ON s.id_support = a.id_support JOIN classification c ON c.id_classification = a.id_classification JOIN autor_anime aa ON aa.id_anime = a.id_anime
        WHERE aa.id_autor = ? ORDER BY titre");
    $rListe->bindParam(1,$id,PDO::PARAM_INT);
    $rListe->bindParam(2,$id,PDO::PARAM_INT);
    $rListe->execute();
    $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);
}catch(EXCEPTION $error){
    die($error->get_message());
}?>

<!-- --------------------------------------------------------------------------------------- -->

<?php include '../includes/header.php';?>
    <main>
        <section id="autor">
            <img src="<?php echo($autor['image_autor'])?>">
            <div style="display: flex; flex-direction: column">
                <h1><?php echo($autor['nom_autor'])?></h1>
                <p><?php echo($autor['historique_autor'])?></p>
                <a href="<?php echo($autor['lien_autor'])?>">Plus d'infos</a>
            </div>
        </section>
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