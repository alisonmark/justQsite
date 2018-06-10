<?php $canon_options_post = get_option('canon_options_post'); ?>

                		<form id="searchform-standard" class="searchform" role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
                			<input type="text" id="searchform-input-standard" class="searchform-input full" name="s" placeholder="<?php echo esc_attr($canon_options_post['search_box_text']); ?>" />
                			<?php if (isset($_GET['lang'])) { printf("<input type='hidden' name='lang' value='%s' />", esc_attr($_GET['lang'])); } ?>
                			<input name="button" class="btn" type="submit" value="<?php esc_html_e('Search', 'loc-canon-belle'); ?>" id="send" />
                		</form>