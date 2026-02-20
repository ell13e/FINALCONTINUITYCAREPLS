<?php
/**
 * AJAX form handlers — contact form and submission persistence.
 *
 * Security: nonce verification, sanitization, validation.
 * Enquiries email from theme options (ccs_enquiries_email).
 *
 * @package CCS_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// -----------------------------------------------------------------------------
// Helpers
// -----------------------------------------------------------------------------

/**
 * Get client IP (for submission meta).
 *
 * @return string
 */
function ccs_get_client_ip() {
	$ip = '';
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ips = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
		$ip  = trim( $ips[0] );
	} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return sanitize_text_field( $ip );
}

/**
 * Save form submission to database.
 *
 * @param array  $data        Submission data (name, email, phone, message, consent, marketing_consent, ip, page_url, etc.).
 * @param string $form_type   Taxonomy slug (e.g. care-enquiry, general, request-callback, other).
 * @param bool   $email_sent  Whether notification email was sent.
 * @param string $email_error Error message if email failed.
 * @return int|WP_Error Post ID on success, WP_Error on failure.
 */
function ccs_save_form_submission( $data, $form_type, $email_sent = false, $email_error = '' ) {
	$name    = isset( $data['name'] ) ? sanitize_text_field( $data['name'] ) : '';
	$email   = isset( $data['email'] ) ? sanitize_email( $data['email'] ) : '';
	$phone   = isset( $data['phone'] ) ? sanitize_text_field( $data['phone'] ) : '';
	$message = isset( $data['message'] ) ? sanitize_textarea_field( $data['message'] ) : '';
	$consent = ! empty( $data['consent'] ) && in_array( $data['consent'], array( 'yes', 'on', '1' ), true );
	$marketing_consent = ! empty( $data['marketing_consent'] ) && in_array( $data['marketing_consent'], array( 'yes', 'on', '1' ), true );

	$title = $name ? $name : __( 'Anonymous submission', 'ccs-wp-theme' );
	if ( $form_type ) {
		$title .= ' - ' . ucfirst( str_replace( array( '-', '_' ), ' ', $form_type ) );
	}

	$post_id = wp_insert_post( array(
		'post_title'   => $title,
		'post_content' => '',
		'post_status'  => 'publish',
		'post_type'    => 'form_submission',
	) );

	if ( is_wp_error( $post_id ) ) {
		return $post_id;
	}

	// Form type taxonomy
	if ( $form_type ) {
		$term = get_term_by( 'slug', $form_type, 'form_type' );
		if ( ! $term ) {
			$term_result = wp_insert_term( ucfirst( str_replace( array( '-', '_' ), ' ', $form_type ) ), 'form_type', array( 'slug' => $form_type ) );
			if ( ! is_wp_error( $term_result ) ) {
				wp_set_object_terms( $post_id, array( (int) $term_result['term_id'] ), 'form_type' );
			}
		} else {
			wp_set_object_terms( $post_id, array( (int) $term->term_id ), 'form_type' );
		}
	}

	update_post_meta( $post_id, '_submission_name', $name );
	update_post_meta( $post_id, '_submission_email', $email );
	update_post_meta( $post_id, '_submission_phone', $phone );
	update_post_meta( $post_id, '_submission_message', $message );
	update_post_meta( $post_id, '_submission_consent', $consent ? 'yes' : 'no' );
	update_post_meta( $post_id, '_submission_marketing_consent', $marketing_consent ? 'yes' : 'no' );
	update_post_meta( $post_id, '_submission_email_sent', $email_sent ? 'yes' : 'no' );
	if ( $email_error ) {
		update_post_meta( $post_id, '_submission_email_error', $email_error );
	}
	update_post_meta( $post_id, '_submission_followup_status', 'new' );

	if ( isset( $data['ip'] ) ) {
		update_post_meta( $post_id, '_submission_ip', sanitize_text_field( $data['ip'] ) );
	} else {
		update_post_meta( $post_id, '_submission_ip', ccs_get_client_ip() );
	}
	if ( isset( $data['page_url'] ) ) {
		update_post_meta( $post_id, '_submission_page_url', esc_url_raw( $data['page_url'] ) );
	}
	if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
		update_post_meta( $post_id, '_submission_user_agent', sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) );
	}

	// Consent timestamps.
	update_post_meta( $post_id, '_submission_consent_at', current_time( 'c' ) );
	if ( $marketing_consent ) {
		update_post_meta( $post_id, '_submission_marketing_consent_at', current_time( 'c' ) );
	}

	// UTM and referrer (max 191 chars for meta).
	$utm_keys = array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term' );
	foreach ( $utm_keys as $key ) {
		if ( isset( $data[ $key ] ) && is_string( $data[ $key ] ) ) {
			$val = sanitize_text_field( $data[ $key ] );
			if ( $val !== '' ) {
				update_post_meta( $post_id, '_submission_' . $key, substr( $val, 0, 191 ) );
			}
		}
	}
	if ( isset( $data['referrer'] ) && is_string( $data['referrer'] ) ) {
		$ref = esc_url_raw( $data['referrer'] );
		if ( $ref !== '' ) {
			update_post_meta( $post_id, '_submission_referrer', substr( $ref, 0, 191 ) );
		}
	}
	if ( isset( $data['lead_source'] ) && is_string( $data['lead_source'] ) ) {
		$lead = sanitize_text_field( $data['lead_source'] );
		if ( $lead !== '' ) {
			update_post_meta( $post_id, '_submission_lead_source', substr( $lead, 0, 191 ) );
		}
	}

	return $post_id;
}

