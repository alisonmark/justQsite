	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>

		<h2><?php printf( "%s %s - %s", esc_attr(wp_get_theme()->Name), esc_html__("Settings", "loc-canon-belle"), esc_html__("Help Center", "loc-canon-belle") ); ?></h2>

		<br><br>

		<!-- TABS -->		
			<div class="tab_control">
			
				<input type="hidden" id="show_tab" name="canon_options_help[show_tab]" value="<?php if (isset($canon_options_help['show_tab'])) {echo esc_attr($canon_options_help['show_tab']);} else {echo "theme_docs";} ?>">

				<div class="theme_docs settings_tab current_tab" data-tab="theme_docs">
					<?php esc_html_e("Theme documentation", "loc-canon-belle"); ?>
				</div>

<!-- 				<div class="tutorial_videos settings_tab" data-tab="tutorial_videos">
					<?php esc_html_e("Tutorial Videos", "loc-canon-belle"); ?>
				</div>
 -->
				<div class="codex settings_tab last_tab" data-tab="codex">
					<?php esc_html_e("WordPress Codex", "loc-canon-belle"); ?>
				</div>

				<div class="tab_divider">
					<hr>
				</div>

			</div>

		<!-- THEME DOCS -->		
			<div class="theme_docs tab_section">

				<iframe 
					name="theme_docs" 
					src="http://themecanon.net/docs/belle/" 
					frameborder="0" 
					scrolling="auto" 
					width="100%" 
					height="5000px" 
					marginwidth="5" 
					marginheight="5"
				>
				</iframe> 

			</div>

		<!-- TUTORIAL VIDEOS-->		
			<div class="tutorial_videos tab_section">

				<div class="tutorial_videos_container">

					<iframe 
						src="//www.youtube.com/embed/videoseries?list=PLeRq9LbHO1hXKK5YYpgSAhQ_0A94-OPl3" 
						frameborder="0" 
						allowfullscreen>
					</iframe>

					
				</div>


			</div>

		<!-- CODEX -->		
			<div class="codex tab_section">

				<iframe 
					name="faq" 
					src="http://codex.wordpress.org/" 
					frameborder="0" 
					scrolling="auto" 
					width="100%" 
					height="5000px" 
					marginwidth="5" 
					marginheight="5"
				>
				</iframe> 


			</div>


	</div>

