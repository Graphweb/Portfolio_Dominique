jQuery(document).ready(function ($) {
    // Vérifie si le bouton existe
    if ($('#load-more-projets').length === 0) {
        return; // Arrête le script si le bouton n'existe pas
    }

    console.log("Bouton trouvé. Initialisation de l'écouteur.");

    // Bouton charger plus
    $('#load-more-projets').on('click', function () {
        console.log("Bouton 'Charger Plus' cliqué.");
        
        var button = $(this);
        var page = button.data('page'); // Récupère la page suivante
        
        // Vérifie si la page est définie
        if (!page) {
            console.error("La donnée 'page' est manquante.");
            return;
        }

        console.log("Envoi d'une requête AJAX pour la page : " + page);

        var data = {
            action: 'load_more_projets', // L'action AJAX
            page: page,
            posts_per_page: 6, // Nombre de projets à charger
        };

        $.ajax({
            url: ajaxurl, // URL pour l'appel AJAX
            type: 'POST',
            data: data,
            beforeSend: function () {
                button.text('Chargement...'); // Change le texte du bouton pendant le chargement
            },
            success: function (response) {
                console.log("Réponse reçue :", response);

                if (response.success) {
                    // Ajoute les nouveaux projets à la galerie
                    $('.projets-gallery').append(response.data);
                    button.text('Charger plus'); // Remet le texte du bouton
                    button.data('page', page + 1); // Met à jour la page pour la prochaine requête
                } else {
                    console.warn("Aucun projet supplémentaire.");
                    button.text('Plus de projets');
                    button.prop('disabled', true);
                }
            },
            error: function (xhr, status, error) {
                console.error("Erreur AJAX :", status, error);
                button.text('Erreur...');
            },
        });
    });
});
