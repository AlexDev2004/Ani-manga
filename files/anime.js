const animeGallery = document.querySelector(".gallery");


animeOrdered.map((anime)=>{
    createCardAnime(anime,animeGallery);
});



const cardList=[];
for(let i=0;i<animeOrdered.length;i++){
    cardList.push(animeGallery.getElementsByClassName("cardTitre")[i]);
}


// -------- Envoyer le nom de la carte cliquée dans le localStorage -----------------

cardList.map((cardId , i)=>{
    cardId.addEventListener("click",()=>{

        localStorage.setItem("animeCardClicked",animeOrdered[i][0]);
    });
});