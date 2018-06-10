	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_html__("Settings", "loc-canon-belle"), esc_html__("Advanced", "loc-canon-belle") ); ?></h2>

		<?php 
			$canon_options_advanced = get_option('canon_options_advanced'); 

			//LOAD OPTIONS
			$canon_options = get_option('canon_options'); 
			$canon_options_frame = get_option('canon_options_frame'); 
			$canon_options_post = get_option('canon_options_post'); 
			$canon_options_appearance = get_option('canon_options_appearance');
			$canon_options_advanced = get_option('canon_options_advanced'); 
			

		////////////////////////////////////////////////
		// IMPORT/EXPORT SETTINGS
		////////////////////////////////////////////////

			//MAKE SUPERARRAY AND ENCODE
			$canon_options_superarray = array(
				'canon_options' => $canon_options,
				'canon_options_frame' => $canon_options_frame,
				'canon_options_post' => $canon_options_post,
				'canon_options_appearance' => $canon_options_appearance,
				'canon_options_advanced' => $canon_options_advanced,

			);
			$encoded_serialized_options_data = canon_fw_filter_sensitive_input(json_encode($canon_options_superarray));

			//IF IMPORT DATA WAS CLICKED
			if ( (isset($canon_options_advanced['import_data'])) && (isset($canon_options_advanced['canon_options_data'])) )  {
				if ($canon_options_advanced['import_data'] == 'IMPORT') {
					
					//get import data (returns false if improper structured data sent)
					$import_superarray = @json_decode(canon_fw_filter_sensitive_output($canon_options_advanced['canon_options_data']), true);

					//only proceed if unserialize succeeded
					if ($import_superarray) {
						//replace old data with new data
						$canon_options = canon_fw_array_replace($canon_options, $import_superarray['canon_options']);
						$canon_options_frame = canon_fw_array_replace($canon_options_frame, $import_superarray['canon_options_frame']);
						$canon_options_post = canon_fw_array_replace($canon_options_post, $import_superarray['canon_options_post']);
						$canon_options_appearance = canon_fw_array_replace($canon_options_appearance, $import_superarray['canon_options_appearance']);
						$canon_options_advanced = canon_fw_array_replace($canon_options_advanced, $import_superarray['canon_options_advanced']);

						//update data to database
						update_option('canon_options', $canon_options);
						update_option('canon_options_frame', $canon_options_frame);
						update_option('canon_options_post', $canon_options_post);
						update_option('canon_options_appearance', $canon_options_appearance);
						update_option('canon_options_advanced', $canon_options_advanced);

						//get data from database (is this not superfluous?)
						$canon_options = get_option('canon_options'); 
						$canon_options_frame = get_option('canon_options_frame'); 
						$canon_options_post = get_option('canon_options_post'); 
						$canon_options_appearance = get_option('canon_options_appearance');
						$canon_options_advanced = get_option('canon_options_advanced'); 

						//display success notice:
						echo '<div class="updated"><p>Settings successfully imported!</p></div>';

					} else {
							
						//display fail notice:
						echo '<div class="error"><p>Import failed!</p></div>';

					}

				}
					
			}


		////////////////////////////////////////////////
		// IMPORT/EXPORT WIDGETS
		////////////////////////////////////////////////

			// MAKE WIDGETS SUPERARRAY
			$canon_widgets_superarray = array();

			// GET AND ADD WIDGET AREAS SUBARRAY
			$widget_areas = get_option('sidebars_widgets');
			$canon_widgets_superarray['widget_areas'] = $widget_areas;

			// CREATE AND ADD ACTIVE WIDGETS SUBARRAY
			$active_widgets = array();
			foreach ($widget_areas as $area_slug => $area_content) {			// first we create an array of active widget slugs
				if (is_array($area_content) && !empty($area_content)) {
					foreach ($area_content as $key => $widget_name) {
						// grab and delete postfix
						$widget_name_explode_array = explode('-', $widget_name);
						$last_index = count($widget_name_explode_array)-1;
						$postfix = "-" . $widget_name_explode_array[$last_index];
						$widget_name = str_replace($postfix, "", $widget_name);
						array_push($active_widgets, $widget_name);
					}
				}
			}
			$active_widgets = array_unique($active_widgets);
			foreach ($active_widgets as $key => $widget_slug) {					// then we convert the array of active widget slugs to an assoc array of active widget slugs and their settings
				$widget_settings_array = get_option('widget_' . $widget_slug);
				$active_widgets[$widget_slug] = $widget_settings_array;
				unset($active_widgets[$key]);

			}
			$canon_widgets_superarray['active_widgets'] = $active_widgets;
			$encoded_serialized_widgets_data = canon_fw_filter_sensitive_input(json_encode($canon_widgets_superarray));

			//IF IMPORT widgetsDATA WAS CLICKED
			if ( (isset($canon_options_advanced['import_widgets_data'])) && (isset($canon_options_advanced['canon_widgets_data'])) )  {
				if ($canon_options_advanced['import_widgets_data'] == 'IMPORT') {
					
					//get import data (returns false if improper structured data sent)
					$import_widgets_superarray = @json_decode(canon_fw_filter_sensitive_output($canon_options_advanced['canon_widgets_data']), true);

					//only proceed if unserialize succeeded
					if ($import_widgets_superarray) {

						// first replace widget areas
						update_option('sidebars_widgets', $import_widgets_superarray['widget_areas']);

						// next replace active widget settings
						foreach ($import_widgets_superarray['active_widgets'] as $widget_slug => $widget_content) {
							update_option('widget_' . $widget_slug, $widget_content);
						}

						// update data to database
						unset($canon_options_advanced['import_widgets_data']);
						unset($canon_options_advanced['canon_widgets_data']);
						update_option('canon_options_advanced', $canon_options_advanced);

						// get data from database (is this not superfluous?)
						$canon_options_advanced = get_option('canon_options_advanced'); 

						//display success notice:
						echo '<div class="updated"><p>Widgets successfully imported!</p></div>';

					} else {
							
						//display fail notice:
						echo '<div class="error"><p>Import failed!</p></div>';

					}

				}
					
			}


		////////////////////////////////////////////////
		// RESET SETTINGS
		////////////////////////////////////////////////

			//RESET BASIC
			if ($canon_options_advanced['reset_basic'] == 'RESET') {
				delete_option('canon_options');
				delete_option('canon_options_frame');
				delete_option('canon_options_post');
				delete_option('canon_options_appearance');

				// clear reset_basic var
				$canon_options_advanced['reset_basic'] = "";
				update_option('canon_options_advanced', $canon_options_advanced);

				// output response
				echo "<script>alert('Basic theme settings have been reset!'); window.location.reload();</script>";
			}


			//RESET ALL
			if ($canon_options_advanced['reset_all'] == 'RESET') {
				delete_option('canon_options');
				delete_option('canon_options_frame');
				delete_option('canon_options_post');
				delete_option('canon_options_appearance');
				delete_option('canon_options_advanced');


				// output response
				echo "<script>alert('All theme settings have been reset!'); window.location.reload();</script>";
			}



		////////////////////////////////////////////////
		// INSTAGRAM OAUTH
		////////////////////////////////////////////////


			// UNSERIALIZE OAUTH FOR USE ON OPTIONS PAGE
			$canon_options_advanced['oauth_instagram'] = @json_decode(canon_fw_filter_sensitive_output($canon_options_advanced['oauth_instagram']), true);

			// DETECT RESET
			if ($canon_options_advanced['reset_oauth_instagram'] == 'RESET') {

				// clear variables
				$canon_options_advanced['oauth_instagram_client_id'] = "";
				$canon_options_advanced['oauth_instagram_client_secret'] = "";
				$canon_options_advanced['oauth_instagram'] = "";

				// clear reset_oauth_instagram var
				$canon_options_advanced['reset_oauth_instagram'] = "";
				update_option('canon_options_advanced', $canon_options_advanced);
				$canon_options_advanced = get_option('canon_options_advanced'); 

				// output response
				echo "<script>alert('Instagram authorization has been reset!'); window.location.reload();</script>";
			}

			// STEP 1: CREATE CLIENT/APP AND GET CLIENT ID+CLIENT SECRET
			$oauth_instagram_error_message = "";
			$oauth_instagram_step = 1;
			$redirect_uri = get_admin_url() . "admin.php?page=handle_canon_options_advanced";

			// STEP 2: USER AUTHORIZES CLIENT AND RETURNS WITH A TEMPORARY CODE
			if ( !empty($canon_options_advanced['oauth_instagram_client_id']) && !empty($canon_options_advanced['oauth_instagram_client_secret']) ) {
				$oauth_instagram_step = 2;
				$oauth_instagram_authorize_uri = sprintf('https://api.instagram.com/oauth/authorize/?client_id=%s&redirect_uri=%s&response_type=code&scope=public_content', esc_attr($canon_options_advanced['oauth_instagram_client_id']), esc_url($redirect_uri));
			}

			// STEP 3: GRAB TEMPORARY CODE AND EXCHANGE IT FOR FINAL OAUTH TOKEN
			if (isset($_GET['code']) && !$canon_options_advanced['oauth_instagram'] && !empty($canon_options_advanced['oauth_instagram_client_id']) && !empty($canon_options_advanced['oauth_instagram_client_secret']) ) {
				$oauth_instagram_step = 3;
				$oauth_instagram_temporary_code = $_GET['code'];

				$oauth_instagram_access_token_uri = "https://api.instagram.com/oauth/access_token";
				$args = array(
					'body' 		=> array(
						'client_id'			=> $canon_options_advanced['oauth_instagram_client_id'],
						'client_secret'		=> $canon_options_advanced['oauth_instagram_client_secret'],
						'grant_type'		=> 'authorization_code',
						'redirect_uri'		=> $redirect_uri,
						'code'				=> $oauth_instagram_temporary_code,
					),
				);

				$response = wp_remote_post($oauth_instagram_access_token_uri, $args);

				if ( is_wp_error( $response ) ) {
					$error = true;
				    $oauth_instagram_error_message .= $response->get_error_message();
						
				} elseif ($response['response']['code'] == 400) {
					
					// IF FAILURE
					$response_body = json_decode($response['body'], true);
					$oauth_instagram_error_message = $response_body['error_message'];

					// IF OLD CODE PARAM ISSUE
					if (strpos($oauth_instagram_error_message, 'No matching code') !== false) {
						$oauth_instagram_error_message .= sprintf(' Try <a href="%s">clearing code</a> or reset.', esc_url($redirect_uri));
					}
						
				} elseif ($response['response']['code'] == 200) {
					
					// IF SUCCESS
					$canon_options_advanced['oauth_instagram'] = json_decode($response['body'], true);
					$canon_options_advanced['oauth_instagram'] = canon_fw_filter_sensitive_input(json_encode($canon_options_advanced['oauth_instagram']));
					update_option('canon_options_advanced', $canon_options_advanced);
					$canon_options_advanced = get_option('canon_options_advanced'); 

					// reload
					echo "<script>window.location.reload();</script>";

				}

			}

			// STEP 4: AUTHORIZED - ACCESS TOKEN IN DATABASE
			if (!empty($canon_options_advanced['oauth_instagram'])) {
				$oauth_instagram_step = 4;	
			}

			// DEBUG
			// printf("OAUTH INSTAGRAM STEP: %s ", esc_attr($oauth_instagram_step));
			// if (isset($response_body)) { var_dump($response_body);; }

			// QUERY API
			// $response = json_decode(wp_remote_retrieve_body(wp_remote_get('https://api.instagram.com/v1/users/self/feed?access_token=' . $canon_options_advanced['oauth_instagram']['access_token'])), true);
			// var_dump($response);



		////////////////////////////////////////////////
		// MISC
		////////////////////////////////////////////////


			// remove template + remove duplicate custom widget areas and rearrange keys
			if (isset($canon_options_advanced['custom_widget_areas'][9999])) { unset($canon_options_advanced['custom_widget_areas'][9999]); }
            $canon_options_advanced['custom_widget_areas'] = array_values($canon_options_advanced['custom_widget_areas']);

			// delete_option('canon_options_advanced');
			// var_dump($canon_options_advanced);

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_advanced'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_advanced'); ?>		

					<?php submit_button(); ?>
					
					<!-- 

						INDEX

						CUSTOM WIDGET AREAS (CWA)
						FINAL CALL CSS
						IMPORT/EXPORT SETTINGS
						IMPORT/EXPORT WIDGETS
						INSTAGRAM AUTHORIZATION
					
					-->


					<!-- 
					--------------------------------------------------------------------------
						CUSTOM WIDGET AREAS (CWA)
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Widget Areas Manager", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php
								
								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Widget Areas Manager', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Here you can create new custom widget areas. Give each widget area a unique name.', 'loc-canon-belle'),
										esc_html__('You can drag and drop to decide the order of which the widget areas will display in the widgets section.', 'loc-canon-belle'),
										wp_kses_post(__('To add widgets to your custom widget areas go to <i>WordPress Appearance > Widgets</i>.', 'loc-canon-belle')),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<tr>

								<th scope='row'></th>
								<td>
									<ul id="cwa_template">

												<!-- TEMPLATE: C/P LI -->
												<?php $i=9999; ?>

												<li>
													<span><?php esc_html_e("Custom Widget Area Name", "loc-canon-belle"); ?>:<span>
													<span class="cwa_del"><a href="#"><?php esc_html_e("Delete", "loc-canon-belle"); ?></a></span>
													<input class='widefat cwa_option' type='text' name='canon_options_advanced[custom_widget_areas][<?php echo esc_attr($i); ?>][name]' value="<?php if (isset($canon_options_advanced['custom_widget_areas'][$i]['name'])) echo htmlspecialchars($canon_options_advanced['custom_widget_areas'][$i]['name']); ?>">
												</li>


									</ul>
								</td>
							</tr>

							<tr>
								<th scope='row'><?php esc_html_e("Custom Widget Areas", "loc-canon-belle"); ?></th>
								<td>
									<ul id="cwa_list" class="cwa_sortable">

										<?php 

											if (isset($canon_options_advanced['custom_widget_areas'])) {

												for ($i = 0; $i < count($canon_options_advanced['custom_widget_areas']); $i++) {  
												?>

												<li>
													<span><?php esc_html_e("Custom Widget Area Name", "loc-canon-belle"); ?>:<span>
													<span class="cwa_del"><a href="#"><?php esc_html_e("Delete", "loc-canon-belle"); ?></a></span>
													<input class='widefat cwa_option' type='text' name='canon_options_advanced[custom_widget_areas][<?php echo esc_attr($i); ?>][name]' value="<?php if (isset($canon_options_advanced['custom_widget_areas'][$i]['name'])) echo htmlspecialchars($canon_options_advanced['custom_widget_areas'][$i]['name']); ?>">
												</li>

												<?php
												}

											}

										?>

									</ul>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="button" class="button button_add_cwa" value="<?php esc_html_e("Create new custom widget area", "loc-canon-belle"); ?>" />
									<br><br>
								</td>
							</tr>




						</table>


					<!-- 
					--------------------------------------------------------------------------
						FINAL CALL CSS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Final Call CSS", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php
								
								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Final call CSS', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Put your own CSS code here. This CSS will be called last and overwrites all theme CSS.', 'loc-canon-belle'),
										wp_kses_post(__('Final call CSS will be exported/imported along with all other theme settings when using the <i>Import/Export</i> option.', 'loc-canon-belle')),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Use final call CSS', 'loc-canon-belle'),
									'slug' 					=> 'use_final_call_css',
									'options_name'			=> 'canon_options_advanced',
								)); 

							?>


							<tr valign='top'>
								<th></th>
								<td colspan="2">
									<textarea id='final_call_css' name='canon_options_advanced[final_call_css]' rows='20' cols='100'><?php if (isset($canon_options_advanced['final_call_css'])) echo htmlentities($canon_options_advanced['final_call_css']); ?></textarea>

								</td>
							</tr>

						</table>




						<table class='form-table'>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						IMPORT/EXPORT SETTINGS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Import/Export Settings", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Import/Export settings', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Use this section to import/export your settings.', 'loc-canon-belle'),
										wp_kses_post(__('<strong>WARNING</strong>: Settings may be overwritten/deleted/replaced. ', 'loc-canon-belle')),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Generate settings data', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Clicking this button will generate settings data. You can copy this data from the settings data window.', 'loc-canon-belle'),
										esc_html__('Clicking the window will select all text.', 'loc-canon-belle'),
										esc_html__('Press CTRL+C on your keyboard or right click selected text and select copy.', 'loc-canon-belle'),
										esc_html__('Once you have copied the data you can either save it to a text document/file (safest) or simply keep the data in your copy/paste clipboard (not safe).', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Import settings data', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Clicking this button will import your settings data from the data string supplied in the settings data window.', 'loc-canon-belle'),
										esc_html__('Make sure you paste all of the data into the settings data textarea/window. If part of the code is altered or left out import will fail.', 'loc-canon-belle'),
										esc_html__('Click the "Import settings data" button.', 'loc-canon-belle'),
										esc_html__('Your setting have now been imported.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Load predefined settings data', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Use this select to load predefined settings data into the data window.', 'loc-canon-belle'),
										esc_html__('Click the "Import settings data" button.', 'loc-canon-belle'),
										esc_html__('The predefined settings have now been imported.', 'loc-canon-belle'),
									),
								)); 

							?>
						</div>

						<table class='form-table import-export'>

							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Settings data", "loc-canon-belle"); ?></th>
								<td colspan="2">
									<textarea id='canon_options_data' class='canon_export_data' name='canon_options_advanced[canon_options_data]' rows='5' cols='100'></textarea>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="hidden" id="import_data" name="canon_options_advanced[import_data]" value="">

									<input type="button" class="button button_generate_data" value="Generate settings data" data-export_data="<?php echo esc_attr($encoded_serialized_options_data); ?>" />
									<button id="button_import_data" name="button_import_data" class="button-secondary"><?php esc_html_e("Import settings data", "loc-canon-belle"); ?></button>
								</td>

								<td class="float-right">
									<select class="predefined-data-select">
							     		<option value="" selected='selected'><?php esc_html_e('Load predefined settings data...', 'loc-canon-belle'); ?></option> 
							     		
							     		<option value="{¤(dq)¤canon_options¤(dq)¤:{¤(dq)¤dev_mode¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤dev_mockup_structure¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤dev_controller_classes¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤use_responsive_design¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤use_boxed_design¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤use_maintenance_mode¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤maintenance_msg¤(dq)¤:¤(dq)¤We are busy doing maintenance - please check back later!¤(dq)¤,¤(dq)¤read_more_text¤(dq)¤:¤(dq)¤Continue Reading¤(dq)¤,¤(dq)¤sidebars_alignment¤(dq)¤:¤(dq)¤right¤(dq)¤,¤(dq)¤back_to_top_button¤(dq)¤:¤(dq)¤prefooter¤(dq)¤,¤(dq)¤overlay_header¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤overlay_content_negative_margin¤(dq)¤:¤(dq)¤-291¤(dq)¤,¤(dq)¤overlay_header_turn_off_width¤(dq)¤:¤(dq)¤0¤(dq)¤,¤(dq)¤overlay_content_turn_off_width¤(dq)¤:¤(dq)¤0¤(dq)¤,¤(dq)¤image_sizes¤(dq)¤:{¤(dq)¤canon_post_component_carousel¤(dq)¤:{¤(dq)¤width¤(dq)¤:¤(dq)¤700¤(dq)¤,¤(dq)¤height¤(dq)¤:¤(dq)¤420¤(dq)¤,¤(dq)¤ratio¤(dq)¤:¤(dq)¤1.67¤(dq)¤},¤(dq)¤canon_block_post_grid_6wide¤(dq)¤:{¤(dq)¤width¤(dq)¤:¤(dq)¤900¤(dq)¤,¤(dq)¤height¤(dq)¤:¤(dq)¤625¤(dq)¤,¤(dq)¤ratio¤(dq)¤:¤(dq)¤1.94¤(dq)¤},¤(dq)¤canon_block_post_grid_3wide¤(dq)¤:{¤(dq)¤width¤(dq)¤:¤(dq)¤1267¤(dq)¤,¤(dq)¤height¤(dq)¤:¤(dq)¤654¤(dq)¤,¤(dq)¤ratio¤(dq)¤:¤(dq)¤1.94¤(dq)¤},¤(dq)¤canon_block_post_grid_6tall¤(dq)¤:{¤(dq)¤width¤(dq)¤:¤(dq)¤1267¤(dq)¤,¤(dq)¤height¤(dq)¤:¤(dq)¤654¤(dq)¤,¤(dq)¤ratio¤(dq)¤:¤(dq)¤1.94¤(dq)¤},¤(dq)¤canon_block_carousel¤(dq)¤:{¤(dq)¤width¤(dq)¤:¤(dq)¤1200¤(dq)¤,¤(dq)¤height¤(dq)¤:¤(dq)¤768¤(dq)¤,¤(dq)¤ratio¤(dq)¤:¤(dq)¤1.78¤(dq)¤},¤(dq)¤canon_even_grid¤(dq)¤:{¤(dq)¤width¤(dq)¤:¤(dq)¤970¤(dq)¤,¤(dq)¤height¤(dq)¤:¤(dq)¤546¤(dq)¤,¤(dq)¤ratio¤(dq)¤:¤(dq)¤1.78¤(dq)¤},¤(dq)¤canon_grid_gallery_landscape¤(dq)¤:{¤(dq)¤width¤(dq)¤:¤(dq)¤600¤(dq)¤,¤(dq)¤height¤(dq)¤:¤(dq)¤361¤(dq)¤,¤(dq)¤ratio¤(dq)¤:¤(dq)¤1.66¤(dq)¤},¤(dq)¤canon_grid_gallery_portrait¤(dq)¤:{¤(dq)¤width¤(dq)¤:¤(dq)¤500¤(dq)¤,¤(dq)¤height¤(dq)¤:¤(dq)¤602¤(dq)¤,¤(dq)¤ratio¤(dq)¤:¤(dq)¤0.83¤(dq)¤}},¤(dq)¤autocomplete_words¤(dq)¤:¤(dq)¤c++, jquery, I like jQuery, java, php, coldfusion, javascript, asp, ruby¤(dq)¤,¤(dq)¤hide_theme_meta_description¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤hide_theme_og¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤fontface_fix¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤favicon_url¤(dq)¤:¤(dq)¤¤(dq)¤},¤(dq)¤canon_options_frame¤(dq)¤:{¤(dq)¤header_pre_layout¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤header_pre_custom_left¤(dq)¤:¤(dq)¤header_text¤(dq)¤,¤(dq)¤header_pre_custom_right¤(dq)¤:¤(dq)¤social¤(dq)¤,¤(dq)¤header_main_layout¤(dq)¤:¤(dq)¤header_main_custom_center¤(dq)¤,¤(dq)¤header_main_custom_center¤(dq)¤:¤(dq)¤logo¤(dq)¤,¤(dq)¤header_post_layout¤(dq)¤:¤(dq)¤header_post_custom_center¤(dq)¤,¤(dq)¤homepage_feature_layout¤(dq)¤:¤(dq)¤block_slider¤(dq)¤,¤(dq)¤footer_pre_layout¤(dq)¤:¤(dq)¤footer_pre_custom_left_right¤(dq)¤,¤(dq)¤footer_pre_custom_left¤(dq)¤:¤(dq)¤aux_logo¤(dq)¤,¤(dq)¤footer_pre_custom_right¤(dq)¤:¤(dq)¤secondary¤(dq)¤,¤(dq)¤footer_main_layout¤(dq)¤:¤(dq)¤block_widgets¤(dq)¤,¤(dq)¤footer_post_layout¤(dq)¤:¤(dq)¤footer_post_custom_left_right¤(dq)¤,¤(dq)¤footer_post_custom_left¤(dq)¤:¤(dq)¤footer_text¤(dq)¤,¤(dq)¤footer_post_custom_right¤(dq)¤:¤(dq)¤social¤(dq)¤,¤(dq)¤use_boxed_header¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤use_sticky_preheader¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤use_sticky_header¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤use_sticky_postheader¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤preheader_opacity¤(dq)¤:¤(dq)¤1¤(dq)¤,¤(dq)¤header_opacity¤(dq)¤:¤(dq)¤1¤(dq)¤,¤(dq)¤postheader_opacity¤(dq)¤:¤(dq)¤1¤(dq)¤,¤(dq)¤sticky_turn_off_width¤(dq)¤:¤(dq)¤768¤(dq)¤,¤(dq)¤add_search_btn_to_primary¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤add_search_btn_to_secondary¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤header_padding_top¤(dq)¤:¤(dq)¤20¤(dq)¤,¤(dq)¤header_padding_bottom¤(dq)¤:¤(dq)¤20¤(dq)¤,¤(dq)¤pos_left_element_top¤(dq)¤:¤(dq)¤0¤(dq)¤,¤(dq)¤pos_left_element_left¤(dq)¤:¤(dq)¤0¤(dq)¤,¤(dq)¤pos_right_element_top¤(dq)¤:¤(dq)¤12¤(dq)¤,¤(dq)¤pos_right_element_right¤(dq)¤:¤(dq)¤0¤(dq)¤,¤(dq)¤prefooter_padding_top¤(dq)¤:¤(dq)¤20¤(dq)¤,¤(dq)¤prefooter_padding_bottom¤(dq)¤:¤(dq)¤20¤(dq)¤,¤(dq)¤prefooter_pos_left_element_top¤(dq)¤:¤(dq)¤0¤(dq)¤,¤(dq)¤prefooter_pos_left_element_left¤(dq)¤:¤(dq)¤0¤(dq)¤,¤(dq)¤prefooter_pos_right_element_top¤(dq)¤:¤(dq)¤10¤(dq)¤,¤(dq)¤prefooter_pos_right_element_right¤(dq)¤:¤(dq)¤0¤(dq)¤,¤(dq)¤logo_url¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤logo_max_width¤(dq)¤:¤(dq)¤193¤(dq)¤,¤(dq)¤logo_text¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤logo_text_append_tagline¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤logo_text_size¤(dq)¤:¤(dq)¤28¤(dq)¤,¤(dq)¤tagline_text_size¤(dq)¤:¤(dq)¤12¤(dq)¤,¤(dq)¤aux_logo_url¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤aux_logo_max_width¤(dq)¤:¤(dq)¤97¤(dq)¤,¤(dq)¤header_img_homepage_only¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤header_img_url¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤header_img_bg_color¤(dq)¤:¤(dq)¤#141312¤(dq)¤,¤(dq)¤header_img_height¤(dq)¤:¤(dq)¤400¤(dq)¤,¤(dq)¤header_img_parallax_amount¤(dq)¤:¤(dq)¤50¤(dq)¤,¤(dq)¤header_img_text¤(dq)¤:¤(dq)¤¤(lt)¤h3¤(gt)¤Header Image With Parallax Scrolling - What¤(sq)¤s Not To Like!¤(lt)¤¤(bs)¤/h3¤(gt)¤[button]Buy Belle Today[¤(bs)¤/button]¤(dq)¤,¤(dq)¤header_img_text_alignment¤(dq)¤:¤(dq)¤centered¤(dq)¤,¤(dq)¤header_img_text_margin_top¤(dq)¤:¤(dq)¤150¤(dq)¤,¤(dq)¤banner_code¤(dq)¤:¤(dq)¤¤(lt)¤a href=¤(sq)¤http:¤(bs)¤/¤(bs)¤/www.themeforest.com¤(bs)¤/?ref=themecanon¤(sq)¤ target=¤(sq)¤_blank¤(sq)¤¤(gt)¤¤(lt)¤img src=¤(sq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/themes¤(bs)¤/belle¤(bs)¤/img¤(bs)¤/banner_468x60.gif¤(sq)¤¤(gt)¤¤(lt)¤¤(bs)¤/a¤(gt)¤¤(dq)¤,¤(dq)¤header_text¤(dq)¤:¤(dq)¤¤(lt)¤em class=¤(bs)¤¤(dq)¤fa fa-pencil¤(bs)¤¤(dq)¤¤(gt)¤¤(lt)¤¤(bs)¤/em¤(gt)¤ Smart Personal Blogging¤(dq)¤,¤(dq)¤footer_text¤(dq)¤:¤(dq)¤¤(bs)¤u00a9 Copyright Belle by ¤(lt)¤a href=¤(bs)¤¤(dq)¤http:¤(bs)¤/¤(bs)¤/www.themecanon.com¤(bs)¤¤(dq)¤ target=¤(bs)¤¤(dq)¤_blank¤(bs)¤¤(dq)¤¤(gt)¤Theme Canon¤(lt)¤¤(bs)¤/a¤(gt)¤¤(dq)¤,¤(dq)¤toolbar_search_button¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤countdown_datetime_string¤(dq)¤:¤(dq)¤December 31, 2023 23:59:59¤(dq)¤,¤(dq)¤countdown_gmt_offset¤(dq)¤:¤(dq)¤+10¤(dq)¤,¤(dq)¤countdown_description¤(dq)¤:¤(dq)¤Next Event: ¤(dq)¤,¤(dq)¤social_in_new¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤social_links¤(dq)¤:[[¤(dq)¤fa-facebook-square¤(dq)¤,¤(dq)¤https:¤(bs)¤/¤(bs)¤/www.facebook.com¤(bs)¤/themecanon¤(dq)¤],[¤(dq)¤fa-twitter-square¤(dq)¤,¤(dq)¤https:¤(bs)¤/¤(bs)¤/twitter.com¤(bs)¤/ThemeCanon¤(dq)¤],[¤(dq)¤fa-rss-square¤(dq)¤,¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/feed¤(bs)¤/¤(dq)¤]],¤(dq)¤block_post_grid_shows¤(dq)¤:¤(dq)¤latest_posts¤(dq)¤,¤(dq)¤block_post_grid_layout¤(dq)¤:¤(dq)¤6wide¤(dq)¤,¤(dq)¤block_post_grid_animation¤(dq)¤:¤(dq)¤simple¤(dq)¤,¤(dq)¤block_post_grid_anim_delay¤(dq)¤:¤(dq)¤400¤(dq)¤,¤(dq)¤block_post_grid_anim_speed¤(dq)¤:¤(dq)¤3000¤(dq)¤,¤(dq)¤block_slider_alias¤(dq)¤:¤(dq)¤Post-Slider¤(dq)¤,¤(dq)¤block_slider_boxed¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤block_carousel_shows¤(dq)¤:¤(dq)¤latest_posts¤(dq)¤,¤(dq)¤block_carousel_show_featured_image¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤block_carousel_show_title¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤block_carousel_show_excerpt¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤block_carousel_display_num_posts¤(dq)¤:¤(dq)¤4¤(dq)¤,¤(dq)¤block_carousel_num_posts¤(dq)¤:¤(dq)¤15¤(dq)¤,¤(dq)¤block_carousel_excerpt_length¤(dq)¤:¤(dq)¤130¤(dq)¤,¤(dq)¤block_carousel_autoplay_speed¤(dq)¤:¤(dq)¤3000¤(dq)¤,¤(dq)¤block_carousel_stop_on_hover¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤block_carousel_pagination¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤block_instagram_carousel_shows¤(dq)¤:¤(dq)¤recent¤(dq)¤,¤(dq)¤block_instagram_carousel_user_id¤(dq)¤:null,¤(dq)¤block_instagram_carousel_tag¤(dq)¤:¤(dq)¤wordpress¤(dq)¤,¤(dq)¤block_instagram_carousel_display_num_posts¤(dq)¤:¤(dq)¤5¤(dq)¤,¤(dq)¤block_instagram_carousel_num_posts¤(dq)¤:¤(dq)¤15¤(dq)¤,¤(dq)¤block_instagram_carousel_excerpt_length¤(dq)¤:¤(dq)¤100¤(dq)¤,¤(dq)¤block_instagram_carousel_autoplay_speed¤(dq)¤:¤(dq)¤3000¤(dq)¤,¤(dq)¤block_instagram_carousel_stop_on_hover¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤block_instagram_carousel_pagination¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤block_widgets_boxed¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤block_search_bg_color¤(dq)¤:¤(dq)¤#9189a4¤(dq)¤,¤(dq)¤block_search_text_color¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤block_search_bg_attachment¤(dq)¤:¤(dq)¤scroll¤(dq)¤,¤(dq)¤block_search_bg_size¤(dq)¤:¤(dq)¤cover¤(dq)¤,¤(dq)¤block_search_block_height¤(dq)¤:¤(dq)¤750¤(dq)¤,¤(dq)¤block_search_content_top_margin¤(dq)¤:¤(dq)¤200¤(dq)¤,¤(dq)¤block_search_html¤(dq)¤:¤(dq)¤¤(lt)¤h1¤(gt)¤Search ¤(lt)¤b¤(gt)¤Specific Categories¤(lt)¤¤(bs)¤/b¤(gt)¤¤(lt)¤¤(bs)¤/h1¤(gt)¤¤(bs)¤r¤(bs)¤n¤(lt)¤p¤(gt)¤Search my blog of literary masterpieces.¤(lt)¤¤(bs)¤/p¤(gt)¤¤(dq)¤,¤(dq)¤block_search_placeholder¤(dq)¤:¤(dq)¤Search For Posts¤(dq)¤,¤(dq)¤block_search_btn_text¤(dq)¤:¤(dq)¤Search¤(dq)¤,¤(dq)¤block_search_in¤(dq)¤:¤(dq)¤all_categories¤(dq)¤,¤(dq)¤header_pre_custom_center¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤header_main_custom_left¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤header_main_custom_right¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤header_post_custom_center¤(dq)¤:¤(dq)¤primary¤(dq)¤,¤(dq)¤header_post_custom_left¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤header_post_custom_right¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤footer_pre_custom_center¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤footer_post_custom_center¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤block_search_bg_img_url¤(dq)¤:¤(dq)¤¤(dq)¤},¤(dq)¤canon_options_post¤(dq)¤:{¤(dq)¤homepage_layout¤(dq)¤:¤(dq)¤masonry_sidebar¤(dq)¤,¤(dq)¤homepage_num_columns¤(dq)¤:¤(dq)¤2¤(dq)¤,¤(dq)¤homepage_sidebar¤(dq)¤:¤(dq)¤canon_archive_sidebar_widget_area¤(dq)¤,¤(dq)¤homepage_drop_cap¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤homepage_excerpt_length¤(dq)¤:¤(dq)¤150¤(dq)¤,¤(dq)¤homepage_pagination¤(dq)¤:¤(dq)¤loadmore_ajax¤(dq)¤,¤(dq)¤cat_layout¤(dq)¤:¤(dq)¤masonry_sidebar¤(dq)¤,¤(dq)¤cat_num_columns¤(dq)¤:¤(dq)¤2¤(dq)¤,¤(dq)¤cat_sidebar¤(dq)¤:¤(dq)¤canon_archive_sidebar_widget_area¤(dq)¤,¤(dq)¤cat_drop_cap¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤cat_excerpt_length¤(dq)¤:¤(dq)¤150¤(dq)¤,¤(dq)¤show_cat_title¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤show_cat_description¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤cat_pagination¤(dq)¤:¤(dq)¤loadmore_ajax¤(dq)¤,¤(dq)¤archive_layout¤(dq)¤:¤(dq)¤classic_sidebar¤(dq)¤,¤(dq)¤archive_num_columns¤(dq)¤:¤(dq)¤3¤(dq)¤,¤(dq)¤archive_sidebar¤(dq)¤:¤(dq)¤canon_archive_sidebar_widget_area¤(dq)¤,¤(dq)¤archive_drop_cap¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤archive_excerpt_length¤(dq)¤:¤(dq)¤150¤(dq)¤,¤(dq)¤archive_pagination¤(dq)¤:¤(dq)¤loadmore_ajax¤(dq)¤,¤(dq)¤page_show_comments¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤single_default_post_style¤(dq)¤:¤(dq)¤compact_sidebar¤(dq)¤,¤(dq)¤single_use_dropcap¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤show_tags¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_comments¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_post_nav¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤post_nav_same_cat¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤post_component_ad_code¤(dq)¤:¤(dq)¤¤(lt)¤a href=¤(sq)¤http:¤(bs)¤/¤(bs)¤/www.themeforest.com¤(bs)¤/?ref=themecanon¤(sq)¤ target=¤(sq)¤_blank¤(sq)¤¤(gt)¤¤(lt)¤img src=¤(sq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/themes¤(bs)¤/belle¤(bs)¤/img¤(bs)¤/ad-example-2.png¤(sq)¤ alt=¤(sq)¤Advertisement¤(sq)¤¤(gt)¤¤(lt)¤¤(bs)¤/a¤(gt)¤¤(dq)¤,¤(dq)¤show_meta_categories¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_meta_author¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_meta_date¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_meta_comments¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_meta_likes¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_meta_views¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_share_link_facebook¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_share_link_twitter¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_share_link_google_plus¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_share_link_pinterest¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤archive_header_padding_top¤(dq)¤:¤(dq)¤100¤(dq)¤,¤(dq)¤archive_header_padding_bottom¤(dq)¤:¤(dq)¤100¤(dq)¤,¤(dq)¤search_box_text¤(dq)¤:¤(dq)¤What are you looking for?¤(dq)¤,¤(dq)¤search_posts¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤search_pages¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤search_cpt¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤search_cpt_source¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤search_widget_area_1¤(dq)¤:¤(dq)¤canon_cwa_search-widget-area-1¤(dq)¤,¤(dq)¤search_widget_area_2¤(dq)¤:¤(dq)¤canon_cwa_search-widget-area-2¤(dq)¤,¤(dq)¤search_widget_area_3¤(dq)¤:¤(dq)¤canon_cwa_search-widget-area-3¤(dq)¤,¤(dq)¤search_widget_area_4¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤search_widget_area_5¤(dq)¤:¤(dq)¤off¤(dq)¤,¤(dq)¤404_layout¤(dq)¤:¤(dq)¤full¤(dq)¤,¤(dq)¤404_sidebar¤(dq)¤:¤(dq)¤canon_page_sidebar_widget_area¤(dq)¤,¤(dq)¤404_title¤(dq)¤:¤(dq)¤Page not found¤(dq)¤,¤(dq)¤404_msg¤(dq)¤:¤(dq)¤Sorry, you¤(sq)¤re lost my friend, the page you¤(sq)¤re looking for does not exist anymore. Take your luck at searching for a new one.¤(dq)¤,¤(dq)¤archive_ads¤(dq)¤:[{¤(dq)¤append_to_posts¤(dq)¤:¤(dq)¤3¤(dq)¤,¤(dq)¤ad_code¤(dq)¤:¤(dq)¤¤(lt)¤a href=¤(bs)¤¤(dq)¤#¤(bs)¤¤(dq)¤ class=¤(bs)¤¤(dq)¤col-1-2¤(bs)¤¤(dq)¤¤(gt)¤¤(bs)¤r¤(bs)¤n¤(lt)¤img src=¤(bs)¤¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/themes¤(bs)¤/belle¤(bs)¤/img¤(bs)¤/ads¤(bs)¤/468x60.png¤(bs)¤¤(dq)¤ alt=¤(bs)¤¤(dq)¤Advertisement¤(bs)¤¤(dq)¤ ¤(bs)¤/¤(gt)¤¤(bs)¤r¤(bs)¤n¤(lt)¤¤(bs)¤/a¤(gt)¤¤(bs)¤r¤(bs)¤n¤(bs)¤t¤(bs)¤t¤(bs)¤t¤(bs)¤t¤(bs)¤r¤(bs)¤n¤(lt)¤a href=¤(bs)¤¤(dq)¤#¤(bs)¤¤(dq)¤ class=¤(bs)¤¤(dq)¤col-1-2 last¤(bs)¤¤(dq)¤¤(gt)¤¤(bs)¤r¤(bs)¤n¤(lt)¤img src=¤(bs)¤¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/themes¤(bs)¤/belle¤(bs)¤/img¤(bs)¤/ads¤(bs)¤/468x60.png¤(bs)¤¤(dq)¤ alt=¤(bs)¤¤(dq)¤Advertisement¤(bs)¤¤(dq)¤ ¤(bs)¤/¤(gt)¤¤(bs)¤r¤(bs)¤n¤(lt)¤¤(bs)¤/a¤(gt)¤¤(dq)¤,¤(dq)¤show_ad_homepage¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤show_ad_category¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤show_ad_archive¤(dq)¤:¤(dq)¤unchecked¤(dq)¤},{¤(dq)¤append_to_posts¤(dq)¤:¤(dq)¤5, 12¤(dq)¤,¤(dq)¤ad_code¤(dq)¤:¤(dq)¤¤(lt)¤a href=¤(sq)¤http:¤(bs)¤/¤(bs)¤/www.themeforest.com¤(bs)¤/?ref=themecanon¤(sq)¤ target=¤(sq)¤_blank¤(sq)¤¤(gt)¤¤(lt)¤img src=¤(sq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/themes¤(bs)¤/belle¤(bs)¤/img¤(bs)¤/ad-example-2.png¤(sq)¤ alt=¤(sq)¤Advertisement¤(sq)¤¤(gt)¤¤(lt)¤¤(bs)¤/a¤(gt)¤¤(dq)¤,¤(dq)¤show_ad_homepage¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤show_ad_category¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤show_ad_archive¤(dq)¤:¤(dq)¤unchecked¤(dq)¤}],¤(dq)¤revslider_clean_ui¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤use_woocommerce_sidebar¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤woocommerce_sidebar¤(dq)¤:¤(dq)¤canon_cwa_shop¤(dq)¤,¤(dq)¤woocommerce_shop_slider¤(dq)¤:¤(dq)¤shop_carousel¤(dq)¤,¤(dq)¤archive_header_image_default¤(dq)¤:¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/uploads¤(bs)¤/2016¤(bs)¤/03¤(bs)¤/lake.jpg¤(dq)¤,¤(dq)¤archive_header_cat_fashion¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤archive_header_cat_featured¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤archive_header_cat_layout¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤archive_header_cat_personal¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤archive_header_cat_uncategorized¤(dq)¤:¤(dq)¤¤(dq)¤},¤(dq)¤canon_options_appearance¤(dq)¤:{¤(dq)¤body_skin_class¤(dq)¤:¤(dq)¤tc-belle-1¤(dq)¤,¤(dq)¤color_body¤(dq)¤:¤(dq)¤#f8f8f8¤(dq)¤,¤(dq)¤color_plate¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_main_text¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_main_headings¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_links¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_links_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_like¤(dq)¤:¤(dq)¤#f15292¤(dq)¤,¤(dq)¤color_white_text¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_btn¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_btn_hover¤(dq)¤:¤(dq)¤#358d90¤(dq)¤,¤(dq)¤color_btn_text¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_btn_text_hover¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_feat_color¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_feat_overlay_color¤(dq)¤:¤(dq)¤#1d2121¤(dq)¤,¤(dq)¤color_feat_overtext_color¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_meta¤(dq)¤:¤(dq)¤#b8babd¤(dq)¤,¤(dq)¤color_drops¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_pre_header¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_pre_header_text¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_pre_header_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_pre_header_menus¤(dq)¤:¤(dq)¤#f8f8f8¤(dq)¤,¤(dq)¤color_pre_header_line¤(dq)¤:¤(dq)¤#e7e7e7¤(dq)¤,¤(dq)¤color_header¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_header_stuck¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_header_text¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_header_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_header_menus_2nd¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_header_menus¤(dq)¤:¤(dq)¤#f8f8f8¤(dq)¤,¤(dq)¤color_header_line¤(dq)¤:¤(dq)¤#e7e7e7¤(dq)¤,¤(dq)¤color_post_header¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_post_header_text¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_post_header_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_post_header_menus¤(dq)¤:¤(dq)¤#f8f8f8¤(dq)¤,¤(dq)¤color_post_header_line¤(dq)¤:¤(dq)¤#e7e7e7¤(dq)¤,¤(dq)¤color_search_bg¤(dq)¤:¤(dq)¤#1d2121¤(dq)¤,¤(dq)¤color_search_text¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_search_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_search_line¤(dq)¤:¤(dq)¤#3c4242¤(dq)¤,¤(dq)¤color_sidr¤(dq)¤:¤(dq)¤#191c20¤(dq)¤,¤(dq)¤color_sidr_text¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_sidr_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_sidr_line¤(dq)¤:¤(dq)¤#23272c¤(dq)¤,¤(dq)¤color_borders¤(dq)¤:¤(dq)¤#e7e7e7¤(dq)¤,¤(dq)¤color_second_plate¤(dq)¤:¤(dq)¤#f8f8f8¤(dq)¤,¤(dq)¤color_fields¤(dq)¤:¤(dq)¤#f8f8f8¤(dq)¤,¤(dq)¤color_feat_area¤(dq)¤:¤(dq)¤#f8f8f8¤(dq)¤,¤(dq)¤color_feat_area_text¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_feat_area_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_feat_car_text¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_feat_car_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_feat_area_borders¤(dq)¤:¤(dq)¤#e7e7e7¤(dq)¤,¤(dq)¤color_footfeat_area¤(dq)¤:¤(dq)¤#323638¤(dq)¤,¤(dq)¤color_footfeat_area_text¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_footfeat_area_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_footfeat_area_borders¤(dq)¤:¤(dq)¤#54585a¤(dq)¤,¤(dq)¤color_pre_footer¤(dq)¤:¤(dq)¤#ffffff¤(dq)¤,¤(dq)¤color_pre_footer_text¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤color_pre_footer_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_pre_footer_line¤(dq)¤:¤(dq)¤#e7e7e7¤(dq)¤,¤(dq)¤color_baseline¤(dq)¤:¤(dq)¤#25292b¤(dq)¤,¤(dq)¤color_baseline_text¤(dq)¤:¤(dq)¤#b8babd¤(dq)¤,¤(dq)¤color_baseline_text_hover¤(dq)¤:¤(dq)¤#7db2b4¤(dq)¤,¤(dq)¤color_logo¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤bg_img_url¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤bg_link¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤bg_size¤(dq)¤:¤(dq)¤auto¤(dq)¤,¤(dq)¤bg_repeat¤(dq)¤:¤(dq)¤repeat¤(dq)¤,¤(dq)¤bg_attachment¤(dq)¤:¤(dq)¤scroll¤(dq)¤,¤(dq)¤lightbox_overlay_color¤(dq)¤:¤(dq)¤#000000¤(dq)¤,¤(dq)¤lightbox_overlay_opacity¤(dq)¤:¤(dq)¤0.7¤(dq)¤,¤(dq)¤font_main¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_heading¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_heading2¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_heading_italic¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_heading_strong¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_heading2_italic¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_heading2_strong¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_nav¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_meta¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_tags¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_button¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_dropcap¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_quote¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_logotext¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_lead¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_bold¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_italic¤(dq)¤:[¤(dq)¤canon_default¤(dq)¤,¤(dq)¤¤(dq)¤,¤(dq)¤¤(dq)¤],¤(dq)¤font_size_root¤(dq)¤:100,¤(dq)¤anim_img_slider_slideshow¤(dq)¤:¤(dq)¤unchecked¤(dq)¤,¤(dq)¤anim_img_slider_delay¤(dq)¤:¤(dq)¤5000¤(dq)¤,¤(dq)¤anim_img_slider_anim_duration¤(dq)¤:¤(dq)¤800¤(dq)¤,¤(dq)¤anim_quote_slider_slideshow¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤anim_quote_slider_delay¤(dq)¤:¤(dq)¤5000¤(dq)¤,¤(dq)¤anim_quote_slider_anim_duration¤(dq)¤:¤(dq)¤800¤(dq)¤,¤(dq)¤anim_menus¤(dq)¤:¤(dq)¤anim_menus_off¤(dq)¤,¤(dq)¤anim_menus_enter¤(dq)¤:¤(dq)¤left¤(dq)¤,¤(dq)¤anim_menus_move¤(dq)¤:40,¤(dq)¤anim_menus_duration¤(dq)¤:600,¤(dq)¤anim_menus_delay¤(dq)¤:150},¤(dq)¤canon_options_advanced¤(dq)¤:{¤(dq)¤reset_all¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤reset_basic¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤custom_widget_areas¤(dq)¤:{¤(dq)¤9999¤(dq)¤:{¤(dq)¤name¤(dq)¤:¤(dq)¤¤(dq)¤},¤(dq)¤0¤(dq)¤:{¤(dq)¤name¤(dq)¤:¤(dq)¤Search Widget Area 1¤(dq)¤},¤(dq)¤1¤(dq)¤:{¤(dq)¤name¤(dq)¤:¤(dq)¤Search Widget Area 2¤(dq)¤},¤(dq)¤2¤(dq)¤:{¤(dq)¤name¤(dq)¤:¤(dq)¤Search Widget Area 3¤(dq)¤},¤(dq)¤3¤(dq)¤:{¤(dq)¤name¤(dq)¤:¤(dq)¤Search Widget Area 4¤(dq)¤},¤(dq)¤4¤(dq)¤:{¤(dq)¤name¤(dq)¤:¤(dq)¤Search Widget Area 5¤(dq)¤},¤(dq)¤5¤(dq)¤:{¤(dq)¤name¤(dq)¤:¤(dq)¤Shop¤(dq)¤}},¤(dq)¤use_final_call_css¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤oauth_instagram_client_id¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤oauth_instagram_client_secret¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤oauth_instagram¤(dq)¤:¤(dq)¤null¤(dq)¤,¤(dq)¤reset_oauth_instagram¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤final_call_css¤(dq)¤:¤(dq)¤div.single-item.ad,¤(bs)¤r¤(bs)¤n.single-item.post.tag-fullwidth{¤(bs)¤r¤(bs)¤n    width: 100%;¤(bs)¤r¤(bs)¤n}¤(dq)¤,¤(dq)¤canon_options_data¤(dq)¤:¤(dq)¤{¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_options¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4dev_mode¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4dev_mockup_structure¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4dev_controller_classes¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_responsive_design¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_boxed_design¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_maintenance_mode¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4maintenance_msg¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4We are busy doing maintenance - please check back later!¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4read_more_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Continue Reading¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4sidebars_alignment¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4right¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4back_to_top_button¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4prefooter¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4overlay_header¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4overlay_content_negative_margin¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4-291¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4overlay_header_turn_off_width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4overlay_content_turn_off_width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4image_sizes¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_post_component_carousel¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4700¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4420¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ratio¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41.67¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_block_post_grid_6wide¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4900¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4625¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ratio¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41.94¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_block_post_grid_3wide¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41267¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4654¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ratio¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41.94¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_block_post_grid_6tall¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41267¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4654¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ratio¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41.94¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_block_carousel¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41200¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4768¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ratio¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41.78¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_even_grid¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4970¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4546¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ratio¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41.78¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_grid_gallery_landscape¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4600¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4361¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ratio¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41.66¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_grid_gallery_portrait¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4500¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4602¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ratio¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40.83¤(bs)¤u00a4(dq)¤(bs)¤u00a4}},¤(bs)¤u00a4(dq)¤(bs)¤u00a4autocomplete_words¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4c++, jquery, I like jQuery, java, php, coldfusion, javascript, asp, ruby¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4hide_theme_meta_description¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4hide_theme_og¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4fontface_fix¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4favicon_url¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_options_frame¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_pre_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_pre_custom_left¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_pre_custom_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4social¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_main_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_main_custom_center¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_main_custom_center¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4logo¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_post_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_post_custom_center¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4homepage_feature_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_slider¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_pre_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_pre_custom_left_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_pre_custom_left¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4aux_logo¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_pre_custom_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4secondary¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_main_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_widgets¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_post_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_post_custom_left_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_post_custom_left¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_post_custom_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4social¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_boxed_header¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_sticky_preheader¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_sticky_header¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_sticky_postheader¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4preheader_opacity¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_opacity¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4postheader_opacity¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a41¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4sticky_turn_off_width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4768¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4add_search_btn_to_primary¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4add_search_btn_to_secondary¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_padding_top¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a420¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_padding_bottom¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a420¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4pos_left_element_top¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4pos_left_element_left¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4pos_right_element_top¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a412¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4pos_right_element_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4prefooter_padding_top¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a420¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4prefooter_padding_bottom¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a420¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4prefooter_pos_left_element_top¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4prefooter_pos_left_element_left¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4prefooter_pos_right_element_top¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a410¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4prefooter_pos_right_element_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4logo_url¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4logo_max_width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4193¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4logo_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4logo_text_append_tagline¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4logo_text_size¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a428¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4tagline_text_size¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a412¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4aux_logo_url¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4aux_logo_max_width¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a497¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_img_homepage_only¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_img_url¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_img_bg_color¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#141312¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_img_height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4400¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_img_parallax_amount¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a450¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_img_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4h3¤(bs)¤u00a4(gt)¤(bs)¤u00a4Header Image With Parallax Scrolling - What¤(bs)¤u00a4(sq)¤(bs)¤u00a4s Not To Like!¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/h3¤(bs)¤u00a4(gt)¤(bs)¤u00a4[button]Buy Belle Today[¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/button]¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_img_text_alignment¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4centered¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_img_text_margin_top¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4150¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4banner_code¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4a href=¤(bs)¤u00a4(sq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/www.themeforest.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/?ref=themecanon¤(bs)¤u00a4(sq)¤(bs)¤u00a4 target=¤(bs)¤u00a4(sq)¤(bs)¤u00a4_blank¤(bs)¤u00a4(sq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4img src=¤(bs)¤u00a4(sq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/wp-content¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themes¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/img¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/banner_468x60.gif¤(bs)¤u00a4(sq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/a¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4em class=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4fa fa-pencil¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/em¤(bs)¤u00a4(gt)¤(bs)¤u00a4 Smart Personal Blogging¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4u00a9 Copyright Belle by ¤(bs)¤u00a4(lt)¤(bs)¤u00a4a href=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/www.themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4 target=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4_blank¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4Theme Canon¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/a¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4toolbar_search_button¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4countdown_datetime_string¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4December 31, 2023 23:59:59¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4countdown_gmt_offset¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4+10¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4countdown_description¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Next Event: ¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4social_in_new¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4social_links¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[[¤(bs)¤u00a4(dq)¤(bs)¤u00a4fa-facebook-square¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4https:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/www.facebook.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon¤(bs)¤u00a4(dq)¤(bs)¤u00a4],[¤(bs)¤u00a4(dq)¤(bs)¤u00a4fa-twitter-square¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4https:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/twitter.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/ThemeCanon¤(bs)¤u00a4(dq)¤(bs)¤u00a4],[¤(bs)¤u00a4(dq)¤(bs)¤u00a4fa-rss-square¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/feed¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(dq)¤(bs)¤u00a4]],¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_post_grid_shows¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4latest_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_post_grid_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a46wide¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_post_grid_animation¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4simple¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_post_grid_anim_delay¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4400¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_post_grid_anim_speed¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a43000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_slider_alias¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Post-Slider¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_slider_boxed¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_shows¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4latest_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_show_featured_image¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_show_title¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_show_excerpt¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_display_num_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a44¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_num_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a415¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_excerpt_length¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4130¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_autoplay_speed¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a43000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_stop_on_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_carousel_pagination¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_shows¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4recent¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_user_id¤(bs)¤u00a4(dq)¤(bs)¤u00a4:null,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_tag¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4wordpress¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_display_num_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a45¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_num_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a415¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_excerpt_length¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4100¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_autoplay_speed¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a43000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_stop_on_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_instagram_carousel_pagination¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_widgets_boxed¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_bg_color¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#9189a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_text_color¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_bg_attachment¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4scroll¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_bg_size¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4cover¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_block_height¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4750¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_content_top_margin¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4200¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_html¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4h1¤(bs)¤u00a4(gt)¤(bs)¤u00a4Search ¤(bs)¤u00a4(lt)¤(bs)¤u00a4b¤(bs)¤u00a4(gt)¤(bs)¤u00a4Specific Categories¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/b¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/h1¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n¤(bs)¤u00a4(lt)¤(bs)¤u00a4p¤(bs)¤u00a4(gt)¤(bs)¤u00a4Search my blog of literary masterpieces.¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/p¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_placeholder¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Search For Posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_btn_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Search¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_in¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4all_categories¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_pre_custom_center¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_main_custom_left¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_main_custom_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_post_custom_center¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4primary¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_post_custom_left¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4header_post_custom_right¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_pre_custom_center¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4footer_post_custom_center¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4block_search_bg_img_url¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_options_post¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4homepage_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4masonry_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4homepage_num_columns¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a42¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4homepage_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_archive_sidebar_widget_area¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4homepage_drop_cap¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4homepage_excerpt_length¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4150¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4homepage_pagination¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4loadmore_ajax¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4cat_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4masonry_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4cat_num_columns¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a42¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4cat_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_archive_sidebar_widget_area¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4cat_drop_cap¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4cat_excerpt_length¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4150¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_cat_title¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_cat_description¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4cat_pagination¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4loadmore_ajax¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4classic_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_num_columns¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a43¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_archive_sidebar_widget_area¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_drop_cap¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_excerpt_length¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4150¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_pagination¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4loadmore_ajax¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4page_show_comments¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4single_default_post_style¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4compact_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4single_use_dropcap¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_tags¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_comments¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_post_nav¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4post_nav_same_cat¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4post_component_ad_code¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4a href=¤(bs)¤u00a4(sq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/www.themeforest.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/?ref=themecanon¤(bs)¤u00a4(sq)¤(bs)¤u00a4 target=¤(bs)¤u00a4(sq)¤(bs)¤u00a4_blank¤(bs)¤u00a4(sq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4img src=¤(bs)¤u00a4(sq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/wp-content¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themes¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/img¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/ad-example-2.png¤(bs)¤u00a4(sq)¤(bs)¤u00a4 alt=¤(bs)¤u00a4(sq)¤(bs)¤u00a4Advertisement¤(bs)¤u00a4(sq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/a¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_meta_categories¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_meta_author¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_meta_date¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_meta_comments¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_meta_likes¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_meta_views¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_share_link_facebook¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_share_link_twitter¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_share_link_google_plus¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_share_link_pinterest¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_header_padding_top¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4100¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_header_padding_bottom¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4100¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_box_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4What are you looking for?¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_pages¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_cpt¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_cpt_source¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_widget_area_1¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_cwa_search-widget-area-1¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_widget_area_2¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_cwa_search-widget-area-2¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_widget_area_3¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_cwa_search-widget-area-3¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_widget_area_4¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4search_widget_area_5¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4404_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4full¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4404_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_page_sidebar_widget_area¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4404_title¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Page not found¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4404_msg¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Sorry, you¤(bs)¤u00a4(sq)¤(bs)¤u00a4re lost my friend, the page you¤(bs)¤u00a4(sq)¤(bs)¤u00a4re looking for does not exist anymore. Take your luck at searching for a new one.¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_ads¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[{¤(bs)¤u00a4(dq)¤(bs)¤u00a4append_to_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a43¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ad_code¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4a href=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4#¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4 class=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4col-1-2¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n¤(bs)¤u00a4(lt)¤(bs)¤u00a4img src=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/wp-content¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themes¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/img¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/ads¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/468x60.png¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4 alt=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4Advertisement¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4 ¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/a¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n¤(bs)¤u00a4(bs)¤(bs)¤u00a4t¤(bs)¤u00a4(bs)¤(bs)¤u00a4t¤(bs)¤u00a4(bs)¤(bs)¤u00a4t¤(bs)¤u00a4(bs)¤(bs)¤u00a4t¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n¤(bs)¤u00a4(lt)¤(bs)¤u00a4a href=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4#¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4 class=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4col-1-2 last¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n¤(bs)¤u00a4(lt)¤(bs)¤u00a4img src=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/wp-content¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themes¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/img¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/ads¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/468x60.png¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4 alt=¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4Advertisement¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4 ¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/a¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_ad_homepage¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_ad_category¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_ad_archive¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4},{¤(bs)¤u00a4(dq)¤(bs)¤u00a4append_to_posts¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a45, 12¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4ad_code¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4a href=¤(bs)¤u00a4(sq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/www.themeforest.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/?ref=themecanon¤(bs)¤u00a4(sq)¤(bs)¤u00a4 target=¤(bs)¤u00a4(sq)¤(bs)¤u00a4_blank¤(bs)¤u00a4(sq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4img src=¤(bs)¤u00a4(sq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/wp-content¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themes¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/img¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/ad-example-2.png¤(bs)¤u00a4(sq)¤(bs)¤u00a4 alt=¤(bs)¤u00a4(sq)¤(bs)¤u00a4Advertisement¤(bs)¤u00a4(sq)¤(bs)¤u00a4¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(lt)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/a¤(bs)¤u00a4(gt)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_ad_homepage¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_ad_category¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4show_ad_archive¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4}],¤(bs)¤u00a4(dq)¤(bs)¤u00a4revslider_clean_ui¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_woocommerce_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4woocommerce_sidebar¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_cwa_shop¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4woocommerce_shop_slider¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4shop_carousel¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_header_image_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/wp-content¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/uploads¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/2016¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/03¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/lake.jpg¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_header_cat_fashion¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_header_cat_featured¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_header_cat_layout¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_header_cat_personal¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4archive_header_cat_uncategorized¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_options_appearance¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4body_skin_class¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4tc-belle-1¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_body¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#f8f8f8¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_plate¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_main_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_main_headings¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_links¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_links_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_like¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#f15292¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_white_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_btn¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_btn_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#358d90¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_btn_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_btn_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_color¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_overlay_color¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#1d2121¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_overtext_color¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_meta¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#b8babd¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_drops¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_header¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_header_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_header_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_header_menus¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#f8f8f8¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_header_line¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#e7e7e7¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_header¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_header_stuck¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_header_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_header_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_header_menus_2nd¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_header_menus¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#f8f8f8¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_header_line¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#e7e7e7¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_post_header¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_post_header_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_post_header_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_post_header_menus¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#f8f8f8¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_post_header_line¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#e7e7e7¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_search_bg¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#1d2121¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_search_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_search_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_search_line¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#3c4242¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_sidr¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#191c20¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_sidr_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_sidr_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_sidr_line¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#23272c¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_borders¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#e7e7e7¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_second_plate¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#f8f8f8¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_fields¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#f8f8f8¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_area¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#f8f8f8¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_area_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_area_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_car_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_car_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_feat_area_borders¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#e7e7e7¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_footfeat_area¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#323638¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_footfeat_area_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_footfeat_area_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_footfeat_area_borders¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#54585a¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_footer¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#ffffff¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_footer_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_footer_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_pre_footer_line¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#e7e7e7¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_baseline¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#25292b¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_baseline_text¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#b8babd¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_baseline_text_hover¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#7db2b4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4color_logo¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4bg_img_url¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4bg_link¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4bg_size¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4auto¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4bg_repeat¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4repeat¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4bg_attachment¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4scroll¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4lightbox_overlay_color¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4#000000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4lightbox_overlay_opacity¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a40.7¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_main¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_heading¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_heading2¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_heading_italic¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_heading_strong¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_heading2_italic¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_heading2_strong¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_nav¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_meta¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_tags¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_button¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_dropcap¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_quote¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_logotext¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_lead¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_bold¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_italic¤(bs)¤u00a4(dq)¤(bs)¤u00a4:[¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_default¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4],¤(bs)¤u00a4(dq)¤(bs)¤u00a4font_size_root¤(bs)¤u00a4(dq)¤(bs)¤u00a4:100,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_img_slider_slideshow¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4unchecked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_img_slider_delay¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a45000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_img_slider_anim_duration¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4800¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_quote_slider_slideshow¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_quote_slider_delay¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a45000¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_quote_slider_anim_duration¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4800¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_menus¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_menus_off¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_menus_enter¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4left¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_menus_move¤(bs)¤u00a4(dq)¤(bs)¤u00a4:40,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_menus_duration¤(bs)¤u00a4(dq)¤(bs)¤u00a4:600,¤(bs)¤u00a4(dq)¤(bs)¤u00a4anim_menus_delay¤(bs)¤u00a4(dq)¤(bs)¤u00a4:150},¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_options_advanced¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4reset_all¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4reset_basic¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4custom_widget_areas¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a49999¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4name¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a40¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4name¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Search Widget Area 1¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a41¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4name¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Search Widget Area 2¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a42¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4name¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Search Widget Area 3¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a43¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4name¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Search Widget Area 4¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a44¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4name¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Search Widget Area 5¤(bs)¤u00a4(dq)¤(bs)¤u00a4},¤(bs)¤u00a4(dq)¤(bs)¤u00a45¤(bs)¤u00a4(dq)¤(bs)¤u00a4:{¤(bs)¤u00a4(dq)¤(bs)¤u00a4name¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4Shop¤(bs)¤u00a4(dq)¤(bs)¤u00a4}},¤(bs)¤u00a4(dq)¤(bs)¤u00a4use_final_call_css¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4checked¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4oauth_instagram_client_id¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4oauth_instagram_client_secret¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4oauth_instagram¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4null¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4reset_oauth_instagram¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4final_call_css¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/* For Display Purposes Only *¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.main-header.right .header_banner{¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n    position: relative;¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n    margin-top: -24px;¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n}¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-2.not-sidebar .single-item.post.sticky,¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-2.not-sidebar .single-item.post.tag-fullwidth { ¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n    width: 48%;¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n}¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-3 .single-item.post.sticky,¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-3 .single-item.post.tag-fullwidth { ¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n    width: 30%;¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n}¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-4 .single-item.post.sticky,¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-4 .single-item.post.tag-fullwidth { ¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n    width: 22%;¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n}¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-2.not-sidebar .single-item.ad,¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-3 .single-item.ad,¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.is-col-1-4 .single-item.ad  {¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n    display: none;¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n}¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4ndiv.single-item.ad,¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n.single-item.post.tag-fullwidth{¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n    width: 100%;¤(bs)¤u00a4(bs)¤(bs)¤u00a4r¤(bs)¤u00a4(bs)¤(bs)¤u00a4n}¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_options_data¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4import_data¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4canon_widgets_data¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4import_widgets_data¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4¤(bs)¤u00a4(dq)¤(bs)¤u00a4,¤(bs)¤u00a4(dq)¤(bs)¤u00a4oauth_instagram_redirect_uri¤(bs)¤u00a4(dq)¤(bs)¤u00a4:¤(bs)¤u00a4(dq)¤(bs)¤u00a4http:¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/themecanon.com¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/belle¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/wp-admin¤(bs)¤u00a4(bs)¤(bs)¤u00a4¤(bs)¤/admin.php?page=handle_canon_options_advanced¤(bs)¤u00a4(dq)¤(bs)¤u00a4}}¤(dq)¤,¤(dq)¤import_data¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤canon_widgets_data¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤import_widgets_data¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤oauth_instagram_redirect_uri¤(dq)¤:¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-admin¤(bs)¤/admin.php?page=handle_canon_options_advanced¤(dq)¤}}">
							     		<?php esc_html_e('Demo settings', 'loc-canon-belle'); ?></option>
							     		
							     		

									</select> 
								</td>
							</tr>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						IMPORT/EXPORT WIDGETS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Import/Export Widgets", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Import/Export widgets', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Use this section to import/export your widgets.', 'loc-canon-belle'),
										esc_html__(' ', 'loc-canon-belle'),
										wp_kses_post(__('<strong>WARNING</strong>: Existing widgets and widget settings will be lost! ', 'loc-canon-belle')),
										esc_html__(' ', 'loc-canon-belle'),
										esc_html__('The Widget Areas Manager which is used to create custom widget areas is part of the theme settings so please notice that custom widget areas are imported/exported along with the rest of the theme settings and NOT as part of the widgets import/export function. As widgets can only be imported into custom widget areas that already exist you may want to import your theme settings first to make sure that the required custom widget areas exist when importing your widgets.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Generate widgets data', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Clicking this button will generate widgets data. You can copy this data from the widgets data window.', 'loc-canon-belle'),
										esc_html__('Clicking the window will select all text.', 'loc-canon-belle'),
										esc_html__('Press CTRL+C on your keyboard or right click selected text and select copy.', 'loc-canon-belle'),
										esc_html__('Once you have copied the data you can either save it to a text document/file (safest) or simply keep the data in your copy/paste clipboard (not safe).', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Import widgets data', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Clicking this button will import your widgets data from the data string supplied in the widgets data window.', 'loc-canon-belle'),
										esc_html__('Make sure you paste all of the data into the widgets data textarea/window. If part of the code is altered or left out import will fail.', 'loc-canon-belle'),
										esc_html__('Click the "Import widgets data" button.', 'loc-canon-belle'),
										esc_html__('Your widgets have now been imported.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'title' 				=> esc_html__('Load predefined widgets data', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Use this select to load predefined widgets data into the data window.', 'loc-canon-belle'),
										esc_html__('Click the "Import widgets data" button.', 'loc-canon-belle'),
										esc_html__('The predefined widgets have now been imported.', 'loc-canon-belle'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<tr valign='top'>
								<th scope='row'><?php esc_html_e("Widgets data", "loc-canon-belle"); ?></th>
								<td colspan="2">
									<textarea id='canon_widgets_data' class='canon_export_data' name='canon_options_advanced[canon_widgets_data]' rows='5' cols='100'></textarea>
								</td>
							</tr>

							<tr valign='top'>
								<th scope='row'></th>
								<td>
									<input type="hidden" id="import_widgets_data" name="canon_options_advanced[import_widgets_data]" value="">

									<input type="button" class="button button_generate_data" value="Generate widgets data" data-export_data="<?php echo esc_attr($encoded_serialized_widgets_data); ?>" />
									<button id="button_import_widgets_data" name="button_import_widgets_data" class="button-secondary"><?php esc_html_e("Import widgets data", "loc-canon-belle"); ?></button>
								</td>
								<td class="float-right">
									<select class="predefined-data-select">
							     		<option value="" selected='selected'><?php esc_html_e('Load predefined widgets data...', 'loc-canon-belle'); ?></option> 
							     		
							     		<option value="{¤(dq)¤widget_areas¤(dq)¤:{¤(dq)¤wp_inactive_widgets¤(dq)¤:[],¤(dq)¤canon_archive_sidebar_widget_area¤(dq)¤:[¤(dq)¤belle_about-2¤(dq)¤,¤(dq)¤belle_social_links-2¤(dq)¤,¤(dq)¤belle_more_posts-2¤(dq)¤,¤(dq)¤belle_search-2¤(dq)¤,¤(dq)¤text-2¤(dq)¤,¤(dq)¤tag_cloud-2¤(dq)¤],¤(dq)¤canon_page_sidebar_widget_area¤(dq)¤:[],¤(dq)¤canon_feature_widget_area_1¤(dq)¤:[¤(dq)¤text-3¤(dq)¤],¤(dq)¤canon_feature_widget_area_2¤(dq)¤:[¤(dq)¤belle_more_posts-3¤(dq)¤],¤(dq)¤canon_feature_widget_area_3¤(dq)¤:[¤(dq)¤belle_twitter-2¤(dq)¤],¤(dq)¤canon_feature_widget_area_4¤(dq)¤:[¤(dq)¤recent-comments-2¤(dq)¤],¤(dq)¤canon_feature_widget_area_5¤(dq)¤:[],¤(dq)¤canon_cwa_search-widget-area-1¤(dq)¤:[¤(dq)¤belle_more_posts-4¤(dq)¤],¤(dq)¤canon_cwa_search-widget-area-2¤(dq)¤:[¤(dq)¤belle_twitter-3¤(dq)¤],¤(dq)¤canon_cwa_search-widget-area-3¤(dq)¤:[¤(dq)¤belle_social_links-4¤(dq)¤],¤(dq)¤canon_cwa_search-widget-area-4¤(dq)¤:[],¤(dq)¤canon_cwa_search-widget-area-5¤(dq)¤:[],¤(dq)¤canon_cwa_shop¤(dq)¤:[¤(dq)¤belle_about-3¤(dq)¤,¤(dq)¤woocommerce_widget_cart-2¤(dq)¤,¤(dq)¤woocommerce_price_filter-3¤(dq)¤],¤(dq)¤array_version¤(dq)¤:3},¤(dq)¤active_widgets¤(dq)¤:{¤(dq)¤belle_about¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤image_url¤(dq)¤:¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/uploads¤(bs)¤/2016¤(bs)¤/03¤(bs)¤/belle-1.jpg¤(dq)¤,¤(dq)¤name¤(dq)¤:¤(dq)¤Belle Wilson¤(dq)¤,¤(dq)¤tagline¤(dq)¤:¤(dq)¤Wife ¤(bs)¤/ Blogger ¤(bs)¤/ Amateur Photographer¤(dq)¤,¤(dq)¤description¤(dq)¤:¤(dq)¤Cras justo odio, dapibus ac facilisis in, egestas egem sociis natoque perient montes, nascetur ridiculus mus.¤(dq)¤,¤(dq)¤read_more_text¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤read_more_link¤(dq)¤:¤(dq)¤http:¤(bs)¤/¤(bs)¤/www.google.com¤(dq)¤,¤(dq)¤user_id¤(dq)¤:¤(dq)¤off¤(dq)¤},¤(dq)¤3¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤image_url¤(dq)¤:¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/uploads¤(bs)¤/2016¤(bs)¤/03¤(bs)¤/belle-1.jpg¤(dq)¤,¤(dq)¤name¤(dq)¤:¤(dq)¤Belle Wilson¤(dq)¤,¤(dq)¤tagline¤(dq)¤:¤(dq)¤Wife ¤(bs)¤/ Blogger ¤(bs)¤/ Amateur Photographer¤(dq)¤,¤(dq)¤description¤(dq)¤:¤(dq)¤Cras justo odio, dapibus ac facilisis in, egestas egem sociis natoque perient montes, nascetur ridiculus mus.¤(dq)¤,¤(dq)¤read_more_text¤(dq)¤:¤(dq)¤¤(dq)¤,¤(dq)¤read_more_link¤(dq)¤:¤(dq)¤http:¤(bs)¤/¤(bs)¤/www.google.com¤(dq)¤,¤(dq)¤user_id¤(dq)¤:¤(dq)¤off¤(dq)¤},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤belle_social_links¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Follow Me¤(dq)¤,¤(dq)¤display_style¤(dq)¤:¤(dq)¤rounded¤(dq)¤,¤(dq)¤open_in_new¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤social_links¤(dq)¤:[[¤(dq)¤fa-facebook¤(dq)¤,¤(dq)¤https:¤(bs)¤/¤(bs)¤/www.facebook.com¤(bs)¤/themecanon¤(dq)¤],[¤(dq)¤fa-twitter¤(dq)¤,¤(dq)¤https:¤(bs)¤/¤(bs)¤/twitter.com¤(bs)¤/ThemeCanon¤(dq)¤],[¤(dq)¤fa-google-plus¤(dq)¤,¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/feed¤(bs)¤/¤(dq)¤],[¤(dq)¤fa-youtube¤(dq)¤,¤(dq)¤#¤(dq)¤],[¤(dq)¤fa-slack¤(dq)¤,¤(dq)¤#¤(dq)¤],[¤(dq)¤fa-rss¤(dq)¤,¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/feed¤(bs)¤/¤(dq)¤]]},¤(dq)¤4¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Follow Me¤(dq)¤,¤(dq)¤display_style¤(dq)¤:¤(dq)¤rounded¤(dq)¤,¤(dq)¤open_in_new¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤social_links¤(dq)¤:[[¤(dq)¤fa-facebook¤(dq)¤,¤(dq)¤https:¤(bs)¤/¤(bs)¤/www.facebook.com¤(bs)¤/themecanon¤(dq)¤],[¤(dq)¤fa-twitter¤(dq)¤,¤(dq)¤https:¤(bs)¤/¤(bs)¤/twitter.com¤(bs)¤/ThemeCanon¤(dq)¤],[¤(dq)¤fa-google-plus¤(dq)¤,¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/feed¤(bs)¤/¤(dq)¤],[¤(dq)¤fa-youtube¤(dq)¤,¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/feed¤(bs)¤/¤(dq)¤],[¤(dq)¤fa-rss¤(dq)¤,¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/feed¤(bs)¤/¤(dq)¤]]},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤belle_more_posts¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Latest Posts¤(dq)¤,¤(dq)¤show¤(dq)¤:¤(dq)¤latest_posts¤(dq)¤,¤(dq)¤display_style¤(dq)¤:¤(dq)¤thumbnails_list¤(dq)¤,¤(dq)¤num_posts¤(dq)¤:¤(dq)¤3¤(dq)¤,¤(dq)¤num_columns¤(dq)¤:¤(dq)¤2¤(dq)¤},¤(dq)¤3¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Features¤(dq)¤,¤(dq)¤show¤(dq)¤:¤(dq)¤postcat_featured¤(dq)¤,¤(dq)¤display_style¤(dq)¤:¤(dq)¤thumbnails_list¤(dq)¤,¤(dq)¤num_posts¤(dq)¤:¤(dq)¤2¤(dq)¤,¤(dq)¤num_columns¤(dq)¤:¤(dq)¤2¤(dq)¤},¤(dq)¤4¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Recent Posts¤(dq)¤,¤(dq)¤show¤(dq)¤:¤(dq)¤latest_posts¤(dq)¤,¤(dq)¤display_style¤(dq)¤:¤(dq)¤thumbnails_list¤(dq)¤,¤(dq)¤num_posts¤(dq)¤:¤(dq)¤3¤(dq)¤,¤(dq)¤num_columns¤(dq)¤:¤(dq)¤2¤(dq)¤},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤belle_search¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Search My Blog¤(dq)¤,¤(dq)¤widget_placeholder_text¤(dq)¤:¤(dq)¤Search...¤(dq)¤},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤text¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Ad Spot¤(dq)¤,¤(dq)¤text¤(dq)¤:¤(dq)¤¤(lt)¤a href=¤(bs)¤¤(dq)¤#¤(bs)¤¤(dq)¤¤(gt)¤¤(lt)¤img src=¤(bs)¤¤(dq)¤http:¤(bs)¤/¤(bs)¤/themecanon.com¤(bs)¤/belle¤(bs)¤/wp-content¤(bs)¤/uploads¤(bs)¤/2016¤(bs)¤/03¤(bs)¤/300x250_dark-2.png¤(bs)¤¤(dq)¤ alt=¤(bs)¤¤(dq)¤ad¤(bs)¤¤(dq)¤ ¤(bs)¤/¤(gt)¤¤(lt)¤¤(bs)¤/a¤(gt)¤¤(dq)¤,¤(dq)¤filter¤(dq)¤:false},¤(dq)¤3¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤About Belle¤(dq)¤,¤(dq)¤text¤(dq)¤:¤(dq)¤Maecenas sed diam eget risus varius blandit sit amet non magna. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec sed odio dui. Maecenas faucibus mollis interdum. ¤(dq)¤,¤(dq)¤filter¤(dq)¤:false},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤tag_cloud¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Tags¤(dq)¤,¤(dq)¤taxonomy¤(dq)¤:¤(dq)¤post_tag¤(dq)¤},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤belle_twitter¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Latest Tweet¤(dq)¤,¤(dq)¤twitter_widget_code¤(dq)¤:¤(dq)¤            ¤(lt)¤a class=¤(bs)¤¤(dq)¤twitter-timeline¤(bs)¤¤(dq)¤  href=¤(bs)¤¤(dq)¤https:¤(bs)¤/¤(bs)¤/twitter.com¤(bs)¤/makelemonadeco¤(bs)¤¤(dq)¤ data-widget-id=¤(bs)¤¤(dq)¤334632933006655488¤(bs)¤¤(dq)¤¤(gt)¤Tweets by @makelemonadeco¤(lt)¤¤(bs)¤/a¤(gt)¤¤(bs)¤r¤(bs)¤n            ¤(lt)¤script¤(gt)¤!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=¤(bs)¤/^http:¤(bs)¤/.test(d.location)?¤(sq)¤http¤(sq)¤:¤(sq)¤https¤(sq)¤;if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+¤(bs)¤¤(dq)¤:¤(bs)¤/¤(bs)¤/platform.twitter.com¤(bs)¤/widgets.js¤(bs)¤¤(dq)¤;fjs.parentNode.insertBefore(js,fjs);}}(document,¤(bs)¤¤(dq)¤script¤(bs)¤¤(dq)¤,¤(bs)¤¤(dq)¤twitter-wjs¤(bs)¤¤(dq)¤);¤(lt)¤¤(bs)¤/script¤(gt)¤¤(bs)¤r¤(bs)¤n          ¤(dq)¤,¤(dq)¤use_theme_design¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤twitter_num_tweets¤(dq)¤:¤(dq)¤1¤(dq)¤},¤(dq)¤3¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Latest Tweet¤(dq)¤,¤(dq)¤twitter_widget_code¤(dq)¤:¤(dq)¤            ¤(lt)¤a class=¤(bs)¤¤(dq)¤twitter-timeline¤(bs)¤¤(dq)¤  href=¤(bs)¤¤(dq)¤https:¤(bs)¤/¤(bs)¤/twitter.com¤(bs)¤/makelemonadeco¤(bs)¤¤(dq)¤ data-widget-id=¤(bs)¤¤(dq)¤334632933006655488¤(bs)¤¤(dq)¤¤(gt)¤Tweets by @makelemonadeco¤(lt)¤¤(bs)¤/a¤(gt)¤¤(bs)¤r¤(bs)¤n            ¤(lt)¤script¤(gt)¤!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=¤(bs)¤/^http:¤(bs)¤/.test(d.location)?¤(sq)¤http¤(sq)¤:¤(sq)¤https¤(sq)¤;if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+¤(bs)¤¤(dq)¤:¤(bs)¤/¤(bs)¤/platform.twitter.com¤(bs)¤/widgets.js¤(bs)¤¤(dq)¤;fjs.parentNode.insertBefore(js,fjs);}}(document,¤(bs)¤¤(dq)¤script¤(bs)¤¤(dq)¤,¤(bs)¤¤(dq)¤twitter-wjs¤(bs)¤¤(dq)¤);¤(lt)¤¤(bs)¤/script¤(gt)¤¤(bs)¤r¤(bs)¤n          ¤(dq)¤,¤(dq)¤use_theme_design¤(dq)¤:¤(dq)¤checked¤(dq)¤,¤(dq)¤twitter_num_tweets¤(dq)¤:¤(dq)¤1¤(dq)¤},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤recent-comments¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Recent Comments¤(dq)¤,¤(dq)¤number¤(dq)¤:3},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤woocommerce_widget_cart¤(dq)¤:{¤(dq)¤2¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Your Cart¤(dq)¤,¤(dq)¤hide_if_empty¤(dq)¤:0},¤(dq)¤_multiwidget¤(dq)¤:1},¤(dq)¤woocommerce_price_filter¤(dq)¤:{¤(dq)¤3¤(dq)¤:{¤(dq)¤title¤(dq)¤:¤(dq)¤Filter by price¤(dq)¤},¤(dq)¤_multiwidget¤(dq)¤:1}}}">
							     		<?php esc_html_e('Demo widgets', 'loc-canon-belle'); ?></option>

									</select> 
								</td>

							</tr>

						</table>




					<!-- 
					--------------------------------------------------------------------------
						INSTAGRAM AUTHORIZATION
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Instagram Authorization", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>

							<?php esc_html_e('Register and authorize your site as an Instagram client. This will allow you to use the Instagram features of this theme e.g. displaying your recent Instagram media using the Instagram carousel.', 'loc-canon-belle'); ?>

							<br><br>

							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('STEP 1', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Register your site as an Instagram client to receive a Client ID and a Client secret. Click the STEP 1 link to begin the process. The STEP 1 link will take you to instagram.com where you will need to log in to Instagram and register your site/application/client. During this procedure you will be asked for:', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'ul',
									'content' 				=> array(
										esc_html__('Application Name (e.g. Belle)', 'loc-canon-belle'),
										esc_html__('Description (e.g. My Homepage)', 'loc-canon-belle'),
										esc_html__('Website (http://www.myhomepage.com)', 'loc-canon-belle'),
										esc_html__('OAuth redirect_uri (this must be exactly the same as provided in the Redirect URI text field in the theme settings)', 'loc-canon-belle'),
										esc_html__('Contact email (e.g. my@email.com)', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'content' 				=> array(
										esc_html__('Once your site is registered as an Instagram client copy/paste the Client ID and Client Secret to the corresponding inputs in the theme settings and click Save Changes.', 'loc-canon-belle'),
										wp_kses_post(__('<strong>NB</strong>: Never give out your Client Secret.', 'loc-canon-belle')),
									),
								)); 


								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('STEP 2', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The STEP 1 link will now be replaced by a STEP 2 link. Simply click this link to authorize your site/client with Instagram.', 'loc-canon-belle'),
										esc_html__('If successful the STEP 2 link will be replaced by a success notification and you are now ready to use the theme Instagram features.', 'loc-canon-belle'),
									),
								)); 

								printf('<h2>%s</h2><br>', esc_html__('Troubleshooting', 'loc-canon-belle'));

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('ERROR: No matching code found. Try clearing code or reset.', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('This error happens on rare occassions when a timed out code parameter still resides in the URL. Simply click the Clearing code link or visit another page and come back to the General Settings as this will clear the old code parameter from the URL.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('ERROR: There are no HTTP transports available which can complete the requested request.', 'loc-canon-belle'),
									'content' 				=> array(
										wp_kses_post(__('Instagram authorization uses the <a href="http://codex.wordpress.org/HTTP_API" target="_blank">WordPress HTTP API</a> which detects and uses the transport methods that are available on your server (e.g. file_get_contents, cURL etc). Very rarely a server will have no transport methods available and you will get this error message. You will need to contact the people responsible for your server and kindly ask them to make transports available on your server.', 'loc-canon-belle')),
									),
								)); 

							?>


						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Client ID', 'loc-canon-belle'),
									'slug' 					=> 'oauth_instagram_client_id',
									'colspan'				=> '2',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_advanced',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Client Secret', 'loc-canon-belle'),
									'slug' 					=> 'oauth_instagram_client_secret',
									'colspan'				=> '2',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_advanced',
								)); 

							?>

							<tr>
								<th scope='row'><?php esc_html_e("Redirect URI", "loc-canon-belle"); ?></th>
								<td colspan="2">
									<input type='text' name='canon_options_advanced[oauth_instagram_redirect_uri]' class="widefat" value="<?php echo esc_url($redirect_uri); ?>" readonly>
								</td>
							</tr>

							<tr>
								<th></th>

								<td>
									<?php 

										// OAUTH INSTAGRAM STATUS
										if (!empty($oauth_instagram_error_message)) {
											printf('ERROR: %s', wp_kses_post($oauth_instagram_error_message));		
										} elseif ($oauth_instagram_step === 1) {
											printf('<a href="https://instagram.com/developer/clients/manage/" target="_blank">%s</a>', esc_html__('STEP 1: Register your site as an Instagram client to get Client ID and Client Secret (Save when done).', 'loc-canon-belle'));
										} elseif ($oauth_instagram_step == 2) {
											printf('<a href="%s">%s</a>', esc_url($oauth_instagram_authorize_uri), esc_html__('STEP 2: Log in to Instagram.', 'loc-canon-belle'));
										} elseif ($oauth_instagram_step == 4) {
											$instagram_username = $canon_options_advanced['oauth_instagram']['user']['username'];
											printf('Hi <strong>%s</strong>, your site is now authorized to interact with Instagram.', esc_attr($instagram_username));	
										}

									?>

								</td>
								<td>
									<input type="hidden" id="oauth_instagram" name="canon_options_advanced[oauth_instagram]" value="<?php echo esc_attr(canon_fw_filter_sensitive_input(json_encode($canon_options_advanced['oauth_instagram']))); ?>">
									<input type="hidden" id="reset_oauth_instagram" name="canon_options_advanced[reset_oauth_instagram]" value="">
									<button id="reset_oauth_instagram_button" class="button-secondary reset_nowarn_button"><?php esc_html_e("Reset", "loc-canon-belle"); ?></button>
								</td>
							</tr>



						</table>



					<!-- BOTTOM BUTTONS -->

					<br><br>
					
					<div class="save_submit"><?php submit_button(); ?></div>

					<input type="hidden" id="reset_basic" name="canon_options_advanced[reset_basic]" value="">
					<button id="reset_basic_button" class="button-primary reset_button"><?php esc_html_e("Reset basic settings ..", "loc-canon-belle"); ?></button>

					<input type="hidden" id="reset_all" name="canon_options_advanced[reset_all]" value="">
					<button id="reset_all_button" class="button-primary reset_button"><?php esc_html_e("Reset all settings ..", "loc-canon-belle"); ?></button>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

