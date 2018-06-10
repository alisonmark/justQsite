	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_html__("Settings", "loc-canon-belle"), esc_html__("Appearance", "loc-canon-belle") ); ?></h2>

		<?php 
			//delete_option('canon_options_appearance');
			$canon_options_appearance = get_option('canon_options_appearance'); 

			// var_dump($canon_options_appearance);

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_appearance'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_appearance'); ?>		


					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						SKINS
						COLOR SETTINGS
						BACKGROUND
						GOOGLE WEBFONTS
						RELATIVE FONT SIZE
						LIGHTBOX SETTINGS
						ANIMATION: IMG SLIDERS
						ANIMATION: QUOTE SLIDERS
						ANIMATION: REVIEW SLIDERS
						ANIMATION: LAZY LOAD EFFECT
						ANIMATION: MENUS

					-->

					<!-- 
					--------------------------------------------------------------------------
						SKINS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Skins", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Skins', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Click a skin-button to change the colour-scheme of the whole theme.', 'loc-canon-belle'),
									),
								)); 

							?>			

						</div>

						<table class='form-table' id="skins">

							<?php
								
								canon_fw_option(array(
									'type'					=> 'hidden',
									'slug' 					=> 'body_skin_class',
									'options_name'			=> 'canon_options_appearance',
								)); 
							
							?>

							<tr valign='top'>
								<td>
									<img src="<?php echo get_template_directory_uri() ?>/img/skin_btn_1.png" alt="" 

										data-body_skin_class					="tc-belle-1"
										
										data-color_body							="#f8f8f8"
										data-color_plate						="#ffffff"
										data-color_main_text					="#000000"
										data-color_main_headings				="#000000"
										data-color_links						="#000000"
										data-color_links_hover					="#7db2b4"
										data-color_like							="#f15292"
										data-color_white_text					="#ffffff"
										
										data-color_btn							="#7db2b4"
										data-color_btn_hover					="#358d90"
										data-color_btn_text						="#ffffff"
										data-color_btn_text_hover				="#ffffff"
										data-color_feat_color					="#7db2b4"
										
										data-color_feat_overlay_color			="#1d2121"
										data-color_feat_overtext_color			="#ffffff"
										
										data-color_meta							="#b8babd"
										data-color_drops						="#000000"
										data-color_pre_header					="#ffffff"
										data-color_pre_header_text				="#000000"
										data-color_pre_header_text_hover		="#7db2b4"
										data-color_pre_header_menus				="#f8f8f8"
										data-color_pre_header_line				="#e7e7e7"
										data-color_header						="#ffffff"
										data-color_header_stuck					="#ffffff"
										data-color_header_text					="#000000"
										data-color_header_text_hover			="#7db2b4"
										data-color_header_menus_2nd				="#ffffff"
										data-color_header_menus					="#f8f8f8"
										data-color_header_line					="#e7e7e7"
										data-color_post_header					="#ffffff"
										data-color_post_header_text				="#000000"
										data-color_post_header_text_hover		="#7db2b4"
										data-color_post_header_menus			="#f8f8f8"
										data-color_post_header_line				="#e7e7e7"
										data-color_search_bg					="#1d2121"
										data-color_search_text					="#ffffff"
										data-color_search_text_hover			="#7db2b4"
										data-color_search_line					="#3c4242"
										data-color_sidr							="#191c20"
										data-color_sidr_text					="#ffffff"
										data-color_sidr_text_hover				="#7db2b4"
										data-color_sidr_line					="#23272c"
										data-color_borders						="#e7e7e7"
										
										data-color_second_plate					="#f8f8f8"
										data-color_fields						="#f8f8f8"
										
										data-color_feat_area					="#f8f8f8"
										data-color_feat_area_text				="#000000"
										data-color_feat_area_text_hover			="#7db2b4"
										data-color_feat_car_text				="#ffffff"
										data-color_feat_car_text_hover			="#7db2b4"
										data-color_feat_area_borders			="#e7e7e7"
										
										data-color_footfeat_area				="#323638"
										data-color_footfeat_area_text			="#ffffff"
										data-color_footfeat_area_text_hover		="#7db2b4"
										data-color_footfeat_area_borders		="#54585a"
										
										data-color_pre_footer					="#ffffff"
										data-color_pre_footer_text				="#000000"
										data-color_pre_footer_text_hover		="#7db2b4"
										data-color_pre_footer_line				="#e7e7e7"
										data-color_baseline						="#25292b"
										data-color_baseline_text				="#b8babd"
										data-color_baseline_text_hover			="#7db2b4"
										data-color_logo							="#000000"

									/>
									
									
									
								
									
									
								</td>
							</tr>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						COLOR SETTINGS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Color settings", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Colors', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Change the colours of the theme. Remember to save your changes.', 'loc-canon-belle'),
									),
								)); 

							?>			

						</div>

						<table class='form-table'>

							<?php
								
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Body Background', 'loc-canon-belle'),
									'slug' 					=> 'color_body',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Main Plate Background', 'loc-canon-belle'),
									'slug' 					=> 'color_plate',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('General Text', 'loc-canon-belle'),
									'slug' 					=> 'color_main_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Main Headings', 'loc-canon-belle'),
									'slug' 					=> 'color_main_headings',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Links Text', 'loc-canon-belle'),
									'slug' 					=> 'color_links',
									'options_name'			=> 'canon_options_appearance',
								));  
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Links Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_links_hover',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Like Heart', 'loc-canon-belle'),
									'slug' 					=> 'color_like',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('White Text', 'loc-canon-belle'),
									'slug' 					=> 'color_white_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Buttons', 'loc-canon-belle'),
									'slug' 					=> 'color_btn',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Buttons Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_btn_hover',
									'options_name'			=> 'canon_options_appearance',
								));    
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Buttons Text', 'loc-canon-belle'),
									'slug' 					=> 'color_btn_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Buttons Hover Text', 'loc-canon-belle'),
									'slug' 					=> 'color_btn_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Color', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_color',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Overlay Color', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_overlay_color',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Overlay Text Color', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_overtext_color',
									'options_name'			=> 'canon_options_appearance',
								));
								  
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Meta Text', 'loc-canon-belle'),
									'slug' 					=> 'color_meta',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Drop Caps Text', 'loc-canon-belle'),
									'slug' 					=> 'color_drops',
									'options_name'			=> 'canon_options_appearance',
								));  
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Header Background', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_header',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Header Text', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_header_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Header Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_header_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Header Tertiary Menus', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_header_menus',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Header Borders', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_header_line',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Header Background', 'loc-canon-belle'),
									'slug' 					=> 'color_header',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Header Background Sticky', 'loc-canon-belle'),
									'slug' 					=> 'color_header_stuck',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Header Text', 'loc-canon-belle'),
									'slug' 					=> 'color_header_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Header Text hover', 'loc-canon-belle'),
									'slug' 					=> 'color_header_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Header Tertiary Menu', 'loc-canon-belle'),
									'slug' 					=> 'color_header_menus',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Header Secondary Menu', 'loc-canon-belle'),
									'slug' 					=> 'color_header_menus_2nd',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Header Borders', 'loc-canon-belle'),
									'slug' 					=> 'color_header_line',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Post Header Background', 'loc-canon-belle'),
									'slug' 					=> 'color_post_header',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Post Header Text', 'loc-canon-belle'),
									'slug' 					=> 'color_post_header_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Post Header Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_post_header_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Post Header Tertiary Menu', 'loc-canon-belle'),
									'slug' 					=> 'color_post_header_menus',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Post Header Borders', 'loc-canon-belle'),
									'slug' 					=> 'color_post_header_line',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Search Container Background', 'loc-canon-belle'),
									'slug' 					=> 'color_search_bg',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Search Container Text', 'loc-canon-belle'),
									'slug' 					=> 'color_search_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Search Container Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_search_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Search Container Borders', 'loc-canon-belle'),
									'slug' 					=> 'color_search_line',
									'options_name'			=> 'canon_options_appearance',
								));
															
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Responsive Menu Background', 'loc-canon-belle'),
									'slug' 					=> 'color_sidr',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Responsive Menu Text', 'loc-canon-belle'),
									'slug' 					=> 'color_sidr_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Responsive Menu Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_sidr_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Responsive Menu Borders', 'loc-canon-belle'),
									'slug' 					=> 'color_sidr_line',
									'options_name'			=> 'canon_options_appearance',
								));    
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Border/Rulers Color', 'loc-canon-belle'),
									'slug' 					=> 'color_borders',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Light Block Elements', 'loc-canon-belle'),
									'slug' 					=> 'color_second_plate',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Form Fields Background', 'loc-canon-belle'),
									'slug' 					=> 'color_fields',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Area Background', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_area',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Area Text', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_area_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Area Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_area_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Instagram Text', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_car_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Instagram Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_car_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Feature Area Borders', 'loc-canon-belle'),
									'slug' 					=> 'color_feat_area_borders',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Footer Feature Area Background', 'loc-canon-belle'),
									'slug' 					=> 'color_footfeat_area',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Footer Feature Area Text', 'loc-canon-belle'),
									'slug' 					=> 'color_footfeat_area_text',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Footer Feature Area Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_footfeat_area_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Footer Feature Area Borders', 'loc-canon-belle'),
									'slug' 					=> 'color_footfeat_area_borders',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Footer Background', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_footer',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Footer Text', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_footer_text',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Footer Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_footer_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Pre Footer Borders', 'loc-canon-belle'),
									'slug' 					=> 'color_pre_footer_line',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Baseline Background', 'loc-canon-belle'),
									'slug' 					=> 'color_baseline',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Baseline Text', 'loc-canon-belle'),
									'slug' 					=> 'color_baseline_text',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Baseline Text Hover', 'loc-canon-belle'),
									'slug' 					=> 'color_baseline_text_hover',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Logo Text', 'loc-canon-belle'),
									'slug' 					=> 'color_logo',
									'options_name'			=> 'canon_options_appearance',
								));
								
					
							?>			


						</table>


					<!-- 
					--------------------------------------------------------------------------
						BACKGROUND
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Background", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Background image URL', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Enter a complete URL to the image you want to use or', 'loc-canon-belle'),
										esc_html__('Click the "Upload" button, upload an image and make sure you click the "Use this image" button or', 'loc-canon-belle'),
										esc_html__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use this image" button.', 'loc-canon-belle'),
										esc_html__('Remember to save your changes.', 'loc-canon-belle'),
										esc_html__('NB: the background image will be positioned top-center.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Background link (optional)', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If you insert a link here you background will automatically be made clickable. Clicking the background will open up your link in a new window. Great for take-over style ad-campaigns.', 'loc-canon-belle'),
										esc_html__('NB: Only works with boxed design.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Size', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set background size.', 'loc-canon-belle'),
										wp_kses_post(__('<b>Auto</b>: Default. Image retains original size.', 'loc-canon-belle')),
										wp_kses_post(__('<b>Pattern optimized</b>: Recommended when using patterns for background. On high resolution monitors patterns will be set to half image size to avoid magnification/pixelation. On standard monitors original pattern size will be used.', 'loc-canon-belle')),
										wp_kses_post(__('<b>Cover</b>: Image will cover viewport background. Works best with large images and Attachement set to fixed - otherwise magnification/pixelation may occur.', 'loc-canon-belle')),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Repeat', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If set to repeat the background image will repeat vertically.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Attachment', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If set to fixed the background image will not scroll.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Background pattern', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Click one of buttons to use that background pattern. Notice that the url of pattern image file will be automatically inserted into the Backgroun image URL input. Also notice that Repeat and attachment selects will be updated to recommended selections for use with pattern backgrounds (repeat fixed). Remember to save your changes.', 'loc-canon-belle'),
									),
								));

							?> 

						</div>

						<table class='form-table' id="background_table">

							<?php

								canon_fw_option(array(
									'type'					=> 'upload',
									'title' 				=> esc_html__('Background image URL', 'loc-canon-belle'),
									'slug' 					=> 'bg_img_url',
									'btn_text'				=> esc_html__('Upload background image', 'loc-canon-belle'),
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Background link (optional)', 'loc-canon-belle'),
									'slug' 					=> 'bg_link',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Size', 'loc-canon-belle'),
									'slug' 					=> 'bg_size',
									'select_options'		=> array(
										'auto'				=> esc_html__('Auto', 'loc-canon-belle'),
										'pattern'			=> esc_html__('Pattern Optimized', 'loc-canon-belle'),
										'cover'				=> esc_html__('Cover', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Repeat', 'loc-canon-belle'),
									'slug' 					=> 'bg_repeat',
									'select_options'		=> array(
										'repeat'			=> esc_html__('Repeat', 'loc-canon-belle'),
										'no-repeat'			=> esc_html__('No repeat', 'loc-canon-belle')
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Attachment', 'loc-canon-belle'),
									'slug' 					=> 'bg_attachment',
									'select_options'		=> array(
										'fixed'				=> esc_html__('Fixed', 'loc-canon-belle'),
										'scroll'			=> esc_html__('Scroll', 'loc-canon-belle')
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

							 ?>		

							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Background pattern", "loc-canon-belle"); ?></th>
								<td class="bg_pattern_picker">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile_btn.png" data-img_file="tile.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile2_btn.png" data-img_file="tile2.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile3_btn.png" data-img_file="tile3.png">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile4_btn.png" data-img_file="tile4.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile5_btn.png" data-img_file="tile5.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile6_btn.png" data-img_file="tile6.png">
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile7_btn.png" data-img_file="tile7.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile8_btn.png" data-img_file="tile8.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile9_btn.png" data-img_file="tile9.png"> 
									<img src="<?php echo get_template_directory_uri(); ?>/img/patterns/tile10_btn.png" data-img_file="tile10.png">  
								</td>
							</tr>


						</table>


					<!-- 
					--------------------------------------------------------------------------
						GOOGLE WEBFONTS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Google Webfonts", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Change fonts', 'loc-canon-belle'),
									'content' 				=> array(
										wp_kses_post(__('<i>first select:</i> Font name.', 'loc-canon-belle')),
										wp_kses_post(__('<i>middle select:</i> Font variants (will change automatically if available for the chosen font).', 'loc-canon-belle')),
										wp_kses_post(__('<i>last select:</i> Font subset (will change automatically if available for the chosen font).', 'loc-canon-belle')),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> esc_html__('More info', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Notice: You can only control the general fonts to be used. However, parameters like font size, styling, letter-spacing etc. are controlled by the theme itself.', 'loc-canon-belle'),
										wp_kses_post(__('Go to <a href="http://www.google.com/webfonts" target="_blank">Google Webfonts</a> homepage to preview fonts.', 'loc-canon-belle')),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Body Font', 'loc-canon-belle'),
									'slug' 					=> 'font_main',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Headings Font', 'loc-canon-belle'),
									'slug' 					=> 'font_heading',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Headings Font Strong', 'loc-canon-belle'),
									'slug' 					=> 'font_heading_strong',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Headings Font Italics', 'loc-canon-belle'),
									'slug' 					=> 'font_heading_italic',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Second Headings Font', 'loc-canon-belle'),
									'slug' 					=> 'font_heading2',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Second Headings Font Strong', 'loc-canon-belle'),
									'slug' 					=> 'font_heading2_strong',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Second Headings Font Italics', 'loc-canon-belle'),
									'slug' 					=> 'font_heading2_italic',
									'options_name'			=> 'canon_options_appearance',
								));  
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Menu Font', 'loc-canon-belle'),
									'slug' 					=> 'font_nav',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Meta Info Font', 'loc-canon-belle'),
									'slug' 					=> 'font_meta',
									'options_name'			=> 'canon_options_appearance',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Tags Font', 'loc-canon-belle'),
									'slug' 					=> 'font_tags',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Button Font', 'loc-canon-belle'),
									'slug' 					=> 'font_button',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('DropCaps Font', 'loc-canon-belle'),
									'slug' 					=> 'font_dropcap',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Quotes Font', 'loc-canon-belle'),
									'slug' 					=> 'font_quote',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Logo Font', 'loc-canon-belle'),
									'slug' 					=> 'font_logotext',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Lead Text Font', 'loc-canon-belle'),
									'slug' 					=> 'font_lead',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Bold Text Font', 'loc-canon-belle'),
									'slug' 					=> 'font_bold',
									'options_name'			=> 'canon_options_appearance',
								));
								
								canon_fw_option(array(
									'type'					=> 'font',
									'title' 				=> esc_html__('Italics Text Font', 'loc-canon-belle'),
									'slug' 					=> 'font_italic',
									'options_name'			=> 'canon_options_appearance',
								));
								
							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						RELATIVE FONT SIZE
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php esc_html_e("Relative Font Size", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Font size', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Adjust the relative size of all fonts.', 'loc-canon-belle'),
									),
								));

							?> 

						</div>
						

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Font size', 'loc-canon-belle'),
									'slug' 					=> 'font_size_root',
									'min'					=> '0',
									'max'					=> '1000',
									'step'					=> '1',
									'width_px'				=> '60',
									'colspan'				=> '2',
									'postfix' 				=> esc_html__('%', 'loc-canon-belle'),
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						LIGHTBOX SETTINGS
				    -------------------------------------------------------------------------- 
					-->


						<h3><?php esc_html_e("Lightbox settings", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Lightbox overlay color', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select the color of the lightbox overlay.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Lightbox overlay opacity', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select the opacity of the lightbox overlay.', 'loc-canon-belle'),
										esc_html__('Choose a value between 0 and 1.', 'loc-canon-belle'),
										esc_html__('0 is completely transparent.', 'loc-canon-belle'),
										esc_html__('1 is compeltely solid.', 'loc-canon-belle'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php

								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Lightbox overlay color', 'loc-canon-belle'),
									'slug' 					=> 'lightbox_overlay_color',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Lightbox overlay opacity', 'loc-canon-belle'),
									'slug' 					=> 'lightbox_overlay_opacity',
									'min'					=> '0',
									'max'					=> '1',
									'step'					=> '0.1',
									'width_px'				=> '60',
									'colspan'				=> '2',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: IMG SLIDERS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Animation: Image Sliders", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php esc_html_e('This controls general behavior of image flexsliders used in theme.', 'loc-canon-belle'); ?>

							<br><br>

							<?php

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Slideshow', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If checked slides will change automatically.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Slide delay', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Delay between each slide (in milliseconds).', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Animation duration', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Duration of transition animation (in milliseconds).', 'loc-canon-belle'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Slideshow', 'loc-canon-belle'),
									'slug' 					=> 'anim_img_slider_slideshow',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Slide delay', 'loc-canon-belle'),
									'slug' 					=> 'anim_img_slider_delay',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Animation duration', 'loc-canon-belle'),
									'slug' 					=> 'anim_img_slider_anim_duration',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: QUOTE SLIDERS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Animation: Quote Sliders", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php esc_html_e('This controls general behavior of quote flexsliders used in theme.', 'loc-canon-belle'); ?>

							<br><br>

							<?php

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Slideshow', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If checked slides will change automatically.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Slide delay', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Delay between each slide (in milliseconds).', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Animation duration', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Duration of transition animation (in milliseconds).', 'loc-canon-belle'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Slideshow', 'loc-canon-belle'),
									'slug' 					=> 'anim_quote_slider_slideshow',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Slide delay', 'loc-canon-belle'),
									'slug' 					=> 'anim_quote_slider_delay',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Animation duration', 'loc-canon-belle'),
									'slug' 					=> 'anim_quote_slider_anim_duration',
									'min'					=> '0',
									'max'					=> '100000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ANIMATION: MENUS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Animation: Menus", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Animate menus', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select which menus to animate - or turn off menu animation altogether.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Enter from', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Element moves in from this angle.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Move distance', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('How much the element will move (in pixels). Can be 0 if you do not want the element to move at all.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Animation duration', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Duration of the menu animation.', 'loc-canon-belle'),
									),
								));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Delay between elements', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Delay in milliseconds between each menu item starts to appear.', 'loc-canon-belle'),
									),
								));

							?> 

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Animate menus', 'loc-canon-belle'),
									'slug' 					=> 'anim_menus',
									'select_options'		=> array(
										'anim_menus_off'		=> esc_html__('Off', 'loc-canon-belle'),
										'.primary_menu'			=> esc_html__('Primary menu', 'loc-canon-belle'),
										'.secondary_menu'		=> esc_html__('Secondary menu', 'loc-canon-belle'),
										'.nav'					=> esc_html__('Primary + Secondary menu', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Enter from', 'loc-canon-belle'),
									'slug' 					=> 'anim_menus_enter',
									'select_options'		=> array(
										'bottom'			=> esc_html__('Top', 'loc-canon-belle'),
										'left'				=> esc_html__('Right', 'loc-canon-belle'),
										'top'				=> esc_html__('Bottom', 'loc-canon-belle'),
										'right'				=> esc_html__('Left', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Move distance', 'loc-canon-belle'),
									'slug' 					=> 'anim_menus_move',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '1',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Animation duration', 'loc-canon-belle'),
									'slug' 					=> 'anim_menus_duration',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Delay between elements', 'loc-canon-belle'),
									'slug' 					=> 'anim_menus_delay',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (milliseconds)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_appearance',
								)); 

							?>

						</table>







					<?php submit_button(); ?>
				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>