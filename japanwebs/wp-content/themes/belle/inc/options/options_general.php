<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_html__("Settings", "loc-canon-belle"), esc_html__("General", "loc-canon-belle") ); ?></h2>

		<?php 
			//delete_option('canon_options');
			$canon_options = get_option('canon_options'); 
			$canon_options_frame = get_option('canon_options_frame'); 
			$canon_options_post = get_option('canon_options_post'); 
			$canon_options_appearance = get_option('canon_options_appearance');
			$canon_options_advanced = get_option('canon_options_advanced'); 

			//detect dev
			$dev = (isset($_GET['dev'])) ? $_GET['dev'] : "false";

			$dev_options = array(

				// GENERAL OPTION
				array( 'slug' => 'use_boxed_design', 'set' => 'canon_options'),
				array( 'slug' => 'sidebars_alignment', 'set' => 'canon_options'),
				array( 'slug' => 'overlay_header', 'set' => 'canon_options'),

				// FRAME OPTIONS
				array( 'slug' => 'header_pre_layout', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_main_layout', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_post_layout', 'set' => 'canon_options_frame'),

				array( 'slug' => 'header_pre_custom_center', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_pre_custom_left', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_pre_custom_right', 'set' => 'canon_options_frame'),

				array( 'slug' => 'header_main_custom_center', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_main_custom_left', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_main_custom_right', 'set' => 'canon_options_frame'),

				array( 'slug' => 'header_post_custom_center', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_post_custom_left', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_post_custom_right', 'set' => 'canon_options_frame'),

				array( 'slug' => 'homepage_feature_layout', 'set' => 'canon_options_frame'),

				array( 'slug' => 'footer_pre_layout', 'set' => 'canon_options_frame'),
				array( 'slug' => 'footer_main_layout', 'set' => 'canon_options_frame'),
				array( 'slug' => 'footer_post_layout', 'set' => 'canon_options_frame'),

				array( 'slug' => 'footer_post_custom_center', 'set' => 'canon_options_frame'),
				array( 'slug' => 'footer_post_custom_left', 'set' => 'canon_options_frame'),
				array( 'slug' => 'footer_post_custom_right', 'set' => 'canon_options_frame'),

				array( 'slug' => 'footer_pre_custom_center', 'set' => 'canon_options_frame'),
				array( 'slug' => 'footer_pre_custom_left', 'set' => 'canon_options_frame'),
				array( 'slug' => 'footer_pre_custom_right', 'set' => 'canon_options_frame'),


				array( 'slug' => 'use_boxed_header', 'set' => 'canon_options_frame'),

				array( 'slug' => 'use_sticky_preheader', 'set' => 'canon_options_frame'),
				array( 'slug' => 'use_sticky_header', 'set' => 'canon_options_frame'),
				array( 'slug' => 'use_sticky_postheader', 'set' => 'canon_options_frame'),

				array( 'slug' => 'preheader_opacity', 'set' => 'canon_options_frame'),
				array( 'slug' => 'header_opacity', 'set' => 'canon_options_frame'),
				array( 'slug' => 'postheader_opacity', 'set' => 'canon_options_frame'),

				array( 'slug' => 'block_post_grid_layout', 'set' => 'canon_options_frame'),
				array( 'slug' => 'block_slider_alias', 'set' => 'canon_options_frame'),


				// POST OPTIONS
				array( 'slug' => 'homepage_layout', 'set' => 'canon_options_post'),
				array( 'slug' => 'homepage_num_columns', 'set' => 'canon_options_post'),
				array( 'slug' => 'homepage_drop_cap', 'set' => 'canon_options_post'),
				array( 'slug' => 'homepage_excerpt_length', 'set' => 'canon_options_post'),

				// APPEARANCE
				array( 'slug' => 'anim_menus', 'set' => 'canon_options_appearance'),

				// ADVANCED

			);

			// GENERATE DEV MODE URL PARAM
			$url_param = "";
			foreach ($dev_options as $key => $value) {
				extract($value);
				$this_checkbox_slug = "dev_option-$set-$slug";
				if (isset($canon_options[$this_checkbox_slug])) { if ($canon_options[$this_checkbox_slug] == "checked") {
					$option = get_option($set);
					if (isset($option[$slug])) {
						$this_option_value = $option[$slug];
						$url_param .= "&$slug=$this_option_value";
					}
				} }
			}
			$url_param = trim($url_param, "&");
			$url_param = "?" . $url_param;

			// var_dump($canon_options);
			// var_dump(get_intermediate_image_sizes());	// displays registered image sizes

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options'); ?>		


					<?php submit_button(); ?>

					<!-- 

						INDEX

						DEVELOPER TOOLS
						GENERAL 
						IMAGE SIZES
						MAIN SEARCH AUTOCOMPLETE
						COMPATIBILITY
					
					-->


					<?php if ($dev === "true") : ?>

					<!-- 
					--------------------------------------------------------------------------
						DEVELOPER TOOLS
				    -------------------------------------------------------------------------- 
					-->

							<h3><?php esc_html_e('Developer Tools', 'loc-canon-belle'); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Developer mode', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('Turns developer mode on. Other developer options will only take effect when developer mode is turned on.', 'loc-canon-belle'),
										),
									)); 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Use these controller classes', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('Add custom controller classes. Will replace the theme generated controller classes on grid layouts. Leave empty to not use.', 'loc-canon-belle'),
										),
									)); 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Use this mockup structure', 'loc-canon-belle'),
										'content' 				=> array(
											wp_kses_post(__('Add box mockups files to the <i>/inc/templates/mockups</i> folder. Each box mockup file can contain markup of a single box. Add file names (no file extension - just the name) separated with commas. This list will be used to generate a grid. E.g. &quot;1, 2, 3, 1&quot; will generate a grid displaying markup in files 1.php, 2.php, 3.php and 1.php in that order. Leave empty not to use.', 'loc-canon-belle')),
										),
									)); 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Dev options URL param generator', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('Check the checkboxes of the options you would like to generate URL parameters for. Placing these parameters at the end of a URL will overwrite the theme options.', 'loc-canon-belle'),
											esc_html__('When you have selected you checkboxes make sure you save this selection. The URL parameters string will show the last saved selection.', 'loc-canon-belle'),
											esc_html__('Workflow is easiest with a two server setup (e.g. demo server and local server). You could then use your local server to experiment/setup for example your header and then generate and copy/paste the url param string and use on your demo server to overwrite the server header options.', 'loc-canon-belle'),
										),
									)); 

								?>

							</div>

							<table class='form-table'>

								<?php
								
									canon_fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> esc_html__('Developer mode', 'loc-canon-belle'),
										'slug' 					=> 'dev_mode',
										'options_name'			=> 'canon_options',
									)); 

									canon_fw_option(array(
										'type'					=> 'text',
										'title' 				=> esc_html__('Use these controller classes', 'loc-canon-belle'),
										'slug' 					=> 'dev_controller_classes',
										'class'					=> 'widefat',
										'options_name'			=> 'canon_options',
									));

									canon_fw_option(array(
										'type'					=> 'textarea',
										'title' 				=> esc_html__('Use this mockup structure', 'loc-canon-belle'),
										'slug' 					=> 'dev_mockup_structure',
										'rows'					=> '5',
										'options_name'			=> 'canon_options',
									)); 


								?>

								 <!-- DIVIDER -->
								 <tr><td colspan="2"><hr></td></tr>

								 <!-- URL PARAM GENERATOR -->
								 <tr><td colspan="2"><strong>Dev options URL param generator:</strong></td></tr>

								<?php

									foreach ($dev_options as $key => $value) {
									 	extract($value);

										canon_fw_option(array(
											'type'					=> 'checkbox',
											'title' 				=> $slug,
											'slug' 					=> "dev_option-$set-$slug",
											'options_name'			=> 'canon_options',
											'postfix'				=> "<i>($set)</i>",
										));

									 } 

								?>

								<tr><td colspan="2"><input type="text" class="widefat" onclick="this.select()" value="<?php echo esc_attr($url_param); ?>" readonly /></td></tr>

							</table>

						 		
					<?php else: ?>

						<input type="hidden" name="canon_options[dev_mode]" value="<?php echo esc_attr($canon_options['dev_mode']); ?>" />
						<input type="hidden" name="canon_options[dev_controller_classes]" value="<?php echo esc_attr($canon_options['dev_controller_classes']); ?>" />
						<input type="hidden" name="canon_options[dev_mockup_structure]" value="<?php echo esc_attr($canon_options['dev_mockup_structure']); ?>" />

					<?php endif; ?>
					

					<!-- 
					--------------------------------------------------------------------------
						GENERAL 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("General", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php
								
								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Use responsive design', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices.', 'loc-canon-belle'),
										esc_html__('Turning off responsive design will make the site look the same across all devices and browser sizes.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Use boxed design', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Use boxed design for site layout. Otherwise site will display in full width layout.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Maintenance mode', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Activating maintenance mode will mean that only logged in users can see the content of your site. Only exception are pages using the placeholder template which can still be seen by all.', 'loc-canon-belle'),
										esc_html__('We suggest that if you use this function you also use a placeholder page as a "static homepage" to let people know that your site is under maintenance.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Maintenance mode message', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The message that will be displayed to visitors when in maintenance mode.', 'loc-canon-belle'),
										esc_html__('Remember that you can set up a placeholder page (using the placeholder page-template) and use as a homepage as this page type will always display even when maintenance mode is active.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Favicon URL', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Enter a complete URL to the image you want to use or', 'loc-canon-belle'),
										esc_html__('Click the "Upload" button, upload an image and make sure you click the "Use this image" button or', 'loc-canon-belle'),
										esc_html__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use this image" button.', 'loc-canon-belle'),
										esc_html__('If you leave the URL text field empty the default favicon will be displayed.', 'loc-canon-belle'),
										esc_html__('Remember to save your changes.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Read-more-links text', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Text to use on general read-more-links', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Sidebars alignment', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose which side to have your sidebars on.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Back to top button', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select back to top button.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Overlay header', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Overlay header on top element. Only available on top elements that accepts header overlay (slider, full width featured images etc).', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Overlay content', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Apply negative margin to content to make it overlay top element. Set negative margin in pixels. Only available where top element accepts content overlay (slider, full width featured images etc).', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Responsive overlay', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('You can turn overlays off at certain responsive break points. Use this if overlays interfere with content on smaller viewport sizes.', 'loc-canon-belle'),
									),
								)); 

							?>			

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Use responsive design', 'loc-canon-belle'),
									'slug' 					=> 'use_responsive_design',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Use boxed design', 'loc-canon-belle'),
									'slug' 					=> 'use_boxed_design',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Maintenance mode', 'loc-canon-belle'),
									'postfix'				=> wp_kses_post(__('<i>(Warning: only logged-in users will be able to see your site pages.)</i>', 'loc-canon-belle')),
									'slug' 					=> 'use_maintenance_mode',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Maintenance mode message', 'loc-canon-belle'),
									'slug' 					=> 'maintenance_msg',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'upload',
									'title' 				=> esc_html__('Favicon URL', 'loc-canon-belle'),
									'slug' 					=> 'favicon_url',
									'btn_text'				=> 'Upload favicon',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Read-more-links text', 'loc-canon-belle'),
									'slug' 					=> 'read_more_text',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Sidebars alignment', 'loc-canon-belle'),
									'slug' 					=> 'sidebars_alignment',
									'select_options'		=> array(
										'left'					=> esc_html__('Left', 'loc-canon-belle'),
										'right'					=> esc_html__('Right', 'loc-canon-belle')
									),
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Back to top button', 'loc-canon-belle'),
									'slug' 					=> 'back_to_top_button',
									'select_options'		=> array(
										'none'					=> esc_html__('None', 'loc-canon-belle'),
										'floating'				=> esc_html__('Classic floating', 'loc-canon-belle'),
										'prefooter'				=> esc_html__('Fixed on pre-footer', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Overlay header', 'loc-canon-belle'),
									'slug' 					=> 'overlay_header',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Overlay content', 'loc-canon-belle'),
									'slug' 					=> 'overlay_content_negative_margin',
									'min'					=> '-10000',						// optional
									'max'					=> '0',								// optional
									'step'					=> '1',								// optional
									'width_px'				=> '80',							// optional
									'postfix'				=> esc_html__('(pixels)', 'loc-canon-belle'),
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Responsive overlay header', 'loc-canon-belle'),
									'slug' 					=> 'overlay_header_turn_off_width',
									'select_options'		=> array(
										'0'					=> esc_html__('Overlay header stays the same', 'loc-canon-belle'),
										'768'				=> esc_html__('Turn off @ viewport width below 768px', 'loc-canon-belle'),
										'600'				=> esc_html__('Turn off @ viewport width below 600px', 'loc-canon-belle'),
										'480'				=> esc_html__('Turn off @ viewport width below 480px', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Responsive overlay content', 'loc-canon-belle'),
									'slug' 					=> 'overlay_content_turn_off_width',
									'select_options'		=> array(
										'0'					=> esc_html__('Overlay content stays the same', 'loc-canon-belle'),
										'768'				=> esc_html__('Turn off @ viewport width below 768px', 'loc-canon-belle'),
										'600'				=> esc_html__('Turn off @ viewport width below 600px', 'loc-canon-belle'),
										'480'				=> esc_html__('Turn off @ viewport width below 480px', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options',
								)); 

							 ?>		

						</table>

					<!-- 
					--------------------------------------------------------------------------
						IMAGE SIZES
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Cropped image sizes", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> esc_html__('Cropped image sizes', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Some images in this theme are cropped to a certain size and aspect ratio to make sure the image fits within the design of the theme. For example an even grid layout is dependent on featured images all being the same size or else a single image can break the even layout.', 'loc-canon-belle'),
										esc_html__('You can change the width and height of the cropped images in this section. Remember that after each change you have to regenerate all your images. Regenerating your images/thumbnails does not change the original image - it simply creates new copies of that image with the sizes you have set. To regenerate your images you can use a plugin such as the "Regenerate Thumbnails" plugin.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> esc_html__('High definition sizes', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If you require your site to be HD ready make sure your cropped images sizes are at least double the size of what is actually displayed. If for example you have a Related Posts Carousel that displays featured images at a size of 234x140 pixels and you want those images to be HD ready the images have to be cropped to at least (double) 468x280 pixels.', 'loc-canon-belle'),
										esc_html__('Larger images take longer to load so if HD is not a requirement or if you are using images that are simply not large enough to support HD it is better to crop directly to the displayed size of 234x140 pixels.', 'loc-canon-belle'),
										esc_html__('Do notice that depending on responsive state (viewport size) an image that in desktop mode is 234x140 pixels can sometimes change size and become larger. Remember to take this into account when deciding on a crop size.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> esc_html__('Aspect ratios', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The aspect ratio is the ratio of the width to the height of an image. So an image that has a width of 600 pixels and a height of 400 pixels will have an aspect ratio of (600/400) 1.5 (1.5:1) When deciding on a crop size it is best to try and maintain the original aspect ratio. Changing the aspect ratio of a cropped image could have unexpected results on design. We can only guarantee a correct design with the default sizes and aspect ratios. Changing sizes and aspect ratios could require further customizations to adapt design to different image sizes.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> esc_html__('Most common user case', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The most common reason why users change crop sizes is because the default values require images larger than what they have available. In that case they should reduce the sizes but maintain the aspect ratio. An easy way to do this is simply to halve the size values. Notice that reducing the crop sizes could result in images not being HD ready and therefore they could appear pixelated on some HD devices.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> esc_html__('Q&A: What size image should I use?', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('WordPress can only crop images to a smaller size. So your image has to be larger than the desired crop size. A quick way to estimate how large your images need to be is to look at the list of cropped image sizes and make sure your images are larger than the largest crop size on the list. If you have a lot of images that are smaller than this you should consider setting smaller crop sizes.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> esc_html__('Q&A: What size image should I use for images not on the cropped images list?', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Our theme uses a lot of images that are not cropped. These images will be loaded in full and will fit to the spot they are placed in while maintaining their original aspect ratio. Most sizes can be used for these images and it is not possible to define an optimal size as this depends on each user case. In general try to use large images that have been opmitized for web. If you image appears pixelated it is probably too small. ', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'paragraphs',
									'title' 				=> esc_html__('Troubleshoot: My images are not cropped correctly? The sizes look all wrong!', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The number one reason for this is trying to use images that are too small. WordPress can only crop images to a smaller size so if your image is smaller than the crop size WordPress will not crop your image to the correct size and aspect ratio and this will often break the design. To fix this either use larger images or reduce the cropped image size.', 'loc-canon-belle'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php

								canon_fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> esc_html__('Related posts carousel', 'loc-canon-belle'),
									'slug' 					=> 'canon_post_component_carousel',
									'options_name'			=> 'canon_options',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> esc_html__('Featured post grid (6 items wide)', 'loc-canon-belle'),
									'slug' 					=> 'canon_block_post_grid_6wide',
									'options_name'			=> 'canon_options',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> esc_html__('Featured post grid (3 items wide)', 'loc-canon-belle'),
									'slug' 					=> 'canon_block_post_grid_3wide',
									'options_name'			=> 'canon_options',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> esc_html__('Featured post grid (6 items tall)', 'loc-canon-belle'),
									'slug' 					=> 'canon_block_post_grid_6tall',
									'options_name'			=> 'canon_options',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> esc_html__('Featured block carousel', 'loc-canon-belle'),
									'slug' 					=> 'canon_block_carousel',
									'options_name'			=> 'canon_options',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> esc_html__('Even grid featured image', 'loc-canon-belle'),
									'slug' 					=> 'canon_even_grid',
									'options_name'			=> 'canon_options',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> esc_html__('Gallery post format landscape thumb', 'loc-canon-belle'),
									'slug' 					=> 'canon_grid_gallery_landscape',
									'options_name'			=> 'canon_options',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'image_size',
									'title' 				=> esc_html__('Gallery post format portrait thumb', 'loc-canon-belle'),
									'slug' 					=> 'canon_grid_gallery_portrait',
									'options_name'			=> 'canon_options',
								)); 
								
							 ?>		


						</table>


					<!-- 
					--------------------------------------------------------------------------
						MAIN SEARCH AUTOCOMPLETE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Main Search Autocomplete", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Search words', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('When typing a search term in the main search box the autocomplete function will make search suggestions.', 'loc-canon-belle'),
										esc_html__('Enter words or phrases to give as search suggestions. Separate terms with a comma.', 'loc-canon-belle'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> esc_html__('Suggest these words', 'loc-canon-belle'),
									'slug' 					=> 'autocomplete_words',
									'rows'					=> '5',
									'options_name'			=> 'canon_options',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						COMPATIBILITY
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Compatibility", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Suppress theme meta description', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If using a 3rd party SEO plugin the theme meta description can sometimes interfere with the plugin meta description.', 'loc-canon-belle'),
										esc_html__('Use this option to suppress the theme meta description and use the plugin meta description instead.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Suppress theme Open Graph data', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Open Graph is a protocol used by Facebook to gather information about your site that can be utilized when sharing content on Facebook.', 'loc-canon-belle'),
										esc_html__('If using a 3rd party SEO plugin the theme Open Graph data can sometimes interfere with the plugin Open Graph data.', 'loc-canon-belle'),
										esc_html__('Use this option to suppress the theme Open Graph data and use the plugin Open Graph data instead.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Chrome/Safari @font-face fix', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('On some server configurations a known bug in Chrome and Safari can prevent the rendering of serverside @font-face fonts leaving a page blank except for images and other non-text media. If your site experiences this bug make sure you turn on the Chrome/Safari @font-face fix.', 'loc-canon-belle'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Suppress theme meta description', 'loc-canon-belle'),
									'slug' 					=> 'hide_theme_meta_description',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Suppress theme Open Graph data', 'loc-canon-belle'),
									'slug' 					=> 'hide_theme_og',
									'options_name'			=> 'canon_options',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Chrome/Safari @font-face fix', 'loc-canon-belle'),
									'slug' 					=> 'fontface_fix',
									'options_name'			=> 'canon_options',
								)); 

							?>

						</table>




					<?php submit_button(); ?>


				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

