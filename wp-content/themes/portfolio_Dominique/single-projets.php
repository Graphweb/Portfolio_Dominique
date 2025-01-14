<?php get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

<article class="post">
    
    
    <div class="photo-meta">
    <h1><?php the_title(); ?></h1>
    

    <?php 
    
    // Afficher les catégories
    if ($categories = get_the_terms(get_the_ID(), 'categorie')) {
        echo '<p><strong>Catégorie :</strong> ';
        echo implode(', ', wp_list_pluck($categories, 'name'));
        echo '</p>';
    }

    // Afficher l'URL du projet
    if (function_exists('get_field') && $url_du_projet = get_field('url_du_projet')) {
        echo '<p><strong>URL du projet :</strong> <a href="' . esc_url($url_du_projet) . '" target="_blank">' . esc_url($url_du_projet) . '</a></p>';
    }

    // Afficher la description
    if (function_exists('get_field') && $description = get_field('description')) {
        echo '<p><strong>Description :</strong> ' . esc_html($description) . '</p>';
    }

    // Afficher les technologies utilisées
    if (function_exists('get_field') && $technologies = get_field('technologies_utilisees')) {
        echo '<p><strong>Technologies utilisées :</strong> ' . esc_html($technologies) . '</p>';
    }
    // Afficher l'année
    echo '<p><strong>Année :</strong> ' . get_the_date('Y') . '</p>';
?>

<!-- Afficher la photo -->
<div class="photo-image">
    <?php 
    if (has_post_thumbnail()) {
        the_post_thumbnail('original', ['class' => 'photo-display']);
    } 
    ?>
</div>

    </div>
</article>
<section class="pagination-btn">
    <div class="info">
        <p>Un projet en tête ?</p>
    </div>
    <div class="contact-button" id="contact">Contact</div>

    <div class="contact-form-container" id="contactFormContainer">
        <h2>Un café s'il te plaît !</h2>
        <small>Venez discuter de votre projet !</small>
        <form id="contactForm" method="post">
            <input placeholder="Nom" type="text" name="name" required />
            <input placeholder="Email" type="email" name="email" required />
            <textarea placeholder="Message" name="message" required></textarea>
            <button class="contact-form-button" type="submit">Envoyer</button>
        </form>
    </div>
</section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>


