const titleSelect = localStorage.getItem("animeCardClicked");
const lienManga = document.getElementById("lienManga");
let animeSelect;

animeOrdered.map((anime)=>{
    if(anime[0] == titleSelect){
        animeSelect = anime[1];
    }
});


console.log(animeSelect);

const touteLaPage = document.querySelector("body");
const page = document.querySelector("main");

const title = document.createElement("h1");
title.innerText = animeSelect.title;

const infos = document.createElement("div");
infos.setAttribute("id","infos");
const blocInfo = document.createElement("div");
blocInfo.setAttribute("id","blocInfo");

const imagePrincipale = document.createElement("img");
imagePrincipale.setAttribute("src",animeSelect.image);

const originalTitle = document.createElement("h3");
const otherTitle = document.createElement("h3");
const date = document.createElement("h3");
const studio = document.createElement("h3");
const classif = document.createElement("h3");
const genre = document.createElement("h3");
const theme = document.createElement("h3");
const episodes = document.createElement("h3");
const saisons = document.createElement("h3");
const diffusion = document.createElement("h3");
const type = document.createElement("h3");

originalTitle.innerHTML =  `<strong>Titre original :</strong> ${animeSelect.originalTitle}`;
if(animeSelect.otherTitle != false){
    otherTitle.innerHTML = `<strong>Titres alternatifs :</strong> ${animeSelect.otherTitle}`;
}
type.innerHTML =  `<strong>Type :</strong> ${animeSelect.type}`;
date.innerHTML =  `<strong>Date :</strong> ${animeSelect.sortie}`;

let studioLink = [];
animeSelect.studio.map((studio)=>{studioLink.push(`<a class="studio" href="autor.html">${studio}</a>`)});
studio.innerHTML = `<strong>Studio :</strong> ${studioLink.join(" - ")}`;

classif.innerHTML =  `<strong>Classification :</strong> <a class="class" href="search.html">${animeSelect.class}</a>`;

let genreLink = [];
animeSelect.genre.map((genre)=>{genreLink.push(`<a class="genre" href="search.html">${genre}</a>`)});
genre.innerHTML = `<strong>Genres :</strong> ${genreLink.join(" - ")}`;

let themeLink = [];
animeSelect.theme.map((theme)=>{themeLink.push(`<a class="theme" href="search.html">${theme}</a>`)});
theme.innerHTML = `<strong>Thèmes :</strong> ${themeLink.join(" - ")}`;

episodes.innerHTML =  `<strong>Episodes :</strong> ${animeSelect.episodes}`;
if(animeSelect.listSaisons != false){
    saisons.innerHTML = `<strong>Saisons :</strong> ${animeSelect.saisons}`;
}

let diffusionLink = [];
animeSelect.diffusion.map((diffusion)=>{diffusionLink.push(`<a class="diffusion" href="autor.html">${diffusion}</a>`)});
diffusion.innerHTML = `<strong>Diffusion :</strong> ${diffusionLink.join(" - ")}`;

blocInfo.append(imagePrincipale , infos);
infos.append(originalTitle,otherTitle,episodes,saisons,classif,genre,theme,date,type,studio,diffusion);

const synopsis = document.createElement("p");
synopsis.innerHTML = animeSelect.synopsis;
synopsis.setAttribute("id","synopsis");

page.append(title,blocInfo,synopsis);

touteLaPage.style.backgroundImage = `url("${animeSelect.background}")`; 


// ---------------Ajout des saisons-------------------------------------------------

const saisonsGrid = document.createElement("div");
saisonsGrid.setAttribute("id","tomesGrid");
if(animeSelect.listSaisons == false){
}else{
    animeSelect.listSaisons.map((listSaisons,i)=>{
        const cardSaison = document.createElement("div");
        const cardSaisonImg = document.createElement("img");
        const texteBloc = document.createElement("div");
        texteBloc.setAttribute("class","texteBlocTome");
        const texteTitle = document.createElement("h3");
        texteTitle.setAttribute("class","titreTome");
        texteTitle.innerHTML = listSaisons.title;
        const textePara = document.createElement("p");
        textePara.innerHTML = listSaisons.synopsis;
        texteBloc.append(texteTitle,textePara);
        cardSaisonImg.setAttribute("src",listSaisons.image);
        cardSaison.append(cardSaisonImg,texteBloc);
        cardSaison.setAttribute("class","cardTome");
        saisonsGrid.appendChild(cardSaison);
    });
}

// -----------------Ajouter tout dans la page et mettre l'arriere plan---------------------
page.append(title,blocInfo,synopsis,saisonsGrid);
touteLaPage.style.backgroundImage = `url("${animeSelect.background}")`; 


// ------------------Mettre le voile blanc au clic des tomes------------------------------

const tomesList = document.getElementsByClassName("cardTome");
const textList = document.getElementsByClassName("texteBlocTome");
cardTomeTab = Array.from(tomesList);

cardTomeTab.map((card , i)=>{
    card.addEventListener("click",()=>{
        card.classList.toggle("cardTomeClicked");
        card.classList.toggle("cardTome");

        textList[i].classList.toggle("texteBlocTomeClicked");
    });
});


// --------------- Récupérer les liens du bloc info --------------------------------

const linkList = document.querySelectorAll("#infos a");
const linkListTab = Array.from(linkList);
console.log(linkListTab);
linkListTab.map((link , i)=>{
    link.addEventListener("click",()=>{
        if(link.getAttribute("class") == "genre"){
            localStorage.setItem("searchAction","searchGender");
            localStorage.setItem("searchGender",link.textContent);
        }
        if(link.getAttribute("class") == "theme"){
            localStorage.setItem("searchAction","searchTheme");
            localStorage.setItem("searchTheme",link.textContent);
        }
        if(link.getAttribute("class") == "class"){
            localStorage.setItem("searchAction","searchClass");
            localStorage.setItem("searchClass",link.textContent);
        }

        if(link.getAttribute("class") == "studio"){
            localStorage.setItem("autorAction","autorStudio");
            localStorage.setItem("autorStudio",link.textContent);
        }
        if(link.getAttribute("class") == "diffusion"){
            localStorage.setItem("autorAction","autorDiffusion");
            localStorage.setItem("autorDiffusion",link.textContent);
        }
    })
})

// --------------- Passer à la version manga ------------------------------------------
const titreList = [];
const footer = document.querySelector("section");
if(animeSelect.mangaLié != false){
    animeSelect.mangaLié.map((titre)=>{
        let mangaId;
        mangaOrdered.map((manga,i)=>{
            if(manga[0] == titre){
                mangaId = i;
                titreList.push(manga);
            }
        });
        createLink(mangaOrdered[mangaId][1],footer);
    });
}
if(animeSelect.animeLié != false){
    animeSelect.animeLié.map((titre)=>{
        let animeId;
        animeOrdered.map((anime,i)=>{
            if(anime[0] == titre){
                animeId = i;
                titreList.push(anime);
            }
        });
        createLink(animeOrdered[animeId][1],footer);
    });
}

// -------- Envoyer le nom de la carte cliquée dans le localStorage -----------------

const cardList=[];
for(let i=0;i<titreList.length;i++){
    cardList.push(footer.getElementsByTagName("a")[i]);
}
cardList.map((cardId , i)=>{
    cardId.addEventListener("click",()=>{
        console.log(titreList[i][0]);
        if(titreList[i][1].support == "anime"){
            localStorage.setItem("animeCardClicked",titreList[i][0]);
        }else{
            localStorage.setItem("mangaCardClicked",titreList[i][0]);
        }
    }); 
});
