<?php
/**
 * Process CPT Meta Boxes
 */

function ccs_process_meta_boxes() {
    add_meta_box(
        'ccs_process_details',
        'Process Details',
        'ccs_process_details_callback',
        'process',
        'side',
        'high'
    );

    add_meta_box(
        'ccs_process_sections',
        'Content Sections',
        'ccs_process_sections_callback',
        'process',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'ccs_process_meta_boxes');

function ccs_process_details_callback($post) {
    wp_nonce_field('ccs_process_details_nonce', 'ccs_process_details_nonce');

    $step_number = get_post_meta($post->ID, '_ccs_step_number', true);
    $is_hub = get_post_meta($post->ID, '_ccs_is_hub', true);
    $duration = get_post_meta($post->ID, '_ccs_duration', true);
    ?>

    <p>
        <label>
            <input type="checkbox" name="ccs_is_hub" value="1" <?php checked($is_hub, '1'); ?>>
            This is the hub page
        </label>
    </p>

    <p>
        <label><strong>Step Number:</strong></label><br>
        <input type="number" name="ccs_step_number" value="<?php echo esc_attr($step_number); ?>" style="width: 100%;" placeholder="1">
        <small>For ordering and schema</small>
    </p>

    <p>
        <label><strong>Estimated Duration:</strong></label><br>
        <input type="text" name="ccs_duration" value="<?php echo esc_attr($duration); ?>" style="width: 100%;" placeholder="e.g., Usually takes 1-2 days">
    </p>

    <?php
}

function ccs_process_sections_callback($post) {
    wp_nonce_field('ccs_process_sections_nonce', 'ccs_process_sections_nonce');

    $section_overview = get_post_meta($post->ID, '_ccs_section_overview', true);
    $section_what_happens = get_post_meta($post->ID, '_ccs_section_what_happens', true);
    $section_what_you_need = get_post_meta($post->ID, '_ccs_section_what_you_need', true);
    $section_how_long = get_post_meta($post->ID, '_ccs_section_how_long', true);
    $section_what_next = get_post_meta($post->ID, '_ccs_section_what_next', true);
    ?>

    <div style="margin-bottom: 20px;">
        <h4>Section: Overview</h4>
        <?php
        wp_editor($section_overview, 'ccs_section_overview', array(
            'textarea_name' => 'ccs_section_overview',
            'textarea_rows' => 6,
            'media_buttons' => false
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: What Happens</h4>
        <?php
        wp_editor($section_what_happens, 'ccs_section_what_happens', array(
            'textarea_name' => 'ccs_section_what_happens',
            'textarea_rows' => 10,
            'media_buttons' => true
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: What You Need to Prepare</h4>
        <?php
        wp_editor($section_what_you_need, 'ccs_section_what_you_need', array(
            'textarea_name' => 'ccs_section_what_you_need',
            'textarea_rows' => 8,
            'media_buttons' => false
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: How Long It Takes</h4>
        <?php
        wp_editor($section_how_long, 'ccs_section_how_long', array(
            'textarea_name' => 'ccs_section_how_long',
            'textarea_rows' => 6,
            'media_buttons' => false
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: What Happens Next</h4>
        <?php
        wp_editor($section_what_next, 'ccs_section_what_next', array(
            'textarea_name' => 'ccs_section_what_next',
            'textarea_rows' => 6,
            'media_buttons' => false
        ));
        ?>
    </div>

    <?php
}

function ccs_save_process_meta($post_id) {
    if (!isset($_POST['ccs_process_details_nonce']) || !wp_verify_nonce($_POST['ccs_process_details_nonce'], 'ccs_process_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['ccs_step_number'])) {
        update_post_meta($post_id, '_ccs_step_number', absint($_POST['ccs_step_number']));
    }
    update_post_meta($post_id, '_ccs_is_hub', isset($_POST['ccs_is_hub']) ? '1' : '0');
    if (isset($_POST['ccs_duration'])) {
        update_post_meta($post_id, '_ccs_duration', sanitize_text_field($_POST['ccs_duration']));
    }

    if (isset($_POST['ccs_process_sections_nonce']) && wp_verify_nonce($_POST['ccs_process_sections_nonce'], 'ccs_process_sections_nonce')) {
        if (isset($_POST['ccs_section_overview'])) {
            update_post_meta($post_id, '_ccs_section_overview', wp_kses_post($_POST['ccs_section_overview']));
        }
        if (isset($_POST['ccs_section_what_happens'])) {
            update_post_meta($post_id, '_ccs_section_what_happens', wp_kses_post($_POST['ccs_section_what_happens']));
        }
        if (isset($_POST['ccs_section_what_you_need'])) {
            update_post_meta($post_id, '_ccs_section_what_you_need', wp_kses_post($_POST['ccs_section_what_you_need']));
        }
        if (isset($_POST['ccs_section_how_long'])) {
            update_post_meta($post_id, '_ccs_section_how_long', wp_kses_post($_POST['ccs_section_how_long']));
        }
        if (isset($_POST['ccs_section_what_next'])) {
            update_post_meta($post_id, '_ccs_section_what_next', wp_kses_post($_POST['ccs_section_what_next']));
        }
    }
}
add_action('save_post_process', 'ccs_save_process_meta');
