/********** FORMULAIRE CONTACT **********/

jQuery(function ($) {
    var ajaxUrl = ajax_object.ajax_url;

    // Affichage/masquage du formulaire
    $('#contact').click(function () {
        $('#contactFormContainer').fadeToggle();
    });

    // Masquer le formulaire si on clique en dehors
    $(document).mouseup(function (e) {
        var container = $("#contactFormContainer");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.fadeOut();
        }
    });

    // Gestion de la soumission du formulaire avec Ajax
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();

        const formData = {
            name: $('input[name="name"]').val(),
            email: $('input[name="email"]').val(),
            message: $('textarea[name="message"]').val(),
        };

        $.ajax({
            url: ajaxUrl,
            type: "POST",
            data: {
                action: "send_contact_email",
                formData: formData,
            },
            success: function (response) {
                if (response.success) {
                    alert("Message envoyé avec succès !");
                    $('#contactForm')[0].reset();
                    $('#contactFormContainer').fadeOut();
                } else {
                    alert("Erreur : " + response.data.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX Error: " + textStatus, errorThrown);
                alert("Une erreur est survenue. Veuillez réessayer.");
            }
        });
    });
});


/************************* BANDE LOGO *************************************/
document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.swiper-container', {
        loop: true,
        slidesPerView: 10, // Réduit le nombre de diapositives visibles en même temps
        slidesPerGroup: 1, // Réduit le nombre de diapositives défilant en même temps
        autoplay: {
            delay: 2000,
            reverseDirection: true,
        },
    });
    });



/* ***************** MENU BURGER ******************* */
document.addEventListener('DOMContentLoaded', () => {
    const burgerToggle = document.getElementById('burgerToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const body = document.body;

    // Vérifiez si les éléments existent pour éviter les erreurs
    if (burgerToggle && mobileMenu) {
        burgerToggle.addEventListener('click', () => {
            burgerToggle.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            body.classList.toggle('no-scroll');
        });
    }
});
