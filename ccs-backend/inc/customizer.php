<?php
/**
 * Theme Customizer — Contact / Site info and social.
 *
 * @package CCS_Backend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function ccs_customize_register( $wp_customize ) {

	// ——— Contact / Site info ———
	$wp_customize->add_section( 'ccs_contact_site_info', array(
		'title'       => __( 'Contact / Site info', 'ccs-wp-theme' ),
		'priority'    => 30,
		'description' => __( 'Contact details and site links used in the header, footer, and contact page.', 'ccs-wp-theme' ),
	) );

	// Phone
	$wp_customize->add_setting( 'ccs_contact_phone', array(
		'default'           => '01622 809881',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'ccs_contact_phone', array(
		'label'   => __( 'Phone number', 'ccs-wp-theme' ),
		'section' => 'ccs_contact_site_info',
		'type'    => 'text',
	) );

	// Email
	$wp_customize->add_setting( 'ccs_contact_email', array(
		'default'           => 'office@continuitycareservices.co.uk',
		'sanitize_callback' => 'sanitize_email',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'ccs_contact_email', array(
		'label'   => __( 'Email address', 'ccs-wp-theme' ),
		'section' => 'ccs_contact_site_info',
		'type'    => 'email',
	) );

	// Address (single field)
	$wp_customize->add_setting( 'ccs_contact_address', array(
		'default'           => 'The Maidstone Studios, New Cut Road, Maidstone, Kent, ME14 5NZ',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_control( 'ccs_contact_address', array(
		'label'   => __( 'Address', 'ccs-wp-theme' ),
		'section' => 'ccs_contact_site_info',
		'type'    => 'textarea',
		'rows'    => 3,
	) );

	// Map link (Google Maps or other)
	$wp_customize->add_setting( 'ccs_contact_address_link', array(
		'default'           => 'https://www.google.com/maps/search/?api=1&query=The+Maidstone+Studios+New+Cut+Road+Maidstone+ME14+5NZ',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'ccs_contact_address_link', array(
		'label'       => __( 'Address / map link', 'ccs-wp-theme' ),
		'description' => __( 'URL for "View on map" (e.g. Google Maps).', 'ccs-wp-theme' ),
		'section'     => 'ccs_contact_site_info',
		'type'        => 'url',
	) );

	// Contact page path (slug or path; used to build contact_url)
	$wp_customize->add_setting( 'ccs_contact_page_slug', array(
		'default'           => 'contact-us',
		'sanitize_callback' => function( $value ) {
			return sanitize_title( trim( $value, " \t\n\r\0\x0B/" ) );
		},
	) );
	$wp_customize->add_control( 'ccs_contact_page_slug', array(
		'label'       => __( 'Contact page slug', 'ccs-wp-theme' ),
		'description' => __( 'Page slug for the contact page (e.g. contact-us). Used for "Contact us" links.', 'ccs-wp-theme' ),
		'section'     => 'ccs_contact_site_info',
		'type'        => 'text',
	) );

	// ——— Social ———
	$wp_customize->add_setting( 'ccs_social_facebook', array(
		'default'           => 'https://m.me/821174384562849',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'ccs_social_facebook', array(
		'label'   => __( 'Facebook URL', 'ccs-wp-theme' ),
		'section' => 'ccs_contact_site_info',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'ccs_social_instagram', array(
		'default'           => 'https://instagram.com/continuityofcareservices/',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'ccs_social_instagram', array(
		'label'   => __( 'Instagram URL', 'ccs-wp-theme' ),
		'section' => 'ccs_contact_site_info',
		'type'    => 'url',
	) );

	$wp_customize->add_setting( 'ccs_social_linkedin', array(
		'default'           => 'https://linkedin.com/company/continuitycareservices',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'ccs_social_linkedin', array(
		'label'   => __( 'LinkedIn URL', 'ccs-wp-theme' ),
		'section' => 'ccs_contact_site_info',
		'type'    => 'url',
	) );
}

add_action( 'customize_register', 'ccs_customize_register' );
