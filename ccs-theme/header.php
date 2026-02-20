<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$nav_current = '';
if ( is_page() ) {
    $obj = get_queried_object();
    $nav_current = ( $obj && isset( $obj->post_name ) ) ? $obj->post_name : '';
} elseif ( is_post_type_archive( 'service' ) ) {
    $nav_current = 'services';
}
?>
<header class="site-header" role="banner">
    <div class="header-inner container">
        <div class="header-brand">
            <a href="<?php ccs_url( '/' ); ?>" class="site-logo" aria-label="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                <img src="<?php echo esc_url( ccs_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" width="240" height="auto" class="site-logo-img" />
            </a>
            <?php if ( get_bloginfo( 'description' ) ) : ?>
                <p class="header-tagline"><?php echo esc_html( get_bloginfo( 'description', 'display' ) ); ?></p>
            <?php endif; ?>
        </div>

        <button type="button" class="menu-toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="primary-nav">
            <span class="menu-toggle-icon" aria-hidden="true"></span>
        </button>

        <nav id="primary-nav" class="primary-nav" aria-label="Main">
            <ul class="nav-list">
                <?php
                $context = function_exists( 'ccs_get_site_context' ) ? ccs_get_site_context() : 'care';
                if ( $context === 'careers' ) :
                ?>
                    <li><a href="<?php ccs_url( '/careers/' ); ?>">Why Join Us</a></li>
                    <li><a href="<?php ccs_url( '/careers/typical-day/' ); ?>">Typical Day</a></li>
                    <li><a href="<?php ccs_url( '/careers/training/' ); ?>">Training</a></li>
                    <li><a href="<?php ccs_url( '/careers/jobs/' ); ?>">Current Jobs</a></li>
                    <li><a href="<?php ccs_url( '/careers/apply/' ); ?>">Apply</a></li>
                    <li class="nav-context-switch"><a href="<?php ccs_url( '/services/' ); ?>">Need Care?</a></li>
                <?php else :
                    $care_nav_items = array(
                        array( 'slug' => 'services', 'url' => '/services/', 'label' => 'Services' ),
                        array( 'slug' => 'pricing', 'url' => '/pricing/', 'label' => 'Pricing' ),
                        array( 'slug' => 'how-it-works', 'url' => '/how-it-works/', 'label' => 'How It Works' ),
                        array( 'slug' => 'about', 'url' => '/about/', 'label' => 'Who We Are' ),
                        array( 'slug' => 'team', 'url' => '/team/', 'label' => 'Our Team' ),
                        array( 'slug' => 'resources', 'url' => '/resources/', 'label' => 'Resources' ),
                    );
                    foreach ( $care_nav_items as $item ) :
                        $li_class = ( $nav_current === $item['slug'] ) ? ' current-menu-item' : '';
                ?>
                    <li class="<?php echo esc_attr( trim( $li_class ) ); ?>"><a href="<?php ccs_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
                <?php endforeach; ?>
                    <li class="nav-context-switch"><a href="<?php ccs_url( '/careers/' ); ?>">Looking for Work?</a></li>
                <?php endif; ?>
            </ul>
            <div class="header-ctas">
                <a href="tel:01622809881" class="header-cta-pill" aria-label="Call us: 01622 809881">
                    <span class="header-cta-pill-icon" aria-hidden="true"></span>
                    <span class="header-cta-pill-number">01622 809881</span>
                    <span class="header-cta-pill-label">Call us</span>
                </a>
                <?php if ( $context === 'careers' ) : ?>
                    <a href="<?php ccs_url( '/careers/apply/' ); ?>" class="btn btn-primary btn-pill">Apply Now</a>
                <?php else : ?>
                    <a href="<?php ccs_url( '/contact/' ); ?>" class="btn btn-primary btn-pill">Book Consultation</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>

<main id="main-content" class="site-main" role="main">
