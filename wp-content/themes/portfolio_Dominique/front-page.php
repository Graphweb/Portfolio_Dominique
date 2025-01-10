<?php
get_header();
?>
<!-- // Ajouter le Hero Banner // -->

<section class="hero-banner " style="background-image: url('<?php echo get_random_hero_image(); ?>');">
   
        <div class="hero-content">
            <h1>Gr@ph'Web
            <span>Développeur</span>
            <span>WordPress</span>
            <span>Designer UI</span>
            </h1>
        </div>
   
</section>

<section id="about-section" class="about-section">
    <div class="about-container">
        <!-- Colonne image -->
        <div class="about-image">
            <img src="wp-content\themes\portfolio_Dominique\images\moi-1.jpg" alt="À propos de moi">
        </div>
        
        <!-- Colonne texte -->
        <div class="about-content">
            <h2>À propos de moi</h2>
            <p>
            Diplômée d'un BEP Couture Flou des Industries Connexes et d'une mention complémentaire, j'ai eu envie d'une reconversion professionnelle et je me décide après la crise COVID-19, de changer de toile fillaire à celle du numérique.
            Je suis une personne très assidue et apprendre de nouvelles choses me passionne. J'ai découvert le graphisme et la suite ADOBE que j'adore et me perfectionne au fil du temps ! Je suis actuellement en formation de "Concepteur Designer UI" afin d'obtenir le Titre Professionnel.
            En dehors du cadre professionnel, je suis une addict de cinéma, j'aime jouer avec mes chiens, aller à la plage, aller en montagne et se ressourcer en pleine nature.
            </p>
            <button id="view-cv-btn" class="btn">Voir mon CV</button>
        </div>
    </div>

    <!-- Visionneuse modale pour le CV -->
    <div id="cv-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <iframe src="wp-content\themes\portfolio_Dominique\pdf\CV cdui.pdf" frameborder="0"></iframe>
        </div>
    </div>
</section>


<?php
// Boucle pour afficher les projets //
$args = array(
    'post_type'      => 'projets',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => 1,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div class="projets-gallery">';
    while ($query->have_posts()) : $query->the_post(); 
        $categories = get_the_terms(get_the_ID(), 'categorie'); // Récupère les catégories
        $technologies = get_field('technologies_utilisees');   // Champ personnalisé (ACF)
        $url_projet = get_field('url_du_projet');              // Champ personnalisé (ACF)
        $description = get_field('description');              // Champ personnalisé (ACF)

        // Vérification de l'erreur pour les catégories
        if (!is_wp_error($categories) && !empty($categories)) {
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
                         <!-- Icône pour aller à la page single-photo.php -->
                         <a href="<?php the_permalink(); ?>" class="icon icon-view" aria-label="Voir la page">
                            <i class="fas fa-eye"></i>
                        </a>
                        <!-- Icône pour ouvrir la lightbox -->
                        <a href="#" class="icon icon-lightbox" data-photo-id="<?php echo get_the_ID(); ?>" aria-label="Voir dans la lightbox">
                            <i class="fas fa-expand"></i>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    <?php endwhile;
    echo '</div>';
    echo '<button id="load-more-projets" data-page="2">Charger plus</button>';
    wp_reset_postdata();
else :
    echo '<p>Aucun projet trouvé.</p>';
endif;

get_footer();
