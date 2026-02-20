<?php
/**
 * SEO Verification — run basic SEO checks (schema, meta, canonical, sitemap).
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Run SEO verification checks.
 *
 * @return array Results with checks, score, overall_status.
 */
function ccs_run_seo_verification() {
	$results = array(
		'timestamp'       => current_time( 'mysql' ),
		'checks'         => array(),
		'overall_status' => 'pass',
		'score'           => 0,
		'total_checks'    => 0,
		'passed_checks'   => 0,
		'warnings'       => 0,
		'errors'         => 0,
	);

	$checks = array(
		'schema'    => ccs_verify_schema(),
		'meta_tags' => ccs_verify_meta_tags(),
		'canonical' => ccs_verify_canonical(),
		'sitemap'   => ccs_verify_sitemap(),
	);

	foreach ( $checks as $key => $check ) {
		$results['checks'][ $key ] = $check;
		$results['total_checks']++;
		if ( $check['status'] === 'pass' ) {
			$results['passed_checks']++;
		} elseif ( $check['status'] === 'warning' ) {
			$results['warnings']++;
		} else {
			$results['errors']++;
		}
	}

	if ( $results['total_checks'] > 0 ) {
		$results['score'] = (int) round( ( $results['passed_checks'] / $results['total_checks'] ) * 100 );
	}
	if ( $results['errors'] > 0 ) {
		$results['overall_status'] = 'error';
	} elseif ( $results['warnings'] > 0 ) {
		$results['overall_status'] = 'warning';
	}

	return $results;
}

function ccs_verify_schema() {
	$check = array( 'name' => 'Schema Markup', 'status' => 'pass', 'issues' => array(), 'recommendations' => array() );
	if ( ! function_exists( 'ccs_schema_markup' ) ) {
		$check['status'] = 'error';
		$check['issues'][] = 'Schema function ccs_schema_markup not found';
		return $check;
	}
	ob_start();
	ccs_schema_markup();
	$out = ob_get_clean();
	if ( empty( $out ) || strpos( $out, 'application/ld+json' ) === false ) {
		$check['status'] = 'warning';
		$check['issues'][] = 'Schema output missing or invalid';
	}
	return $check;
}

function ccs_verify_meta_tags() {
	$check = array( 'name' => 'Meta Tags', 'status' => 'pass', 'issues' => array(), 'recommendations' => array() );
	if ( ! has_action( 'wp_head', 'ccs_seo_meta_tags' ) ) {
		$check['status'] = 'error';
		$check['issues'][] = 'ccs_seo_meta_tags not hooked to wp_head';
	}
	return $check;
}

function ccs_verify_canonical() {
	$check = array( 'name' => 'Canonical URL', 'status' => 'pass', 'issues' => array(), 'recommendations' => array() );
	if ( ! has_action( 'wp_head', 'ccs_seo_meta_tags' ) ) {
		$check['status'] = 'warning';
		$check['issues'][] = 'Canonical is output by ccs_seo_meta_tags; verify it is present';
	}
	return $check;
}

function ccs_verify_sitemap() {
	$check = array( 'name' => 'Sitemap', 'status' => 'pass', 'issues' => array(), 'recommendations' => array() );
	if ( ! function_exists( 'wp_sitemaps_get_server' ) ) {
		$check['status'] = 'warning';
		$check['issues'][] = 'WordPress core sitemaps not available (WP 5.5+)';
	} else {
		$check['recommendations'][] = 'Sitemap index: ' . home_url( '/wp-sitemap.xml' );
	}
	return $check;
}
