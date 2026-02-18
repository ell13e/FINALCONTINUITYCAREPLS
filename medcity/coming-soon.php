<?php
/**
 * Coming Soon — placeholder for pages under construction.
 * UI mirrors CTA theme; uses medcity layout and classes (404-style).
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>
<main class="main-content pt-130 pb-80">
	<div class="container">
		<section class="text-center py-80" aria-labelledby="coming-soon-heading">
			<h1 id="coming-soon-heading" class="heading__title mb-20"><?php esc_html_e( 'We’re still working on this page!', 'ccs-wp-theme' ); ?></h1>
			<p class="color-gray mb-40">
				<?php esc_html_e( 'This content is on its way. In the meantime, head back to the homepage or get in touch if you need help.', 'ccs-wp-theme' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn__primary btn__rounded"><?php esc_html_e( 'Back to home', 'ccs-wp-theme' ); ?></a>
		</section>
	</div>
</main>
<?php
get_footer();
