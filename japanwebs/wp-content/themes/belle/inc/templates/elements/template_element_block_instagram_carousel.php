<?php
	
	// GET OPTIONS
	$canon_options_frame = get_option('canon_options_frame'); 
	$canon_options_advanced = get_option('canon_options_advanced'); 
	
	$canon_options_advanced['oauth_instagram'] = @json_decode(canon_fw_filter_sensitive_output($canon_options_advanced['oauth_instagram']), true);

	$error_message = "ERROR";

	// FAILSAFE DEFAULTS
	if (!isset($canon_options_advanced['oauth_instagram']['access_token'])) { $canon_options_advanced['oauth_instagram']['access_token'] = ""; }

	// SET QUERY
	$url = "";
	if ($canon_options_frame['block_instagram_carousel_shows'] == 'recent') {
		$url = sprintf('https://api.instagram.com/v1/users/%s/media/recent/?count=%s&access_token=%s', esc_attr($canon_options_frame['block_instagram_carousel_user_id']), esc_attr($canon_options_frame['block_instagram_carousel_num_posts']), esc_attr($canon_options_advanced['oauth_instagram']['access_token']));
	} elseif ($canon_options_frame['block_instagram_carousel_shows'] == 'hashtag') {
		$url = sprintf('https://api.instagram.com/v1/tags/%s/media/recent?count=%s&access_token=%s', esc_attr($canon_options_frame['block_instagram_carousel_tag']), esc_attr($canon_options_frame['block_instagram_carousel_num_posts']), esc_attr($canon_options_advanced['oauth_instagram']['access_token']));	
	} 
	
	// CHECK FOR TRANSIENT OR PERFORM QUERY
	if (get_transient('instagram_carousel_response')) {
		$response = get_transient('instagram_carousel_response');
		// var_dump("CACHED RESPONSE");	
	} else {
		$response = wp_remote_get($url);
		// var_dump("RUN REMOTE GET");	

		// ERROR HANDLING
		$error = false;
		if ( is_wp_error( $response ) ) {
			$error = true;
		    $error_message .= ": " . $response->get_error_message();
		} elseif ($response['response']['code'] == 400) {
			$error = true;
			$response = json_decode(wp_remote_retrieve_body($response), true);
			$error_message .= "(400): " . $response['meta']['error_message'];
		} elseif ($response['response']['code'] == 404) {
			$error = true;
			$error_message .= "(404): " . $response['response']['message'];
		}

		if ($error == false) {
			set_transient('instagram_carousel_response', $response, 10);	
		}

	}


	// CONVERT RAW RESPONSE INTO DATA ARRAY
	$response = json_decode(wp_remote_retrieve_body($response), true);
	$data = $response['data'];

	// IF QUERY IS SUCCESSFUL CHECK FOR EMPTY DATA
	if ($error == false && empty($data)) {
		$error = true;
		$error_message .= sprintf(": %s", esc_html__("Query successful but returned no content.", "loc-canon-belle"));
	}

	// echo "<br><br>";
	// var_dump($error_message);


?>

		<?php if ($error == false) :  ?>

			<div class="hero-carousel element-block-carousel element-block-instagram-carousel clearfix">

				<div class="block-carousel-nav owl-carousel-nav">
				    <a class="prev-btn"><i class="fa fa-angle-left"></i></a>
				    <a class="next-btn"><i class="fa fa-angle-right"></i></a>
				</div>
				
				<div class="owl-carousel block-carousel"
					data-display_num_posts		= "<?php echo esc_attr($canon_options_frame['block_instagram_carousel_display_num_posts']); ?>"
					data-autoplay_speed			= "<?php echo esc_attr($canon_options_frame['block_instagram_carousel_autoplay_speed']); ?>"	
					data-stop_on_hover			= "<?php echo esc_attr($canon_options_frame['block_instagram_carousel_stop_on_hover']); ?>"
					data-pagination 			= "<?php echo esc_attr($canon_options_frame['block_instagram_carousel_pagination']); ?>"
				>

				<?php

					for ($i = 0; $i < count($data); $i++) { 

						$this_item = $data[$i];
						$date = date_i18n(get_option('date_format'), $this_item['created_time']);

		                // ITEM WRAPPER
		                echo ' <div class="item">';

		                // FEATURED IMAGE

						echo "<div class='tc-hover-container tc-effect-fade'><div class='tc-hover'>";		
						printf('<img src="%s" alt="%s" />', esc_url($this_item['images']['standard_resolution']['url']), esc_attr($this_item['caption']['text']));	

						echo '<div class="tc-hover-content-container">';
						echo '<div class="tc-hover-content">';

						printf('<h3><a href="%s" target="_blank">%s</a> <div class="dateMeta">%s</div><div class="user-meta"><a href="https://instagram.com/%s" target="_blank">%s</a></h3>'
							, esc_url($this_item['link'])
							, canon_fw_make_excerpt(wp_kses_post($this_item['caption']['text']), $canon_options_frame['block_instagram_carousel_excerpt_length'], false)
							, esc_attr($date)
							, esc_attr($this_item['user']['username'])
							, esc_attr($this_item['user']['username'])
						);

						echo '</div>';
						echo '</div>';

	                    echo "</div></div>";

		                // END ITEM WRAPPER
		            	echo '</div>';

		            }

		        ?>


				    

				</div>
				<!-- end owl-carousel -->

			</div>

		<?php else : ?>

			<?php printf('<div class="element-block-error"><h2>Instagram Carousel</h2><div class="error-message">%s</div></div>', wp_kses_post($error_message)); ?>

		<?php endif; ?>

