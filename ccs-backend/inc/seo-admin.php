<?php
/**
 * SEO Admin — menu, dashboard (verification), settings, redirects.
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add SEO admin menu and subpages.
 */
function ccs_add_seo_admin_menu() {
	add_menu_page(
		__( 'SEO', 'ccs-wp-theme' ),
		__( 'SEO', 'ccs-wp-theme' ),
		'manage_options',
		'ccs-seo',
		'ccs_seo_dashboard_page',
		'dashicons-search',
		30
	);
	add_submenu_page(
		'ccs-seo',
		__( 'SEO Dashboard', 'ccs-wp-theme' ),
		__( 'Dashboard', 'ccs-wp-theme' ),
		'manage_options',
		'ccs-seo',
		'ccs_seo_dashboard_page'
	);
	add_submenu_page(
		'ccs-seo',
		__( 'SEO Settings', 'ccs-wp-theme' ),
		__( 'Settings', 'ccs-wp-theme' ),
		'manage_options',
		'ccs-seo-settings',
		'ccs_seo_settings_page'
	);
	add_submenu_page(
		'ccs-seo',
		__( 'Redirects', 'ccs-wp-theme' ),
		__( 'Redirects', 'ccs-wp-theme' ),
		'manage_options',
		'ccs-seo-redirects',
		'ccs_seo_redirects_page'
	);
}
add_action( 'admin_menu', 'ccs_add_seo_admin_menu', 20 );

/**
 * Register SEO options (redirects, verification).
 */
function ccs_register_seo_options() {
	register_setting( 'ccs_seo_redirects', 'ccs_redirect_attachments_enabled', array(
		'type'              => 'integer',
		'default'           => 1,
		'sanitize_callback'  => function ( $v ) { return ! empty( $v ) ? 1 : 0; },
	) );
	register_setting( 'ccs_seo_redirects', 'ccs_strip_category_base_enabled', array(
		'type'              => 'integer',
		'default'           => 0,
		'sanitize_callback'  => function ( $v ) { return ! empty( $v ) ? 1 : 0; },
	) );
	register_setting( 'ccs_seo_settings', 'ccs_seo_title_separator', array(
		'type'         => 'string',
		'default'      => '|',
		'sanitize_callback' => 'sanitize_text_field',
	) );
}
add_action( 'admin_init', 'ccs_register_seo_options' );

/**
 * SEO Dashboard — verification results.
 */
function ccs_seo_dashboard_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$results = function_exists( 'ccs_run_seo_verification' ) ? ccs_run_seo_verification() : array();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'SEO Dashboard', 'ccs-wp-theme' ); ?></h1>
		<?php if ( ! empty( $results['checks'] ) ) : ?>
			<p><strong><?php esc_html_e( 'Score:', 'ccs-wp-theme' ); ?></strong> <?php echo (int) $results['score']; ?>% —
				<?php
				if ( $results['overall_status'] === 'pass' ) {
					esc_html_e( 'All checks passed.', 'ccs-wp-theme' );
				} elseif ( $results['overall_status'] === 'warning' ) {
					esc_html_e( 'Some warnings.', 'ccs-wp-theme' );
				} else {
					esc_html_e( 'Some errors.', 'ccs-wp-theme' );
				}
				?>
			</p>
			<table class="widefat striped">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Check', 'ccs-wp-theme' ); ?></th>
						<th><?php esc_html_e( 'Status', 'ccs-wp-theme' ); ?></th>
						<th><?php esc_html_e( 'Details', 'ccs-wp-theme' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $results['checks'] as $key => $check ) : ?>
						<tr>
							<td><?php echo esc_html( isset( $check['name'] ) ? $check['name'] : $key ); ?></td>
							<td><?php echo esc_html( isset( $check['status'] ) ? $check['status'] : '—' ); ?></td>
							<td>
								<?php
								if ( ! empty( $check['issues'] ) ) {
									echo esc_html( implode( ' ', $check['issues'] ) );
								}
								if ( ! empty( $check['recommendations'] ) ) {
									echo ' ' . esc_html( implode( ' ', $check['recommendations'] ) );
								}
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else : ?>
			<p><?php esc_html_e( 'Verification not available.', 'ccs-wp-theme' ); ?></p>
		<?php endif; ?>
		<p><a href="<?php echo esc_url( admin_url( 'admin.php?page=ccs-seo-settings' ) ); ?>" class="button"><?php esc_html_e( 'SEO Settings', 'ccs-wp-theme' ); ?></a>
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=ccs-seo-redirects' ) ); ?>" class="button"><?php esc_html_e( 'Redirects', 'ccs-wp-theme' ); ?></a></p>
	</div>
	<?php
}

