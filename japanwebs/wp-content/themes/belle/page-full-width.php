<?php /* Template Name: Page Full Width*/ ?>

<?php get_header(); ?>
		
<?php 

    // GET OPTIONS
    $canon_options = get_option('canon_options');
    $canon_options_post = get_option('canon_options_post'); 

    // SET CONTROLLER CLASSES
    $controller_classes = "is-col-1-1 not-sidebar is-boxed not-dropcap";
    $controller_classes .= " not-full";

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

	                            <!-- WP_LINK_PAGES -->
	                            <div class="link-pages"><?php wp_link_pages(array('before' => '<p>' . esc_html__('Pages:','loc-canon-belle'))); ?></div>

							</div>
							
						</div>

						<!-- COMMENTS -->
                    	<?php if ($canon_options_post['page_show_comments'] == "checked") { comments_template( '', true ); } ?>
						
					</div>
					
				</div>
				<!-- END MAIN-COLUMN -->
					
			</div>

		</div>
		<!-- END OUTTER-WRAPPER-PARENT -->

		
	<?php endwhile; ?>
	<!-- END LOOP -->
			


<?php get_footer(); ?>