const animeGallery = document.querySelector(".gallery");


animeOrdered.map((anime)=>{
    createCardAnime(anime,animeGallery);
});

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


const cardList=[];
for(let i=0;i<animeOrdered.length;i++){
    cardList.push(animeGallery.getElementsByTagName("button")[i]);
}


// -------- Envoyer le nom de la carte cliquée dans le localStorage -----------------

cardList.map((cardId , i)=>{
    cardId.addEventListener("click",()=>{

        localStorage.setItem("animeCardClicked",animeOrdered[i][0]);
    });
});