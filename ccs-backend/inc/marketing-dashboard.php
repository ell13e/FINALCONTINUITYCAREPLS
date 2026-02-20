<?php
/**
 * Marketing Dashboard — reports (submissions by week, form type, source).
 *
 * @package CCS_Backend
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render Marketing → Dashboard page.
 */
function ccs_marketing_dashboard_page() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to view this page.', 'ccs-wp-theme' ) );
	}

	$six_months_ago = gmdate( 'Y-m-d', strtotime( '-6 months' ) );

	// Submissions by week (last 6 months)
	$by_week = ccs_marketing_submissions_by_week( $six_months_ago );
	// By form type
	$by_form_type = ccs_marketing_submissions_by_form_type( $six_months_ago );
	// By lead source
	$by_lead_source = ccs_marketing_submissions_by_lead_source( $six_months_ago );
	// By utm_source (top sources)
	$by_utm_source = ccs_marketing_submissions_by_utm_source( $six_months_ago );
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Marketing Dashboard', 'ccs-wp-theme' ); ?></h1>
		<p><?php esc_html_e( 'Submissions over the last 6 months.', 'ccs-wp-theme' ); ?></p>

		<h2><?php esc_html_e( 'Submissions by week', 'ccs-wp-theme' ); ?></h2>
		<table class="widefat striped" style="max-width: 480px;">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Week starting', 'ccs-wp-theme' ); ?></th>
					<th><?php esc_html_e( 'Count', 'ccs-wp-theme' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ( $by_week as $week => $count ) {
					echo '<tr><td>' . esc_html( $week ) . '</td><td>' . (int) $count . '</td></tr>';
				}
				if ( empty( $by_week ) ) {
					echo '<tr><td colspan="2">' . esc_html__( 'No submissions in this period.', 'ccs-wp-theme' ) . '</td></tr>';
				}
				?>
			</tbody>
		</table>

		<h2 style="margin-top: 24px;"><?php esc_html_e( 'By form type', 'ccs-wp-theme' ); ?></h2>
		<table class="widefat striped" style="max-width: 480px;">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Form type', 'ccs-wp-theme' ); ?></th>
					<th><?php esc_html_e( 'Count', 'ccs-wp-theme' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ( $by_form_type as $name => $count ) {
					echo '<tr><td>' . esc_html( $name ) . '</td><td>' . (int) $count . '</td></tr>';
				}
				if ( empty( $by_form_type ) ) {
					echo '<tr><td colspan="2">' . esc_html__( 'No submissions in this period.', 'ccs-wp-theme' ) . '</td></tr>';
				}
				?>
			</tbody>
		</table>

		<h2 style="margin-top: 24px;"><?php esc_html_e( 'By lead source', 'ccs-wp-theme' ); ?></h2>
		<table class="widefat striped" style="max-width: 480px;">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Lead source', 'ccs-wp-theme' ); ?></th>
					<th><?php esc_html_e( 'Count', 'ccs-wp-theme' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ( $by_lead_source as $name => $count ) {
					echo '<tr><td>' . esc_html( $name ) . '</td><td>' . (int) $count . '</td></tr>';
				}
				if ( empty( $by_lead_source ) ) {
					echo '<tr><td colspan="2">' . esc_html__( 'No data.', 'ccs-wp-theme' ) . '</td></tr>';
				}
				?>
			</tbody>
		</table>

		<h2 style="margin-top: 24px;"><?php esc_html_e( 'By UTM source', 'ccs-wp-theme' ); ?></h2>
		<table class="widefat striped" style="max-width: 480px;">
			<thead>
				<tr>
					<th><?php esc_html_e( 'UTM source', 'ccs-wp-theme' ); ?></th>
					<th><?php esc_html_e( 'Count', 'ccs-wp-theme' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ( $by_utm_source as $name => $count ) {
					$label = $name !== '' ? $name : __( '(none)', 'ccs-wp-theme' );
					echo '<tr><td>' . esc_html( $label ) . '</td><td>' . (int) $count . '</td></tr>';
				}
				if ( empty( $by_utm_source ) ) {
					echo '<tr><td colspan="2">' . esc_html__( 'No data.', 'ccs-wp-theme' ) . '</td></tr>';
				}
				?>
			</tbody>
		</table>
	</div>
	<?php
}

/**
 * Get submission counts by week (week-start date => count).
 *
 * @param string $after Date Y-m-d.
 * @return array
 */
function ccs_marketing_submissions_by_week( $after ) {
	$query = new WP_Query( array(
		'post_type'      => 'form_submission',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'date_query'     => array( array( 'after' => $after . ' 00:00:00', 'inclusive' => true ) ),
		'orderby'        => 'date',
		'order'          => 'ASC',
	) );
	$ids = $query->posts;
	if ( ! is_array( $ids ) ) {
		$ids = array();
	}
	$by_week = array();
	foreach ( $ids as $id ) {
		$post = get_post( $id );
		if ( ! $post || ! $post->post_date ) {
			continue;
		}
		$week_start = gmdate( 'Y-m-d', strtotime( 'monday this week', strtotime( $post->post_date ) ) );
		if ( ! isset( $by_week[ $week_start ] ) ) {
			$by_week[ $week_start ] = 0;
		}
		$by_week[ $week_start ]++;
	}
	ksort( $by_week );
	return $by_week;
}

/**
 * Get submission counts by form type (name => count).
 *
 * @param string $after Date Y-m-d.
 * @return array
 */
function ccs_marketing_submissions_by_form_type( $after ) {
	$terms = get_terms( array( 'taxonomy' => 'form_type', 'hide_empty' => false ) );
	if ( ! $terms || is_wp_error( $terms ) ) {
		return array();
	}
	$out = array();
	foreach ( $terms as $term ) {
		$q = new WP_Query( array(
			'post_type'      => 'form_submission',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'date_query'     => array( array( 'after' => $after . ' 00:00:00', 'inclusive' => true ) ),
			'tax_query'      => array( array( 'taxonomy' => 'form_type', 'field' => 'term_id', 'terms' => $term->term_id ) ),
		) );
		$count = is_array( $q->posts ) ? count( $q->posts ) : 0;
		if ( $count > 0 ) {
			$out[ $term->name ] = $count;
		}
	}
	return $out;
}

/**
 * Get submission counts by lead source (label => count).
 *
 * @param string $after Date Y-m-d.
 * @return array
 */
function ccs_marketing_submissions_by_lead_source( $after ) {
	$opts = function_exists( 'ccs_lead_source_options' ) ? ccs_lead_source_options() : array();
	$out = array();
	foreach ( $opts as $value => $label ) {
		$q = new WP_Query( array(
			'post_type'      => 'form_submission',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'date_query'     => array( array( 'after' => $after . ' 00:00:00', 'inclusive' => true ) ),
			'meta_query'     => array( array( 'key' => '_submission_lead_source', 'value' => $value ) ),
		) );
		$count = is_array( $q->posts ) ? count( $q->posts ) : 0;
		if ( $count > 0 ) {
			$out[ $label ] = $count;
		}
	}
	// Count empty/no selection
	$q = new WP_Query( array(
		'post_type'      => 'form_submission',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'date_query'     => array( array( 'after' => $after . ' 00:00:00', 'inclusive' => true ) ),
		'meta_query'     => array(
			'relation' => 'OR',
			array( 'key' => '_submission_lead_source', 'compare' => 'NOT EXISTS' ),
			array( 'key' => '_submission_lead_source', 'value' => '', 'compare' => '=' ),
		),
	) );
	$count = is_array( $q->posts ) ? count( $q->posts ) : 0;
	if ( $count > 0 ) {
		$out[ __( '(not set)', 'ccs-wp-theme' ) ] = $count;
	}
	return $out;
}

/**
 * Get submission counts by utm_source (value => count), top N.
 *
 * @param string $after Date Y-m-d.
 * @param int    $top   Max number of rows.
 * @return array
 */
function ccs_marketing_submissions_by_utm_source( $after, $top = 15 ) {
	$query = new WP_Query( array(
		'post_type'      => 'form_submission',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'fields'         => 'ids',
		'date_query'     => array( array( 'after' => $after . ' 00:00:00', 'inclusive' => true ) ),
	) );
	$ids = $query->posts;
	if ( ! is_array( $ids ) ) {
		$ids = array();
	}
	$counts = array();
	foreach ( $ids as $id ) {
		$val = get_post_meta( $id, '_submission_utm_source', true );
		$val = is_string( $val ) ? trim( $val ) : '';
		if ( ! isset( $counts[ $val ] ) ) {
			$counts[ $val ] = 0;
		}
		$counts[ $val ]++;
	}
	arsort( $counts, SORT_NUMERIC );
	return array_slice( $counts, 0, $top, true );
}
