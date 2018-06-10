<?php
							
	//VARS
    $canon_options = get_option('canon_options'); 
    $canon_options_post = get_option('canon_options_post'); 

	// DETERMINE PAGE TYPE (home, page or category)
	$page_type = canon_fw_get_page_type();

    // SET TITLE STRING
    switch ($page_type) {
        case 'category':
            $archive_title = esc_html__('in category', 'loc-canon-belle');
            $archive_subject = single_cat_title('', false);
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'tag':
            $archive_title = esc_html__('tagged', 'loc-canon-belle');
            $archive_subject = single_tag_title('', false);
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'search':
            $archive_title = esc_html__('searching for', 'loc-canon-belle');
            $archive_subject = get_search_query();
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'author':
            $archive_title = esc_html__('by', 'loc-canon-belle');
            $archive_subject = get_the_author_meta('display_name',$wp_query->post->post_author);
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'day':
            $archive_title = esc_html__('from day', 'loc-canon-belle');
            $archive_subject =  get_the_time('d/m/Y');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'month':
            $archive_title = esc_html__('from month', 'loc-canon-belle');
            $archive_subject = get_the_time('m/Y');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'year':
            $archive_title = esc_html__('from year', 'loc-canon-belle');
            $archive_subject = get_the_time('Y');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        case 'tax':
            $archive_title = esc_html__('in group', 'loc-canon-belle');
            $archive_subject = get_query_var('term');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
        default:
            $archive_title = esc_html__('browsing', 'loc-canon-belle');
            $archive_subject = esc_html__('Unknown', 'loc-canon-belle');
            $archive_title_string = sprintf('%s <span>%s</span>', $archive_title, $archive_subject);
            break;
    }


    $num_posts_found = $wp_query->found_posts;
    $num_posts_found_postfix = ($num_posts_found == "1") ? esc_html__("post", "loc-canon-belle") : esc_html__("posts", "loc-canon-belle");
    if ($page_type == "search") { $num_posts_found_postfix = ($num_posts_found === 1) ? esc_html__("result", "loc-canon-belle") : esc_html__("results", "loc-canon-belle"); }
    $num_posts_found_string = sprintf('%s %s', esc_attr($num_posts_found), esc_attr($num_posts_found_postfix) );

    // SET CONTROLLER CLASSES
    $controller_classes = "is-col-1-1 not-boxed is-classic not-dropcap not-sidebar";
    $controller_classes .= " not-full";


?>

			<div class="outter-wrapper clearfix archive-header <?php echo esc_attr($controller_classes); ?> <?php if ($canon_options['overlay_header'] == "checked") { echo "overlay-header"; } ?>">

				<!-- SUMMARY -->
				<?php if (!($page_type == "category" && $canon_options_post['show_cat_title'] != "checked")) { printf('<h1>%s %s</h1>', esc_attr($num_posts_found_string), wp_kses_post($archive_title_string)); } ?>
				
				
				<?php if ($page_type == "author") : ?>

				<?php
					
				    $author_description = get_the_author_meta('description');
				    $author_description = (!empty($author_description)) ? $author_description : esc_html__("This author has not supplied a bio yet.","loc-canon-belle");

				?>

					<!-- AUTHOR BOX -->
					<div class="postAuthor">

						<div class="postAuthor-inner">

                            <?php 

                                // AVATAR
                                echo get_avatar(get_the_author_meta('ID'), 72, '', 'author-avatar');

                                // BIO
                                printf('<p>%s</p>', wp_kses_post($author_description));

                                // SOCIAL LINKS
                                if (canon_fw_get_author_social_links_list()) { printf('<div class="author-social">%s</div>', wp_kses_post(canon_fw_get_author_social_links_list())); }
                                
                            ?>

						</div>	

					</div>

				<?php endif; ?>


                <?php $category_description = category_description(); ?>

                <?php if ( $page_type == "category" && $canon_options_post['show_cat_description'] == "checked" && !empty($category_description) ) : ?>

                    <!-- CATEGORY DESCRIPTION -->
                    <div class="category-description">

                        <div class="category-description-inner">

                            <?php echo wp_kses_post($category_description); ?>

                        </div>

                    </div>

                <?php endif; ?>


			</div>
