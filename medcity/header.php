<?php
/**
 * Header — Continuity Care Services (CCS).
 *
 * @package CCS_Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$contact = ccs_get_contact_info();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
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
								<li><i class="icon-phone"></i><a href="<?php echo esc_url( $contact['phone_link'] ); ?>"><?php echo esc_html( $contact['phone'] ); ?></a></li>
								<li><i class="icon-location"></i><a href="<?php echo esc_url( $contact['address_link'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $contact['address'] ); ?></a></li>
								<li><i class="icon-clock"></i><a href="<?php echo esc_url( $contact['contact_url'] ); ?>"><?php esc_html_e( 'Contact us', 'ccs-wp-theme' ); ?></a></li>
							</ul>
							<div class="d-flex">
								<ul class="social-icons list-unstyled mb-0 mr-30">
									<li><a href="<?php echo esc_url( $contact['social']['facebook'] ); ?>" aria-label="<?php esc_attr_e( 'Message us on Facebook', 'ccs-wp-theme' ); ?>"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="<?php echo esc_url( $contact['social']['instagram'] ); ?>" aria-label="<?php esc_attr_e( 'Find us on Instagram', 'ccs-wp-theme' ); ?>"><i class="fab fa-instagram"></i></a></li>
									<li><a href="<?php echo esc_url( $contact['social']['linkedin'] ); ?>" aria-label="<?php esc_attr_e( 'Find us on LinkedIn', 'ccs-wp-theme' ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
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
					<img src="<?php echo esc_url( ccs_asset( 'images/logo/logo.svg' ) ); ?>" class="logo-light" alt="<?php bloginfo( 'name' ); ?>" width="68" height="48" loading="eager" fetchpriority="high">
					<img src="<?php echo esc_url( ccs_asset( 'images/logo/logo.svg' ) ); ?>" class="logo-dark" alt="<?php bloginfo( 'name' ); ?>" width="68" height="48" loading="eager" fetchpriority="high">
				</a>
				<button class="navbar-toggler" type="button" aria-label="<?php esc_attr_e( 'Toggle menu', 'ccs-wp-theme' ); ?>">
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
							<li class="nav__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav__item-link"><?php esc_html_e( 'Home', 'ccs-wp-theme' ); ?></a></li>
							<li class="nav__item"><a href="<?php echo esc_url( ccs_page_url( 'about-us' ) ); ?>" class="nav__item-link"><?php esc_html_e( 'About Us', 'ccs-wp-theme' ); ?></a></li>
							<li class="nav__item"><a href="<?php echo esc_url( ccs_page_url( 'our-services' ) ); ?>" class="nav__item-link"><?php esc_html_e( 'Our Services', 'ccs-wp-theme' ); ?></a></li>
							<li class="nav__item"><a href="<?php echo esc_url( ccs_page_url( 'our-team' ) ); ?>" class="nav__item-link"><?php esc_html_e( 'Our Team', 'ccs-wp-theme' ); ?></a></li>
							<li class="nav__item"><a href="<?php echo esc_url( ccs_page_url( 'areas-we-cover' ) ); ?>" class="nav__item-link"><?php esc_html_e( 'Areas we cover', 'ccs-wp-theme' ); ?></a></li>
							<li class="nav__item"><a href="<?php echo esc_url( $contact['contact_url'] ); ?>" class="nav__item-link"><?php esc_html_e( 'Contact', 'ccs-wp-theme' ); ?></a></li>
						</ul>
						<?php
					}
					?>
					<button class="close-mobile-menu d-block d-lg-none" aria-label="<?php esc_attr_e( 'Close menu', 'ccs-wp-theme' ); ?>"><i class="fas fa-times"></i></button>
				</div>
			</div>
		</nav>
	</header>
