<?php
	
    // GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 

    $author_description = get_the_author_meta('description');
    $author_description = (!empty($author_description)) ? $author_description : esc_html__("This author has not supplied a bio yet.","loc-canon-belle");

	$cmb_post_author_title = get_post_meta($post->ID, 'cmb_post_author_title', true);

?>

				
						<div class="post-component-container post-component-author postAuthor">

							<?php if (!empty($cmb_post_author_title)) { printf('<div class="author-title"><h3 class="feat-title">%s</h3></div>', wp_kses_post($cmb_post_author_title)); } ?>
							
							<div class="postAuthor-inner clearfix">
								
								<div class="col-2-5"> 

									<?php echo get_avatar(get_the_author_meta('ID'), 72, '', 'author-avatar'); ?>
									
	                                <?php 

	                                    // DATE
	                                    $archive_year  = get_the_time('Y'); 
	                                    $archive_month = get_the_time('m'); 
	                                    $archive_day   = get_the_time('d');                             

	                                    // BYLINE AND PUBLISH DATE
	                                    echo '<div class="author-meta"><div>';

	                                    if ($canon_options_post['show_meta_author'] == "checked") { printf('%s <a class="meta-author" href="%s">%s</a>', esc_html__('Written By', 'loc-canon-belle'), esc_url(get_author_posts_url( get_the_author_meta('ID'))), esc_attr(get_the_author()) ); }
	                                    if ($canon_options_post['show_meta_author'] == "checked" && $canon_options_post['show_meta_date'] == "checked") { printf('<br> %s', esc_html__(' on ', 'loc-canon-belle')); }
	                                    if ($canon_options_post['show_meta_date'] == "checked") { printf('<a class="meta-date" href="%s">%s</a>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(canon_fw_localize_datetime(get_the_time(get_option('date_format')))) ); }

	                                    echo '</div></div>';

	                                    // SOCIAL LINKS
	                                    if (canon_fw_get_author_social_links_list()) { printf('<div class="author-social">%s</div>', wp_kses_post(canon_fw_get_author_social_links_list())); }

									?>

								</div>
								
								
								<div class="col-3-5 last">

									<?php echo wp_kses_post($author_description); ?>

								</div>
								
							</div>	

						</div>

					
