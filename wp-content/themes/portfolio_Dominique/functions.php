<?php
// Charger le style parent et le style enfant
function portfolio_enqueue_styles() {
    wp_enqueue_style('astra-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('portfolio-child-style', get_stylesheet_directory_uri() . '/style.css', array('astra-parent-style'));
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/js/script.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'portfolio_enqueue_styles');