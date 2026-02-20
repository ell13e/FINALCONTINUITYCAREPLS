<?php
/**
 * Helpers — Continuity Care Services (CCS). Plugin asset URL and contact info.
 *
 * @package CCS_Backend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin asset URL (for admin or future use).
 *
 * @param string $path Path relative to plugin assets/ (e.g. 'css/admin.css').
 * @return string Full URL.
 */
function ccs_asset( $path ) {
	return CCS_BACKEND_URI . 'assets/' . ltrim( $path, '/' );
}

/**
 * Site contact info (single source for header, footer, contact page).
 * Values come from Customizer (Appearance → Customize → Contact / Site info); fallbacks below.
 *
 * @return array Keys: phone, phone_link, email, address (string), address_link (maps URL), contact_url, social (facebook, instagram, linkedin).
 */
function ccs_get_contact_info() {
	$phone = get_theme_mod( 'ccs_contact_phone', '01622 809881' );
	$phone_link = 'tel:' . preg_replace( '/\D/', '', $phone );
	$slug = get_theme_mod( 'ccs_contact_page_slug', 'contact-us' );
	$contact_url = $slug ? home_url( '/' . trailingslashit( $slug ) ) : home_url( '/contact-us/' );

	return array(
		'phone'         => $phone,
		'phone_link'    => $phone_link,
		'email'         => get_theme_mod( 'ccs_contact_email', 'office@continuitycareservices.co.uk' ),
		'address'       => get_theme_mod( 'ccs_contact_address', 'The Maidstone Studios, New Cut Road, Maidstone, Kent, ME14 5NZ' ),
		'address_link'  => get_theme_mod( 'ccs_contact_address_link', 'https://www.google.com/maps/search/?api=1&query=The+Maidstone+Studios+New+Cut+Road+Maidstone+ME14+5NZ' ),
		'contact_url'   => $contact_url,
		'social'        => array(
			'facebook'  => get_theme_mod( 'ccs_social_facebook', 'https://m.me/821174384562849' ),
			'instagram' => get_theme_mod( 'ccs_social_instagram', 'https://instagram.com/continuityofcareservices/' ),
			'linkedin'  => get_theme_mod( 'ccs_social_linkedin', 'https://linkedin.com/company/continuitycareservices' ),
		),
	);
}

/**
 * Page URL by slug (resolves to pretty permalink when possible).
 *
 * @param string $slug Page slug (e.g. 'contact-us', 'about-us', 'privacy-policy').
 * @return string URL for the page.
 */
function ccs_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page && $page->post_name ) {
		return home_url( '/' . $page->post_name . '/' );
	}
	return home_url( '/' . $slug . '/' );
}
