	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_html__("Settings", "loc-canon-belle"), esc_html__("Posts & Pages", "loc-canon-belle") ); ?></h2>

		<?php 
			//delete_option('canon_options_post');

			// GET VARS
			$canon_options_post = get_option('canon_options_post'); 
			$canon_theme_name = wp_get_theme()->Name;

			// ARRAY VALUES
			$canon_options_post['archive_ads'] = array_values($canon_options_post['archive_ads']);
			update_option('canon_options_post', $canon_options_post);

			// GET ARRAY OF REGISTERED SIDEBARS
			$registered_sidebars_array = array();
			foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) { array_push($registered_sidebars_array, $value); }

			// GET CAT LIST
			$cat_list = get_categories(array('hide_empty' => 0));
			$cat_list = array_values($cat_list);

			// var_dump($canon_options_post);

		?>

		<br>
		
		<div class="options_wrapper canon-options">
		
			<div class="table_container">

				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('group_canon_options_post'); ?>				<!-- very important to add these two functions as they mediate what wordpress generates automatically from the functions.php -->
					<?php do_settings_sections('handle_canon_options_post'); ?>		


					<?php submit_button(); ?>


					<!-- 

						INDEX

						HOMEPAGE
						CATEGORY
						OTHER ARCHIVE PAGES
						SINGLE PAGE
						SINGLE POST
						META INFO AND SHARE LINKS
						ARCHIVE HEADER
						SEARCH 
						404
						ARCHIVE ADS
						REVOLUTION SLIDER
						WOOCOMMERCE
					
					-->


					<!-- 
					--------------------------------------------------------------------------
						HOMEPAGE
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php esc_html_e("Homepage", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>

							<?php echo wp_kses_post(__('The theme homepage. Displays your latest posts. Can display a feature at the top of the page. Go to <i>Header & Footer > Homepage Feature Builder</i> to setup feature.', 'loc-canon-belle')); ?>

							<br><br>
							
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Layout', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose a layout. Layouts can have sidebar or no sidebar.', 'loc-canon-belle'),
										wp_kses_post(__('<i>Masonry</i>: Column layout where posts rearrange to form a masonry pattern.', 'loc-canon-belle')),
										wp_kses_post(__('<i>Even grid</i>: Column layout where posts arrange into an even grid.', 'loc-canon-belle')),
										wp_kses_post(__('<i>Classic</i>: Classic blog layout with featured image to the left and text to the right.', 'loc-canon-belle')),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Number of columns', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select number of columns for column layouts.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Sidebar', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Drop cap excerpt', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Drop cap first letter in post excerpt.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set the excerpt length in approx. number of characters before cut-off.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose type of pagination.', 'loc-canon-belle'),
									),
								)); 

							?>

						</div>

						<table class='form-table homepage-section group-page-setups'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Homepage layout', 'loc-canon-belle'),
									'slug' 					=> 'homepage_layout',
									'select_options'		=> array(
										'masonry'				=> esc_html__('Masonry', 'loc-canon-belle'),
										'masonry_sidebar'		=> esc_html__('Masonry with sidebar', 'loc-canon-belle'),
										'even'					=> esc_html__('Even grid', 'loc-canon-belle'),
										'even_sidebar'			=> esc_html__('Even grid with sidebar', 'loc-canon-belle'),
										'classic'				=> esc_html__('Classic', 'loc-canon-belle'),
										'classic_sidebar'		=> esc_html__('Classic with sidebar', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Number of columns', 'loc-canon-belle'),
									'slug' 					=> 'homepage_num_columns',
									'select_options'		=> array(
										'1'						=> esc_html__('1 Column', 'loc-canon-belle'),
										'2'						=> esc_html__('2 Columns', 'loc-canon-belle'),
										'3'						=> esc_html__('3 Columns', 'loc-canon-belle'),
										'4'						=> esc_html__('4 Columns', 'loc-canon-belle'),
									),
									'listen_to'				=> '#homepage_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Sidebar for homepage', 'loc-canon-belle'),
									'slug' 					=> 'homepage_sidebar',
									'listen_to'				=> '#homepage_layout',
									'listen_for'			=> 'masonry_sidebar even_sidebar classic_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Drop cap excerpt', 'loc-canon-belle'),
									'slug' 					=> 'homepage_drop_cap',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'slug' 					=> 'homepage_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'slug' 					=> 'homepage_pagination',
									'select_options'		=> array(
										'prevnext'				=> esc_html__('Previous/next', 'loc-canon-belle'),
										'prevnext_ajax'			=> esc_html__('Previous/next (AJAX)', 'loc-canon-belle'),
										'links'					=> esc_html__('Links', 'loc-canon-belle'),
										'links_ajax'			=> esc_html__('Links (AJAX)', 'loc-canon-belle'),
										'loadmore_ajax'			=> esc_html__('Load more (AJAX)', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>

						</table>


					<!-- 
					--------------------------------------------------------------------------
						CATEGORY
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php esc_html_e("Category", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>
							
							<?php echo wp_kses_post(__('Category pages display posts from a certain category. To add a category page to your site go to <i>Appearance > Menus > Categories</i>. Select a category and click the Add to Menu button. Drag and drop the new menu item to the desired location in the menu.', 'loc-canon-belle')); ?>

							<br><br>
							
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Layout', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose a layout. Layouts can have sidebar or no sidebar.', 'loc-canon-belle'),
										wp_kses_post(__('<i>Masonry</i>: Column layout where posts rearrange to form a masonry pattern.', 'loc-canon-belle')),
										wp_kses_post(__('<i>Even grid</i>: Column layout where posts arrange into an even grid.', 'loc-canon-belle')),
										wp_kses_post(__('<i>Classic</i>: Classic blog layout with featured image to the left and text to the right.', 'loc-canon-belle')),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Number of columns', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select number of columns for column layouts.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Sidebar', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Drop cap excerpt', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Drop cap first letter in post excerpt.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set the excerpt length in approx. number of characters before cut-off.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose type of pagination.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show category title', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose to display the category title at the top of category pages.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show category description', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose to display the category description at the top of category pages.', 'loc-canon-belle'),
										wp_kses_post(__('You can set the category description at <i>Posts > Categories > Your category > Description</i>.', 'loc-canon-belle')),
									),
								)); 

							?>

						</div>

						<table class='form-table cat-section group-page-setups'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Category layout', 'loc-canon-belle'),
									'slug' 					=> 'cat_layout',
									'select_options'		=> array(
										'masonry'				=> esc_html__('Masonry', 'loc-canon-belle'),
										'masonry_sidebar'		=> esc_html__('Masonry with sidebar', 'loc-canon-belle'),
										'even'					=> esc_html__('Even grid', 'loc-canon-belle'),
										'even_sidebar'			=> esc_html__('Even grid with sidebar', 'loc-canon-belle'),
										'classic'				=> esc_html__('Classic', 'loc-canon-belle'),
										'classic_sidebar'		=> esc_html__('Classic with sidebar', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Number of columns', 'loc-canon-belle'),
									'slug' 					=> 'cat_num_columns',
									'select_options'		=> array(
										'1'						=> esc_html__('1 Column', 'loc-canon-belle'),
										'2'						=> esc_html__('2 Columns', 'loc-canon-belle'),
										'3'						=> esc_html__('3 Columns', 'loc-canon-belle'),
										'4'						=> esc_html__('4 Columns', 'loc-canon-belle'),
									),
									'listen_to'				=> '#cat_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Sidebar for category pages', 'loc-canon-belle'),
									'slug' 					=> 'cat_sidebar',
									'listen_to'				=> '#cat_layout',
									'listen_for'			=> 'masonry_sidebar even_sidebar classic_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Drop cap excerpt', 'loc-canon-belle'),
									'slug' 					=> 'cat_drop_cap',
									'listen_to'				=> '#cat_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'slug' 					=> 'cat_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'slug' 					=> 'cat_pagination',
									'select_options'		=> array(
										'prevnext'				=> esc_html__('Previous/next', 'loc-canon-belle'),
										'prevnext_ajax'			=> esc_html__('Previous/next (AJAX)', 'loc-canon-belle'),
										'links'					=> esc_html__('Links', 'loc-canon-belle'),
										'links_ajax'			=> esc_html__('Links (AJAX)', 'loc-canon-belle'),
										'loadmore_ajax'			=> esc_html__('Load more (AJAX)', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show category title', 'loc-canon-belle'),
									'slug' 					=> 'show_cat_title',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show category description', 'loc-canon-belle'),
									'slug' 					=> 'show_cat_description',
									'options_name'			=> 'canon_options_post',
								)); 

							?>

						</table>

					<!-- 
					--------------------------------------------------------------------------
						OTHER ARCHIVE PAGES
				    -------------------------------------------------------------------------- 
					-->

						<h3 class="group-page-setups"><?php esc_html_e("Other archive pages", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help group-page-setups'>
							
							<?php esc_html_e('Other archive pages are pages such as search results, author pages, tag pages, date pages (day, month, year) etc.', 'loc-canon-belle') ?>

							<br><br>
							
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Layout', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose a layout. Layouts can have sidebar or no sidebar.', 'loc-canon-belle'),
										wp_kses_post(__('<i>Masonry</i>: Column layout where posts rearrange to form a masonry pattern.', 'loc-canon-belle')),
										wp_kses_post(__('<i>Even grid</i>: Column layout where posts arrange into an even grid.', 'loc-canon-belle')),
										wp_kses_post(__('<i>Classic</i>: Classic blog layout with featured image to the left and text to the right.', 'loc-canon-belle')),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Number of columns', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select number of columns for column layouts.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Sidebar', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select what widget area to use in sidebar if sidebar layout is selected.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Drop cap excerpt', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Drop cap first letter in post excerpt.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set the excerpt length in approx. number of characters before cut-off.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose type of pagination.', 'loc-canon-belle'),
									),
								)); 

							?>


						</div>

						<table class='form-table archive-section group-page-setups'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Archive layout', 'loc-canon-belle'),
									'slug' 					=> 'archive_layout',
									'select_options'		=> array(
										'masonry'				=> esc_html__('Masonry', 'loc-canon-belle'),
										'masonry_sidebar'		=> esc_html__('Masonry with sidebar', 'loc-canon-belle'),
										'even'					=> esc_html__('Even grid', 'loc-canon-belle'),
										'even_sidebar'			=> esc_html__('Even grid with sidebar', 'loc-canon-belle'),
										'classic'				=> esc_html__('Classic', 'loc-canon-belle'),
										'classic_sidebar'		=> esc_html__('Classic with sidebar', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Number of columns', 'loc-canon-belle'),
									'slug' 					=> 'archive_num_columns',
									'select_options'		=> array(
										'1'						=> esc_html__('1 Column', 'loc-canon-belle'),
										'2'						=> esc_html__('2 Columns', 'loc-canon-belle'),
										'3'						=> esc_html__('3 Columns', 'loc-canon-belle'),
										'4'						=> esc_html__('4 Columns', 'loc-canon-belle'),
									),
									'listen_to'				=> '#archive_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Sidebar for archive', 'loc-canon-belle'),
									'slug' 					=> 'archive_sidebar',
									'listen_to'				=> '#archive_layout',
									'listen_for'			=> 'masonry_sidebar even_sidebar classic_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Drop cap excerpt', 'loc-canon-belle'),
									'slug' 					=> 'archive_drop_cap',
									'listen_to'				=> '#archive_layout',
									'listen_for'			=> 'masonry masonry_sidebar even even_sidebar',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Excerpt length', 'loc-canon-belle'),
									'slug' 					=> 'archive_excerpt_length',
									'min'					=> '1',									// optional
									'max'					=> '1000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(characters)',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Pagination', 'loc-canon-belle'),
									'slug' 					=> 'archive_pagination',
									'select_options'		=> array(
										'prevnext'				=> esc_html__('Previous/next', 'loc-canon-belle'),
										'prevnext_ajax'			=> esc_html__('Previous/next (AJAX)', 'loc-canon-belle'),
										'links'					=> esc_html__('Links', 'loc-canon-belle'),
										'links_ajax'			=> esc_html__('Links (AJAX)', 'loc-canon-belle'),
										'loadmore_ajax'			=> esc_html__('Load more (AJAX)', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>


						</table>


					<!-- HORIZONTAL DIVIDER -->
					<br><hr><br>


					<!-- 
					--------------------------------------------------------------------------
						SINGLE PAGE
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Single Page", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show comments', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Displays comments and comment reply form.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show comments', 'loc-canon-belle'),
									'slug' 					=> 'page_show_comments',
									'options_name'			=> 'canon_options_post',
								)); 

							 ?>	

						</table>


					<!-- 
					--------------------------------------------------------------------------
						SINGLE POST
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Single Post", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Default post style', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Default style for single posts. Post style can also be changed in each individual post.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Use dropcap', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Drop cap the first letter in content.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show tags', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Display tags associated with your post.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show comments', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Displays comments and comment reply form.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show post navigation', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Adds post navigation to posts. Use this to navigate between previous and next post relative to the current post.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Post navigate only same category posts', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The prev/next post navigation only navigates posts from the same category as the current post.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Ad code', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Insert your ad code or ad HTML here. If you are unsure what code to use you should consult your ad provider.', 'loc-canon-belle'),
										wp_kses_post(__('To display the ad in your single posts remember to check the checkbox <i>Your post > Post settings > Post component: Ad > Show ad</i>.', 'loc-canon-belle')),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('Default post style', 'loc-canon-belle'),
									'slug' 					=> 'single_default_post_style',
									'select_options'		=> array(
										'full'					=> esc_html__('Full width featured image', 'loc-canon-belle'),
										'compact'				=> esc_html__('Compact featured image', 'loc-canon-belle'),
										'full_sidebar'			=> esc_html__('Full width featured image and sidebar', 'loc-canon-belle'),
										'compact_sidebar'		=> esc_html__('Compact featured image and sidebar', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Use dropcap', 'loc-canon-belle'),
									'slug' 					=> 'single_use_dropcap',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show tags', 'loc-canon-belle'),
									'slug' 					=> 'show_tags',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show comments', 'loc-canon-belle'),
									'slug' 					=> 'show_comments',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show post navigation', 'loc-canon-belle'),
									'slug' 					=> 'show_post_nav',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Post navigate only same category posts', 'loc-canon-belle'),
									'slug' 					=> 'post_nav_same_cat',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> esc_html__('Ad code', 'loc-canon-belle'),
									'slug' 					=> 'post_component_ad_code',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_post',
								)); 

							 ?>	

						</table>


					<!-- 
					--------------------------------------------------------------------------
						META INFO AND SHARE LINKS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Meta info and share links", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show meta info', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose what meta info to display in posts and on archive pages.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show share links', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose what share links to display in posts and on archive pages.', 'loc-canon-belle'),
									),
								)); 

							 ?>		

						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show meta info: categories', 'loc-canon-belle'),
									'slug' 					=> 'show_meta_categories',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show meta info: author', 'loc-canon-belle'),
									'slug' 					=> 'show_meta_author',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show meta info: publish date', 'loc-canon-belle'),
									'slug' 					=> 'show_meta_date',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show meta info: comments', 'loc-canon-belle'),
									'slug' 					=> 'show_meta_comments',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show meta info: likes', 'loc-canon-belle'),
									'slug' 					=> 'show_meta_likes',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Show meta info: views', 'loc-canon-belle'),
									'slug' 					=> 'show_meta_views',
									'options_name'			=> 'canon_options_post',
								)); 


							 ?>	

							 <!-- DIVIDER -->
							 <tr><td colspan="2"><hr></td></tr>

							<?php 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Share link: Facebook', 'loc-canon-belle'),
									'slug' 					=> 'show_share_link_facebook',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Share link: Twitter', 'loc-canon-belle'),
									'slug' 					=> 'show_share_link_twitter',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Share link: Google Plus', 'loc-canon-belle'),
									'slug' 					=> 'show_share_link_google_plus',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Share link: Pinterest', 'loc-canon-belle'),
									'slug' 					=> 'show_share_link_pinterest',
									'options_name'			=> 'canon_options_post',
								)); 

							?>

						</table>




					<!-- 
					--------------------------------------------------------------------------
						ARCHIVE HEADER
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Archive Header", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Padding top / bottom', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Set amount of padding for the archive header.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Archive header images', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select a default image to use as background for the archive header. You can also set a custom image for each of the category pages. If no image is set for a category the default image will be used.', 'loc-canon-belle'),
									),
								)); 


							?>

						</div>

						<table class='form-table'>

							<?php
								
								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Padding top', 'loc-canon-belle'),
									'slug' 					=> 'archive_header_padding_top',
									'min'					=> '1',									// optional
									'max'					=> '10000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(pixels)',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'number',
									'title' 				=> esc_html__('Padding bottom', 'loc-canon-belle'),
									'slug' 					=> 'archive_header_padding_bottom',
									'min'					=> '1',									// optional
									'max'					=> '10000',								// optional
									'step'					=> '1',									// optional
									'width_px'				=> '60',								// optional
									'postfix'				=> '(pixels)',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'upload',
									'title' 				=> esc_html__('Default archive header image', 'loc-canon-belle'),
									'slug' 					=> 'archive_header_image_default',
									'btn_text'				=> esc_html__('Select image', 'loc-canon-belle'),
									'options_name'			=> 'canon_options_post',
								)); 
								
							?>

							 <!-- DIVIDER -->
							 <tr><td colspan="2"><hr></td></tr>

							<?php


								for ($i = 0; $i < count($cat_list); $i++) { 

									canon_fw_option(array(
										'type'					=> 'upload',
										'title' 				=> esc_html__('Category: ', 'loc-canon-belle') . $cat_list[$i]->name,
										'slug' 					=> 'archive_header_cat_'. $cat_list[$i]->slug,
										'btn_text'				=> esc_html__('Select image', 'loc-canon-belle'),
										'options_name'			=> 'canon_options_post',
									)); 

								}



							?>		

						</table>

					<!-- 
					--------------------------------------------------------------------------
						SEARCH 
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Search", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Search box text', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The text that displays inside the search box.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Search post types', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select what post types to include in search. Notice that deselecting all post types will result in no filters being applied to search (default WordPress behaviour) and all post types containing the search term will be returned on the search results page. This may not always be what you want as a lot of custom post types are for internal theme/plugin use only and are not meant to be viewed as regular posts. Correct styling and functionality of search results can only be guaranteed for posts and pages. Including custom post types in search is to be viewed as "experimental" and is "use-at-own-risk".', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Custom post types', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('What custom post types to include in search when Search custom post types has been selected. Separate with commas. Notice that you need to put in the custom post type slug. If you are unsure what the slug of a certain custom post type is please consult the plugin documentation or the plugin author.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Search widget areas', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Search buttons like those that can be added to the header will activate a full screen search window. This window has a search area as well as a widget area consisting of 5 widget columns.', 'loc-canon-belle'),
										esc_html__('Select what widget areas to display in the 5 search widget columns. You have to select widget areas for at least 2 of the 5 columns. Column widths will adjust to the number of active columns.', 'loc-canon-belle'),
										esc_html__('If you do not want to display widgets in your search window select widget areas for at least 2 of the 5 columns but leave the widget areas empty.', 'loc-canon-belle'),
									),
								)); 

							?>

						</div>

						<table class='form-table'>

							<?php
								
								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Search box text', 'loc-canon-belle'),
									'slug' 					=> 'search_box_text',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 
							
								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Search posts', 'loc-canon-belle'),
									'slug' 					=> 'search_posts',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Search pages', 'loc-canon-belle'),
									'slug' 					=> 'search_pages',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'checkbox',
									'title' 				=> esc_html__('Search custom post types', 'loc-canon-belle'),
									'slug' 					=> 'search_cpt',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('Custom post types', 'loc-canon-belle'),
									'slug' 					=> 'search_cpt_source',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 
							
								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Search Widget Area 1', 'loc-canon-belle'),
									'slug' 					=> 'search_widget_area_1',
									'select_options'		=> array(
										'off'					=> esc_html__('Off', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Search Widget Area 2', 'loc-canon-belle'),
									'slug' 					=> 'search_widget_area_2',
									'select_options'		=> array(
										'off'					=> esc_html__('Off', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Search Widget Area 3', 'loc-canon-belle'),
									'slug' 					=> 'search_widget_area_3',
									'select_options'		=> array(
										'off'					=> esc_html__('Off', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Search Widget Area 4', 'loc-canon-belle'),
									'slug' 					=> 'search_widget_area_4',
									'select_options'		=> array(
										'off'					=> esc_html__('Off', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Search Widget Area 5', 'loc-canon-belle'),
									'slug' 					=> 'search_widget_area_5',
									'select_options'		=> array(
										'off'					=> esc_html__('Off', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

							?>			

						</table>

					<!-- 
					--------------------------------------------------------------------------
						404
				    -------------------------------------------------------------------------- 
					-->

						<h3>404 <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('404 layout', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Choose between full width or sidebar layout.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('404 title', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Title that displays on the 404-page.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('404 message', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Message to display on the 404-page.', 'loc-canon-belle'),
									),
								)); 

							?>
						</div>

						<table class='form-table'>

							<?php 

								canon_fw_option(array(
									'type'					=> 'select',
									'title' 				=> esc_html__('404 Layout', 'loc-canon-belle'),
									'slug' 					=> '404_layout',
									'select_options'		=> array(
										'full'				=> esc_html__('Full width', 'loc-canon-belle'),
										'sidebar'			=> esc_html__('Sidebar', 'loc-canon-belle'),
									),
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'select_sidebar',
									'title' 				=> esc_html__('Sidebar for 404 page', 'loc-canon-belle'),
									'slug' 					=> '404_sidebar',
									'listen_to'				=> '#404_layout',
									'listen_for'			=> 'sidebar',
									'options_name'			=> 'canon_options_post',
								)); 
								
								canon_fw_option(array(
									'type'					=> 'text',
									'title' 				=> esc_html__('404 title', 'loc-canon-belle'),
									'slug' 					=> '404_title',
									'class'					=> 'widefat',
									'options_name'			=> 'canon_options_post',
								)); 

								canon_fw_option(array(
									'type'					=> 'textarea',
									'title' 				=> esc_html__('404 message', 'loc-canon-belle'),
									'slug' 					=> '404_msg',
									'cols'					=> '100',
									'rows'					=> '5',
									'options_name'			=> 'canon_options_post',
								)); 
							
							?>			

						</table>
						
						
						
					<!-- 
					--------------------------------------------------------------------------
						ARCHIVE ADS
				    -------------------------------------------------------------------------- 
					-->

						<h3><?php esc_html_e("Archive ads", "loc-canon-belle"); ?> <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

						<div class='contextual-help'>
							<?php 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Ads', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Use this section to put ads in your archive streams. You can use the Add and Delete buttons to add and remove ads.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show ad after post number', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Your ad will show up after these number of posts on archive pages. You can add more posts separated by comma. "5, 10" will make your ad appear after post number 5 and 10 on the selected archive page. Do notice that these numbers are NOT the ID of each individual post - they are simply how many posts to display before your ad will appear.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Ad code', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('The ad code. If you are unsure what code to use you should consult your ad-provider.', 'loc-canon-belle'),
									),
								)); 

								canon_fw_option_help(array(
									'type'					=> 'standard',
									'title' 				=> esc_html__('Show on', 'loc-canon-belle'),
									'content' 				=> array(
										esc_html__('Select what archive pages to put this ad on.', 'loc-canon-belle'),
									),
								)); 


							?>
						</div>

						<table class='form-table archive_ads'>

							<tr valign='top' class='archive_ads_row'>
								<th scope='row'><?php esc_html_e("Ads", "loc-canon-belle"); ?></th>
								<td>
									<ul class="ul_sortable"  data-split_index="2" data-placeholder="ul_sortable_archive_ads_placeholder">

										<?php for ($i = 0; $i < count($canon_options_post['archive_ads']); $i++) : ?>

											<li>

												<p>
													<button class="button ul_del_this right"><?php esc_html_e("delete", "loc-canon-belle"); ?></button>
													<label><?php esc_html_e("Show ad after post number", "loc-canon-belle"); ?></label><br>
													<input type='text' class='li_option widefat' name='canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][append_to_posts]' value='<?php if (isset($canon_options_post['archive_ads'][$i]['append_to_posts'])) echo esc_attr($canon_options_post['archive_ads'][$i]['append_to_posts']); ?>'>
												</p>

												<p>
													<label><?php esc_html_e("Ad code", "loc-canon-belle"); ?></label><br>
													<textarea 
														id='ad_code_id' 
														name='canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][ad_code]' 
														class="li_option" 
														cols=5
														rows=10
													><?php if (isset($canon_options_post['archive_ads'][$i]['ad_code'])) echo esc_attr($canon_options_post['archive_ads'][$i]['ad_code']); ?></textarea>
												</p>

												<p class="archive_ads_checkboxes">

														<span><?php esc_html_e("Show on", "loc-canon-belle"); ?>: </span>
														<span>
															<input class="li_option" type="hidden" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ad_homepage]" value="unchecked" />
															<input class="checkbox li_option" type="checkbox" id="show_ad_homepage" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ad_homepage]" value="checked" <?php if (isset($canon_options_post['archive_ads'][$i]['show_ad_homepage'])) { checked($canon_options_post['archive_ads'][$i]['show_ad_homepage'] == "checked"); } ?>/> <?php esc_html_e("Homepage", "loc-canon-belle"); ?>
														</span>
														<span>
															<input class="li_option" type="hidden" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ad_category]" value="unchecked" />
															<input class="checkbox li_option" type="checkbox" id="show_ad_category" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ad_category]" value="checked" <?php if (isset($canon_options_post['archive_ads'][$i]['show_ad_category'])) { checked($canon_options_post['archive_ads'][$i]['show_ad_category'] == "checked"); } ?>/> <?php esc_html_e("Category", "loc-canon-belle"); ?>
														</span>
														<span>
															<input class="li_option" type="hidden" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ad_archive]" value="unchecked" />
															<input class="checkbox li_option" type="checkbox" id="show_ad_archive" name="canon_options_post[archive_ads][<?php echo esc_attr($i); ?>][show_ad_archive]" value="checked" <?php if (isset($canon_options_post['archive_ads'][$i]['show_ad_archive'])) { checked($canon_options_post['archive_ads'][$i]['show_ad_archive'] == "checked"); } ?>/> <?php esc_html_e("Other archive pages", "loc-canon-belle"); ?>
														</span>

												</p>


											</li>

										<?php endfor; ?>

									</ul>

									<div class="ul_control" data-min="1" data-max="1000">
										<input type="button" class="button ul_add" value="<?php esc_html_e("Add", "loc-canon-belle"); ?>" />
										<input type="button" class="button ul_del" value="<?php esc_html_e("Delete", "loc-canon-belle"); ?>" />
									</div>

								</td>
							</tr>

						</table>


					<?php 

						if (class_exists('RevSlider')) {
						?>

					<!-- 
					--------------------------------------------------------------------------
						REVOLUTION SLIDER
				    -------------------------------------------------------------------------- 
					-->

							<h3>Revolution Slider <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Clean UI', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('By default the Revolution Slider (AKA Slider Revolution) interface contains practical information that is not relevant in themes where the Revolution Slider plugin comes bundled with the theme. This option will let you hide this information for a cleaner user interface.', 'loc-canon-belle'),
										),
									)); 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('A note on bundled plugins', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('This theme comes bundled with a free version of the Revolution Slider plugin. Please be aware that the free bundled version may not always be the latest version of the plugin. We update the bundled version regularly but not necessarily at the same time or every time a new version is released as we need time to test the updated plugin with our theme to ensure optimal compatibility. If you want to activate automatic updates for the Revolution Slider plugin or you urgently need the latest version of the plugin you will have to buy a regular license for the Revolution Slider plugin.', 'loc-canon-belle'),
										),
									)); 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Revolution Slider purchase code / purchase key / activation key', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('You can ignore any prompts for a Revolution Slider activation key as this only pertains to customers who have purchased a regular license for the plugin. With our theme you get a bundled version which works right after installation so you can just begin to use the plugin without any further steps.', 'loc-canon-belle'),
										),
									)); 


								?>

							</div>

							<table class='form-table'>

								<?php
								
									canon_fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> esc_html__('Clean user interface', 'loc-canon-belle'),
										'slug' 					=> 'revslider_clean_ui',
										'options_name'			=> 'canon_options_post',
									)); 

								?>

							</table>

						 		
						<?php	
						}
					?>



					<?php 

						if (is_plugin_active('woocommerce/woocommerce.php')) {
						?>

					<!-- 
					--------------------------------------------------------------------------
						WOOCOMMERCE
				    -------------------------------------------------------------------------- 
					-->

							<h3>WooCommerce <img src="<?php echo get_template_directory_uri() . '/img/help.png' ?>"></h3>

							<div class='contextual-help'>
								<?php 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Sidebar on shop and product pages', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('Choose to have a sidebar displayed on your shop and product pages.', 'loc-canon-belle'),
										),
									)); 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('What about the other WooCommerce pages?', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('Other WooCommerce pages use ordinary page templates. You can change which template to use for each of the WooCommerce pages (sidebar or full width page templates).', 'loc-canon-belle'),
										),
									)); 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Sidebar for WooCommerce pages', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('Choose which sidebar to use for your WooCommerce pages. This will be the same across all WooCommerce pages that have a sidebar.', 'loc-canon-belle'),
										),
									)); 

									canon_fw_option_help(array(
										'type'					=> 'standard',
										'title' 				=> esc_html__('Slider for shop page', 'loc-canon-belle'),
										'content' 				=> array(
											esc_html__('Choose which slider to use for your shop page', 'loc-canon-belle'),
										),
									)); 


								?>

							</div>

							<table class='form-table'>

								<?php
								
									canon_fw_option(array(
										'type'					=> 'checkbox',
										'title' 				=> esc_html__('Sidebar on shop and product pages', 'loc-canon-belle'),
										'slug' 					=> 'use_woocommerce_sidebar',
										'options_name'			=> 'canon_options_post',
									)); 

									canon_fw_option(array(
										'type'					=> 'select_sidebar',
										'title' 				=> esc_html__('Sidebar for WooCommerce pages', 'loc-canon-belle'),
										'slug' 					=> 'woocommerce_sidebar',
										'options_name'			=> 'canon_options_post',
									)); 
								
									canon_fw_option(array(
										'type'					=> 'select_revslider',
										'title' 				=> esc_html__('Slider for shop page', 'loc-canon-belle'),
										'select_options'		=> array(
											'no_slider'				=> esc_html__('No slider', 'loc-canon-belle'),
											''						=> esc_html__('---', 'loc-canon-belle')
										),
										'slug' 					=> 'woocommerce_shop_slider',
										'options_name'			=> 'canon_options_post',
									)); 

								?>

							</table>

						 		
						<?php	
						}
					?>




					<!-- END OPTIONS AND WRAP UP FILE -->

					<?php submit_button(); ?>

				</form>
			</div> <!-- end table container -->	

	
		</div>

	</div>

