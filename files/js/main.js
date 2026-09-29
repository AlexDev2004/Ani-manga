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
        createCardAnime(resultObject,gallery);
    }else{
        createCardManga(resultObject,gallery);
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

        if(resultOrdered[i][1].support == "manga"){
            localStorage.setItem("mangaCardClicked",resultOrdered[i][0]);
        }else{
            localStorage.setItem("animeCardClicked",resultOrdered[i][0]);
        }
    });
});