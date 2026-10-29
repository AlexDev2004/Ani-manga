<?php require_once __DIR__ . '/../php/data.php';

try{
    $rListe=$pdoAniManga->prepare("SELECT c.nom_classification , a.id_anime , a.titre_anime , a.image_anime , a.saisons_anime , a.episodes_anime FROM anime a
        JOIN classification c ON c.id_classification = a.id_classification
        ORDER BY titre_anime");
    $rListe->execute();
    $listeOeuvres = $rListe->fetchAll(PDO::FETCH_ASSOC);

}catch(EXCEPTION $error){
    die($error->getmessage());
}?>

<!-- -------------------------------------------------------------------------------- -->


<?php include '../includes/header.php';?>
    <main>
        <h1>Animés</h1>
        <section id="gallerie">
            <?php
                foreach($listeOeuvres as $oeuvre){
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
                }
            ?>
        </div>
</section>
    <footer>

    </footer>
</body>
</html> 