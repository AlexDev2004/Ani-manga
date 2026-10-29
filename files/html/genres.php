<?php require_once __DIR__ . '/../php/data.php';

try{
    $rGenres=$pdoAniManga->prepare("SELECT g.nom_genre , g.id_genre , g.image_genre
        FROM genre g");
    $rGenres->execute();
    $genreList = $rGenres->fetchAll(PDO::FETCH_ASSOC);

}catch(EXCEPTION $error){
    die($error->getmessage());
}?>

<!-- -------------------------------------------------------------------------------- -->

<?php include '../includes/header.php';?>
    <main>
        <section id="genres">
            <?php foreach($genreList as $genre){
                echo("<a href='search.php?genre=$genre[nom_genre]'>
                    <div><h2>$genre[nom_genre]</h2></div>
                    <img src='$genre[image_genre]'>
                </a>");
            }?>
        </section>
    </main>
    <footer>

    </footer>
</body>
</html>     