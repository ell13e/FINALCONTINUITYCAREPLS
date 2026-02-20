<?php
/**
 * SEO — meta description, Open Graph, document title.
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Generate meta description from template by post type (CTA-style).
 *
 * @param WP_Post $post Post object.
 * @return string Generated description (raw; caller trims length).
 */
function ccs_generate_meta_description( $post ) {
	if ( ! $post || ! isset( $post->ID ) ) {
		return '';
	}
	$title = get_the_title( $post->ID );
	$excerpt = has_excerpt( $post->ID ) ? get_the_excerpt( $post->ID ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 25 );
	$brand = __( 'Continuity Care Services — home care in Kent.', 'ccs-wp-theme' );

	switch ( $post->post_type ) {
		case 'service':
			$description = $excerpt ? $title . '. ' . $excerpt . ' ' . $brand : $title . ' — person-centred care and support. ' . $brand;
			break;
		case 'team_member':
			$description = $excerpt ? $title . '. ' . $excerpt . ' ' . $brand : $title . ' — part of the Continuity Care Services team. ' . $brand;
			break;
		case 'area':
			$description = $excerpt ? $title . ' — home care and support. ' . $excerpt . ' ' . $brand : $title . ' — we provide home care in this area. ' . $brand;
			break;
		case 'resource':
			$description = $excerpt ? $excerpt . ' ' . $brand : $title . ' — guide and resources from Continuity Care Services.';
			break;
		case 'post':
			$description = $excerpt ? $excerpt . ' Continuity Care Services.' : $title . ' — news and updates from Continuity Care Services.';
			break;
		case 'page':
			$description = $excerpt ? $excerpt : $title . '. ' . $brand;
			break;
		default:
			$description = $excerpt ? $excerpt : $title . '.';
	}

	$description = wp_trim_words( wp_strip_all_tags( $description ), 30, '' );
	if ( strlen( $description ) > 160 ) {
		$description = wp_trim_words( $description, 25, '' );
	}
	return $description;
}

/**
 * Get meta description for the current or given post.
 *
 * Priority: post meta _ccs_meta_description, excerpt, generated (template), trimmed content, site tagline, default.
 *
 * @param int|WP_Post|null $post Post ID, object, or null for current.
 * @return string Meta description (suitable length for SEO).
 */
function ccs_get_meta_description( $post = null ) {
	if ( $post === null ) {
		global $post;
	}
	if ( is_numeric( $post ) ) {
		$post = get_post( $post );
	}

	$default = __( 'Continuity Care Services — home care in Kent. CQC-registered, person-centred care and support.', 'ccs-wp-theme' );

	if ( ! $post ) {
		$site_desc = get_bloginfo( 'description' );
		return $site_desc ? wp_strip_all_tags( $site_desc ) : $default;
	}

	$custom = get_post_meta( $post->ID, '_ccs_meta_description', true );
	if ( is_string( $custom ) && trim( $custom ) !== '' ) {
		return wp_strip_all_tags( trim( $custom ) );
	}

	if ( has_excerpt( $post->ID ) ) {
		$excerpt = get_the_excerpt( $post->ID );
		if ( strlen( $excerpt ) >= 100 && strlen( $excerpt ) <= 160 ) {
			return wp_strip_all_tags( $excerpt );
		}
	}

	$generated = ccs_generate_meta_description( $post );
	if ( $generated !== '' ) {
		return $generated;
	}

	$content = get_post_field( 'post_content', $post->ID );
	if ( $content !== '' ) {
		$trimmed = wp_trim_words( wp_strip_all_tags( $content ), 25 );
		if ( $trimmed !== '' ) {
			return $trimmed;
		}
	}

	$site_desc = get_bloginfo( 'description' );
	return $site_desc ? wp_strip_all_tags( $site_desc ) : $default;
}

/**
 * Output SEO meta tags and Open Graph in head.
 */
