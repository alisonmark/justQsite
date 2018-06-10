<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options'); 
    $canon_options_post = get_option('canon_options_post'); 

    // GET CMB DATA
    $cmb_single_style = get_post_meta( $post->ID, 'cmb_single_style', true);
    $cmb_feature = get_post_meta( $post->ID, 'cmb_feature', true);
    $cmb_media_link = get_post_meta( $post->ID, 'cmb_media_link', true);
    $cmb_hide_feature_in_post = get_post_meta( $post->ID, 'cmb_hide_feature_in_post', true);
    $cmb_post_show_post_slider = get_post_meta( $post->ID, 'cmb_post_show_post_slider', true);

    $cmb_post_show_info = get_post_meta($post->ID, 'cmb_post_show_info', true);
    $cmb_post_show_ratings = get_post_meta( $post->ID, 'cmb_post_show_ratings', true);
    $cmb_post_show_ad = get_post_meta( $post->ID, 'cmb_post_show_ad', true);
    $cmb_post_show_author = get_post_meta( $post->ID, 'cmb_post_show_author', true);
	$cmb_post_show_more_carousel = get_post_meta( $post->ID, 'cmb_post_show_more_carousel', true);

    // DEFAULTS
    if (empty($cmb_single_style)) $cmb_single_style = "default";
    if (!isset($canon_options_post['show_meta_author'])) { $canon_options_post['show_meta_author'] = "checked"; }
    if (!isset($canon_options_post['show_meta_date'])) { $canon_options_post['show_meta_date'] = "checked"; }
    if (!isset($canon_options_post['show_meta_comments'])) { $canon_options_post['show_meta_comments'] = "checked"; }
    if (!isset($canon_options_post['show_meta_categories'])) { $canon_options_post['show_meta_categories'] = "checked"; }
    $has_meta = ($canon_options_post['show_meta_author'] == "checked" || $canon_options_post['show_meta_date'] == "checked" || $canon_options_post['show_meta_comments'] == "checked" || $canon_options_post['show_meta_categories'] == "checked") ? true : false;
    if (!isset($canon_options_post['show_tags'])) { $canon_options_post['show_tags'] = "checked"; }

    // HANDLE POST SLIDER
    $consolidated_slider_array = array();
    if ($cmb_post_show_post_slider == "checked") {
        $cmb_post_slider_source = get_post_meta( $post->ID, 'cmb_post_slider_source', true);
        $post_slider_array = canon_fw_strip_wp_galleries_to_array($cmb_post_slider_source);
        $consolidated_slider_array = canon_fw_convert_wp_galleries_array_to_consolidated_wp_gallery_array($post_slider_array);
    }

    // DETERMINE POST STYLE
    $cmb_single_style = ($cmb_single_style == "default") ? $canon_options_post['single_default_post_style'] : $cmb_single_style;
    $has_sidebar = (strpos($cmb_single_style, "sidebar") !== false) ? true : false;
    $feature_position = (strpos($cmb_single_style, "full") !== false) ? "full" : "compact";

    // SET CONTROLLER CLASSES
    $controller_classes = "is-col-1-1 is-boxed";
    $controller_classes .= ($canon_options_post['single_use_dropcap'] == "checked") ? " is-dropcap" : " not-dropcap";
    $controller_classes .= " not-full";
    $controller_classes .= ($has_sidebar) ? " is-sidebar" : " not-sidebar";
    $controller_classes .= ($canon_options['sidebars_alignment'] == "left") ? " is-sidebar-left" : " not-sidebar-left";

    // setcookie('belle_cookie', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, false);


