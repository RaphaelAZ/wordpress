<?php get_header(); ?>

<main>
    <div class="container">
        <?php if ( have_posts() ) : ?>
        <div class="articles-list">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="article">
                <div class="body">
                    <div><?php the_content(); ?></div>
                </div>
                <div class="head">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
        <?php else : ?>
            <p>Aucun article trouvé</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>