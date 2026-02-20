<?php
/**
 * Condition CPT Meta Boxes
 */

// Add meta boxes
function ccs_condition_meta_boxes() {
    add_meta_box(
        'ccs_condition_details',
        'Condition Details',
        'ccs_condition_details_callback',
        'condition',
        'side',
        'high'
    );

    add_meta_box(
        'ccs_condition_sections',
        'Content Sections',
        'ccs_condition_sections_callback',
        'condition',
        'normal',
        'default'
    );

    add_meta_box(
        'ccs_condition_resources',
        'External Resources',
        'ccs_condition_resources_callback',
        'condition',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'ccs_condition_meta_boxes');

// Condition Details
function ccs_condition_details_callback($post) {
    wp_nonce_field('ccs_condition_details_nonce', 'ccs_condition_details_nonce');

    $category = get_post_meta($post->ID, '_ccs_condition_category', true);
    $schema_code = get_post_meta($post->ID, '_ccs_schema_code', true);
    $alt_names = get_post_meta($post->ID, '_ccs_alt_names', true);
    ?>

    <p>
        <label><strong>Condition Category:</strong></label><br>
        <select name="ccs_condition_category" style="width: 100%;">
            <option value="">-- Select --</option>
            <option value="Neurological" <?php selected($category, 'Neurological'); ?>>Neurological</option>
            <option value="Physical" <?php selected($category, 'Physical'); ?>>Physical</option>
            <option value="Learning Disability" <?php selected($category, 'Learning Disability'); ?>>Learning Disability</option>
            <option value="Mental Health" <?php selected($category, 'Mental Health'); ?>>Mental Health</option>
            <option value="Complex Care" <?php selected($category, 'Complex Care'); ?>>Complex Care</option>
        </select>
    </p>

    <p>
        <label><strong>Medical Code (ICD-10):</strong></label><br>
        <input type="text" name="ccs_schema_code" value="<?php echo esc_attr($schema_code); ?>" style="width: 100%;" placeholder="e.g., F03">
        <small>Optional - for schema markup</small>
    </p>

    <p>
        <label><strong>Alternate Names:</strong></label><br>
        <textarea name="ccs_alt_names" rows="3" style="width: 100%;" placeholder="e.g., Memory loss, cognitive decline"><?php echo esc_textarea($alt_names); ?></textarea>
        <small>Comma-separated</small>
    </p>

    <?php
}

// Condition Content Sections
function ccs_condition_sections_callback($post) {
    wp_nonce_field('ccs_condition_sections_nonce', 'ccs_condition_sections_nonce');

    $section_what_it_is = get_post_meta($post->ID, '_ccs_section_what_it_is', true);
    $section_progression = get_post_meta($post->ID, '_ccs_section_progression', true);
    $section_daily_life = get_post_meta($post->ID, '_ccs_section_daily_life', true);
    $section_how_care_helps = get_post_meta($post->ID, '_ccs_section_how_care_helps', true);
    $section_our_approach = get_post_meta($post->ID, '_ccs_section_our_approach', true);
    $section_training = get_post_meta($post->ID, '_ccs_section_training', true);
    ?>

    <div style="margin-bottom: 20px;">
        <h4>Section: What It Is</h4>
        <?php
        wp_editor($section_what_it_is, 'ccs_section_what_it_is', array(
            'textarea_name' => 'ccs_section_what_it_is',
            'textarea_rows' => 10,
            'media_buttons' => true,
            'teeny' => false,
            'tinymce' => true
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: How It Progresses / Stages</h4>
        <?php
        wp_editor($section_progression, 'ccs_section_progression', array(
            'textarea_name' => 'ccs_section_progression',
            'textarea_rows' => 10,
            'media_buttons' => true,
            'teeny' => false,
            'tinymce' => true
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: What Daily Life Looks Like</h4>
        <?php
        wp_editor($section_daily_life, 'ccs_section_daily_life', array(
            'textarea_name' => 'ccs_section_daily_life',
            'textarea_rows' => 10,
            'media_buttons' => true,
            'teeny' => false,
            'tinymce' => true
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: How Home Care Helps</h4>
        <?php
        wp_editor($section_how_care_helps, 'ccs_section_how_care_helps', array(
            'textarea_name' => 'ccs_section_how_care_helps',
            'textarea_rows' => 10,
            'media_buttons' => true,
            'teeny' => false,
            'tinymce' => true
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Our Approach</h4>
        <?php
        wp_editor($section_our_approach, 'ccs_section_our_approach', array(
            'textarea_name' => 'ccs_section_our_approach',
            'textarea_rows' => 10,
            'media_buttons' => true,
            'teeny' => false,
            'tinymce' => true
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Training Our Carers Receive</h4>
        <?php
        wp_editor($section_training, 'ccs_section_training', array(
            'textarea_name' => 'ccs_section_training',
            'textarea_rows' => 10,
            'media_buttons' => true,
            'teeny' => false,
            'tinymce' => true
        ));
        ?>
    </div>

    <?php
}

// External Resources
function ccs_condition_resources_callback($post) {
    wp_nonce_field('ccs_condition_resources_nonce', 'ccs_condition_resources_nonce');

    $resources = get_post_meta($post->ID, '_ccs_external_resources', true);
    if (!is_array($resources)) {
        $resources = array();
    }
    ?>

    <div id="ccs-resources-container">
        <?php
        if (!empty($resources)) {
            foreach ($resources as $index => $resource) {
                ?>
                <div class="ccs-resource-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd;">
                    <p>
                        <label><strong>Link Text:</strong></label><br>
                        <input type="text" name="ccs_resources[<?php echo (int) $index; ?>][text]" value="<?php echo esc_attr($resource['text']); ?>" style="width: 100%;" placeholder="e.g., NHS Dementia Guide">
                    </p>
                    <p>
                        <label><strong>URL:</strong></label><br>
                        <input type="url" name="ccs_resources[<?php echo (int) $index; ?>][url]" value="<?php echo esc_url($resource['url']); ?>" style="width: 100%;" placeholder="https://">
                    </p>
                    <p>
                        <label><strong>Organization:</strong></label><br>
                        <input type="text" name="ccs_resources[<?php echo (int) $index; ?>][org]" value="<?php echo esc_attr($resource['org']); ?>" style="width: 100%;" placeholder="e.g., NHS, Alzheimer's Society">
                    </p>
                    <button type="button" class="button ccs-remove-resource">Remove</button>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <button type="button" class="button" id="ccs-add-resource">+ Add External Resource</button>

    <script>
    jQuery(document).ready(function($) {
        var resourceIndex = <?php echo (int) count($resources); ?>;

        $('#ccs-add-resource').on('click', function() {
            var html = '<div class="ccs-resource-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd;">';
            html += '<p><label><strong>Link Text:</strong></label><br>';
            html += '<input type="text" name="ccs_resources[' + resourceIndex + '][text]" style="width: 100%;" placeholder="e.g., NHS Dementia Guide"></p>';
            html += '<p><label><strong>URL:</strong></label><br>';
            html += '<input type="url" name="ccs_resources[' + resourceIndex + '][url]" style="width: 100%;" placeholder="https://"></p>';
            html += '<p><label><strong>Organization:</strong></label><br>';
            html += '<input type="text" name="ccs_resources[' + resourceIndex + '][org]" style="width: 100%;" placeholder="e.g., NHS"></p>';
            html += '<button type="button" class="button ccs-remove-resource">Remove</button>';
            html += '</div>';

            $('#ccs-resources-container').append(html);
            resourceIndex++;
        });

        $(document).on('click', '.ccs-remove-resource', function() {
            $(this).closest('.ccs-resource-item').remove();
        });
    });
    </script>

    <?php
}

// Save Condition Meta
function ccs_save_condition_meta($post_id) {
    // Check nonces
    if (!isset($_POST['ccs_condition_details_nonce']) || !wp_verify_nonce($_POST['ccs_condition_details_nonce'], 'ccs_condition_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save details
    if (isset($_POST['ccs_condition_category'])) {
        update_post_meta($post_id, '_ccs_condition_category', sanitize_text_field($_POST['ccs_condition_category']));
    }
    if (isset($_POST['ccs_schema_code'])) {
        update_post_meta($post_id, '_ccs_schema_code', sanitize_text_field($_POST['ccs_schema_code']));
    }
    if (isset($_POST['ccs_alt_names'])) {
        update_post_meta($post_id, '_ccs_alt_names', sanitize_textarea_field($_POST['ccs_alt_names']));
    }

    // Save sections
    if (isset($_POST['ccs_condition_sections_nonce']) && wp_verify_nonce($_POST['ccs_condition_sections_nonce'], 'ccs_condition_sections_nonce')) {
        if (isset($_POST['ccs_section_what_it_is'])) {
            update_post_meta($post_id, '_ccs_section_what_it_is', wp_kses_post($_POST['ccs_section_what_it_is']));
        }
        if (isset($_POST['ccs_section_progression'])) {
            update_post_meta($post_id, '_ccs_section_progression', wp_kses_post($_POST['ccs_section_progression']));
        }
        if (isset($_POST['ccs_section_daily_life'])) {
            update_post_meta($post_id, '_ccs_section_daily_life', wp_kses_post($_POST['ccs_section_daily_life']));
        }
        if (isset($_POST['ccs_section_how_care_helps'])) {
            update_post_meta($post_id, '_ccs_section_how_care_helps', wp_kses_post($_POST['ccs_section_how_care_helps']));
        }
        if (isset($_POST['ccs_section_our_approach'])) {
            update_post_meta($post_id, '_ccs_section_our_approach', wp_kses_post($_POST['ccs_section_our_approach']));
        }
        if (isset($_POST['ccs_section_training'])) {
            update_post_meta($post_id, '_ccs_section_training', wp_kses_post($_POST['ccs_section_training']));
        }
    }

    // Save resources
    if (isset($_POST['ccs_condition_resources_nonce']) && wp_verify_nonce($_POST['ccs_condition_resources_nonce'], 'ccs_condition_resources_nonce')) {
        $resources = array();
        if (isset($_POST['ccs_resources']) && is_array($_POST['ccs_resources'])) {
            foreach ($_POST['ccs_resources'] as $resource) {
                if (!empty($resource['text']) && !empty($resource['url'])) {
                    $resources[] = array(
                        'text' => sanitize_text_field($resource['text']),
                        'url' => esc_url_raw($resource['url']),
                        'org' => isset($resource['org']) ? sanitize_text_field($resource['org']) : ''
                    );
                }
            }
        }
        update_post_meta($post_id, '_ccs_external_resources', $resources);
    }
}
add_action('save_post_condition', 'ccs_save_condition_meta');
