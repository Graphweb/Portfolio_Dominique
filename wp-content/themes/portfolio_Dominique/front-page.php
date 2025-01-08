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


<?php
if (have_posts()) : while (have_posts()) : the_post();
?>
    <div class="single-projet">
        
        <div class="projet-image">
            <?php 
            if (get_field('image_du_projet')) {
                echo '<img src="' . get_field('image_du_projet') . '" alt="' . get_the_title() . '">';
            }
            ?>
        </div>
        <div class="projet-description">
            <p><?php the_content(); ?></p>
            <h1><?php the_title(); ?></h1>
            <p><strong>Description :</strong> <?php the_field('description'); ?></p>
            <p><strong>Technologies utilisées :</strong> <?php the_field('technologies_utilisees'); ?></p>
            <p><a href="<?php the_field('url_du_projet'); ?>" target="_blank">Voir le projet</a></p>
        </div>
    </div>
<?php
endwhile; endif;
get_footer();
