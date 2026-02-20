<?php
/**
 * Main template. Standard loop.
 */
get_header();
?>

<div class="container">

    <?php ccs_breadcrumbs(); ?>

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>

        <?php endwhile; ?>

    <?php else : ?>

        <p>No content found.</p>

    <?php endif; ?>

</div>

<?php get_footer(); ?>
