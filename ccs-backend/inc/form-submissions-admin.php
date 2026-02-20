<?php
/**
 * Form Submissions Admin — list view and edit screen (home care tailored).
 *
 * Assignees: AC, DK, KV, MZ, NM, SRF, VW, ZC (alphabetical).
 * Follow-up statuses tailored for home care.
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Assignees (alphabetical) */
function ccs_submission_assignees() {
	return array( 'AC', 'DK', 'KV', 'MZ', 'NM', 'SRF', 'VW', 'ZC' );
}

/**
 * Lead source options ("How did you hear about us?").
 *
 * @return array Value => label for dropdown/display.
 */
function ccs_lead_source_options() {
	return array(
		'google'   => __( 'Google', 'ccs-wp-theme' ),
		'facebook' => __( 'Facebook', 'ccs-wp-theme' ),
		'referral' => __( 'Referral', 'ccs-wp-theme' ),
		'leaflet'  => __( 'Leaflet', 'ccs-wp-theme' ),
		'other'    => __( 'Other', 'ccs-wp-theme' ),
	);
}

/** Follow-up status options (home care) */
function ccs_submission_followup_statuses() {
	return array(
		'new'              => __( 'New enquiry', 'ccs-wp-theme' ),
		'needed'            => __( 'Requires follow-up', 'ccs-wp-theme' ),
		'contacted-email'   => __( 'Contacted (email)', 'ccs-wp-theme' ),
		'contacted-phone'   => __( 'Contacted (phone)', 'ccs-wp-theme' ),
		'contacted-both'    => __( 'Contacted (both)', 'ccs-wp-theme' ),
		'in-progress'       => __( 'In progress', 'ccs-wp-theme' ),
		'assessment-booked' => __( 'Assessment booked', 'ccs-wp-theme' ),
		'care-started'      => __( 'Care started', 'ccs-wp-theme' ),
		'completed'         => __( 'Completed', 'ccs-wp-theme' ),
		'cancelled'         => __( 'Cancelled', 'ccs-wp-theme' ),
	);
}

/**
 * Admin notice: recent submissions count on dashboard.
 */
function ccs_form_submissions_admin_notice() {
	$screen = get_current_screen();
	if ( ! $screen || $screen->id !== 'dashboard' ) {
		return;
	}
	$recent = get_posts( array(
		'post_type'      => 'form_submission',
		'post_status'    => 'publish',
		'posts_per_page' => 10,
		'date_query'     => array( array( 'after' => '7 days ago' ) ),
		'fields'         => 'ids',
	) );
	$count = is_array( $recent ) ? count( $recent ) : 0;
	if ( $count === 0 ) {
		return;
	}
	echo '<div class="notice notice-info is-dismissible"><p><strong>Form Submissions:</strong> ';
	echo esc_html( sprintf( _n( 'You have %s new submission in the last 7 days.', 'You have %s new submissions in the last 7 days.', $count ), $count ) );
	echo ' <a href="' . esc_url( admin_url( 'edit.php?post_type=form_submission' ) ) . '">' . esc_html__( 'View all submissions', 'ccs-wp-theme' ) . ' &rarr;</a></p></div>';
}
add_action( 'admin_notices', 'ccs_form_submissions_admin_notice' );

/**
 * Admin columns for form submissions list.
 */
function ccs_form_submission_columns( $columns ) {
	$new = array();
	if ( isset( $columns['cb'] ) ) {
		$new['cb'] = $columns['cb'];
	}
	$new['title']           = __( 'Name', 'ccs-wp-theme' );
	$new['form_type']       = __( 'Form type', 'ccs-wp-theme' );
	$new['source']          = __( 'Source', 'ccs-wp-theme' );
	$new['contact_info']    = __( 'Contact', 'ccs-wp-theme' );
	$new['followup_status'] = __( 'Status', 'ccs-wp-theme' );
	$new['followup_notes']  = __( 'Notes', 'ccs-wp-theme' );
	$new['assigned_to']     = __( 'Assigned', 'ccs-wp-theme' );
	$new['email_status']    = __( 'Email', 'ccs-wp-theme' );
	$new['date']            = __( 'Submitted', 'ccs-wp-theme' );
	return $new;
}
add_filter( 'manage_form_submission_posts_columns', 'ccs_form_submission_columns' );

/**
 * Populate custom columns.
 */
