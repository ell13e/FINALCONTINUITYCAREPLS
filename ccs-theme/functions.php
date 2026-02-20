<?php
/**
 * CCS Theme Functions
 */

// Template helpers: short, escaped output so templates stay readable.
function ccs_url( $path = '' ) {
    echo esc_url( home_url( $path ) );
}
function ccs_site_name() {
    echo esc_html( get_bloginfo( 'name', 'display' ) );
}
function ccs_site_description() {
    echo esc_html( get_bloginfo( 'description', 'display' ) );
}
/** Logo URL (long/horizontal) for header and footer. */
function ccs_logo_url() {
    return get_template_directory_uri() . '/assets/images/long_logo.png';
}
/** Service post URL by slug, or /services fallback. Echoes escaped URL. */
function ccs_service_link( $slug ) {
    $posts = get_posts( array( 'post_type' => 'service', 'name' => $slug, 'posts_per_page' => 1 ) );
    $url = ! empty( $posts ) ? get_permalink( $posts[0] ) : home_url( '/services/' );
    echo esc_url( $url );
}

add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);

function ccs_remove_gutenberg_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
}
add_action('wp_enqueue_scripts', 'ccs_remove_gutenberg_css', 100);

require_once get_template_directory() . '/inc/cpt-registration.php';
require_once get_template_directory() . '/inc/taxonomy-registration.php';

require_once get_template_directory() . '/inc/meta-boxes-service.php';
require_once get_template_directory() . '/inc/meta-boxes-condition.php';
require_once get_template_directory() . '/inc/meta-boxes-location.php';
require_once get_template_directory() . '/inc/meta-boxes-guide.php';
require_once get_template_directory() . '/inc/meta-boxes-process.php';
require_once get_template_directory() . '/inc/meta-boxes-team.php';
require_once get_template_directory() . '/inc/customizer-cvminder.php';
require_once get_template_directory() . '/inc/customizer-hero.php';

require_once get_template_directory() . '/inc/custom-rewrites.php';
require_once get_template_directory() . '/inc/schema-output.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/navigation.php';
require_once get_template_directory() . '/inc/duplicate-post.php';

function ccs_enqueue_assets() {
    wp_enqueue_style('ccs-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_script('ccs-scripts', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);

    // Contact page: localise ajaxurl and nonce for backend ccs_contact_form handler.
    if ( is_page( 'contact' ) ) {
        wp_localize_script( 'ccs-scripts', 'ccs_contact', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'ccs_contact_form' ),
        ) );
    }
}
add_action('wp_enqueue_scripts', 'ccs_enqueue_assets');

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
