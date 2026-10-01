const gallery = document.querySelector(".gallery");
const blocTitre = document.querySelector(".blocTitre");
const searchGallery = document.querySelector("#searchGallery");
let action = localStorage.getItem("autorAction");
let recherche;
const result =[];

//------------------------------- Tri par auteur ---------------------------------------------------------------------
if(action == "autorAuteur"){
    recherche = localStorage.getItem("autorAuteur");
    
    mangaOrdered.map((manga)=>{
        if(manga[1].auteur.includes(recherche)){
            result.push(manga);
        }
    });
}

//------------------------------- Tri par editeur ---------------------------------------------------------------------
if(action == "autorEditeur"){
    recherche = localStorage.getItem("autorEditeur");
    
    mangaOrdered.map((manga)=>{
        if(manga[1].editeur.includes(recherche)){
            result.push(manga);
        }
    });
}

//------------------------------- Tri par studio ---------------------------------------------------------------------
if(action == "autorStudio"){
    recherche = localStorage.getItem("autorStudio");

    animeOrdered.map((anime)=>{
        if(anime[1].studio.includes(recherche)){
            result.push(anime);
        }
    });
}

//------------------------------- Tri par diffuseur ---------------------------------------------------------------------
if(action == "autorDiffusion"){
    recherche = localStorage.getItem("autorDiffusion");

    animeOrdered.map((anime)=>{
        if(anime[1].diffusion.includes(recherche)){
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

// ------------------------------ Zone titre -------------------------------------------------------------------

if(action == "autorAuteur"){
    auteurs.map((auteur)=>{
        if(auteur.nom == recherche){
            const imgAutor = document.createElement("img");
            const nomAutor = document.createElement("h1");
            const textAutor = document.createElement("p");
            const zoneText = document.createElement("div");
            const linkAutor = document.createElement("a");
            zoneText.style.display = "flex";
            zoneText.style.flexDirection = "column";
            imgAutor.setAttribute("src",auteur.image);
            nomAutor.innerText = auteur.nom;
            textAutor.innerText = auteur.historique;
            linkAutor.innerText= "Plus d'infos";
            linkAutor.setAttribute("href",auteur.link);
            zoneText.append(nomAutor,textAutor,linkAutor);
            blocTitre.append(imgAutor,zoneText);
        }
    })
}
if(action == "autorEditeur"){
    editeurs.map((editeur)=>{
        if(editeur.nom == recherche){
            const imgAutor = document.createElement("img");
            const nomAutor = document.createElement("h1");
            const textAutor = document.createElement("p");
            const zoneText = document.createElement("div");
            const linkAutor = document.createElement("a");
            zoneText.style.display = "flex";
            zoneText.style.flexDirection = "column";
            imgAutor.setAttribute("src",editeur.image);
            nomAutor.innerText = editeur.nom;
            textAutor.innerText = editeur.historique;
            linkAutor.innerText= "Plus d'infos";
            linkAutor.setAttribute("href",editeur.link);
            zoneText.append(nomAutor,textAutor,linkAutor);
            blocTitre.append(imgAutor,zoneText);
        }
    })
}
if(action == "autorStudio"){
    studios.map((studio)=>{
        if(studio.nom == recherche){
            const imgAutor = document.createElement("img");
            const nomAutor = document.createElement("h1");
            const textAutor = document.createElement("p");
            const zoneText = document.createElement("div");
            const linkAutor = document.createElement("a");
            zoneText.style.display = "flex";
            zoneText.style.flexDirection = "column";
            imgAutor.setAttribute("src",studio.image);
            nomAutor.innerText = studio.nom;
            textAutor.innerText = studio.historique;
            linkAutor.innerText= "Plus d'infos";
            linkAutor.setAttribute("href",studio.link);
            zoneText.append(nomAutor,textAutor,linkAutor);
            blocTitre.append(imgAutor,zoneText);
        }
    })
}
if(action == "autorDiffusion"){
    diffusions.map((diffusion)=>{
        if(diffusion.nom == recherche){
            const imgAutor = document.createElement("img");
            const nomAutor = document.createElement("h1");
            const textAutor = document.createElement("p");
            const zoneText = document.createElement("div");
            const linkAutor = document.createElement("a");
            zoneText.style.display = "flex";
            zoneText.style.flexDirection = "column";
            imgAutor.setAttribute("src",diffusion.image);
            nomAutor.innerText = diffusion.nom;
            textAutor.innerText = diffusion.historique;
            linkAutor.innerText= "Plus d'infos";
            linkAutor.setAttribute("href",diffusion.link);
            zoneText.append(nomAutor,textAutor,linkAutor);
            blocTitre.append(imgAutor,zoneText);
        }
    })
}

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