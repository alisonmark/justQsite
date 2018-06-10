<?php

/****************************************************
DESCRIPTION: 	FRAME OPTIONS
OPTION HANDLE: 	canon_options_frame
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_frame');

	function register_canon_options_frame () {
		global $screen_handle_canon_options_frame;	  							//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)
		$theme_name = wp_get_theme()->Name;										//get theme name

		// Use this instad if submenu
		$screen_handle_canon_options_frame = add_submenu_page(
			'handle_canon_options',												//the handle of the parent options page. 
			esc_html__('Header & Footer Settings', 'loc-canon-belle'),			//the submenu title that will appear in browser title area.
			esc_html__('Header & Footer', 'loc-canon-belle'),					//the on screen name of the submenu
			'manage_options',													//privileges check
			'handle_canon_options_frame',										//the handle of this submenu
			'display_canon_options_frame'										//the callback function to display the actual submenu page content.
		);

		//changing the name of the first submenu which has duplicate name (there are global variables $menu and $submenu which can be used. var_dump them to see content)
		// Put this in the submenu controller. NB: Not in the first add_menu_page controller, but in the first submenu controller with add_submenu_page. It is not defined until then. 
		global $submenu;	
		$submenu['handle_canon_options'][0][0] = esc_html__("General", "loc-canon-belle");

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_frame');	
	
	function init_canon_options_frame () {
		register_setting(
			'group_canon_options_frame',										//group name. The group for the fields custom_options_group
			'canon_options_frame',												//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_frame'										//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_frame');	

	function default_canon_options_frame () {

	 	// SET DEFAULTS
	 	$default_options = array (

 			'header_pre_layout'								=> 'header_pre_custom_left_right',
 			'header_pre_custom_left'						=> 'primary',
 			'header_pre_custom_right'						=> 'social',
 			'header_main_layout'							=> 'header_main_custom_center',
 			'header_main_custom_center'						=> 'logo',
 			'header_post_layout'							=> 'off',

 			'homepage_feature_layout'						=> 'off',

 			'footer_pre_layout'								=> 'footer_pre_custom_left_right',
 			'footer_pre_custom_left'						=> 'aux_logo',
 			'footer_pre_custom_right'						=> 'secondary',
 			'footer_main_layout'							=> 'block_widgets',
 			'footer_post_layout'							=> 'footer_post_custom_left_right',
 			'footer_post_custom_left'						=> 'footer_text',
 			'footer_post_custom_right'						=> 'social',

 			'use_boxed_header'								=> 'unchecked',
 			'use_sticky_preheader'							=> 'checked',
 			'use_sticky_header'								=> 'unchecked',
 			'use_sticky_postheader'							=> 'unchecked',
 			'preheader_opacity'								=> 1,
 			'header_opacity'								=> 1,
 			'postheader_opacity'							=> 1,
 			'use_sticky_shadow'								=> 'checked',
 			'sticky_turn_off_width'							=> '768',
 			'add_search_btn_to_primary'						=> 'unchecked',
 			'add_search_btn_to_secondary'					=> 'unchecked',

 			'header_padding_top'							=> 20,
 			'header_padding_bottom'							=> 20,
 			'pos_left_element_top'							=> 0,
 			'pos_left_element_left'							=> 0,
 			'pos_right_element_top'							=> 0,
 			'pos_right_element_right'						=> 0,

 			'prefooter_padding_top'							=> 20,
 			'prefooter_padding_bottom'						=> 20,
 			'prefooter_pos_left_element_top'				=> 0,
 			'prefooter_pos_left_element_left'				=> 0,
 			'prefooter_pos_right_element_top'				=> 10,
 			'prefooter_pos_right_element_right'				=> 0,

 			'logo_url'										=> '',
 			'logo_max_width'								=> 253,
 			'logo_text'										=> '',
 			'logo_text_append_tagline'						=> 'checked',
 			'logo_text_size'								=> 28,
 			'tagline_text_size'								=> 12,

 			'aux_logo_url'									=> '',
 			'aux_logo_max_width'							=> 97,

 			'header_img_homepage_only'						=> 'unchecked',
 			'header_img_url'								=> '',
			'header_img_bg_color'							=> '#141312',
 			'header_img_height'								=> 400,
 			'header_img_parallax_amount'					=> 50,
 			'header_img_text'								=> "<h3>Header Image With Parallax Scrolling - What's Not To Like!</h3>[button]Buy Belle Today[/button]",
 			'header_img_text_alignment'						=> 'centered',
 			'header_img_text_margin_top'					=> 150,

 			'banner_code'									=> "<a href='http://www.themeforest.com/?ref=themecanon' target='_blank'><img src='".get_template_directory_uri()."/img/banner_468x60.gif'></a>",
 			
 			'header_text'									=> 'Smart Personal Blogging',
			'footer_text'									=> '© Copyright Belle by <a href="http://www.themecanon.com" target="_blank">Theme Canon</a>',

			'toolbar_search_button'							=> 'checked',

			'countdown_datetime_string'						=> 'December 31, 2023 23:59:59',
			'countdown_gmt_offset'							=> '+10',
			'countdown_description'							=> 'Next Event: ',

			'social_in_new'									=> 'checked',
 			'social_links'									=> array(
 				'0' 											=> array('fa-facebook-square','https://www.facebook.com/themecanon'),
 				'1' 											=> array('fa-twitter-square','https://twitter.com/ThemeCanon'),
 				'2' 											=> array('fa-rss-square', get_bloginfo('rss2_url')),
 			),

 			'block_post_grid_shows'							=> 'latest_posts',
 			'block_post_grid_layout'						=> '6wide',
 			'block_post_grid_animation'						=> 'off',
 			'block_post_grid_anim_delay'					=> 400,
 			'block_post_grid_anim_speed'					=> 3000,

 			
 			'block_slider_alias'							=> 'homepage',
 			'block_slider_boxed'							=> 'unchecked',

 			'block_carousel_shows'							=> 'latest_posts',
 			'block_carousel_show_featured_image'			=> 'checked',
 			'block_carousel_show_title'						=> 'checked',
 			'block_carousel_show_excerpt'					=> 'checked',
 			'block_carousel_display_num_posts'				=> 5,
 			'block_carousel_num_posts'						=> 15,
 			'block_carousel_excerpt_length'					=> 130,
 			'block_carousel_autoplay_speed'					=> 3000,
 			'block_carousel_stop_on_hover'					=> 'checked',
 			'block_carousel_pagination'						=> 'checked',

 			'block_instagram_carousel_shows'				=> 'recent',
 			'block_instagram_carousel_user_id'				=> '',
 			'block_instagram_carousel_tag'					=> 'wordpress',
 			'block_instagram_carousel_display_num_posts'	=> 5,
 			'block_instagram_carousel_num_posts'			=> 15,
 			'block_instagram_carousel_excerpt_length'		=> 100,
 			'block_instagram_carousel_autoplay_speed'		=> 3000,
 			'block_instagram_carousel_stop_on_hover'		=> 'checked',
 			'block_instagram_carousel_pagination'			=> 'checked',

 			'block_widgets_boxed'							=> 'checked',

 			'block_search_bg_color'							=> '#141312',
 			'block_search_text_color'						=> '#ffffff',
 			'block_search_bg_attachment'					=> 'scroll',
 			'block_search_bg_size'							=> 'cover',
 			'block_search_block_height'						=> 750,
 			'block_search_content_top_margin'				=> 200,
 			'block_search_html'								=> '<h1>Search <b>Specific Categories</b></h1>
<p>Search my blog of literary masterpieces.</p>',
	 		'block_search_placeholder'						=> 'Search For Posts',
	 		'block_search_btn_text'							=> 'Search',
	 		'block_search_in'								=> 'all_categories',

		);

		// GET EXISTING OPTIONS IF ANY
		$canon_options_frame = (get_option('canon_options_frame')) ? get_option('canon_options_frame') : array();

		// MERGE ARRAYS. EXISTING OPTIONS WILL OVERWRITE DEFAULTS.
		$canon_options_frame = array_merge($default_options, $canon_options_frame);

		// SAVE OPTIONS
		update_option('canon_options_frame', $canon_options_frame);

	}

	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_frame ($new_instance) {				
		$old_instance = get_option('canon_options_frame');
		return $new_instance;
	}

	//display the menus
	function display_canon_options_frame () {
		require_once get_template_directory() . "/inc/options/options_frame.php";
	}