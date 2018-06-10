<?php
//upgrade
function synapse_customize_register_misc( $wp_customize ) {
$wp_customize->add_section(
    'synapse_sec_upgrade_pro',
    array(
        'title'     => __('Upgrade to Synapse Pro','synapse'),
        'priority'  => 3,
    )
);

$wp_customize->add_setting(
    'synapse_upgrade_pro',
    array( 'sanitize_callback' => 'esc_textarea' )
);

$wp_customize->add_control(
    new Synapse_WP_Customize_Upgrade_Control(
        $wp_customize,
        'synapse_upgrade_pro',
        array(
            'label' => __('Thanks for visiting this section.<br /> I hope you are enjoying the free version of this theme. I have not restricted any feature in the free version. But for those who want more power, more performance and more customization I have created a pro version for you as well. Some of the exciting Features of Synapse Pro are <br /><br />- Better Mobile Friendliness <br />- Unlimited Colors & Skins <br />- Many More Featured Areas <br />- Advanced Slider  <br />- 600+ Custom Fonts <br />- More Blog/Page Layouts <br />- Adsense Support  <br />- And Much More <br /><br /> To Purchase & Know more visit  <a target="_blank" href="https://inkhive.com/product/synapse-pro/">Synapse Pro</a>.','synapse'),
            'section' => 'synapse_sec_upgrade_pro',
            'settings' => 'synapse_upgrade_pro',
        )
    )
);

$wp_customize->add_section(
    'synapse_sec_upgrade',
    array(
        'title'     => __('Synapse Theme - Help & Support','synapse'),
        'priority'  => 4,
    )
);

$wp_customize->add_setting(
    'synapse_upgrade',
    array( 'sanitize_callback' => 'esc_textarea' )
);

$wp_customize->add_control(
    new Synapse_WP_Customize_Upgrade_Control(
        $wp_customize,
        'synapse_upgrade',
        array(
            'label' => __('Thank You','synapse'),
            'description' => __('Thank You for Choosing Synapse Theme by Inkhive Themes. Synapse is a Powerful Wordpress theme which also supports WooCommerce in the best possible way. It is "as we say" the last theme you would ever need. It has all the basic and advanced features needed to run a gorgeous looking site. For any Help related to this theme, please visit  <a href="https://inkhive.com/contact-us/">Synapse Help & Support</a>.','synapse'),
            'section' => 'synapse_sec_upgrade',
            'settings' => 'synapse_upgrade',
        )
    )
);
}
add_action( 'customize_register', 'synapse_customize_register_misc' );