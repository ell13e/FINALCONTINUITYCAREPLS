<?php
/**
 * Location CPT Meta Boxes
 */

function ccs_location_meta_boxes() {
    add_meta_box(
        'ccs_location_details',
        'Location Details',
        'ccs_location_details_callback',
        'location',
        'side',
        'high'
    );

    add_meta_box(
        'ccs_location_sections',
        'Content Sections',
        'ccs_location_sections_callback',
        'location',
        'normal',
        'default'
    );

    add_meta_box(
        'ccs_location_local',
        'Local Information',
        'ccs_location_local_callback',
        'location',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'ccs_location_meta_boxes');

function ccs_location_details_callback($post) {
    wp_nonce_field('ccs_location_details_nonce', 'ccs_location_details_nonce');

    $location_type = get_post_meta($post->ID, '_ccs_location_type', true);
    $coordinates = get_post_meta($post->ID, '_ccs_coordinates', true);
    $postal_codes = get_post_meta($post->ID, '_ccs_postal_codes', true);
    ?>

    <p>
        <label><strong>Location Type:</strong></label><br>
        <select name="ccs_location_type" style="width: 100%;">
            <option value="County" <?php selected($location_type, 'County'); ?>>County</option>
            <option value="Town" <?php selected($location_type, 'Town'); ?>>Town</option>
            <option value="Neighborhood" <?php selected($location_type, 'Neighborhood'); ?>>Neighborhood</option>
        </select>
    </p>

    <p>
        <label><strong>Coordinates (Lat, Long):</strong></label><br>
        <input type="text" name="ccs_coordinates" value="<?php echo esc_attr($coordinates); ?>" style="width: 100%;" placeholder="51.2787, 0.5217">
        <small>For map embedding</small>
    </p>

    <p>
        <label><strong>Postal Codes Covered:</strong></label><br>
        <textarea name="ccs_postal_codes" rows="3" style="width: 100%;" placeholder="ME14, ME15, ME16"><?php echo esc_textarea($postal_codes); ?></textarea>
        <small>Comma-separated</small>
    </p>

    <?php
}

function ccs_location_sections_callback($post) {
    wp_nonce_field('ccs_location_sections_nonce', 'ccs_location_sections_nonce');

    $section_intro = get_post_meta($post->ID, '_ccs_section_intro', true);
    $section_areas_covered = get_post_meta($post->ID, '_ccs_section_areas_covered', true);
    $section_services = get_post_meta($post->ID, '_ccs_section_services', true);
    $section_local_context = get_post_meta($post->ID, '_ccs_section_local_context', true);
    $section_why_local = get_post_meta($post->ID, '_ccs_section_why_local', true);
    ?>

    <div style="margin-bottom: 20px;">
        <h4>Section: Introduction</h4>
        <?php
        wp_editor($section_intro, 'ccs_section_intro', array(
            'textarea_name' => 'ccs_section_intro',
            'textarea_rows' => 8,
            'media_buttons' => true
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Areas Covered</h4>
        <small>List specific neighborhoods, villages, postcodes</small>
        <?php
        wp_editor($section_areas_covered, 'ccs_section_areas_covered', array(
            'textarea_name' => 'ccs_section_areas_covered',
            'textarea_rows' => 8,
            'media_buttons' => false
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Services Available Here</h4>
        <?php
        wp_editor($section_services, 'ccs_section_services', array(
            'textarea_name' => 'ccs_section_services',
            'textarea_rows' => 8,
            'media_buttons' => false
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Local Context</h4>
        <small>KCC funding info, local partnerships, demographics</small>
        <?php
        wp_editor($section_local_context, 'ccs_section_local_context', array(
            'textarea_name' => 'ccs_section_local_context',
            'textarea_rows' => 8,
            'media_buttons' => false
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Why Choose Local Care</h4>
        <?php
        wp_editor($section_why_local, 'ccs_section_why_local', array(
            'textarea_name' => 'ccs_section_why_local',
            'textarea_rows' => 8,
            'media_buttons' => false
        ));
        ?>
    </div>

    <?php
}

function ccs_location_local_callback($post) {
    wp_nonce_field('ccs_location_local_nonce', 'ccs_location_local_nonce');

    $map_embed = get_post_meta($post->ID, '_ccs_map_embed', true);
    $show_map = get_post_meta($post->ID, '_ccs_show_map', true);
    ?>

    <p>
        <label>
            <input type="checkbox" name="ccs_show_map" value="1" <?php checked($show_map, '1'); ?>>
            Show coverage map on this page
        </label>
    </p>

    <p>
        <label><strong>Map Embed Code:</strong></label><br>
        <textarea name="ccs_map_embed" rows="5" style="width: 100%; font-family: monospace;" placeholder="<iframe src=...></iframe>"><?php echo esc_textarea($map_embed); ?></textarea>
        <small>Google Maps iframe embed code</small>
    </p>

    <?php
}

function ccs_save_location_meta($post_id) {
    if (!isset($_POST['ccs_location_details_nonce']) || !wp_verify_nonce($_POST['ccs_location_details_nonce'], 'ccs_location_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['ccs_location_type'])) {
        update_post_meta($post_id, '_ccs_location_type', sanitize_text_field($_POST['ccs_location_type']));
    }
    if (isset($_POST['ccs_coordinates'])) {
        update_post_meta($post_id, '_ccs_coordinates', sanitize_text_field($_POST['ccs_coordinates']));
    }
    if (isset($_POST['ccs_postal_codes'])) {
        update_post_meta($post_id, '_ccs_postal_codes', sanitize_textarea_field($_POST['ccs_postal_codes']));
    }

    if (isset($_POST['ccs_location_sections_nonce']) && wp_verify_nonce($_POST['ccs_location_sections_nonce'], 'ccs_location_sections_nonce')) {
        if (isset($_POST['ccs_section_intro'])) {
            update_post_meta($post_id, '_ccs_section_intro', wp_kses_post($_POST['ccs_section_intro']));
        }
        if (isset($_POST['ccs_section_areas_covered'])) {
            update_post_meta($post_id, '_ccs_section_areas_covered', wp_kses_post($_POST['ccs_section_areas_covered']));
        }
        if (isset($_POST['ccs_section_services'])) {
            update_post_meta($post_id, '_ccs_section_services', wp_kses_post($_POST['ccs_section_services']));
        }
        if (isset($_POST['ccs_section_local_context'])) {
            update_post_meta($post_id, '_ccs_section_local_context', wp_kses_post($_POST['ccs_section_local_context']));
        }
        if (isset($_POST['ccs_section_why_local'])) {
            update_post_meta($post_id, '_ccs_section_why_local', wp_kses_post($_POST['ccs_section_why_local']));
        }
    }

    if (isset($_POST['ccs_location_local_nonce']) && wp_verify_nonce($_POST['ccs_location_local_nonce'], 'ccs_location_local_nonce')) {
        update_post_meta($post_id, '_ccs_show_map', isset($_POST['ccs_show_map']) ? '1' : '0');
        if (isset($_POST['ccs_map_embed'])) {
            update_post_meta($post_id, '_ccs_map_embed', wp_kses_post($_POST['ccs_map_embed']));
        }
    }
}
add_action('save_post_location', 'ccs_save_location_meta');
