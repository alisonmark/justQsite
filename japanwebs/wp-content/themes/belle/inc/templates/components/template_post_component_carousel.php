<?php
	
    // GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

	// GET VARS
	$show = $cmb_post_more_carousel_shows = get_post_meta($post->ID, 'cmb_post_more_carousel_shows', true);
	$title = get_post_meta($post->ID, 'cmb_post_more_carousel_title', true);
	$num_posts = get_post_meta($post->ID, 'cmb_post_more_carousel_num_load', true);
	$num_show = get_post_meta($post->ID, 'cmb_post_more_carousel_num_show', true);
	$cmb_post_more_carousel_hide_excerpts = get_post_meta($post->ID, 'cmb_post_more_carousel_hide_excerpts', true);
	$excerpt_length = get_post_meta($post->ID, 'cmb_post_more_carousel_excerpt_length', true);

	// GET POSTS
	$results_query = canon_fw_get_posts_from_show_select($show, $num_posts, true);

?>


						<div class="inner-wrapper">	
						
							<div class="post-component-container post-component-carousel postRecommend clearfix">
								
								<!-- TITLE -->
								<h3 class="feat-title"><?php echo wp_kses_post($title); ?></h3>

									
								<div class="owl-carousel-nav more-posts-carousel-nav">
								    <a class="prev-btn"><i class="fa fa-angle-left"></i></a>
								    <a class="next-btn"><i class="fa fa-angle-right"></i></a>
								</div>
								
								<div class="owl-carousel more-posts-carousel" data-items="<?php echo esc_attr($num_show); ?>">

									<?php

										for ($i = 0; $i < count($results_query); $i++) {

											$this_post = $results_query[$i];

											// skip this post if no featured image
											if (!has_post_thumbnail($this_post->ID) || !get_post(get_post_thumbnail_id($this_post->ID)) ) { continue; }

                            				$the_excerpt = canon_fw_get_excerpt( $this_post->ID, $excerpt_length);

											?>

												<div class="carousel-post">

													<?php 

														// IMAGE VARS
														$post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'canon_post_component_carousel');
														$img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
		                                                $img_post = get_post(get_post_thumbnail_id($this_post->ID));
			                                            
			                                            // FEATURED IMAGE
														printf('<a href="%s" title="%s"><img src="%s" alt="%s" /></a>', esc_url(get_permalink($this_post->ID)), esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));	

													?>

													<!-- TITLE -->
													<?php printf('<div class="title"><a href="%s">%s</a></div>', esc_url(get_permalink($this_post->ID)), esc_attr(strip_tags($this_post->post_title))); ?>

													<!-- DATE -->
													<?php 

														// DATE
														$archive_year  = get_the_time('Y', $this_post->ID); 
														$archive_month = get_the_time('m', $this_post->ID); 
														$archive_day   = get_the_time('d', $this_post->ID); 							

														if ($canon_options_post['show_meta_date'] == "checked") { printf('<div class="meta"><a class="meta-date" href="%s"><em class="fa fa-calendar"></em>%s</a></div>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(canon_fw_localize_datetime(get_the_time(get_option('date_format'), $this_post->ID))) ); } 

													?>

													<!-- EXCERPT -->
													<?php if ($cmb_post_more_carousel_hide_excerpts != "checked") { printf('<div class="excerpt">%s</div>', wp_kses_post($the_excerpt )); } ?>

												
												</div>

											<?php
										}

									?>

								</div>
								
							</div>
							
						</div>
