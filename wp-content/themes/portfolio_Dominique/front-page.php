<?php
get_header();
?>

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
            <img src="wp-content/themes/portfolio_Dominique/images/moi-1.jpg" alt="À propos de moi">
        </div>
        
        <!-- Colonne texte -->
        <div class="about-content">
            <h2>À propos de moi</h2>
            <p>
            Diplômée d'un BEP Couture Flou des Industries Connexes et d'une mention complémentaire, j'ai entrepris une reconversion professionnelle après la crise COVID-19 pour passer de la création textile à l'univers numérique.<br><br>
            Passionnée, curieuse et déterminée, j'ai découvert le graphisme et la suite ADOBE, qui m'ont immédiatement captivée. Depuis, je perfectionne mes compétences et explore de nouvelles opportunités dans le domaine numérique.<br>
            Après avoir obtenu mon diplôme de Concepteur Designer UI et validé un Titre Professionnel, je poursuis actuellement une formation de Développeur WordPress chez OpenClassrooms, dans le but de compléter mon expertise technique et d'acquérir un nouveau Titre Professionnel.
            Cette double compétence en design UI et développement WordPress me permet d'allier créativité et technique.<br>Je suis capable de concevoir des interfaces utilisateur esthétiques et ergonomiques tout en les rendant fonctionnelles grâce à une maîtrise approfondie de WordPress. Mon objectif est de proposer des solutions adaptées aux besoins des clients, tout en garantissant une expérience utilisateur optimale.            
            </p>
            <button id="view-cv-btn" class="btn">Voir mon CV</button>
        </div>
    </div>

    <!-- Visionneuse modale pour le CV -->
    <div id="cv-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn2">&times;</span>
            <iframe src="wp-content/themes/portfolio_Dominique/pdf/CV%20cdui.pdf" frameborder="0"></iframe>
        </div>
    </div>
</section>


<section>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\180px-Jquery-logo.png" alt="Jquery"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\GitHub_Invertocat_Logo.svg.png" alt="GitHub"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\HTML5_logo_and_wordmark.svg.png" alt="HTML5"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\Javascript-736400_960_720.png" alt="Javascript"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\MySQL.svg.png" alt="MySQL"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\Node.js_logo.svg.png" alt="Node.js"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\Official_CSS_Logo.svg.png" alt="Official_CSS"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\PHP-logo.svg.png" alt="PHP-logo"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\PhpMyAdmin_logo.png" alt="PhpMyAdmin"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\Sass_Logo_Color.svg.png" alt="Sass"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\Visual_Studio_Code_1.35_icon.svg.png" alt="Visual_Studio_Code"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\WordPress_logo.svg.png" alt="WordPress"></div>
            <div class="swiper-slide"><img src="wp-content\themes\portfolio_Dominique\images\swiper-logo.svg" alt="swiper"></div>
        </div>
    </div>
</section>

<section id="mes-projets" class="mes-projet">
    <h2>Mes projets</h2>
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
