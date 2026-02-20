<?php
/**
 * Team CPT Meta Boxes
 */

function ccs_team_meta_boxes() {
    add_meta_box(
        'ccs_team_details',
        'Team Member Details',
        'ccs_team_details_callback',
        'team',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ccs_team_meta_boxes');

function ccs_team_details_callback($post) {
    wp_nonce_field('ccs_team_details_nonce', 'ccs_team_details_nonce');

    $first_name = get_post_meta($post->ID, '_ccs_first_name', true);
    $role = get_post_meta($post->ID, '_ccs_role', true);
    $tenure_years = get_post_meta($post->ID, '_ccs_tenure_years', true);
    $qualifications = get_post_meta($post->ID, '_ccs_qualifications', true);
    $specialisms = get_post_meta($post->ID, '_ccs_specialisms', true);
    if (!is_array($specialisms)) {
        $specialisms = array();
    }
    ?>

    <p>
        <label><strong>First Name:</strong></label><br>
        <input type="text" name="ccs_first_name" value="<?php echo esc_attr($first_name); ?>" style="width: 100%;" placeholder="e.g., Sarah">
    </p>

    <p>
        <label><strong>Role:</strong></label><br>
        <select name="ccs_role" style="width: 100%;">
            <option value="">-- Select --</option>
            <option value="Carer" <?php selected($role, 'Carer'); ?>>Carer</option>
            <option value="Senior Carer" <?php selected($role, 'Senior Carer'); ?>>Senior Carer</option>
            <option value="Care Coordinator" <?php selected($role, 'Care Coordinator'); ?>>Care Coordinator</option>
            <option value="Manager" <?php selected($role, 'Manager'); ?>>Manager</option>
            <option value="Registered Manager" <?php selected($role, 'Registered Manager'); ?>>Registered Manager</option>
            <option value="Leadership" <?php selected($role, 'Leadership'); ?>>Leadership</option>
        </select>
    </p>

    <p>
        <label><strong>Tenure (years with CCS):</strong></label><br>
        <input type="number" name="ccs_tenure_years" value="<?php echo esc_attr($tenure_years); ?>" style="width: 100%;" step="0.5" placeholder="e.g., 3.5">
    </p>

    <p>
        <label><strong>Qualifications:</strong></label><br>
        <textarea name="ccs_qualifications" rows="3" style="width: 100%;" placeholder="e.g., NVQ Level 3 in Health & Social Care, First Aid Certified"><?php echo esc_textarea($qualifications); ?></textarea>
    </p>

    <p>
        <label><strong>Specialisms:</strong></label><br>
        <label><input type="checkbox" name="ccs_specialisms[]" value="Dementia" <?php checked(in_array('Dementia', $specialisms)); ?>> Dementia</label><br>
        <label><input type="checkbox" name="ccs_specialisms[]" value="Epilepsy" <?php checked(in_array('Epilepsy', $specialisms)); ?>> Epilepsy</label><br>
        <label><input type="checkbox" name="ccs_specialisms[]" value="Autism" <?php checked(in_array('Autism', $specialisms)); ?>> Autism</label><br>
        <label><input type="checkbox" name="ccs_specialisms[]" value="Learning Disabilities" <?php checked(in_array('Learning Disabilities', $specialisms)); ?>> Learning Disabilities</label><br>
        <label><input type="checkbox" name="ccs_specialisms[]" value="Parkinson's" <?php checked(in_array("Parkinson's", $specialisms)); ?>> Parkinson's</label><br>
        <label><input type="checkbox" name="ccs_specialisms[]" value="Physical Disabilities" <?php checked(in_array('Physical Disabilities', $specialisms)); ?>> Physical Disabilities</label><br>
        <label><input type="checkbox" name="ccs_specialisms[]" value="Complex Care" <?php checked(in_array('Complex Care', $specialisms)); ?>> Complex Care</label><br>
        <label><input type="checkbox" name="ccs_specialisms[]" value="Palliative Care" <?php checked(in_array('Palliative Care', $specialisms)); ?>> Palliative Care</label>
    </p>

    <p>
        <label><strong>Bio:</strong></label><br>
        <small>Use the main editor below for the full bio</small>
    </p>

    <?php
}

function ccs_save_team_meta($post_id) {
    if (!isset($_POST['ccs_team_details_nonce']) || !wp_verify_nonce($_POST['ccs_team_details_nonce'], 'ccs_team_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['ccs_first_name'])) {
        update_post_meta($post_id, '_ccs_first_name', sanitize_text_field($_POST['ccs_first_name']));
    }
    if (isset($_POST['ccs_role'])) {
        update_post_meta($post_id, '_ccs_role', sanitize_text_field($_POST['ccs_role']));
    }
    if (isset($_POST['ccs_tenure_years'])) {
        update_post_meta($post_id, '_ccs_tenure_years', floatval($_POST['ccs_tenure_years']));
    }
    if (isset($_POST['ccs_qualifications'])) {
        update_post_meta($post_id, '_ccs_qualifications', sanitize_textarea_field($_POST['ccs_qualifications']));
    }

    $specialisms = isset($_POST['ccs_specialisms']) && is_array($_POST['ccs_specialisms'])
        ? array_map('sanitize_text_field', $_POST['ccs_specialisms'])
        : array();
    update_post_meta($post_id, '_ccs_specialisms', $specialisms);
}
add_action('save_post_team', 'ccs_save_team_meta');
