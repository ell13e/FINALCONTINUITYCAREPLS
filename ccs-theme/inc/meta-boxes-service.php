<?php
/**
 * Service CPT Meta Boxes (minimal stub: details + sections used by single templates).
 */

function ccs_service_meta_boxes() {
    add_meta_box(
        'ccs_service_details',
        'Service Details',
        'ccs_service_details_callback',
        'service',
        'side',
        'high'
    );
    add_meta_box(
        'ccs_service_sections',
        'Content Sections',
        'ccs_service_sections_callback',
        'service',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'ccs_service_meta_boxes');

function ccs_service_details_callback($post) {
    wp_nonce_field('ccs_service_details_nonce', 'ccs_service_details_nonce');
    $is_pillar   = get_post_meta($post->ID, '_ccs_is_pillar', true);
    $pricing     = get_post_meta($post->ID, '_ccs_pricing_range', true);
    ?>
    <p>
        <label><input type="checkbox" name="ccs_is_pillar" value="1" <?php checked($is_pillar, '1'); ?> /> This is a pillar service page</label>
    </p>
    <p>
        <label><strong>Pricing range (e.g. £28–32/hr):</strong></label><br>
        <input type="text" name="ccs_pricing_range" value="<?php echo esc_attr($pricing); ?>" style="width:100%;" />
    </p>
    <?php
}

function ccs_service_sections_callback($post) {
    wp_nonce_field('ccs_service_sections_nonce', 'ccs_service_sections_nonce');
    $what_it_is   = get_post_meta($post->ID, '_ccs_section_what_it_is', true);
    $who_its_for  = get_post_meta($post->ID, '_ccs_section_who_its_for', true);
    $typical      = get_post_meta($post->ID, '_ccs_section_typical_visit', true);
    ?>
    <p><label><strong>Section: What it is</strong></label></p>
    <?php wp_editor($what_it_is, 'ccs_section_what_it_is', array('textarea_name' => 'ccs_section_what_it_is', 'textarea_rows' => 8)); ?>
    <p><label><strong>Section: Who it's for</strong></label></p>
    <?php wp_editor($who_its_for, 'ccs_section_who_its_for', array('textarea_name' => 'ccs_section_who_its_for', 'textarea_rows' => 8)); ?>
    <p><label><strong>Section: Typical visit</strong></label></p>
    <?php wp_editor($typical, 'ccs_section_typical_visit', array('textarea_name' => 'ccs_section_typical_visit', 'textarea_rows' => 8)); ?>
    <?php
}

function ccs_save_service_meta($post_id) {
    if (!isset($_POST['ccs_service_details_nonce']) || !wp_verify_nonce($_POST['ccs_service_details_nonce'], 'ccs_service_details_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    update_post_meta($post_id, '_ccs_is_pillar', isset($_POST['ccs_is_pillar']) ? '1' : '0');
    update_post_meta($post_id, '_ccs_pricing_range', isset($_POST['ccs_pricing_range']) ? sanitize_text_field($_POST['ccs_pricing_range']) : '');

    if (isset($_POST['ccs_service_sections_nonce']) && wp_verify_nonce($_POST['ccs_service_sections_nonce'], 'ccs_service_sections_nonce')) {
        update_post_meta($post_id, '_ccs_section_what_it_is', isset($_POST['ccs_section_what_it_is']) ? wp_kses_post($_POST['ccs_section_what_it_is']) : '');
        update_post_meta($post_id, '_ccs_section_who_its_for', isset($_POST['ccs_section_who_its_for']) ? wp_kses_post($_POST['ccs_section_who_its_for']) : '');
        update_post_meta($post_id, '_ccs_section_typical_visit', isset($_POST['ccs_section_typical_visit']) ? wp_kses_post($_POST['ccs_section_typical_visit']) : '');
    }
}
add_action('save_post_service', 'ccs_save_service_meta');
