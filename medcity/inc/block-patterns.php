<?php
/**
 * Block patterns — category and pattern registration.
 *
 * Registers the ccs-patterns category and theme patterns so they appear
 * in the block editor inserter. Pattern markup lives in patterns/*.php.
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register block pattern category.
 */
function ccs_register_block_pattern_category() {
	register_block_pattern_category( 'ccs-patterns', array(
		'label'       => __( 'CCS Patterns', 'ccs-wp-theme' ),
		'description' => __( 'Pre-designed blocks for Continuity Care Services', 'ccs-wp-theme' ),
	) );
}
add_action( 'init', 'ccs_register_block_pattern_category', 9 );

/**
 * Register block patterns (content loaded from patterns/*.php).
 */
function ccs_register_block_patterns() {
	$pattern_files = array(
		array(
			'file'        => 'ccs-cqc-section.php',
			'name'        => 'ccs-cqc-section',
			'title'       => __( 'CQC section', 'ccs-wp-theme' ),
			'description' => __( 'CQC rating section — heading, subheading, profile link, and optional CQC widget script.', 'ccs-wp-theme' ),
		),
		array(
			'file'        => 'ccs-cv-minder-careers.php',
			'name'        => 'ccs-cv-minder-careers',
			'title'       => __( 'CV Minder careers embed', 'ccs-wp-theme' ),
			'description' => __( 'Careers page — CV Minder job portal iframe or fallback with Contact us CTA.', 'ccs-wp-theme' ),
		),
	);

	$patterns_dir = CCS_THEME_DIR . '/patterns/';

	foreach ( $pattern_files as $item ) {
		$path = $patterns_dir . $item['file'];
		if ( ! is_readable( $path ) ) {
			continue;
		}
		$content = ccs_get_pattern_content( $path );
		if ( $content === '' ) {
			continue;
		}
		register_block_pattern( 'ccs-wp-theme/' . $item['name'], array(
			'title'       => $item['title'],
			'description' => $item['description'],
			'categories'  => array( 'ccs-patterns' ),
			'content'     => $content,
		) );
	}
}
add_action( 'init', 'ccs_register_block_patterns', 11 );

/**
 * Read pattern block content from a PHP file (markup after the first closing PHP tag).
 *
 * @param string $path Full path to the pattern file.
 * @return string Pattern block markup.
 */
function ccs_get_pattern_content( $path ) {
	$contents = file_get_contents( $path );
	if ( $contents === false ) {
		return '';
	}
	$pos = strpos( $contents, '?>' );
	if ( $pos === false ) {
		return '';
	}
	return trim( substr( $contents, $pos + 2 ) );
}
