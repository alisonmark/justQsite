<?php
	
	// GET OPTIONS
	$canon_options_frame = get_option('canon_options_frame'); 

	// SMART WIDGETIZED FOOTER
	$min_num_widgets = 2;
	$max_num_widgets = 5;

	// count active widget areas
	$num_widgets = 0;
	for ($i = 1; $i < $max_num_widgets+1; $i++) {  
		if (is_active_sidebar("canon_feature_widget_area_" . $i)) $num_widgets++;
	}

	// set classes
	$widget_area_base_class = "feature-widget-area";
	$widget_area_size_class = canon_fw_get_col_size_class_from_num($num_widgets, "col-1-4");

	// width class
	$width_class = ($canon_options_frame['block_widgets_boxed'] == "checked") ? "hero-widgets-boxed" : "hero-widgets-full";

?>

		<div class="hero-widgets element-block-widgets clearfix">
			<div class="hero-widgets-inner clearfix <?php echo esc_attr($width_class); ?>">
				<?php 

					if (($num_widgets < $min_num_widgets) && is_user_logged_in()) {
					?>
						<div class="add-featured-widgets-notice">
							<h3 class="centered"><?php esc_html_e("Feature Widget Areas", "loc-canon-belle"); ?></h3>  
							<p class="centered"><i><?php esc_html_e("Please login and add widgets to at least", "loc-canon-belle"); ?> <?php echo esc_attr($min_num_widgets); ?> <?php esc_html_e("of the", "loc-canon-belle"); ?> <?php echo esc_attr($max_num_widgets); ?> <?php esc_html_e("feature widget areas", "loc-canon-belle"); ?>.</i></p>  
						</div>
					
					<?php       
					} elseif ($num_widgets >= $min_num_widgets) {
							
						$num_widget_shown = 0;

						for ($i = 1; $i < $max_num_widgets+1; $i++) {  

							// determine which widget to add last class to
							$add_last_class_to_num = $min_num_widgets;
							if ($num_widgets > $min_num_widgets) $add_last_class_to_num = $num_widgets;

							if ( is_active_sidebar("canon_feature_widget_area_" . $i) ) {
								$num_widget_shown++;

								// set last class and final class
								$widget_area_last_class = "";
								if ($num_widget_shown === $add_last_class_to_num) $widget_area_last_class = "last";
								$widget_area_final_class = $widget_area_base_class . " " . $widget_area_size_class . " " . $widget_area_last_class;

							?>

								<!-- FEATURE: WIDGET AREA -->
								<div class="<?php echo esc_attr($widget_area_final_class); ?>">

									<?php dynamic_sidebar("canon_feature_widget_area_" . $i); ?>  

								</div>
								
							<?php
							}

						}
					}
				?>

			</div>
		</div>
