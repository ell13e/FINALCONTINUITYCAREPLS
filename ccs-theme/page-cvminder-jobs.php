<?php
/**
 * Template Name: CV Minder — Jobs
 *
 * Careers jobs page: CV Minder job portal iframe (when enabled in Customizer)
 * or fallback CTA to contact. Assign to a Page with slug e.g. "jobs" under parent "careers".
 */
get_header();

$use_cvminder = get_theme_mod( 'ccs_use_cvminder', false );
$cvminder_url = get_theme_mod( 'ccs_cvminder_url', 'https://cvminder.com/jobportal/index.php?gid=60&pk=2347289374823605326759060200713' );
$contact_url  = home_url( '/contact-us/' );
?>

<div class="container">
    <?php ccs_breadcrumbs(); ?>

    <article class="page cvminder-jobs-page">
        <header class="page-header">
            <h1><?php the_title(); ?></h1>
        </header>

        <?php if ( get_the_content() ) : ?>
            <div class="page-content">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>

        <?php if ( $use_cvminder && $cvminder_url ) : ?>
            <?php // CV Minder: software we use to display our active job advertisements; structure/CSS per official embed. ?>
            <div id="cvm_content">
                <iframe
                    id="cvm_jobframe"
                    name="cvm_jobframe"
                    src="<?php echo esc_url( $cvminder_url ); ?>"
                    allowtransparency="true"
                    frameborder="0"
                    marginwidth="0"
                    marginheight="0"
                    scrolling="auto"
                    title="<?php esc_attr_e( 'Jobs posted by CV Minder', 'ccs-theme' ); ?>"
                    onload="(function(){var x=0;var y=0;if(document.cookie.indexOf('cvminder_iframe')===-1){self.scrollTo(0,0);document.cookie='cvminder_iframe=1';}else{self.scrollTo(x,y);}})();"
                ></iframe>
            </div>
        <?php else : ?>
            <div class="cvm-fallback container container--lg">
                <p><?php esc_html_e( 'View our current vacancies or contact us to find out about opportunities.', 'ccs-theme' ); ?></p>
                <p><a href="<?php echo esc_url( $contact_url ); ?>" class="button button--primary"><?php esc_html_e( 'Contact us', 'ccs-theme' ); ?></a></p>
            </div>
        <?php endif; ?>
    </article>
</div>

<?php get_footer(); ?>
