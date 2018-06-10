<?php

/////////////////////////////////

// INDEX
//
// COLOR
// NUMBER
// IMAGE SIZE
// CHECKBOX
// UPLOAD
// TEXT
// TEXTAREA
// SELECT
// SELECT ONLY
// SELECT SIDEBAR
// SELECT REVSLIDER
// FONT
// HIDDEN

/////////////////////////////////


	function canon_fw_option ($params) {

		extract($params);

		// general vars
		$id = $slug;
		$name = $options_name . "[" . $slug . "]";
		$options = get_option($options_name);
		$colspan_str = (isset($colspan)) ? " colspan='".$colspan."'" : "";

		// table row params (incl. dynamic_options)
		$tr_string = "valign='top'";
		if (isset($listen_to) && isset($listen_for)) { $tr_string .= " class='dynamic_option' data-listen_to='$listen_to' data-listen_for='$listen_for'"; }

		// GET ARRAY OF REGISTERED SIDEBARS
		$registered_sidebars_array = array();
		foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) { array_push($registered_sidebars_array, $value); }

        // GET ARRAY OF SLIDERS
        if (class_exists('RevSlider')) {
	        $slider = new RevSlider();
	        $slider_aliases_array = $slider->getAllSliderAliases();
	        if (empty($slider_aliases_array)) { $slider_aliases_array = array('No sliders found!'); }
        } else {
        	$slider_aliases_array = array('Revolution Slider plugin not found!');	
        }


// COLOR

// Usage:

// canon_fw_option(array(
// 	'type'					=> 'color',
// 	'title' 				=> esc_html__('Example Color', 'loc-canon-belle'),
// 	'slug' 					=> 'color_example',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "color") {

			// specific vars
			$colorselector_id = "colorSelector_" . $slug;

			?>

			<!-- FW OPTION: COLOR-->

				<tr <?php echo wp_kses_post($tr_string); ?>>

					<th scope='row'><?php echo wp_kses_post($title); ?></th>

					<td>
						<input type="text" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>" />    
						<div class="colorSelectorBox" id="<?php echo esc_attr($colorselector_id); ?>">
							<div style="background-color: <?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>"></div>
						</div>
					</td>

				</tr>

			<?php

			return true;		
				
		}


// NUMBER
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'number',
// 	'title' 				=> esc_html__('Example opacity', 'loc-canon-belle'),
// 	'slug' 					=> 'example_opacity',
// 	'min'					=> '0',										// optional
// 	'max'					=> '1',										// optional
// 	'step'					=> '0.1',									// optional
// 	'width_px'				=> '60',									// optional
// 	'postfix'				=> '<i>(pixels)</i>',						// optional
// 	'colspan'				=> '2',										// optional
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "number") {

			// specific vars
			if (isset($width_px)) { $style_width = 'width:' . $width_px . 'px;'; };
			?>

			<!-- FW OPTION: NUMBER-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input 
							type='number' 
							id= <?php echo esc_attr($id); ?>
							name= <?php echo esc_attr($name); ?>
							<?php if (isset($min)) { echo "min=" . $min; } ?>
							<?php if (isset($max)) { echo "max=" . $max; } ?>
							<?php if (isset($step)) { echo "step=" . $step; } ?>
							<?php if (isset($width_px)) { echo "style=" . $style_width; } ?>
							value='<?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?>'
						> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } ?>
					</td>
				</tr>

			<?php

			return true;		
				
		}


