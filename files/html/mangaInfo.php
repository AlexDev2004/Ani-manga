<?php require_once __DIR__ . '/../php/mangaInfoData.php'; ?>

<?php include '../includes/header.php';?>
    <main style="background-image: url('<?php echo($arrierePlan) ?>'); background-attachment: fixed; background-repeat: no-repeat; background-size: cover;">
        <section id="infoPage">
            <div id="top">
                <div id="svg"><?php
                    if(empty($checkFav) || !isset($_SESSION['id'])) {
                        echo("<form action='#' method='post'><button type='submit' name='fav'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-star-plus preview-icon'><path d='M11.013 18.582 6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.12 2.12 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.12 2.12 0 0 0 1.597-1.16l2.309-4.679a.53.53 0 0 1 .95 0l2.31 4.679a2.12 2.12 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904L20 11.5'/><path d='M15 18h6'/><path d='M18 15v6'/></svg>                   
                        </button></form>");
                    }else{
                        echo("<form action='#' method='post'><button type='submit' name='favSup'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='3.5' stroke-linecap='round' stroke-linejoin='round' class='lucide lucide-star-check preview-icon'><path d='m19.06 12.501 2.78-2.707a.53.53 0 0 0-.294-.905l-5.166-.755a2.1 2.1 0 0 1-1.595-1.16l-2.31-4.68a.53.53 0 0 0-.95.001L9.216 6.974a2.1 2.1 0 0 1-1.597 1.16l-5.165.755a.53.53 0 0 0-.294.906l3.736 3.637a2.1 2.1 0 0 1 .611 1.879l-.88 5.139a.53.53 0 0 0 .769.56l4.617-2.428.027-.014'/><path d='m15 18 2 2 4-4'/></svg>
                        </button></form>");
                    }
                ?></div>
                <h1><?php echo($titreManga);?></h1>
                <?php
                    if(empty($checkList) || !isset($_SESSION['id'])) { 
                        echo("<form id='liste' action='#' method='post'><button type='submit' name='liste'>Ajouter à ma liste</button></form>");
                    }else{
                        echo("<form id='liste' action='#' method='post'><button type='submit' name='listeSup'>Supprimer de ma liste</button></form>");
                    }
                ?>
            </div>
            <div id="blocInfo">
                <img src="<?php echo($imageManga);?>">
                <div id="infos">
                    <h3><strong>Titre original : </strong><?php echo($originalTitle);?></h3>
                    <?php if($otherTitle != null) echo('<h3><strong>Titre original : </strong>' .$otherTitle.'</h3>');?>
                    <h3><strong>Origine : </strong><?php echo($paysManga.' - '.$dateVo);?></h3>
                    <?php if($paysManga != 'France' && $tomesVf != null) echo('<h3><strong>Sortie VF : </strong>' .$dateVf.'</h3>');?>
                    <h3><strong>Auteur(s) : </strong><?php $first = true; foreach ($assocAutor as $autor) {
                        if($autor['id_type_autor'] == 1) {
                            if(!$first) echo(' - ');
                            echo("<a href='autor.php?id=$autor[id_autor]'>$autor[nom_autor]</a>");
                            $first = false;
                    }}?></h3>
                    <h3><strong>Classification : </strong><?php echo($classification);?></h3>
                    <h3><strong>Genres : </strong><?php $first = true; foreach ($assocGenres as $genre) {
                        if(!$first) echo(' - ');
                        echo("<a href='search.php?genre=$genre[nom_genre]'>$genre[nom_genre]</a>");
                        $first = false;
                    }?></h3>
                    <h3><strong>Thèmes : </strong><?php $first = true; foreach ($assocTheme as $theme) {
                        if(!$first) echo(' - ');
                        echo("<a href='search.php?theme=$theme[nom_theme]'>$theme[nom_theme]</a>");
                        $first = false;
                    }?></h3>
                    <?php if($paysManga != 'France' && $tomesVf != null) echo('<h3><strong>Volumes FR : </strong>' .$tomesVf.' ('.$statutVf.')</h3>');?>
                    <?php if($tomesVf === null) echo('<h3><strong>Volumes VF : </strong>' .$statutVf.'</h3>');?>
                    <h3><strong>Volumes VO : </strong><?php echo($tomesVo.' ('.$statutVo.')');?></h3>
                    <h3><strong>Editeur : </strong><?php $first = true; foreach ($assocAutor as $autor) {
                        if($autor['id_type_autor'] == 2) {
                            if(!$first) echo(' - ');
                            echo("<a href='autor.php?id=$autor[id_autor]'>$autor[nom_autor]</a>");
                            $first = false;
                    }}?></h3>
                    <h3 id="note1"><strong> Note globale : </strong>
                    <?php echo($notes." / 5<span>"); 
                        star($notes);
                    ?></span></h3>
                    <h3 id="note2"><strong> Note personnelle : </strong>
                    <?php echo($note." / 5<form method='post'>"); 
                        star($note);
                    ?></form></h3>
                </div>
            </div>
            <p id="synopsis"><?php echo($synopsis); ?></p>
            

            <div id='tomesGrid'><?php
                if($tomesVo > 1){
                    if($tabTome[0]['nom_arc'] == null){ 
                        genererTomesSimple($tabTome);
                    }else{ 
                        genererTomesArc($tabTome);
                    }
                }
            ?></div>
        </section>
        <section id="fichesLiees">
            <h1>Fiches liées :</h1>
            <article>
                <?php foreach($tabFichesLiées as $oeuvre) createLinkCard($oeuvre); ?>
            </article>
        </section>
    </main>
    <footer>
    </footer>
    <script src="../js/mangaInfo.js"></script>
</body>
</html>

