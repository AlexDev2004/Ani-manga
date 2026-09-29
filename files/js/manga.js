const mangaGallery = document.querySelector(".gallery");

mangaOrdered.map((manga)=>{
    if(manga[1].support == "manga"){
        createCardManga(manga,mangaGallery);
    }
});



const cardList=[];
for(let i=0;i<mangaOrdered.length;i++){
    cardList.push(mangaGallery.getElementsByClassName("cardTitre")[i]);
}


// -------- Envoyer le nom de la carte cliquée dans le localStorage -----------------

cardList.map((cardId , i)=>{
    cardId.addEventListener("click",()=>{

        localStorage.setItem("mangaCardClicked",mangaOrdered[i][0]);
    });
});