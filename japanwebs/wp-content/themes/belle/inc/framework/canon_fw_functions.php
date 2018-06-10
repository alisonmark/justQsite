<?php 

/**************************************
INDEX OF FUNCTIONS

canon_fw_get_author_social_links_list
canon_fw_filter_sensitive_input
canon_fw_filter_sensitive_output
canon_fw_get_pinterest_share_url
canon_fw_convert_percentage_to_inverse_ratio
canon_fw_kses_plus
canon_fw_get_posts_from_show_select
canon_fw_get_allowed_html_tags
canon_fw_get_breadcrumbs
canon_fw_get_cat_string
canon_fw_has_feature
canon_fw_list_categories_of_consolidated_wp_gallery
canon_fw_get_excerpt
canon_fw_get_exclude_array
canon_fw_get_exclude_string
canon_fw_strip_wp_galleries_to_array
canon_fw_convert_wp_galleries_array_to_consolidated_wp_gallery_array
canon_fw_array_replace
canon_fw_lcfirst
canon_fw_sanitize_output
canon_fw_sanitized_output
canon_fw_is_woocommerce_page
canon_fw_create_slug
canon_fw_get_col_size_class_from_num
canon_fw_get_size_class_from_num
canon_fw_tag_search_string
canon_fw_hex_opacity_to_rgba
canon_fw_rgb_to_hex
canon_fw_hex_to_rgb
canon_fw_get_google_webfonts_link
canon_fw_get_css_from_google_webfonts_settings_array
canon_fw_build_delim_string_from_array
canon_fw_add_value_to_delim_string
canon_fw_del_value_from_delim_string
canon_fw_is_value_in_delim_string
canon_fw_cookie_check_key_for_value
canon_fw_update_cookie_key_value
canon_fw_cookie_get_key_value
canon_fw_localize_datetime
canon_fw_show_admin_notice
canon_fw_format_datetime_str
canon_fw_make_excerpt
canon_fw_get_page_type
canon_fw_get_latest_tweets
canon_fw_filter_tweet
canon_fw_time_ago_tweet
canon_fw_get_twitter_count
canon_fw_get_facebook_count
canon_fw_update_post_views
canon_fw_get_post_views
canon_fw_update_post_views_single_check
canon_fw_get_rating_percentage
canon_fw_get_rating_color


***************************************/

/****************************************************
canon_fw_get_author_social_links_list
****************************************************/

	/**
	* @version 1.0
	*
	* @param int $user_id - optional. If not defined will get current author ID.
	*
	* @return string - contains html.
	*/

	if (!function_exists("canon_fw_get_author_social_links_list")) { function canon_fw_get_author_social_links_list ($user_id = NULL) {	

		// DEFAULT
		if ($user_id === NULL) { $user_id = get_the_author_meta('ID'); }

		$string = '';
		if (get_the_author_meta('user_url', $user_id)) { $string .= sprintf('<li><a href="%s" target="_blank"><em class="fa fa-globe"></em></a></li>', esc_url(get_the_author_meta('user_url', $user_id))); }
		if (get_the_author_meta('twitter', $user_id)) { $string .= sprintf('<li><a href="%s" target="_blank"><em class="fa fa-twitter"></em></a></li>', esc_url(get_the_author_meta('twitter', $user_id))); }
		if (get_the_author_meta('facebook', $user_id)) { $string .= sprintf('<li><a href="%s" target="_blank"><em class="fa fa-facebook"></em></a></li>', esc_url(get_the_author_meta('facebook', $user_id))); }
		if (get_the_author_meta('googleplus', $user_id)) { $string .= sprintf('<li><a href="%s" target="_blank"><em class="fa fa-google-plus"></em></a></li>', esc_url(get_the_author_meta('googleplus', $user_id))); }
		if (get_the_author_meta('linkedin', $user_id)) { $string .= sprintf('<li><a href="%s" target="_blank"><em class="fa fa-linkedin"></em></a></li>', esc_url(get_the_author_meta('linkedin', $user_id))); }
		if (get_the_author_meta('instagram', $user_id)) { $string .= sprintf('<li><a href="%s" target="_blank"><em class="fa fa-instagram"></em></a></li>', esc_url(get_the_author_meta('instagram', $user_id))); }
		
		if (empty($string)) { return false; }

		$string = '<ul class="author-social-links-list">' . $string . '</ul>';

		return $string;
	}}


/****************************************************
canon_fw_filter_sensitive_input
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $string
	*
	* @return string
	*/

	if (!function_exists("canon_fw_filter_sensitive_input")) { function canon_fw_filter_sensitive_input ($string) {	

		$string = str_replace('\\', '¤(bs)¤', $string);
		$string = str_replace('"', '¤(dq)¤', $string);
		$string = str_replace('\'', '¤(sq)¤', $string);
		$string = str_replace('<', '¤(lt)¤', $string);
		$string = str_replace('>', '¤(gt)¤', $string);

		return $string;
	}}





/****************************************************
canon_fw_filter_sensitive_output
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $string
	*
	* @return string
	*/

	if (!function_exists("canon_fw_filter_sensitive_output")) { function canon_fw_filter_sensitive_output ($string) {	

		$string = str_replace('¤(bs)¤', '\\', $string);
		$string = str_replace('¤(dq)¤', '"', $string);
		$string = str_replace('¤(sq)¤', '\'', $string);
		$string = str_replace('¤(lt)¤', '<', $string);
		$string = str_replace('¤(gt)¤', '>', $string);

		return $string;
	}}


/**************************************
canon_fw_get_pinterest_share_url
***************************************/

	/**
	* @version 1.0
	*
	* @param int $post_id
	*
	* @return string - url
	*/

	if (!function_exists("canon_fw_get_pinterest_share_url")) { function canon_fw_get_pinterest_share_url ($post_id) {

    	$canon_options_frame = get_option('canon_options_frame'); 

    	// base
    	$url = "http://pinterest.com/pin/create/button/";

    	// add url
    	$url .= sprintf('?url=%s', urlencode(esc_url(get_the_permalink($post_id))));

    	// add media
		if (empty($canon_options_frame['logo_url'])) { $canon_options_frame['logo_url'] = get_template_directory_uri() . "/img/logo@2x.png"; }
		$img_src = (wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full')) ? wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full') : array($canon_options_frame['logo_url']);

    	$url .= sprintf('&media=%s', urlencode(esc_url($img_src[0])));

		// add description
		$excerpt_length = 250;
		$the_excerpt = canon_fw_get_excerpt($post_id, $excerpt_length);

    	$url .= sprintf('&description=%s', urlencode(esc_attr($the_excerpt)));

		return $url;		

	}}


/**************************************
canon_fw_convert_percentage_to_inverse_ratio
***************************************/

	/**
	* @version 1.0
	*
	* @param int $percentage
	*
	* @return float
	*/

	if (!function_exists("canon_fw_convert_percentage_to_inverse_ratio")) { function canon_fw_convert_percentage_to_inverse_ratio ($percentage) {
			
    	$ratio = 1 - ($percentage / 100);

		return $ratio;

	}}



