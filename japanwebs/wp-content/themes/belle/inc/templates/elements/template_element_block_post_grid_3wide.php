<?php
	
	// GET OPTIONS
	$canon_options_frame = get_option('canon_options_frame'); 

	// GET VARS
	$show = $canon_options_frame['block_post_grid_shows'];

	// GET POSTS
	$results_query = canon_fw_get_posts_from_show_select($show, 3, false);

?>

		<div class="hero-grid element-block-post-grid grid-3wide clearfix">
		
			<div class="col-1-1">
			
				<div class="col-1-3">

					<?php 

						$this_index = 0;
						if (isset($results_query[$this_index])) {
							// IMAGE VARS
							$this_post = $results_query[$this_index];
							$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_3wide') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
							$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
	                        
	                        // FEATURED IMAGE WITH HOVER BOX
							echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
							printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
	                        canon_belle_hoverbox_default($this_post->ID, $this_post->post_title );														
	                        echo "</div></div>";
						}

					?>
				
					<?php 

						$this_index = 1;
						if (isset($results_query[$this_index])) {
							// IMAGE VARS
							$this_post = $results_query[$this_index];
							$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_3wide') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
							$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
	                        
	                        // FEATURED IMAGE WITH HOVER BOX
							echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
							printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
	                        canon_belle_hoverbox_default($this_post->ID, $this_post->post_title );														
	                        echo "</div></div>";
						}

					?>

				</div>
				
				<div class="col-2-3">

					<?php 

						$this_index = 2;
						if (isset($results_query[$this_index])) {
							// IMAGE VARS
							$this_post = $results_query[$this_index];
							$post_thumbnail_src = ( wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID)) ) ? wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_post_grid_3wide') : array(get_template_directory_uri() . "/img/block_grid_default.jpg");
							$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
	                        
	                        // FEATURED IMAGE WITH HOVER BOX
							echo "<div class='tc-hover-container tc-effect-lift'><div class='tc-hover'>";		
							printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	
	                        canon_belle_hoverbox_default($this_post->ID, $this_post->post_title );														
	                        echo "</div></div>";
						}

					?>

				</div>
				
			</div>

		
		</div>
