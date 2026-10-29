<?php require_once __DIR__ . '/data.php';

$id = $_GET['id'];
if(isset($_SESSION['id'])) $idUser = $_SESSION['id'];

try{    
    // -------- Infos générales ----------
    $rAnimeInfo = $pdoAniManga->prepare
        ('SELECT a.titre_anime , a.image_anime , a.titre_original_anime , a.titres_alternatifs_anime , a.annee_anime , sp.nom_saison_parution , c.nom_classification , a.episodes_anime , a.saisons_anime , s.nom_statut , a.synopsis_anime , a.arriere_plan_anime , t.nom_type_anime
            FROM anime a LEFT JOIN classification c ON c.id_classification = a.id_classification LEFT JOIN statut s ON s.id_statut = a.id_statut LEFT JOIN saison_parution sp ON sp.id_saison_parution = a.id_saison_parution LEFT JOIN type_anime t ON t.id_type_anime = a.id_type_anime
                WHERE a.id_anime = ?');
    $rAnimeInfo->bindParam(1,$id);
    $rAnimeInfo->execute();
    $assocAnimeTitre = $rAnimeInfo->fetch(PDO::FETCH_ASSOC);
    if ($assocAnimeTitre === false) {
        exit("Aucun animé trouvé pour l'identifiant : " . $id);
    }
    $titreAnime = $assocAnimeTitre['titre_anime'];
    $imageAnime = $assocAnimeTitre['image_anime'];
    $originalTitle = $assocAnimeTitre['titre_original_anime'];
    $otherTitle = $assocAnimeTitre['titres_alternatifs_anime'];
    $annee = $assocAnimeTitre['annee_anime'];
    $classification = $assocAnimeTitre['nom_classification'];
    $episodes = $assocAnimeTitre['episodes_anime'];
    $saisons = $assocAnimeTitre['saisons_anime'];
    $statut = $assocAnimeTitre['nom_statut'];
    $synopsis = $assocAnimeTitre['synopsis_anime'];
    $arrierePlan = $assocAnimeTitre['arriere_plan_anime'];
    $type = $assocAnimeTitre['nom_type_anime'];
    $saison = $assocAnimeTitre['nom_saison_parution'];

    $rGenres = $pdoAniManga->prepare
        ('SELECT g.id_genre , g.nom_genre FROM anime a 
            LEFT JOIN genre_anime ga ON ga.id_anime = a.id_anime LEFT JOIN genre g ON g.id_genre = ga.id_genre
                WHERE a.id_anime = ?');
    $rGenres->bindParam(1,$id);
    $rGenres->execute();
    $assocGenres = $rGenres->fetchAll(PDO::FETCH_ASSOC);

    $rThemes = $pdoAniManga->prepare
        ('SELECT t.id_theme , t.nom_theme FROM anime a 
            LEFT JOIN theme_anime ta ON ta.id_anime = a.id_anime LEFT JOIN theme t ON t.id_theme = ta.id_theme
                WHERE a.id_anime = ?');
    $rThemes->bindParam(1,$id);
    $rThemes->execute();
    $assocTheme = $rThemes->fetchAll(PDO::FETCH_ASSOC);

    $rAutor = $pdoAniManga->prepare
        ('SELECT a.id_autor , a.nom_autor , a.id_type_autor FROM anime an 
            LEFT JOIN autor_anime aa ON aa.id_anime = an.id_anime LEFT JOIN autor a ON a.id_autor = aa.id_autor
                WHERE an.id_anime = ?');
    $rAutor->bindParam(1,$id);
    $rAutor->execute();
    $assocAutor = $rAutor->fetchAll(PDO::FETCH_ASSOC);

    // ---------- Saisons -----------------------
        $rSaisons=$pdoAniManga->prepare("SELECT s.nom_saisons , s.numero_saisons , s.image_saisons , s.synopsis_saisons , s.episodes_saisons
            FROM saisons s 
            WHERE s.id_anime = ? ORDER BY s.numero_saisons");
        $rSaisons->bindParam(1,$id,PDO::PARAM_STR);
        $rSaisons->execute();
        $tabSaisons = $rSaisons->fetchAll(PDO::FETCH_ASSOC);

    // --------- Fiches liées -----------------
    $rRelationsAnimePreneur=$pdoAniManga->prepare("SELECT a.nom_anime nom_oeuvre , aa.id_anime_donneur id_oeuvre , t.nom_type_anime type_oeuvre , s.nom_support support_oeuvre , tr.nom_type_relation relation_oeuvre , a.image_anime image_oeuvre
        FROM anime_anime aa JOIN anime a ON aa.id_anime_donneur = a.id_anime JOIN support s ON s.id_support = a.id_support JOIN type_anime t ON t.id_type_anime = a.id_type_anime JOIN type_relation tr ON tr.id_type_relation = aa.id_type_relation
        WHERE aa.id_anime_preneur = ?");
    $rRelationsAnimePreneur->bindParam(1,$id,PDO::PARAM_STR);
    $rRelationsAnimePreneur->execute();
    $rRelationsAnimeDonneur=$pdoAniManga->prepare("SELECT a.nom_anime nom_oeuvre , aa.id_anime_preneur id_oeuvre , t.nom_type_anime type_oeuvre , s.nom_support support_oeuvre , tr.nom_type_relation relation_oeuvre , a.image_anime image_oeuvre
        FROM anime_anime aa JOIN anime a ON aa.id_anime_preneur = a.id_anime JOIN support s ON s.id_support = a.id_support JOIN type_anime t ON t.id_type_anime = a.id_type_anime JOIN type_relation tr ON tr.id_type_relation = aa.id_type_relation_inverse
        WHERE aa.id_anime_donneur = ?");
    $rRelationsAnimeDonneur->bindParam(1,$id,PDO::PARAM_STR);
    $rRelationsAnimeDonneur->execute();
    $rRelationsAnimeManga=$pdoAniManga->prepare("SELECT m.nom_manga nom_oeuvre, ma.id_manga id_oeuvre, s.nom_support type_oeuvre , tr.nom_type_relation relation_oeuvre , m.image_manga image_oeuvre , s.nom_support support_oeuvre
        FROM manga_anime ma JOIN manga m ON ma.id_manga = m.id_manga JOIN type_relation tr ON tr.id_type_relation = ma.id_type_relation_inverse JOIN support s ON s.id_support = m.id_support
        WHERE ma.id_anime = ?");
    $rRelationsAnimeManga->bindParam(1,$id,PDO::PARAM_STR);
    $rRelationsAnimeManga->execute();
    $tabAnimePreneur = $rRelationsAnimePreneur->fetchAll(PDO::FETCH_ASSOC);
    $tabAnimeDonneur = $rRelationsAnimeDonneur->fetchAll(PDO::FETCH_ASSOC);
    $tabAnimeManga = $rRelationsAnimeManga->fetchAll(PDO::FETCH_ASSOC);
    $tabFichesLiées = array_merge($tabAnimeManga , $tabAnimePreneur , $tabAnimeDonneur);

    // Bouton ajouter a la liste ----------------------
    // Verifier si l'anime est deja dans la liste
    $rCheckList=$pdoAniManga->prepare("SELECT l.id_anime FROM anime_compte_liste l WHERE l.id_anime = ? AND l.id_compte = ? AND l.id_type_liste = 2");
    $rCheckList->bindParam(1,$id,PDO::PARAM_INT);
    $rCheckList->bindParam(2,$idUser,PDO::PARAM_INT);
    $rCheckList->execute();
    $checkList = $rCheckList->fetch(PDO::FETCH_ASSOC);

    // Ajouter a la liste
    if(isset($_POST['liste'])){
        if(!isset($_SESSION['id'])) {
            header('Location: ../html/compte.php');
            exit;
        } 
        $rListe=$pdoAniManga->prepare("INSERT INTO anime_compte_liste (id_anime , id_compte , id_type_liste) VALUE (?,?,2);");
        $rListe->bindParam(1,$id,PDO::PARAM_INT);
        $rListe->bindParam(2,$idUser,PDO::PARAM_INT);
        $rListe->execute();
        header("Location: ../html/animeInfo.php?id=$id");
        exit;
    }
    // Supprimer de la liste
    if(isset($_POST['listeSup'])){
        if(!isset($_SESSION['id'])) {
            header('Location: ../html/compte.php');
            exit;
        } 
        $rListe=$pdoAniManga->prepare("DELETE FROM anime_compte_liste WHERE id_anime = ? AND id_compte = ? AND id_type_liste = 2 ");
        $rListe->bindParam(1,$id,PDO::PARAM_INT);
        $rListe->bindParam(2,$idUser,PDO::PARAM_INT);
        $rListe->execute();
        header("Location: ../html/animeInfo.php?id=$id  ");
        exit;
    }
    // Bouton ajouter aux favoris ----------------------
    // Verifier si l'anime est deja dans les favoris
    $rCheckFav=$pdoAniManga->prepare("SELECT l.id_anime FROM anime_compte_liste l WHERE l.id_anime = ? AND l.id_compte = ? AND l.id_type_liste = 1");
    $rCheckFav->bindParam(1,$id,PDO::PARAM_INT);
    $rCheckFav->bindParam(2,$idUser,PDO::PARAM_INT);
    $rCheckFav->execute();
    $checkFav = $rCheckFav->fetch(PDO::FETCH_ASSOC);

    // Ajouter aux favoris
    if(isset($_POST['fav'])){
        if(!isset($_SESSION['id'])) {
            header('Location: ../html/compte.php');
            exit;
        } 
        $rFav=$pdoAniManga->prepare("INSERT INTO anime_compte_liste (id_anime , id_compte , id_type_liste) VALUE (?,?,1);");
        $rFav->bindParam(1,$id,PDO::PARAM_INT);
        $rFav->bindParam(2,$idUser,PDO::PARAM_INT);
        $rFav->execute();
        header("Location: ../html/animeInfo.php?id=$id");
        exit;
    }
    // Supprimer des favoris
    if(isset($_POST['favSup'])){
        if(!isset($_SESSION['id'])) {
            header('Location: ../html/compte.php');
            exit;
        } 
        $rFav=$pdoAniManga->prepare("DELETE FROM anime_compte_liste WHERE id_anime = ? AND id_compte = ? AND id_type_liste = 1 ");
        $rFav->bindParam(1,$id,PDO::PARAM_INT);
        $rFav->bindParam(2,$idUser,PDO::PARAM_INT);
        $rFav->execute();
        header("Location: ../html/animeInfo.php?id=$id  ");
        exit;
    }
    // Récupérer la note globale
    $rTakeNote=$pdoAniManga->prepare("SELECT ROUND(AVG(n.note_compte),1)note FROM anime_compte_note n WHERE n.id_anime = ?");
    $rTakeNote->bindParam(1,$id,PDO::PARAM_INT);
    $rTakeNote->execute();
    $moyenneNotes = $rTakeNote->fetch(PDO::FETCH_ASSOC);
    $notes = $moyenneNotes['note'];
    // Récupérer la note perso
    if(isset($_SESSION['id'])){
        $rNote=$pdoAniManga->prepare("SELECT n.note_compte note FROM anime_compte_note n WHERE n.id_anime = ? AND n.id_compte = ?");
        $rNote->bindParam(1,$id,PDO::PARAM_INT);
        $rNote->bindParam(2,$idUser,PDO::PARAM_INT);
        $rNote->execute();
        $tabNote = $rNote->fetch(PDO::FETCH_ASSOC);
        if(empty($tabNote)) {
            $note = 0;
        }else{
            $note = $tabNote['note'];
        }
    }else{
        $note = 0;
    }
    // Récupérer la nouvelle note
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST[$i])) {
            $newNote = $i;
            if(!isset($_SESSION['id'])) {
            header('Location: compte.php');
            exit;
            }
            if($note == 0){
                $rNewNote=$pdoAniManga->prepare("INSERT INTO anime_compte_note (id_anime , id_compte , note_compte) VALUE (?,?,?)");
                $rNewNote->bindParam(1,$id,PDO::PARAM_INT);
                $rNewNote->bindParam(2,$idUser,PDO::PARAM_INT);
                $rNewNote->bindParam(3,$newNote,PDO::PARAM_INT);
                $rNewNote->execute();
            }else{
                $rModifNote=$pdoAniManga->prepare("UPDATE anime_compte_note SET note_compte = ? WHERE id_anime = ? AND id_compte = ?");
                $rModifNote->bindParam(1,$newNote,PDO::PARAM_INT);
                $rModifNote->bindParam(2,$id,PDO::PARAM_INT);
                $rModifNote->bindParam(3,$idUser,PDO::PARAM_INT);
                $rModifNote->execute();
            }
            header("Location: ../html/animeInfo.php?id=$id");
            exit;
        }
    }      

}catch(EXCEPTION $error){
    die($error->getmessage());
}


// --------------- Fonctions ----------------------------------

// Fonction créer carte tome :

function genererSaison($saison){
    echo("<div class='cardTome'>
        <img src='$saison[image_saisons]' class='imageTome'>
        <div class='texteBlocTome'>
            <h3 class='titreTome'>$saison[nom_saisons]</h3>
            <p>$saison[synopsis_saisons]</p>
        </div>
    </div>");
}

// Fonction Liste de tomes sans arc
function genererSaisons($tab){
    foreach($tab as $tome) genererSaison($tome);
}

// Fonctions oeuvres liées
function createLinkCard($oeuvre){
        $url = "mangaInfo.php?id=$oeuvre[id_oeuvre]";
        if($oeuvre['support_oeuvre'] == 'Anime') $url = "animeInfo.php?id=$oeuvre[id_oeuvre]";
        
        echo("<a href='$url'>
            <h2>$oeuvre[nom_oeuvre]</h2>
            <div><h3><strong>$oeuvre[type_oeuvre]</h3><h3>$oeuvre[relation_oeuvre]</strong></h3></div>
            <img src='$oeuvre[image_oeuvre]'>
        </a>");
    }



?>
