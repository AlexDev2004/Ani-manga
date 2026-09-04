const searchBar = document.getElementById("search");
const zoneDeRecherche = document.getElementById("searchZone");

zoneDeRecherche.addEventListener("submit",()=>{
    searchBar.value;
    localStorage.setItem("searchBar",searchBar.value);
    localStorage.setItem("searchAction","searchBar");
});







function createCardManga(mangaPos,target){
    let manga = mangaPos[1];

    const card = document.createElement("button");
    card.setAttribute("type","submit");
    const image = document.createElement("img");
    image.setAttribute("src",manga.image);
    card.appendChild(image);

    const info = document.createElement("div");

    const title = document.createElement("h2");
    title.innerHTML = `${manga.title}`;
    const classif = document.createElement("p");
    classif.innerHTML = `<strong>Classification :</strong> <a href="search.html">${manga.class}</a>`;

    const genres = document.createElement("p");
    let genreLink = [];
    manga.genre.map((genre)=>{genreLink.push(`<a href="search.html">${genre}</a>`)});
    genres.innerHTML = `<strong>Genres :</strong> ${genreLink.join(" - ")}`;

    const themes = document.createElement("p");
    let themeLink = [];
    manga.theme.map((theme)=>{themeLink.push(`<a href="search.html">${theme}</a>`)})
    themes.innerHTML = `<strong>Thèmes :</strong> ${themeLink.join(" - ")}`;
    
    const tomeVF = document.createElement("p");
    tomeVF.innerHTML = `<strong>Tomes VF :</strong> ${manga.VF}`;
    const tomeVO = document.createElement("p");
    tomeVO.innerHTML = `<strong>Tomes VO :</strong> ${manga.VO}`;

    info.append(title,classif,genres,themes,tomeVF,tomeVO);

    card.appendChild(info);
    target.appendChild(card);
}

function createCardAnime(animePos,target){
    let anime = animePos[1];

    const card = document.createElement("button");
    const image = document.createElement("img");
    image.setAttribute("src",anime.image);
    card.appendChild(image);

    const info = document.createElement("div");

    const title = document.createElement("h2");
    title.innerHTML = `${anime.title}`;
    const classif = document.createElement("p");
    classif.innerHTML = `<strong>Classification :</strong> <a href="search.html">${anime.class}</a>`;

    const genres = document.createElement("p");
    let genreLink = [];
    anime.genre.map((genre)=>{genreLink.push(`<a href="search.html">${genre}</a>`)});
    genres.innerHTML = `<strong>Genres :</strong> ${genreLink.join(" - ")}`;

    const themes = document.createElement("p");
    let themeLink = [];
    anime.theme.map((theme)=>{themeLink.push(`<a href="search.html">${theme}</a>`)})
    themes.innerHTML = `<strong>Thèmes :</strong> ${themeLink.join(" - ")}`;
    
    const episodes = document.createElement("p");
    episodes.innerHTML = `<strong>Episodes :</strong> ${anime.episodes}`;
    const saisons = document.createElement("p");

    if(anime.listSaisons != false){
        saisons.innerHTML = `<strong>Saisons :</strong> ${anime.saisons}`;
    }

    info.append(title,classif,genres,themes,episodes,saisons);

    card.appendChild(info);
    target.appendChild(card);
}