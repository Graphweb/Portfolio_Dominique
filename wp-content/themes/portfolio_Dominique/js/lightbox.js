document.addEventListener("DOMContentLoaded", function () {
  const lightboxOverlay = document.getElementById("lightbox-overlay");
  const lightboxImage = document.querySelector(".lightbox-image");
  const lightboxTitle = document.querySelector(".lightbox-title");
  const lightboxCategory = document.querySelector(".lightbox-category");
  const closeButton = document.querySelector(".lightbox-close");
  const prevButton = document.querySelector(".lightbox-prev");
  const nextButton = document.querySelector(".lightbox-next");
  let currentProjetIndex = 0;

  // Fonction pour récupérer les projets actuels dans le DOM
  function getProjets() {
    return document.querySelectorAll(".projet-item img");
  }

  // Affiche la lightbox avec le projet donné
  function showLightbox(projet) {
    const originalSrc = projet.src.replace(/-\d+x\d+(.\w+)$/, "$1"); // Remplace les dimensions par l'original
    const category = projet.dataset.category; // Récupère la catégorie
    lightboxOverlay.style.display = "flex"; // Affiche la lightbox
    lightboxImage.src = originalSrc; // Charge l'image originale
    lightboxTitle.textContent = projet.alt || "Projet"; // Définit le titre
    lightboxCategory.textContent = category || ""; // Définit la catégorie
    document.body.classList.add("no-scroll"); // Ajoute la classe pour désactiver le scroll
  }

  // Met à jour la lightbox pour une nouvelle photo
  function updateLightbox() {
    const projets = getProjets(); // Récupère les projets actuels
    const newProjet = projets[currentProjetIndex]; // Projet actuel
    const category = newProjet.dataset.category; // Récupère la catégorie
    const originalSrc = newProjet.src.replace(/-\d+x\d+(.\w+)$/, "$1"); // Remplace les dimensions
    lightboxImage.src = originalSrc; // Charge l'image originale
    lightboxTitle.textContent = newProjet.alt || "Projet"; // Définit le titre
    lightboxCategory.textContent = category || ""; // Définit la catégorie
  }

  // Gestionnaire d'événements délégué pour ouvrir la lightbox
  document.body.addEventListener("click", function (e) {
    const icon = e.target.closest(".icon-lightbox");
    if (icon) {
      e.preventDefault(); // Empêche le comportement par défaut
      const projets = getProjets(); // Récupère les projets actuels
      currentProjetIndex = Array.from(projets).findIndex((projet) =>
        projet.closest(".projet-item").contains(icon)
      ); // Trouve l'index du projet associé
      if (currentProjetIndex !== -1) {
        showLightbox(projets[currentProjetIndex]);
      }
    }
  });

  // Ferme la lightbox
  function closeLightbox() {
    lightboxOverlay.style.display = "none"; // Masque la lightbox
    document.body.classList.remove("no-scroll"); // Retire la classe pour réactiver le scroll
    lightboxImage.src = ""; // Vide l'image
    lightboxTitle.textContent = ""; // Vide le titre
    lightboxCategory.textContent = ""; // Vide la catégorie
  }

  // Bouton de fermeture
  closeButton.addEventListener("click", closeLightbox);

  // Fermeture en cliquant en dehors de l'image
  lightboxOverlay.addEventListener("click", function (e) {
    if (e.target === lightboxOverlay) {
      closeLightbox();
    }
  });

  // Navigation vers la photo précédente
  prevButton.addEventListener("click", function () {
    const projets = getProjets(); // Récupère les projets actuels
    currentProjetIndex = (currentProjetIndex - 1 + projets.length) % projets.length; // Reculer
    updateLightbox();
  });

  // Navigation vers la photo suivante
  nextButton.addEventListener("click", function () {
    const projets = getProjets(); // Récupère les projets actuels
    currentProjetIndex = (currentProjetIndex + 1) % projets.length; // Avancer
    updateLightbox();
  });
});
