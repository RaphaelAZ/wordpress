<?php
get_header();
?>

<main id="main" class="site-main" role="main">
    <div class="container">
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                the_title('<h2>', '</h2>');
                the_content();
            endwhile;
        else :
            echo '<p>Aucun article trouvé.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</main>

<?php
get_footer();
?>