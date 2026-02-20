<?php
/**
 * Register taxonomies: town, service-type (for service/location/team).
 */

function ccs_register_taxonomies() {

    register_taxonomy('town', array('location', 'service', 'team'), array(
        'labels'            => array(
            'name'          => 'Towns',
            'singular_name' => 'Town',
            'add_new_item'  => 'Add New Town',
        ),
        'public'            => true,
        'hierarchical'      => true,
        'rewrite'           => array('slug' => 'town'),
        'show_admin_column' => true,
    ));

    register_taxonomy('service-type', array('service'), array(
        'labels'            => array(
            'name'          => 'Service Types',
            'singular_name' => 'Service Type',
            'add_new_item'  => 'Add New Service Type',
        ),
        'public'            => true,
        'hierarchical'      => true,
        'rewrite'           => array('slug' => 'service-type'),
        'show_admin_column' => true,
    ));
}
add_action('init', 'ccs_register_taxonomies', 10);
