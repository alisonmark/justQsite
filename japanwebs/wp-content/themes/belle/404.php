<?php get_header(); ?>
	
<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
	$canon_options_post = get_option('canon_options_post'); 
	$layout = $canon_options_post['404_layout'];

    // HAS SIDEBAR
    $has_sidebar = ($layout == "sidebar") ? true : false;

    // SET CONTROLLER CLASSES
    $controller_classes = "not-full is-col-1-1 not-boxed not-dropcap";
    $controller_classes .= ($has_sidebar) ? " is-sidebar" : " not-sidebar";
    $controller_classes .= ($canon_options['sidebars_alignment'] == "left") ? " is-sidebar-left" : " not-sidebar-left";

?>

	
		
		<!-- OUTTER-WRAPPER-PARENT -->
		<div class="outter-wrapper-parent">

			<!-- MAIN CONTENT AREA-->
			<div class="outter-wrapper clearfix page-content <?php echo esc_attr($controller_classes); ?>">

				<!-- MAIN-COLUMN -->
				<div class="main-column">


					<h1 class="super"><span>404</span></h1>
					<h1><?php echo wp_kses_post($canon_options_post['404_title']); ?></h1>
					<p class="lead"><?php echo wp_kses_post($canon_options_post['404_msg']); ?></p>                       
					
					<?php get_search_form(); ?>

                
				</div>
				<!-- END MAIN-COLUMN -->

                <!-- SIDEBAR -->
                <?php if ($has_sidebar) { get_sidebar('404'); } ?>


			</div>
			<!-- END MAIN CONTENT AREA-->

		</div>
		<!-- END OUTTER-WRAPPER-PARENT -->

		
<?php get_footer(); ?>