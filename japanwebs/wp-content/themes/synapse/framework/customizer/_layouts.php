<?php
// Layout and Design
function synapse_customize_register_layouts( $wp_customize ) {
    $wp_customize->get_section('background_image')->panel = 'synapse_design_panel';

$wp_customize->add_panel( 'synapse_design_panel', array(
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Design & Layout','synapse'),
) );

$wp_customize->add_section(
    'synapse_design_options',
    array(
        'title'     => __('Blog Layout','synapse'),
        'priority'  => 0,
        'panel'     => 'synapse_design_panel'
    )
);


$wp_customize->add_setting(
    'synapse_blog_layout',
    array( 'sanitize_callback' => 'synapse_sanitize_blog_layout','default'=>'synapse' )
);

function synapse_sanitize_blog_layout( $input ) {
    if ( in_array($input, array('grid','grid_2_column','synapse','maximum') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'synapse_blog_layout',array(
        'label' => __('Select Layout','synapse'),
        'settings' => 'synapse_blog_layout',
        'section'  => 'synapse_design_options',
        'type' => 'select',
        'choices' => array(
            'grid' => __('Standard Blog Layout','synapse'),
            'synapse' => __('Synapse Theme Layout','synapse'),
            'grid_2_column' => __('Grid - 2 Column','synapse'),
            'maximum' => __('Maximum Layout','synapse'),
        )
    )
);

$wp_customize->add_section(
    'synapse_sidebar_options',
    array(
        'title'     => __('Sidebar Layout','synapse'),
        'priority'  => 0,
        'panel'     => 'synapse_design_panel'
    )
);

$wp_customize->add_setting(
    'synapse_disable_sidebar',
    array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
);

$wp_customize->add_control(
    'synapse_disable_sidebar', array(
        'settings' => 'synapse_disable_sidebar',
        'label'    => __( 'Disable Sidebar Everywhere.','synapse' ),
        'section'  => 'synapse_sidebar_options',
        'type'     => 'checkbox',
        'default'  => false
    )
);

$wp_customize->add_setting(
    'synapse_disable_sidebar_home',
    array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
);

$wp_customize->add_control(
    'synapse_disable_sidebar_home', array(
        'settings' => 'synapse_disable_sidebar_home',
        'label'    => __( 'Disable Sidebar on Home/Blog.','synapse' ),
        'section'  => 'synapse_sidebar_options',
        'type'     => 'checkbox',
        'active_callback' => 'synapse_show_sidebar_options',
        'default'  => false
    )
);

$wp_customize->add_setting(
    'synapse_disable_sidebar_front',
    array( 'sanitize_callback' => 'synapse_sanitize_checkbox' )
);

$wp_customize->add_control(
    'synapse_disable_sidebar_front', array(
        'settings' => 'synapse_disable_sidebar_front',
        'label'    => __( 'Disable Sidebar on Front Page.','synapse' ),
        'section'  => 'synapse_sidebar_options',
        'type'     => 'checkbox',
        'active_callback' => 'synapse_show_sidebar_options',
        'default'  => false
    )
);


$wp_customize->add_setting(
    'synapse_sidebar_width',
    array(
        'default' => 4,
        'sanitize_callback' => 'synapse_sanitize_positive_number' )
);

$wp_customize->add_control(
    'synapse_sidebar_width', array(
        'settings' => 'synapse_sidebar_width',
        'label'    => __( 'Sidebar Width','synapse' ),
        'description' => __('Min: 25%, Default: 33%, Max: 40%','synapse'),
        'section'  => 'synapse_sidebar_options',
        'type'     => 'range',
        'active_callback' => 'synapse_show_sidebar_options',
        'input_attrs' => array(
            'min'   => 3,
            'max'   => 5,
            'step'  => 1,
            'class' => 'sidebar-width-range',
            'style' => 'color: #0a0',
        ),
    )
);

/* Active Callback Function */
function synapse_show_sidebar_options($control) {

    $option = $control->manager->get_setting('synapse_disable_sidebar');
    return $option->value() == false ;

}

$wp_customize-> add_section(
    'synapse_custom_footer',
    array(
        'title'			=> __('Custom Footer Text','synapse'),
        'description'	=> __('Enter your Own Copyright Text.','synapse'),
        'priority'		=> 11,
        'panel'			=> 'synapse_design_panel'
    )
);

$wp_customize->add_setting(
    'synapse_footer_text',
    array(
        'default'		=> '',
        'sanitize_callback'	=> 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    'synapse_footer_text',
    array(
        'section' => 'synapse_custom_footer',
        'settings' => 'synapse_footer_text',
        'type' => 'text'
    )
);
}
add_action( 'customize_register', 'synapse_customize_register_layouts' );