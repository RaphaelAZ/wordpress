<?php

function init() {
    wp_enqueue_style('custom-style', get_template_directory_uri() . './assets/css/styles.css');

    wp_enqueue_script('custom-js', get_template_directory_uri() . './assets/js/index.js');
    wp_enqueue_script( 'iconify', 'https://code.iconify.design/2/2.2.1/iconify.min.js', array(), '2.2.1', true );

    add_theme_support('title-tag');

    add_theme_support('menus');
    register_nav_menu('header', 'Catégories');
}

add_action('init', 'init');
