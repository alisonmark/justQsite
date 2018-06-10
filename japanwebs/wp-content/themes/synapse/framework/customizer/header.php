<?php
//Logo Settings
function synapse_customize_register_header( $wp_customize ) {
    $wp_customize->add_panel('synapse_header_panel', array(
        'priority' => 10,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Header Settings', 'synapse'),


    ));
$wp_customize->add_section( 'title_tagline' , array(
    'title'      => __( 'Title, Tagline & Logo', 'synapse' ),
    'priority'   => 30,
    'panel' => 'synapse_header_panel'
) );
    
//Replace Header Text Color with, separate colors for Title and Description
//Override synapse_site_titlecolor
$wp_customize->remove_control('display_header_text');
$wp_customize->remove_setting('header_textcolor');
$wp_customize->add_setting('synapse_site_titlecolor', array(
    'default'     => '#FFFFFF',
    'sanitize_callback' => 'sanitize_hex_color',
));
//header panel





$wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'synapse_site_titlecolor', array(
        'label' => __('Site Title Color','synapse'),
        'section' => 'colors',
        'settings' => 'synapse_site_titlecolor',
        'type' => 'color'
    ) )
);

$wp_customize->add_setting('synapse_header_desccolor', array(
    'default'     => '#AAAAAA',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'synapse_header_desccolor', array(
        'label' => __('Site Tagline Color','synapse'),
        'section' => 'colors',
        'settings' => 'synapse_header_desccolor',
        'type' => 'color'
    ) )
);

//Settings For Logo Area

$wp_customize->add_setting(
    'synapse_hide_title_tagline',
    array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
);

$wp_customize->add_control(
    'synapse_hide_title_tagline', array(
        'settings' => 'synapse_hide_title_tagline',
        'label'    => __( 'Hide Title and Tagline.', 'synapse' ),
        'section'  => 'title_tagline',
        'type'     => 'checkbox',
    )
);

function synapse_title_visible( $control ) {
    $option = $control->manager->get_setting('synapse_hide_title_tagline');
    return $option->value() == false ;
}
}
add_action( 'customize_register', 'synapse_customize_register_header' );