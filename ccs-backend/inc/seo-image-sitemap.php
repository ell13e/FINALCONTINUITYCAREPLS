<?php
/**
 * Image Sitemap — add images to WordPress core sitemaps for CPTs and posts.
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add featured images to sitemap entries for services, team, areas, resources, and posts.
 *
 * @param array   $url       Sitemap URL entry.
 * @param WP_Post $post      Post object.
 * @param string  $post_type Post type.
 * @return array Modified URL entry with images.
 */
function ccs_add_images_to_sitemap( $url, $post, $post_type ) {
	$with_images = array( 'service', 'team_member', 'area', 'resource', 'post', 'page' );
	if ( ! in_array( $post_type, $with_images, true ) ) {
		return $url;
	}

	if ( ! ( $post instanceof WP_Post ) ) {
		return $url;
	}

	$image_id = get_post_thumbnail_id( $post->ID );
	if ( ! $image_id ) {
		return $url;
	}

	$image_url = wp_get_attachment_image_url( $image_id, 'full' );
	if ( ! $image_url ) {
		return $url;
	}

	$image_meta = wp_get_attachment_metadata( $image_id );
	if ( ! isset( $url['images'] ) ) {
		$url['images'] = array();
	}

	$alt_text = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	$title    = ! empty( $alt_text ) ? $alt_text : ( get_the_title( $post->ID ) . ' — ' . get_bloginfo( 'name' ) );

	$image_data = array( 'loc' => $image_url, 'title' => $title );
	$caption    = wp_get_attachment_caption( $image_id );
	if ( ! empty( $caption ) ) {
		$image_data['caption'] = $caption;
	}
	if ( ! empty( $image_meta['width'] ) && ! empty( $image_meta['height'] ) ) {
		$image_data['width']  = (int) $image_meta['width'];
		$image_data['height'] = (int) $image_meta['height'];
	}

	$url['images'][] = $image_data;
	return $url;
}
add_filter( 'wp_sitemaps_posts_entry', 'ccs_add_images_to_sitemap', 10, 3 );
