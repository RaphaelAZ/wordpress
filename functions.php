<?php
function init_custom() {
    wp_enqueue_style('custom-style', get_template_directory_uri() . './assets/css/styles.css');

    wp_enqueue_script('custom-js', get_template_directory_uri() . './assets/js/index.js', array('jquery'), null, true);
}

add_action('init', 'init_custom');
