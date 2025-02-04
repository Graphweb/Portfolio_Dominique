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

/* ************ VISSIONNEUSE CSS ET JS ************** */
function enqueue_visionneuse_scripts() {
    wp_enqueue_style('visionneuse-css', get_stylesheet_directory_uri() . '/css/visionneuse.css', array(), '1.0', 'all');
    wp_enqueue_script('visionneuse-js', get_stylesheet_directory_uri() . '/js/visionneuse.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_visionneuse_scripts');

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

/**************************** ACF ************************************************* */
// Enregistrer un template pour les CPT "Projets"
function portfolio_register_templates() {
    if (is_singular('projets')) {
        include get_stylesheet_directory() . '/single-projets.php';
        exit;
    }
}
add_action('template_redirect', 'portfolio_register_templates');

/**************** CHARGER PLUS *****************/
function load_more_projets() {
    if (!isset($_POST['page']) || !isset($_POST['posts_per_page'])) {
        wp_send_json_error(['message' => 'Paramètres manquants.']);
    }

    $page = intval($_POST['page']);
    $posts_per_page = intval($_POST['posts_per_page']);

    $args = array(
        'post_type'      => 'projets', 
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        ob_start();
        while ($query->have_posts()) : $query->the_post();

            // Récupérer les catégories associées
            $categories = get_the_terms(get_the_ID(), 'categorie'); // Changez 'category' si nécessaire
            if (!empty($categories) && !is_wp_error($categories)) {
                $category_name = esc_html($categories[0]->name);
            } else {
                $category_name = 'Non catégorisé';
            }
            ?>
            <article class="projet-item">
                <div class="projet-wrapper">
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('original', [
                            'class' => 'projet-thumbnail',
                            'alt'   => esc_attr(get_the_title()),
                            'data-category' => $category_name,
                        ]);
                    } else {
                        echo '<img src="' . get_stylesheet_directory_uri() . '/Images/placeholder.jpg" alt="Image non disponible" class="projet-thumbnail" data-category="' . $category_name . '">';
                    }
                    ?>
                    <div class="projet-overlay">
                        <div class="projet-info">
                            <h3 class="projet-title"><?php the_title(); ?></h3>
                            <p class="projet-category"><?php echo $category_name; ?></p>
                        </div>
                        <div class="projet-icons">
                            <a href="<?php the_permalink(); ?>" class="icon icon-view" aria-label="Voir la page">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="icon icon-lightbox" data-photo-id="<?php echo get_the_ID(); ?>" aria-label="Voir dans la lightbox">
                                <i class="fas fa-expand"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            <?php
        endwhile;
        $content = ob_get_clean();
        wp_send_json_success($content);
    else :
        wp_send_json_error(['message' => 'Aucun projet trouvé.']);
    endif;

    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_load_more_projets', 'load_more_projets');
add_action('wp_ajax_nopriv_load_more_projets', 'load_more_projets');


/*************************************************** */
function enqueue_load_more_script() {
    // Charger le script JavaScript
    wp_enqueue_script('load-more-projets', get_stylesheet_directory_uri() . '/js/load-more-projets.js', array('jquery'), null, true); // Nom plus approprié

    // Localiser le script pour ajouter la variable ajaxurl
    wp_localize_script('load-more-projets', 'ajaxurl', admin_url('admin-ajax.php')); // Utiliser le même nom de script
}
add_action('wp_enqueue_scripts', 'enqueue_load_more_script');


/********************* FORMULAIRE CONTACTE *************************/

// Fonction pour gérer l'envoi de l'email
function send_contact_email() {
    if (!isset($_POST['formData'])) {
        wp_send_json_error(['message' => 'Données manquantes.']);
    }

    $formData = $_POST['formData'];
    $name = sanitize_text_field($formData['name']);
    $email = sanitize_email($formData['email']);
    $message = sanitize_textarea_field($formData['message']);
    $recaptcha = $formData['recaptcha'];

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error(['message' => 'Tous les champs sont obligatoires.']);
    }
     // Vérification du token reCAPTCHA
     $response = wp_remote_post("https://www.google.com/recaptcha/api/siteverify", [
        'body' => [
            'secret' => RECAPTCHA_SECRET_KEY,
            'response' => $recaptcha,
        ]
    ]);

    $responseBody = wp_remote_retrieve_body($response);
    $result = json_decode($responseBody, true);

    if (!$result['success'] || $result['score'] < 0.5) {
        wp_send_json_error(['message' => 'Vérification reCAPTCHA échouée.']);
    }

    $admin_email = get_option('admin_email');
    $subject = "Nouveau message de contact";
    $body = "Nom : $name\nEmail : $email\nMessage :\n$message";
    $headers = ['Content-Type: text/plain; charset=UTF-8', "Reply-To: $email"];

    if (wp_mail($admin_email, $subject, $body, $headers)) {
        wp_send_json_success(['message' => 'Email envoyé avec succès !']);
    } else {
        wp_send_json_error(['message' => "Impossible d'envoyer l'email."]);
    }

    wp_die();
}

// Ajout des actions AJAX
add_action('wp_ajax_send_contact_email', 'send_contact_email');
add_action('wp_ajax_nopriv_send_contact_email', 'send_contact_email');

// Test de wp_mail()
// add_action('wp_footer', function () {
//     $admin_email = get_option('admin_email');
//     $test = wp_mail($admin_email, 'Test Email', 'Ceci est un test de wp_mail()');

//     if ($test) {
//         echo '<script>console.log("✅ Email de test envoyé avec succès.");</script>';
//     } else {
//         echo '<script>console.log("❌ Échec de l\'envoi de l\'email.");</script>';
//     }
// });





function enqueue_custom_scripts() {
    wp_enqueue_script('jquery');
    wp_localize_script('jquery', 'ajax_object', ['ajax_url' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
