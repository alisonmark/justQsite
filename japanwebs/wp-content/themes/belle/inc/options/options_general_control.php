<?php

/****************************************************
DESCRIPTION: 	GENERAL OPTIONS
OPTION HANDLE: 	canon_options
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options');

	function register_canon_options () {
		global $screen_handle_canon_options;	  								//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)
		$theme_name = wp_get_theme()->Name;										//get theme name

		$screen_handle_canon_options = add_menu_page(
			sprintf("%s %s", esc_attr($theme_name), esc_html__("Settings", "loc-canon-belle")), 	//page title (appears in the browser title area / on the tab)
			sprintf("%s %s", esc_attr($theme_name), esc_html__("Settings", "loc-canon-belle")), 	//on screen name of options page (appears in left-hand menu)
			'manage_options', 													//capability (user-level) minimum level for access to this page.
			'handle_canon_options',												//handle of this options page
			'display_canon_options_general', 									//the function / callback that runs the whole admin page
			'',																	//optional icon url 16x16px
			200																	//optional position in the menu. The higher the number the lower down on the menu list it appears.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options');	

	function init_canon_options () {
		register_setting(
			'group_canon_options',												//group name. The group for the fields custom_options_group
			'canon_options',													//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options'											//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options');	

	function default_canon_options () {

	 	// SET DEFAULTS
	 	$default_options = array (

	 		'dev_mode'								=> 'unchecked',
	 		'dev_mockup_structure'					=> 'mockup_template, mockup_template, mockup_template',
	 		'dev_controller_classes'				=> '',

 			'use_responsive_design'					=> 'checked',
	 		'use_boxed_design'						=> 'unchecked',
	 		'use_maintenance_mode'					=> 'unchecked',
	 		'maintenance_msg'						=> 'We are busy doing maintenance - please check back later!',
	 		'read_more_text'						=> 'Continue Reading',
			'sidebars_alignment'					=> 'right',
			'back_to_top_button'					=> 'prefooter',
 			'overlay_header'						=> 'unchecked',
 			'overlay_content_negative_margin'		=> -300,
 			'overlay_header_turn_off_width'			=> '0',
 			'overlay_content_turn_off_width'		=> '0',

 			'image_sizes'							=> array(
 				'canon_post_component_carousel'			=> array('width' => 700, 'height' => 420, 'ratio' => '1.67'),
 				'canon_block_post_grid_6wide'			=> array('width' => 1005, 'height' => 519, 'ratio' => '1.94'),
 				'canon_block_post_grid_3wide'			=> array('width' => 1267, 'height' => 654, 'ratio' => '1.94'),
 				'canon_block_post_grid_6tall'			=> array('width' => 1267, 'height' => 654, 'ratio' => '1.94'),
 				'canon_block_carousel'					=> array('width' => 970, 'height' => 546, 'ratio' => '1.78'),
 				'canon_even_grid'						=> array('width' => 970, 'height' => 546, 'ratio' => '1.78'),
 				'canon_grid_gallery_landscape'			=> array('width' => 600, 'height' => 361, 'ratio' => '1.66'),
 				'canon_grid_gallery_portrait'			=> array('width' => 500, 'height' => 602, 'ratio' => '0.83'),
 			),

	 		'autocomplete_words'					=> 'c++, jquery, I like jQuery, java, php, coldfusion, javascript, asp, ruby',
			
			'hide_theme_meta_description'			=> 'unchecked',
			'hide_theme_og'							=> 'unchecked',
			'fontface_fix'							=> 'unchecked',

		);

		// GET EXISTING OPTIONS IF ANY
		$canon_options = (get_option('canon_options')) ? get_option('canon_options') : array();

		// IF OPTIONS DO NOT EXIST (FIRST INSTALL OR AFTER RESET)
		if (empty($canon_options)) {
				
			// WORDPRESS OPTIONS DEFAULTS
			update_option('image_default_link_type','file');	//none, file, post

		}

		// MERGE ARRAYS. EXISTING OPTIONS WILL OVERWRITE DEFAULTS.
		$canon_options = array_merge($default_options, $canon_options);

		// SAVE OPTIONS
		update_option('canon_options', $canon_options);

	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_canon_options_general () {
		require_once get_template_directory() . "/inc/options/options_general.php";
	}