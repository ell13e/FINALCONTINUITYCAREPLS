<?php
/**
 * Customizer: CV Minder — Use embed toggle and iframe URL for careers/jobs page.
 */

function ccs_cvminder_customize_register( WP_Customize_Manager $wp_customize ) {
    $wp_customize->add_section( 'ccs_cvminder', array(
        'title'    => __( 'CV Minder (Careers)', 'ccs-theme' ),
        'priority' => 120,
    ) );

    $wp_customize->add_setting( 'ccs_use_cvminder', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ) );
    $wp_customize->add_control( 'ccs_use_cvminder', array(
        'label'   => __( 'Use CV Minder job portal on Jobs page', 'ccs-theme' ),
        'section' => 'ccs_cvminder',
        'type'    => 'checkbox',
    ) );

    $default_url = 'https://cvminder.com/jobportal/index.php?gid=60&pk=2347289374823605326759060200713';
    $wp_customize->add_setting( 'ccs_cvminder_url', array(
        'default'           => $default_url,
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'ccs_cvminder_url', array(
        'label'       => __( 'CV Minder iframe URL', 'ccs-theme' ),
        'description' => __( 'Override the default job portal URL if needed.', 'ccs-theme' ),
        'section'     => 'ccs_cvminder',
        'type'        => 'url',
    ) );
}
add_action( 'customize_register', 'ccs_cvminder_customize_register' );
