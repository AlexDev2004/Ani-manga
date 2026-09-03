const mangaGallery = document.querySelector(".gallery");

mangaOrdered.map((manga)=>{
    createCardManga(manga,mangaGallery);
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

const cardList=[];
for(let i=0;i<mangaOrdered.length;i++){
    cardList.push(mangaGallery.getElementsByTagName("button")[i]);
}


// -------- Envoyer le nom de la carte cliquée dans le localStorage -----------------

cardList.map((cardId , i)=>{
    cardId.addEventListener("click",()=>{

        localStorage.setItem("mangaCardClicked",mangaOrdered[i][0]);
    });
});