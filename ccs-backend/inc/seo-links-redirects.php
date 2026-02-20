<?php
/**
 * SEO Links & Redirects
 *
 * - Redirect attachment pages to parent (or home)
 * - Optional: strip category base
 * - External links: target="_blank" and rel="noopener noreferrer"
 * - Image SEO: auto alt from filename when missing
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Redirect attachment pages to parent post or homepage.
 */
function ccs_redirect_attachments() {
	if ( ! (bool) get_option( 'ccs_redirect_attachments_enabled', 1 ) ) {
		return;
	}
	if ( ! is_attachment() ) {
		return;
	}
	global $post;
	$parent_id = $post->post_parent;
	if ( $parent_id ) {
		$parent_url = get_permalink( $parent_id );
		if ( $parent_url ) {
			wp_redirect( $parent_url, 301 );
			exit;
		}
	}
	wp_redirect( home_url( '/' ), 301 );
	exit;
}
add_action( 'template_redirect', 'ccs_redirect_attachments', 1 );

/**
 * Strip category base (optional). Use pre_option_category_base.
 */
function ccs_strip_category_base_option( $value ) {
	if ( ! (bool) get_option( 'ccs_strip_category_base_enabled', 0 ) ) {
		return $value;
	}
	return '.';
}
add_filter( 'pre_option_category_base', 'ccs_strip_category_base_option' );

/**
 * Give pages precedence over category when strip category base is on.
 */
function ccs_page_precedence_over_stripped_category() {
	if ( ! (bool) get_option( 'ccs_strip_category_base_enabled', 0 ) ) {
		return;
	}
	$GLOBALS['wp_rewrite']->use_verbose_page_rules = true;
}
add_action( 'init', 'ccs_page_precedence_over_stripped_category', 1 );

function ccs_collect_page_rules_for_precedence( $page_rewrite_rules ) {
	if ( ! (bool) get_option( 'ccs_strip_category_base_enabled', 0 ) ) {
		return $page_rewrite_rules;
	}
	$GLOBALS['ccs_page_rewrite_rules'] = $page_rewrite_rules;
	return array();
}
add_filter( 'page_rewrite_rules', 'ccs_collect_page_rules_for_precedence' );

function ccs_prepend_page_rewrite_rules( $rewrite_rules ) {
	if ( ! (bool) get_option( 'ccs_strip_category_base_enabled', 0 ) ) {
		return $rewrite_rules;
	}
	if ( empty( $GLOBALS['ccs_page_rewrite_rules'] ) ) {
		return $rewrite_rules;
	}
	return $GLOBALS['ccs_page_rewrite_rules'] + $rewrite_rules;
}
add_filter( 'rewrite_rules_array', 'ccs_prepend_page_rewrite_rules' );

/**
 * Generate category links without /category/ when strip is enabled.
 */
function ccs_fix_category_link( $url, $term, $taxonomy ) {
	if ( $taxonomy !== 'category' ) {
		return $url;
	}
	if ( ! (bool) get_option( 'ccs_strip_category_base_enabled', 0 ) ) {
		return $url;
	}
	$slugs   = array();
	$current = $term;
	while ( $current && ! is_wp_error( $current ) ) {
		array_unshift( $slugs, $current->slug );
		if ( empty( $current->parent ) ) {
			break;
		}
		$current = get_term( $current->parent, 'category' );
	}
	return trailingslashit( home_url( '/' ) ) . implode( '/', $slugs ) . '/';
}
add_filter( 'term_link', 'ccs_fix_category_link', 10, 3 );

/**
 * Add target="_blank" and rel="noopener noreferrer" to external links in content.
 */
function ccs_add_external_link_attributes( $content ) {
	if ( empty( $content ) || is_admin() ) {
		return $content;
	}
	$site_domain = wp_parse_url( home_url(), PHP_URL_HOST );
	$pattern     = '/<a\s+([^>]*href=["\']([^"\']*)["\'][^>]*)>/i';
	$content     = preg_replace_callback( $pattern, function ( $matches ) use ( $site_domain ) {
		$full_tag = $matches[0];
		$attrs    = $matches[1];
		$url      = $matches[2];
		if ( strpos( $attrs, 'target=' ) !== false ) {
			return $full_tag;
		}
		if ( strpos( $url, '#' ) === 0 || strpos( $url, 'mailto:' ) === 0 || strpos( $url, 'tel:' ) === 0 ) {
			return $full_tag;
		}
		$url_domain = wp_parse_url( $url, PHP_URL_HOST );
		if ( ! $url_domain || $url_domain === $site_domain ) {
			return $full_tag;
		}
		if ( strpos( $attrs, 'rel=' ) === false ) {
			$attrs .= ' rel="noopener noreferrer"';
		} elseif ( strpos( $attrs, 'noopener' ) === false ) {
			$attrs = preg_replace( '/rel=["\']([^"\']*)["\']/', 'rel="$1 noopener noreferrer"', $attrs );
		}
		$attrs .= ' target="_blank"';
		return '<a ' . $attrs . '>';
	}, $content );
	return $content;
}
add_filter( 'the_content', 'ccs_add_external_link_attributes', 99 );
add_filter( 'widget_text', 'ccs_add_external_link_attributes', 99 );

/**
 * Auto-generate alt text from filename when attachment has no alt.
 */
function ccs_auto_alt_text_attributes( $attr, $attachment, $size ) {
	if ( ! empty( $attr['alt'] ) ) {
		return $attr;
	}
	$filename = get_post_meta( $attachment->ID, '_wp_attached_file', true );
	if ( empty( $filename ) ) {
		$path = get_attached_file( $attachment->ID );
		$filename = $path ? basename( $path ) : '';
	}
	if ( empty( $filename ) ) {
		return $attr;
	}
	$base = pathinfo( $filename, PATHINFO_FILENAME );
	$base = str_replace( array( '-', '_' ), ' ', $base );
	$attr['alt'] = ucwords( strtolower( $base ) );
	if ( ! get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) ) {
		update_post_meta( $attachment->ID, '_wp_attachment_image_alt', $attr['alt'] );
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'ccs_auto_alt_text_attributes', 20, 3 );

function ccs_auto_alt_on_upload( $post_id ) {
	if ( ! wp_attachment_is_image( $post_id ) ) {
		return;
	}
	if ( get_post_meta( $post_id, '_wp_attachment_image_alt', true ) ) {
		return;
	}
	$file = get_attached_file( $post_id );
	if ( ! $file ) {
		return;
	}
	$base = pathinfo( basename( $file ), PATHINFO_FILENAME );
	$base = str_replace( array( '-', '_' ), ' ', $base );
	update_post_meta( $post_id, '_wp_attachment_image_alt', ucwords( strtolower( $base ) ) );
}
add_action( 'add_attachment', 'ccs_auto_alt_on_upload' );
add_action( 'edit_attachment', 'ccs_auto_alt_on_upload' );
