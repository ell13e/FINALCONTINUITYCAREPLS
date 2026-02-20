<?php
/**
 * Block placeholders — {{theme_uri}} and {{current_year}} in core/html blocks.
 *
 * @package CCS_Backend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Replace {{theme_uri}} and {{current_year}} in core/html blocks.
 */
function ccs_render_block_replace_placeholders( $block_content, $block ) {
	if ( isset( $block['blockName'] ) && $block['blockName'] === 'core/html' ) {
		$block_content = str_replace( '{{theme_uri}}', esc_url( CCS_BACKEND_URI ), $block_content );
		$block_content = str_replace( '{{current_year}}', esc_html( (string) wp_date( 'Y' ) ), $block_content );
	}
	return $block_content;
}
add_filter( 'render_block', 'ccs_render_block_replace_placeholders', 10, 2 );
