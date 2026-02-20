<?php
/**
 * Template Name: Team Page
 */
get_header();
?>

<div class="container">

    <?php ccs_breadcrumbs(); ?>

    <article class="team-page">

        <header class="page-header">
            <h1>Who You'll Meet</h1>
            <p class="lead">These are the people who actually visit. We employ all our carers directly — we don't use agency staff.</p>
        </header>

        <section class="what-we-look-for section">
            <h2>What We Look For</h2>
            <div class="look-for-cards cards-grid">
                <div class="card look-for-card">
                    <h3>You Don't Need Experience</h3>
                    <p>We train from scratch. If you're kind, willing to learn, and want to make a real difference, we'll support you with induction and ongoing training.</p>
                </div>
                <div class="card look-for-card">
                    <h3>You Need to Give a Damn</h3>
                    <p>Care only works when it's consistent and respectful. We want people who show up, listen, and treat every client like a person — not a task.</p>
                </div>
                <div class="card look-for-card">
                    <h3>You Need to Be Reliable</h3>
                    <p>Our clients depend on us. Turning up on time, every time, and communicating if something changes is non-negotiable.</p>
                </div>
            </div>
        </section>

        <?php
        $team_members = get_posts(array(
            'post_type'      => 'team',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC'
        ));

        if (!empty($team_members)) :
        ?>
            <div class="team-grid">
                <?php foreach ($team_members as $member) :
                    $first_name = get_post_meta($member->ID, '_ccs_first_name', true);
                    $role = get_post_meta($member->ID, '_ccs_role', true);
                    $tenure = get_post_meta($member->ID, '_ccs_tenure_years', true);
                    $qualifications = get_post_meta($member->ID, '_ccs_qualifications', true);
                    $specialisms = get_post_meta($member->ID, '_ccs_specialisms', true);
                    $towns = wp_get_post_terms($member->ID, 'town', array('fields' => 'names'));
                ?>
                    <div class="team-member">
                        <?php if (has_post_thumbnail($member->ID)) : ?>
                            <div class="team-photo">
                                <?php echo get_the_post_thumbnail($member->ID, 'medium'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="team-info">
                            <h3><?php echo esc_html($first_name ? $first_name : $member->post_title); ?></h3>

                            <?php if ($role) : ?>
                                <p class="team-role"><?php echo esc_html($role); ?></p>
                            <?php endif; ?>

                            <?php if ($tenure) : ?>
                                <p class="team-tenure"><?php echo esc_html($tenure); ?> years with CCS</p>
                            <?php endif; ?>

                            <?php if (!empty($towns) && !is_wp_error($towns)) : ?>
                                <p class="team-areas">Covers: <?php echo esc_html(implode(', ', $towns)); ?></p>
                            <?php endif; ?>

                            <?php if ($qualifications) : ?>
                                <p class="team-quals"><?php echo esc_html($qualifications); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($specialisms) && is_array($specialisms)) : ?>
                                <p class="team-specialisms">
                                    <strong>Specialisms:</strong> <?php echo esc_html(implode(', ', $specialisms)); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($member->post_content) : ?>
                                <div class="team-bio">
                                    <?php echo wp_kses_post(wpautop($member->post_content)); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Team member profiles coming soon.</p>
        <?php endif; ?>

        <aside class="page-cta">
            <h3>Want to Join the Team?</h3>
            <a href="<?php echo esc_url(home_url('/careers')); ?>" class="btn btn-primary">View Careers</a>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-secondary">Get in Touch</a>
        </aside>

    </article>

</div>

<?php get_footer(); ?>