function ccs_form_submission_column_content( $column, $post_id ) {
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	switch ( $column ) {
		case 'form_type':
			$terms = get_the_terms( $post_id, 'form_type' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				echo esc_html( $terms[0]->name );
			} else {
				echo '—';
			}
			break;
		case 'source':
			$lead_src = get_post_meta( $post_id, '_submission_lead_source', true );
			$utm_src  = get_post_meta( $post_id, '_submission_utm_source', true );
			$utm_med  = get_post_meta( $post_id, '_submission_utm_medium', true );
			$utm_cam  = get_post_meta( $post_id, '_submission_utm_campaign', true );
			if ( $lead_src && function_exists( 'ccs_lead_source_options' ) ) {
				$opts = ccs_lead_source_options();
				echo esc_html( isset( $opts[ $lead_src ] ) ? $opts[ $lead_src ] : $lead_src );
			} elseif ( $utm_src || $utm_med || $utm_cam ) {
				$parts = array_filter( array( $utm_src, $utm_med, $utm_cam ) );
				echo esc_html( implode( ' / ', $parts ) );
			} else {
				echo '—';
			}
			break;
		case 'contact_info':
			$email = get_post_meta( $post_id, '_submission_email', true );
			$phone = get_post_meta( $post_id, '_submission_phone', true );
			$parts = array();
			if ( $email ) {
				$parts[] = '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
			}
			if ( $phone ) {
				$parts[] = esc_html( $phone );
			}
			echo $parts ? wp_kses_post( implode( ' · ', $parts ) ) : '—';
			break;
		case 'followup_status':
			$status = get_post_meta( $post_id, '_submission_followup_status', true );
			$labels = ccs_submission_followup_statuses();
			echo $status && isset( $labels[ $status ] ) ? esc_html( $labels[ $status ] ) : '—';
			break;
		case 'followup_notes':
			$notes = get_post_meta( $post_id, '_submission_followup_notes', true );
			echo $notes ? esc_html( wp_trim_words( $notes, 12 ) ) : '—';
			break;
		case 'assigned_to':
			$assigned = get_post_meta( $post_id, '_submission_assigned_to', true );
			echo $assigned ? esc_html( $assigned ) : '—';
			break;
		case 'email_status':
			$sent   = get_post_meta( $post_id, '_submission_email_sent', true );
			$error  = get_post_meta( $post_id, '_submission_email_error', true );
			if ( $sent === 'yes' || $sent === '1' ) {
				echo '<span style="color:#00a32a;">' . esc_html__( 'Sent', 'ccs-wp-theme' ) . '</span>';
			} elseif ( $error ) {
				echo '<span style="color:#d63638;" title="' . esc_attr( $error ) . '">' . esc_html__( 'Failed', 'ccs-wp-theme' ) . '</span>';
			} else {
				echo '—';
			}
			break;
	}
}
add_action( 'manage_form_submission_posts_custom_column', 'ccs_form_submission_column_content', 10, 2 );

/**
 * Make assignee and status columns sortable (optional; can add later).
 */

/**
 * Add meta boxes on edit submission.
 */