// IMAGE SIZE
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'image_size',
// 	'title' 				=> esc_html__('Example opacity', 'loc-canon-belle'),
// 	'slug' 					=> 'example_opacity',
// 	'min'					=> '0',										// optional
// 	'max'					=> '1',										// optional
// 	'step'					=> '0.1',									// optional
// 	'width_px'				=> '60',									// optional
// 	'postfix'				=> '<i>(pixels)</i>',						// optional
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "image_size") {

			// specific vars
			if (isset($width_px)) { $style_width = 'width:' . $width_px . 'px;'; };

			$name = $options_name . "[image_sizes][" . $slug . "]";

			?>

			<!-- FW OPTION: IMAGE SIZE-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td>
						<input 
							type='number' 
							name= <?php echo esc_attr($name . "[width]"); ?>
							min= <?php if (isset($min)) { echo esc_attr($min); } else { echo '1'; } ?>
							max= <?php if (isset($max)) { echo esc_attr($max); } else { echo '10000'; } ?>
							step= <?php if (isset($step)) { echo esc_attr($step); } else { echo '1'; } ?>
							style= <?php if (isset($width_px)) { echo esc_attr($style_width); } else { echo '"width: 60px"'; } ?>
							value='<?php if (isset($options['image_sizes'][$slug]['width'])) echo esc_attr($options['image_sizes'][$slug]['width']); ?>'
						> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } else { esc_html_e('(px)', 'loc-canon-belle'); } ?>
					</td>
					<td>
						<?php esc_html_e('x', 'loc-canon-belle'); ?>
					</td>
					<td>
						<input 
							type='number' 
							name= <?php echo esc_attr($name . "[height]"); ?>
							min= <?php if (isset($min)) { echo esc_attr($min); } else { echo '1'; } ?>
							max= <?php if (isset($max)) { echo esc_attr($max); } else { echo '10000'; } ?>
							step= <?php if (isset($step)) { echo esc_attr($step); } else { echo '1'; } ?>
							style= <?php if (isset($width_px)) { echo esc_attr($style_width); } else { echo '"width: 60px"'; } ?>
							value='<?php if (isset($options['image_sizes'][$slug]['height'])) echo esc_attr($options['image_sizes'][$slug]['height']); ?>'
						> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } else { esc_html_e('(px)', 'loc-canon-belle'); } ?>
					</td>
					<td>

						<?php 
							$current_aspect_ratio = round($options['image_sizes'][$slug]['width'] / $options['image_sizes'][$slug]['height'], 2);
							// printf('<i>(Recommended aspect ratio: <strong>%s:1</strong> / Current aspect ratio:  <strong>%s:1</strong>)</i>', esc_attr($options['image_sizes'][$slug]['ratio']), esc_attr($current_aspect_ratio)); 
							printf('Aspect ratio: <strong>%s:1</strong>', esc_attr($current_aspect_ratio)); 
						?>

						<input type="hidden" name="<?php echo esc_attr($name. "[ratio]"); ?>" value="<?php echo esc_attr($options['image_sizes'][$slug]['ratio']); ?>">
					
					</td>

					<td>
						<?php printf('(<i>Recommended: <strong>%s:1</strong>)</i>', esc_attr($options['image_sizes'][$slug]['ratio']) ); ?>
					</td>
				</tr>


			<?php

			return true;		
				
		}


// CHECKBOX
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'checkbox',
// 	'title' 				=> esc_html__('Slideshow', 'loc-canon-belle'),
// 	'slug' 					=> 'anim_slider',
// 	'postfix'				=> '<i>(pixels)</i>',						// optional
// 	'colspan'				=> '2',										// optional
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "checkbox") {
			?>

			<!-- FW OPTION: CHECKBOX-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input type="hidden" name="<?php echo esc_attr($name); ?>" value="unchecked" />
						<input class="checkbox" type="checkbox" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="checked" <?php if (isset($options[$slug])) { checked($options[$slug] == "checked"); } ?>/> <?php if (isset($postfix)) { echo wp_kses_post($postfix); } ?>
					</td>
				</tr>

			<?php

			return true;		
				
		}


// UPLOAD
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'upload',
// 	'title' 				=> esc_html__('Logo URL', 'loc-canon-belle'),
// 	'slug' 					=> 'logo_url',
// 	'btn_text'				=> esc_html__('Upload logo', 'loc-canon-belle'),
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options',
// )); 



		if ($type == "upload") {

			// specific vars
			?>

			<!-- FW OPTION: UPLOAD-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td>
						<input type='text' id='<?php echo esc_attr($id); ?>' name='<?php echo esc_attr($name); ?>' class='url' value='<?php if (isset($options[$slug])) echo esc_url($options[$slug]); ?>'>
						<input type="button" class="upload button upload_button" value="<?php echo esc_attr($btn_text); ?>" />
					</td>
				</tr>

			<?php

			return true;		
				
		}

