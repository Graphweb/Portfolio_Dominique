
<footer>
    <?php wp_nav_menu( array(
        'theme_location' => 'footer_menu',
        'menu_class' => 'footer-links',
        'container' => 'null',
    ) );
    ?>
<!-- Lightbox HTML -->
<div id="lightbox-overlay">
  <div class="lightbox-content">
    <!-- Bouton précédente -->
    <button class="lightbox-prev">
      <span class="arrow"></span>
      <span class="text"></span>
    </button>
    <!-- Image affichée -->
    <img class="lightbox-image" src="" alt="">
    <!-- Informations sur l'image -->
    <div class="lightbox-info">
      <h3 class="lightbox-title"></h3>
      <span class="lightbox-category"></span>
    </div>
    <!-- Bouton suivante -->
    <button class="lightbox-next">
    <span class="text"></span>
      <span class="arrow"></span>
    </button>
  </div>
  <span class="lightbox-close">&times;</span>
</div>


<?php wp_footer(); ?>
</footer>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=6Lc2pMwqAAAAAHbk-fAO6GkopRxMy-2f3OX83Pus"></script>
</body>
</html>