function ccs_seo_meta_tags() {
	global $post;

	$site_name = get_bloginfo( 'name' );
	$site_desc = get_bloginfo( 'description' );
	$default_desc = __( 'Continuity Care Services — home care in Kent. CQC-registered, person-centred care and support.', 'ccs-wp-theme' );
	$default_image = get_site_icon_url( 512 );
	if ( ! $default_image ) {
		$default_image = '';
	}

	if ( is_singular() && $post ) {
		$title = get_the_title( $post->ID );
		$description = ccs_get_meta_description( $post );
		$url = get_permalink( $post->ID );
		$image = get_the_post_thumbnail_url( $post->ID, 'large' );
		if ( ! $image ) {
			$image = $default_image;
		}
		$type = 'article';
	} elseif ( is_home() || is_front_page() ) {
		$title = $site_name;
		$description = $site_desc ? wp_strip_all_tags( $site_desc ) : $default_desc;
		$url = home_url( '/' );
		$image = $default_image;
		$type = 'website';
	} elseif ( is_post_type_archive() ) {
		$pt = get_queried_object();
		$archive_title = $pt && isset( $pt->labels->name ) ? $pt->labels->name : post_type_archive_title( '', false );
		$title = $archive_title;
		$url = get_post_type_archive_link( get_query_var( 'post_type' ) );
		$descriptions = array(
			'service'   => __( 'Care and support tailored to you and your family. Explore our services.', 'ccs-wp-theme' ),
			'team_member' => __( 'Meet the people behind Continuity Care Services.', 'ccs-wp-theme' ),
			'area'      => __( 'We provide home care and support across Kent and surrounding areas.', 'ccs-wp-theme' ),
			'resource'  => __( 'Guides and information to support you and your family.', 'ccs-wp-theme' ),
		);
		$post_type = get_query_var( 'post_type' );
		if ( is_array( $post_type ) ) {
			$post_type = reset( $post_type );
		}
		$description = isset( $descriptions[ $post_type ] ) ? $descriptions[ $post_type ] : ( $site_desc ? wp_strip_all_tags( $site_desc ) : $default_desc );
		$image = $default_image;
		$type = 'website';
	} elseif ( is_search() ) {
		$title = sprintf( __( 'Search: %s', 'ccs-wp-theme' ), get_search_query() );
		$description = sprintf( __( 'Search results for "%s" on %s.', 'ccs-wp-theme' ), get_search_query(), $site_name );
		$url = get_search_link();
		$image = $default_image;
		$type = 'website';
	} elseif ( is_404() ) {
		$title = __( 'Page not found', 'ccs-wp-theme' );
		$description = __( 'The page you are looking for could not be found.', 'ccs-wp-theme' );
		$url = home_url( add_query_arg( array() ) );
		$image = $default_image;
		$type = 'website';
	} else {
		$title = wp_get_document_title();
		$description = $site_desc ? wp_strip_all_tags( $site_desc ) : $default_desc;
		$url = home_url( add_query_arg( array() ) );
		$image = $default_image;
		$type = 'website';
	}

	$title = esc_attr( wp_strip_all_tags( $title ) );
	$description = wp_strip_all_tags( $description );
	if ( strlen( $description ) > 160 ) {
		$description = wp_trim_words( $description, 25, '' );
	}
	$description = esc_attr( $description );
	$url = esc_url( $url );
	$image = esc_url( $image );
	$site_name_attr = esc_attr( $site_name );
	?>
	<!-- SEO Meta -->
	<meta name="description" content="<?php echo $description; ?>">
	<link rel="canonical" href="<?php echo $url; ?>">
	<!-- Open Graph -->
	<meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
	<meta property="og:url" content="<?php echo $url; ?>">
	<meta property="og:title" content="<?php echo $title; ?>">
	<meta property="og:description" content="<?php echo $description; ?>">
	<meta property="og:image" content="<?php echo $image; ?>">
	<meta property="og:site_name" content="<?php echo $site_name_attr; ?>">
	<meta property="og:locale" content="en_GB">
	<!-- Twitter Card -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo $title; ?>">
	<meta name="twitter:description" content="<?php echo $description; ?>">
	<meta name="twitter:image" content="<?php echo $image; ?>">
	<?php
}
add_action( 'wp_head', 'ccs_seo_meta_tags', 1 );

/**
 * Adjust document title parts (e.g. Page Title | Site Name).
 *
 * @param array $title_parts Document title parts from core.
 * @return array Modified parts.
 */
function ccs_document_title_parts( $title_parts ) {
	if ( is_feed() ) {
		return $title_parts;
	}
	$site_name = get_bloginfo( 'name' );
	if ( is_front_page() && ! is_home() ) {
		$title_parts['title'] = $site_name;
		$title_parts['site'] = '';
	} elseif ( ! empty( $title_parts['title'] ) && ! empty( $title_parts['site'] ) && $title_parts['title'] !== $site_name ) {
		// Keep core format: title | site (or tagline). Optionally cap length.
		if ( strlen( $title_parts['title'] ) > 60 ) {
			$title_parts['title'] = wp_trim_words( $title_parts['title'], 8, '' );
		}
	}
	return $title_parts;
}
add_filter( 'document_title_parts', 'ccs_document_title_parts', 10 );

/**
 * Document title separator (uses SEO Settings when set).
 *
 * @param string $sep Separator from core.
 * @return string Separator to use.
 */
function ccs_document_title_separator( $sep ) {
	$saved = get_option( 'ccs_seo_title_separator', '' );
	return is_string( $saved ) && $saved !== '' ? $saved : '|';
}
add_filter( 'document_title_separator', 'ccs_document_title_separator', 10 );
