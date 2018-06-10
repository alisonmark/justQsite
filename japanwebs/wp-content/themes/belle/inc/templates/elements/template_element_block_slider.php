<?php
			
	// GET OPTIONS
	$canon_options = get_option('canon_options');
	$canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") { 
        if (isset($_GET['overlay_header'])) { $canon_options['overlay_header'] = wp_filter_nohtml_kses($_GET['overlay_header']); }
        if (isset($_GET['block_slider_alias'])) { $canon_options_frame['block_slider_alias'] = wp_filter_nohtml_kses($_GET['block_slider_alias']); }
    }

	// CONTROLLER CLASSES
	$controller_classes = "";
	if ($canon_options['overlay_header'] == "checked") { $controller_classes .= " overlay-header"; }

?>

		<div class="hero-slider element-block-slider clearfix <?php echo esc_attr($controller_classes); ?>">


			<?php 

				if ($canon_options_frame['block_slider_boxed'] == "checked") { echo '<div class="outter-wrapper clearfix not-full">'; }

				if (function_exists('putRevSlider')) { putRevSlider($canon_options_frame['block_slider_alias']); } else { echo "<div class='block-error-msg'>The Revolution Slider plugin seems to be missing!</div>"; }

				if ($canon_options_frame['block_slider_boxed'] == "checked") { echo '</div>'; }
			?>

		</div>