<?php

/****************************************************
DESCRIPTION: 	GENERAL OPTIONS
OPTION HANDLE: 	canon_options_appearance
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_appearance');

	function register_canon_options_appearance () {
		global $screen_handle_canon_options_appearance;	  						//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_canon_options_appearance = add_submenu_page(
			'handle_canon_options',												//the handle of the parent options page. 
			esc_html__('Appearance Settings', 'loc-canon-belle'),				//the submenu title that will appear in browser title area.
			esc_html__('Appearance', 'loc-canon-belle'),						//the on screen name of the submenu
			'manage_options',													//privileges check
			'handle_canon_options_appearance',									//the handle of this submenu
			'display_canon_options_appearance'									//the callback function to display the actual submenu page content.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_appearance');	
	
	function init_canon_options_appearance () {
		register_setting(
			'group_canon_options_appearance',									//group name. The group for the fields custom_options_group
			'canon_options_appearance',											//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_appearance'									//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_appearance');	

	function default_canon_options_appearance () {

	 	// SET DEFAULTS
	 	$default_options = array (

	 		'body_skin_class'					=> 'tc-belle-1',
			
			'color_body'						=> '#f8f8f8',
			'color_plate'						=> '#ffffff',
			'color_main_text'					=> '#000000',
			'color_main_headings'				=> '#000000',
			'color_links'						=> '#000000',
			'color_links_hover'					=> '#7db2b4',
			'color_like'						=> '#f15292',
			'color_white_text'					=> '#ffffff',
			
			'color_btn'							=> '#7db2b4',
			'color_btn_hover'					=> '#358d90',
			'color_btn_text'					=> '#ffffff',
			'color_btn_text_hover'				=> '#ffffff',
			'color_feat_color'					=> '#7db2b4',
			
			'color_feat_overlay_color'			=> '#1d2121',
			'color_feat_overtext_color'			=> '#ffffff',
			
			'color_meta'						=> '#b8babd',
			'color_drops'						=> '#000000',
			'color_pre_header'					=> '#ffffff',
			'color_pre_header_text'				=> '#000000',
			'color_pre_header_text_hover'		=> '#7db2b4',
			'color_pre_header_menus'			=> '#f8f8f8',
			'color_pre_header_line'				=> '#e7e7e7',
			'color_header'						=> '#ffffff',
			'color_header_stuck'				=> '#ffffff',
			'color_header_text'					=> '#000000',
			'color_header_text_hover'			=> '#7db2b4',
			'color_header_menus_2nd'			=> '#ffffff',
			'color_header_menus'				=> '#f8f8f8',
			'color_header_line'					=> '#e7e7e7',
			'color_post_header'					=> '#ffffff',
			'color_post_header_text'			=> '#000000',
			'color_post_header_text_hover'		=> '#7db2b4',
			'color_post_header_menus'			=> '#f8f8f8',
			'color_post_header_line'			=> '#e7e7e7',
			'color_search_bg'					=> '#1d2121',
			'color_search_text'					=> '#ffffff',
			'color_search_text_hover'			=> '#7db2b4',
			'color_search_line'					=> '#3c4242',
			'color_sidr'						=> '#191c20',
			'color_sidr_text'					=> '#ffffff',
			'color_sidr_text_hover'				=> '#7db2b4',
			'color_sidr_line'					=> '#23272c',
			'color_borders'						=> '#e7e7e7',
			
			'color_second_plate'				=> '#f8f8f8',
			'color_fields'						=> '#f8f8f8',
			
			'color_feat_area'					=> '#f8f8f8',
			'color_feat_area_text'				=> '#000000',
			'color_feat_area_text_hover'		=> '#7db2b4',
			'color_feat_car_text'				=> '#ffffff',
			'color_feat_car_text_hover'			=> '#7db2b4',
			'color_feat_area_borders'			=> '#e7e7e7',
			
			'color_footfeat_area'				=> '#323638',
			'color_footfeat_area_text'			=> '#ffffff',
			'color_footfeat_area_text_hover'	=> '#7db2b4',
			'color_footfeat_area_borders'		=> '#54585a',
			
			'color_pre_footer'					=> '#ffffff',
			'color_pre_footer_text'				=> '#000000',
			'color_pre_footer_text_hover'		=> '#7db2b4',
			'color_pre_footer_line'				=> '#e7e7e7',
			'color_baseline'					=> '#25292b',
			'color_baseline_text'				=> '#b8babd',
			'color_baseline_text_hover'			=> '#7db2b4',
			'color_logo'						=> '#000000',
			

			'bg_img_url'						=> '',
			'bg_link'							=> '',
			'bg_size'							=> 'auto',
			'bg_repeat'							=> 'repeat',
			'bg_attachment'						=> 'scroll',

			'lightbox_overlay_color'			=> '#000000',
			'lightbox_overlay_opacity'			=> '0.7',

		 	'font_main'        					=> array('canon_default','',''),				 	
		 	'font_heading'        				=> array('canon_default','',''),
		 	'font_heading2'        				=> array('canon_default','',''),
		 	'font_heading_italic'       		=> array('canon_default','',''),
		 	'font_heading_strong'        		=> array('canon_default','',''),
		 	'font_heading2_italic'       		=> array('canon_default','',''),
		 	'font_heading2_strong'        		=> array('canon_default','',''),
		 	'font_nav'	        				=> array('canon_default','',''),
		 	'font_meta'        					=> array('canon_default','',''),
		 	'font_tags'        					=> array('canon_default','',''),
		 	'font_button'      					=> array('canon_default','',''),
		 	'font_dropcap'        				=> array('canon_default','',''),
		 	'font_quote'        				=> array('canon_default','',''),
		 	'font_logotext'        				=> array('canon_default','',''),
		 	'font_lead'        					=> array('canon_default','',''),
		 	'font_bold'        					=> array('canon_default','',''),
		 	'font_italic'        				=> array('canon_default','',''),

		 	'font_size_root'					=> 100,

			'anim_img_slider_slideshow'			=> 'unchecked',
			'anim_img_slider_delay'				=> '5000',
			'anim_img_slider_anim_duration'		=> '800',
			'anim_quote_slider_slideshow'		=> 'checked',
			'anim_quote_slider_delay'			=> '5000',
			'anim_quote_slider_anim_duration'	=> '800',

			'anim_menus'						=> 'anim_menus_off',
			'anim_menus_enter'					=> 'left',
			'anim_menus_move'					=> 40,
			'anim_menus_duration'				=> 600,
			'anim_menus_delay'					=> 150,

		);

		// GET EXISTING OPTIONS IF ANY
		$canon_options_appearance = (get_option('canon_options_appearance')) ? get_option('canon_options_appearance') : array();

		// MERGE ARRAYS. EXISTING OPTIONS WILL OVERWRITE DEFAULTS.
		$canon_options_appearance = array_merge($default_options, $canon_options_appearance);

		// SAVE OPTIONS
		update_option('canon_options_appearance', $canon_options_appearance);

	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_appearance ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_canon_options_appearance () {
		require_once get_template_directory() . "/inc/options/options_appearance.php";
	}