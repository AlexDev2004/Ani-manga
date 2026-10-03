const genreGallery = document.querySelector("#genreGallery");

// -------------- Création des cards ---------------------
genres.map((genre)=>{
    const card = document.createElement("button");
    card.setAttribute("type","summit");
    card.setAttribute("name",genre[0]);
    const div = document.createElement("div");
    const title = document.createElement("h2");
    title.innerText = genre[0];
    div.appendChild(title);
    const image = document.createElement("img");
    image.setAttribute("src",genre[1]);
    card.append(div,image);
    genreGallery.append(card);
});


// ------------- Clic des cards --------------------------
const genresGrid = document.querySelector("main");
const genresList = genresGrid.querySelectorAll("button");
const genresTab = Array.from(genresList);

genresTab.map((card)=>{
    card.addEventListener("click",()=>{
        const genre = card.getAttribute("name");
        localStorage.setItem("searchGender",genre);
        localStorage.setItem("searchAction","searchGender");
    });
});