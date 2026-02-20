<?php get_header(); ?>

<?php while (have_posts()) : the_post();
    $location_type = get_post_meta(get_the_ID(), '_ccs_location_type', true);
    $is_county = ($location_type === 'County');
?>

    <div class="container">

        <?php ccs_breadcrumbs(); ?>

        <article class="location-page location-type-<?php echo esc_attr(strtolower($location_type)); ?>">

            <header class="page-header">
                <h1><?php if ($is_county) : ?>Home Care Across <?php endif; ?><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="lead"><?php the_excerpt(); ?></p>
                <?php endif; ?>
            </header>

            <?php
            $show_map = get_post_meta(get_the_ID(), '_ccs_show_map', true);
            $map_embed = get_post_meta(get_the_ID(), '_ccs_map_embed', true);
            if ($show_map && $map_embed) :
            ?>
                <div class="location-map">
                    <?php echo wp_kses_post($map_embed); ?>
                </div>
            <?php endif; ?>

            <div class="location-sections">

                <?php
                $section_intro = get_post_meta(get_the_ID(), '_ccs_section_intro', true);
                if ($section_intro) :
                ?>
                    <section class="section-intro">
                        <?php echo wp_kses_post(wpautop($section_intro)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_areas_covered = get_post_meta(get_the_ID(), '_ccs_section_areas_covered', true);
                if ($section_areas_covered) :
                ?>
                    <section class="section-areas-covered">
                        <h2>Areas We Cover</h2>
                        <?php echo wp_kses_post(wpautop($section_areas_covered)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_services = get_post_meta(get_the_ID(), '_ccs_section_services', true);
                if ($section_services) :
                ?>
                    <section class="section-services-available">
                        <h2>Services Available<?php if (!$is_county) : ?> in <?php the_title(); ?><?php endif; ?></h2>
                        <?php echo wp_kses_post(wpautop($section_services)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_local_context = get_post_meta(get_the_ID(), '_ccs_section_local_context', true);
                if ($section_local_context) :
                ?>
                    <section class="section-local-context">
                        <h2>Local Information</h2>
                        <?php echo wp_kses_post(wpautop($section_local_context)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_why_local = get_post_meta(get_the_ID(), '_ccs_section_why_local', true);
                if ($section_why_local) :
                ?>
                    <section class="section-why-local">
                        <h2>Why Choose Local Care</h2>
                        <?php echo wp_kses_post(wpautop($section_why_local)); ?>
                    </section>
                <?php endif; ?>

            </div>

            <?php if ($is_county) : ?>
                <?php
                $child_locations = get_posts(array(
                    'post_type'      => 'location',
                    'posts_per_page' => -1,
                    'post_parent'   => get_the_ID(),
                    'orderby'       => 'title',
                    'order'         => 'ASC'
                ));

                if (!empty($child_locations)) :
                ?>
                    <aside class="child-locations">
                        <h2>Towns We Serve in Kent</h2>
                        <ul class="towns-grid">
                            <?php foreach ($child_locations as $location) : ?>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink($location->ID)); ?>">
                                        <?php echo esc_html($location->post_title); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            <?php endif; ?>

            <aside class="page-cta">
                <h3>Get Started in <?php the_title(); ?></h3>
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-primary">Our Services</a>
                <a href="<?php echo esc_url(home_url('/pricing')); ?>" class="btn btn-secondary">See Pricing</a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-tertiary">Book Free Consultation</a>
            </aside>

        </article>

    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
