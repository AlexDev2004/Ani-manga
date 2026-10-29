<?php require_once __DIR__ . '/../php/data.php'; 

try{
    $rClassification=$pdoAniManga->prepare("SELECT c.nom_classification , c.id_classification FROM classification c");
    $rGenre=$pdoAniManga->prepare("SELECT g.nom_genre , g.id_genre FROM genre g");
    $rTheme=$pdoAniManga->prepare("SELECT t.nom_theme , t.id_theme FROM theme t");
    $rClassification->execute();
    $rGenre->execute();
    $rTheme->execute();
    $classificationList = $rClassification->fetchAll(PDO::FETCH_ASSOC);
    $genreList = $rGenre->fetchAll(PDO::FETCH_ASSOC);
    $themeList = $rTheme->fetchAll(PDO::FETCH_ASSOC);
}catch(EXCEPTION $error){die($error->get_message());}
?>


<?php include '../includes/header.php';?>
    <main>
        <h1>Filtres de recherche</h1>
        <form method="post" action="search.php" id="tags">
            <section><h3>Classification démographique : </h3>
            <div class="part">
            <?php foreach($classificationList as $classification){
                echo("<div class='case'>
                    <label for='$classification[nom_classification]'>$classification[nom_classification]</label>
                    <input type='checkbox' value='$classification[nom_classification]' name='classifications[]' id='$classification[nom_classification]'>
                </div>");
            }?></div></section>
            <section><h3>Genres : </h3>
            <div class="part">
            <?php foreach($genreList as $genre){
                echo("<div class='case'>
                    <label for='$genre[nom_genre]'>$genre[nom_genre]</label>
                    <input type='checkbox' value='$genre[nom_genre]' name='genres[]' id='$genre[nom_genre]'>
                </div>");
            }?></div></section>
            <section><h3>Thèmes : </h3>
            <div class="part">
            <?php foreach($themeList as $theme){
                echo("<div class='case'>
                    <label for='$theme[nom_theme]'>$theme[nom_theme]</label>
                    <input type='checkbox' value='$theme[nom_theme]' name='themes[]' id='$theme[nom_theme]'  >
                </div>");
            }?></div></section>
            <button id="valider" name="multiTag" type="submit">Rechercher</button>
        </form>
    </main>
    <footer>

    </footer>
</body>
</html>     