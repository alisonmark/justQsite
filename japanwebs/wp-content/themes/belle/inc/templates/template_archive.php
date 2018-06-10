<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_frame = get_option('canon_options_frame');
    $canon_options_post = get_option('canon_options_post'); 

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['sidebars_alignment'])) { $canon_options['sidebars_alignment'] = wp_filter_nohtml_kses($_GET['sidebars_alignment']); }
        if (isset($_GET['homepage_layout'])) { $canon_options_post['homepage_layout'] = wp_filter_nohtml_kses($_GET['homepage_layout']); }
        if (isset($_GET['homepage_num_columns'])) { $canon_options_post['homepage_num_columns'] = wp_filter_nohtml_kses($_GET['homepage_num_columns']); }
        if (isset($_GET['homepage_drop_cap'])) { $canon_options_post['homepage_drop_cap'] = wp_filter_nohtml_kses($_GET['homepage_drop_cap']); }
        if (isset($_GET['homepage_feature_layout'])) { $canon_options_frame['homepage_feature_layout'] = wp_filter_nohtml_kses($_GET['homepage_feature_layout']); }
    }

    // GET PAGE TYPE
    $page_type = canon_fw_get_page_type();

    //DETERMINE ARCHIVE STYLE
    if ($page_type == 'home' || $page_type == 'page') {                     // blog
        $prefix = 'homepage';
    } elseif ($page_type == 'category') {                                   // category
    	$prefix = 'cat';
    } else {
        $prefix = 'archive';                  								// all other archive pages
    }

    $layout = $canon_options_post[$prefix . '_layout'];
    $has_sidebar = (strpos($layout, "_sidebar") !== false) ? true : false;

    // SET CONTROLLER CLASSES
    $controller_classes = "outter-wrapper clearfix page-content";
    $controller_classes .= " is-" . canon_fw_get_col_size_class_from_num($canon_options_post[$prefix . '_num_columns'], 'col-1-2');
    $controller_classes .= " is-boxed";
    $controller_classes .= " not-full";
	
	// IF CLASSIC LAYOUT
    if (strpos($layout, "classic") !== false) {
    	$controller_classes = "outter-wrapper clearfix page-content not-full is-col-1-1 not-boxed is-classic";
    }

    $controller_classes .= ($canon_options_post[$prefix . '_drop_cap'] == "checked") ? " is-dropcap" : " not-dropcap";
    $controller_classes .= ($has_sidebar) ? " is-sidebar" : " not-sidebar";
    $controller_classes .= ($canon_options['sidebars_alignment'] == "left") ? " is-sidebar-left" : " not-sidebar-left";

    // DEV CONTROLLER CLASSES HIJACK
    if ($canon_options['dev_mode'] == 'checked' && !empty($canon_options['dev_controller_classes'])) { $controller_classes = $canon_options['dev_controller_classes']; }

?>

		
		<!-- OUTTER-WRAPPER-PARENT -->
		<div class="outter-wrapper-parent">
			

			<!-- ARCHIVE HEADER -->
			<?php 

				if ($prefix == 'homepage') {
					if ($canon_options_frame['homepage_feature_layout'] != "off") { get_template_part('inc/templates/feature/template_feature'); }						
				} else {
					get_template_part('inc/templates/template_archive_header'); 
				}

			?>


			<!-- MAIN CONTENT AREA-->
			<div class="<?php echo esc_attr($controller_classes); ?>">


				<!-- LOOP -->
				<?php 

					if ((strpos($layout, "classic") !== false)) {
						get_template_part("inc/templates/template_archive_loop_classic");
					} else {
						get_template_part("inc/templates/template_archive_loop_grid"); 
					}
				
				?>
			
				
                <!-- SIDEBAR -->
                <?php if ($has_sidebar) { get_sidebar("archive"); } ?>

					
			</div>
			<!-- END MAIN CONTENT AREA-->

		</div>
		<!-- END OUTTER-WRAPPER-PARENT -->
	
	
		
		
