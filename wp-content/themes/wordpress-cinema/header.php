<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="title">
        <span class="iconify-inline" data-icon="arcticons:jiocinema"></span>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">ESGI</a>
    </div>
    <nav class="navbar">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'categories',
            'container'      => false,
            'menu_class'     => 'nav-menu',
            'fallback_cb'    => false
        ) );
        ?>
    </nav>
</header>