<?php
/**
 * Header template — Medcity UI.
 *
 * @package CCS_Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$theme_uri = get_template_directory_uri();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'medcity-classic-theme' ); ?>>
<?php wp_body_open(); ?>

<div class="wrapper">
	<div class="preloader" aria-hidden="true">
		<div class="loading"><span></span><span></span><span></span><span></span></div>
	</div>

	<header class="header header-layout1">
		<div class="header-topbar">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-12">
						<div class="d-flex align-items-center justify-content-between">
							<ul class="contact__list d-flex flex-wrap align-items-center list-unstyled mb-0">
								<li><i class="icon-phone"></i><a href="tel:01622689047">01622 689 047</a></li>
								<li><i class="icon-location"></i><a href="https://www.google.com/maps/search/?api=1&amp;query=The+Maidstone+Studios+New+Cut+Road+Maidstone+ME14+5NZ" target="_blank" rel="noopener noreferrer">The Maidstone Studios, New Cut Road, Maidstone, Kent, ME14 5NZ</a></li>
								<li><i class="icon-clock"></i><a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>">Contact us</a></li>
							</ul>
							<div class="d-flex">
								<ul class="social-icons list-unstyled mb-0 mr-30">
									<li><a href="https://m.me/821174384562849" aria-label="Message Continuity's Facebook"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="http://instagram.com/continuityofcareservices/" aria-label="Find Continuity on Instagram"><i class="fab fa-instagram"></i></a></li>
									<li><a href="http://linkedin.com/company/continuitycareservices" aria-label="Find Continuity on Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg sticky-navbar">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/logo/logo-light.png" class="logo-light" alt="<?php bloginfo( 'name' ); ?>">
					<img src="<?php echo esc_url( $theme_uri ); ?>/assets/images/logo/logo-dark.png" class="logo-dark" alt="<?php bloginfo( 'name' ); ?>">
				</a>
				<button class="navbar-toggler" type="button" aria-label="Toggle menu">
					<span class="menu-lines"><span></span></span>
				</button>
				<div class="collapse navbar-collapse" id="mainNavigation">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'navbar-nav ml-auto',
							'container'      => false,
						) );
					} else {
						?>
						<ul class="navbar-nav ml-auto">
							<li class="nav__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__item-link">Home</a></li>
							<li class="nav__item"><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" class="nav__item-link">About Us</a></li>
							<li class="nav__item"><a href="<?php echo esc_url( home_url( '/our-services/' ) ); ?>" class="nav__item-link">Our Services</a></li>
							<li class="nav__item"><a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="nav__item-link">Contact</a></li>
						</ul>
						<?php
					}
					?>
					<button class="close-mobile-menu d-block d-lg-none" aria-label="Close menu"><i class="fas fa-times"></i></button>
				</div>
			</div>
		</nav>
	</header>
