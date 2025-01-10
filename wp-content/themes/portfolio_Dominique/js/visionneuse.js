document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('cv-modal');
    const openModalBtn = document.getElementById('view-cv-btn');
    const closeModalBtn = modal.querySelector('.close-btn');

    // Ouvrir la modale
    openModalBtn.addEventListener('click', function () {
        modal.style.display = 'flex';
    });

    // Fermer la modale
    closeModalBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Fermer la modale en cliquant à l'extérieur du contenu
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
