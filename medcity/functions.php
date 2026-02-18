<?php
/**
 * Continuity Care Services (CCS) — classic theme.
 *
 * Bootstrap: constants, inc/, enqueue, block placeholders.
 *
 * @package CCS_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CCS_THEME_VERSION', '1.0.0' );
define( 'CCS_THEME_DIR', get_template_directory() );
define( 'CCS_THEME_URI', get_template_directory_uri() );

require_once CCS_THEME_DIR . '/inc/theme-setup.php';
require_once CCS_THEME_DIR . '/inc/theme-helpers.php';
require_once CCS_THEME_DIR . '/inc/customizer.php';
require_once CCS_THEME_DIR . '/inc/block-patterns.php';

/**
 * Enqueue global styles and scripts (CCS handles).
 */
function ccs_enqueue_assets() {
	$ver = CCS_THEME_VERSION;
	$uri = CCS_THEME_URI;

	wp_enqueue_style(
		'ccs-libraries',
		$uri . '/assets/css/libraries.css',
		array(),
		$ver
	);
	wp_enqueue_style(
		'ccs-style',
		$uri . '/assets/css/style.css',
		array( 'ccs-libraries' ),
		$ver
	);

	wp_enqueue_script(
		'ccs-plugins',
		$uri . '/assets/js/plugins.js',
		array( 'jquery' ),
		$ver,
		true
	);
	wp_enqueue_script(
		'ccs-main',
		$uri . '/assets/js/main.js',
		array( 'jquery', 'ccs-plugins' ),
		$ver,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ccs_enqueue_assets' );

/**
 * Conditional scripts/styles per template (extend as needed).
 */
function ccs_enqueue_page_scripts() {
	// Example: enqueue contact form script only on contact page template.
	// if ( is_page_template( 'page-templates/page-contact-us.php' ) ) {
	//     wp_enqueue_script( 'ccs-contact', ccs_asset( 'js/contact.js' ), array( 'ccs-main' ), CCS_THEME_VERSION, true );
	// }
}
add_action( 'wp_enqueue_scripts', 'ccs_enqueue_page_scripts' );

/**
 * Replace {{theme_uri}} and {{current_year}} in core/html blocks.
 */
function ccs_render_block_replace_placeholders( $block_content, $block ) {
	if ( isset( $block['blockName'] ) && $block['blockName'] === 'core/html' ) {
		$block_content = str_replace( '{{theme_uri}}', esc_url( CCS_THEME_URI ), $block_content );
		$block_content = str_replace( '{{current_year}}', esc_html( (string) wp_date( 'Y' ) ), $block_content );
	}
	return $block_content;
}
add_filter( 'render_block', 'ccs_render_block_replace_placeholders', 10, 2 );
