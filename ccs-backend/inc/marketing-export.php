<?php
/**
 * Marketing Export — CSV export of form submissions with filters.
 *
 * @package CCS_Backend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Escape a value for CSV (quotes and newlines).
 *
 * @param string $value Cell value.
 * @return string
 */
function ccs_export_csv_cell( $value ) {
	$value = (string) $value;
	if ( strpos( $value, '"' ) !== false || strpos( $value, "\n" ) !== false || strpos( $value, "\r" ) !== false || strpos( $value, ',' ) !== false ) {
		return '"' . str_replace( '"', '""', $value ) . '"';
	}
	return $value;
}

/**
 * Output CSV row (headers or data).
 *
 * @param array $row Array of cell values.
 */
function ccs_export_csv_row( $row ) {
	$out = array();
	foreach ( $row as $cell ) {
		$out[] = ccs_export_csv_cell( $cell );
	}
	echo implode( ',', $out ) . "\r\n";
}

/**
 * Handle CSV download (stream and exit).
 */
function ccs_export_submissions_csv_stream() {
	if ( ! isset( $_GET['page'] ) || $_GET['page'] !== 'ccs-export-submissions' || ! isset( $_GET['ccs_export_csv'] ) || ! isset( $_GET['_wpnonce'] ) ) {
		return;
	}
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to export.', 'ccs-wp-theme' ), 403 );
	}
	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'ccs_export_submissions_csv' ) ) {
		wp_die( esc_html__( 'Security check failed.', 'ccs-wp-theme' ), 403 );
	}

	$date_from = isset( $_GET['date_from'] ) ? sanitize_text_field( wp_unslash( $_GET['date_from'] ) ) : '';
	$date_to   = isset( $_GET['date_to'] ) ? sanitize_text_field( wp_unslash( $_GET['date_to'] ) ) : '';
	$form_type = isset( $_GET['form_type'] ) ? sanitize_text_field( wp_unslash( $_GET['form_type'] ) ) : '';
	$utm_source = isset( $_GET['utm_source'] ) ? sanitize_text_field( wp_unslash( $_GET['utm_source'] ) ) : '';
	$lead_source = isset( $_GET['lead_source'] ) ? sanitize_text_field( wp_unslash( $_GET['lead_source'] ) ) : '';
	$marketing_only = ! empty( $_GET['marketing_consented_only'] );

	$args = array(
		'post_type'      => 'form_submission',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	$date_query = array();
	if ( $date_from ) {
		$date_query[] = array( 'after' => $date_from . ' 00:00:00', 'inclusive' => true );
	}
	if ( $date_to ) {
		$date_query[] = array( 'before' => $date_to . ' 23:59:59', 'inclusive' => true );
	}
	if ( ! empty( $date_query ) ) {
		$args['date_query'] = $date_query;
	}

	if ( $form_type ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'form_type',
				'field'   => 'slug',
				'terms'    => $form_type,
			),
		);
	}

	$meta_query = array();
	if ( $utm_source ) {
		$meta_query[] = array(
			'key'   => '_submission_utm_source',
			'value' => $utm_source,
		);
	}
	if ( $lead_source ) {
		$meta_query[] = array(
			'key'   => '_submission_lead_source',
			'value' => $lead_source,
		);
	}
	if ( $marketing_only ) {
		$meta_query[] = array(
			'key'   => '_submission_marketing_consent',
			'value' => 'yes',
		);
	}
	if ( ! empty( $meta_query ) ) {
		$args['meta_query'] = $meta_query;
	}

	$query = new WP_Query( $args );
	$ids   = $query->posts;
	if ( ! is_array( $ids ) ) {
		$ids = array();
	}

	$filename = 'form-submissions-' . gmdate( 'Y-m-d-His' ) . '.csv';
	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=' . $filename );
	header( 'Cache-Control: no-cache, no-store, must-revalidate' );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );

	$fp = fopen( 'php://output', 'w' );
	if ( $fp ) {
		fprintf( $fp, "\xEF\xBB\xBF" );
	}
	// Headers
	ccs_export_csv_row( array(
		'date',
		'name',
		'email',
		'phone',
		'form type',
		'lead source',
		'utm_source',
		'utm_medium',
		'utm_campaign',
		'page_url',
		'referrer',
		'consent',
		'marketing_consent',
		'consent_at',
		'marketing_consent_at',
		'followup_status',
		'notes',
	) );

	$statuses = function_exists( 'ccs_submission_followup_statuses' ) ? ccs_submission_followup_statuses() : array();
	$lead_opts = function_exists( 'ccs_lead_source_options' ) ? ccs_lead_source_options() : array();

	foreach ( $ids as $post_id ) {
		$post = get_post( $post_id );
		if ( ! $post ) {
			continue;
		}
		$terms = get_the_terms( $post_id, 'form_type' );
		$form_type_label = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';
		$status = get_post_meta( $post_id, '_submission_followup_status', true );
		$status_label = ( $status && isset( $statuses[ $status ] ) ) ? $statuses[ $status ] : $status;
		$lead_src = get_post_meta( $post_id, '_submission_lead_source', true );
		$lead_label = ( $lead_src && isset( $lead_opts[ $lead_src ] ) ) ? $lead_opts[ $lead_src ] : $lead_src;

		ccs_export_csv_row( array(
			get_the_date( 'Y-m-d H:i:s', $post ),
			get_post_meta( $post_id, '_submission_name', true ),
			get_post_meta( $post_id, '_submission_email', true ),
			get_post_meta( $post_id, '_submission_phone', true ),
			$form_type_label,
			$lead_label,
			get_post_meta( $post_id, '_submission_utm_source', true ),
			get_post_meta( $post_id, '_submission_utm_medium', true ),
			get_post_meta( $post_id, '_submission_utm_campaign', true ),
			get_post_meta( $post_id, '_submission_page_url', true ),
			get_post_meta( $post_id, '_submission_referrer', true ),
			get_post_meta( $post_id, '_submission_consent', true ),
			get_post_meta( $post_id, '_submission_marketing_consent', true ),
			get_post_meta( $post_id, '_submission_consent_at', true ),
			get_post_meta( $post_id, '_submission_marketing_consent_at', true ),
			$status_label,
			get_post_meta( $post_id, '_submission_followup_notes', true ),
		) );
	}
	exit;
}

