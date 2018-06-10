<?php
//Fonts
function synapse_customize_register_fonts( $wp_customize ) {
$wp_customize->add_section(
    'synapse_typo_options',
    array(
        'title'     => __('Google Web Fonts','synapse'),
        'priority'  => 41,
        'description' => __('Defaults: Play, Lap.','synapse'),
        'panel'     => 'synapse_design_panel'
    )
);

$font_array = array('Play','Open Sans','Droid Sans','Lato','Droid Serif','Roboto');
$fonts = array_combine($font_array, $font_array);

$wp_customize->add_setting(
    'synapse_title_font',
    array(
        'default'=> 'Play',
        'sanitize_callback' => 'synapse_sanitize_gfont'
    )
);

function synapse_sanitize_gfont( $input ) {
    if ( in_array($input, array('Play','Open Sans','Droid Sans','Lato','Droid Serif','Roboto') ) )
        return $input;
    else
        return '';
}

$wp_customize->add_control(
    'synapse_title_font',array(
        'label' => __('Title','synapse'),
        'settings' => 'synapse_title_font',
        'section'  => 'synapse_typo_options',
        'type' => 'select',
        'choices' => $fonts,
    )
);

$wp_customize->add_setting(
    'synapse_body_font',
    array(	'default'=> 'Lato',
        'sanitize_callback' => 'synapse_sanitize_gfont' )
);

$wp_customize->add_control(
    'synapse_body_font',array(
        'label' => __('Body','synapse'),
        'settings' => 'synapse_body_font',
        'section'  => 'synapse_typo_options',
        'type' => 'select',
        'choices' => $fonts
    )
);
//Page and Post content Font size start
    $wp_customize->add_setting(
        'synapse_content_page_post_fontsize_set',
        array(
            'default' => 'default',
            'sanitize_callback' => 'synapse_sanitize_content_size'
        )
    );
    function synapse_sanitize_content_size( $input ) {
        if ( in_array($input, array('default','small','medium','large','extra-large') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'synapse_content_page_post_fontsize_set', array(
            'settings' => 'synapse_content_page_post_fontsize_set',
            'label'    => __( 'Page/Post Font Size','synapse' ),
            'description' => __('Choose your font size. This is only for Posts and Pages. It wont affect your blog page.','synapse'),
            'section'  => 'synapse_typo_options',
            'type'     => 'select',
            'choices' => array(
                'default'   => 'Default',
                'small' => 'Small',
                'medium'   => 'Medium',
                'large'  => 'Large',
                'extra-large' => 'Extra Large',
            ),
        )
    );

    //Page and Post content Font size end
    //site title Font size start
    $wp_customize->add_setting(
        'synapse_content_site_title_fontsize_set',
        array(
            'default' => '50',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'synapse_content_site_title_fontsize_set', array(
            'settings' => 'synapse_content_site_title_fontsize_set',
            'label'    => __( 'Site Title Font Size','synapse' ),
            'description' => __('Choose your font size. This is only for Site Title.','synapse'),
            'section'  => 'synapse_typo_options',
            'type'     => 'number',
        )
    );
    //site title Font size end

    //site description Font size start
    $wp_customize->add_setting(
        'synapse_content_site_desc_fontsize_set',
        array(
            'default' => '15',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'synapse_content_site_desc_fontsize_set', array(
            'settings' => 'synapse_content_site_desc_fontsize_set',
            'label'    => __( 'Site Description Font Size','synapse' ),
            'description' => __('Choose your font size. This is only for Site Description.','synapse'),
            'section'  => 'synapse_typo_options',
            'type'     => 'number',
        )
    );
    //site description Font size end

}
add_action( 'customize_register', 'synapse_customize_register_fonts' );