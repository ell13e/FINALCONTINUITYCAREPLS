<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $post_id   = get_the_ID();
    $pricing   = get_post_meta($post_id, '_ccs_pricing_range', true);
    $what_it_is = get_post_meta($post_id, '_ccs_section_what_it_is', true);
    $who_its_for = get_post_meta($post_id, '_ccs_section_who_its_for', true);
    $typical   = get_post_meta($post_id, '_ccs_section_typical_visit', true);
    $scheduling = get_post_meta($post_id, '_ccs_section_scheduling', true);
    $towns     = get_the_terms($post_id, 'town');
?>

    <div class="container single-service">

        <?php ccs_breadcrumbs(); ?>

        <article class="service-page">

            <header class="page-header">
                <h1><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="lead"><?php the_excerpt(); ?></p>
                <?php endif; ?>
                <?php if ($pricing) : ?>
                    <p class="service-pricing"><?php echo esc_html($pricing); ?></p>
                <?php endif; ?>
                <?php if ($towns && ! is_wp_error($towns)) : ?>
                    <p class="service-towns">
                        <?php
                        $names = array_map(function ($t) { return $t->name; }, $towns);
                        echo esc_html(implode(', ', $names));
                        ?>
                    </p>
                <?php endif; ?>
            </header>

            <div class="service-sections">

                <?php if ($what_it_is) : ?>
                    <section class="section-what-it-is">
                        <h2>What It Is</h2>
                        <?php echo wp_kses_post(wpautop($what_it_is)); ?>
                    </section>
                <?php endif; ?>

                <?php if ($who_its_for) : ?>
                    <section class="section-who-its-for">
                        <h2>Who It's For</h2>
                        <?php echo wp_kses_post(wpautop($who_its_for)); ?>
                    </section>
                <?php endif; ?>

                <?php if ($typical) : ?>
                    <section class="section-typical-visit">
                        <h2>Typical Visit</h2>
                        <?php echo wp_kses_post(wpautop($typical)); ?>
                    </section>
                <?php endif; ?>

                <?php if ($scheduling) : ?>
                    <section class="section-scheduling">
                        <h2>Scheduling</h2>
                        <?php echo wp_kses_post(wpautop($scheduling)); ?>
                    </section>
                <?php endif; ?>

            </div>

            <div class="service-ctas">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a free consultation</a>
                <a href="tel:01622809881" class="btn btn-secondary">Call 01622 809881</a>
            </div>

            <nav class="service-links" aria-label="Related pages">
                <a href="<?php echo esc_url(home_url('/how-it-works/')); ?>">How it works</a>
                <a href="<?php echo esc_url(home_url('/team/')); ?>">Our team</a>
                <a href="<?php echo esc_url(home_url('/resources/')); ?>">Resources &amp; FAQs</a>
            </nav>

        </article>

    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
