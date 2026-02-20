<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <div class="container">

        <?php ccs_breadcrumbs(); ?>

        <article class="condition-page">

            <header class="page-header">
                <h1><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="lead"><?php the_excerpt(); ?></p>
                <?php endif; ?>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="condition-sections">

                <?php
                $section_what_it_is = get_post_meta(get_the_ID(), '_ccs_section_what_it_is', true);
                if ($section_what_it_is) :
                ?>
                    <section class="section-what-it-is">
                        <h2>What It Is</h2>
                        <?php echo wp_kses_post(wpautop($section_what_it_is)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_progression = get_post_meta(get_the_ID(), '_ccs_section_progression', true);
                if ($section_progression) :
                ?>
                    <section class="section-progression">
                        <h2>How It Progresses</h2>
                        <?php echo wp_kses_post(wpautop($section_progression)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_daily_life = get_post_meta(get_the_ID(), '_ccs_section_daily_life', true);
                if ($section_daily_life) :
                ?>
                    <section class="section-daily-life">
                        <h2>Living with <?php the_title(); ?></h2>
                        <?php echo wp_kses_post(wpautop($section_daily_life)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_how_care_helps = get_post_meta(get_the_ID(), '_ccs_section_how_care_helps', true);
                if ($section_how_care_helps) :
                ?>
                    <section class="section-how-care-helps">
                        <h2>How Home Care Helps</h2>
                        <?php echo wp_kses_post(wpautop($section_how_care_helps)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_our_approach = get_post_meta(get_the_ID(), '_ccs_section_our_approach', true);
                if ($section_our_approach) :
                ?>
                    <section class="section-our-approach">
                        <h2>Our Approach</h2>
                        <?php echo wp_kses_post(wpautop($section_our_approach)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_training = get_post_meta(get_the_ID(), '_ccs_section_training', true);
                if ($section_training) :
                ?>
                    <section class="section-training">
                        <h2>Training Our Carers Receive</h2>
                        <?php echo wp_kses_post(wpautop($section_training)); ?>
                    </section>
                <?php endif; ?>

            </div>

            <?php
            $resources = get_post_meta(get_the_ID(), '_ccs_external_resources', true);
            if (!empty($resources) && is_array($resources)) :
            ?>
                <aside class="external-resources">
                    <h3>Further Information</h3>
                    <ul>
                        <?php foreach ($resources as $resource) : ?>
                            <li>
                                <a href="<?php echo esc_url($resource['url']); ?>" target="_blank" rel="noopener">
                                    <?php echo esc_html($resource['text']); ?>
                                </a>
                                <?php if (!empty($resource['org'])) : ?>
                                    <span class="org-name">(<?php echo esc_html($resource['org']); ?>)</span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            <?php endif; ?>

            <aside class="page-cta">
                <h3>Need Support with <?php the_title(); ?>?</h3>
                <p>See how our care services can help.</p>
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-primary">Our Services</a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-secondary">Book Consultation</a>
            </aside>

        </article>

    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
