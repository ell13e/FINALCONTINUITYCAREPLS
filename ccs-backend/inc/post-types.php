<?php
/**
 * Post types and taxonomies — form submissions for contact/enquiries.
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Form Submission post type.
 */
function ccs_register_form_submission_post_type() {
	$labels = array(
		'name'               => __( 'Form Submissions', 'ccs-wp-theme' ),
		'singular_name'      => __( 'Form Submission', 'ccs-wp-theme' ),
		'menu_name'          => __( 'Submissions', 'ccs-wp-theme' ),
		'edit_item'          => __( 'View Submission', 'ccs-wp-theme' ),
		'view_item'          => __( 'View Submission', 'ccs-wp-theme' ),
		'all_items'          => __( 'All Submissions', 'ccs-wp-theme' ),
		'search_items'      => __( 'Search Submissions', 'ccs-wp-theme' ),
		'not_found'          => __( 'No submissions found.', 'ccs-wp-theme' ),
		'not_found_in_trash' => __( 'No submissions found in Trash.', 'ccs-wp-theme' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => false,
		'query_var'           => false,
		'rewrite'             => false,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => false,
		'menu_position'       => 26,
		'menu_icon'            => 'dashicons-feedback',
		'supports'            => array( 'title' ),
		'capabilities'        => array(
			'create_posts' => false,
			'delete_posts' => 'delete_posts',
		),
		'map_meta_cap'        => true,
	);

	register_post_type( 'form_submission', $args );
}
add_action( 'init', 'ccs_register_form_submission_post_type' );

/**
 * Register Form Type taxonomy for submissions.
 */
function ccs_register_form_type_taxonomy() {
	$labels = array(
		'name'          => __( 'Form Types', 'ccs-wp-theme' ),
		'singular_name' => __( 'Form Type', 'ccs-wp-theme' ),
		'menu_name'     => __( 'Form Types', 'ccs-wp-theme' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => false,
		'query_var'         => true,
		'rewrite'           => false,
	);

	register_taxonomy( 'form_type', array( 'form_submission' ), $args );
}
add_action( 'init', 'ccs_register_form_type_taxonomy' );

/**
 * Hide Form Types submenu — types are managed in code.
 */
function ccs_hide_form_types_submenu() {
	remove_submenu_page( 'edit.php?post_type=form_submission', 'edit-tags.php?taxonomy=form_type&post_type=form_submission' );
}
add_action( 'admin_menu', 'ccs_hide_form_types_submenu', 99 );

/**
 * Pre-register home-care form types.
 */
function ccs_preintegrate_form_types() {
	$form_types = array(
		array(
			'slug' => 'care-enquiry',
			'name' => __( 'Care enquiry', 'ccs-wp-theme' ),
			'description' => __( 'Enquiries about care services.', 'ccs-wp-theme' ),
		),
		array(
			'slug' => 'general',
			'name' => __( 'General', 'ccs-wp-theme' ),
			'description' => __( 'General contact form submissions.', 'ccs-wp-theme' ),
		),
		array(
			'slug' => 'request-callback',
			'name' => __( 'Request callback', 'ccs-wp-theme' ),
			'description' => __( 'Request a phone callback.', 'ccs-wp-theme' ),
		),
		array(
			'slug' => 'other',
			'name' => __( 'Other', 'ccs-wp-theme' ),
			'description' => __( 'Other enquiries.', 'ccs-wp-theme' ),
		),
	);

	foreach ( $form_types as $ft ) {
		if ( ! term_exists( $ft['slug'], 'form_type' ) ) {
			wp_insert_term( $ft['name'], 'form_type', array(
				'slug'        => $ft['slug'],
				'description' => $ft['description'],
			) );
		}
	}
}
add_action( 'init', 'ccs_preintegrate_form_types', 20 );
