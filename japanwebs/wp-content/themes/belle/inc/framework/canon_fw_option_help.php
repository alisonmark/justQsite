<?php

/////////////////////////////////

// INDEX
//
// STANDARD
// PARAGRAPHS
// UNORDERED LIST
// ORDERED LIST

/////////////////////////////////





	function canon_fw_option_help ($params) {

		extract($params);

// STANDARD
//
// Usage:
//
// canon_fw_option_help(array(
// 	'type'					=> 'standard',
// 	'title' 				=> esc_html__('Use responsive design', 'loc-canon-belle'),
// 	'content' 				=> array(
// 		esc_html__('Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices. Turning off responsive design will make the site look the same across all devices and browser sizes.', 'loc-canon-belle'),
// 	),
// )); 


		if ($type == "standard") {

			?>

			<!-- FW OPTION HELP: STANDARD-->

				<div class="help_item">

					<?php if (isset($title)) { printf('<h4>%s</h4>', wp_kses_post($title)); } ?>

					<p>

						<?php 

							foreach($content as $value) {
								echo wp_kses_post($value);
								echo "<br/>";
							}
						?>

					</p>

				</div>


			<?php

			return true;		
				
		}

// PARAGRAPHS
//
// Usage:
//
// canon_fw_option_help(array(
// 	'type'					=> 'paragraphs',
// 	'title' 				=> esc_html__('Use responsive design', 'loc-canon-belle'),
// 	'content' 				=> array(
// 		esc_html__('Responsive design changes the way your site looks depending on the browser size. This is done to optimize the viewing experience on different devices. Turning off responsive design will make the site look the same across all devices and browser sizes.', 'loc-canon-belle'),
// 	),
// )); 


		if ($type == "paragraphs") {

			?>

			<!-- FW OPTION HELP: PARAGRAPHS-->

				<div class="help_item">

					<?php if (isset($title)) { printf('<h4>%s</h4>', wp_kses_post($title)); } ?>

					<?php 

						foreach($content as $value) {
							echo "<p>";
							echo wp_kses_post($value);
							echo "</p>";
						}
					?>

				</div>


			<?php

			return true;		
				
		}


// UNORDERED LIST
//
// Usage:
//
// canon_fw_option_help(array(
// 	'type'					=> 'ul',
// 	'title' 				=> esc_html__('Favicon URL', 'loc-canon-belle'),
// 	'content' 				=> array(
// 		esc_html__('Enter a complete URL to the image you want to use or', 'loc-canon-belle'),
// 		esc_html__('Click the "Upload" button, upload an image and make sure you click the "Use as favicon" button or', 'loc-canon-belle'),
// 		esc_html__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as favicon" button.', 'loc-canon-belle'),
// 		esc_html__('If you leave the URL text field empty the default favicon will be displayed.', 'loc-canon-belle'),
// 		esc_html__('Remember to save your changes.', 'loc-canon-belle'),
// 	),
// )); 


		if ($type == "ul") {

			?>

			<!-- FW OPTION HELP: UL-->

				<div class="help_item">

					<?php if (isset($title)) { printf('<h4>%s</h4>', wp_kses_post($title)); } ?>

					<ul>

						<?php 

							foreach($content as $value) {
								echo "<li> &#8226; ";
								echo wp_kses_post($value);
								echo "</li>";
							}
						?>

					</ul>	

				</div>


			<?php

			return true;		
				
		}

// ORDERED LIST
//
// Usage:
//
// canon_fw_option_help(array(
// 	'type'					=> 'ol',
// 	'title' 				=> esc_html__('Favicon URL', 'loc-canon-belle'),
// 	'content' 				=> array(
// 		esc_html__('Enter a complete URL to the image you want to use or', 'loc-canon-belle'),
// 		esc_html__('Click the "Upload" button, upload an image and make sure you click the "Use as favicon" button or', 'loc-canon-belle'),
// 		esc_html__('Click the "Upload" button and choose an image from the media library tab. Make sure you click the "Use as favicon" button.', 'loc-canon-belle'),
// 		esc_html__('If you leave the URL text field empty the default favicon will be displayed.', 'loc-canon-belle'),
// 		esc_html__('Remember to save your changes.', 'loc-canon-belle'),
// 	),
// )); 


		if ($type == "ol") {

			?>

			<!-- FW OPTION HELP: OL-->

				<div class="help_item">

					<?php if (isset($title)) { printf('<h4>%s</h4>', wp_kses_post($title)); } ?>

					<ol>

						<?php 

							foreach($content as $value) {
								echo "<li>";
								echo wp_kses_post($value);
								echo "</li>";
							}
						?>

					</ol>	

				</div>


			<?php

			return true;		
				
		}

		return false;

	}
