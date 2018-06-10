<?php
	
	// GET OPTIONS
	$canon_options = get_option('canon_options'); 
	$canon_options_frame = get_option('canon_options_frame'); 

	// GET VARS
	$show = $canon_options_frame['block_carousel_shows'];
	$num_posts = $canon_options_frame['block_carousel_num_posts'];

	// GET POSTS
	$results_query = canon_fw_get_posts_from_show_select($show, $num_posts, false);

?>

		<div class="hero-carousel element-block-carousel clearfix">

			
			<div class="owl-carousel-nav block-carousel-nav">
			    <a class="prev-btn"><i class="fa fa-angle-left"></i></a>
			    <a class="next-btn"><i class="fa fa-angle-right"></i></a>
			</div>
			
			
			<div class="owl-carousel block-carousel"
				data-display_num_posts		= "<?php echo esc_attr($canon_options_frame['block_carousel_display_num_posts']); ?>"
				data-autoplay_speed			= "<?php echo esc_attr($canon_options_frame['block_carousel_autoplay_speed']); ?>"	
				data-stop_on_hover			= "<?php echo esc_attr($canon_options_frame['block_carousel_stop_on_hover']); ?>"
				data-pagination 			= "<?php echo esc_attr($canon_options_frame['block_carousel_pagination']); ?>"
			>
			
			

			<?php

				for ($i = 0; $i < count($results_query); $i++) { 

					$this_post = $results_query[$i];

	                $the_excerpt = canon_fw_get_excerpt($this_post->ID, $canon_options_frame['block_carousel_excerpt_length']);

	                // ITEM WRAPPER
	                echo ' <div class="item">';

	                // FEATURED IMAGE
	                if ($canon_options_frame['block_carousel_show_featured_image'] == "checked") {

                        $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID), 'canon_block_carousel');
                        $img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
                        $img_post = get_post(get_post_thumbnail_id($this_post->ID));

                        if (has_post_thumbnail($this_post->ID) && get_post(get_post_thumbnail_id($this_post->ID)) ) { 
                            printf('<a href="%s" title="%s"><img src="%s" alt="%s" /></a>', esc_url(get_permalink($this_post->ID)), esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                        }

	                }

	                // CONTENT
	                if ($canon_options_frame['block_carousel_show_title'] == "checked" || $canon_options_frame['block_carousel_show_excerpt'] == "checked") {
	                	
	                	echo '<div class="owl-item-boxed-content">';
						
						if ($canon_options_frame['block_carousel_show_title'] == "checked") { printf('<h3 class="block-carousel-title"><a href="%s">%s</a></h3>', esc_url(get_permalink($this_post->ID)), wp_kses_post($this_post->post_title)); }
						if ($canon_options_frame['block_carousel_show_excerpt'] == "checked") { printf('<div class="block-carousel-excerpt">%s <a class="read-more" href="%s">%s</a></div>', wp_kses_post($the_excerpt), esc_url(get_permalink($this_post->ID)), wp_kses_post($canon_options['read_more_text']) ); }

	                	echo '</div>';

	                }

	                // END ITEM WRAPPER
	            	echo '</div>';

	            }

	        ?>


			    

			</div>
			<!-- end owl-carousel -->

		</div>
