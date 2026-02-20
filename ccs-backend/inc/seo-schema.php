<?php
/**
 * Schema.org JSON-LD — Organization, LocalBusiness (and WebSite on front).
 *
 * Uses ccs_get_contact_info() for contact and address.
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build Organization schema from contact/site info.
 *
 * @return array Schema.org Organization node.
 */
function ccs_get_organization_schema() {
	$contact = ccs_get_contact_info();
	$site_url = home_url( '/' );
	$site_name = get_bloginfo( 'name' );
	$site_desc = get_bloginfo( 'description' );
	$default_desc = __( 'Continuity Care Services — home care in Kent. CQC-registered, person-centred care and support.', 'ccs-wp-theme' );

	$same_as = array_values( array_filter( array(
		$contact['social']['facebook'],
		$contact['social']['instagram'],
		$contact['social']['linkedin'],
	) ) );

	$org = array(
		'@type'       => 'Organization',
		'@id'         => $site_url . '#organization',
		'name'        => $site_name,
		'url'         => $site_url,
		'description' => $site_desc ? wp_strip_all_tags( $site_desc ) : $default_desc,
		'telephone'   => $contact['phone'],
	);
	$logo_url = get_site_icon_url( 512 );
	if ( $logo_url ) {
		$org['logo'] = array( '@type' => 'ImageObject', 'url' => $logo_url );
	}
	if ( ! empty( $contact['email'] ) ) {
		$org['email'] = $contact['email'];
	}
	if ( ! empty( $same_as ) ) {
		$org['sameAs'] = $same_as;
	}

	if ( ! empty( $contact['address'] ) ) {
		$org['address'] = array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $contact['address'],
			'addressCountry'  => 'GB',
		);
	}

	return $org;
}

/**
 * Build LocalBusiness schema (physical location) for local/sitelinks.
 *
 * @return array Schema.org LocalBusiness node.
 */
function ccs_get_local_business_schema() {
	$contact = ccs_get_contact_info();
	$site_url = home_url( '/' );
	$site_name = get_bloginfo( 'name' );

	$lb = array(
		'@type'    => 'LocalBusiness',
		'@id'      => $site_url . '#localbusiness',
		'name'     => $site_name,
		'url'      => $site_url,
		'telephone'=> $contact['phone'],
	);

	if ( ! empty( $contact['address'] ) ) {
		$lb['address'] = array(
			'@type'          => 'PostalAddress',
			'streetAddress'  => $contact['address'],
			'addressCountry' => 'GB',
		);
	}

	if ( ! empty( $contact['email'] ) ) {
		$lb['email'] = $contact['email'];
	}

	return $lb;
}

/**
 * Output schema JSON-LD script in head.
 *
 * @param array $graph Array of schema nodes (no @context).
 */
function ccs_output_schema_json( $graph ) {
	if ( empty( $graph ) ) {
		return;
	}
	$data = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);
	echo "\n<!-- Schema.org -->\n";
	echo '<script type="application/ld+json">' . "\n";
	echo wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	echo "\n</script>\n";
}

/**
 * Build and output schema graph for current request.
 */
function ccs_output_schema() {
	$site_url = home_url( '/' );
	$site_name = get_bloginfo( 'name' );
	$site_desc = get_bloginfo( 'description' );
	$default_desc = __( 'Continuity Care Services — home care in Kent. CQC-registered, person-centred care and support.', 'ccs-wp-theme' );

	$graph = array();

	if ( is_front_page() || is_home() ) {
		$graph[] = array(
			'@type'       => 'WebSite',
			'@id'         => $site_url . '#website',
			'url'         => $site_url,
			'name'        => $site_name,
			'description' => $site_desc ? wp_strip_all_tags( $site_desc ) : $default_desc,
			'inLanguage'  => 'en-GB',
			'publisher'   => array( '@id' => $site_url . '#organization' ),
		);
	}

	$graph[] = ccs_get_organization_schema();
	$graph[] = ccs_get_local_business_schema();

	// Singular CPT or post: Service schema, or Article for post/resource.
	if ( is_singular() ) {
		$post_type = get_post_type();
		$id = get_the_ID();
		$permalink = get_permalink( $id );
		$title = get_the_title( $id );
		$desc = ccs_get_meta_description( get_post( $id ) );
		$image_url = get_the_post_thumbnail_url( $id, 'large' );
		if ( $post_type === 'service' || $post_type === 'area' ) {
			$node = array(
				'@type'       => 'Service',
				'@id'         => $permalink . '#schema',
				'name'        => $title,
				'description' => $desc,
				'url'         => $permalink,
				'provider'    => array( '@id' => $site_url . '#organization' ),
			);
			if ( $image_url ) {
				$node['image'] = $image_url;
			}
			$graph[] = $node;
		} elseif ( $post_type === 'resource' || $post_type === 'post' ) {
			$node = array(
				'@type'       => 'Article',
				'@id'         => $permalink . '#schema',
				'headline'    => $title,
				'description' => $desc,
				'url'         => $permalink,
				'author'      => array( '@id' => $site_url . '#organization' ),
				'publisher'   => array( '@id' => $site_url . '#organization' ),
			);
			if ( $image_url ) {
				$node['image'] = $image_url;
			}
			$graph[] = $node;
		}
		// BreadcrumbList for singular (Home > Archive > Title).
		$breadcrumb = ccs_get_breadcrumb_schema();
		if ( ! empty( $breadcrumb ) ) {
			$graph[] = $breadcrumb;
		}
	}

	// Archive: BreadcrumbList (Home > Archive label).
	if ( is_post_type_archive() ) {
		$breadcrumb = ccs_get_breadcrumb_schema();
		if ( ! empty( $breadcrumb ) ) {
			$graph[] = $breadcrumb;
		}
	}

	ccs_output_schema_json( $graph );
}
add_action( 'wp_head', 'ccs_output_schema', 5 );

/**
 * Wrapper for SEO verification (expects ccs_schema_markup to output schema).
 */
function ccs_schema_markup() {
	ccs_output_schema();
}

/**
 * Build BreadcrumbList schema from current context.
 *
 * @return array|null BreadcrumbList node or null.
 */
function ccs_get_breadcrumb_schema() {
	$site_url = home_url( '/' );
	$site_name = get_bloginfo( 'name' );
	$items = array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => $site_name,
			'item'     => $site_url,
		),
	);
	$position = 2;
	if ( is_post_type_archive() ) {
		$pt = get_query_var( 'post_type' );
		if ( is_array( $pt ) ) {
			$pt = reset( $pt );
		}
		$obj = get_queried_object();
		$label = $obj && isset( $obj->labels->name ) ? $obj->labels->name : post_type_archive_title( '', false );
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position++,
			'name'     => $label,
			'item'     => get_post_type_archive_link( $pt ),
		);
	}
	if ( is_singular() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title(),
			'item'     => get_permalink(),
		);
	}
	if ( count( $items ) < 2 ) {
		return null;
	}
	return array(
		'@type'           => 'BreadcrumbList',
		'@id'             => ( is_singular() ? get_permalink() : ( is_post_type_archive() ? get_post_type_archive_link( is_array( get_query_var( 'post_type' ) ) ? reset( get_query_var( 'post_type' ) ) : get_query_var( 'post_type' ) ) : $site_url ) ) . '#breadcrumb',
		'itemListElement' => $items,
	);
}
