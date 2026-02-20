<?php
/**
 * Duplicate post: row actions + admin action. Copies post, taxonomies, meta, thumbnail.
 */

function ccs_duplicate_post_link($actions, $post) {
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=ccs_duplicate_post&post=' . $post->ID, 'ccs_duplicate_' . $post->ID) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
    }
    return $actions;
}
add_filter('post_row_actions', 'ccs_duplicate_post_link', 10, 2);
add_filter('page_row_actions', 'ccs_duplicate_post_link', 10, 2);

function ccs_duplicate_post() {
    if (empty($_GET['post'])) {
        wp_die('No post to duplicate has been supplied!');
    }

    $post_id = absint($_GET['post']);
    check_admin_referer('ccs_duplicate_' . $post_id);

    $post = get_post($post_id);
    if (!$post) {
        wp_die('Post not found!');
    }
    if (!current_user_can('edit_post', $post_id)) {
        wp_die('You do not have permission to duplicate this post.');
    }

    $new_post = array(
        'post_title'   => $post->post_title . ' (Copy)',
        'post_content' => $post->post_content,
        'post_excerpt'  => $post->post_excerpt,
        'post_status'   => 'draft',
        'post_type'     => $post->post_type,
        'post_author'   => get_current_user_id(),
        'post_parent'   => $post->post_parent,
        'menu_order'    => $post->menu_order
    );

    $new_post_id = wp_insert_post($new_post);
    if (is_wp_error($new_post_id)) {
        wp_die('Failed to create duplicate.');
    }

    $taxonomies = get_object_taxonomies($post->post_type);
    foreach ($taxonomies as $taxonomy) {
        $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
        if (!is_wp_error($post_terms) && !empty($post_terms)) {
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }
    }

    $post_meta = get_post_meta($post_id);
    foreach ($post_meta as $meta_key => $meta_values) {
        if ($meta_key === '_thumbnail_id') {
            continue;
        }
        foreach ($meta_values as $meta_value) {
            add_post_meta($new_post_id, $meta_key, maybe_unserialize($meta_value));
        }
    }

    $thumbnail_id = get_post_thumbnail_id($post_id);
    if ($thumbnail_id) {
        set_post_thumbnail($new_post_id, $thumbnail_id);
    }

    wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
    exit;
}
add_action('admin_action_ccs_duplicate_post', 'ccs_duplicate_post');

function ccs_admin_bar_duplicate_link($wp_admin_bar) {
    global $post;

    if (!is_admin() || !is_object($post)) {
        return;
    }
    if (!current_user_can('edit_post', $post->ID)) {
        return;
    }

    $wp_admin_bar->add_node(array(
        'id'    => 'duplicate-post',
        'title' => 'Duplicate This',
        'href'  => wp_nonce_url(admin_url('admin.php?action=ccs_duplicate_post&post=' . $post->ID), 'ccs_duplicate_' . $post->ID),
        'meta'  => array('class' => 'duplicate-post-link')
    ));
}
add_action('admin_bar_menu', 'ccs_admin_bar_duplicate_link', 90);