/**************************************
canon_fw_kses_plus
***************************************/

	/**
	* performs kses on $source. 
	* if $incl_allowedposttags (true/false) is set to true then global $allowedposttags (same as used in wp_kses_post) will be used as base tag whitelist.
	* add predefined tags to $tags array and these will be added to the whitelist.
	* Known tags so far: 'iframe', 'source'
	*
	* @version 1.0
	*
	* @param string $source
	* @param bool $incl_allowedposttags
	* @param array $tags
	*
	* @return string
	*/


	if (!function_exists("canon_fw_kses_plus")) { function canon_fw_kses_plus ($source, $incl_allowedposttags, $tags = array()) {

		$allowed_tags_array = array();

		if ($incl_allowedposttags === true) {
			global $allowedposttags;
			$allowed_tags_array = array_merge($allowed_tags_array, $allowedposttags);
		}

		// IFRAME
		if (in_array('iframe', $tags)) {
			$allowed_tags_array = array_merge($allowed_tags_array, array(
				'iframe' => array(
					'align' => true,
					'frameborder' => true,
					'height' => true,
					'longdesc' => true,
					'marginheight' => true,
					'marginwidth' => true,
					'name' => true,
					'sandbox' => true,
					'scrolling' => true,
					'seamless' => true,
					'src' => true,
					'srcdoc' => true,
					'width' => true,
					'allowFullScreen' => true,
					'webkitAllowFullScreen' => true,
					'mozallowfullscreen' => true,
				),
			));
				
		}
			
		// SOURCE	
		if (in_array('source', $tags)) {
			$allowed_tags_array = array_merge($allowed_tags_array, array(
				'source' => array(
					'src' => true,
					'type' => true,
				),
			));
				
		}
			
		ksort($allowed_tags_array, SORT_REGULAR);

		return wp_kses($source, $allowed_tags_array);

	}}





/**************************************
canon_fw_get_posts_from_show_select
***************************************/

	/**
	* @version 1.0
	*
	* @param string $show
	* @param int $num_posts
	* @param bool $exclude_current_post
	*
	* @return array - array of posts
	*/

	if (!function_exists("canon_fw_get_posts_from_show_select")) { function canon_fw_get_posts_from_show_select ($show, $num_posts, $exclude_current_post) {

		// get current post
		global $post;

		//basic args
		$query_args = array();
		$query_args = array_merge($query_args, array(
			'post_type'    			=> 'post',
			'numberposts' 			=> $num_posts,
			'post_status'     		=> 'publish',
			'offset' 				=> 0,
			'suppress_filters' 		=> false
		));

		// exclude current post
		if ($exclude_current_post) {
			$query_args = array_merge($query_args, array(
				'post__not_in'			=> array($post->ID),	// exclude the current post
			));
		}

		// show switch
		if ($show == "same_cat") {
			$categories_array = get_the_category($post->ID);
			$first_category_object = $categories_array[0];
			$query_args = array_merge($query_args, array(
				'category_name'		=> $first_category_object->slug,
				'orderby'			=> 'post_date',
				'order'				=> 'DESC',
			));
		} elseif ($show == "latest_posts") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'orderby'			=> 'post_date',
				'order'				=> 'DESC',
			));
		} elseif ($show == "random_posts") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'orderby'			=> 'rand',
			));
		} elseif ($show == "popular_views") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'meta_key'			=> 'post_views',
	 			'orderby'   		=> 'meta_value_num', //or 'meta_value_num'
				'order'				=> 'DESC',
				'exclude'			=> canon_fw_get_exclude_string('cmb_hide_from_popular'),
			));
		} elseif ($show == "popular_likes") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'meta_key'			=> 'post_likes',
	 			'orderby'   		=> 'meta_value_num', //or 'meta_value_num'
				'order'				=> 'DESC',
				'exclude'			=> canon_fw_get_exclude_string('cmb_hide_from_popular'),
			));
		} elseif ($show == "popular_comments") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'orderby'			=> 'comment_count',
				'order'				=> 'DESC',
				'exclude'			=> canon_fw_get_exclude_string('cmb_hide_from_popular'),
			));
		} elseif (strpos($show, "postcat_") !== false) {
			$show = str_replace("postcat_", "", $show);
			$query_args = array_merge($query_args, array(
				'category_name'		=> $show,
				'orderby'			=> 'post_date',
				'order'				=> 'DESC',
			));
		}

		//final query
		$results_query = get_posts($query_args);

		return $results_query;

	}}




/**************************************
canon_fw_get_allowed_html_tags
***************************************/

	/**
	* $allowedposttags from wp-includes/kses.php. Mainly to be used with kses functions.
	* Use this function to return or modify the default $allowedposttags array.
	* If function is called without params canon_fw_get_allowed_html_tags() it returns default allowed tags.
	* Or you can add two parameters canon_fw_get_allowed_html_tags($operator, $custom_array)
	* $operator must be "modify" or "remove" and will add/modify or remove the $custom_array to/from the default $allowedposttags.
	* Often used with wp_kses("modify", canon_fw_get_allowed_html_tags("modify", $custom_array)) where custom array for adding iframe to the allowed list would look like
	* 
	* 		$custom_array = array(
	* 			'iframe' => array(
	* 				'align' => true,
	* 				'frameborder' => true,
	* 				'height' => true,
	* 				'longdesc' => true,
	* 				'marginheight' => true,
	* 				'marginwidth' => true,
	* 				'name' => true,
	* 				'sandbox' => true,
	* 				'scrolling' => true,
	* 				'seamless' => true,
	* 				'src' => true,
	* 				'srcdoc' => true,
	* 				'width' => true,
	* 				'webkitAllowFullScreen' => true,
	* 				'mozallowfullscreen' => true,
	* 				'allowFullScreen' => true,
	* 			),
	* 		);
	* 
	* @version 1.0
	*
	* @param string $show
	* @param int $num_posts
	* @param bool $exclude_current_post
	*
	* @return array - array of posts
	*/

	if (!function_exists("canon_fw_get_allowed_html_tags")) { function canon_fw_get_allowed_html_tags($operator = "none", $custom_array = array()) {
			
		global $allowedposttags;

		// if modify then start by deleting relevant keys
		if ( ($operator == "modify" || $operator == "remove") && !empty($custom_array) ) {
			foreach ($custom_array as $key => $value) {
					unset($allowedposttags[$key]);
				}	
		}

		// if add then add $custom_array to $allowedposttags
		if ( $operator == "modify" ) {
			$allowedposttags = array_merge($allowedposttags, $custom_array);
			ksort($allowedposttags, SORT_REGULAR);
		}

		return $allowedposttags;

	}}


