<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <div class="container">

        <?php ccs_breadcrumbs(); ?>

        <article class="process-page">

            <header class="page-header">
                <?php
                $step_number = get_post_meta(get_the_ID(), '_ccs_step_number', true);
                if ($step_number) :
                ?>
                    <span class="step-number">Step <?php echo absint($step_number); ?></span>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>

                <?php
                $duration = get_post_meta(get_the_ID(), '_ccs_duration', true);
                if ($duration) :
                ?>
                    <p class="duration"><?php echo esc_html($duration); ?></p>
                <?php endif; ?>
            </header>

            <div class="process-sections">

                <?php
                $section_overview = get_post_meta(get_the_ID(), '_ccs_section_overview', true);
                if ($section_overview) :
                ?>
                    <section class="section-overview">
                        <?php echo wp_kses_post(wpautop($section_overview)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_what_happens = get_post_meta(get_the_ID(), '_ccs_section_what_happens', true);
                if ($section_what_happens) :
                ?>
                    <section class="section-what-happens">
                        <h2>What Happens</h2>
                        <?php echo wp_kses_post(wpautop($section_what_happens)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_what_you_need = get_post_meta(get_the_ID(), '_ccs_section_what_you_need', true);
                if ($section_what_you_need) :
                ?>
                    <section class="section-what-you-need">
                        <h2>What You Need to Prepare</h2>
                        <?php echo wp_kses_post(wpautop($section_what_you_need)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_how_long = get_post_meta(get_the_ID(), '_ccs_section_how_long', true);
                if ($section_how_long) :
                ?>
                    <section class="section-how-long">
                        <h2>How Long It Takes</h2>
                        <?php echo wp_kses_post(wpautop($section_how_long)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_what_next = get_post_meta(get_the_ID(), '_ccs_section_what_next', true);
                if ($section_what_next) :
                ?>
                    <section class="section-what-next">
                        <h2>What Happens Next</h2>
                        <?php echo wp_kses_post(wpautop($section_what_next)); ?>
                    </section>
                <?php endif; ?>

            </div>

            <aside class="page-cta">
                <h3>Ready to Get Started?</h3>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Book Free Consultation</a>
                <a href="<?php echo esc_url(home_url('/how-it-works')); ?>" class="btn btn-secondary">See Full Process</a>
            </aside>

        </article>

    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
