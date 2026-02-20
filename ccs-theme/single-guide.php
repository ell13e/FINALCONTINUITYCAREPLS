<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <div class="container">

        <?php ccs_breadcrumbs(); ?>

        <article class="guide-page">

            <header class="page-header">
                <h1><?php the_title(); ?></h1>

                <div class="guide-meta">
                    <?php
                    $reading_time = get_post_meta(get_the_ID(), '_ccs_reading_time', true);
                    $last_reviewed = get_post_meta(get_the_ID(), '_ccs_last_reviewed', true);
                    $author_credentials = get_post_meta(get_the_ID(), '_ccs_author_credentials', true);
                    ?>

                    <?php if ($reading_time) : ?>
                        <span class="reading-time"><?php echo absint($reading_time); ?> min read</span>
                    <?php endif; ?>

                    <?php if ($last_reviewed) : ?>
                        <span class="last-reviewed">Last reviewed: <?php echo esc_html(date('F j, Y', strtotime($last_reviewed))); ?></span>
                    <?php endif; ?>

                    <?php if ($author_credentials) : ?>
                        <span class="author-credentials"><?php echo esc_html($author_credentials); ?></span>
                    <?php endif; ?>
                </div>
            </header>

            <div class="guide-sections">

                <?php
                $section_intro = get_post_meta(get_the_ID(), '_ccs_section_intro', true);
                if ($section_intro) :
                ?>
                    <section class="section-intro">
                        <?php echo wp_kses_post(wpautop($section_intro)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_main = get_post_meta(get_the_ID(), '_ccs_section_main', true);
                if ($section_main) :
                ?>
                    <section class="section-main-content">
                        <?php echo wp_kses_post(wpautop($section_main)); ?>
                    </section>
                <?php endif; ?>

                <?php
                $section_takeaways = get_post_meta(get_the_ID(), '_ccs_section_takeaways', true);
                if ($section_takeaways) :
                ?>
                    <aside class="section-takeaways">
                        <h2>Key Takeaways</h2>
                        <?php echo wp_kses_post(wpautop($section_takeaways)); ?>
                    </aside>
                <?php endif; ?>

                <?php
                $section_next_steps = get_post_meta(get_the_ID(), '_ccs_section_next_steps', true);
                if ($section_next_steps) :
                ?>
                    <section class="section-next-steps">
                        <h2>Next Steps</h2>
                        <?php echo wp_kses_post(wpautop($section_next_steps)); ?>
                    </section>
                <?php endif; ?>

            </div>

            <?php
            $faqs = get_post_meta(get_the_ID(), '_ccs_faqs', true);
            if (!empty($faqs) && is_array($faqs)) :
            ?>
                <aside class="guide-faqs">
                    <h2>Frequently Asked Questions</h2>
                    <?php foreach ($faqs as $faq) : ?>
                        <div class="faq-item">
                            <h3><?php echo esc_html($faq['question']); ?></h3>
                            <p><?php echo esc_html($faq['answer']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </aside>
            <?php endif; ?>

            <aside class="page-cta">
                <h3>Need Help?</h3>
                <p>Book a free consultation to discuss your care needs.</p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Book Consultation</a>
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-secondary">Our Services</a>
            </aside>

        </article>

    </div>

<?php endwhile; ?>

<?php get_footer(); ?>
