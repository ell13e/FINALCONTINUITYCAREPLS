<?php
/**
 * Custom URL rewrites for CPTs. Careers use Pages (e.g. /careers/, /careers/jobs/) with CV Minder.
 */

function ccs_rewrite_rules() {
    add_rewrite_rule('^conditions/?$', 'index.php?post_type=condition', 'top');
    add_rewrite_rule('^conditions/page/([0-9]+)/?$', 'index.php?post_type=condition&paged=$matches[1]', 'top');
    add_rewrite_rule('^locations/?$', 'index.php?post_type=location', 'top');
    add_rewrite_rule('^guides/?$', 'index.php?post_type=guide', 'top');
    add_rewrite_rule('^how-it-works/?$', 'index.php?post_type=process', 'top');
}
add_action('init', 'ccs_rewrite_rules', 20);

function ccs_rewrite_flush() {
    ccs_rewrite_rules();
    flush_rewrite_rules();
}