// Run before admin page render so we can stream and exit.
add_action( 'admin_init', 'ccs_export_submissions_csv_stream', 5 );

/**
 * Render Marketing → Export page (filter form and trigger download).
 */
function ccs_export_submissions_page() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to view this page.', 'ccs-wp-theme' ) );
	}

	$date_from = isset( $_GET['date_from'] ) ? sanitize_text_field( wp_unslash( $_GET['date_from'] ) ) : '';
	$date_to   = isset( $_GET['date_to'] ) ? sanitize_text_field( wp_unslash( $_GET['date_to'] ) ) : '';
	$form_type = isset( $_GET['form_type'] ) ? sanitize_text_field( wp_unslash( $_GET['form_type'] ) ) : '';
	$utm_source = isset( $_GET['utm_source'] ) ? sanitize_text_field( wp_unslash( $_GET['utm_source'] ) ) : '';
	$lead_source = isset( $_GET['lead_source'] ) ? sanitize_text_field( wp_unslash( $_GET['lead_source'] ) ) : '';
	$marketing_only = ! empty( $_GET['marketing_consented_only'] );

	$export_url = add_query_arg( array(
		'page'                   => 'ccs-export-submissions',
		'ccs_export_csv'         => '1',
		'_wpnonce'               => wp_create_nonce( 'ccs_export_submissions_csv' ),
		'date_from'              => $date_from,
		'date_to'                => $date_to,
		'form_type'              => $form_type,
		'utm_source'             => $utm_source,
		'lead_source'            => $lead_source,
		'marketing_consented_only' => $marketing_only ? '1' : '',
	), admin_url( 'admin.php' ) );

	$form_types = get_terms( array( 'taxonomy' => 'form_type', 'hide_empty' => false ) );
	$lead_opts = function_exists( 'ccs_lead_source_options' ) ? ccs_lead_source_options() : array();
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Export submissions', 'ccs-wp-theme' ); ?></h1>
		<p><?php esc_html_e( 'Filter submissions and download as CSV.', 'ccs-wp-theme' ); ?></p>

		<form method="get" action="<?php echo esc_url( admin_url( 'admin.php' ) ); ?>" class="ccs-export-filters" style="max-width: 640px; margin: 1em 0;">
			<input type="hidden" name="page" value="ccs-export-submissions" />
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="date_from"><?php esc_html_e( 'Date from', 'ccs-wp-theme' ); ?></label></th>
					<td><input type="date" name="date_from" id="date_from" value="<?php echo esc_attr( $date_from ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="date_to"><?php esc_html_e( 'Date to', 'ccs-wp-theme' ); ?></label></th>
					<td><input type="date" name="date_to" id="date_to" value="<?php echo esc_attr( $date_to ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="form_type"><?php esc_html_e( 'Form type', 'ccs-wp-theme' ); ?></label></th>
					<td>
						<select name="form_type" id="form_type">
							<option value=""><?php esc_html_e( 'All', 'ccs-wp-theme' ); ?></option>
							<?php
							if ( $form_types && ! is_wp_error( $form_types ) ) {
								foreach ( $form_types as $term ) {
									echo '<option value="' . esc_attr( $term->slug ) . '"' . selected( $form_type, $term->slug, false ) . '>' . esc_html( $term->name ) . '</option>';
								}
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="utm_source"><?php esc_html_e( 'UTM source', 'ccs-wp-theme' ); ?></label></th>
					<td><input type="text" name="utm_source" id="utm_source" value="<?php echo esc_attr( $utm_source ); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="lead_source"><?php esc_html_e( 'Lead source', 'ccs-wp-theme' ); ?></label></th>
					<td>
						<select name="lead_source" id="lead_source">
							<option value=""><?php esc_html_e( 'All', 'ccs-wp-theme' ); ?></option>
							<?php
							foreach ( $lead_opts as $val => $label ) {
								echo '<option value="' . esc_attr( $val ) . '"' . selected( $lead_source, $val, false ) . '>' . esc_html( $label ) . '</option>';
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Marketing consented only', 'ccs-wp-theme' ); ?></th>
					<td>
						<label><input type="checkbox" name="marketing_consented_only" value="1" <?php checked( $marketing_only ); ?> /> <?php esc_html_e( 'Only export submissions with marketing consent', 'ccs-wp-theme' ); ?></label>
					</td>
				</tr>
			</table>
			<p>
				<button type="submit" class="button"><?php esc_html_e( 'Apply filters', 'ccs-wp-theme' ); ?></button>
				<a href="<?php echo esc_url( $export_url ); ?>" class="button button-primary"><?php esc_html_e( 'Download CSV', 'ccs-wp-theme' ); ?></a>
			</p>
		</form>
	</div>
	<?php
}

/**
 * Add Export link on Form Submissions list screen.
 */
function ccs_form_submissions_export_link( $post_type ) {
	if ( $post_type !== 'form_submission' || ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	$url = admin_url( 'admin.php?page=ccs-export-submissions' );
	echo ' <a href="' . esc_url( $url ) . '" class="page-title-action">' . esc_html__( 'Export CSV', 'ccs-wp-theme' ) . '</a>';
}
add_action( 'restrict_manage_posts', 'ccs_form_submissions_export_link', 10, 1 );
