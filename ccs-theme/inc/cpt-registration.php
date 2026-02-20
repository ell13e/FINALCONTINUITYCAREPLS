<?php
/**
 * Register Custom Post Types: service, condition, location, guide, process, team.
 * Careers/jobs use CV Minder embed (page template), not a CPT.
 */

function ccs_register_post_types() {

    register_post_type('service', array(
        'labels'              => array(
            'name'          => 'Services',
            'singular_name' => 'Service',
            'add_new_item'  => 'Add New Service',
            'edit_item'     => 'Edit Service',
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'services'),
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
        'menu_icon'           => 'dashicons-admin-generic',
    ));

    register_post_type('condition', array(
        'labels'              => array(
            'name'          => 'Conditions',
            'singular_name' => 'Condition',
            'add_new_item'  => 'Add New Condition',
            'edit_item'     => 'Edit Condition',
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'conditions'),
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
        'menu_icon'           => 'dashicons-heart',
    ));

    register_post_type('location', array(
        'labels'              => array(
            'name'          => 'Locations',
            'singular_name' => 'Location',
            'add_new_item'  => 'Add New Location',
            'edit_item'     => 'Edit Location',
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'locations'),
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
        'hierarchical'       => true,
        'menu_icon'           => 'dashicons-location-alt',
    ));

    register_post_type('guide', array(
        'labels'              => array(
            'name'          => 'Guides',
            'singular_name' => 'Guide',
            'add_new_item'  => 'Add New Guide',
            'edit_item'     => 'Edit Guide',
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'guides'),
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
        'menu_icon'           => 'dashicons-book',
    ));

    register_post_type('process', array(
        'labels'              => array(
            'name'          => 'Process Steps',
            'singular_name' => 'Process Step',
            'add_new_item'  => 'Add New Step',
            'edit_item'     => 'Edit Step',
        ),
        'public'              => true,
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'how-it-works'),
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
        'menu_icon'           => 'dashicons-list-view',
    ));

    register_post_type('team', array(
        'labels'              => array(
            'name'          => 'Team Members',
            'singular_name' => 'Team Member',
            'add_new_item'  => 'Add New Team Member',
            'edit_item'     => 'Edit Team Member',
        ),
        'public'              => true,
        'publicly_queryable' => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => 'team'),
        'supports'            => array('title', 'editor', 'thumbnail'),
        'menu_icon'           => 'dashicons-admin-users',
    ));
}
add_action('init', 'ccs_register_post_types', 5);
