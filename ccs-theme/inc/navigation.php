<?php
/**
 * Context-switching nav. Returns 'care' or 'careers' for header/footer.
 * Care: Services, Pricing, How It Works, Our Team, Resources; CTA Book Consultation.
 * Careers: Why Join Us, Typical Day, Training, Jobs, Apply; CTA Apply Now.
 */

function ccs_get_site_context() {
    $context = 'care';

    $slug = get_post_queried_object_slug();
    if ($slug && in_array($slug, array('careers', 'why-join-us', 'typical-day', 'training', 'jobs', 'apply'), true)) {
        $context = 'careers';
    }

    return apply_filters('ccs_site_context', $context);
}

function get_post_queried_object_slug() {
    $obj = get_queried_object();
    if (!$obj || !isset($obj->post_name)) {
        return '';
    }
    return $obj->post_name;
}
