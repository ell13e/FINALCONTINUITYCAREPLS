<?php
/**
 * Plugin Name: CCS Backend
 * Plugin URI: https://www.continuitycareservices.co.uk
 * Description: Backend logic for Continuity Care Services: CPTs (Services, Team, Areas, Resources, Form Submissions), SEO, contact form AJAX, Customizer contact/social, theme options. Use with any theme.
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Continuity Care Services
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ccs-wp-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CCS_BACKEND_VERSION', '1.0.0' );
define( 'CCS_BACKEND_DIR', plugin_dir_path( __FILE__ ) );
define( 'CCS_BACKEND_URI', plugin_dir_url( __FILE__ ) );

$ccs_inc_files = array(
	'theme-setup.php',
	'theme-helpers.php',
	'customizer.php',
	'theme-options.php',
	'block-patterns.php',
	'block-placeholders.php',
	'seo.php',
	'seo-schema.php',
	'seo-image-sitemap.php',
	'seo-verification.php',
	'seo-links-redirects.php',
	'seo-global-settings.php',
	'seo-admin.php',
	'post-types.php',
	'cpt-content.php',
	'form-submissions-admin.php',
	'ajax-handlers.php',
	'marketing-settings.php',
	'marketing-dashboard.php',
	'marketing-export.php',
);

foreach ( $ccs_inc_files as $file ) {
	$path = CCS_BACKEND_DIR . 'inc/' . $file;
	if ( is_readable( $path ) ) {
		require_once $path;
	}
}