// -----------------------------------------------------------------------------
// Contact form handler
// -----------------------------------------------------------------------------

/**
 * Handle contact form AJAX submission.
 */
function ccs_handle_contact_form() {
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'ccs_contact_form' ) ) {
		wp_send_json_error( array(
			'message' => __( 'Security check failed. Please refresh and try again.', 'ccs-wp-theme' ),
			'code'    => 'nonce_failed',
		), 403 );
	}

	// Form uses name="contact-name", etc. (dashes).
	$name    = isset( $_POST['contact-name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact-name'] ) ) : '';
	$email   = isset( $_POST['contact-email'] ) ? sanitize_email( wp_unslash( $_POST['contact-email'] ) ) : '';
	$phone   = isset( $_POST['contact-phone'] ) ? sanitize_text_field( wp_unslash( $_POST['contact-phone'] ) ) : '';
	$subject = isset( $_POST['contact-subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact-subject'] ) ) : 'general';
	$message = isset( $_POST['contact-message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact-message'] ) ) : '';
	$page_url = isset( $_POST['page_url'] ) ? esc_url_raw( wp_unslash( $_POST['page_url'] ) ) : '';

	// UTM and referrer (front-end may send these from URL or JS).
	$utm_source   = isset( $_POST['utm_source'] ) ? sanitize_text_field( wp_unslash( $_POST['utm_source'] ) ) : '';
	$utm_medium   = isset( $_POST['utm_medium'] ) ? sanitize_text_field( wp_unslash( $_POST['utm_medium'] ) ) : '';
	$utm_campaign = isset( $_POST['utm_campaign'] ) ? sanitize_text_field( wp_unslash( $_POST['utm_campaign'] ) ) : '';
	$utm_content  = isset( $_POST['utm_content'] ) ? sanitize_text_field( wp_unslash( $_POST['utm_content'] ) ) : '';
	$utm_term     = isset( $_POST['utm_term'] ) ? sanitize_text_field( wp_unslash( $_POST['utm_term'] ) ) : '';
	$referrer     = '';
	if ( ! empty( $_SERVER['HTTP_REFERER'] ) ) {
		$referrer = esc_url_raw( wp_unslash( $_SERVER['HTTP_REFERER'] ) );
	}
	$lead_source_raw = isset( $_POST['lead_source'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_source'] ) ) : '';
	if ( $lead_source_raw === '' && isset( $_POST['contact-source'] ) ) {
		$lead_source_raw = sanitize_text_field( wp_unslash( $_POST['contact-source'] ) );
	}
	$lead_source = '';
	if ( function_exists( 'ccs_lead_source_options' ) ) {
		$allowed = array_keys( ccs_lead_source_options() );
		if ( in_array( $lead_source_raw, $allowed, true ) ) {
			$lead_source = $lead_source_raw;
		}
	}

	$errors = array();

	if ( strlen( trim( $name ) ) < 2 ) {
		$errors['contact-name'] = __( 'Please enter your name.', 'ccs-wp-theme' );
	}
	if ( ! is_email( $email ) ) {
		$errors['contact-email'] = __( 'Please enter a valid email address.', 'ccs-wp-theme' );
	}
	if ( strlen( trim( $phone ) ) < 5 ) {
		$errors['contact-phone'] = __( 'Please enter a valid phone number.', 'ccs-wp-theme' );
	}
	$allowed_types = array( 'care-enquiry', 'general', 'request-callback', 'other' );
	if ( $subject && ! in_array( $subject, $allowed_types, true ) ) {
		$subject = 'general';
	}
	if ( strlen( trim( $message ) ) < 10 ) {
		$errors['contact-message'] = __( 'Please enter your message (at least 10 characters).', 'ccs-wp-theme' );
	}

	if ( ! empty( $errors ) ) {
		wp_send_json_error( array(
			'message' => __( 'Please correct the errors below.', 'ccs-wp-theme' ),
			'errors'  => $errors,
			'code'    => 'validation_failed',
		), 400 );
	}

	$to = function_exists( 'ccs_get_enquiries_email' ) ? ccs_get_enquiries_email() : get_option( 'ccs_enquiries_email', 'office@continuitycareservices.co.uk' );
	if ( ! $to || ! is_email( $to ) ) {
		wp_send_json_error( array(
			'message' => __( 'Contact form is not configured. Please try again later or call us.', 'ccs-wp-theme' ),
			'code'    => 'email_config',
		), 500 );
	}

	$marketing_consent_post = isset( $_POST['marketing_consent'] ) ? wp_unslash( $_POST['marketing_consent'] ) : ( isset( $_POST['contact-marketing-consent'] ) ? wp_unslash( $_POST['contact-marketing-consent'] ) : '' );
	$marketing_consent_val  = ! empty( $marketing_consent_post ) && in_array( $marketing_consent_post, array( 'yes', 'on', '1' ), true );

	$submission_data = array(
		'name'              => $name,
		'email'             => $email,
		'phone'             => $phone,
		'message'           => $message,
		'consent'           => 'yes',
		'marketing_consent' => $marketing_consent_val ? 'yes' : 'no',
		'ip'                => ccs_get_client_ip(),
		'page_url'         => $page_url ? $page_url : ( is_singular() ? get_permalink() : home_url( '/' ) ),
		'utm_source'       => $utm_source,
		'utm_medium'       => $utm_medium,
		'utm_campaign'     => $utm_campaign,
		'utm_content'      => $utm_content,
		'utm_term'         => $utm_term,
		'referrer'         => $referrer,
		'lead_source'      => $lead_source,
	);

	$saved = ccs_save_form_submission( $submission_data, $subject ? $subject : 'general', false, '' );

	$subject_labels = array(
		'care-enquiry'     => __( 'Care enquiry', 'ccs-wp-theme' ),
		'general'          => __( 'General', 'ccs-wp-theme' ),
		'request-callback' => __( 'Request callback', 'ccs-wp-theme' ),
		'other'            => __( 'Other', 'ccs-wp-theme' ),
	);
	$subject_label = isset( $subject_labels[ $subject ] ) ? $subject_labels[ $subject ] : $subject;

	$email_subject = sprintf( '[%s] %s — %s', get_bloginfo( 'name' ), $subject_label, $name );
	$body  = "New contact form submission\n\n";
	$body .= "Name: {$name}\n";
	$body .= "Email: {$email}\n";
	$body .= "Phone: {$phone}\n";
	$body .= "Subject: {$subject_label}\n\n";
	$body .= "Message:\n{$message}\n\n";
	$body .= "---\n";
	$body .= "Submitted: " . current_time( 'mysql' ) . "\n";
	$body .= "IP: " . ccs_get_client_ip() . "\n";
	if ( $submission_data['page_url'] ) {
		$body .= "Page: " . $submission_data['page_url'] . "\n";
	}
	if ( ! is_wp_error( $saved ) && $saved ) {
		$body .= "\nView in admin: " . admin_url( 'post.php?post=' . $saved . '&action=edit' ) . "\n";
	}

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $name . ' <' . $email . '>',
	);

	$sent = wp_mail( $to, $email_subject, $body, $headers );
	$email_error = '';
	if ( ! $sent ) {
		$email_error = __( 'Email sending failed', 'ccs-wp-theme' );
	}

	if ( ! is_wp_error( $saved ) && $saved ) {
		update_post_meta( $saved, '_submission_email_sent', $sent ? 'yes' : 'no' );
		if ( $email_error ) {
			update_post_meta( $saved, '_submission_email_error', $email_error );
		}
	}

	wp_send_json_success( array(
		'message' => __( 'Thank you for your message. We will be in touch soon.', 'ccs-wp-theme' ),
	) );
}
add_action( 'wp_ajax_ccs_contact_form', 'ccs_handle_contact_form' );
add_action( 'wp_ajax_nopriv_ccs_contact_form', 'ccs_handle_contact_form' );
