<?php
//FEATURED POSTS SLIDER
function synapse_customize_fposts_slider( $wp_customize ) {
$wp_customize->add_section(
    'synapse_feat_post_slider_section',
    array(
        'title'     => __('Featured Posts Slider','synapse'),
        'priority'  => 35,
    )
);


$wp_customize->add_setting(
    'synapse_feat_post_slider_enable',
    array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
);

$wp_customize->add_control(
    'synapse_feat_post_slider_enable', array(
        'settings' => 'synapse_feat_post_slider_enable',
        'label'    => __( 'Enable', 'synapse' ),
        'section'  => 'synapse_feat_post_slider_section',
        'type'     => 'checkbox',
    )
);

$wp_customize->add_setting(
    'synapse_feat_post_slider_cat',
    array( 'sanitize_callback' => 'synapse_sanitize_category' )
);


$wp_customize->add_control(
    new Synapse_WP_Customize_Category_Control(
        $wp_customize,
        'synapse_feat_post_slider_cat',
        array(
            'label'    => __('Category For Image Grid','synapse'),
            'settings' => 'synapse_feat_post_slider_cat',
            'section'  => 'synapse_feat_post_slider_section'
        )
    )
);

$wp_customize->add_setting(
    'synapse_feat_post_slider_pc',
    array( 'sanitize_callback' => 'synapse_sanitize_positive_number' )
);

$wp_customize->add_control(
    'synapse_feat_post_slider_pc', array(
        'settings' => 'synapse_feat_post_slider_pc',
        'label'    => __( 'Max No. of Posts. Min: 4.', 'synapse' ),
        'section'  => 'synapse_feat_post_slider_section',
        'type'     => 'number',
        'default'  => '0'
    )
);
}
add_action( 'customize_register', 'synapse_customize_fposts_slider' );