<?php
	
	// GET OPTIONS
	$canon_options = get_option('canon_options'); 
	$canon_options_frame = get_option('canon_options_frame'); 

	// CONTROLLER CLASSES
	$controller_classes = "";
	if ($canon_options['overlay_header'] == "checked") { $controller_classes .= " overlay-header"; }

?>


		<div class="hero-search-feature element-block-search overlay-content <?php echo esc_attr($controller_classes); ?>">
			
            <style type="text/css" scoped>

               .element-block-search {
                    <?php if (!empty($canon_options_frame['block_search_bg_img_url'])) { printf("background-image: url('%s');", esc_url($canon_options_frame['block_search_bg_img_url'])); } ?>
                    <?php if (!empty($canon_options_frame['block_search_bg_color'])) { printf("background-color: %s;", esc_attr($canon_options_frame['block_search_bg_color'])); } ?>
                    <?php if (!empty($canon_options_frame['block_search_bg_attachment'])) { printf("background-attachment: %s;", esc_attr($canon_options_frame['block_search_bg_attachment'])); } ?>
                    <?php if (!empty($canon_options_frame['block_search_bg_size'])) { printf("background-size: %s;", esc_attr($canon_options_frame['block_search_bg_size'])); } ?>
                    <?php if (!empty($canon_options_frame['block_search_block_height'])) { printf("height: %spx;", esc_attr($canon_options_frame['block_search_block_height'])); } ?>
                }

                .element-block-search .inner-wrapper {
                    <?php if (!empty($canon_options_frame['block_search_content_top_margin'])) { printf("margin-top: %spx;", esc_attr($canon_options_frame['block_search_content_top_margin'])); } ?>
                }

                .element-block-search * {
                    <?php if (!empty($canon_options_frame['block_search_text_color'])) { printf("color: %s;", esc_attr($canon_options_frame['block_search_text_color'])); } ?>
                }

            </style>

			<div class="inner-wrapper centered">

				<?php if ($canon_options_frame['block_search_html']) { printf('<div class="block-search-text">%s</div>', wp_kses_post($canon_options_frame['block_search_html'])); } ?>


				<div class="hero-search-form-container">

	                <form id="searchform-hero" class="searchform hero-search-form" role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">

	                    <?php if ($canon_options_frame['block_search_in'] != "all_categories") { printf('<input type="hidden" value="%s" name="category_name" id="category_name" />', esc_attr($canon_options_frame['block_search_in'])); } ?>
	                    
	                    <input type="text" id="searchform-input-hero" class="searchform-input full" name="s" placeholder="<?php echo esc_attr($canon_options_frame['block_search_placeholder']); ?>" />
                		<?php if (isset($_GET['lang'])) { printf("<input type='hidden' name='lang' value='%s' />", esc_attr($_GET['lang'])); } ?>
						<button class="btn"><?php echo esc_attr($canon_options_frame['block_search_btn_text']); ?></button>

	                </form>


				</div>

			</div>

		</div> 