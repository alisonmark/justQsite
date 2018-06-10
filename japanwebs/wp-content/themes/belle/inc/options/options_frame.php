	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_html__("Settings", "loc-canon-belle"), esc_html__("Header & Footer", "loc-canon-belle") ); ?></h2>

		<?php 
			//delete_option('canon_options_frame');
			$canon_options_frame = get_option('canon_options_frame'); 
			$canon_options_advanced = get_option('canon_options_advanced'); 

			// GET CAT LIST
			$cat_list = get_categories(array('hide_empty' => 0));
			$cat_list = array_values($cat_list);

			// SUGGEST INSTAGRAM USER ID
			if ( empty($canon_options_frame['block_instagram_carousel_user_id']) && !empty($canon_options_advanced['oauth_instagram']) ) {
					$canon_options_advanced['oauth_instagram'] = @json_decode(canon_fw_filter_sensitive_output($canon_options_advanced['oauth_instagram']), true);
					$canon_options_frame['block_instagram_carousel_user_id'] = $canon_options_advanced['oauth_instagram']['user']['id'];
					update_option('canon_options_frame', $canon_options_frame);
					$canon_options_frame = get_option('canon_options_frame'); 
			}

			// var_dump($canon_options_frame);
		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_frame'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_frame'); ?>		


					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						HEADER BUILDER
						HOMEPAGE FEATURE BUILDER
						FOOTER BUILDER
						HEADER: GENERAL
						MAIN HEADER ADJUSTMENTS
						PRE-FOOTER ADJUSTMENTS
						ELEMENT: LOGO
						ELEMENT: AUXILIARY LOGO
						ELEMENT: HEADER IMAGE
						ELEMENT: BANNER
						ELEMENT: HEADER TEXT
						ELEMENT: FOOTER TEXT
						ELEMENT: SOCIAL LINKS 
						ELEMENT: TOOLBAR
						ELEMENT: COUNTDOWN
						BLOCK: POST GRID
						BLOCK: SLIDER
						BLOCK: CAROUSEL
						BLOCK: INSTAGRAM CAROUSEL
						BLOCK: WIDGETS
						BLOCK: SEARCH

					-->


					<!-- 
					--------------------------------------------------------------------------
						HEADER BUILDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-builders"><?php esc_html_e("Header Builder", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-builders'>
							<?php 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Header builder', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Build your own header. Select elements for each header section using the selects. Settings for each element can be found below.', 'loc-canon-belle'),
										esc_html__('Notice that some elements are only available for certain spots e.g. logo which can only be placed in the main header etc.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Available elements', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Primary menu.', 'loc-canon-belle'),
										esc_html__('Secondary menu', 'loc-canon-belle'),
										esc_html__('Logo', 'loc-canon-belle'),
										esc_html__('Header image.', 'loc-canon-belle'),
										esc_html__('Social icons', 'loc-canon-belle'),
										esc_html__('Text', 'loc-canon-belle'),
										esc_html__('Toolbar (search button)', 'loc-canon-belle'),
										esc_html__('Ad banner', 'loc-canon-belle'),
										esc_html__('Countdown', 'loc-canon-belle'),
										esc_html__('Breadcrumbs', 'loc-canon-belle'),
									),
								)); 


							 ?>		

						</div>


						<table class='form-table header-layout group-builders'>

						<!-- PRE HEADER -->

							<?php 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Pre-header', 'loc-canon-belle'),
									'slug' 					=> 'header_pre_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'									=> esc_html__('Off', 'loc-canon-belle'),
										'header_pre_custom_center'				=> esc_html__('Custom Center', 'loc-canon-belle'),
										'header_pre_custom_left_right'			=> esc_html__('Custom Left + Right', 'loc-canon-belle'),
										'header_pre_image'						=> esc_html__('Image header', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						<!-- PRE HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_pre_layout" data-listen_for="header_pre_custom_center">
								<th></th>
								<td colspan="2">

									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_center',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- PRE HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_pre_layout" data-listen_for="header_pre_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_left',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_pre_custom_right',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>


						<!-- MAIN HEADER -->

							<?php

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Main header', 'loc-canon-belle'),
									'slug' 					=> 'header_main_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> esc_html__('Off', 'loc-canon-belle'),
										'header_main_custom_center'			=> esc_html__('Custom Center', 'loc-canon-belle'),
										'header_main_custom_left_right'		=> esc_html__('Custom Left + Right', 'loc-canon-belle'),
										'header_main_image'					=> esc_html__('Image header', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						<!-- MAIN HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_main_layout" data-listen_for="header_main_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_center',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'logo'					=> esc_html__('Logo', 'loc-canon-belle'),
												'aux_logo'				=> esc_html__('Auxiliary logo', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'banner'				=> esc_html__('Ad banner', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>
					
							</tr>

						<!-- MAIN HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_main_layout" data-listen_for="header_main_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_left',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'logo'					=> esc_html__('Logo', 'loc-canon-belle'),
												'aux_logo'				=> esc_html__('Auxiliary logo', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'banner'				=> esc_html__('Ad banner', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_main_custom_right',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'logo'					=> esc_html__('Logo', 'loc-canon-belle'),
												'aux_logo'				=> esc_html__('Auxiliary logo', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'banner'				=> esc_html__('Ad banner', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						<!-- POST HEADER -->

							<?php							
								
								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Post-header', 'loc-canon-belle'),
									'slug' 					=> 'header_post_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> esc_html__('Off', 'loc-canon-belle'),
										'header_post_custom_center'		=> esc_html__('Custom Center', 'loc-canon-belle'),
										'header_post_custom_left_right'	=> esc_html__('Custom Left + Right', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- POST HEADER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#header_post_layout" data-listen_for="header_post_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_center',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- POST HEADER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#header_post_layout" data-listen_for="header_post_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_left',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'header_post_custom_right',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						HOMEPAGE FEATURE BUILDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-builders"><?php esc_html_e("Homepage Feature Builder", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-builders'>
							<?php 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Homepage feature', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select what feature block to use as homepage feature. Will appear at the top of the homepage. Off for no feature. Settings for each feature block can be found below.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table header-layout group-builders'>

						<!-- HOMEPAGE FEATURE -->

							<?php

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Homepage feature', 'loc-canon-belle'),
									'slug' 					=> 'homepage_feature_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> esc_html__('Off', 'loc-canon-belle'),
										'block_carousel'				=> esc_html__('Carousel', 'loc-canon-belle'),
										'block_instagram_carousel'		=> esc_html__('Instagram Carousel', 'loc-canon-belle'),
										'block_post_grid'				=> esc_html__('Post Grid', 'loc-canon-belle'),
										'block_slider'					=> esc_html__('Slider', 'loc-canon-belle'),
										'block_widgets'					=> esc_html__('Widgets', 'loc-canon-belle'),
										'block_search'					=> esc_html__('Search', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						FOOTER BUILDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-builders"><?php esc_html_e("Footer Builder", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-builders'>
							<?php 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Footer builder', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Build your own footer. Select elements for each footer section using the selects. Settings for each element can be found below.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table header-layout group-builders'>

						<!-- PRE FOOTER -->

							<?php							
								
								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Pre-footer', 'loc-canon-belle'),
									'slug' 					=> 'footer_pre_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> esc_html__('Off', 'loc-canon-belle'),
										'footer_pre_custom_center'		=> esc_html__('Custom Center', 'loc-canon-belle'),
										'footer_pre_custom_left_right'	=> esc_html__('Custom Left + Right', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- PRE FOOTER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#footer_pre_layout" data-listen_for="footer_pre_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_center',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'logo'					=> esc_html__('Logo', 'loc-canon-belle'),
												'aux_logo'				=> esc_html__('Auxiliary logo', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- PRE FOOTER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#footer_pre_layout" data-listen_for="footer_pre_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_left',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'logo'					=> esc_html__('Logo', 'loc-canon-belle'),
												'aux_logo'				=> esc_html__('Auxiliary logo', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_pre_custom_right',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'logo'					=> esc_html__('Logo', 'loc-canon-belle'),
												'aux_logo'				=> esc_html__('Auxiliary logo', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>


						<!-- MAIN FOOTER -->

							<?php

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Main footer', 'loc-canon-belle'),
									'slug' 					=> 'footer_main_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> esc_html__('Off', 'loc-canon-belle'),
										'block_carousel'				=> esc_html__('Carousel', 'loc-canon-belle'),
										'block_instagram_carousel'		=> esc_html__('Instagram Carousel', 'loc-canon-belle'),
										'block_post_grid'				=> esc_html__('Post Grid', 'loc-canon-belle'),
										'block_slider'					=> esc_html__('Slider', 'loc-canon-belle'),
										'block_widgets'					=> esc_html__('Widgets', 'loc-canon-belle'),
										'block_search'					=> esc_html__('Search', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						<!-- POST FOOTER -->

							<?php							
								
								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Post-footer', 'loc-canon-belle'),
									'slug' 					=> 'footer_post_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'							=> esc_html__('Off', 'loc-canon-belle'),
										'footer_post_custom_center'		=> esc_html__('Custom Center', 'loc-canon-belle'),
										'footer_post_custom_left_right'	=> esc_html__('Custom Left + Right', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 
								
							?>

						<!-- POST FOOTER: CUSTOM CENTER -->

							<tr class="dynamic_option" data-listen_to="#footer_post_layout" data-listen_for="footer_post_custom_center">
								<th></th>
								<td colspan="2">
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_center',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

							</tr>

						<!-- POST FOOTER: CUSTOM LEFT RIGHT -->

							<tr class="dynamic_option" data-listen_to="#footer_post_layout" data-listen_for="footer_post_custom_left_right">
								<th></th>
								<td>
					
									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_left',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

								</td>
								<td>

									<?php 

										canon_fw_option(array(
											'type'					=> 'select_only',
											'slug' 					=> 'footer_post_custom_right',
											'select_options'		=> array(
												'off'					=> esc_html__('Off', 'loc-canon-belle'),
												'primary'				=> esc_html__('Primary Menu', 'loc-canon-belle'),
												'secondary'				=> esc_html__('Secondary Menu', 'loc-canon-belle'),
												'social'				=> esc_html__('Social Icons', 'loc-canon-belle'),
												'header_text'			=> esc_html__('Header Text', 'loc-canon-belle'),
												'footer_text'			=> esc_html__('Footer Text', 'loc-canon-belle'),
												'toolbar'				=> esc_html__('Toolbar', 'loc-canon-belle'),
												'countdown'				=> esc_html__('Countdown', 'loc-canon-belle'),
												'breadcrumbs'			=> esc_html__('Breadcrumbs', 'loc-canon-belle'),
											),
											'options_name'			=> 'canon_options_frame',
										)); 

									?>

 								</td>
							</tr>

						</table>

					
					<!-- HORIZONTAL DIVIDER -->
					<br><hr><br>


					<!-- 
					--------------------------------------------------------------------------
						HEADER: GENERAL
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Header: General Settings", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Boxed header content', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Make header content boxed.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Sticky headers', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Make the headers stick to the top of the page when scrolling down.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Header opacity', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set the opacity of each header section. Values must be between 0 and 1. 0 is completely transparent. 1 is completely solid/opaque.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Sticky header shadow', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Apply a shadow to the sticky header when scrolling down.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Stickyness in responsive mode', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Turn off stickyness in responsive mode. Choose the viewport size under which stickyness will be disabled. The optimal setting depends on your content. If you have many sticky elements or tall sticky elements you might want to turn off stickyness at a higher viewport size to avoid the sticky elements taking up the whole viewport.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Add search button to primary or secondary menu', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select this to put a search button at the end of your primary or secondary menu', 'loc-canon-belle'),
									),
								)); 

							 ?>		


						</div>

						<table class='form-table'>


							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Boxed header content', 'loc-canon-belle'),
									'slug' 					=> 'use_boxed_header',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Sticky pre-header', 'loc-canon-belle'),
									'slug' 					=> 'use_sticky_preheader',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Sticky main header', 'loc-canon-belle'),
									'slug' 					=> 'use_sticky_header',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Sticky post-header', 'loc-canon-belle'),
									'slug' 					=> 'use_sticky_postheader',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Pre-header opacity', 'loc-canon-belle'),
									'slug' 					=> 'preheader_opacity',
									'min'					=> '0',										// optional
									'max'					=> '1',										// optional
									'step'					=> '0.05',									// optional
									'width_px'				=> '60',									// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Main header opacity', 'loc-canon-belle'),
									'slug' 					=> 'header_opacity',
									'min'					=> '0',										// optional
									'max'					=> '1',										// optional
									'step'					=> '0.05',									// optional
									'width_px'				=> '60',									// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Post-header opacity', 'loc-canon-belle'),
									'slug' 					=> 'postheader_opacity',
									'min'					=> '0',										// optional
									'max'					=> '1',										// optional
									'step'					=> '0.05',									// optional
									'width_px'				=> '60',									// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Sticky header shadow', 'loc-canon-belle'),
									'slug' 					=> 'use_sticky_shadow',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Stickyness in responsive mode', 'loc-canon-belle'),
									'slug' 					=> 'sticky_turn_off_width',
									'select_options'		=> array(
										'0'					=> esc_html__('Stickyness is always on', 'loc-canon-belle'),
										'768'				=> esc_html__('Turn off @ viewport width below 768px', 'loc-canon-belle'),
										'600'				=> esc_html__('Turn off @ viewport width below 600px', 'loc-canon-belle'),
										'480'				=> esc_html__('Turn off @ viewport width below 480px', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Add search button to primary menu', 'loc-canon-belle'),
									'slug' 					=> 'add_search_btn_to_primary',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Add search button to secondary menu', 'loc-canon-belle'),
									'slug' 					=> 'add_search_btn_to_secondary',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						MAIN HEADER ADJUSTMENTS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Main Header Adjustments", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Padding top & Padding bottom', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Used to position your header elements.', 'loc-canon-belle'),
										esc_html__('Increase padding top to create space above the header elements.', 'loc-canon-belle'),
										esc_html__('Increase padding bottom to create space below the header elements.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Adjust left element relative position', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('You can fine adjust the left element position. Values are pixels from top-left.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Adjust right element relative position', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('You can fine adjust the right element position. Values are pixels from top-right.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table header-layout'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Header padding top', 'loc-canon-belle'),
									'slug' 					=> 'header_padding_top',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Header padding bottom', 'loc-canon-belle'),
									'slug' 					=> 'header_padding_bottom',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

							 ?>		


							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Adjust left element relative position", "loc-canon-belle"); ?></th>
								<td>
									<input 
										type='number' 
										id='pos_left_element_top' 
										name='canon_options_frame[pos_left_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_left_element_top'])) echo esc_attr($canon_options_frame['pos_left_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='pos_left_element_left' 
										name='canon_options_frame[pos_left_element_left]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_left_element_left'])) echo esc_attr($canon_options_frame['pos_left_element_left']); ?>'
									> <i>(pixels from left)</i>
								</td> 
							</tr>

							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Adjust right element relative position", "loc-canon-belle"); ?></th>
								<td>
									<input 
										type='number' 
										id='pos_right_element_top' 
										name='canon_options_frame[pos_right_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_right_element_top'])) echo esc_attr($canon_options_frame['pos_right_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='pos_right_element_right' 
										name='canon_options_frame[pos_right_element_right]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['pos_right_element_right'])) echo esc_attr($canon_options_frame['pos_right_element_right']); ?>'
									> <i>(pixels from right)</i>
								</td> 
							</tr>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						PRE-FOOTER ADJUSTMENTS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Pre-footer Adjustments", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Padding top & Padding bottom', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Used to position your pre-footer elements.', 'loc-canon-belle'),
										esc_html__('Increase padding top to create space above the pre-footer elements.', 'loc-canon-belle'),
										esc_html__('Increase padding bottom to create space below the pre-footer elements.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Adjust left element relative position', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('You can fine adjust the left element position. Values are pixels from top-left.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Adjust right element relative position', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('You can fine adjust the right element position. Values are pixels from top-right.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table header-layout'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Pre-footer padding top', 'loc-canon-belle'),
									'slug' 					=> 'prefooter_padding_top',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Pre-footer padding bottom', 'loc-canon-belle'),
									'slug' 					=> 'prefooter_padding_bottom',
									'min'					=> '0',										// optional
									'max'					=> '1000',									// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

							 ?>		


							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Adjust left element relative position", "loc-canon-belle"); ?></th>
								<td>
									<input 
										type='number' 
										id='prefooter_pos_left_element_top' 
										name='canon_options_frame[prefooter_pos_left_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['prefooter_pos_left_element_top'])) echo esc_attr($canon_options_frame['prefooter_pos_left_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='prefooter_pos_left_element_left' 
										name='canon_options_frame[prefooter_pos_left_element_left]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['prefooter_pos_left_element_left'])) echo esc_attr($canon_options_frame['prefooter_pos_left_element_left']); ?>'
									> <i>(pixels from left)</i>
								</td> 
							</tr>

							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Adjust right element relative position", "loc-canon-belle"); ?></th>
								<td>
									<input 
										type='number' 
										id='prefooter_pos_right_element_top' 
										name='canon_options_frame[prefooter_pos_right_element_top]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['prefooter_pos_right_element_top'])) echo esc_attr($canon_options_frame['prefooter_pos_right_element_top']); ?>'
									> <i>(pixels from top)</i>
									<input 
										type='number' 
										id='prefooter_pos_right_element_right' 
										name='canon_options_frame[prefooter_pos_right_element_right]' 
										min='-1000'
										max='1000'
										style='width: 60px;'
										value='<?php if (isset($canon_options_frame['prefooter_pos_right_element_right'])) echo esc_attr($canon_options_frame['prefooter_pos_right_element_right']); ?>'
									> <i>(pixels from right)</i>
								</td> 
							</tr>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: LOGO
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Logo", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('General logo hierarchy', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('by default the theme logo will be displayed', 'loc-canon-belle'),
										esc_html__('if you enter a logo image URL this image will be displayed instead of the theme logo.', 'loc-canon-belle'),
										esc_html__('if you enter text as logo this text will be displayed instead of any custom logo image and instead of the theme logo.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Logo URL', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Enter a complete URL to the image you want to use or', 'loc-canon-belle'),
										esc_html__('Click the "Upload" button, upload an image and make sure you click the "Use as logo" button or', 'loc-canon-belle'),
										esc_html__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as logo" button.', 'loc-canon-belle'),
										esc_html__('If you leave the URL text field empty the default logo will be displayed.', 'loc-canon-belle'),
										esc_html__('Remember to save your changes.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Logo max width', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('You can control the size of your logo by setting the maximum allowed width of your logo image.', 'loc-canon-belle'),
										esc_html__('To make your logo HD-ready/retina-ready you should set the logo max width to half the original width of your image (compression ratio: 2)', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Use text as logo', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('This text will be displayed instead of any logo image. You can select font for logo text by going to Appearance > Google Webfonts > Logo text.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Append tagline to text logo', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Appends the blog tagline to the the text logo. Blog tagline/description can be set in (WordPress) Settings > General > Tagline', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Text as logo size', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If using text as logo this option lets you set a font size.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Tagline size', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Tagline font size.', 'loc-canon-belle'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									 <br>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Logo Preview", "loc-canon-belle"); ?></th>
								<td>
									<?php 

				                        if (!empty($canon_options_frame['logo_url'])) {
				                            $logo_url = $canon_options_frame['logo_url'];
				                        } else {
				                            $logo_url = get_template_directory_uri() .'/img/logo@2x.png';
				                        }
				                        $logo_size = getimagesize($logo_url);
				                        if (!empty($canon_options_frame['logo_max_width'])) {
					                        $compression_ratio = $logo_size[0] / (int) $canon_options_frame['logo_max_width'];
				                        } else {
					                        $compression_ratio = 999;
				                        }

									 ?>
									<img class="thelogo" width="<?php if (!empty($canon_options_frame['logo_max_width'])) echo esc_attr($canon_options_frame['logo_max_width']); ?>" src="<?php echo esc_url($logo_url); ?>"><br><br>
									<?php printf("<i>(%s%s %s%s%s)</i>", esc_html__("Original size: Width: ", "loc-canon-belle"), esc_attr($logo_size[0]), esc_html__("pixels, height: ", "loc-canon-belle") , esc_attr($logo_size[1]), esc_html__(" pixels", "loc-canon-belle")); ?><br>
                                    <?php printf("<i>(%s%s %s%.2f)</i>", esc_html__("Resized to max width: ", "loc-canon-belle") , esc_attr($canon_options_frame['logo_max_width']), esc_html__("pixels. Compression ratio: ", "loc-canon-belle"), esc_attr($compression_ratio)); ?><br>
									<br><br>
								</td>
							</tr>

							<?php 

								canon_fw_option(array(
									'type'					=> 'upload',
									'title' 				=> esc_html__('Logo URL', 'loc-canon-belle'),
									'slug' 					=> 'logo_url',
									'btn_text'				=> 'Upload logo',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Logo max width (size)', 'loc-canon-belle'),
									'slug' 					=> 'logo_max_width',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Use text as logo', 'loc-canon-belle'),
									'slug' 					=> 'logo_text',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Append tagline to text logo', 'loc-canon-belle'),
									'slug' 					=> 'logo_text_append_tagline',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Text as logo size', 'loc-canon-belle'),
									'slug' 					=> 'logo_text_size',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Tagline size', 'loc-canon-belle'),
									'slug' 					=> 'tagline_text_size',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 


							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: AUXILIARY LOGO
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Auxiliary logo", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Auxiliary logo', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The auxiliary logo lets you display a second logo. Notice that it does not have the same options as the main logo to display text as logo.', 'loc-canon-belle'),
										esc_html__('To make your logo HD-ready/retina-ready you should set the logo max width to half the original width of your image (compression ratio: 2)', 'loc-canon-belle'),
									),
								)); 


								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Logo URL', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Enter a complete URL to the image you want to use or', 'loc-canon-belle'),
										esc_html__('Click the "Upload" button, upload an image and make sure you click the "Use as logo" button or', 'loc-canon-belle'),
										esc_html__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as logo" button.', 'loc-canon-belle'),
										esc_html__('If you leave the URL text field empty the default logo will be displayed.', 'loc-canon-belle'),
										esc_html__('Remember to save your changes.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Logo max width', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('You can control the size of your logo by setting the maximum allowed width of your logo image.', 'loc-canon-belle'),
										esc_html__('To make your logo HD-ready/retina-ready you should set the logo max width to half the original width of your image (compression ratio: 2)', 'loc-canon-belle'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									 <br>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Aux. logo Preview", "loc-canon-belle"); ?></th>
								<td>
									<?php 

				                        if (!empty($canon_options_frame['aux_logo_url'])) {
				                            $aux_logo_url = $canon_options_frame['aux_logo_url'];
				                        } else {
				                            $aux_logo_url = get_template_directory_uri() .'/img/logo@2x-dark.png';
				                        }
				                        $aux_logo_size = getimagesize($aux_logo_url);
				                        if (!empty($canon_options_frame['aux_logo_max_width'])) {
					                        $compression_ratio = $aux_logo_size[0] / (int) $canon_options_frame['aux_logo_max_width'];
				                        } else {
					                        $compression_ratio = 999;
				                        }

									 ?>
									<img class="aux-logo" width="<?php if (!empty($canon_options_frame['aux_logo_max_width'])) echo esc_attr($canon_options_frame['aux_logo_max_width']); ?>" src="<?php echo esc_url($aux_logo_url); ?>"><br><br>
									<?php printf("<i>(%s%s %s%s%s)</i>", esc_html__("Original size: Width: ", "loc-canon-belle"), esc_attr($aux_logo_size[0]), esc_html__("pixels, height: ", "loc-canon-belle") , esc_attr($aux_logo_size[1]), esc_html__(" pixels", "loc-canon-belle")); ?><br>
                                    <?php printf("<i>(%s%s %s%.2f)</i>", esc_html__("Resized to max width: ", "loc-canon-belle") , esc_attr($canon_options_frame['aux_logo_max_width']), esc_html__("pixels. Compression ratio: ", "loc-canon-belle"), esc_attr($compression_ratio)); ?><br>
									<br><br>
								</td>
							</tr>

							<?php 

								canon_fw_option(array(
									'type'					=> 'upload',
									'title' 				=> esc_html__('Aux. logo URL', 'loc-canon-belle'),
									'slug' 					=> 'aux_logo_url',
									'btn_text'				=> 'Upload logo',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Aux. logo max width (size)', 'loc-canon-belle'),
									'slug' 					=> 'aux_logo_max_width',
									'min'					=> '1',										// optional
									'max'					=> '1000',									// optional
									'step'					=> '1',										// optional
									'width_px'				=> '60',									// optional
									'postfix'				=> '<i>(pixels)</i>',						// optional
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: HEADER IMAGE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Header Image", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show only on homepage', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The header image will only be displayed on the homepage.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Image URL', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Insert URL to use as header image or click Select Image button to choose from media library.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Background color', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set header image background color. Useful when using transparent image files.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Header height', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set header image height', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Parallax amount', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select how much of a parallax effect you want.', 'loc-canon-belle'),
										esc_html__('Set at 0% to turn parallax off completely - the image will scroll along with the rest of the page.', 'loc-canon-belle'),
										esc_html__('Set at 100% for maximum parallax effect - the image stays fixed as the page scrolls by.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Image text', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Text to display over header image.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Image text top margin', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Increase number to position text further down.', 'loc-canon-belle'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show only on homepage', 'loc-canon-belle'),
									'slug' 					=> 'header_img_homepage_only',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'upload',
									'title' 				=> esc_html__('Image URL', 'loc-canon-belle'),
									'slug' 					=> 'header_img_url',
									'btn_text'				=> esc_html__('Select Image', 'loc-canon-belle'),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Background color', 'loc-canon-belle'),
									'slug' 					=> 'header_img_bg_color',
									'options_name'			=> 'canon_options_frame',
								)); 
							
								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Header height', 'loc-canon-belle'),
									'slug' 					=> 'header_img_height',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Parallax amount', 'loc-canon-belle'),
									'slug' 					=> 'header_img_parallax_amount',
									'min'					=> '0',
									'max'					=> '100',
									'step'					=> '1',
									'postfix'				=> '<i>%</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> esc_html__('Image text', 'loc-canon-belle'),
									'slug' 					=> 'header_img_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Image text alignment', 'loc-canon-belle'),
									'slug' 					=> 'header_img_text_alignment',
									'select_options'		=> array(
										'centered'			=> esc_html__('Center', 'loc-canon-belle'),
										'left'				=> esc_html__('Left', 'loc-canon-belle'),
										'right'				=> esc_html__('Right', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Image text top margin', 'loc-canon-belle'),
									'slug' 					=> 'header_img_text_margin_top',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 


							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: BANNER
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Ad Banner", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Ad Code', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Insert your ad code or ad HTML here. If you are unsure what code to use you should consult your ad provider.', 'loc-canon-belle'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								canon_fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> esc_html__('Ad code', 'loc-canon-belle'),
									'slug' 					=> 'banner_code',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: HEADER TEXT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Header Text", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Header text', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Text to display in header. Can contain HTML.', 'loc-canon-belle'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								canon_fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> esc_html__('Header text', 'loc-canon-belle'),
									'slug' 					=> 'header_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: FOOTER TEXT
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Footer Text", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Footer text', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Text to display in footer. Can contain HTML.', 'loc-canon-belle'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								canon_fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> esc_html__('Footer text', 'loc-canon-belle'),
									'slug' 					=> 'footer_text',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: SOCIAL LINKS 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Social Links", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Open links in new window', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose if social links should open in a new window.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Social links', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose an icon in the select and attach this to a social link.', 'loc-canon-belle'),
										esc_html__('Make sure you put the whole URL to your social site in the text input.', 'loc-canon-belle'),
										esc_html__('You can add a new social link to the end of the list by clicking "Add social link', 'loc-canon-belle'),
										esc_html__('You can remove social links by clicking "Delete".', 'loc-canon-belle'),
										wp_kses_post(__('You can see a full list of the Font Awesome icons <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">here</a>.', 'loc-canon-belle')),
									),
								)); 

							?>
						</div>

						<table class='form-table social_links'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Open links in new window', 'loc-canon-belle'),
									'slug' 					=> 'social_in_new',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

							<?php 
							if (isset($canon_options_frame['social_links'])) {

								$font_awesome_array = canon_fw_get_font_awesome_icon_names_in_array();
								
								// ARRAY VALUES
								$canon_options_frame['social_links'] = array_values($canon_options_frame['social_links']);
								update_option('canon_options_frame', $canon_options_frame);

								?>

								<tr valign='top' class='social_links_row'>
									<th scope='row'><?php esc_html_e("Social links", "loc-canon-belle"); ?></th>
									<td>
										<ul class="ul_sortable"  data-split_index="2" data-placeholder="social_links_sortable_placeholder">
											<?php for ($i = 0; $i < count($canon_options_frame['social_links']); $i++) : ?>

												<li>
													<select class="social_links_icon fa_select li_option" name="canon_options_frame[social_links][<?php echo esc_attr($i); ?>][0]"> 
														<?php 

															for ($n = 0; $n < count($font_awesome_array); $n++) {  
															?>
										     					<option value="<?php echo esc_attr($font_awesome_array[$n]); ?>" <?php if (isset($canon_options_frame['social_links'][$i][0])) {if ($canon_options_frame['social_links'][$i][0] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo esc_attr($font_awesome_array[$n]); ?></option> 
															<?php
															}

														?>
													</select> 

													<i class="fa <?php if (isset($canon_options_frame['social_links'][$i][0])) { echo esc_attr($canon_options_frame['social_links'][$i][0]); } else { echo "fa-flag"; } ?>"></i>
													<input type='text' class='social_links_link li_option' name='canon_options_frame[social_links][<?php echo esc_attr($i); ?>][1]' value='<?php if (isset($canon_options_frame['social_links'][$i][1])) echo esc_url($canon_options_frame['social_links'][$i][1]); ?>'>
													<button class="button ul_del_this"><?php esc_html_e("delete", "loc-canon-belle"); ?></button>

												</li>

											<?php endfor; ?>

										</ul>

										<div class="ul_control" data-min="1" data-max="1000">
											<input type="button" class="button ul_add" value="<?php esc_html_e("Add", "loc-canon-belle"); ?>" />
											<input type="button" class="button ul_del" value="<?php esc_html_e("Delete", "loc-canon-belle"); ?>" />
										</div>

									</td>
								</tr>

								<?php

							}

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: TOOLBAR
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Toolbar", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Toolbar', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select what tools to add to the toolbar.', 'loc-canon-belle'),
									),
								)); 


							?>
						</div>

						<table class='form-table'>


							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Search button', 'loc-canon-belle'),
									'slug' 					=> 'toolbar_search_button',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						ELEMENT: COUNTDOWN
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Countdown", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Countdown to', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Must be in the format Month DD, YYYY HH:MM:SS e.g. December 31, 2023 23:59:59', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('GMT offset', 'loc-canon-belle'),
									'content' 				=> array(
										wp_kses_post(__('GMT offset of your current timezone. You can search for your timezone <a href="http://www.worldtimezone.com/" target="_blank">here</a>.', 'loc-canon-belle')),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Description', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Countdown description. Will appear before the countdown.', 'loc-canon-belle'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>


							<?php 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Countdown to', 'loc-canon-belle'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_datetime_string',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('GMT Offset', 'loc-canon-belle'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_gmt_offset',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Description', 'loc-canon-belle'),
									'class'					=> 'widefat',
									'slug' 					=> 'countdown_description',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						BLOCK: POST GRID
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php esc_html_e("Feature Block: Post Grid", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>
							<?php 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Grid shows', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose what posts to display in the post grid.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Layout', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose between 3 or 6-item layout.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('On Load Animation', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Off: No animations.', 'loc-canon-belle'),
										esc_html__('Simple fade in: All items fade in at once.', 'loc-canon-belle'),
										esc_html__('Sequential: Items fade in one at a time in sequential order.', 'loc-canon-belle'),
										esc_html__('Random: Items fade in one at a time in random order.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table block-post-grid group-feature-block'>

							<tr valign='top'>

								<th scope='row'><?php esc_html_e("Grid shows", "loc-canon-belle"); ?></th>
								
								<td>
								
									<select id="block_post_grid_shows" name="canon_options_frame[block_post_grid_shows]"> 

						     			<option value="latest_posts" <?php if ($canon_options_frame['block_post_grid_shows'] == "latest_posts") { echo "selected='selected'";} ?>><?php esc_html_e("Latest posts", "loc-canon-belle"); ?></option> 
						     			<option value="random_posts" <?php if ($canon_options_frame['block_post_grid_shows'] == "random_posts") { echo "selected='selected'";} ?>><?php esc_html_e("Random posts", "loc-canon-belle"); ?></option> 
						     			<option value="latest_posts"></option> 

						     			<option value="popular_views" <?php if ($canon_options_frame['block_post_grid_shows'] == "popular_views") { echo "selected='selected'";} ?>><?php esc_html_e("Popular posts by views", "loc-canon-belle"); ?>	</option> 
						     			<option value="popular_likes" <?php if ($canon_options_frame['block_post_grid_shows'] == "popular_likes") { echo "selected='selected'";} ?>><?php esc_html_e("Popular posts by likes", "loc-canon-belle"); ?>	</option> 
					 					<option value="popular_comments" <?php if ($canon_options_frame['block_post_grid_shows'] == "popular_comments") { echo "selected='selected'";} ?>><?php esc_html_e("Popular posts by comments", "loc-canon-belle"); ?>	</option> 
						     			<option value="latest_posts"></option> 

										<?php 
											for ($i = 0; $i < count($cat_list); $i++) { 
											?>
							     				<option value="postcat_<?php echo esc_attr($cat_list[$i]->slug); ?>" <?php if ($canon_options_frame['block_post_grid_shows'] == "postcat_" . $cat_list[$i]->slug) { echo "selected='selected'";} ?>><?php echo esc_attr($cat_list[$i]->name); ?> <?php esc_html_e("category", "loc-canon-belle"); ?></option> 
											<?php
											}
										?>

									</select> 
								
								</td>
							
							</tr>

							<?php
								
								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Layout', 'loc-canon-belle'),
									'slug' 					=> 'block_post_grid_layout',
									'colspan'				=> 2,
									'select_options'		=> array(
										'6wide'						=> esc_html__('Layout 1 (6 items wide)', 'loc-canon-belle'),
										'3wide'						=> esc_html__('Layout 2 (3 items wide)', 'loc-canon-belle'),
										'6tall'						=> esc_html__('Layout 3 (6 items tall)', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('On load animation', 'loc-canon-belle'),
									'slug' 					=> 'block_post_grid_animation',
									'colspan'				=> 2,
									'select_options'		=> array(
										'off'									=> esc_html__('Off', 'loc-canon-belle'),
										'simple'								=> esc_html__('Simple fade in', 'loc-canon-belle'),
										'sequential'							=> esc_html__('Sequential', 'loc-canon-belle'),
										'random'								=> esc_html__('Random', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Animation delay', 'loc-canon-belle'),
									'slug' 					=> 'block_post_grid_anim_delay',
									'min'					=> '0',
									'step'					=> '10',
									'width_px'				=> '60',
									'postfix'				=> '<i>(milliseconds)</i>',
									'listen_to'				=> '#block_post_grid_animation',
									'listen_for'			=> 'simple sequential random',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Animation speed', 'loc-canon-belle'),
									'slug' 					=> 'block_post_grid_anim_speed',
									'min'					=> '0',
									'step'					=> '10',
									'width_px'				=> '60',
									'postfix'				=> '<i>(milliseconds)</i>',
									'listen_to'				=> '#block_post_grid_animation',
									'listen_for'			=> 'simple sequential random',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						</table>


					<!-- 
					--------------------------------------------------------------------------
						BLOCK: SLIDER
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php esc_html_e("Feature Block: Slider", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							The Feature Block: Slider depends on the Revolution Slider plugin so make sure that this plugin is installed and activated (the plugin comes bundled with the theme). Also make sure that you have created at least one slider.

							<br><br>

							<?php 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Select slider alias', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__(' Select here which slider to display.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Boxed', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('By default the Feature Block: Slider will display a full width slider. Check the Boxed checkbox to display a slider in boxed layout instead. Remember that the Revolution Slider itself has a setting called "Force Full Width" which you must turn off to allow for boxed layout.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>

						<?php
							
					        // HANDLE STATUS
					        if (class_exists('RevSlider')) {
						        $slider = new RevSlider();
						        $arrSliders = $slider->getAllSliderAliases();
						        if (empty($arrSliders)) { $arrSliders = array('No sliders found!'); }
					        } else {
					        	$arrSliders = array('Revolution Slider plugin not found!');	
					        }
							

						?>

						<table class='form-table block-feature group-feature-block'>

							<tr valign='top'>

								<th scope='row'><?php esc_html_e("Select slider alias", "loc-canon-belle"); ?></th>
								
								<td>
								
									<select class='block_slider_alias' id="alias" name="canon_options_frame[block_slider_alias]"> 
									<?php 
										for ($i = 0; $i < count($arrSliders); $i++) { 
										?>
						     				<option value="<?php echo esc_attr($arrSliders[$i]); ?>" <?php if (isset($canon_options_frame['block_slider_alias'])) {if ($canon_options_frame['block_slider_alias'] == $arrSliders[$i]) echo "selected='selected'";} ?>><?php echo esc_attr($arrSliders[$i]); ?></option> 
										<?php
										}
									?>
									</select> 
								
								</td>
							
							</tr>

							<?php

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Boxed', 'loc-canon-belle'),
									'slug' 					=> 'block_slider_boxed',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						</table>


					<!-- 
					--------------------------------------------------------------------------
						BLOCK: CAROUSEL
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php esc_html_e("Feature Block: Carousel", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							<?php 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Carousel shows', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose what posts to display in the carousel.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show featured image, title and excerpt', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Use these checkboxes to select what elements to show.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Number of posts to display', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('How many posts to display at a time in the carousel.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Number of posts to load', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('How many posts to load into the carousel.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Excerpt length in approximate number of characters.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Autoplay speed', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Time between each slide. Set to 0 for no autoplay.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Stop on hover', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Carousel pauses when user hovers carousel with cursor.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Show pagination. Will appear as bullets under carousel.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table block-feature group-feature-block'>

							<tr valign='top'>

								<th scope='row'><?php esc_html_e("Carousel shows", "loc-canon-belle"); ?></th>
								
								<td>
								
									<select id="block_carousel_shows" name="canon_options_frame[block_carousel_shows]"> 

						     			<option value="latest_posts" <?php if ($canon_options_frame['block_carousel_shows'] == "latest_posts") { echo "selected='selected'";} ?>><?php esc_html_e("Latest posts", "loc-canon-belle"); ?></option> 
						     			<option value="random_posts" <?php if ($canon_options_frame['block_carousel_shows'] == "random_posts") { echo "selected='selected'";} ?>><?php esc_html_e("Random posts", "loc-canon-belle"); ?></option> 
						     			<option value="latest_posts"></option> 

						     			<option value="popular_views" <?php if ($canon_options_frame['block_carousel_shows'] == "popular_views") { echo "selected='selected'";} ?>><?php esc_html_e("Popular posts by views", "loc-canon-belle"); ?>	</option> 
						     			<option value="popular_likes" <?php if ($canon_options_frame['block_carousel_shows'] == "popular_likes") { echo "selected='selected'";} ?>><?php esc_html_e("Popular posts by likes", "loc-canon-belle"); ?>	</option> 
					 					<option value="popular_comments" <?php if ($canon_options_frame['block_carousel_shows'] == "popular_comments") { echo "selected='selected'";} ?>><?php esc_html_e("Popular posts by comments", "loc-canon-belle"); ?>	</option> 
						     			<option value="latest_posts"></option> 

										<?php 
											for ($i = 0; $i < count($cat_list); $i++) { 
											?>
							     				<option value="postcat_<?php echo esc_attr($cat_list[$i]->slug); ?>" <?php if ($canon_options_frame['block_carousel_shows'] == "postcat_" . $cat_list[$i]->slug) { echo "selected='selected'";} ?>><?php echo esc_attr($cat_list[$i]->name); ?> <?php esc_html_e("category", "loc-canon-belle"); ?></option> 
											<?php
											}
										?>

									</select> 
								
								</td>
							
							</tr>

							<?php

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show featured image', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_show_featured_image',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show title', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_show_title',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show excerpt', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_show_excerpt',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Number of posts to display', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_display_num_posts',
									'min'					=> '2',
									'max'					=> '6',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Number of posts to load', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_num_posts',
									'min'					=> '1',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_excerpt_length',
									'min'					=> '1',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Autoplay speed', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_autoplay_speed',
									'min'					=> '0',
									'step'					=> '100',
									'postfix'				=> '<i>(milliseconds - 0 to turn autoplay off)</i>',						// optional
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Stop on hover', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_stop_on_hover',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'slug' 					=> 'block_carousel_pagination',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						</table>



					<!-- 
					--------------------------------------------------------------------------
						BLOCK: INSTAGRAM CAROUSEL
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php esc_html_e("Feature Block: Instagram Carousel", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							<?php 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Carousel shows', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose what images to display in the carousel.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('User ID', 'loc-canon-belle'),
									'content' 				=> array(
										wp_kses_post(__('If Carousel shows is set to Recent media then get recent media from this User ID. If you have succesfully authenticated your site with Instagram your own User ID will display here as default. You can use services such as <a href="http://www.otzberg.net/iguserid/" target="_blank">http://www.otzberg.net/iguserid/</a> to look up user id if you know the user name.', 'loc-canon-belle')),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Hashtag', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('If Carousel shows is set to Media with hashtag then get recent media with this hashtag. Just write a single word like "food" - do not append the # symbol.', 'loc-canon-belle'),
									),
								)); 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Number of images to display', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('How many images to display at a time in the carousel.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Number of images to load', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('How many images to load into the carousel.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Excerpt length in approximate number of characters.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Autoplay speed', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Time between each slide. Set to 0 for no autoplay.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Stop on hover', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Carousel pauses when user hovers carousel with cursor.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Show pagination. Will appear as bullets under carousel.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table block-feature group-feature-block'>


							<?php

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Carousel shows', 'loc-canon-belle'),
									'slug' 					=> 'block_instagram_carousel_shows',
									'colspan'				=> 2,
									'select_options'		=> array(
										'recent'								=> esc_html__('Recent media', 'loc-canon-belle'),
										'hashtag'								=> esc_html__('Media with hashtag', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('User ID', 'loc-canon-belle'),
									'class'					=> 'widefat',
									'listen_to'				=> '#block_instagram_carousel_shows',
									'listen_for'			=> 'recent',
									'slug' 					=> 'block_instagram_carousel_user_id',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Hashtag', 'loc-canon-belle'),
									'class'					=> 'widefat',
									'listen_to'				=> '#block_instagram_carousel_shows',
									'listen_for'			=> 'hashtag',
									'slug' 					=> 'block_instagram_carousel_tag',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Number of images to display', 'loc-canon-belle'),
									'slug' 					=> 'block_instagram_carousel_display_num_posts',
									'min'					=> '2',
									'max'					=> '8',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Number of images to load', 'loc-canon-belle'),
									'slug' 					=> 'block_instagram_carousel_num_posts',
									'min'					=> '1',
									'max'					=> '20',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'slug' 					=> 'block_instagram_carousel_excerpt_length',
									'min'					=> '1',
									'step'					=> '1',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Autoplay speed', 'loc-canon-belle'),
									'slug' 					=> 'block_instagram_carousel_autoplay_speed',
									'min'					=> '0',
									'step'					=> '100',
									'postfix'				=> '<i>(milliseconds - 0 to turn autoplay off)</i>',						// optional
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Stop on hover', 'loc-canon-belle'),
									'slug' 					=> 'block_instagram_carousel_stop_on_hover',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'slug' 					=> 'block_instagram_carousel_pagination',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>


						</table>

					<!-- 
					--------------------------------------------------------------------------
						BLOCK: WIDGETS
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php esc_html_e("Feature Block: Widgets", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Boxed', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select this to contain widgets within a boxed width. If unchecked widgets will try to span the full width of the page.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>


						<table class='form-table block-feature group-feature-block'>

							<?php

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Boxed', 'loc-canon-belle'),
									'slug' 					=> 'block_widgets_boxed',
									'options_name'			=> 'canon_options_frame',
								)); 

							?>

						</table>



					<!-- 
					--------------------------------------------------------------------------
						BLOCK: SEARCH
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-feature-block"><?php esc_html_e("Feature Block: Search", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-feature-block'>

							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Background image URL', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Insert URL to use as background image or click Select Image button to choose from media library.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Background color', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set background color. Useful when using transparent image files or for solid color blocks.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Text color', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set text color.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Background-attachment', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Setting background-attachment to scroll will make the background image scroll along with the rest of the page. Fixed will make the background image stay in place for a parallax style effect.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Background-size', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set to auto the background image will retain its original width and height. With background-size set to cover the background image will be as large as possible while still maintaining its original aspect ratio.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Search block height', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set the height of the search block.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Content top margin', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Top margin applied to content (text, search field etc.) Use this for placing the content within the block.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Text/HTML', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Insert text/HTML here. Notice that only standard HTML tags are allowed by default.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Search field placeholder text', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Placeholder text for the search input field.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Search button text', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Text on the search button.', 'loc-canon-belle'),
									),
								)); 


							 ?>		

						</div>


						<table class='form-table block-feature group-feature-block'>

							<?php

								canon_fw_option(array(
									'type'					=> 'upload',
									'title' 				=> esc_html__('Background image URL', 'loc-canon-belle'),
									'slug' 					=> 'block_search_bg_img_url',
									'btn_text'				=> esc_html__('Select Image', 'loc-canon-belle'),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Background color', 'loc-canon-belle'),
									'slug' 					=> 'block_search_bg_color',
									'options_name'			=> 'canon_options_frame',
								)); 
							
								canon_fw_option(array(
									'type'					=> 'color',
									'title' 				=> esc_html__('Text color', 'loc-canon-belle'),
									'slug' 					=> 'block_search_text_color',
									'options_name'			=> 'canon_options_frame',
								)); 
							
								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Background-attachment', 'loc-canon-belle'),
									'slug' 					=> 'block_search_bg_attachment',
									'colspan'				=> 2,
									'select_options'		=> array(
										'scroll'				=> esc_html__('Scroll', 'loc-canon-belle'),
										'fixed'					=> esc_html__('Fixed', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Background-size', 'loc-canon-belle'),
									'slug' 					=> 'block_search_bg_size',
									'colspan'				=> 2,
									'select_options'		=> array(
										'auto'					=> esc_html__('Auto', 'loc-canon-belle'),
										'cover'					=> esc_html__('Cover', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Search block height', 'loc-canon-belle'),
									'slug' 					=> 'block_search_block_height',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Content top margin', 'loc-canon-belle'),
									'slug' 					=> 'block_search_content_top_margin',
									'min'					=> '0',
									'max'					=> '10000',
									'step'					=> '10',
									'postfix'				=> '<i> (pixels)</i>',
									'width_px'				=> '60',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> esc_html__('Text/HTML', 'loc-canon-belle'),
									'slug' 					=> 'block_search_html',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Search field placeholder text', 'loc-canon-belle'),
									'class'					=> 'widefat',
									'slug' 					=> 'block_search_placeholder',
									'options_name'			=> 'canon_options_frame',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Search button text', 'loc-canon-belle'),
									'class'					=> 'widefat',
									'slug' 					=> 'block_search_btn_text',
									'options_name'			=> 'canon_options_frame',
								)); 


							?>

							<tr valign='top'>

								<th scope='row'><?php esc_html_e("Search in", "loc-canon-belle"); ?></th>
								
								<td>
								
									<select id="block_search_in" name="canon_options_frame[block_search_in]"> 

						     			<option value="all_categories" <?php if ($canon_options_frame['block_search_in'] == "all_categories") { echo "selected='selected'";} ?>><?php esc_html_e("All categories", "loc-canon-belle"); ?></option> 

						     			<option value="all_categories"></option> 

										<?php 
											for ($i = 0; $i < count($cat_list); $i++) { 
											?>
							     				<option value="<?php echo esc_attr($cat_list[$i]->slug); ?>" <?php if ($canon_options_frame['block_search_in'] == $cat_list[$i]->slug) { echo "selected='selected'";} ?>><?php echo esc_attr($cat_list[$i]->name); ?> <?php esc_html_e("category", "loc-canon-belle"); ?></option> 
											<?php
											}
										?>

									</select> 
								
								</td>
							
							</tr>

						</table>







					<!-- BOTTOM OF PAGE -->						
					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

