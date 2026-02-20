<?php
/**
 * Marketing menu and settings (GA4, GTM, consent wording).
 *
 * @package CCS_Backend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Marketing top-level menu and submenus.
 */
function ccs_marketing_register_menu() {
	add_menu_page(
		__( 'Marketing', 'ccs-wp-theme' ),
		__( 'Marketing', 'ccs-wp-theme' ),
		'edit_posts',
		'ccs-marketing',
		'ccs_marketing_dashboard_page',
		'dashicons-chart-line',
		30
	);
	add_submenu_page(
		'ccs-marketing',
		__( 'Dashboard', 'ccs-wp-theme' ),
		__( 'Dashboard', 'ccs-wp-theme' ),
		'edit_posts',
		'ccs-marketing',
		'ccs_marketing_dashboard_page'
	);
	add_submenu_page(
		'ccs-marketing',
		__( 'Settings', 'ccs-wp-theme' ),
		__( 'Settings', 'ccs-wp-theme' ),
		'edit_posts',
		'ccs-marketing-settings',
		'ccs_marketing_settings_page'
	);
	add_submenu_page(
		'ccs-marketing',
		__( 'Export', 'ccs-wp-theme' ),
		__( 'Export', 'ccs-wp-theme' ),
		'edit_posts',
		'ccs-export-submissions',
		'ccs_export_submissions_page'
	);
}
add_action( 'admin_menu', 'ccs_marketing_register_menu' );

/**
 * Register Marketing options.
 */
function ccs_marketing_register_settings() {
	register_setting(
		'ccs_marketing_settings',
		'ccs_ga4_measurement_id',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'ccs_sanitize_ga4_id',
			'default'           => '',
		)
	);
	register_setting(
		'ccs_marketing_settings',
		'ccs_gtm_container_id',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'ccs_sanitize_gtm_id',
			'default'           => '',
		)
	);
	register_setting(
		'ccs_marketing_settings',
		'ccs_marketing_consent_wording',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_textarea_field',
			'default'           => '',
		)
	);
}
add_action( 'admin_init', 'ccs_marketing_register_settings' );

/**
 * Sanitize GA4 Measurement ID (alphanumeric and hyphen).
 *
 * @param string $value Raw value.
 * @return string
 */
function ccs_sanitize_ga4_id( $value ) {
	$value = is_string( $value ) ? preg_replace( '/[^a-zA-Z0-9\-]/', '', $value ) : '';
	return substr( $value, 0, 50 );
}

/**
 * Sanitize GTM Container ID (alphanumeric and hyphen).
 *
 * @param string $value Raw value.
 * @return string
 */
function ccs_sanitize_gtm_id( $value ) {
	$value = is_string( $value ) ? preg_replace( '/[^a-zA-Z0-9\-]/', '', $value ) : '';
	return substr( $value, 0, 50 );
}

/**
 * Render Marketing → Settings page.
 */
function ccs_marketing_settings_page() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to view this page.', 'ccs-wp-theme' ) );
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Marketing Settings', 'ccs-wp-theme' ); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'ccs_marketing_settings' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="ccs_ga4_measurement_id"><?php esc_html_e( 'GA4 Measurement ID', 'ccs-wp-theme' ); ?></label></th>
					<td>
						<input type="text" name="ccs_ga4_measurement_id" id="ccs_ga4_measurement_id" value="<?php echo esc_attr( get_option( 'ccs_ga4_measurement_id', '' ) ); ?>" class="regular-text" placeholder="G-XXXXXXXXXX" />
						<p class="description"><?php esc_html_e( 'e.g. G-XXXXXXXXXX. Theme/front-end can output the gtag script.', 'ccs-wp-theme' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="ccs_gtm_container_id"><?php esc_html_e( 'GTM Container ID', 'ccs-wp-theme' ); ?></label></th>
					<td>
						<input type="text" name="ccs_gtm_container_id" id="ccs_gtm_container_id" value="<?php echo esc_attr( get_option( 'ccs_gtm_container_id', '' ) ); ?>" class="regular-text" placeholder="GTM-XXXXXXX" />
						<p class="description"><?php esc_html_e( 'e.g. GTM-XXXXXXX. Theme/front-end can output the GTM snippet.', 'ccs-wp-theme' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="ccs_marketing_consent_wording"><?php esc_html_e( 'Marketing consent wording', 'ccs-wp-theme' ); ?></label></th>
					<td>
						<textarea name="ccs_marketing_consent_wording" id="ccs_marketing_consent_wording" class="large-text" rows="4"><?php echo esc_textarea( get_option( 'ccs_marketing_consent_wording', '' ) ); ?></textarea>
						<p class="description"><?php esc_html_e( 'Optional text for cookie/consent banner (e.g. checkbox label).', 'ccs-wp-theme' ); ?></p>
					</td>
				</tr>
			</table>
			<?php submit_button( __( 'Save settings', 'ccs-wp-theme' ) ); ?>
		</form>
	</div>
	<?php
}

/**
 * Get GA4 Measurement ID (for theme/front-end).
 *
 * @return string
 */
function ccs_get_ga4_measurement_id() {
	return (string) get_option( 'ccs_ga4_measurement_id', '' );
}

/**
 * Get GTM Container ID (for theme/front-end).
 *
 * @return string
 */
function ccs_get_gtm_container_id() {
	return (string) get_option( 'ccs_gtm_container_id', '' );
}
