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