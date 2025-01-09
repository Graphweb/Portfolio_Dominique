<?php
// Charger le style parent et le style enfant
function portfolio_enqueue_styles() {
    wp_enqueue_style('astra-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('portfolio-child-style', get_stylesheet_directory_uri() . '/style.css', array('astra-parent-style'));
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/js/script.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'portfolio_enqueue_styles');

/* ************ LIGHTBOX CSS ET JS ************** */
function enqueue_lightbox_scripts() {
    wp_enqueue_style('lightbox-css', get_stylesheet_directory_uri() . '/css/lightbox.css', array(), '1.0', 'all');
    wp_enqueue_script('lightbox-js', get_stylesheet_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_scripts');

/* ************ ENQUEUE AJAX SCRIPT ************** */
function enqueue_load_more_script() {
    // Charger le script JavaScript
    wp_enqueue_script('load-more-photos', get_stylesheet_directory_uri() . '', array('jquery'), null, true);
    // Localiser le script pour ajouter la variable ajaxurl
    wp_localize_script('load-more-photos', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_script');

/* **************** INCLURE JQUERY DEPUIS WORDPRESS ************* */
function custom_enqueue_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');

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



