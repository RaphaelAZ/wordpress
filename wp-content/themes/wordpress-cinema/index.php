<?php get_header(); ?>

<main>
    <div class="container">
        <h1>
        <?php if(is_category()) {
            $category = get_queried_object();
            echo $category->name;
        } else { ?>Tous les films<?php } ?>
        </h1>
        <?php if ( have_posts() ) : ?>
        <div class="articles-list">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="article">
                <div class="body">
                    <?php the_post_thumbnail('films_thumbnail'); ?>
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