// TEXT
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'text',
// 	'title' 				=> esc_html__('Use text as logo', 'loc-canon-belle'),
// 	'slug' 					=> 'logo_text',
// 	'class'					=> 'widefat',
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options',
// )); 


		if ($type == "text") {

			// specific vars
			$default_class = "";	
			$final_class = (isset($class)) ? $class : $default_class;
			?>

			<!-- FW OPTION: TEXT-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
						<input type='text' name='<?php echo esc_attr($name); ?>' class="<?php echo esc_attr($final_class); ?>" value="<?php if (isset($options[$slug])) echo htmlspecialchars($options[$slug]); ?>">
					</td>
				</tr>

			<?php

			return true;		
				
		}


// TEXTAREA
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'textarea',
// 	'title' 				=> esc_html__('Footer text', 'loc-canon-belle'),
// 	'slug' 					=> 'footer_text',
// 	'cols'					=> '100',
// 	'rows'					=> '5',
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options',
// )); 



		if ($type == "textarea") {

			// specific vars
			$default_class = "";	
			$final_class = (isset($class)) ? $class : $default_class;
			?>

			<!-- FW OPTION: TEXTAREA-->

				<tr <?php echo wp_kses_post($tr_string); ?>>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>

					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>

						<textarea 
							id='<?php echo esc_attr($id); ?>' 
							name='<?php echo esc_attr($name); ?>' 
							class="<?php echo esc_attr($final_class); ?>" 
							<?php if (isset($cols)) { echo "cols=" . $cols; } ?>
							<?php if (isset($rows)) { echo "rows=" . $rows; } ?>
						><?php if (isset($options[$slug])) echo esc_attr($options[$slug]); ?></textarea>

					</td>
				</tr>

			<?php

			return true;		
				
		}


// SELECT
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'select',
// 	'title' 				=> esc_html__('Homepage Blog Style', 'loc-canon-belle'),
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> esc_html__('Full width', 'loc-canon-belle'),
// 		'sidebar'				=> esc_html__('With sidebar', 'loc-canon-belle')
// 	),
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select") {

			?>

			<!-- FW OPTION: SELECT-->

				<tr <?php echo wp_kses_post($tr_string); ?>>

					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
					
						<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

							<?php 

								foreach ($select_options as $key => $value) {
								?>
			     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo wp_kses_post($value); ?></option> 
								<?php		
								}


							?>
			     	
						</select> 
					
					</td>
				
				</tr>


			<?php

			return true;		
				
		}



// SELECT ONLY
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'select_only',
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> esc_html__('Full width', 'loc-canon-belle'),
// 		'sidebar'				=> esc_html__('With sidebar', 'loc-canon-belle')
// 	),
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select_only") {

			?>

			<!-- FW OPTION: SELECT ONLY-->

					
				<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

					<?php 

						foreach ($select_options as $key => $value) {
						?>
	     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo wp_kses_post($value); ?></option> 
						<?php		
						}


					?>
	     	
				</select> 
					
			<?php

			return true;		
				
		}


// SELECT SIDEBAR
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'select_sidebar',
// 	'title' 				=> esc_html__('Homepage Blog Style', 'loc-canon-belle'),
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> esc_html__('Full width', 'loc-canon-belle'),
// 		'sidebar'				=> esc_html__('With sidebar', 'loc-canon-belle')
// 	),
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select_sidebar") {

			?>

			<!-- FW OPTION: SELECT SIDEBAR-->

				<tr <?php echo wp_kses_post($tr_string); ?>>

					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
					
						<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

							<?php 

								if (isset($select_options)) { foreach ($select_options as $key => $value) {
								?>
			     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo wp_kses_post($value); ?></option> 
								<?php		
								}}

								for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
								?>
				     				<option value="<?php echo esc_attr($registered_sidebars_array[$i]['id']); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo esc_attr($registered_sidebars_array[$i]['name']); ?></option> 
								<?php
								}

							?>
			     	
						</select> 
					
					</td>
				
				</tr>

			<?php

			return true;		
				
		}


