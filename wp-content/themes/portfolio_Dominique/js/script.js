






jQuery(function ($) { 
    // CONTACT FORM ANIMATIONS
    $('#contact').click(function () {
        $('#contactForm').fadeToggle();
    });

    $(document).mouseup(function (e) {
        var container = $("#contactForm");

        if (!container.is(e.target) // Si la cible du clic n'est pas le container...
            && container.has(e.target).length === 0 // ... ni un descendant du container
        ) {
            container.fadeOut();
        }
    });
});
