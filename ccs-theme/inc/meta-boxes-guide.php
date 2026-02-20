<?php
/**
 * Guide CPT Meta Boxes
 */

function ccs_guide_meta_boxes() {
    add_meta_box(
        'ccs_guide_details',
        'Guide Details',
        'ccs_guide_details_callback',
        'guide',
        'side',
        'high'
    );

    add_meta_box(
        'ccs_guide_sections',
        'Content Sections',
        'ccs_guide_sections_callback',
        'guide',
        'normal',
        'default'
    );

    add_meta_box(
        'ccs_guide_faqs',
        'FAQ Schema (Optional)',
        'ccs_guide_faqs_callback',
        'guide',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'ccs_guide_meta_boxes');

function ccs_guide_details_callback($post) {
    wp_nonce_field('ccs_guide_details_nonce', 'ccs_guide_details_nonce');

    $reading_time = get_post_meta($post->ID, '_ccs_reading_time', true);
    $last_reviewed = get_post_meta($post->ID, '_ccs_last_reviewed', true);
    $author_credentials = get_post_meta($post->ID, '_ccs_author_credentials', true);
    ?>

    <p>
        <label><strong>Reading Time (minutes):</strong></label><br>
        <input type="number" name="ccs_reading_time" value="<?php echo esc_attr($reading_time); ?>" style="width: 100%;" placeholder="5">
    </p>

    <p>
        <label><strong>Last Reviewed Date:</strong></label><br>
        <input type="date" name="ccs_last_reviewed" value="<?php echo esc_attr($last_reviewed); ?>" style="width: 100%;">
        <small>For E-E-A-T</small>
    </p>

    <p>
        <label><strong>Author Credentials:</strong></label><br>
        <input type="text" name="ccs_author_credentials" value="<?php echo esc_attr($author_credentials); ?>" style="width: 100%;" placeholder="e.g., Registered Manager, 15 years experience">
        <small>For E-E-A-T</small>
    </p>

    <?php
}

function ccs_guide_sections_callback($post) {
    wp_nonce_field('ccs_guide_sections_nonce', 'ccs_guide_sections_nonce');

    $section_intro = get_post_meta($post->ID, '_ccs_section_intro', true);
    $section_main = get_post_meta($post->ID, '_ccs_section_main', true);
    $section_takeaways = get_post_meta($post->ID, '_ccs_section_takeaways', true);
    $section_next_steps = get_post_meta($post->ID, '_ccs_section_next_steps', true);
    ?>

    <div style="margin-bottom: 20px;">
        <h4>Section: Introduction</h4>
        <?php
        wp_editor($section_intro, 'ccs_section_intro', array(
            'textarea_name' => 'ccs_section_intro',
            'textarea_rows' => 6,
            'media_buttons' => false
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Main Content</h4>
        <?php
        wp_editor($section_main, 'ccs_section_main', array(
            'textarea_name' => 'ccs_section_main',
            'textarea_rows' => 20,
            'media_buttons' => true
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Key Takeaways</h4>
        <?php
        wp_editor($section_takeaways, 'ccs_section_takeaways', array(
            'textarea_name' => 'ccs_section_takeaways',
            'textarea_rows' => 8,
            'media_buttons' => false
        ));
        ?>
    </div>

    <div style="margin-bottom: 20px;">
        <h4>Section: Next Steps</h4>
        <?php
        wp_editor($section_next_steps, 'ccs_section_next_steps', array(
            'textarea_name' => 'ccs_section_next_steps',
            'textarea_rows' => 6,
            'media_buttons' => false
        ));
        ?>
    </div>

    <?php
}

function ccs_guide_faqs_callback($post) {
    wp_nonce_field('ccs_guide_faqs_nonce', 'ccs_guide_faqs_nonce');

    $faqs = get_post_meta($post->ID, '_ccs_faqs', true);
    if (!is_array($faqs)) {
        $faqs = array();
    }
    ?>

    <p><small>Add FAQs to generate FAQPage schema for better SEO</small></p>

    <div id="ccs-faqs-container">
        <?php
        if (!empty($faqs)) {
            foreach ($faqs as $index => $faq) {
                ?>
                <div class="ccs-faq-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd;">
                    <p>
                        <label><strong>Question:</strong></label><br>
                        <input type="text" name="ccs_faqs[<?php echo (int) $index; ?>][question]" value="<?php echo esc_attr($faq['question']); ?>" style="width: 100%;">
                    </p>
                    <p>
                        <label><strong>Answer:</strong></label><br>
                        <textarea name="ccs_faqs[<?php echo (int) $index; ?>][answer]" rows="4" style="width: 100%;"><?php echo esc_textarea($faq['answer']); ?></textarea>
                    </p>
                    <button type="button" class="button ccs-remove-faq">Remove</button>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <button type="button" class="button" id="ccs-add-faq">+ Add FAQ</button>

    <script>
    jQuery(document).ready(function($) {
        var faqIndex = <?php echo (int) count($faqs); ?>;

        $('#ccs-add-faq').on('click', function() {
            var html = '<div class="ccs-faq-item" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd;">';
            html += '<p><label><strong>Question:</strong></label><br>';
            html += '<input type="text" name="ccs_faqs[' + faqIndex + '][question]" style="width: 100%;"></p>';
            html += '<p><label><strong>Answer:</strong></label><br>';
            html += '<textarea name="ccs_faqs[' + faqIndex + '][answer]" rows="4" style="width: 100%;"></textarea></p>';
            html += '<button type="button" class="button ccs-remove-faq">Remove</button>';
            html += '</div>';

            $('#ccs-faqs-container').append(html);
            faqIndex++;
        });

        $(document).on('click', '.ccs-remove-faq', function() {
            $(this).closest('.ccs-faq-item').remove();
        });
    });
    </script>

    <?php
}

function ccs_save_guide_meta($post_id) {
    if (!isset($_POST['ccs_guide_details_nonce']) || !wp_verify_nonce($_POST['ccs_guide_details_nonce'], 'ccs_guide_details_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['ccs_reading_time'])) {
        update_post_meta($post_id, '_ccs_reading_time', absint($_POST['ccs_reading_time']));
    }
    if (isset($_POST['ccs_last_reviewed'])) {
        update_post_meta($post_id, '_ccs_last_reviewed', sanitize_text_field($_POST['ccs_last_reviewed']));
    }
    if (isset($_POST['ccs_author_credentials'])) {
        update_post_meta($post_id, '_ccs_author_credentials', sanitize_text_field($_POST['ccs_author_credentials']));
    }

    if (isset($_POST['ccs_guide_sections_nonce']) && wp_verify_nonce($_POST['ccs_guide_sections_nonce'], 'ccs_guide_sections_nonce')) {
        if (isset($_POST['ccs_section_intro'])) {
            update_post_meta($post_id, '_ccs_section_intro', wp_kses_post($_POST['ccs_section_intro']));
        }
        if (isset($_POST['ccs_section_main'])) {
            update_post_meta($post_id, '_ccs_section_main', wp_kses_post($_POST['ccs_section_main']));
        }
        if (isset($_POST['ccs_section_takeaways'])) {
            update_post_meta($post_id, '_ccs_section_takeaways', wp_kses_post($_POST['ccs_section_takeaways']));
        }
        if (isset($_POST['ccs_section_next_steps'])) {
            update_post_meta($post_id, '_ccs_section_next_steps', wp_kses_post($_POST['ccs_section_next_steps']));
        }
    }

    if (isset($_POST['ccs_guide_faqs_nonce']) && wp_verify_nonce($_POST['ccs_guide_faqs_nonce'], 'ccs_guide_faqs_nonce')) {
        $faqs = array();
        if (isset($_POST['ccs_faqs']) && is_array($_POST['ccs_faqs'])) {
            foreach ($_POST['ccs_faqs'] as $faq) {
                if (!empty($faq['question']) && !empty($faq['answer'])) {
                    $faqs[] = array(
                        'question' => sanitize_text_field($faq['question']),
                        'answer' => sanitize_textarea_field($faq['answer'])
                    );
                }
            }
        }
        update_post_meta($post_id, '_ccs_faqs', $faqs);
    }
}
add_action('save_post_guide', 'ccs_save_guide_meta');