/**
 * SEO Settings — title separator.
 */
function ccs_seo_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$sep = get_option( 'ccs_seo_title_separator', '|' );
	if ( isset( $_POST['ccs_seo_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ccs_seo_settings_nonce'] ) ), 'ccs_seo_settings' ) ) {
		$sep = isset( $_POST['ccs_seo_title_separator'] ) ? sanitize_text_field( wp_unslash( $_POST['ccs_seo_title_separator'] ) ) : '|';
		update_option( 'ccs_seo_title_separator', $sep );
		echo '<div class="notice notice-success"><p>' . esc_html__( 'Settings saved.', 'ccs-wp-theme' ) . '</p></div>';
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'SEO Settings', 'ccs-wp-theme' ); ?></h1>
		<form method="post" action="">
			<?php wp_nonce_field( 'ccs_seo_settings', 'ccs_seo_settings_nonce' ); ?>
			<table class="form-table">
				<tr>
					<th><label for="ccs_seo_title_separator"><?php esc_html_e( 'Title separator', 'ccs-wp-theme' ); ?></label></th>
					<td><input type="text" id="ccs_seo_title_separator" name="ccs_seo_title_separator" value="<?php echo esc_attr( $sep ); ?>" class="small-text" /> <span class="description"><?php esc_html_e( 'e.g. | or –', 'ccs-wp-theme' ); ?></span></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}

/**
 * Redirects — attachment redirect, strip category base.
 */
function ccs_seo_redirects_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$redirect_attachments = (bool) get_option( 'ccs_redirect_attachments_enabled', 1 );
	$strip_category = (bool) get_option( 'ccs_strip_category_base_enabled', 0 );
	if ( isset( $_POST['ccs_seo_redirects_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ccs_seo_redirects_nonce'] ) ), 'ccs_seo_redirects' ) ) {
		$redirect_attachments = ! empty( $_POST['ccs_redirect_attachments_enabled'] );
		$strip_category       = ! empty( $_POST['ccs_strip_category_base_enabled'] );
		update_option( 'ccs_redirect_attachments_enabled', $redirect_attachments ? 1 : 0 );
		update_option( 'ccs_strip_category_base_enabled', $strip_category ? 1 : 0 );
		echo '<div class="notice notice-success"><p>' . esc_html__( 'Settings saved. If you changed "Strip category base", go to Settings → Permalinks and click Save to flush rewrite rules.', 'ccs-wp-theme' ) . '</p></div>';
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Redirects', 'ccs-wp-theme' ); ?></h1>
		<form method="post" action="">
			<?php wp_nonce_field( 'ccs_seo_redirects', 'ccs_seo_redirects_nonce' ); ?>
			<table class="form-table">
				<tr>
					<th><?php esc_html_e( 'Attachment redirect', 'ccs-wp-theme' ); ?></th>
					<td>
						<label><input type="checkbox" name="ccs_redirect_attachments_enabled" value="1" <?php checked( $redirect_attachments ); ?> /> <?php esc_html_e( 'Redirect attachment pages to parent post (or home)', 'ccs-wp-theme' ); ?></label>
					</td>
				</tr>
				<tr>
					<th><?php esc_html_e( 'Strip category base', 'ccs-wp-theme' ); ?></th>
					<td>
						<label><input type="checkbox" name="ccs_strip_category_base_enabled" value="1" <?php checked( $strip_category ); ?> /> <?php esc_html_e( 'Remove /category/ from category URLs', 'ccs-wp-theme' ); ?></label>
						<p class="description"><?php esc_html_e( 'After changing, save Permalinks once.', 'ccs-wp-theme' ); ?></p>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
