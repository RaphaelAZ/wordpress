<?php

function enqueue_custom_styles_and_scripts() {
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/styles.css');
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/index.js');
    wp_enqueue_script('iconify', 'https://code.iconify.design/2/2.2.1/iconify.min.js', array(), '2.2.1', true);

    if (is_category()) {
        $category = get_queried_object();
        $category_slug = $category->slug;
        
        $style_path = get_template_directory_uri() . "/assets/css/categories/{$category_slug}-style.css";
        
        if (file_exists(get_template_directory() . "/assets/css/categories/{$category_slug}-style.css")) {
            wp_enqueue_style("category-style-{$category_slug}", $style_path);
        }
    }
}

function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('menus');

    add_theme_support('post-thumbnails');
    add_image_size('films_thumbnail', 300, 200, false);
    add_image_size('single_thumbnail', 500, 350, false);
    
    register_nav_menus(
        array(
            'categories' => __( 'Catégories' )
        )
    );
}

function my_custom_footer() {
    wp_enqueue_style('custom-footer', get_template_directory_uri() . './assets/css/footer.css');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_styles_and_scripts');
add_action('wp_footer', 'my_custom_footer');
add_action('after_setup_theme', 'theme_setup');

function custom_single_template($template) {
    if (is_single()) {
        $new_template = locate_template(array('./templates/single-template.php'));
        if ('' != $new_template) {
            wp_enqueue_style('custom-style', get_template_directory_uri() . './assets/css/templates/single.css');
            return $new_template;
        }
    }
    return $template;
}

add_filter('template_include', 'custom_single_template');

// Fonction pour récupérer et afficher les horaires
function afficher_horaires_article_shortcode($atts) {
    $atts = shortcode_atts(array(
        'film' => '',
    ), $atts);

    global $wpdb;
    $table_name = $wpdb->prefix . 'showtime';

    $query = "SELECT * FROM $table_name";
    if (!empty($atts['film'])) {
        $film_name = sanitize_text_field($atts['film']);
        $query .= $wpdb->prepare(" WHERE film = %s", $film_name);
    }

    $horaires = $wpdb->get_results($query, ARRAY_A);

    $output = '<div class="horaires-list">
    <h3>Prochaines diffusions</h3>
    <ul>';
    foreach ($horaires as $horaire) {
        $output .= '<li>' . esc_html($horaire['showtime']) . '</li>';
    }
    $output .= '</ul>
    </div>';

    return $output;
}
add_shortcode('afficher_horaires', 'afficher_horaires_article_shortcode');
