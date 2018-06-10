<?php 
	
	$canon_options = get_option('canon_options'); 
	$canon_options_post = get_option('canon_options_post'); 

	$autocomplete_string = $canon_options['autocomplete_words'];

	$autocomplete_explode_array = explode(",", $autocomplete_string);
	$autocomplete_array = array();

	foreach ($autocomplete_explode_array as $key => $value) {
		$value = trim($value);
		if (!empty($value)) { array_push($autocomplete_array, $value); }
	}

	wp_localize_script('canon-scripts','extDataAutocomplete', array(
		'autocompleteArray'			=> $autocomplete_array, 
	));        

	// SMART WIDGETIZED SEARCH AREA
	$min_num_widgets = 2;
	$max_num_widgets = 5;

	// count active widget areas
	$num_widgets = 0;
	for ($i = 1; $i < $max_num_widgets+1; $i++) {  
		if ($canon_options_post['search_widget_area_' . $i] != "off") $num_widgets++;
	}

	// set classes
	$widget_area_base_class = "";
	$widget_area_size_class = canon_fw_get_col_size_class_from_num($num_widgets, "col-1-4");

?>


	<!-- SEARCH BOX -->

	    <!-- Start Outter Wrapper -->
	    <div class="outter-wrapper search-header-container" data-status="closed">
	        <!-- Start Main Navigation -->
	        <div class="wrapper">

	            <header class="clearfix">

	            	<div class="search-area">

		                <ul class="search_controls">
		                	<li class="search_control_search"><em class="fa fa-search"></em></li>
		                	<li class="search_control_close"><em class="fa fa-times"></em></li>
		                </ul>

		                <form id="searchform-header" class="searchform" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
		                    <input type="text" id="searchform-input-header" class="searchform-input full" name="s" placeholder="<?php echo esc_attr($canon_options_post['search_box_text']); ?>" />
                			<?php if (isset($_GET['lang'])) { printf("<input type='hidden' name='lang' value='%s' />", esc_attr($_GET['lang'])); } ?>
		                </form>

	            	</div>

	            	<div class="widgets-area">
					<?php 

						if ($num_widgets < $min_num_widgets) {
						?>
							<div class="select-more-widget-areas-notice">
								<h3 class="centered"><?php esc_html_e("Search Widget Areas", "loc-canon-belle"); ?></h3>  
								<p class="centered"><i><?php esc_html_e("Please login and assign a widget area to at least", "loc-canon-belle"); ?> <?php echo esc_attr($min_num_widgets); ?> <?php esc_html_e("of the", "loc-canon-belle"); ?> <?php echo esc_attr($max_num_widgets); ?> <?php esc_html_e("search widget columns", "loc-canon-belle"); ?>.</i></p>  
							</div>
						
						<?php       
						} else {
								
							$num_widget_shown = 0;

							for ($i = 1; $i < $max_num_widgets+1; $i++) {  

								if ( $canon_options_post['search_widget_area_'.$i] != "off") {
									$num_widget_shown++;

									// set last class and final class
									$widget_area_last_class = ($num_widget_shown === $num_widgets) ? "last" : "";
									$widget_area_final_class = $widget_area_base_class . " " . $widget_area_size_class . " " . $widget_area_last_class;

								?>

									<!-- FEATURE: WIDGET AREA -->
									<div class="<?php echo esc_attr($widget_area_final_class); ?>">

										<?php dynamic_sidebar($canon_options_post['search_widget_area_'.$i]); ?>  

									</div>
									
								<?php
								}

							}
						}
					?>

	            	</div>


	            </header>
	        </div>
	        <!-- End Main Navigation -->
	    </div>
	    <!-- End Outter Wrapper -->		        