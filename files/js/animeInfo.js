const titleSelect = localStorage.getItem("animeCardClicked");
const lienManga = document.getElementById("lienManga");
let animeSelect;

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
