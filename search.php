<?php get_header(); ?>

<div class="search-results-page">
    <h1>Результаты поиска для: "<?php echo get_search_query(); ?>"</h1>

    <?php if (have_posts()) : ?>
        <ul>
            <?php while (have_posts()) : the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endwhile; ?>
        </ul>

        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <p>Ничего не найдено. Попробуйте другой запрос.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
