<?php
// Charger le style parent et le style enfant
function portfolio_enqueue_styles() {
    wp_enqueue_style('astra-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('portfolio-child-style', get_stylesheet_directory_uri() . '/style.css', array('astra-parent-style'));
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/js/script.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'portfolio_enqueue_styles');


/* ************ ACTIVER LE SUPPORT DU LOGO PERSONNALISÉ ************** */
add_theme_support('custom-logo', array(
    'height'      => 200,
    'width'       => 200,
    'flex-height' => true,
    'flex-width'  => true,
));

/* ********* ENREGISTRER LES MENUS ********** */
register_nav_menus(array(
    'header-menu' => __('Menu Principal'),
    'footer-menu' => __('Menu Footer'),
));

/* ************ HERO AVEC IMAGE ALÉATOIRE ************** */
function get_random_hero_image() {
    $upload_dir = wp_get_upload_dir(); // Récupère le répertoire des uploads
    $base_url = $upload_dir['baseurl']; // URL de base du dossier uploads

    $images = array(
        $base_url . '/2025/01/martin-sanchez-4PDPLw1flgE-unsplash-scaled.jpg',
        $base_url . '/2025/01/florian-olivo-4hbJ-eymZ1o-unsplash-scaled.jpg',
        $base_url . '/2025/01/sameer-ZIUD0FvXI-M-unsplash-scaled.jpg',
        $base_url . '/2025/01/superhero-Header-1920-px.jpg',
    );

    return $images[array_rand($images)];
}


// Enregistrer un template pour les CPT "Projets"
function portfolio_register_templates() {
    if (is_singular('projets')) {
        include get_stylesheet_directory() . '/single-projets.php';
        exit;
    }
}
add_action('template_redirect', 'portfolio_register_templates');