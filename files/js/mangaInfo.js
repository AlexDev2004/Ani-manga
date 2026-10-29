const touteLaPage = document.querySelector("body");
const page = document.querySelector("main");

// ------------------Mettre le voile blanc au clic des tomes------------------------------

const tomesList = document.getElementsByClassName("cardTome");
const textList = document.getElementsByClassName("texteBlocTome");
cardTomeTab = Array.from(tomesList);

cardTomeTab.map((card , i)=>{
    card.addEventListener("click",()=>{
        console.log("clic");
        card.classList.toggle("cardTomeClicked");
        card.classList.toggle("cardTome");

        textList[i].classList.toggle("texteBlocTomeClicked");
    });
});


// --------------- Récupérer les liens du bloc info --------------------------------

const linkList = document.querySelectorAll("#infos a");
const linkListTab = Array.from(linkList);
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

        if(link.getAttribute("class") == "auteur"){
            localStorage.setItem("autorAction","autorAuteur");
            localStorage.setItem("autorAuteur",link.textContent);
        }
        if(link.getAttribute("class") == "editeur"){
            localStorage.setItem("autorAction","autorEditeur");
            localStorage.setItem("autorEditeur",link.textContent);
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