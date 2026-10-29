<?php require_once __DIR__ . '/../php/data.php';

try{
    $rListe=$pdoAniManga->prepare("SELECT c.nom_classification , m.id_manga , m.titre_manga , m.image_manga , m.tomes_vf_manga , m.tomes_vo_manga , p.nom_pays 
        FROM manga m JOIN classification c ON c.id_classification = m.id_classification JOIN pays p ON p.id_pays = m.id_pays
        ORDER BY m.titre_manga");
    $rListe->execute();
    $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);
}catch(EXCEPTION $error){
    die($error->getmessage());
}?>

<!-- ------------------------------------------------------------------------------- -->

<?php include '../includes/header.php';?>
    <main>
        <h1>Mangas</h1>
        <section id="gallerie">
            <?php
                foreach($listeOeuvres as $oeuvre){
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
            ?>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>     