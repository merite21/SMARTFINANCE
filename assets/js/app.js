document.addEventListener("DOMContentLoaded", function () {

    /* -------------------------------------------------
       1) Apparition en douceur des cartes au défilement
    ------------------------------------------------- */
    const elementsAnimes = document.querySelectorAll(
        ".card, .stat-card, .dashboard-card, .hero h1, .hero p"
    );

    elementsAnimes.forEach(function (el) {
        el.classList.add("sf-reveal");
    });

    const observateur = new IntersectionObserver(function (entrees) {
        entrees.forEach(function (entree) {
            if (entree.isIntersecting) {
                entree.target.classList.add("sf-reveal-visible");
                observateur.unobserve(entree.target);
            }
        });
    }, { threshold: 0.1 });

    elementsAnimes.forEach(function (el) {
        observateur.observe(el);
    });


    /* -------------------------------------------------
       2) Compteurs animés (ex: statistiques du dashboard)
    ------------------------------------------------- */
    const compteurs = document.querySelectorAll("[data-count]");

    compteurs.forEach(function (compteur) {
        const cible = parseInt(compteur.getAttribute("data-count"), 10) || 0;
        const duree = 900;
        const depart = performance.now();

        function animer(maintenant) {
            const progression = Math.min((maintenant - depart) / duree, 1);
            const valeur = Math.round(progression * cible);
            compteur.textContent = valeur.toLocaleString("fr-FR");

            if (progression < 1) {
                requestAnimationFrame(animer);
            }
        }

        requestAnimationFrame(animer);
    });


    /* -------------------------------------------------
       3) Alertes qui se ferment automatiquement
    ------------------------------------------------- */
    document.querySelectorAll(".alert").forEach(function (alerte) {
        setTimeout(function () {
            alerte.classList.add("sf-fade-out");
            setTimeout(function () {
                alerte.remove();
            }, 500);
        }, 5000);
    });

});
