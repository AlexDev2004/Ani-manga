<?php require_once __DIR__ . '/data.php';

$id = $_GET['id'];
if(isset($_SESSION['id'])) $idUser = $_SESSION['id'];

try{
    // -------- Infos générales ----------
    $rMangaInfo = $pdoAniManga->prepare
        ('SELECT m.titre_manga , m.image_manga , m.titre_original_manga , m.titres_alternatifs_manga , p.nom_pays , m.annee_vo_manga , m.annee_vf_manga , c.nom_classification , m.tomes_vf_manga , m.tomes_vo_manga , sf.nom_statut statut_vf , so.nom_statut statut_vo , m.synopsis_manga , m.arriere_plan_manga
            FROM manga m LEFT JOIN pays p ON p.id_pays = m.id_pays LEFT JOIN classification c ON c.id_classification = m.id_classification LEFT JOIN statut sf ON sf.id_statut = m.id_statut_vf LEFT JOIN statut so ON so.id_statut = m.id_statut_vo
                WHERE m.id_manga = ?');
    $rMangaInfo->bindParam(1,$id);
    $rMangaInfo->execute();
    $assocMangaTitre = $rMangaInfo->fetch(PDO::FETCH_ASSOC);
    if ($assocMangaTitre === false) {
        exit("Aucun manga trouvé pour l'identifiant : " . $id);
    }
    $titreManga = $assocMangaTitre['titre_manga'];
    $imageManga = $assocMangaTitre['image_manga'];
    $originalTitle = $assocMangaTitre['titre_original_manga'];
    $otherTitle = $assocMangaTitre['titres_alternatifs_manga'];
    $paysManga = $assocMangaTitre['nom_pays'];
    $dateVo = $assocMangaTitre['annee_vo_manga'];
    $dateVf = $assocMangaTitre['annee_vf_manga'];
    $classification = $assocMangaTitre['nom_classification'];
    $tomesVf = $assocMangaTitre['tomes_vf_manga'];
    $tomesVo = $assocMangaTitre['tomes_vo_manga'];
    $statutVf = $assocMangaTitre['statut_vf'];
    $statutVo = $assocMangaTitre['statut_vo'];
    $synopsis = $assocMangaTitre['synopsis_manga'];
    $arrierePlan = $assocMangaTitre['arriere_plan_manga'];

    $rGenres = $pdoAniManga->prepare
        ('SELECT g.id_genre , g.nom_genre FROM manga m 
            LEFT JOIN genre_manga gm ON gm.id_manga = m.id_manga LEFT JOIN genre g ON g.id_genre = gm.id_genre
                WHERE m.id_manga = ?');
    $rGenres->bindParam(1,$id);
    $rGenres->execute();
    $assocGenres = $rGenres->fetchAll(PDO::FETCH_ASSOC);

    $rThemes = $pdoAniManga->prepare
        ('SELECT t.id_theme , t.nom_theme FROM manga m 
            LEFT JOIN theme_manga tm ON tm.id_manga = m.id_manga LEFT JOIN theme t ON t.id_theme = tm.id_theme
                WHERE m.id_manga = ?');
    $rThemes->bindParam(1,$id);
    $rThemes->execute();
    $assocTheme = $rThemes->fetchAll(PDO::FETCH_ASSOC);

    $rAutor = $pdoAniManga->prepare
        ('SELECT a.id_autor , a.nom_autor , a.id_type_autor FROM manga m 
            LEFT JOIN autor_manga am ON am.id_manga = m.id_manga LEFT JOIN autor a ON a.id_autor = am.id_autor
                WHERE m.id_manga = ?');
    $rAutor->bindParam(1,$id);
    $rAutor->execute();
    $assocAutor = $rAutor->fetchAll(PDO::FETCH_ASSOC);

    // ---------- Tomes -----------------------
        $rTomes=$pdoAniManga->prepare("SELECT t.numero_tomes , t.image_tomes , t.synopsis_tomes , a.nom_arc
            FROM tomes t LEFT JOIN arc a ON a.id_arc = t.id_arc 
            WHERE t.id_manga = ? ORDER BY a.numero_arc , t.numero_tomes");
        $rTomes->bindParam(1,$id,PDO::PARAM_STR);
        $rTomes->execute();
        $tabTome = $rTomes->fetchAll(PDO::FETCH_ASSOC);

    // --------- Fiches liées -----------------
    $rRelationsMangaPreneur=$pdoAniManga->prepare("SELECT m.nom_manga nom_oeuvre , mm.id_manga_donneur id_oeuvre , s.nom_support type_oeuvre , s.nom_support support_oeuvre , tr.nom_type_relation relation_oeuvre , m.image_manga image_oeuvre
        FROM manga_manga mm JOIN manga m ON mm.id_manga_donneur = m.id_manga JOIN support s ON s.id_support = m.id_support JOIN type_relation tr ON tr.id_type_relation = mm.id_type_relation
        WHERE mm.id_manga_preneur = ?");
    $rRelationsMangaPreneur->bindParam(1,$id,PDO::PARAM_STR);
    $rRelationsMangaPreneur->execute();
    $rRelationsMangaDonneur=$pdoAniManga->prepare("SELECT m.nom_manga nom_oeuvre , mm.id_manga_preneur id_oeuvre , s.nom_support type_oeuvre , s.nom_support support_oeuvre , tr.nom_type_relation relation_oeuvre , m.image_manga image_oeuvre
        FROM manga_manga mm JOIN manga m ON mm.id_manga_preneur = m.id_manga JOIN support s ON s.id_support = m.id_support JOIN type_relation tr ON tr.id_type_relation = mm.id_type_relation_inverse
        WHERE mm.id_manga_donneur = ?");
    $rRelationsMangaDonneur->bindParam(1,$id,PDO::PARAM_STR);
    $rRelationsMangaDonneur->execute();
    $rRelationsMangaAnime=$pdoAniManga->prepare("SELECT a.nom_anime nom_oeuvre, ma.id_anime id_oeuvre, ta.nom_type_anime type_oeuvre , tr.nom_type_relation relation_oeuvre , a.image_anime image_oeuvre , s.nom_support support_oeuvre
        FROM manga_anime ma JOIN anime a ON ma.id_anime = a.id_anime JOIN type_anime ta ON ta.id_type_anime = a.id_type_anime JOIN type_relation tr ON tr.id_type_relation = ma.id_type_relation JOIN support s ON s.id_support = a.id_support
        WHERE ma.id_manga = ?");
    $rRelationsMangaAnime->bindParam(1,$id,PDO::PARAM_STR);
    $rRelationsMangaAnime->execute();
    $tabMangaPreneur = $rRelationsMangaPreneur->fetchAll(PDO::FETCH_ASSOC);
    $tabMangaDonneur = $rRelationsMangaDonneur->fetchAll(PDO::FETCH_ASSOC);
    $tabMangaAnime = $rRelationsMangaAnime->fetchAll(PDO::FETCH_ASSOC);
    $tabFichesLiées = array_merge($tabMangaPreneur , $tabMangaDonneur , $tabMangaAnime);

    // Bouton ajouter a la liste ----------------------
    // Verifier si le manga est deja dans la liste
    $rCheckList=$pdoAniManga->prepare("SELECT l.id_manga FROM manga_compte_liste l WHERE l.id_manga = ? AND l.id_compte = ? AND l.id_type_liste = 2");
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
        $rListe=$pdoAniManga->prepare("INSERT INTO manga_compte_liste (id_manga , id_compte , id_type_liste) VALUE (?,?,2);");
        $rListe->bindParam(1,$id,PDO::PARAM_INT);
        $rListe->bindParam(2,$idUser,PDO::PARAM_INT);
        $rListe->execute();
        header("Location: ../html/mangaInfo.php?id=$id");
        exit;
    }
    // Supprimer de la liste
    if(isset($_POST['listeSup'])){
        if(!isset($_SESSION['id'])) {
            header('Location: ../html/compte.php');
            exit;
        } 
        $rListe=$pdoAniManga->prepare("DELETE FROM manga_compte_liste WHERE id_manga = ? AND id_compte = ? AND id_type_liste = 2 ");
        $rListe->bindParam(1,$id,PDO::PARAM_INT);
        $rListe->bindParam(2,$idUser,PDO::PARAM_INT);
        $rListe->execute();
        header("Location: ../html/mangaInfo.php?id=$id  ");
        exit;
    }
    // Bouton ajouter aux favoris ----------------------
    // Verifier si le manga est deja dans les favoris
    $rCheckFav=$pdoAniManga->prepare("SELECT l.id_manga FROM manga_compte_liste l WHERE l.id_manga = ? AND l.id_compte = ? AND l.id_type_liste = 1");
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
        $rFav=$pdoAniManga->prepare("INSERT INTO manga_compte_liste (id_manga , id_compte , id_type_liste) VALUE (?,?,1);");
        $rFav->bindParam(1,$id,PDO::PARAM_INT);
        $rFav->bindParam(2,$idUser,PDO::PARAM_INT);
        $rFav->execute();
        header("Location: ../html/mangaInfo.php?id=$id");
        exit;
    }
    // Supprimer des favoris
    if(isset($_POST['favSup'])){
        if(!isset($_SESSION['id'])) {
            header('Location: ../html/compte.php');
            exit;
        } 
        $rFav=$pdoAniManga->prepare("DELETE FROM manga_compte_liste WHERE id_manga = ? AND id_compte = ? AND id_type_liste = 1 ");
        $rFav->bindParam(1,$id,PDO::PARAM_INT);
        $rFav->bindParam(2,$idUser,PDO::PARAM_INT);
        $rFav->execute();
        header("Location: ../html/mangaInfo.php?id=$id");
        exit;
    }
    // Récupérer la note globale
    $rTakeNote=$pdoAniManga->prepare("SELECT ROUND(AVG(n.note_compte),1)note FROM manga_compte_note n WHERE n.id_manga = ?");
    $rTakeNote->bindParam(1,$id,PDO::PARAM_INT);
    $rTakeNote->execute();
    $moyenneNotes = $rTakeNote->fetch(PDO::FETCH_ASSOC);
    $notes = $moyenneNotes['note'];
    // Récupérer la note perso
    if(isset($_SESSION['id'])){
        $rNote=$pdoAniManga->prepare("SELECT n.note_compte note FROM manga_compte_note n WHERE n.id_manga = ? AND n.id_compte = ?");
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
                $rNewNote=$pdoAniManga->prepare("INSERT INTO manga_compte_note (id_manga , id_compte , note_compte) VALUE (?,?,?)");
                $rNewNote->bindParam(1,$id,PDO::PARAM_INT);
                $rNewNote->bindParam(2,$idUser,PDO::PARAM_INT);
                $rNewNote->bindParam(3,$newNote,PDO::PARAM_INT);
                $rNewNote->execute();
            }else{
                $rModifNote=$pdoAniManga->prepare("UPDATE manga_compte_note SET note_compte = ? WHERE id_manga = ? AND id_compte = ?");
                $rModifNote->bindParam(1,$newNote,PDO::PARAM_INT);
                $rModifNote->bindParam(2,$id,PDO::PARAM_INT);
                $rModifNote->bindParam(3,$idUser,PDO::PARAM_INT);
                $rModifNote->execute();
            }
            header("Location: ../html/mangaInfo.php?id=$id");
            exit;
        }
    }      
}catch(EXCEPTION $error){die($error->getmessage());}


// --------------- Fonctions ----------------------------------

// Fonction créer carte tome :

function genererTome($tome){
    echo("<div class='cardTome'>
        <img src='$tome[image_tomes]'>
        <div class='texteBlocTome'>
            <h3 class='titreTome'>Tome $tome[numero_tomes]</h3>
            <p>$tome[synopsis_tomes]</p>
        </div>
    </div>");
}

// Fonction Liste de tomes sans arc
function genererTomesSimple($tab){
    foreach($tab as $tome) genererTome($tome);
}
// Fonction liste de tomes avec arc
function genererTomesArc($tab){
    $nomArc = "";
    foreach($tab as $tome){
        if($tome['nom_arc'] != $nomArc){
            $nomArc = $tome['nom_arc'];
            echo("<h2>$tome[nom_arc]</h2>");
        }
        genererTome($tome);
    };
} 
// Fonction oeuvres liées -------------
function createLinkCard($oeuvre){
    $url = "mangaInfo.php?id=$oeuvre[id_oeuvre]";
    if($oeuvre['support_oeuvre'] == 'Anime') $url = "animeInfo.php?id=$oeuvre[id_oeuvre]";
    
    echo("<a href='$url'>
        <img src='$oeuvre[image_oeuvre]'>
        <h2>$oeuvre[nom_oeuvre]</h2>
        <div><h3><strong>$oeuvre[type_oeuvre]</h3><h3>$oeuvre[relation_oeuvre]</strong></h3></div>
    </a>");
}


?>
