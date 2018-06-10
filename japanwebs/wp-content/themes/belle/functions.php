<?php

/**************************************
INDEX

PHP INCLUDES
WP ENQUEUE
SETUP THEME
	ADD ACTIONS
	ADD FILTERS
	ADD_THEME_SUPPORT CALLS
	IMAGE SIZES
	REGISTER MENUS
	LOCALIZATION INIT
REGISTER WIDGET AREAS
	REGISTER THEME WIDGET AREAS
	REGISTER CUSTOM WIDGET AREAS
MEDIA UPLOAD CUSTOMIZE
REMOVE THEME SETTINGS FOR NON-ADMINS
FILTER BODY CLASS
FILTER WORDPRESS MENUS
FILTER SEARCH QUERY
FILTER USER CONTACTMETHODS
SET THEME COOKIE
CANON HOVER BOXES
MAINTENANCE MODE REMINDER
LEGACY TITLE TAG 
EXCLUDE THEME FROM REPOSITORY UPDATE CHECK

***************************************/

/**************************************
PHP INCLUDES
***************************************/

	include get_template_directory() . '/inc/functions/functions_tgm.php';
	include get_template_directory() . '/inc/functions/functions_ajax.php';
	include get_template_directory() . '/inc/functions/functions_font_awesome.php';
	include get_template_directory() . '/inc/functions/functions_google_webfonts.php';
	
	// framework
	include get_template_directory() . '/inc/framework/canon_fw_index.php';

	// options
	include get_template_directory() . '/inc/options/options_general_control.php';
	include get_template_directory() . '/inc/options/options_frame_control.php';
	include get_template_directory() . '/inc/options/options_post_control.php';
	include get_template_directory() . '/inc/options/options_appearance_control.php';
	include get_template_directory() . '/inc/options/options_advanced_control.php';
	include get_template_directory() . '/inc/options/options_help_control.php';

	// // dynamic css
	include get_template_directory() . '/inc/templates/dynamic_css.php';
	include get_template_directory() . '/inc/templates/dynamic_css_admin.php';