?>

    <!-- BEGIN LOOP -->
    <?php while ( have_posts() ) : the_post(); ?>

		<!-- OUTTER-WRAPPER-PARENT -->
		<div class="outter-wrapper-parent">
			

            <!-- FEATURED IMAGE -->
            <?php if ( ($cmb_post_show_post_slider == "checked" || ( canon_fw_has_feature(get_the_ID()) && $cmb_hide_feature_in_post != "checked" )) && $feature_position == "full" ) : ?>

                <div class="outter-wrapper featImage full-width-feat-image overlay-content <?php if ($canon_options['overlay_header'] == "checked") { echo "overlay-header";} ?>">

                    <div class="flexslider flexslider-standard">

                        <ul class="slides">

                        <?php

                            if ($cmb_post_show_post_slider != "checked") {
                                
                                if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                    printf('<li>%s</li>', canon_fw_sanitized_output($cmb_media_link));
                                } else {
                                    $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                    $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                    $img_post = get_post(get_post_thumbnail_id(get_the_ID()));

                                    if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                        printf("<li><a class='fancybox-media fancybox.iframe' href='%s'><img src='%s' alt='%s'></a></li>", esc_url($cmb_media_link), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                    } elseif ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                        printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                    }
                                }
                                    
                            } else {
                                    
                                for ($i = 0; $i < count($consolidated_slider_array); $i++) {  
                                    $post_thumbnail_src = wp_get_attachment_image_src($consolidated_slider_array[$i]['id'],'full');
                                    $img_alt = get_post_meta($consolidated_slider_array[$i]['id'], '_wp_attachment_image_alt', true);
                                    $img_post = get_post($consolidated_slider_array[$i]['id']);
                                    printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_excerpt), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                }
                            }

                        ?>
                        
                        </ul>
                        
                    </div>

                </div>

            <?php endif; ?>


			                            
			<!-- MAIN CONTENT AREA-->
			<div class="outter-wrapper clearfix page-content <?php echo esc_attr($controller_classes); ?>">

				<!-- THE POST -->
				<div class="main-column">
				
					<!-- Start Post -->
                    <div 
                        id="post-<?php the_ID(); ?>" <?php post_class(); ?>
                        data-post_ID="<?php the_ID(); ?>" 
                        data-nonce="<?php echo wp_create_nonce('like_post_' . get_the_ID()); ?>"
                    >

						<div class="inner-wrapper">	

                            <!-- FEATURED IMAGE -->
                            <?php if ( ($cmb_post_show_post_slider == "checked" || ( canon_fw_has_feature(get_the_ID()) && $cmb_hide_feature_in_post != "checked" )) && $feature_position == "compact" ) : ?>

                                <div class="featImage">

                                    <div class="flexslider flexslider-standard">
                                        <ul class="slides">

                                        <?php

                                            if ($cmb_post_show_post_slider != "checked") {
                                                
                                                if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                                                    printf('<li>%s</li>', canon_fw_sanitized_output($cmb_media_link));
                                                } else {
                                                    $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
                                                    $img_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                                    $img_post = get_post(get_post_thumbnail_id(get_the_ID()));

                                                    if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id(get_the_ID())) ) {
                                                        printf("<li><a class='fancybox-media fancybox.iframe' href='%s'><img src='%s' alt='%s'></a></li>", esc_url($cmb_media_link), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                    } elseif ( has_post_thumbnail(get_the_ID()) && get_post(get_post_thumbnail_id(get_the_ID())) ) { 
                                                        printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_title), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                    }
                                                }
                                                    
                                            } else {
                                                    
                                                for ($i = 0; $i < count($consolidated_slider_array); $i++) {  
                                                    $post_thumbnail_src = wp_get_attachment_image_src($consolidated_slider_array[$i]['id'],'full');
                                                    $img_alt = get_post_meta($consolidated_slider_array[$i]['id'], '_wp_attachment_image_alt', true);
                                                    $img_post = get_post($consolidated_slider_array[$i]['id']);
                                                    printf("<li><a title='%s' href='%s'><img src='%s' alt='%s'></a></li>", esc_attr($img_post->post_excerpt), esc_url($post_thumbnail_src[0]), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                                                }
                                            }

                                        ?>
                                        
                                        </ul>
                                    </div>

                                </div>

                            <?php endif; ?>


							<!-- META -->
							<div class="top-post-meta clearfix">

                                <!-- AVATAR -->
								<?php echo get_avatar(get_the_author_meta('ID'), 72, '', 'author-avatar'); ?>

                                <?php 

                                    // DATE
                                    $archive_year  = get_the_time('Y'); 
                                    $archive_month = get_the_time('m'); 
                                    $archive_day   = get_the_time('d');                             

                                    // LIKED CLASS
                                    $likes_string = canon_fw_cookie_get_key_value ("belle_cookie", "post-likes");
                                    $liked_class = (canon_fw_is_value_in_delim_string($likes_string,get_the_ID(),",")) ? "liked" : "";
                                    $post_likes = get_post_meta(get_the_ID(), 'post_likes', true);
                                    if (empty($post_likes)) { $post_likes = 0; }
                                    $post_views = get_post_meta(get_the_ID(), 'post_views', true);

                                    // BYLINE AND PUBLISH DATE
                                    echo '<div class="author-meta">';

                                    if ($canon_options_post['show_meta_author'] == "checked") { printf('%s <a class="meta-author" href="%s">%s</a>', esc_attr(esc_html__('Written By', 'loc-canon-belle')), esc_url(get_author_posts_url( get_the_author_meta('ID'))), esc_attr(get_the_author()) ); }
                                    if ($canon_options_post['show_meta_author'] == "checked" && $canon_options_post['show_meta_date'] == "checked") { esc_html_e(' on ', 'loc-canon-belle'); }
                                    if ($canon_options_post['show_meta_date'] == "checked") { printf('<a class="meta-date" href="%s">%s</a>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(canon_fw_localize_datetime(get_the_time(get_option('date_format')))) ); }

                                    echo '</div>';

                                    // SOCIAL LINKS
                                    echo '<ul class="socialList">';

                                    if ($canon_options_post['show_meta_comments'] == "checked") { printf('<li><a class="meta-comments" href="%s"><em class="fa fa-comment"></em>%s</a></li>', esc_url(get_the_permalink() . "#comments"), esc_attr(get_comments_number()) ); }
                                    if ($canon_options_post['show_meta_likes'] == "checked" && get_post_type() == "post") { printf('<li><a href="#" class="heart %s"><em class="fa fa-heart"></em>%s</a></li>', esc_attr($liked_class), esc_attr($post_likes)); }
                                    if ($canon_options_post['show_meta_views'] == "checked") { printf('<li><a class="meta-views"><em class="fa fa-eye"></em>%s</a></li>', esc_attr($post_views) ); }
                                    if ($canon_options_post['show_share_link_facebook'] == "checked") { printf('<li><a href="https://www.facebook.com/sharer/sharer.php?u=%s" target="_blank"><i class="fa fa-facebook"></i></a></li>', esc_url(get_the_permalink())); }
                                    if ($canon_options_post['show_share_link_twitter'] == "checked") { printf('<li><a href="http://twitter.com/share?url=%s" target="_blank"><i class="fa fa-twitter"></i></a></li>', esc_url(get_the_permalink())); }
                                    if ($canon_options_post['show_share_link_google_plus'] == "checked") { printf('<li><a href="https://plus.google.com/share?url=%s" target="_blank"><i class="fa fa-google-plus"></i></a></li>', esc_url(get_the_permalink())); }
                                    if ($canon_options_post['show_share_link_pinterest'] == "checked") { printf('<li><a href="%s" target="_blank"><i class="fa fa-pinterest"></i></a></li>', esc_url(canon_fw_get_pinterest_share_url(get_the_ID())) ); }

                                    echo '</ul>';

                                ?>
								
							</div>
							
                            <!-- CATEGORIES -->
                            <?php if ($canon_options_post['show_meta_categories'] == 'checked') { echo wp_kses_post(get_the_category_list()); } ?>

							<!-- TITLE -->
							<div class="postTitle"><h1><?php the_title(); ?></h1></div>
							
                            <!-- THE CONTENT -->
							<div class="postText">

                                <?php the_content(); ?>
                                <div class="link-pages"><?php wp_link_pages(array('before' => '<p>' . esc_html__('Pages:','loc-canon-belle'))); ?></div>
							
                                <!-- INFO BOX -->
                                <?php if ($cmb_post_show_info == "checked") { get_template_part('/inc/templates/components/template_post_component_info'); } ?>
                                
                                <!-- RATINGS -->
                                <?php if ($cmb_post_show_ratings == "checked") { get_template_part('/inc/templates/components/template_post_component_ratings'); } ?>
                        
                               	<!-- TAGS -->
       							<?php if ($canon_options_post['show_tags'] == "checked") { get_template_part('/inc/templates/components/template_post_component_tags'); } ?>
       							
       							<!-- ABOUT THE AUTHOR -->
       							<?php if ($cmb_post_show_author == "checked") { get_template_part('/inc/templates/components/template_post_component_author'); } ?>
                           	
                           	</div>						 
							
						</div>
							
                        <!-- AD -->
                        <?php if ($cmb_post_show_ad == "checked") { get_template_part('/inc/templates/components/template_post_component_ad'); } ?>

	                    <!-- MORE POSTS CAROUSEL -->
						<?php if ($cmb_post_show_more_carousel == "checked") { get_template_part('/inc/templates/components/template_post_component_carousel'); } ?>
						
						<!-- COMMENTS -->
                    	<?php if ($canon_options_post['show_comments'] == "checked") { comments_template( '', true ); } ?>
                    	
                    	<!-- POST PAGINATION -->    
                    	<?php if ($canon_options_post['show_post_nav'] == "checked") get_template_part('inc/templates/components/template_post_pagination'); ?>  

						
					</div>
					<!-- End Post -->
					
				</div>
				
			
                <!-- SIDEBAR -->
                <?php if ($has_sidebar) { get_sidebar(); } ?>

					
			</div>
			<!-- END MAIN CONTENT AREA-->

		</div>
		<!-- END OUTTER-WRAPPER-PARENT -->
	
    <?php endwhile; ?>
    <!-- END LOOP -->
	
