const gallery = document.querySelector(".gallery");
const searchGallery = document.querySelector("#searchGallery");
const result =[];

mangaOrdered.map((manga)=>{
    result.push(manga);
});
animeOrdered.map((anime)=>{
    result.push(anime);
});
console.log(result);    
// ------------------------------ Trier le tableau par ordre de date -----------------------------------------------
const resultOrdered = result.sort((a, b) =>b[1].date - a[1].date);

console.log(
    resultOrdered.map(element => [
        element[1].support,
        element[1].title,
        element[1].date
    ])
); 

// ----------------------------------Afficher les cards --------------------------------------------------------------

result.map((resultObject)=>{
    if(resultObject[1].support == "anime"){
    let anime = resultObject[1];

    const card = document.createElement("a");
    card.setAttribute("href","html/animeInfo.html");
    card.setAttribute("class","cardTitre");
    const image = document.createElement("img");
    image.setAttribute("src",`img/${anime.image}`);
    card.appendChild(image);

    const info = document.createElement("div");

    const title = document.createElement("h2");
    title.innerHTML = `${anime.title}`;
    const classif = document.createElement("p");
    classif.innerHTML = `<strong>Classification :</strong>${anime.class}`;

    const genres = document.createElement("p");
    let genreLink = [];
    anime.genre.map((genre)=>{genreLink.push(genre)});
    genres.innerHTML = `<strong>Genres :</strong> ${genreLink.join(" - ")}`;

    const themes = document.createElement("p");
    let themeLink = [];
    anime.theme.map((theme)=>{themeLink.push(theme)})
    themes.innerHTML = `<strong>Thèmes :</strong> ${themeLink.join(" - ")}`;
    
    const episodes = document.createElement("p");
    episodes.innerHTML = `<strong>Episodes :</strong> ${anime.episodes}`;
    const saisons = document.createElement("p");

    if(anime.listSaisons != false){
        saisons.innerHTML = `<strong>Saisons :</strong> ${anime.saisons}`;
    }

    info.append(title,classif,genres,themes,episodes,saisons);

    card.appendChild(info);
    gallery.appendChild(card);
    }else{
    let manga = resultObject[1];

    const card = document.createElement("a");
    card.setAttribute("href","html/mangaInfo.html");
    card.setAttribute("class","cardTitre");
    const image = document.createElement("img");
    image.setAttribute("src",`img/${manga.image}`);
    card.appendChild(image);

    const info = document.createElement("div");

    const title = document.createElement("h2");
    title.innerHTML = `${manga.title}`;
    const classif = document.createElement("p");
    classif.innerHTML = `<strong>Classification :</strong> ${manga.class}`;

    const genres = document.createElement("p");
    let genreLink = [];
    manga.genre.map((genre)=>{genreLink.push(genre)});
    genres.innerHTML = `<strong>Genres :</strong> ${genreLink.join(" - ")}`;

    const themes = document.createElement("p");
    let themeLink = [];
    manga.theme.map((theme)=>{themeLink.push(theme)})
    themes.innerHTML = `<strong>Thèmes :</strong> ${themeLink.join(" - ")}`;
    
    const tomeVF = document.createElement("p");
    const flag = document.createElement("img");
    if(!manga.VF){
        flag.setAttribute("src","../svgFlag/jp.svg");
    }else{
        tomeVF.innerHTML = `<strong>Tomes VF :</strong> ${manga.VF}`;
        flag.setAttribute("src","../svgFlag/fr.svg");
    }
    flag.setAttribute("class","flag");
    flag.style.border = "solid black 1px";
    flag.style.borderRadius = "3px";

    const tomeVO = document.createElement("p");
    tomeVO.innerHTML = `<strong>Tomes VO :</strong> ${manga.VO}`;

    info.append(title,classif,genres,themes,tomeVF,tomeVO,flag);

    card.appendChild(info);
    gallery.appendChild(card);
    }
});


// -------------------------------- Reprendre les cards ---------------------------------------------------------------

const cardList=[];
for(let i=0;i<result.length;i++){
    cardList.push(searchGallery.getElementsByClassName("cardTitre")[i]);
}


// -------- Envoyer le nom de la carte cliquée dans le localStorage -----------------

cardList.map((cardId , i)=>{
    cardId.addEventListener("click",()=>{

        if(resultOrdered[i][1].support != "anime"){
            localStorage.setItem("mangaCardClicked",resultOrdered[i][0]);
        }else{
            localStorage.setItem("animeCardClicked",resultOrdered[i][0]);
        }
    });
});