
document.addEventListener("DOMContentLoaded", () => {
    const burger = document.getElementById("burgerButton");
    const menu = document.getElementById("navLiens");

    if (!burger || !menu) return;

    function fermerMenu() {
        menu.classList.remove("ouvert");
        burger.classList.remove("actif");
        burger.setAttribute("aria-expanded", "false");
        burger.setAttribute("aria-label", "Ouvrir le menu");
    }

    burger.addEventListener("click", () => {
        const ouvert = menu.classList.toggle("ouvert");

        burger.classList.toggle("actif", ouvert);
        burger.setAttribute("aria-expanded", String(ouvert));
        burger.setAttribute(
            "aria-label",
            ouvert ? "Fermer le menu" : "Ouvrir le menu"
        );
    });

    document.addEventListener("click", (event) => {
        if (!burger.contains(event.target) &&
            !menu.contains(event.target)) {
            fermerMenu();
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            fermerMenu();
        }
    });

    window.matchMedia("(min-width: 1101px)")
        .addEventListener("change", (event) => {
            if (event.matches) fermerMenu();
        });
});