function ccs_form_submission_meta_boxes() {
	remove_meta_box( 'tagsdiv-form_type', 'form_submission', 'side' );
	add_meta_box(
		'ccs_submission_details',
		__( 'Submission details', 'ccs-wp-theme' ),
		'ccs_form_submission_details_callback',
		'form_submission',
		'normal',
		'high'
	);
	add_meta_box(
		'ccs_submission_followup',
		__( 'Follow-up', 'ccs-wp-theme' ),
		'ccs_form_submission_followup_callback',
		'form_submission',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'ccs_form_submission_meta_boxes' );

/**
 * Meta box: submission details (read-only).
 */
function ccs_form_submission_details_callback( $post ) {
	if ( ! current_user_can( 'edit_posts' ) ) {
		echo '<p>' . esc_html__( 'You do not have permission to view this.', 'ccs-wp-theme' ) . '</p>';
		return;
	}
	$name    = get_post_meta( $post->ID, '_submission_name', true );
	$email   = get_post_meta( $post->ID, '_submission_email', true );
	$phone   = get_post_meta( $post->ID, '_submission_phone', true );
	$message = get_post_meta( $post->ID, '_submission_message', true );
	$page_url = get_post_meta( $post->ID, '_submission_page_url', true );
	$consent  = get_post_meta( $post->ID, '_submission_marketing_consent', true );
	$terms    = get_the_terms( $post->ID, 'form_type' );
	$form_type = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';
	echo '<table class="form-table" role="presentation"><tbody>';
	echo '<tr><th scope="row">' . esc_html__( 'Submitted', 'ccs-wp-theme' ) . '</th><td>' . esc_html( get_the_date( 'd M Y H:i', $post ) ) . '</td></tr>';
	if ( $form_type ) {
		echo '<tr><th scope="row">' . esc_html__( 'Form type', 'ccs-wp-theme' ) . '</th><td>' . esc_html( $form_type ) . '</td></tr>';
	}
	if ( $name ) {
		echo '<tr><th scope="row">' . esc_html__( 'Name', 'ccs-wp-theme' ) . '</th><td>' . esc_html( $name ) . '</td></tr>';
	}
	if ( $email ) {
		echo '<tr><th scope="row">' . esc_html__( 'Email', 'ccs-wp-theme' ) . '</th><td><a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a></td></tr>';
	}
	if ( $phone ) {
		$tel = preg_replace( '/\D/', '', $phone );
		echo '<tr><th scope="row">' . esc_html__( 'Phone', 'ccs-wp-theme' ) . '</th><td><a href="tel:' . esc_attr( $tel ) . '">' . esc_html( $phone ) . '</a></td></tr>';
	}
	if ( $consent ) {
		echo '<tr><th scope="row">' . esc_html__( 'Marketing consent', 'ccs-wp-theme' ) . '</th><td>' . ( $consent === 'yes' ? esc_html__( 'Yes', 'ccs-wp-theme' ) : esc_html__( 'No', 'ccs-wp-theme' ) ) . '</td></tr>';
	}
	$consent_at         = get_post_meta( $post->ID, '_submission_consent_at', true );
	$marketing_consent_at = get_post_meta( $post->ID, '_submission_marketing_consent_at', true );
	if ( $consent_at ) {
		echo '<tr><th scope="row">' . esc_html__( 'Consent at', 'ccs-wp-theme' ) . '</th><td>' . esc_html( $consent_at ) . '</td></tr>';
	}
	if ( $marketing_consent_at ) {
		echo '<tr><th scope="row">' . esc_html__( 'Marketing consent at', 'ccs-wp-theme' ) . '</th><td>' . esc_html( $marketing_consent_at ) . '</td></tr>';
	}
	$lead_src = get_post_meta( $post->ID, '_submission_lead_source', true );
	if ( $lead_src && function_exists( 'ccs_lead_source_options' ) ) {
		$opts = ccs_lead_source_options();
		echo '<tr><th scope="row">' . esc_html__( 'Lead source', 'ccs-wp-theme' ) . '</th><td>' . esc_html( isset( $opts[ $lead_src ] ) ? $opts[ $lead_src ] : $lead_src ) . '</td></tr>';
	}
	if ( $page_url ) {
		echo '<tr><th scope="row">' . esc_html__( 'Submitted from', 'ccs-wp-theme' ) . '</th><td><a href="' . esc_url( $page_url ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $page_url ) . '</a></td></tr>';
	}
	$utm_source   = get_post_meta( $post->ID, '_submission_utm_source', true );
	$utm_medium   = get_post_meta( $post->ID, '_submission_utm_medium', true );
	$utm_campaign = get_post_meta( $post->ID, '_submission_utm_campaign', true );
	$utm_content  = get_post_meta( $post->ID, '_submission_utm_content', true );
	$utm_term     = get_post_meta( $post->ID, '_submission_utm_term', true );
	$referrer     = get_post_meta( $post->ID, '_submission_referrer', true );
	$has_attr     = $utm_source || $utm_medium || $utm_campaign || $utm_content || $utm_term || $referrer;
	echo '<tr><th scope="row">' . esc_html__( 'Attribution', 'ccs-wp-theme' ) . '</th><td>';
	if ( $has_attr ) {
		$attr_parts = array();
		if ( $utm_source ) {
			$attr_parts[] = 'utm_source: ' . esc_html( $utm_source );
		}
		if ( $utm_medium ) {
			$attr_parts[] = 'utm_medium: ' . esc_html( $utm_medium );
		}
		if ( $utm_campaign ) {
			$attr_parts[] = 'utm_campaign: ' . esc_html( $utm_campaign );
		}
		if ( $utm_content ) {
			$attr_parts[] = 'utm_content: ' . esc_html( $utm_content );
		}
		if ( $utm_term ) {
			$attr_parts[] = 'utm_term: ' . esc_html( $utm_term );
		}
		if ( $referrer ) {
			$attr_parts[] = 'referrer: <a href="' . esc_url( $referrer ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $referrer ) . '</a>';
		}
		echo wp_kses_post( implode( ' &middot; ', $attr_parts ) );
	} else {
		echo '—';
	}
	echo '</td></tr>';
	echo '</tbody></table>';
	if ( $message ) {
		echo '<h4>' . esc_html__( 'Message', 'ccs-wp-theme' ) . '</h4><div class="notice inline"><p>' . nl2br( esc_html( $message ) ) . '</p></div>';
	}
}

/**
 * Meta box: follow-up (status, assignee, notes) — editable.
 */
function ccs_form_submission_followup_callback( $post ) {
	if ( ! current_user_can( 'edit_posts' ) ) {
		echo '<p>' . esc_html__( 'You do not have permission to edit this.', 'ccs-wp-theme' ) . '</p>';
		return;
	}
	wp_nonce_field( 'ccs_form_submission_followup', 'ccs_form_submission_followup_nonce' );
	$status   = get_post_meta( $post->ID, '_submission_followup_status', true );
	$assigned = get_post_meta( $post->ID, '_submission_assigned_to', true );
	$notes    = get_post_meta( $post->ID, '_submission_followup_notes', true );
	$statuses = ccs_submission_followup_statuses();
	$assignees = ccs_submission_assignees();
	echo '<p><label for="ccs_followup_status"><strong>' . esc_html__( 'Status', 'ccs-wp-theme' ) . '</strong></label></p>';
	echo '<select name="ccs_followup_status" id="ccs_followup_status" class="widefat">';
	echo '<option value="">—</option>';
	foreach ( $statuses as $key => $label ) {
		echo '<option value="' . esc_attr( $key ) . '"' . selected( $status, $key, false ) . '>' . esc_html( $label ) . '</option>';
	}
	echo '</select>';
	echo '<p style="margin-top:12px;"><label for="ccs_assigned_to"><strong>' . esc_html__( 'Assigned to', 'ccs-wp-theme' ) . '</strong></label></p>';
	echo '<select name="ccs_assigned_to" id="ccs_assigned_to" class="widefat">';
	echo '<option value="">—</option>';
	foreach ( $assignees as $code ) {
		echo '<option value="' . esc_attr( $code ) . '"' . selected( $assigned, $code, false ) . '>' . esc_html( $code ) . '</option>';
	}
	echo '</select>';
	echo '<p style="margin-top:12px;"><label for="ccs_followup_notes"><strong>' . esc_html__( 'Notes', 'ccs-wp-theme' ) . '</strong></label></p>';
	echo '<textarea name="ccs_followup_notes" id="ccs_followup_notes" class="widefat" rows="4">' . esc_textarea( $notes ) . '</textarea>';
}

/**
 * Save follow-up meta on save submission.
 */
function ccs_form_submission_save_meta( $post_id ) {
	if ( ! isset( $_POST['ccs_form_submission_followup_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ccs_form_submission_followup_nonce'] ) ), 'ccs_form_submission_followup' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$post = get_post( $post_id );
	if ( ! $post || $post->post_type !== 'form_submission' ) {
		return;
	}
	$statuses  = ccs_submission_followup_statuses();
	$assignees = ccs_submission_assignees();
	$status   = isset( $_POST['ccs_followup_status'] ) ? sanitize_text_field( $_POST['ccs_followup_status'] ) : '';
	$assigned = isset( $_POST['ccs_assigned_to'] ) ? sanitize_text_field( $_POST['ccs_assigned_to'] ) : '';
	$notes    = isset( $_POST['ccs_followup_notes'] ) ? sanitize_textarea_field( $_POST['ccs_followup_notes'] ) : '';
	if ( $status !== '' && array_key_exists( $status, $statuses ) ) {
		update_post_meta( $post_id, '_submission_followup_status', $status );
		if ( $status === 'cancelled' ) {
			update_post_meta( $post_id, '_submission_archived_date', current_time( 'mysql' ) );
		}
	}
	if ( $assigned !== '' && in_array( $assigned, $assignees, true ) ) {
		update_post_meta( $post_id, '_submission_assigned_to', $assigned );
	}
	update_post_meta( $post_id, '_submission_followup_notes', $notes );
}
add_action( 'save_post_form_submission', 'ccs_form_submission_save_meta' );
