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
    add_image_size('films_thumbnail', 300, 200, true);
    add_image_size('single_thumbnail', 500, 350, true);
    
    register_nav_menus(
        array(
            'categories' => __( 'Catégories' )
        )
    );
}

add_action('wp_enqueue_scripts', 'enqueue_custom_styles_and_scripts');
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
