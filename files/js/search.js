const gallery = document.querySelector(".gallery");
const searchGallery = document.querySelector("#searchGallery");
let action = localStorage.getItem("searchAction");
let recherche;
const result =[];


// ------------------------------- Tri par nom ----------------------------------------------------------------------
if(action == "searchBar"){
    recherche = localStorage.getItem("searchBar");
    console.log(recherche);

    mangaOrdered.map((manga)=>{
        if(manga[1].title.includes(recherche)){
            result.push(manga);
        }
    });
    animeOrdered.map((anime)=>{
        if(anime[1].title.includes(recherche)){
            result.push(anime);
        }
    });
}

//------------------------------- Tri par genre ---------------------------------------------------------------------
if(action == "searchGender"){
    recherche = localStorage.getItem("searchGender");
    console.log(recherche); 
    
    mangaOrdered.map((manga)=>{
        if(manga[1].genre.includes(recherche)){
            result.push(manga);
        }
    });
    animeOrdered.map((anime)=>{
        if(anime[1].genre.includes(recherche)){
            result.push(anime);
        }
    });
}

// ------------------------------ Trier le tableau par ordre alphabétique -----------------------------------------------
const resultOrdered = result.sort((a, b) =>
    a[0].localeCompare(b[0], undefined, {
        sensitivity: "base"
    })
);

console.log(result);    

// ----------------------------------Afficher les cards --------------------------------------------------------------

result.map((resultObject)=>{
    if(resultObject[1].support == "manga"){
        createCardManga(resultObject,gallery);
    }else{
        createCardAnime(resultObject,gallery);
    }
});


// -------------------------------- Reprendre les cards ---------------------------------------------------------------

const cardList=[];
for(let i=0;i<resultOrdered.length;i++){
    cardList.push(searchGallery.getElementsByClassName("cardTitre")[i]);
}


// -------- Envoyer le nom de la carte cliquée dans le localStorage -----------------

cardList.map((cardId , i)=>{
    cardId.addEventListener("click",()=>{

        if(resultOrdered[i][1].support == "manga"){
            localStorage.setItem("mangaCardClicked",resultOrdered[i][0]);
        }else{
            localStorage.setItem("animeCardClicked",resultOrdered[i][0]);
        }
    });
});