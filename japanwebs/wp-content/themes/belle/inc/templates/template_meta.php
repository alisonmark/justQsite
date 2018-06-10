<?php
	
    // GET OPTIONS
    $canon_options_post = get_option('canon_options_post'); 
	
?>

									<!-- META -->
									<div class="postMeta">	

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

											if ($canon_options_post['show_meta_author'] == "checked" 
												|| $canon_options_post['show_meta_date'] == "checked"
												|| $canon_options_post['show_meta_comments'] == "checked"
												|| $canon_options_post['show_meta_likes'] == "checked"
												|| $canon_options_post['show_meta_views'] == "checked") {

												echo "<div class='dateMeta'>";
												if ($canon_options_post['show_meta_author'] == "checked") { printf('<a class="meta-author" href="%s"><em class="fa fa-user"></em>%s</a>', esc_url(get_author_posts_url( get_the_author_meta('ID'))), esc_attr(get_the_author()) ); }
												if ($canon_options_post['show_meta_date'] == "checked") { printf('<a class="meta-date" href="%s"><em class="fa fa-calendar"></em>%s</a>', esc_url(get_day_link( $archive_year, $archive_month, $archive_day)), esc_attr(canon_fw_localize_datetime(get_the_time(get_option('date_format')))) ); }
												if ($canon_options_post['show_meta_comments'] == "checked") { printf('<a class="meta-comments" href="%s"><em class="fa fa-comment"></em>%s</a>', esc_url(get_the_permalink() . "#comments"), esc_attr(get_comments_number()) ); }
												if ($canon_options_post['show_meta_likes'] == "checked" && get_post_type() == "post") { printf('<a href="#" class="heart %s"><em class="fa fa-heart"></em>%s</a>', esc_attr($liked_class), esc_attr($post_likes)); }
												if ($canon_options_post['show_meta_views'] == "checked") { printf('<a class="meta-views" href="%s"><em class="fa fa-eye"></em>%s</a> ', esc_url(get_the_permalink()), esc_attr($post_views) ); }
												echo "</div>";
											}

										?>

										<?php 

											// SHARE LINKS
											echo '<ul class="socialList"><li><em class="fa fa-share-alt"></em><ul>';

											if ($canon_options_post['show_share_link_facebook'] == "checked") { printf('<li><a href="https://www.facebook.com/sharer/sharer.php?u=%s" target="_blank"><i class="fa fa-facebook"></i></a></li>', esc_url(get_the_permalink())); }
											if ($canon_options_post['show_share_link_twitter'] == "checked") { printf('<li><a href="http://twitter.com/share?url=%s" target="_blank"><i class="fa fa-twitter"></i></a></li>', esc_url(get_the_permalink())); }
											if ($canon_options_post['show_share_link_google_plus'] == "checked") { printf('<li><a href="https://plus.google.com/share?url=%s" target="_blank"><i class="fa fa-google-plus"></i></a></li>', esc_url(get_the_permalink())); }
											if ($canon_options_post['show_share_link_pinterest'] == "checked") { printf('<li><a href="%s" target="_blank"><i class="fa fa-pinterest"></i></a></li>', esc_url(canon_fw_get_pinterest_share_url(get_the_ID())) ); }

											echo '</ul></li></ul>';

										?>

									</div>