/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	if (!function_exists("canon_belle_load_to_front")) { function canon_belle_load_to_front() {	

		//get options
		$canon_options = get_option('canon_options');
		$canon_options_frame = get_option('canon_options_frame');
		$canon_options_post = get_option('canon_options_post');
		$canon_options_appearance = get_option('canon_options_appearance');
		$canon_options_advanced = get_option('canon_options_advanced');

		// dev mode options
		if ($canon_options['dev_mode'] == "checked") {
			if (isset($_GET['use_boxed_design'])) { $canon_options['use_boxed_design'] = wp_filter_nohtml_kses($_GET['use_boxed_design']); }
			if (isset($_GET['anim_menus'])) { $canon_options_appearance['anim_menus'] = wp_filter_nohtml_kses($_GET['anim_menus']); }
		}

		//wp scripts
		wp_enqueue_script('jquery-ui', false, array(), false, false);
		wp_enqueue_script('jquery-ui-autocomplete', false, array(), false, true);

		// //external scripts
		wp_enqueue_script('fancybox-mousewheel', get_template_directory_uri() . '/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array('jquery'), false, true);
		wp_enqueue_script('fancybox-core', get_template_directory_uri() . '/js/fancybox/source/jquery.fancybox.pack.js', array('jquery'), false, true);
		wp_enqueue_script('fancybox-buttons', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-buttons.js', array('fancybox-core'), false, true);
		wp_enqueue_script('fancybox-media', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-media.js', array('fancybox-core'), false, true);
		
		if (!is_single()) { wp_enqueue_script('isotope', get_template_directory_uri(). '/js/isotope.pkgd.min.js', array(), false, true); }
		wp_enqueue_script('flexslider', get_template_directory_uri(). '/js/jquery.flexslider-min.js', array(), false, true);
		wp_enqueue_script('fitvids', get_template_directory_uri(). '/js/jquery.fitvids.js', array(), false, true);
		wp_enqueue_script('placeholder', get_template_directory_uri(). '/js/placeholder.js', array(), false, true);
		wp_enqueue_script('matchHeight', get_template_directory_uri(). '/js/jquery.matchHeight-min.js', array(), false, true);
		wp_enqueue_script('imagesloaded', get_template_directory_uri(). '/js/imagesloaded.pkgd.min.js', array(), false, true);


		wp_enqueue_script('sidr', get_template_directory_uri(). '/js/jquery.sidr.js', array(), false, true);
		wp_enqueue_script('cleantabs', get_template_directory_uri(). '/js/cleantabs.jquery.js', array(), false, true);
		wp_enqueue_script('stellar', get_template_directory_uri(). '/js/jquery.stellar.min.js', array(), false, true);
		if ($canon_options['back_to_top_button'] == "floating") { wp_enqueue_script('scrollup', get_template_directory_uri(). '/js/jquery.scrollUp.min.js', array(), false, true); }
		wp_enqueue_script('selectivizr', get_template_directory_uri(). '/js/selectivizr-min.js', array(), false, true);
		wp_enqueue_script('countdown', get_template_directory_uri(). '/js/jquery.countdown.min.js', array(), false, true);
		wp_enqueue_script('owl-carousel', get_template_directory_uri(). '/js/owl-carousel/owl.carousel.min.js', array(), false, true);
		wp_enqueue_script('instagram-embeds', '//platform.instagram.com/en_US/embeds.js', array(), false, true);

		//canon scripts
		wp_enqueue_script('canon-global-functions', get_template_directory_uri(). '/js/canon-global-functions.js', array(), false, true);
		wp_enqueue_script('canon-mb-custom-scripts', get_template_directory_uri(). '/js/mb-custom-scripts.js', array(), false, true);
		wp_enqueue_script('canon-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), false, true);


		//support for threaded comments
		if (is_singular() && get_option('thread_comments'))	wp_enqueue_script('comment-reply');
		
		//styles (css)
		wp_enqueue_style('canon-normalize', get_template_directory_uri(). '/css/normalize.min.css');

		wp_enqueue_style('fancybox-style', get_template_directory_uri(). '/js/fancybox/source/jquery.fancybox.css');
		wp_enqueue_style('fancybox-buttons-style', get_template_directory_uri(). '/js/fancybox/source/helpers/jquery.fancybox-buttons.css');
		wp_enqueue_style('sidr-style', get_template_directory_uri(). '/css/jquery.sidr.light.css');
		wp_enqueue_style('flexslider-style', get_template_directory_uri(). '/css/flexslider.css');
		wp_enqueue_style('font-awesome-style', get_template_directory_uri(). '/css/font-awesome.css');
		wp_enqueue_style('countdown-style', get_template_directory_uri(). '/css/jquery.countdown.css');
		wp_enqueue_style('owl-carousel-style', get_template_directory_uri(). '/js/owl-carousel/owl.carousel.css');
		if (class_exists('Woocommerce')) { wp_enqueue_style('woo-shop-style', get_template_directory_uri(). '/css/woo-shop.css'); }	// enqueue theme woocommerce style
		
		wp_enqueue_style('canon-style', get_stylesheet_uri());
		if (isset($canon_options['use_responsive_design'])) { if ($canon_options['use_responsive_design'] == "checked") { wp_enqueue_style('canon-responsive-style', get_template_directory_uri(). '/css/responsive.css'); } }
		if (isset($canon_options['use_boxed_design'])) { if ($canon_options['use_boxed_design'] == "checked") { wp_enqueue_style('canon-boxed-style', get_template_directory_uri(). '/css/boxed.css'); } }
		if (is_rtl()) { wp_enqueue_style('canon-rtl-style', get_template_directory_uri(). '/css/rtl.css'); }

		// google webfonts
	    if (isset($canon_options_appearance['font_main'][0])) { if ($canon_options_appearance['font_main'][0] != "canon_default") { wp_enqueue_style( 'canon-font-main', canon_fw_get_google_webfonts_link($canon_options_appearance['font_main']), array(), null ); } }
	    if (isset($canon_options_appearance['font_heading'][0])) { if ($canon_options_appearance['font_heading'][0] != "canon_default") { wp_enqueue_style( 'canon-font-heading', canon_fw_get_google_webfonts_link($canon_options_appearance['font_heading']), array(), null ); } }
	    if (isset($canon_options_appearance['font_heading2'][0])) { if ($canon_options_appearance['font_heading2'][0] != "canon_default") { wp_enqueue_style( 'canon-font-heading2', canon_fw_get_google_webfonts_link($canon_options_appearance['font_heading2']), array(), null ); } }
	    if (isset($canon_options_appearance['font_heading_italic'][0])) { if ($canon_options_appearance['font_heading_italic'][0] != "canon_default") { wp_enqueue_style( 'canon-font-heading-italic', canon_fw_get_google_webfonts_link($canon_options_appearance['font_heading_italic']), array(), null ); } }
	    if (isset($canon_options_appearance['font_heading_strong'][0])) { if ($canon_options_appearance['font_heading_strong'][0] != "canon_default") { wp_enqueue_style( 'canon-font-heading-strong', canon_fw_get_google_webfonts_link($canon_options_appearance['font_heading_strong']), array(), null ); } }
	    if (isset($canon_options_appearance['font_heading2_italic'][0])) { if ($canon_options_appearance['font_heading2_italic'][0] != "canon_default") { wp_enqueue_style( 'canon-font-heading2-italic', canon_fw_get_google_webfonts_link($canon_options_appearance['font_heading2_italic']), array(), null ); } }
	    if (isset($canon_options_appearance['font_heading2_strong'][0])) { if ($canon_options_appearance['font_heading2_strong'][0] != "canon_default") { wp_enqueue_style( 'canon-font-heading2-strong', canon_fw_get_google_webfonts_link($canon_options_appearance['font_heading2_strong']), array(), null ); } }
	    if (isset($canon_options_appearance['font_nav'][0])) { if ($canon_options_appearance['font_nav'][0] != "canon_default") { wp_enqueue_style( 'canon-font-nav', canon_fw_get_google_webfonts_link($canon_options_appearance['font_nav']), array(), null ); } }
	    if (isset($canon_options_appearance['font_meta'][0])) { if ($canon_options_appearance['font_meta'][0] != "canon_default") { wp_enqueue_style( 'canon-font-meta', canon_fw_get_google_webfonts_link($canon_options_appearance['font_meta']), array(), null ); } }
	    if (isset($canon_options_appearance['font_tags'][0])) { if ($canon_options_appearance['font_tags'][0] != "canon_default") { wp_enqueue_style( 'canon-font-tags', canon_fw_get_google_webfonts_link($canon_options_appearance['font_tags']), array(), null ); } }
	    if (isset($canon_options_appearance['font_button'][0])) { if ($canon_options_appearance['font_button'][0] != "canon_default") { wp_enqueue_style( 'canon-font-button', canon_fw_get_google_webfonts_link($canon_options_appearance['font_button']), array(), null ); } }
	    if (isset($canon_options_appearance['font_dropcap'][0])) { if ($canon_options_appearance['font_dropcap'][0] != "canon_default") { wp_enqueue_style( 'canon-font-dropcap', canon_fw_get_google_webfonts_link($canon_options_appearance['font_dropcap']), array(), null ); } }
	    if (isset($canon_options_appearance['font_quote'][0])) { if ($canon_options_appearance['font_quote'][0] != "canon_default") { wp_enqueue_style( 'canon-font-quote', canon_fw_get_google_webfonts_link($canon_options_appearance['font_quote']), array(), null ); } }
	    if (isset($canon_options_appearance['font_logotext'][0])) { if ($canon_options_appearance['font_logotext'][0] != "canon_default") { wp_enqueue_style( 'canon-font-logotext', canon_fw_get_google_webfonts_link($canon_options_appearance['font_logotext']), array(), null ); } }
	    if (isset($canon_options_appearance['font_lead'][0])) { if ($canon_options_appearance['font_lead'][0] != "canon_default") { wp_enqueue_style( 'canon-font-lead', canon_fw_get_google_webfonts_link($canon_options_appearance['font_lead']), array(), null ); } }
	    if (isset($canon_options_appearance['font_bold'][0])) { if ($canon_options_appearance['font_bold'][0] != "canon_default") { wp_enqueue_style( 'canon-font-bold', canon_fw_get_google_webfonts_link($canon_options_appearance['font_bold']), array(), null ); } }
	    if (isset($canon_options_appearance['font_italic'][0])) { if ($canon_options_appearance['font_italic'][0] != "canon_default") { wp_enqueue_style( 'canon-font-italic', canon_fw_get_google_webfonts_link($canon_options_appearance['font_italic']), array(), null ); } }

		// dynamic_css printout
		add_action('wp_head','canon_dynamic_css');

		//localize sripts
		wp_localize_script('canon-scripts','extData', array(
			'ajaxUrl' 					=> admin_url('admin-ajax.php'), 
			'pageType'					=> canon_fw_get_page_type(), 
			'templateURI' 				=> get_template_directory_uri(), 
			'canonOptions' 				=> $canon_options,
			'canonOptionsFrame' 		=> $canon_options_frame,
			'canonOptionsPost' 			=> $canon_options_post,
			'canonOptionsAppearance' 	=> $canon_options_appearance,
			'canonOptionsAdvanced' 		=> $canon_options_advanced,
		)); 
	}}

	//back end includes
	if (!function_exists("canon_belle_load_to_back")) { function canon_belle_load_to_back() {	
		
		//get options
		$canon_options = get_option('canon_options');
		$canon_options_post = get_option('canon_options_post');
		$canon_options_advanced = get_option('canon_options_advanced');

		//wp scripts (js)
		wp_enqueue_script('jquery-ui', false, array(), false, false);
		wp_enqueue_script('jquery-ui-sortable', false, array(), false, true);
		wp_enqueue_script('thickbox', false, array(), false, true);					
		wp_enqueue_script('media-upload', false, array(), false, true);

		//external scripts
		wp_enqueue_script('canon-colorpicker', get_template_directory_uri() . '/js/colorpicker.js', array(), false, true);
		wp_enqueue_script('canon-admin-scripts', get_template_directory_uri() . '/js/admin-scripts.js', array('jquery'), false, true);

		//style (css)	
		wp_enqueue_style('thickbox');
		wp_enqueue_style('canon-admin-style', get_template_directory_uri(). '/css/admin-style.css');
		wp_enqueue_style('canon-font-awesome-admin-style', get_template_directory_uri(). '/css/font-awesome.css');
		wp_enqueue_style('canon-colorpicker-style', get_template_directory_uri(). '/css/colorpicker.css');

		// dynamic_css_admin printout
		add_action('wp_print_scripts','canon_dynamic_css_admin');

		//localize sripts
		wp_localize_script('canon-admin-scripts','extData', array(
			'templateURI'				=> get_template_directory_uri(), 
			'ajaxURL'					=> admin_url('admin-ajax.php'),
			'canonOptions'				=> $canon_options,
			'canonOptionsPost'			=> $canon_options_post,
			'canonOptionsAdvanced' 		=> $canon_options_advanced,
		));        

		if ( strpos(get_current_screen()->id, 'canon_options_appearance') !== false ) wp_localize_script('canon-admin-scripts','extDataFonts', array('fonts' => canon_fw_get_google_webfonts()));        
	}}



/**************************************
SETUP THEME
***************************************/
	
	add_action( 'after_setup_theme', 'canon_belle_setup_theme' );

	if (!function_exists("canon_belle_setup_theme")) { function canon_belle_setup_theme() {	


	/**************************************
	GET OPTIONS
	***************************************/

		$canon_options = get_option('canon_options'); 


	/**************************************
	ADD ACTIONS
	***************************************/

		// front end includes
		add_action('wp_enqueue_scripts','canon_belle_load_to_front');

		// back end includes
		add_action('admin_enqueue_scripts', 'canon_belle_load_to_back');  

		// register widget areas
		add_action('widgets_init', 'canon_belle_register_widget_areas');  

		// add post views counter to all posts
		add_action('wp_head', 'canon_fw_update_post_views_single_check' );

		// media upload customize
		add_action( 'admin_init', 'canon_belle_check_upload_page' );

		// hide theme settings from non-admins
		add_action( 'admin_menu', 'canon_belle_hide_theme_settings_from_non_admins' );

		// maintenance mode reminder
		if ($canon_options['use_maintenance_mode'] == "checked") { add_action('admin_notices','canon_belle_maintenance_mode_reminder'); }


	/**************************************
	ADD FILTERS
	***************************************/

		// disable woocommerce default styles
		if (class_exists('Woocommerce')) { add_filter( 'woocommerce_enqueue_styles', '__return_false' ); }

		// filter body class
		add_filter('body_class', 'canon_belle_filter_body_class');

		// filter wordpress menus
		add_filter( 'wp_nav_menu_items', 'canon_belle_filter_wp_menus', 10, 2);

		// filter search query
		add_filter('pre_get_posts','canon_belle_filter_search_query');

		// filter user_contactmethods
		add_filter('user_contactmethods', 'canon_belle_modify_user_contactmethods');

	/**************************************
	ADD_THEME_SUPPORT CALLS
	***************************************/

		// add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses Featured Images
		add_theme_support( 'post-thumbnails' );

		// post formats
		add_theme_support('post-formats', array('quote','gallery','video','audio'));

		// woocommerce
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-slider');

		// title tag
		add_theme_support( 'title-tag' );

	/**************************************
	IMAGE SIZES
	***************************************/

		foreach ($canon_options['image_sizes'] as $key => $value) {
			add_image_size($key, $value['width'], $value['height'], true);
		}

		//set general content width
		if (!isset($content_width)) $content_width = 1160;

	/**************************************
	REGISTER MENUS
	***************************************/

		//register primary menu
		register_nav_menus(array(
				'primary_menu' => 'Primary Menu'
		)); 

		//register secondary menu
		register_nav_menus(array(
				'secondary_menu' => 'Secondary Menu'
		)); 

	/**************************************
	LOCALIZATION INIT
	***************************************/

		$lang_dir = get_template_directory() . '/languages';    
		load_theme_textdomain('loc-canon-belle', $lang_dir);




	}}	// end canon_belle_setup_theme



/**************************************
REGISTER WIDGET AREAS
***************************************/

	if (!function_exists("canon_belle_register_widget_areas")) { function canon_belle_register_widget_areas() {	

	/**************************************
	REGISTER THEME WIDGET AREAS
	***************************************/

		// SIDEBARS
		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_archive_sidebar_widget_area",
				'name' => esc_html__('Post/Archive Sidebar Widget Area', 'loc-canon-belle'),  
				'description'   => esc_html__('Sidebar for posts and archive pages', 'loc-canon-belle'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_page_sidebar_widget_area",
				'name' => esc_html__('Page Sidebar Widget Area', 'loc-canon-belle'),  
				'description'   => esc_html__('Sidebar for pages', 'loc-canon-belle'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		// FEATURE WIDGET AREAS
		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_feature_widget_area_1",
				'name' => esc_html__('Feature: Widget Area 1', 'loc-canon-belle'),  
				'description'   => esc_html__('Feature block widget area 1', 'loc-canon-belle'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_feature_widget_area_2",
				'name' => esc_html__('Feature: Widget Area 2', 'loc-canon-belle'),  
				'description'   => esc_html__('Feature block widget area 2', 'loc-canon-belle'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_feature_widget_area_3",
				'name' => esc_html__('Feature: Widget Area 3', 'loc-canon-belle'),  
				'description'   => esc_html__('Feature block widget area 3', 'loc-canon-belle'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_feature_widget_area_4",
				'name' => esc_html__('Feature: Widget Area 4', 'loc-canon-belle'),  
				'description'   => esc_html__('Feature block widget area 4', 'loc-canon-belle'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }

		if (function_exists('register_sidebar')) {
			register_sidebar(array(  
				'id' => "canon_feature_widget_area_5",
				'name' => esc_html__('Feature: Widget Area 5', 'loc-canon-belle'),  
				'description'   => esc_html__('Feature block widget area 5', 'loc-canon-belle'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',  
				'after_widget' => '</div>',  
				'before_title' => '<h3 class="widget-title">',  
				'after_title' => '</h3>'
			)); 
		 }


	/**************************************
	REGISTER CUSTOM WIDGET AREAS
	***************************************/

		$canon_options_advanced = get_option('canon_options_advanced'); 

		if (isset($canon_options_advanced['custom_widget_areas'])) {
			for ($i = 0; $i < count($canon_options_advanced['custom_widget_areas']); $i++) {  

				if (isset($canon_options_advanced['custom_widget_areas'][$i]['name'])) {
					
					$cwa_name = $canon_options_advanced['custom_widget_areas'][$i]['name'];
					$cwa_slug = canon_fw_create_slug($cwa_name);

					if (function_exists('register_sidebar') && !empty($cwa_name)) {
						register_sidebar(array(  
							'id' => 'canon_cwa_' . $cwa_slug,
							'name' => $cwa_name,  
							'before_widget' => '<div id="%1$s" class="widget %2$s">',  
							'after_widget' => '</div>',  
							'before_title' => '<h3 class="widget-title">',  
							'after_title' => '</h3>'
						)); 
					 }
						
				}

			}	
		}


	}}	// end function canon_belle_register_widget_areas




/**************************************
MEDIA UPLOAD CUSTOMIZE
***************************************/

	if (!function_exists("canon_belle_check_upload_page")) { function canon_belle_check_upload_page() {	
		global $pagenow;
		if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
			// Now we'll replace the 'Insert into Post Button' inside Thickbox
			add_filter( 'gettext', 'canon_belle_replace_thickbox_text', 1, 3 );
		}
	}}

	if (!function_exists("canon_belle_replace_thickbox_text")) { function canon_belle_replace_thickbox_text($translated_text, $text, $domain) {	
		if ('Insert into Post' == $text) {
			$referer_strpos = strpos( wp_get_referer(), 'referer=boost_' );
			if ( $referer_strpos != '' ) {

				//now get the referer
				$referer_str = wp_get_referer();
				$explode_arr = explode('referer=', $referer_str);
				$explode_arr = explode('&type=', $explode_arr[1]);
				$referer = $explode_arr[0];

				//define button text for each referer
				if ($referer == "boost_logo") return "Use as logo";
				if ($referer == "boost_favicon") return "Use as favicon";
				if ($referer == "boost_bg") return "Use as background";
				if ($referer == "boost_media") return "Use this media file";
				if ($referer == "boost_default") return "Use this image";

				//default
				return $referer;
			}
		}
		return $translated_text;
	}}


/**************************************
REMOVE THEME SETTINGS FOR NON-ADMINS
***************************************/


	if (!function_exists("canon_belle_hide_theme_settings_from_non_admins")) { function canon_belle_hide_theme_settings_from_non_admins() {	

		if (!current_user_can('switch_themes')) {
			remove_menu_page('handle_canon_options');
		}
	  
	}}


/**************************************
FILTER BODY CLASS
***************************************/

	if (!function_exists("canon_belle_filter_body_class")) { function canon_belle_filter_body_class($classes) {

		// GET OPTIONS
		$canon_options = get_option('canon_options');
		$canon_options_frame = get_option('canon_options_frame');
		$canon_options_appearance = get_option('canon_options_appearance');

		// DEV_MODE
		if ($canon_options['dev_mode'] == "checked") {
			if (isset($_GET['use_boxed_design'])) { $canon_options['use_boxed_design'] = wp_filter_nohtml_kses($_GET['use_boxed_design']); }
		}

		// DEFAULTS
		if (!isset($canon_options['use_boxed_design'])) { $canon_options['use_boxed_design'] = "unchecked"; }
		if (!isset($canon_options_frame['use_sticky_header'])) { $canon_options_frame['use_sticky_header'] = "unchecked"; }
		if (!isset($canon_options_appearance['body_skin_class'])) { $canon_options_appearance['body_skin_class'] = ""; }

		// add boxed-page if boxed design and sticky header
		if ( ($canon_options['use_boxed_design'] == "checked") ) { $classes[] = "boxed-page "; }

		// add body skin class
		if (!empty($canon_options_appearance['body_skin_class'])) { $classes[] = $canon_options_appearance['body_skin_class']; }

		return $classes;

	}}


/**************************************
FILTER WORDPRESS MENUS
***************************************/


	if (!function_exists("canon_belle_filter_wp_menus")) { function canon_belle_filter_wp_menus( $items, $args ) {	

		// GET OPTIONS
		$canon_options_frame = get_option('canon_options_frame');

	    if ($canon_options_frame['add_search_btn_to_primary'] == "checked") {
	    	if ($args->theme_location == "primary_menu") {
			    $items .= '<li class="menu-item menu-item-type-canon toolbar-search-btn"><a href="#"><i class="fa fa-search"></i></a></li>';
	    	}	
	    }

	    if ($canon_options_frame['add_search_btn_to_secondary'] == "checked") {
	    	if ($args->theme_location == "secondary_menu") {
			    $items .= '<li class="menu-item menu-item-type-canon toolbar-search-btn"><a href="#"><i class="fa fa-search"></i></a></li>';
	    	}	
	    }

	    return $items;

	}}


/**************************************
FILTER SEARCH QUERY
***************************************/

	if (!function_exists("canon_belle_filter_search_query")) { function canon_belle_filter_search_query($query) {	

        if ($query->is_search && !is_admin()) {

        	// BBPRESS BOUNCER
        	if (class_exists('bbPress')) { if (is_bbpress()) return; }

			// GET OPTIONS
			$canon_options_post = get_option('canon_options_post');

			// DEFAULTS
			if (!isset($canon_options_post['search_posts'])) { $canon_options_post['search_posts'] = "checked"; }
			if (!isset($canon_options_post['search_pages'])) { $canon_options_post['search_pages'] = "unchecked"; }
			if (!isset($canon_options_post['search_cpt'])) { $canon_options_post['search_cpt'] = "unchecked"; }

			// BOUNCE IF SPECIFIC SEARCH IS NOT WANTED
			if ($canon_options_post['search_posts'] == "unchecked" && $canon_options_post['search_pages'] == "unchecked" && $canon_options_post['search_cpt'] == "unchecked") return;

        	$post_type_array = array();

        	if ($canon_options_post['search_posts'] == "checked") { array_push($post_type_array, 'post'); }
        	if ($canon_options_post['search_pages'] == "checked") { array_push($post_type_array, 'page'); }
        	
        	if ($canon_options_post['search_cpt'] == "checked") { 
        		$search_cpt_source_array = explode(',', $canon_options_post['search_cpt_source']);
        		foreach ($search_cpt_source_array as $key => $slug) {
        			$slug = trim($slug);
        			if (!empty($slug)) {
        				array_push($post_type_array, $slug); 
        			}
        		}
        	}

			$query->set('post_type', $post_type_array);

        }

        return $query;
        
    }}


/**************************************
FILTER USER CONTACTMETHODS
***************************************/

	if (!function_exists("canon_belle_modify_user_contactmethods")) { function canon_belle_modify_user_contactmethods($user_contact) {	
		
		// Add user contact methods
		$user_contact['twitter'] 		= esc_html__('Twitter URL', 'loc-canon-belle');
		$user_contact['facebook'] 		= esc_html__('Facebook URL', 'loc-canon-belle');
		$user_contact['googleplus'] 	= esc_html__('Google+ URL', 'loc-canon-belle');
		$user_contact['linkedin'] 		= esc_html__('LinkedIn URL', 'loc-canon-belle');
		$user_contact['instagram']   	= esc_html__('Instagram URL', 'loc-canon-belle');

		// Remove user contact methods
		// unset( $user_contact['aim']    );

		return $user_contact;

	}}


/**************************************
SET THEME COOKIE
***************************************/

    add_action('init','set_belle_cookie'); 

	if (!function_exists("set_belle_cookie")) { function set_belle_cookie() {	
    	if (!isset($_COOKIE['belle_cookie'])) {
            setcookie('belle_cookie', "post-likes=&user-ratings=&voted-polls=", time()+(60*60*24*365), COOKIEPATH, COOKIE_DOMAIN, false);    
        }
	}} 


/**************************************
CANON HOVER BOXES
***************************************/

	// CANON HOVERBOX DEFAULT
	if (!function_exists("canon_belle_hoverbox_default")) { function canon_belle_hoverbox_default($post_id, $post_title) {	

		printf('<a href="%s">', esc_url(get_permalink($post_id)));
		echo '<div class="tc-hover-content-container">';
		echo '<div class="tc-hover-content">';

		printf('<h3>%s</h3><div class="dateMeta">%s</div>', wp_kses_post($post_title), esc_attr(canon_fw_localize_datetime(get_the_time(get_option('date_format'), $post_id))) );

		echo '</div>';
		echo '</div>';
		echo '</a>';

	}} 


/**************************************
MAINTENANCE MODE REMINDER
***************************************/

	if (!function_exists("canon_belle_maintenance_mode_reminder")) { function canon_belle_maintenance_mode_reminder() {	
		printf('<div class="error"><p>%s</p></div>', wp_kses_post(__('Maintenance mode is on - remember that only logged-in users will be able to see your site pages. Go to <i>Settings > General > Maintenance Mode</i> to disable.','loc-canon-belle')));
	}}



/**************************************
LEGACY TITLE TAG 
***************************************/


	if (!function_exists('_wp_render_title_tag')) {

		// render legacy title
		add_action( 'wp_head', 'canon_belle_render_legacy_title' );

		// filter wp_title
		add_filter( 'wp_title', 'canon_belle_filter_wp_title', 10, 2 );


		/**************************************
		RENDER LEGACY TITLE
		***************************************/

			if (!function_exists("canon_belle_render_legacy_title")) { function canon_belle_render_legacy_title() {	
			
				?><title><?php wp_title( '|', true, 'right' ); ?></title><?php

			}}
		

		/**************************************
		FILTER WORDPRESS TITLE
		***************************************/


			if (!function_exists("canon_belle_filter_wp_title")) { function canon_belle_filter_wp_title( $title, $sep ) {	
				if ( is_feed() ) {
					return $title;
				}
				
				global $page, $paged;

				// Add the blog name
				$title .= get_bloginfo( 'name', 'display' );

				// Add the blog description for the home/front page.
				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description && ( is_home() || is_front_page() ) ) {
					$title .= " $sep $site_description";
				}

				// Add a page number if necessary:
				if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
					$title .= " $sep " . sprintf('%s %s', esc_html__("Page", "loc-canon-belle"), esc_attr(max( $paged, $page )) );
				}

				return $title;

			}}

	}



/**************************************
EXCLUDE THEME FROM REPOSITORY UPDATE CHECK

NB: This snippet is present both in theme and in core plugin as redundancy failsafe. Remember to update both on edit.
***************************************/

	add_filter( 'http_request_args', 'canon_belle_exclude_theme_from_repository_update_check', 5, 2 );

	if (!function_exists("canon_belle_exclude_theme_from_repository_update_check")) { function canon_belle_exclude_theme_from_repository_update_check($r, $url) {	

	    // bounce if not a theme update request
	    if (strpos($url, '//api.wordpress.org/themes/update-check' ) === false ) { return $r; } 

	    $themes = json_decode($r['body']['themes'], true);
	    unset($themes['themes']['belle']);
	    $r['body']['themes'] = json_encode( $themes );

	    return $r;
	}}
	 



