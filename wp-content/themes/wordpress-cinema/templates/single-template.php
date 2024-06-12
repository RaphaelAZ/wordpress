<?php get_header(); ?>

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
                        echo the_author();
                        echo(' - '.get_the_date()); 
                    ?></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>