/**************************************
canon_fw_get_breadcrumbs
***************************************/

	/**
	* Optional args
	* canon_fw_get_breadcrumbs(array(
	* 	"separator" => ">",
	* ));
	*
	* @version 1.0
	*
	* @param array $args
	*
	* @return string - contains HTML
	*/

	if (!function_exists("canon_fw_get_breadcrumbs")) { function canon_fw_get_breadcrumbs($args = array()) {

		global $post;
		extract($args);

		$output = "";
		$separator = (isset($separator)) ? $separator : "/";
		$separator_output = sprintf('<li><span class="canon_breadcrumbs_separator">%s</span></li>', esc_attr($separator) );

		$output .= '<ul class="canon_breadcrumbs">';

		// HOME
		$home_output = '<i class="fa fa-home"></i>';
		$output .= sprintf('<li><a href="%s">%s</a></li>', esc_attr(home_url()), wp_kses_post($home_output) );

		// IF BLOG AND NOT BLOG AS FRONT PAGE
		if (is_home() && !is_front_page()) {
			$blog_output = esc_html__('Blog', 'loc-canon-belle');
			$output .= $separator_output;
			$output .= sprintf('<li>%s</li>', $blog_output);
		}   

		// PAGE
		elseif (is_page() && !is_front_page()) {

			if($post->post_parent){
				$ancestor_ids = get_post_ancestors( $post->ID );
	            $ancestor_ids = array_reverse($ancestor_ids);
				foreach ( $ancestor_ids as $ancestor_id ) {
					$output .= $separator_output;
					$output .= sprintf('<li><a href="%s" title="%s">%s</a></li>', esc_url(get_permalink($ancestor_id)), esc_attr(strip_tags(get_the_title($ancestor_id))), esc_attr(strip_tags(get_the_title($ancestor_id))) );
				}
			}
			$output .= $separator_output;
			$output .= sprintf('<li>%s</li>', esc_attr(strip_tags(get_the_title())) );

		} 

		// CATEGORIES AND SINGLE
		elseif (is_category() || ( is_single() && get_post_type() =="post") ) {

			// THE CATEGORY OBJECT
			global $wp_query;

			$post_type = get_post_type();
			$category_slug = $wp_query->query_vars['category_name'];

			if (is_category() && get_category_by_slug($category_slug)) {
				$the_category_object = get_category_by_slug($category_slug);
			} else {
				$the_categories_array = get_the_category();
				if (!empty($the_categories_array)) { $the_category_object = $the_categories_array[0]; }
			}

			// ADD CATEGORIES
			if (isset($the_category_object)) {

				$category_lineage_array = array();
				$the_category_parent = $the_category_object->parent;

				//do this for all the category parents
				while ($the_category_parent !== 0) {

					$the_category_parent_object = get_category($the_category_parent);	
					array_unshift($category_lineage_array, $the_category_parent_object->term_id);
					$the_category_parent = $the_category_parent_object->parent;
				}

				// now add category parents to output
				foreach ($category_lineage_array as $key => $term_id) {
					$category_lineage_object = get_category($term_id);
					$category_lineage_object_link = get_category_link($term_id);;

					$output .= $separator_output;
					$output .= sprintf('<li><a href="%s">%s</a></li>', $category_lineage_object_link, $category_lineage_object->name);

				}

				// finally add the original category itself (wihtout link if category page)
				$output .= $separator_output;
				if (is_category()) {
					$output .= sprintf('<li>%s</li>', $the_category_object->name);
				} else {
					$the_category_object_link = get_category_link($the_category_object->term_id);
					$output .= sprintf('<li><a href="%s">%s</a></li>', $the_category_object_link, $the_category_object->name);
				}

			}

			// SINGLE
			if (is_single()) {
				$output .= $separator_output;
				$output .= sprintf('<li>%s</li>', esc_attr(strip_tags(get_the_title())) );
			}
				
		}

		// CUSTOM POST TYPES
		elseif ( is_post_type_archive() || is_tax() || (is_single() && get_post_type() != "post") ) {

			$post_type = get_post_type();
			$post_type_object = get_post_type_object($post_type);

			// FIRST ADD THE CUSTOM POST TYPE NAME/LABEL

			$output .= $separator_output;
			$post_type_object_link = get_post_type_archive_link($post_type);

			$output .= sprintf('<li><a href="%s">%s</a></li>', $post_type_object_link, $post_type_object->label);


			// NEXT GET THE TERM OBJECT AND TERM TAXONOMY. IF THIS IS TAXONOMY PAGE YOU CAN GET DATA FROM QUERY IF SINGLE YOU WILL HAVE TO DETECT TERMS

			$the_term_object = null;
			$the_term_taxonomy = null;

			if (is_single()) {
				$taxonomies = get_object_taxonomies( $post_type, 'objects' );

				// get the first term of the first taxonomy
				foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

					// attempt to get terms
					$terms = get_the_terms( $post->ID, $taxonomy_slug );

					// if succesfull
					if ( !empty( $terms ) ) {

						foreach ( $terms as $term ) {
							if ($post_type == "product" && $term->name == "simple") { continue; }	// WooCommerce specific. WooCommerce first term is an internal use label with the name of simple. If detected skip and instead jump to next term which is first category.
							if (!isset($the_term_object)) { 
								$the_term_object = $term; 
								$the_term_taxonomy = $the_term_object->taxonomy;
							}
						}
					}
				}
					
			} elseif (is_tax()) {
					
				global $wp_query;

				$the_term_object = get_term($wp_query->queried_object->term_id,$wp_query->query_vars['taxonomy']);
				$the_term_taxonomy = $the_term_object->taxonomy;
			}

			// NEXT ADD THE CUSTOM POST TYPE TAXONOMIES

			// if this post has any terms
			if (isset($the_term_object)) {
				$term_lineage_array = array();
				array_unshift($term_lineage_array, $the_term_object->term_id);

				$the_term_parent = $the_term_object->parent;

				//do this for all the term parents
				while ($the_term_parent !== 0) {
					$the_term_parent_object = get_term($the_term_parent, $the_term_taxonomy);	
					array_unshift($term_lineage_array, $the_term_parent_object->term_id);
					$the_term_parent = $the_term_parent_object->parent;
				}

				// now add terms to output
				foreach ($term_lineage_array as $key => $term_id) {
					$term_lineage_object = get_term($term_id, $the_term_taxonomy);
					$term_lineage_object_link = get_term_link($term_id, $the_term_taxonomy);

					$output .= $separator_output;
					$output .= sprintf('<li><a href="%s">%s</a></li>', $term_lineage_object_link, $term_lineage_object->name);

				}
			}


			// FINALLY ADD THE SINGLE NAME

			if (is_single()) {
				$output .= $separator_output;
				$output .= sprintf('<li>%s</li>', esc_attr(strip_tags(get_the_title())) );
			}

		}

		// DATE
		elseif (is_date()) {

			// DATE
			$archive_year  = get_the_time('Y'); 
			$archive_month = get_the_time('m'); 
			$archive_day   = get_the_time('d');

			// YEAR
			$year_link = get_year_link($archive_year);
			$output .= $separator_output;
			$output .= sprintf('<li><a href="%s">%s</a></li>', $year_link, $archive_year);

			// MONTH
			if ( is_month() || is_day()) {
				$month_link = get_month_link($archive_year, $archive_month);
				$output .= $separator_output;
				$output .= sprintf('<li><a href="%s">%s</a></li>', $month_link, canon_fw_localize_datetime(get_the_time("F")));

			}

			if (is_day()) {
				// DAY
				$day_link = get_day_link($archive_year, $archive_month, $archive_day);
				$output .= $separator_output;
				$output .= sprintf('<li><a href="%s">%s</a></li>', $day_link, $archive_day);
			}

		}

		// TAG
		elseif (is_tag()) {
			$output .= $separator_output;
			$output .= sprintf('<li>%s: %s</li>', esc_html__('Tag', 'loc-canon-belle'), single_tag_title('', false));
		}

		// AUTHOR
		elseif (is_author()) {
			$output .= $separator_output;
			$output .= sprintf('<li>%s: %s</li>', esc_html__('Author', 'loc-canon-belle'), get_the_author_meta('display_name'));
		}

		// SEARCH
		elseif (is_search()) {
			$output .= $separator_output;
			$output .= sprintf('<li>%s: %s</li>', esc_html__('Search', 'loc-canon-belle'), get_search_query());
		}

		// 404
		elseif (is_404()) {
			$output .= $separator_output;
			$output .= sprintf('<li>404</li>');
		}

		$output .= '</ul>';

		return wp_kses_post($output);
	}}


