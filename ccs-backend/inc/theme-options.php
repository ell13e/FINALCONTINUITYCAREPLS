<?php
/**
 * Theme options (Settings) — enquiries email and API keys.
 *
 * Complements Customizer (contact/site info). Use this for keys and
 * enquiry routing so they are not in version control.
 *
 * @package CCS_Backend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register settings.
 */
function ccs_theme_options_register_settings() {
	register_setting( 'ccs_theme_options', 'ccs_enquiries_email', array(
		'type'              => 'string',
		'sanitize_callback'  => 'sanitize_email',
		'default'           => '',
	) );
	register_setting( 'ccs_theme_options', 'ccs_recaptcha_site_key', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	) );
	register_setting( 'ccs_theme_options', 'ccs_recaptcha_secret_key', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	) );
	register_setting( 'ccs_theme_options', 'ccs_google_maps_api_key', array(
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '',
	) );
}
add_action( 'admin_init', 'ccs_theme_options_register_settings' );

/**
 * Add options page under Settings.
 */
function ccs_theme_options_menu() {
	add_options_page(
		__( 'Theme options', 'ccs-wp-theme' ),
		__( 'Theme options', 'ccs-wp-theme' ),
		'manage_options',
		'ccs-theme-options',
		'ccs_theme_options_page'
	);
}
add_action( 'admin_menu', 'ccs_theme_options_menu' );

/**
 * Options page markup.
 */
function ccs_theme_options_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$enquiries_email = get_option( 'ccs_enquiries_email', 'office@continuitycareservices.co.uk' );
	$recaptcha_site  = get_option( 'ccs_recaptcha_site_key', '' );
	$recaptcha_secret = get_option( 'ccs_recaptcha_secret_key', '' );
	$maps_key        = get_option( 'ccs_google_maps_api_key', '' );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Theme options', 'ccs-wp-theme' ); ?></h1>
		<p class="description"><?php esc_html_e( 'Enquiries email and API keys. Contact/site details are in Appearance → Customize.', 'ccs-wp-theme' ); ?></p>

		<form method="post" action="options.php">
			<?php settings_fields( 'ccs_theme_options' ); ?>

			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">
						<label for="ccs_enquiries_email"><?php esc_html_e( 'Enquiries email', 'ccs-wp-theme' ); ?></label>
					</th>
					<td>
						<input type="email" name="ccs_enquiries_email" id="ccs_enquiries_email" value="<?php echo esc_attr( $enquiries_email ); ?>" class="regular-text" />
						<p class="description"><?php esc_html_e( 'Contact form submissions are sent to this address and saved as Form Submissions in the admin.', 'ccs-wp-theme' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="ccs_recaptcha_site_key"><?php esc_html_e( 'reCAPTCHA site key', 'ccs-wp-theme' ); ?></label>
					</th>
					<td>
						<input type="text" name="ccs_recaptcha_site_key" id="ccs_recaptcha_site_key" value="<?php echo esc_attr( $recaptcha_site ); ?>" class="regular-text" autocomplete="off" />
						<p class="description"><?php esc_html_e( 'Optional. Google reCAPTCHA v3 site key for forms.', 'ccs-wp-theme' ); ?> <a href="https://www.google.com/recaptcha/admin" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get keys', 'ccs-wp-theme' ); ?></a></p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="ccs_recaptcha_secret_key"><?php esc_html_e( 'reCAPTCHA secret key', 'ccs-wp-theme' ); ?></label>
					</th>
					<td>
						<input type="password" name="ccs_recaptcha_secret_key" id="ccs_recaptcha_secret_key" value="<?php echo esc_attr( $recaptcha_secret ); ?>" class="regular-text" autocomplete="off" />
						<p class="description"><?php esc_html_e( 'Keep this private. Used for server-side verification.', 'ccs-wp-theme' ); ?></p>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="ccs_google_maps_api_key"><?php esc_html_e( 'Google Maps API key', 'ccs-wp-theme' ); ?></label>
					</th>
					<td>
						<input type="text" name="ccs_google_maps_api_key" id="ccs_google_maps_api_key" value="<?php echo esc_attr( $maps_key ); ?>" class="regular-text" autocomplete="off" />
						<p class="description"><?php esc_html_e( 'Optional. For advanced Maps usage; simple iframe embeds do not require a key.', 'ccs-wp-theme' ); ?> <a href="https://console.cloud.google.com/google/maps-apis" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Google Cloud Console', 'ccs-wp-theme' ); ?></a></p>
					</td>
				</tr>
			</table>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Get enquiries email (for mail and fallbacks).
 *
 * @return string
 */
function ccs_get_enquiries_email() {
	return get_option( 'ccs_enquiries_email', 'office@continuitycareservices.co.uk' );
}

/**
 * Get reCAPTCHA site key.
 *
 * @return string
 */
function ccs_get_recaptcha_site_key() {
	return get_option( 'ccs_recaptcha_site_key', '' );
}

/**
 * Get reCAPTCHA secret key.
 *
 * @return string
 */
function ccs_get_recaptcha_secret_key() {
	return get_option( 'ccs_recaptcha_secret_key', '' );
}

/**
 * Get Google Maps API key.
 *
 * @return string
 */
function ccs_get_google_maps_api_key() {
	return get_option( 'ccs_google_maps_api_key', '' );
}
