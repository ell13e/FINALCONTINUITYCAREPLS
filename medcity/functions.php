<?php
/**
 * Continuity Care Services (CCS) block theme — Medcity-based.
 *
 * Enqueues Medcity template assets so the block theme keeps the Medcity look.
 *
 * @package CCS_Theme
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CCS_MEDCITY_VERSION', '1.0.0' );
define( 'CCS_MEDCITY_DIR', get_template_directory() );
define( 'CCS_MEDCITY_URI', get_template_directory_uri() );

/**
 * Enqueue Medcity styles and scripts.
 */
function ccs_medcity_enqueue_assets() {
	$ver = CCS_MEDCITY_VERSION;
	$uri = CCS_MEDCITY_URI;

	// Medcity CSS (order matters: libraries then style).
	wp_enqueue_style(
		'medcity-libraries',
		$uri . '/assets/css/libraries.css',
		array(),
		$ver
	);
	wp_enqueue_style(
		'medcity-style',
		$uri . '/assets/css/style.css',
		array( 'medcity-libraries' ),
		$ver
	);

	// Medcity JS (jQuery provided by WordPress).
	wp_enqueue_script(
		'medcity-plugins',
		$uri . '/assets/js/plugins.js',
		array( 'jquery' ),
		$ver,
		true
	);
	wp_enqueue_script(
		'medcity-main',
		$uri . '/assets/js/main.js',
		array( 'jquery', 'medcity-plugins' ),
		$ver,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ccs_medcity_enqueue_assets' );

/**
 * Add body class for Medcity layout.
 */
function ccs_medcity_body_class( $classes ) {
	$classes[] = 'medcity-classic-theme';
	return $classes;
}
add_filter( 'body_class', 'ccs_medcity_body_class' );

/**
 * Theme support and nav menus (classic theme, CTA-style).
 */
function ccs_medcity_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 260,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary menu', 'ccs-wp-theme' ),
	) );
}
add_action( 'after_setup_theme', 'ccs_medcity_setup' );

/**
 * Replace {{theme_uri}} placeholder in HTML blocks so template parts can reference theme assets.
 */
function ccs_medcity_render_block_replace_placeholders( $block_content, $block ) {
	if ( isset( $block['blockName'] ) && $block['blockName'] === 'core/html' ) {
		$block_content = str_replace( '{{theme_uri}}', esc_url( get_template_directory_uri() ), $block_content );
		$block_content = str_replace( '{{current_year}}', esc_html( (string) wp_date( 'Y' ) ), $block_content );
	}
	return $block_content;
}
add_filter( 'render_block', 'ccs_medcity_render_block_replace_placeholders', 10, 2 );