// SELECT REVSLIDER
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'select_revslider',
// 	'title' 				=> esc_html__('Homepage Blog Style', 'loc-canon-belle'),
// 	'slug' 					=> 'homepage_blog_style',
// 	'select_options'		=> array(
// 		'full'					=> esc_html__('Full width', 'loc-canon-belle'),
// 		'sidebar'				=> esc_html__('With sidebar', 'loc-canon-belle')
// 	),
// 	'colspan'				=> '2',
// 	'listen_to'				=> '#homepage_layout',
// 	'listen_for'			=> 'column',
// 	'options_name'			=> 'canon_options_post',
// )); 




		if ($type == "select_revslider") {

			?>

			<!-- FW OPTION: SELECT SLIDER-->

				<tr <?php echo wp_kses_post($tr_string); ?>>

					<th scope='row'><?php echo wp_kses_post($title); ?></th>
					
					<td<?php if (!empty($colspan_str)) { echo esc_attr($colspan_str);} ?>>
					
						<select id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>"> 

							<?php 

								if (isset($select_options)) { foreach ($select_options as $key => $value) {
								?>
			     					<option value="<?php echo esc_attr($key); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] == $key) echo "selected='selected'";} ?>><?php echo wp_kses_post($value); ?></option> 
								<?php		
								}}

								for ($i = 0; $i < count($slider_aliases_array); $i++) { 
								?>
				     				<option value="<?php echo esc_attr($slider_aliases_array[$i]); ?>" <?php if (isset($options[$slug])) {if ($options[$slug] ==  $slider_aliases_array[$i]) echo "selected='selected'";} ?>><?php echo esc_attr($slider_aliases_array[$i]); ?></option> 
								<?php
								}

							?>
			     	
						</select> 
					
					</td>
				
				</tr>

			<?php

			return true;		
				
		}



// FONT
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'font',
// 	'title' 				=> esc_html__('Body text', 'loc-canon-belle'),
// 	'slug' 					=> 'font_main',
// 	'options_name'			=> 'canon_options_appearance',
// )); 




		if ($type == "font") {

			?>

			<!-- FW OPTION: FONT-->

				<tr id='<?php echo esc_attr($id); ?>' valign='top' class='canon_webfonts_controller'>
					<th scope='row'><?php echo wp_kses_post($title); ?></th>

					<td>
						<select id="font_main_family" name="<?php echo esc_attr($name); ?>[0]" class="canon_font_family" data-selected="<?php if (isset($options[$slug][0])) echo esc_attr($options[$slug][0]); ?>"> 
							<option value="canon_default" <?php if (isset($options[$slug][0])) {if ($options[$slug][0] == "canon_default") echo "selected='selected'";} ?>><?php esc_html_e("Theme default", "loc-canon-belle"); ?></option> 
							<option value="canon_default">----</option> 
						</select> 
					</td>

					<td>
						<select id="font_main_variant" name="<?php echo esc_attr($name); ?>[1]" class="canon_font_variant" data-selected="<?php if (isset($options[$slug][1])) echo esc_attr($options[$slug][1]); ?>"> 
						</select> 
					</td>

					<td>
						<select id="font_main_subset" name="<?php echo esc_attr($name); ?>[2]" class="canon_font_subset" data-selected="<?php if (isset($options[$slug][2])) echo esc_attr($options[$slug][2]); ?>"> 
						</select> 
					</td>
				</tr>


			<?php

			return true;		
				
		}

// HIDDEN
//
// Usage:
//
// canon_fw_option(array(
// 	'type'					=> 'hidden',
// 	'slug' 					=> 'body_skin_class',
// 	'options_name'			=> 'canon_options_appearance',
// )); 


		if ($type == "hidden") {

			?>

			<!-- FW OPTION: HIDDEN-->

				<input type="hidden" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($options[$slug]); ?>">

			<?php

			return true;		
				
		}



// END OF MAIN FUNCTION

		return false;

	} // end function canon_fw_option
