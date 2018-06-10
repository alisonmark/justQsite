<?php get_header(); ?>
		

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
	$canon_options_post = get_option('canon_options_post'); 

	// EMPTY VARS FAILSAFE
	if (!isset($canon_options_post['use_woocommerce_sidebar'])) { $canon_options_post['use_woocommerce_sidebar'] = "unchecked"; }

    // SET CONTROLLER CLASSES
    $controller_classes = "not-full is-col-1-1 is-boxed not-dropcap";
    $controller_classes .= ($canon_options_post['use_woocommerce_sidebar'] == "checked") ? " is-sidebar" : " not-sidebar";
    $controller_classes .= ($canon_options['sidebars_alignment'] == "left") ? " is-sidebar-left" : " not-sidebar-left";

	
    // GET SLIDER ALIAS
	$alias = $canon_options_post['woocommerce_shop_slider'];

?>


		<!-- OUTTER-WRAPPER-PARENT -->
		<div class="outter-wrapper-parent">


			<?php 

				// SLIDER
				if (function_exists("putRevSlider") && is_shop() && (!empty($alias)) && ($alias != "no_slider")) { 
					echo '<div class="outter-wrapper feature woocommerce-slider woocommerce-shop-slider">';
					putRevSlider($alias); 
					echo '</div>';
				} 

			?>

			<div class="outter-wrapper clearfix page-content <?php echo esc_attr($controller_classes); ?>">
				
				<!-- MAIN-COLUMN -->
				<div class="main-column">
				
					<div class="wrapper">

						<div class="inner-wrapper clearfix">	
							
							<?php woocommerce_content(); ?> 

						</div>
						
					</div>
					
				</div>
				<!-- END MAIN-COLUMN -->

				<!-- SIDEBAR -->
				<?php if ($canon_options_post['use_woocommerce_sidebar'] == "checked") { get_sidebar('woocommerce'); } ?> 

					
			</div>

		</div>
		<!-- END OUTTER-WRAPPER PARENT -->
		


<?php get_footer(); ?>