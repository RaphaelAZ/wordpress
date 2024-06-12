<?php get_header(); ?>

<?php 
$page_author_id = get_post_field( 'post_author', get_the_ID() );
?>

<main>
    <div class="container">
        <div class="single-article">
            <div class="thumbnail">
                <?php the_post_thumbnail('single_thumbnail'); ?>
                <div class="date-note">
                    <!-- <?php the_content(); ?> -->
                </div>
            </div>

            <div class="description">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>

                <div class="author-date">
                    <p><?php 
                        //Fonctions get_the_author() & the_author() -> dépréciées
                        echo get_the_author_meta( 'display_name', $page_author_id );
                        echo(' - '.get_the_date()); 
                    ?></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>