/**************************************
canon_fw_get_cat_string
***************************************/

	/**
	* @version 1.0
	*
	* @param int $post_id
	* @param string $separator
	*
	* @return string - contains HTML
	*/

	if (!function_exists("canon_fw_get_cat_string")) { function canon_fw_get_cat_string ($post_id, $separator) {

		$cat_array = get_the_category($post_id);
		$cat_string = "";
		$cat_string_separator = $separator;
		if ($cat_array) {

			foreach ($cat_array as $key => $value) {
				$cat_string .= sprintf( '<a href="%s">%s</a>', esc_url(get_category_link($value->term_id)), esc_attr($value->name) );
				$cat_string .= $cat_string_separator;
			}
			$cat_string = trim($cat_string, $cat_string_separator);

		}

		return $cat_string;

	}}

/**************************************
canon_fw_has_feature
***************************************/

	/**
	* @version 1.0
	*
	* @param int $post_id
	*
	* @return bool
	*/

	if (!function_exists("canon_fw_has_feature")) { function canon_fw_has_feature ($post_id) {

		$has_feature = false;
		$cmb_feature = get_post_meta($post_id, 'cmb_feature', true);
		$cmb_media_link = get_post_meta($post_id, 'cmb_media_link', true);

		if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) { $has_feature = true; }
		if ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && has_post_thumbnail($post_id) && get_post(get_post_thumbnail_id($post_id)) )  { $has_feature = true; }
		if ( ($cmb_feature == "image" || empty($cmb_feature)) && has_post_thumbnail($post_id) && get_post(get_post_thumbnail_id($post_id)) ) {  $has_feature = true; }

		return $has_feature;   

	}}



/**************************************
canon_fw_list_categories_of_consolidated_wp_gallery
***************************************/

	/**
	* @version 1.0
	*
	* @param array $consolidated_wp_gallery_array
	*
	* @return bool
	*/

	if (!function_exists("canon_fw_list_categories_of_consolidated_wp_gallery")) { function canon_fw_list_categories_of_consolidated_wp_gallery ($consolidated_wp_gallery_array) {
	
		// create cat_array
		$cat_array = array();
		foreach ($consolidated_wp_gallery_array as $key => $value) {
			foreach ($value['categories'] as $key => $value) {
			   $cat_array[$key] = $value;
			}
		}
		asort($cat_array);

		// output
		printf("<li class='cat-item-all'><a href='#'>%s</a></li>", esc_html__("All categories", "loc-canon-belle"));
		foreach ($cat_array as $key => $value) {
			printf('<li class="cat-item %s"><a href="#" title="%s">%s</a></li>', esc_attr($key), esc_attr($value), esc_attr($value));
		}
			
	}}


/**************************************
canon_fw_get_excerpt
***************************************/

	/**
	* @version 1.0
	*
	* @param int $post_id
	* @param int $excerpt_len
	*
	* @return string
	*/

	if (!function_exists("canon_fw_get_excerpt")) { function canon_fw_get_excerpt ($post_id, $excerpt_len) {
		$this_post = get_post($post_id);
		$default_excerpt_length = 200;
		if (!$this_post) { return false; }
		$excerpt = "";
		if (!empty($this_post->post_excerpt)) {
			$excerpt = do_shortcode($this_post->post_excerpt);	
		} elseif (strpos($this_post->post_content, "<!--more-->") !== false) {
			$content_explode = explode("<!--more-->", $this_post->post_content);
			$excerpt = do_shortcode($content_explode[0]) . "...";
		} else {
			if (!isset($excerpt_len)) { $excerpt_len = $default_excerpt_length; }
			$excerpt = canon_fw_make_excerpt($this_post->post_content, $excerpt_len, true);	
		}

		return $excerpt;

	}}


/**************************************
canon_fw_get_exclude_array
***************************************/

	/**
	* @version 1.0
	*
	* @param string $meta_key
	*
	* @return array
	*/

	if (!function_exists("canon_fw_get_exclude_array")) { function canon_fw_get_exclude_array ($meta_key) {
		
		$exclude_array = array();   
		$results_exclude_posts = get_posts(array(
			'meta_key'          => $meta_key,
			'meta_value'        => 'checked',
			'post_type'         => 'any',
			'suppress_filters'  => false,
		));
		if (count($results_exclude_posts) > 0) {
			for ($i = 0; $i < count($results_exclude_posts); $i++) {  
				$exclude_array[] = $results_exclude_posts[$i]->ID;
			}   
		} 

		return $exclude_array;
			
	}}

/**************************************
canon_fw_get_exclude_string
***************************************/

	/**
	* @version 1.0
	*
	* @param string $meta_key
	*
	* @return string
	*/

	if (!function_exists("canon_fw_get_exclude_string")) { function canon_fw_get_exclude_string ($meta_key) {
		
		$exclude_string = "";
		$separator = ",";
		$results_exclude_posts = get_posts(array(
			'numberposts'			=> -1,
			'meta_key'          	=> $meta_key,
			'meta_value'			=> 'checked',
			'orderby'				=> 'post_date',
			'order'					=> 'DESC',
			'post_type'				=> 'any',
		));
		if (count($results_exclude_posts) > 0) {
			$exclude_string = "";
			for ($i = 0; $i < count($results_exclude_posts); $i++) {  
				$exclude_string .= $results_exclude_posts[$i]->ID . $separator;
			}	
			$exclude_string = trim($exclude_string, $separator);
		} 

		return $exclude_string;
			
	}}


/**************************************
canon_fw_strip_wp_galleries_to_array
***************************************/

	/**
	* @version 1.0
	*
	* @param string $string
	*
	* @return array
	*/

	if (!function_exists("canon_fw_strip_wp_galleries_to_array")) { function canon_fw_strip_wp_galleries_to_array ($string) {
		$wp_galleries_array = array();
		$explode_array = explode('[gallery', $string);
		for ($i = 1; $i < count($explode_array); $i++) {    //notice index starts at 1 to exclude first explode piece
			$explode_array2 = explode(']',$explode_array[$i]);

			// assemble
			$single_gallery = '[gallery' . $explode_array2[0] . ']';
			array_push($wp_galleries_array, $single_gallery);
		}

		return $wp_galleries_array;

	}}

/**************************************
canon_fw_convert_wp_galleries_array_to_consolidated_wp_gallery_array
***************************************/

	/**
	* @version 1.0
	*
	* @param array $wp_galleries_array
	*
	* @return array
	*/

	if (!function_exists("canon_fw_convert_wp_galleries_array_to_consolidated_wp_gallery_array")) { function canon_fw_convert_wp_galleries_array_to_consolidated_wp_gallery_array ($wp_galleries_array) {
		$consolidated_wp_gallery_array = array();

		foreach ($wp_galleries_array as $key => $this_wp_gallery_string) {
			// first create id array
			$id_explode_array = explode('ids="', $this_wp_gallery_string);
			$id_explode_array2 = explode('"',$id_explode_array[1]);
			$id_string = $id_explode_array2[0];
			$id_array = explode(',', $id_string);


			// get category
			$cat_explode_array = explode('category="', $this_wp_gallery_string);
			if (isset($cat_explode_array[1])) {
				$cat_explode_array2 = explode('"',$cat_explode_array[1]);
				$category_name = $cat_explode_array2[0];
				$category_slug = canon_fw_create_slug($category_name);
			} else {
				$category_name = esc_html__("Category ", "loc-canon-belle") . ($key+1);
				$category_slug = canon_fw_create_slug($category_name);
			}

			//handle each id
			foreach ($id_array as $key => $id) {
				// first check if duplicate
				$duplicate = false;
				foreach ($consolidated_wp_gallery_array as $key => $value) {
					if ($value['id'] === $id) { 
						$duplicate = true;

						// if duplicate check if category exists and add if not add
						$duplicate_cat = false;
						foreach ($value['categories'] as $this_cat_slug => $this_cat_name) {
							if ($this_cat_name === $category_name) { $duplicate_cat = true; }
						}

						if ($duplicate_cat === false) {
							$cat_add_array = array(
								$category_slug => $category_name,
							);
							$consolidated_wp_gallery_array[$key]['categories'][$category_slug] = $category_name;
						}
					}
				}

				// add if not duplicate
				if ($duplicate === false) {
					$add_array = array(
						'id'            => $id,
						'categories'    => array(
							$category_slug  => $category_name,
						), 
					);
					array_push($consolidated_wp_gallery_array, $add_array);
				}

			}   // foreach id_array

		}   // foreach wp_gallery_array

		return $consolidated_wp_gallery_array;

	}}



