<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
</head>
<body <?php body_class(); ?>>

    <header>
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">Cinéma</a>
            </div>
            <div class="container">
                <div class="collapse navbar-collapse" id="myNavbar">
                    <?php
                        wp_nav_menu( array(
                            'menu' => 'categories',
                            'menu_class' => 'nav navbar-nav',
                            'container' => false
                        ) );
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <p>Main</p>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></p>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
