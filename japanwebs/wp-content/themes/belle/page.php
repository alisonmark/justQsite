<?php /* Template Name: Page With Sidebar*/ ?>

<?php get_header(); ?>
		

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_post = get_option('canon_options_post'); 
    
    // SET CONTROLLER CLASSES
    $controller_classes = "not-full is-col-1-1 is-boxed not-dropcap is-sidebar";
    $controller_classes .= ($canon_options['sidebars_alignment'] == "left") ? " is-sidebar-left" : " not-sidebar-left";

?>


	<!-- BEGIN LOOP -->
	<?php while ( have_posts() ) : the_post(); ?>

		<!-- OUTTER-WRAPPER-PARENT -->
		<div class="outter-wrapper-parent">
			
			<?php
											
				// FEATURED IMAGE
				if ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 

					$overlay_classes = "overlay-content";
					if ($canon_options['overlay_header'] == "checked") { $overlay_classes .= " overlay-header"; }
					printf('<div class="featImage %s">', esc_attr($overlay_classes));
					the_post_thumbnail();
					echo '</div>';

				} 
			
			?>
										
										
			<div class="outter-wrapper clearfix page-content <?php echo esc_attr($controller_classes); ?>">
				
				<!-- MAIN-COLUMN -->
				<div class="main-column">
				
					<div class="wrapper">

						<div class="inner-wrapper">	

								
							<div class="postText">
							
								<!-- THE TITLE -->
								<span class="postTitle"><h1><?php the_title(); ?></h1></span>

	                            <!-- THE CONTENT -->
	                            <?php the_content(); ?>
	                            <div class="link-pages"><?php wp_link_pages(array('before' => '<p>' . esc_html__('Pages:','loc-canon-belle'))); ?></div>

							</div>
							
							
						</div>

						<!-- COMMENTS -->
                    	<?php if ($canon_options_post['page_show_comments'] == "checked") { comments_template( '', true ); } ?>

						
					</div>
					
				</div>
				<!-- END MAIN-COLUMN -->
				

				<!-- SIDEBAR -->
				<?php 

					if (class_exists('Woocommerce')) {
						if (canon_fw_is_woocommerce_page()) {
							get_sidebar("woocommerce");
						} else {
							get_sidebar("page"); 
						}
					} else {
						get_sidebar("page"); 
					}

				?>
					
			</div>

		</div>
		<!-- END OUTTER-WRAPPER PARENT -->
		
		
	<?php endwhile; ?>
	<!-- END LOOP -->
			


<?php get_footer(); ?>