<?php
/**
 * Content CPTs — Services, Team members, Areas, Resources.
 *
 * Use these instead of (or alongside) pages for services, team, areas we cover,
 * and downloadable/guide resources (e.g. home care guide, dementia first steps).
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Service post type.
 */
function ccs_register_service_post_type() {
	$labels = array(
		'name'               => __( 'Services', 'ccs-wp-theme' ),
		'singular_name'      => __( 'Service', 'ccs-wp-theme' ),
		'menu_name'          => __( 'Services', 'ccs-wp-theme' ),
		'all_items'          => __( 'All Services', 'ccs-wp-theme' ),
		'add_new'            => __( 'Add New', 'ccs-wp-theme' ),
		'add_new_item'       => __( 'Add New Service', 'ccs-wp-theme' ),
		'edit_item'          => __( 'Edit Service', 'ccs-wp-theme' ),
		'new_item'           => __( 'New Service', 'ccs-wp-theme' ),
		'view_item'          => __( 'View Service', 'ccs-wp-theme' ),
		'search_items'       => __( 'Search Services', 'ccs-wp-theme' ),
		'not_found'          => __( 'No services found.', 'ccs-wp-theme' ),
		'not_found_in_trash' => __( 'No services found in Trash.', 'ccs-wp-theme' ),
	);

	register_post_type( 'service', array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'services' ),
		'capability_type'     => 'post',
		'has_archive'         => true,
		'hierarchical'        => false,
		'menu_position'       => 21,
		'menu_icon'            => 'dashicons-admin-generic',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	) );
}
add_action( 'init', 'ccs_register_service_post_type' );

/**
 * Register Team Member post type.
 */
function ccs_register_team_member_post_type() {
	$labels = array(
		'name'               => __( 'Team Members', 'ccs-wp-theme' ),
		'singular_name'      => __( 'Team Member', 'ccs-wp-theme' ),
		'menu_name'          => __( 'Team', 'ccs-wp-theme' ),
		'all_items'          => __( 'All Team Members', 'ccs-wp-theme' ),
		'add_new'            => __( 'Add New', 'ccs-wp-theme' ),
		'add_new_item'       => __( 'Add New Team Member', 'ccs-wp-theme' ),
		'edit_item'          => __( 'Edit Team Member', 'ccs-wp-theme' ),
		'new_item'           => __( 'New Team Member', 'ccs-wp-theme' ),
		'view_item'          => __( 'View Team Member', 'ccs-wp-theme' ),
		'search_items'       => __( 'Search Team Members', 'ccs-wp-theme' ),
		'not_found'          => __( 'No team members found.', 'ccs-wp-theme' ),
		'not_found_in_trash' => __( 'No team members found in Trash.', 'ccs-wp-theme' ),
	);

	register_post_type( 'team_member', array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'team' ),
		'capability_type'     => 'post',
		'has_archive'         => true,
		'hierarchical'        => false,
		'menu_position'       => 22,
		'menu_icon'            => 'dashicons-groups',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	) );
}
add_action( 'init', 'ccs_register_team_member_post_type' );

/**
 * Register Area post type (areas we cover).
 */
function ccs_register_area_post_type() {
	$labels = array(
		'name'               => __( 'Areas', 'ccs-wp-theme' ),
		'singular_name'      => __( 'Area', 'ccs-wp-theme' ),
		'menu_name'          => __( 'Areas', 'ccs-wp-theme' ),
		'all_items'          => __( 'All Areas', 'ccs-wp-theme' ),
		'add_new'            => __( 'Add New', 'ccs-wp-theme' ),
		'add_new_item'       => __( 'Add New Area', 'ccs-wp-theme' ),
		'edit_item'          => __( 'Edit Area', 'ccs-wp-theme' ),
		'new_item'           => __( 'New Area', 'ccs-wp-theme' ),
		'view_item'          => __( 'View Area', 'ccs-wp-theme' ),
		'search_items'       => __( 'Search Areas', 'ccs-wp-theme' ),
		'not_found'          => __( 'No areas found.', 'ccs-wp-theme' ),
		'not_found_in_trash' => __( 'No areas found in Trash.', 'ccs-wp-theme' ),
	);

	register_post_type( 'area', array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'areas' ),
		'capability_type'     => 'post',
		'has_archive'         => true,
		'hierarchical'        => false,
		'menu_position'       => 23,
		'menu_icon'            => 'dashicons-location-alt',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	) );
}
add_action( 'init', 'ccs_register_area_post_type' );

/**
 * Register Resource post type (guides, downloads — home care guide, dementia first steps, etc.).
 */
function ccs_register_resource_post_type() {
	$labels = array(
		'name'               => __( 'Resources', 'ccs-wp-theme' ),
		'singular_name'      => __( 'Resource', 'ccs-wp-theme' ),
		'menu_name'          => __( 'Resources', 'ccs-wp-theme' ),
		'all_items'          => __( 'All Resources', 'ccs-wp-theme' ),
		'add_new'            => __( 'Add New', 'ccs-wp-theme' ),
		'add_new_item'       => __( 'Add New Resource', 'ccs-wp-theme' ),
		'edit_item'          => __( 'Edit Resource', 'ccs-wp-theme' ),
		'new_item'           => __( 'New Resource', 'ccs-wp-theme' ),
		'view_item'          => __( 'View Resource', 'ccs-wp-theme' ),
		'search_items'       => __( 'Search Resources', 'ccs-wp-theme' ),
		'not_found'          => __( 'No resources found.', 'ccs-wp-theme' ),
		'not_found_in_trash' => __( 'No resources found in Trash.', 'ccs-wp-theme' ),
	);

	register_post_type( 'resource', array(
		'labels'              => $labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_rest'        => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'resources' ),
		'capability_type'     => 'post',
		'has_archive'         => true,
		'hierarchical'        => false,
		'menu_position'       => 24,
		'menu_icon'            => 'dashicons-book-alt',
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	) );
}
add_action( 'init', 'ccs_register_resource_post_type' );

/**
 * Register Resource Type taxonomy (e.g. guide, first-steps, download).
 */
function ccs_register_resource_type_taxonomy() {
	$labels = array(
		'name'          => __( 'Resource Types', 'ccs-wp-theme' ),
		'singular_name' => __( 'Resource Type', 'ccs-wp-theme' ),
		'menu_name'     => __( 'Resource Types', 'ccs-wp-theme' ),
	);

	register_taxonomy( 'resource_type', array( 'resource' ), array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'resource-type' ),
	) );
}
add_action( 'init', 'ccs_register_resource_type_taxonomy' );
