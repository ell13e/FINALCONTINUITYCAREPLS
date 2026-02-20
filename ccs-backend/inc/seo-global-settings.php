<?php
/**
 * Global SEO Settings — title templates, robots meta.
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get title template for post type (variables: %title%, %sep%, %sitename%).
 *
 * @param string $post_type Post type.
 * @return string Template string.
 */
function ccs_get_seo_title_template( $post_type = 'post' ) {
	$templates = array(
		'post'        => '%title% %sep% %sitename%',
		'page'        => '%title% %sep% %sitename%',
		'service'     => '%title% %sep% %sitename%',
		'team_member' => '%title% %sep% %sitename%',
		'area'        => '%title% %sep% %sitename%',
		'resource'    => '%title% %sep% %sitename%',
	);
	$custom = get_option( 'ccs_seo_title_template_' . $post_type, '' );
	if ( is_string( $custom ) && trim( $custom ) !== '' ) {
		return $custom;
	}
	return isset( $templates[ $post_type ] ) ? $templates[ $post_type ] : '%title% %sep% %sitename%';
}

/**
 * Process title template with current post.
 *
 * @param string   $template Template with %title%, %sep%, %sitename%.
 * @param WP_Post|null $post Post or null for global $post.
 * @return string Processed title.
 */
function ccs_process_seo_title_template( $template, $post = null ) {
	if ( ! $post ) {
		global $post;
	}
	if ( ! $post ) {
		return '';
	}
	$title    = get_the_title( $post->ID );
	$sitename = get_bloginfo( 'name' );
	$sep      = get_option( 'ccs_seo_title_separator', '|' );
	$out      = str_replace( array( '%title%', '%sitename%', '%sep%' ), array( $title, $sitename, $sep ), $template );
	return $out;
}

/**
 * Apply title template to document title on singular views.
 */
function ccs_apply_seo_title_template( $title_parts ) {
	if ( ! is_singular() ) {
		return $title_parts;
	}
	$post_type = get_post_type();
	$custom_title = get_post_meta( get_the_ID(), '_ccs_meta_title', true );
	if ( is_string( $custom_title ) && trim( $custom_title ) !== '' ) {
		$title_parts['title'] = $custom_title;
		return $title_parts;
	}
	$template = ccs_get_seo_title_template( $post_type );
	global $post;
	if ( $post ) {
		$title_parts['title'] = ccs_process_seo_title_template( $template, $post );
		if ( strlen( $title_parts['title'] ) > 60 ) {
			$title_parts['title'] = wp_trim_words( $title_parts['title'], 8, '' );
		}
	}
	return $title_parts;
}
add_filter( 'document_title_parts', 'ccs_apply_seo_title_template', 5 );

/**
 * Global robots meta (index, follow, max-snippet, etc.).
 */
function ccs_apply_global_robots_meta( $robots ) {
	$global = array(
		'index'             => true,
		'follow'            => true,
		'max-snippet'       => -1,
		'max-image-preview' => 'large',
		'max-video-preview' => -1,
	);
	return array_merge( $robots, $global );
}
add_filter( 'wp_robots', 'ccs_apply_global_robots_meta', 5 );
