<?php
/**
 * Customizer: Front page hero — optional background image.
 */

function ccs_hero_customize_register( WP_Customize_Manager $wp_customize ) {
    $wp_customize->add_section( 'ccs_hero', array(
        'title'    => __( 'Front page hero', 'ccs-theme' ),
        'priority' => 35,
    ) );

    $wp_customize->add_setting( 'ccs_hero_background_image', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( new WP_Customize_Media_Control(
        $wp_customize,
        'ccs_hero_background_image',
        array(
            'label'     => __( 'Hero background image', 'ccs-theme' ),
            'description' => __( 'Optional. Shown behind the overlay on the front page hero. Leave empty for gradient only.', 'ccs-theme' ),
            'section'   => 'ccs_hero',
            'mime_type' => 'image',
        )
    ) );
}
add_action( 'customize_register', 'ccs_hero_customize_register' );
