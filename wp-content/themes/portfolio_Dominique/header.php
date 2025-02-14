<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <?php wp_head(); ?>
</head>
<body> 
    <div class="bg"></div>
    <div class="bg bg2"></div>
    <div class="bg bg3"></div>
<header>
    <nav>
        <div class="logo">
            <?php the_custom_logo(); ?>
        </div>
            <?php wp_nav_menu( array(
            'theme_location' => 'header-menu',
            'menu_class' => 'menu-links',
            'container_class' => 'menu',
            ) );
            ?>

            <!-- MENU VERSION TELEPHONE -->
            <!-- Icône du menu burger -->
        <button class="burger-menu" id="burgerToggle">
            <span class="burger-line"></span>
            <span class="burger-line"></span>
            <span class="burger-line"></span>
        </button>

        <!-- Menu mobile masqué par défaut -->
        <div class="mobile-menu" id="mobileMenu">
            <ul>
                <li><a href="http://portfolio-dominique.qasu7107.odns.fr/portfolio_db/" id="#mes-projets">Accueil</a></li>
                <li><a href="http://portfolio-dominique.qasu7107.odns.fr/portfolio_db/" id="#about-section">À propos</a></li>
            </ul>
    </nav>
</header>          
