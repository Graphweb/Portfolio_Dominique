
<div class="related-photo">
    <a href="<?php the_permalink(); ?>">
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
    </a>
</div>