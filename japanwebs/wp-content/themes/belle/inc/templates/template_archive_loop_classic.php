<?php 

    // GET OPTIONS
    $canon_options = get_option('canon_options');
   	$canon_options_frame = get_option('canon_options_frame');
    $canon_options_post = get_option('canon_options_post'); 

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['homepage_excerpt_length'])) { $canon_options_post['homepage_excerpt_length'] = wp_filter_nohtml_kses($_GET['homepage_excerpt_length']); }
    }

	// VARS
	$post_counter = 0;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$posts_per_page = get_query_var('posts_per_page');

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

    $excerpt_length = $canon_options_post[$prefix . '_excerpt_length'];

    // SET ISOTOPE CLASS
    $isotope_class = "isotope-classic-layout";

?>

				<!-- POSTS -->
				<div class="main-column">

					<div class="main-isotope-container <?php echo esc_attr($isotope_class); ?>">

	                    <!-- MAIN LOOP -->
	                    <?php while ( have_posts() ) : the_post(); ?>

	                        <?php 

	                            $post_format = get_post_format();
	                            $cmb_feature = get_post_meta(get_the_ID(), 'cmb_feature', true);
	                            $cmb_media_link = get_post_meta(get_the_ID(), 'cmb_media_link', true);
	                            $cmb_byline = get_post_meta(get_the_ID(), 'cmb_byline', true);
	                            $cmb_quote_is_tweet = get_post_meta(get_the_ID(), 'cmb_quote_is_tweet', true);
	                            $cmb_post_show_post_slider = get_post_meta(get_the_ID(), 'cmb_post_show_post_slider', true);
	                            $has_feature = canon_fw_has_feature(get_the_ID());
	                            $the_excerpt = canon_fw_get_excerpt(get_the_ID(), $excerpt_length);

								// CALCULATE POST NUMBER
								$post_counter++;
								$post_number = ( ($paged-1) * $posts_per_page ) + $post_counter;	// first post is 1 not 0
								// $page_one_extra_posts_adjustment = 0;	// if you have more posts on page one than set in "blog pages show at most" because of sticky posts not otherwise on page one you can adjust so that post numbers on subsequent pages are calculated correct. Just set this var to the number of extra posts on page one.
								// if ($paged > 1) { $post_number += $page_one_extra_posts_adjustment; }

							    // HANDLE POST SLIDER
							    $consolidated_slider_array = array();
							    if ($cmb_post_show_post_slider == "checked") {
							        $cmb_post_slider_source = get_post_meta( get_the_ID(), 'cmb_post_slider_source', true);
							        $post_slider_array = canon_fw_strip_wp_galleries_to_array($cmb_post_slider_source);
							        $consolidated_slider_array = canon_fw_convert_wp_galleries_array_to_consolidated_wp_gallery_array($post_slider_array);
							    }

	                        ?>

	                        <?php 
							/***************************************************************
							INDEX

							STANDARD POST + VIDEO POST + AUDIO POST
							QUOTE POST
							ARCHIVE ADS
							****************************************************************/ 
	                        ?>


							<?php 
							/***************************************************************
							STANDARD POST + VIDEO POST + AUDIO POST
							****************************************************************/ 
							?>

	                        <?php if ( ($post_format === false) || ($post_format === "video") || ($post_format === "audio") || ($post_format === "gallery") ) : ?>

								
								<div 
									id="post-<?php the_ID(); ?>" <?php post_class('single-item'); ?>
									data-post_ID="<?php the_ID(); ?>" 
									data-nonce="<?php echo wp_create_nonce('like_post_' . get_the_ID()); ?>"
								>

						
									<div class="inner-wrapper">	

										<!-- FEATURE -->
										<?php if ($cmb_post_show_post_slider == "checked" || $has_feature) { echo '<div class="featImage">'; }?>

											<?php 

	                                            if ($cmb_post_show_post_slider == "checked") {

	                                            	echo '<div class="flexslider flexslider-standard"><ul class="slides">';

	                                                for ($i = 0; $i < count($consolidated_slider_array); $i++) { 
	                                                    $post_thumbnail_src = wp_get_attachment_image_src($consolidated_slider_array[$i]['id'], 'full');
	                                                    $img_alt = get_post_meta($consolidated_slider_array[$i]['id'], '_wp_attachment_image_alt', true);
	                                                    $img_post = get_post($consolidated_slider_array[$i]['id']);
	                                                    printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_excerpt), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
	                                                }

	                                                echo '</ul></div>';
	                                                    
	                                            } elseif ($has_feature) {

		                                            if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
		                                                canon_fw_sanitized_output($cmb_media_link);
		                                            } else {
		                                                $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
		                                                $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
		                                                $img_post = get_post(get_post_thumbnail_id(get_the_ID()));

		                                                if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
		                                                    printf('<a href="%s" class="fancybox-media fancybox.iframe play"><img src="%s" alt="%s" /></a>', esc_url($cmb_media_link), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
		                                                } elseif (has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
		                                                    printf('<a href="%s" title="%s"><img src="%s" alt="%s" /></a>', esc_url(get_permalink(get_the_ID())), esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
		                                                }
		                                            }

		                                        }

		                                    ?>

										<?php if ($cmb_post_show_post_slider == "checked" || $has_feature) { echo '</div>'; }?>

										
										<div class="postText">

											<!-- TITLE -->
											<?php if (get_the_title()) { printf('<a class="postTitle" href="%s"><h1>%s</h1></a>', esc_url(get_the_permalink()), wp_kses_post(get_the_title())); } ?>

											<!-- META -->
											<?php get_template_part('/inc/templates/template_meta'); ?>

											<div class="classic-dropcap">

												<!-- EXCERPT -->
												<?php echo wp_kses_post($the_excerpt); ?>
												
												<!-- READ MORE -->
												<p><a href="<?php the_permalink(); ?>" class="read-more"><?php echo wp_kses_post($canon_options['read_more_text']); ?></a></p>
												
											</div>

										</div>

									</div>
									
								</div>

		                    <?php endif; ?>


						
							<?php 
							/***************************************************************
							QUOTE POST
							****************************************************************/ 
							?>

	                        <?php if ( ($post_format == "quote") ) : ?>

								<div 
									id="post-<?php the_ID(); ?>" <?php post_class('single-item'); ?>
									data-post_ID="<?php the_ID(); ?>" 
									data-nonce="<?php echo wp_create_nonce('like_post_' . get_the_ID()); ?>"
								>

									<div class="inner-wrapper post-format-quote <?php if ($cmb_quote_is_tweet == "checked") { echo "is-tweet"; } ?>">	

										<!-- EXCERPT -->
										<div class="postText">

											<!-- QUOTE -->
											<blockquote><?php echo wp_kses_post($the_excerpt); ?></blockquote>
											
											<!-- TITLE -->
											<?php if (!empty($cmb_byline)) { printf('<cite> &nbsp; <a class="cite" href="%s">%s</a></cite>', esc_url(get_the_permalink()), esc_attr($cmb_byline)); } ?>

										</div>
										
									</div>

								</div>

		                    <?php endif; ?>


							<?php 
							/***************************************************************
							ARCHIVE ADS
							****************************************************************/ 

							?>

							<?php 

								foreach ($canon_options_post['archive_ads'] as $key => $this_ad) {
											
									// DETERMINE SHOW ADS
									$show_ad = false;
										
									if ($page_type == 'home' || $page_type == 'page') {                     	// blog
										if ($this_ad['show_ad_homepage'] == "checked") { $show_ad = true; }
									} elseif ($page_type == 'category') {                                   	// category
										if ($this_ad['show_ad_category'] == "checked") { $show_ad = true; }
									} else {																	// all other archive pages
										if ($this_ad['show_ad_archive'] == "checked") { $show_ad = true; }
									}

									if ($show_ad) {

										// get ad code
										$ad_code = $this_ad['ad_code'];

										// if match then display
										$append_to_posts_string = $this_ad['append_to_posts'];
										$append_to_posts_array = explode(',', $append_to_posts_string);
										foreach ($append_to_posts_array as $key => $append_to_this_post_number) {
											$append_to_this_post_number = trim($append_to_this_post_number);
											if ($append_to_this_post_number == $post_number) {
												 
												printf('<div class="single-item ad">');
												echo '<div class="inner-wrapper ad-container">';
												echo do_shortcode($ad_code);
												echo '</div>';
												echo '</div>';
												   
											}
										}
									}

								}

							?>



	                    <?php endwhile; ?>
	                    <!-- END LOOP -->

					</div>
				
					<!-- PAGINATION -->
					<?php get_template_part("inc/templates/template_archive_pagination_" . $canon_options_post[$prefix . '_pagination']); ?>

				</div>
				<!-- END MAIN-COLUMN -->