/****************************************************
canon_fw_array_replace
****************************************************/

	/**
	* PHP's own array_replace() is compatible with PHP 5.3
	* canon_fw_array_replace() does the same but is compatible with PHP 4 (NB: only takes 2 arrays whereas array_replace takes more arrays)
	*
	* @version 1.0
	*
	* @param array $array1
	* @param array $array2
	*
	* @return array
	*/

	if (!function_exists("canon_fw_array_replace")) { function canon_fw_array_replace($array1, $array2) {

		if (function_exists('array_replace')) {
			$array1 = array_replace($array1, $array2);
		} else {
			foreach ($array2 as $key => $value) {
				$array1[$key] = $value;
			}
		}

		return $array1;

	}}


/****************************************************
canon_fw_lcfirst
****************************************************/

	/**
	* PHP's own lcfirst() is compatible with PHP 5.3
	* canon_fw_lcfirst() does the same but is compatible with PHP 4
	*
	* @version 1.0
	*
	* @param string $string
	*
	* @return string
	*/

	if (!function_exists("canon_fw_lcfirst")) { function canon_fw_lcfirst($string) {

		$string = strtolower(substr($string,0,1)) . substr($string,1,strlen($string)-1);

		return $string;

	}}


/**************************************
canon_fw_sanitize_output
***************************************/


	/**
	* @version 1.0
	*
	* @param string $output
	*
	* @return string
	*/

	if (!function_exists("canon_fw_sanitize_output")) { function canon_fw_sanitize_output ($output) {

		// sanitation code here

		return $output;		

	}}

/**************************************
canon_fw_sanitized_output
***************************************/

	/**
	* @version 1.0
	*
	* @param string $output
	*/

	if (!function_exists("canon_fw_sanitized_output")) { function canon_fw_sanitized_output ($output) {

		// var_dump($output);
		// var_dump(canon_fw_kses_plus($output, true, array('iframe', 'source')));
		// echo canon_fw_kses_plus($output, true, array('iframe', 'source'));
		
		echo canon_fw_sanitize_output($output);

	}}


/****************************************************
canon_fw_is_woocommerce_page
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $output
	*
	* @return string
	*/

	if (!function_exists("canon_fw_is_woocommerce_page")) { function canon_fw_is_woocommerce_page() {

		$is_woocommerce = false;
		if (class_exists('Woocommerce')) {
			if (is_woocommerce()
				|| is_shop()
				|| is_product_category()
				|| is_product_taxonomy()
				|| is_product_tag()
				|| is_product()
				|| is_cart()
				|| is_checkout()
				|| is_order_received_page()
				|| is_account_page()
				|| is_ajax()
				) {
				$is_woocommerce = true;	
			}
		}

		return $is_woocommerce;
	}}

/****************************************************
canon_fw_create_slug
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $string
	*
	* @return string
	*/

	if (!function_exists("canon_fw_create_slug")) { function canon_fw_create_slug($string) {

		$slug = strtolower($string);
		$slug = preg_replace("/[^ \w]+/", "", $slug);	//removes all non word and numbers signs
		$slug = str_replace(" ", "-", $slug);

		return $slug;

	}}


/****************************************************
canon_fw_get_col_size_class_from_num
****************************************************/

	/**
	* @version 1.0
	*
	* @param int $num
	* @param string $default
	*
	* @return string
	*/

	if (!function_exists("canon_fw_get_col_size_class_from_num")) { function canon_fw_get_col_size_class_from_num($num, $default) {

		$size_class = "";

		switch ($num) {
			case 1:
				$size_class = "col-1-1";
				break;
			case 2:
				$size_class = "col-1-2";
				break;
			case 3:
				$size_class = "col-1-3";
				break;
			case 4:
				$size_class = "col-1-4";
				break;
			case 5:
				$size_class = "col-1-5";
				break;
			
			default:
				$size_class = $default;
				break;
		}

		return $size_class;

	}}

/****************************************************
canon_fw_get_size_class_from_num
****************************************************/

	/**
	* @version 1.0
	*
	* @param int $num
	* @param string $default
	*
	* @return string
	*/

	if (!function_exists("canon_fw_get_size_class_from_num")) { function canon_fw_get_size_class_from_num($num, $default) {

		$size_class = "";

		switch ($num) {
			case 1:
				$size_class = "full";
				break;
			case 2:
				$size_class = "half";
				break;
			case 3:
				$size_class = "third";
				break;
			case 4:
				$size_class = "fourth";
				break;
			case 5:
				$size_class = "fifth";
				break;
			
			default:
				$size_class = $default;
				break;
		}

		return $size_class;

	}}


/****************************************************
canon_fw_tag_search_string
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $content
	* @param string $subject
	* @param string $pretag
	* @param string $posttag
	* @param bool $strict - if $strict === true only string with same upper/lowercase as subject will get tagged
	*
	* @return string
	*/

	if (!function_exists("canon_fw_tag_search_string")) { function canon_fw_tag_search_string($content, $subject, $pretag, $posttag, $strict) {

		if ($strict === true) {
			$replace_string = $pretag . $subject . $posttag;
			$content = str_replace($subject, $replace_string, $content);
		} else {
			//first uppercase
			$subject = ucfirst($subject);
			$replace_string = $pretag . $subject . $posttag;
			$content = str_replace($subject, $replace_string, $content);
			//then lowercase
			$subject = canon_fw_lcfirst($subject);
			$replace_string = $pretag . $subject . $posttag;
			$content = str_replace($subject, $replace_string, $content);
		}
		return $content;

	}}


/****************************************************
canon_fw_hex_opacity_to_rgba
****************************************************/

	/**
	* @version 1.0
	*
	* @param array $hex
	* @param float $opacity
	*
	* @return string
	*/

	if (!function_exists("canon_fw_hex_opacity_to_rgba")) { function canon_fw_hex_opacity_to_rgba($hex, $opacity) {

		$rgba_array = canon_fw_hex_to_rgb($hex);
		$rgba_string = "rgba(" . implode(",", $rgba_array) . ",". $opacity . ")";

		return $rgba_string;

	}}

/****************************************************
canon_fw_rgb_to_hex
****************************************************/

	/**
	* @version 1.0
	*
	* @param array $rgb - input array(255,255,255)
	*
	* @return string
	*/

	if (!function_exists("canon_fw_rgb_to_hex")) { function canon_fw_rgb_to_hex($rgb) {

	   $hex = "#";
	   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

	   return $hex; // returns the hex value including the number sign (#)

	}}


/****************************************************
canon_fw_hex_to_rgb
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $hex
	*
	* @return array
	*/

	if (!function_exists("canon_fw_hex_to_rgb")) { function canon_fw_hex_to_rgb($hex) {

	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values

	}}


