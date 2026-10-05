const gallery = document.querySelector("#tagGallery");

// ---------- Classifications ----------------------
const classTitle = document.createElement("h3");
classTitle.innerText = "Classification démographique : ";
gallery.appendChild(classTitle);

const classPart = document.createElement("div");
classPart.setAttribute("class","part");

classifs.map((classif)=>{
    const caseSelector = document.createElement("div");
    caseSelector.setAttribute("class","case");
    const classLabel = document.createElement("label");
    classLabel.innerText = classif;
    classLabel.setAttribute("for",classif);

    const classBox = document.createElement("input");
    classBox.setAttribute("type","checkbox");
    classBox.setAttribute("id",classif);
    classBox.setAttribute("name",classif);

    caseSelector.append(classLabel,classBox);
    classPart.appendChild(caseSelector);
});
gallery.appendChild(classPart);

// ---------- Genres ----------------------
const genreTitle = document.createElement("h3");
genreTitle.innerText = "Genres : ";
gallery.appendChild(genreTitle);

const genrePart = document.createElement("div");
genrePart.setAttribute("class","part");

genres.map((genre)=>{
    const caseSelector = document.createElement("div");
    caseSelector.setAttribute("class","case");
    const genreLabel = document.createElement("label");
    genreLabel.innerText = genre[0];
    genreLabel.setAttribute("for",genre[0]);

    const genreBox = document.createElement("input");
    genreBox.setAttribute("type","checkbox");
    genreBox.setAttribute("id",genre[0]);
    genreBox.setAttribute("name",genre[0]);

    caseSelector.append(genreLabel,genreBox);
    genrePart.appendChild(caseSelector);
});
gallery.appendChild(genrePart);

// ---------- Thèmes ----------------------
const themeTitle = document.createElement("h3");
themeTitle.innerText = "Thèmes : ";
gallery.appendChild(themeTitle);

const themePart = document.createElement("div");
themePart.setAttribute("class","part");

themes.map((theme)=>{
    const caseSelector = document.createElement("div");
    caseSelector.setAttribute("class","case");
    const themeLabel = document.createElement("label");
    themeLabel.innerText = theme;
    themeLabel.setAttribute("for",theme);

    const themeBox = document.createElement("input");
    themeBox.setAttribute("type","checkbox");
    themeBox.setAttribute("id",theme);
    themeBox.setAttribute("name",theme);

    caseSelector.append(themeLabel,themeBox);
    themePart.appendChild(caseSelector);
});

gallery.appendChild(themePart);

const valider = document.createElement("button");
valider.innerText = "Rechercher";
valider.setAttribute("id","valider");
gallery.appendChild(valider);