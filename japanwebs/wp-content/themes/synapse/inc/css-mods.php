<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function synapse_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	
	//If Menu Description is Disabled.
	if ( !has_nav_menu('primary') || get_theme_mod('synapse_disable_nav_desc') ) :
		echo "#site-navigation ul li a { padding: 16px 12px; }";
	endif;
	
	
	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('synapse_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: center; }";
	endif;	
	
	if ( get_theme_mod('synapse_title_font') ) :
		echo ".title-font, h1, h2, .section-title, .woocommerce ul.products li.product h3, #site-navigation { font-family: ".esc_html( get_theme_mod('synapse_title_font','Play') )."; }";
	endif;
	
	if ( get_theme_mod('synapse_body_font') ) :
		echo "body { font-family: ".esc_html( get_theme_mod('synapse_body_font','Lato') )."; }";
	endif;
	
	if ( get_theme_mod('synapse_site_titlecolor') ) :
		echo "#masthead h1.site-title a { color: ".esc_html( get_theme_mod('synapse_site_titlecolor', '#FFFFFF') )."; }";
	endif;
	
	
	if ( get_theme_mod('synapse_header_desccolor','#aaa') ) :
		echo ".site-description { color: ".esc_html( get_theme_mod('synapse_header_desccolor','#aaa') )."; }";
	endif;
	//Check Jetpack is active
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) )
		echo '.pagination { display: none; }';
	
	
	if ( get_theme_mod('synapse_hide_title_tagline') ) :
		echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	if ( get_theme_mod('synapse_logo_resize') ) :
		$val = esc_html( get_theme_mod('synapse_logo_resize') )/100;
		echo "#masthead .custom-logo { transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
		endif;

    // page & post fontsize
    if(get_theme_mod('synapse_content_page_post_fontsize_set')):
        $val = get_theme_mod('synapse_content_page_post_fontsize_set');
        if($val=='small'):
            echo "#primary-mono .entry-content{ font-size:12px;}";
        elseif ($val=='medium'):
            echo "#primary-mono .entry-content{ font-size:16px;}";
        elseif ($val=='large'):
            echo "#primary-mono .entry-content{ font-size:18px;}";
        elseif ($val=='extra-large'):
            echo "#primary-mono .entry-content{ font-size:20px;}";
        endif;
    else:
        echo "#primary-mono .entry-content{ font-size:14px;}";
    endif;
    //site title font size
    //var_dump(get_theme_mod('synapse_content_site_fontsize_set'));
    if(get_theme_mod('synapse_content_site_title_fontsize_set')):
        $val = get_theme_mod('synapse_content_site_title_fontsize_set');
        if($val != 'default'):
            echo ".site-branding .site-title {font-size:".$val."px !important;}";
        else:
            echo ".site-branding .site-title {font-size:50"."px;}";
        endif;
    endif;

    //site desc font size
    //var_dump(get_theme_mod('synapse_content_site_desc_fontsize_set'));
    if(get_theme_mod('synapse_content_site_desc_fontsize_set')):
        $val=get_theme_mod('synapse_content_site_desc_fontsize_set');
        if($val != 'default'):
            echo ".site-branding .site-description{font-size:".$val."px !important;}";
        else:
            echo ".site-branding .site-description {font-size:15"."px;}";
        endif;
    endif;
	echo "</style>";
}

add_action('wp_head', 'synapse_custom_css_mods');