/****************************************************
canon_fw_get_google_webfonts_link
****************************************************/

	/**
	* @version 1.0
	*
	* @param array $font_array
	*
	* @return string - url
	*/

	if (!function_exists("canon_fw_get_google_webfonts_link")) { function canon_fw_get_google_webfonts_link ($font_array) {
		
		//build vars
		$font_family = $font_array[0];
		$font_family = preg_replace('/\s/', '+', $font_family);
		$font_variant = $font_array[1];
		$font_subset = $font_array[2];


		//build google webfonts url
		//fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700,400italic,700italic
		$google_webfonts_query_arg = "family=";
		$google_webfonts_query_arg .= $font_family;

		if ($font_variant != "regular") {
			$google_webfonts_query_arg .= ":";
			$google_webfonts_query_arg .= $font_variant;
		}

		if ($font_subset != "latin") {
			$google_webfonts_query_arg .= "&subset=";
			$google_webfonts_query_arg .= $font_subset;
		}

		$google_webfonts_url = add_query_arg( $google_webfonts_query_arg, '', '//fonts.googleapis.com/css');

		return esc_url($google_webfonts_url);
			
	}}


/****************************************************
canon_fw_get_css_from_google_webfonts_settings_array
****************************************************/

	/**
	* @version 1.0
	*
	* @param array $font_array
	*
	* @return string
	*/

	if (!function_exists("canon_fw_get_css_from_google_webfonts_settings_array")) { function canon_fw_get_css_from_google_webfonts_settings_array ($font_array) {

		//build vars
		$css_string = '';
		$font_family = $font_array[0];
		$font_variant = $font_array[1];

		//font-family
		$css_string .= "font-family: \"$font_family\";\n";

		//font-style & font-weight
		if ($font_variant != "regular") {

			if (strpos($font_variant, 'italic') !== FALSE) {
				$css_string .= "font-style: italic;\n";
				$font_variant = str_replace("italic", "", $font_variant);
				if (!empty($font_variant)) { $css_string .= "font-weight: $font_variant;\n"; }
			} else {
				$css_string .= "font-style: normal;\n";
				$css_string .= "font-weight: $font_variant;\n";	
			}
				
		}

		return $css_string;
			
	}}


/****************************************************
canon_fw_build_delim_string_from_array
****************************************************/

	/**
	* @version 1.0
	*
	* @param array $array
	* @param string $delim
	* @param string $prefix
	* @param string $postfix
	*
	* @return string
	*/

	if (!function_exists("canon_fw_build_delim_string_from_array")) { function canon_fw_build_delim_string_from_array($array, $delim, $prefix, $postfix) {

		$return_string = "";
		foreach ($array as $key => $value) {
			$return_string .= $prefix . $key . $postfix . $delim;
		}
		$return_string = substr($return_string,0,strlen($return_string)-1);
		
		return $return_string;	

	}}


/****************************************************
canon_fw_add_value_to_delim_string
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $string
	* @param string $add_value
	* @param string $delim
	* @param bool $add_if_duplicate
	*
	* @return string
	*/

	if (!function_exists("canon_fw_add_value_to_delim_string")) { function canon_fw_add_value_to_delim_string($string, $add_value, $delim, $add_if_duplicate) {

		$explode_arr = explode($delim, $string);	
		
		//check if duplicate
		$duplicate = false;
		foreach ($explode_arr as $key => $value) {
			if ($value == $add_value) $duplicate = true;			
		}

		//return $string untouched if not add on duplicate and duplicate found
		if ($add_if_duplicate == false && $duplicate == true) return $string;

		//in all other cases go ahead and update
		$string = $string . $delim . $add_value;
		$string = trim($string, $delim);

		return $string;

	}}


/****************************************************
canon_fw_del_value_from_delim_string
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $string
	* @param string $del_value
	* @param string $delim
	*
	* @return string
	*/

	if (!function_exists("canon_fw_del_value_from_delim_string")) { function canon_fw_del_value_from_delim_string($string, $del_value, $delim) {

		$explode_arr = explode($delim, $string);
		$return_string = "";	
		
		//build return_string
		foreach ($explode_arr as $key => $value) {
			if ($value != $del_value) $return_string .= $value . $delim;			
		}
		$return_string = trim($return_string, $delim);

		return $return_string;

	}}


/****************************************************
canon_fw_is_value_in_delim_string
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $string
	* @param string $check_value
	* @param string $delim
	*
	* @return bool
	*/

	if (!function_exists("canon_fw_is_value_in_delim_string")) { function canon_fw_is_value_in_delim_string($string, $check_value, $delim) {

		$explode_arr = explode($delim, $string);
		foreach ($explode_arr as $key => $value) {
			if ($value == $check_value) return true;	
		}
		return false;

	}}


/****************************************************
canon_fw_cookie_check_key_for_value
****************************************************/

	/**
	* checks if value is in value delim string of a given key
	*
	* @version 1.0
	*
	* @param string $cookie_name
	* @param string $key
	* @param string $value
	*
	* @return bool
	*/

	if (!function_exists("canon_fw_cookie_check_key_for_value")) { function canon_fw_cookie_check_key_for_value ($cookie_name, $key, $value) {

		if (!isset($_COOKIE[$cookie_name])) return false;

		$cookiestring = $_COOKIE[$cookie_name];
		$explode_arr = explode($key . "=", $cookiestring);
		if (isset($explode_arr[1])) {
			$explode_arr = explode("&", $explode_arr[1]);
			return canon_fw_is_value_in_delim_string($explode_arr[0], $value, ","); ;
		} else {
			return false;	
		}

	}}



/****************************************************
canon_fw_update_cookie_key_value
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $cookie_name
	* @param string $key
	* @param string $value
	*/

	if (!function_exists("canon_fw_update_cookie_key_value")) { function canon_fw_update_cookie_key_value ($cookie_name, $key, $value) {

		$cookie_string = $_COOKIE[$cookie_name];

		$key_value_array = explode('&', $cookie_string);
		$index_of_relevant_key_value_pair = -1;
		$pointer = 0;
		foreach ($key_value_array as $temp_key => $temp_value) {
			if (strpos($temp_value, $key) !== false) { $index_of_relevant_key_value_pair = $pointer; }
			$pointer++;
		}

		if ($index_of_relevant_key_value_pair == -1) {
			// key does not exist in cookie string
			$cookie_string .= "&" . $key . "=" . $value;	
		} else {
			// key exists in cookie string and must be updated
			$key_value_array[$index_of_relevant_key_value_pair] = $key . '=' . $value;
			// rebuild cookie_string
			$cookie_string = "";
			foreach ($key_value_array as $temp_key => $temp_value) {
				$cookie_string .= "&" . $temp_value;
			}
			if (substr($cookie_string, 0, 1) == "&") $cookie_string = substr($cookie_string, 1, strlen($cookie_string)-1);
		}


		// setcookie($cookie_name, "", time()+(60*60*24*365), COOKIEPATH, COOKIE_DOMAIN, false);
		setcookie($cookie_name, $cookie_string, time()+(60*60*24*365), COOKIEPATH, COOKIE_DOMAIN, false); 

		// important to also update global $_COOKIE var. This is only set at the start of a page request and is not updated with the setcookie function   
		$_COOKIE[$cookie_name] = $cookie_string;    
			
	}}



