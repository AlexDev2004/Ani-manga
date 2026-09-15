const titleSelect = localStorage.getItem("mangaCardClicked");
const lienAnime = document.getElementById("lienAnime");
let mangaSelect;

mangaOrdered.map((manga)=>{
    if(manga[0] == titleSelect){
        mangaSelect = manga[1];
    }
});


console.log(mangaSelect);

const touteLaPage = document.querySelector("body");
const page = document.querySelector("main");

const title = document.createElement("h1");
title.innerText = mangaSelect.title;

const infos = document.createElement("div");
infos.setAttribute("id","infos");
const blocInfo = document.createElement("div");
blocInfo.setAttribute("id","blocInfo");

const imagePrincipale = document.createElement("img");
imagePrincipale.setAttribute("src",mangaSelect.image);

const originalTitle = document.createElement("h3");
const otherTitle = document.createElement("h3");
const origine = document.createElement("h3");
const sortieVF = document.createElement("h3");
const auteur = document.createElement("h3");
const classif = document.createElement("h3");
const genre = document.createElement("h3");
const theme = document.createElement("h3");
const VF = document.createElement("h3");
const VO = document.createElement("h3");
const editeur = document.createElement("h3");

originalTitle.innerHTML =  `<strong>Titre original :</strong> ${mangaSelect.originalTitle}`;
if(mangaSelect.otherTitle != false){
    otherTitle.innerHTML = `<strong>Titres alternatifs :</strong> ${mangaSelect.otherTitle}`;
}
origine.innerHTML =  `<strong>Origine :</strong> ${mangaSelect.origine}`;
sortieVF.innerHTML =  `<strong>Sortie en VF :</strong> ${mangaSelect.sortieVF}`;
auteur.innerHTML =  `<strong>Auteur(s) :</strong> ${mangaSelect.auteur}`;
classif.innerHTML =  `<strong>Classification :</strong> <a href="search.html">${mangaSelect.class}</a>`;

let genreLink = [];
mangaSelect.genre.map((genre)=>{genreLink.push(`<a href="search.html">${genre}</a>`)});
genre.innerHTML = `<strong>Genres :</strong> ${genreLink.join(" - ")}`;

let themeLink = [];
mangaSelect.theme.map((theme)=>{themeLink.push(`<a href="search.html">${theme}</a>`)});
theme.innerHTML = `<strong>Thèmes :</strong> ${themeLink.join(" - ")}`;

VF.innerHTML =  `<strong>Volumes VF :</strong> ${mangaSelect.VF} (${mangaSelect.statusVF})`;
VO.innerHTML =  `<strong>Volumes VO :</strong> ${mangaSelect.VO} (${mangaSelect.statusVO})`;
editeur.innerHTML =  `<strong>Editeur :</strong> ${mangaSelect.editeur}`;

blocInfo.append(imagePrincipale , infos);
infos.append(originalTitle,otherTitle,origine,sortieVF,auteur,classif,genre,theme,VF,VO,editeur);

const synopsis = document.createElement("p");
synopsis.innerHTML = mangaSelect.synopsis;
synopsis.setAttribute("id","synopsis");

// ---------------Ajout des tomes-------------------------------------------------

const tomesGrid = document.createElement("div");
tomesGrid.setAttribute("id","tomesGrid");
if(mangaSelect.tomes == false){

}else if(mangaSelect.tomes[0] == false){
    genererTomesSimple();
}else{
    genererTomesArc();
}


function genererTome(tome,i){
    const cardTome = document.createElement("div");
    const cardTomeImg = document.createElement("img");
    cardTomeImg.setAttribute("class","imageTome");
    const texteBloc = document.createElement("div");
    texteBloc.setAttribute("class","texteBlocTome");
    const texteTitle = document.createElement("h3");
    texteTitle.setAttribute("class","titreTome");
    texteTitle.innerHTML = `Tome ${i+1}`;
    const textePara = document.createElement("p");
    textePara.innerHTML = tome.synopsis;
    texteBloc.append(texteTitle,textePara);
    cardTomeImg.setAttribute("src",tome.image);
    cardTome.append(cardTomeImg,texteBloc);
    cardTome.setAttribute("class","cardTome");
    tomesGrid.appendChild(cardTome);
}

function genererTomesSimple(){
    mangaSelect.tomes[1].map((tome,i)=>{
        genererTome(tome,i);
    });
}
function genererTomesArc(){
    mangaSelect.tomes.map((arc)=>{
        const arcTitle = document.createElement("h2");
        arcTitle.innerHTML = arc[0];
        tomesGrid.appendChild(arcTitle);

        arc[1].map((tome,i)=>{
            genererTome(tome,i);
        });
    });
}

// -----------------Ajouter tout dans la page et mettre l'arriere plan---------------------
page.append(title,blocInfo,synopsis,tomesGrid);
touteLaPage.style.backgroundImage = `url("${mangaSelect.background}")`; 


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



// --------------- Passer à la version Animé ------------------------------------------

localStorage.setItem("animeCardClicked",titleSelect);