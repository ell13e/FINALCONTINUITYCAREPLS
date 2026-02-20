<?php
/**
 * Theme setup — Continuity Care Services (CCS). Backend/plugin: support and menus only; no enqueue or template forcing.
 *
 * @package CCS_Backend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme support and nav menus.
 */
function ccs_theme_setup() {
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
	$GLOBALS['content_width'] = 1280;
}
add_action( 'after_setup_theme', 'ccs_theme_setup' );

/**
 * Excerpt length.
 */
function ccs_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'ccs_excerpt_length' );

/**
 * Excerpt more.
 */
function ccs_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'ccs_excerpt_more' );

/**
 * Relabel built-in Posts as "News & Updates" in the admin menu; add/edit screens say "Post".
 */
function ccs_relabel_posts_as_news() {
	global $wp_post_types;
	if ( ! isset( $wp_post_types['post'] ) ) {
		return;
	}
	$wp_post_types['post']->labels->name               = __( 'News & Updates', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->singular_name     = __( 'Post', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->menu_name         = __( 'News & Updates', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->all_items         = __( 'All News & Updates', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->add_new           = __( 'Add New', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->add_new_item     = __( 'Add New Post', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->edit_item         = __( 'Edit Post', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->new_item         = __( 'New Post', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->view_item         = __( 'View Post', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->search_items     = __( 'Search News & Updates', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->not_found         = __( 'No posts found.', 'ccs-wp-theme' );
	$wp_post_types['post']->labels->not_found_in_trash = __( 'No posts found in Trash.', 'ccs-wp-theme' );
}
add_action( 'init', 'ccs_relabel_posts_as_news', 20 );