/****************************************************
canon_fw_cookie_get_key_value
****************************************************/

	/**
	* this function assumes your cookiestring is ordered like f.x. "likes=1,2,3,4,5&hates=none"
	* using canon_fw_cookie_get_key_value('cookiename', 'likes') will return "1,2,3,4,5"
	*
	* @version 1.0
	*
	* @param string $cookie_name
	* @param string $key
	*
	* @return string
	*/

	if (!function_exists("canon_fw_cookie_get_key_value")) { function canon_fw_cookie_get_key_value ($cookie_name, $key) {

		if (!isset($_COOKIE[$cookie_name])) return false;

		$cookiestring = $_COOKIE[$cookie_name];
		$explode_arr = explode($key . "=", $cookiestring);
		if (isset($explode_arr[1])) {
			$explode_arr = explode("&", $explode_arr[1]);
			return $explode_arr[0];
		} else {
			return "";	
		}

	}}


/****************************************************
canon_fw_localize_datetime
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $datetime
	*
	* @return string
	*/

	if (!function_exists("canon_fw_localize_datetime")) { function canon_fw_localize_datetime($datetime) {

		$datetime = str_replace('January', esc_html__('January', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('February', esc_html__('February', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('March', esc_html__('March', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('April', esc_html__('April', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('May', esc_html__('May', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('June', esc_html__('June', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('July', esc_html__('July', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('August', esc_html__('August', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('September', esc_html__('September', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('October', esc_html__('October', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('November', esc_html__('November', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('December', esc_html__('December', 'loc-canon-belle'), $datetime);

		$datetime = str_replace('Jan', esc_html__('Jan', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Feb', esc_html__('Feb', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Mar', esc_html__('Mar', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Apr', esc_html__('Apr', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('May', esc_html__('May', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Jun', esc_html__('Jun', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Jul', esc_html__('Jul', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Aug', esc_html__('Aug', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Sep', esc_html__('Sep', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Oct', esc_html__('Oct', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Nov', esc_html__('Nov', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Dec', esc_html__('Dec', 'loc-canon-belle'), $datetime);

		$datetime = str_replace('Monday', esc_html__('Monday', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Tuesday', esc_html__('Tuesday', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Wednesday', esc_html__('Wednesday', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Thursday', esc_html__('Thursday', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Friday', esc_html__('Friday', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Saturday', esc_html__('Saturday', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Sunday', esc_html__('Sunday', 'loc-canon-belle'), $datetime);

		$datetime = str_replace('Mon', esc_html__('Mon', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Tue', esc_html__('Tue', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Wed', esc_html__('Wed', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Thu', esc_html__('Thu', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Fri', esc_html__('Fri', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Sat', esc_html__('Sat', 'loc-canon-belle'), $datetime);
		$datetime = str_replace('Sun', esc_html__('Sun', 'loc-canon-belle'), $datetime);

		return $datetime;
			
	}}
	


/****************************************************
canon_fw_show_admin_notice
****************************************************/

	/**
	* show notice in the admin area. Classes: updated (yellow), error (red)
	*
	* @version 1.0
	*
	* @param string $message
	* @param string $class
	*/

	if (!function_exists("canon_fw_show_admin_notice")) { function canon_fw_show_admin_notice ($message, $class) {

		echo "<div class=$class>$message</div>";		

	}}

	
/****************************************************
canon_fw_format_datetime_str
****************************************************/

	/**
	* @version 1.0
	*
	* @param string $format_str - format_str as shown in http://php.net/manual/en/function.date.php
	* @param string $datetime_str - datetime_str: mysql datetime like "2012-10-28 07:51:42"
	*
	* @return string
	*/

	if (!function_exists("canon_fw_format_datetime_str")) { function canon_fw_format_datetime_str ($format_str, $datetime_str) {

		$timestamp = strtotime($datetime_str);
		$return_str = date($format_str, $timestamp);

		return $return_str;

	}}


/****************************************************
canon_fw_make_excerpt
****************************************************/

	/**
	* returns a string excerpt of length = $maxlen with "..." attached to the end if $by_word is set to true then will try to split by word looking back for a max of $search_len characters
	*
	* @version 1.0
	*
	* @param string $string
	* @param int $maxlen
	* @param bool $by_word
	*
	* @return string
	*/

	if (!function_exists("canon_fw_make_excerpt")) { function canon_fw_make_excerpt($string, $maxlen, $by_word) {

		$search_len = 10;

		$string = strip_shortcodes($string);
		$string = strip_tags($string);

		if (strlen($string)>$maxlen) {
			if ($by_word === true) {
				$string = substr($string, 0, $maxlen);
				for ($i = 1; $i < $search_len; $i++) {
					if (substr($string, $maxlen-$i, 1) == " ") {
						$string = substr($string, 0, $maxlen-$i) . " ...";
						return	$string;
					} 
				}
				//only gets here if a space haven't been found for during search_len
				$string = substr($string, 0, $maxlen-3) . "..."; 
			} else {
				$string = substr($string, 0, $maxlen-3) . "..."; 
			}
		}	

		return $string;

	}}


/****************************************************
canon_fw_get_page_type
****************************************************/

	/**
	* return the type of page/post/loop you're on. Returns false if called from environments with no type. Look here for more: http://codex.wordpress.org/Conditional_Tags
	*
	* @version 1.0
	*
	* @return string
	*/

	if (!function_exists("canon_fw_get_page_type")) { function canon_fw_get_page_type () {

		global $post;
		$type = false;	
		if (is_category()) { $type = 'category'; }
		if (is_time() ) { $type = 'time'; }
		if (is_day()) { $type = 'day'; }
		if (is_month()) { $type = 'month'; }
		if (is_year()) { $type = 'year'; }
		if (is_author()) { $type = 'author'; }
		if (is_tag()) { $type = 'tag'; }
		if (is_home()) { $type = 'home'; }
		if (is_admin()) { $type = 'admin'; }
		if (is_single()) { $type = 'single'; }
		if (is_page()) { $type = 'page'; }
		if (is_tax()) { $type = 'tax'; }
		if (is_post_type_archive()) { $type = 'custom_post_type_archive'; }
		if (is_search()) { $type = 'search'; }
		if (is_404()) { $type = '404'; }

		return $type;

	}}


/****************************************************
canon_fw_get_latest_tweets
****************************************************/

	/**
	* return latest tweets
	* returns an array of tweet objects. The content is in ->text or on error returns false with errorlog in transient
	*
	* @version 1.0
	*
	* @param string $twitter_screen_name
	*
	* @return array or false
	*/

	if (!function_exists("canon_fw_get_latest_tweets")) { function canon_fw_get_latest_tweets ($twitter_screen_name) {

		$latest_tweets_data = get_transient('latest_tweets_data');		//returns object

		if ($latest_tweets_data === false || $twitter_screen_name != $latest_tweets_data->screen_name) {			//runs the actual function if there is no cached data or the username has changed
			//echo "NEW RUN!<br>";
			$latest_tweets = wp_remote_get("http://api.twitter.com/1/statuses/user_timeline.json?screen_name=" . $twitter_screen_name);

			if ($latest_tweets['response']['code']  == '200') {
				$latest_tweets = json_decode($latest_tweets['body']);

				$latest_tweets_data = new stdClass();
				$latest_tweets_data->screen_name = $twitter_screen_name;
				$latest_tweets_data->tweets = $latest_tweets;

				set_transient('latest_tweets_data', $latest_tweets_data, 60*20);
					
			} else {
				$latest_tweets = json_decode($latest_tweets['body']);
				if (isset($latest_tweets->error)) {
					$latest_tweets_error = $latest_tweets->error;	
				} elseif (isset($latest_tweets->errors[0]->message)) {
					$latest_tweets_error = $latest_tweets->errors[0]->message;
				} else {
					$latest_tweets_error = "Unknown error";
				}

				delete_transient('latest_tweets_data');
				set_transient('latest_tweets_error', $latest_tweets_error, 60*20);
				return false;								
			}
					
		}

		return $latest_tweets_data->tweets;

	}}


/****************************************************
canon_fw_filter_tweet
****************************************************/

	/**
	* filter a tweet and replace links with working links
	*
	* @version 1.0
	*
	* @param string $tweet
	*
	* @return string
	*/

	if (!function_exists("canon_fw_filter_tweet")) { function canon_fw_filter_tweet ($tweet) {

		$tweet = preg_replace ('/(http[^\s]+)/im','<a href="$1" target="_blank">$1</a>', $tweet);
		$tweet = preg_replace ('/@([^\s]+)/i','<a href="http://twitter.com/$1" target="_blank">@$1</a>', $tweet);
		$tweet = preg_replace ('/#([^\s\.\!]+)/i','<a href="https://twitter.com/search?q=%23$1&src=hash" target="_blank">#$1</a>', $tweet);

		return $tweet;

	}}


/****************************************************
canon_fw_time_ago_tweet
****************************************************/

	/**
	* @version 1.0
	*
	* @param object $tweet_object
	*
	* @return string
	*/

	if (!function_exists("canon_fw_time_ago_tweet")) { function canon_fw_time_ago_tweet ($tweet_object) {

		$twitter_date = $tweet_object->created_at;
		$twitter_date_pieces = explode(" ", $twitter_date);
		$twitter_date_parsable = $twitter_date_pieces[2] . " " . $twitter_date_pieces[1] . " " . $twitter_date_pieces[5] . " " . $twitter_date_pieces[3];
		$twitter_date_timestamp = strtotime($twitter_date_parsable);
		$readable_time_diff = human_time_diff($twitter_date_timestamp);

		return $readable_time_diff;

	}}


/****************************************************
canon_fw_get_twitter_count
****************************************************/

	/**
	* returns num of followers on twitter
	*
	* @version 1.0
	*
	* @param string $twitter_screen_name
	*
	* @return int
	*/

	if (!function_exists("canon_fw_get_twitter_count")) { function canon_fw_get_twitter_count ($twitter_screen_name) {
		
		$twitter_count = get_transient('twitter_count');

		if ($twitter_count === false) {
			//echo "NEW RUN!<br>";
			if (!empty($twitter_screen_name)) {
				$tweets = wp_remote_get("http://api.twitter.com/1/users/show.json?screen_name=" . $twitter_screen_name);
				if ($tweets['response']['code']  == '200') {
					$tweets = json_decode($tweets['body']);
					$twitter_count = $tweets->followers_count;
					set_transient('twitter_count', $twitter_count, 60*20);
				} else {
					$tweets = json_decode($tweets['body']);
					$tweets = $tweets->errors[0]->message;
					return $tweets;
				}
			} else {
				$twitter_count = 0;
				set_transient('twitter_count', $twitter_count, 60*20);
			}
		}
		return $twitter_count;

	}}


/****************************************************
canon_fw_get_facebook_count
****************************************************/

	/**
	* returns num of likes on facebook
	*
	* @version 1.0
	*
	* @param string $facebook_page
	*
	* @return int
	*/

	if (!function_exists("canon_fw_get_facebook_count")) { function canon_fw_get_facebook_count ($facebook_page) {
		
		$facebook_count = get_transient('facebook_count');

		if (!$facebook_count) {
			if (!empty($facebook_page)) {
				$facebook_data = wp_remote_get("http://graph.facebook.com/" . $facebook_page);
				$facebook_data = json_decode($facebook_data['body']);

				if (isset($facebook_data->likes)) {
					$facebook_count = $facebook_data->likes;
					set_transient('facebook_count', $facebook_count, 60*20);
				} else {
					$facebook_count = false;
				}
			} else {
				$facebook_count = 0;
				set_transient('facebook_count', $facebook_count, 60*20);
			}
		}

		return $facebook_count;

	}}



/****************************************************
canon_fw_update_post_views
****************************************************/

	/**
	* update post views
	*
	* @version 1.0
	*
	* @param int $post_id
	*
	* @return int
	*/

	if (!function_exists("canon_fw_update_post_views")) { function canon_fw_update_post_views($post_id) {

		$meta_key_views = 'post_views';
		$views = get_post_meta($post_id, $meta_key_views, true);
		if ($views == '') {
			$views = 1;
			delete_post_meta($post_id, $meta_key_views)	;
			update_post_meta($post_id, $meta_key_views, $views);
		} else {
			$views++;
			update_post_meta($post_id, $meta_key_views, $views);
		}

		return $views;

	}}


/****************************************************
canon_fw_get_post_views
****************************************************/

	/**
	* get post views
	*
	* @version 1.0
	*
	* @param int $post_id
	*
	* @return int
	*/

	if (!function_exists("canon_fw_get_post_views")) { function canon_fw_get_post_views($post_id) {

		$meta_key_views = 'post_views';
		$views = get_post_meta($post_id, $meta_key_views, true);
		if ($views == '') {
			$views = 1;
			delete_post_meta($post_id, $meta_key_views);
			update_post_meta($post_id, $meta_key_views, $views);
		}
		return $views;

	}}


/****************************************************
canon_fw_update_post_views_single_check
****************************************************/

	/**
	* add the add_action to your functions.php if you want this function to run on wp_head action.
	* add_action('wp_head', 'canon_fw_update_post_views_single_check' );
	*
	* @version 1.0
	*
	* @param int $post_id
	*/

	if (!function_exists("canon_fw_update_post_views_single_check")) { function canon_fw_update_post_views_single_check($post_id) {

		if (!is_single()) return;
		if (empty($post_id)) {
			global $post;
			$post_id = 	$post->ID;
		}
		canon_fw_update_post_views($post_id);

	}}


/****************************************************
canon_fw_get_rating_percentage
****************************************************/

	/**
	* @version 1.0
	*
	* @param int $rating
	* @param int $min_rating
	* @param int $max_rating
	* @param int $increment
	* @param bool $ignore_increment - $ignore_increment (boolean) should usually be set to true. This is not mathematically correct when calculating rating %, but it is more easily understood by the end user.
	*
	* @return float
	*/

	if (!function_exists("canon_fw_get_rating_percentage")) { function canon_fw_get_rating_percentage ($rating, $min_rating, $max_rating, $increment, $ignore_increment) {

		if ($ignore_increment === true) $increment = 1;
		$scale_resolution = ($max_rating - ($min_rating - $increment)) / $increment;
		$rel_rating = ($rating - ($min_rating - $increment)) / $increment;
		$rating_percentage = ($rel_rating / $scale_resolution) * 100;

		return $rating_percentage;

	}}


/****************************************************
canon_fw_get_rating_color
****************************************************/

	/**
	* @version 1.0
	*
	* @param int $rating_percentage
	*
	* @return string
	*/

	if (!function_exists("canon_fw_get_rating_color")) { function canon_fw_get_rating_color ($rating_percentage) {

		if ($rating_percentage >= 0) $rating_color = 'red';
		if ($rating_percentage >= 20) $rating_color = 'darkred';
		if ($rating_percentage >= 40) $rating_color = 'yellow';
		if ($rating_percentage >= 60) $rating_color = 'darkgreen';
		if ($rating_percentage >= 80) $rating_color = 'green';

		return $rating_color;

	}}
	