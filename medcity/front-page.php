<?php
/**
 * Homepage template — CTA-style: pre-built layout, no blocks required.
 * Uses Medcity UI. Set a static front page in Settings → Reading to use this.
 *
 * @package CCS_Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
get_template_part( 'template-parts/front-page', 'content' );
get_footer();
