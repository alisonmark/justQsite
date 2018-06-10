	<!-- NATIVE HEADER STUFF -->

	<?php $canon_options = get_option('canon_options'); ?>
	<?php $canon_options_frame = get_option('canon_options_frame'); ?>
	<?php $canon_options_appearance = get_option('canon_options_appearance'); ?>

		<?php if ($canon_options['hide_theme_meta_description'] != 'checked') { printf("<meta name='description' content='%s'>", esc_attr(get_bloginfo('description'))); } ?>

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- FAVICON -->

        <?php 

	        if (!function_exists('has_site_icon') || !has_site_icon()) {
	        	$favicon_url = (empty($canon_options['favicon_url'])) ? get_template_directory_uri() . "/img/favicon.ico" : $canon_options['favicon_url'];
	        	printf('<link rel="shortcut icon" href="%s" />', esc_url($favicon_url));
	        }

        ?>
        
	<!-- OPEN GRAPH: BLOG VERSION -->

		<?php 

			if ($canon_options['hide_theme_og'] != "checked" && $post) {

				// OG BASICS
				printf('<meta property="og:type" content="article" />');
				printf('<meta property="og:url" content="http://%s"/>', esc_attr($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]));
				printf('<meta property="og:site_name" content="%s" />', esc_attr(get_bloginfo('name')));

				// OG TITLE
				$og_title = (canon_fw_get_page_type() == 'single') ? strip_tags($post->post_title) : get_bloginfo('name');
				printf('<meta property="og:title" content="%s" />', esc_attr($og_title));

				// OG DESCRIPTION
				$og_description = get_bloginfo('description');	
				if (canon_fw_get_page_type() == "home") {
					$og_description = get_bloginfo('description');
				} elseif (!empty($post->post_content)) {
					$og_description = canon_fw_make_excerpt($post->post_content, 350, true);
				}
				printf('<meta property="og:description" content="%s" />', esc_attr($og_description));

				// OG IMAGE
				if (empty($canon_options_frame['logo_url'])) { $canon_options_frame['logo_url'] = get_template_directory_uri() . "/img/logo@2x.png"; }
				$og_img_src = array($canon_options_frame['logo_url']);
				if (canon_fw_get_page_type() == "home") {
					$og_img_src = array($canon_options_frame['logo_url']);
				} elseif (wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')) {
					$og_img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
				}
				printf('<meta property="og:image" content="%s" />', esc_url($og_img_src[0]));

			}

		?>