<?php 

	function canon_dynamic_css_admin() {
			
		$canon_options_post = get_option('canon_options_post');

 ?>


	<!-- DYNAMIC CSS ADMIN-->
	<style type="text/css">
	
		/* REVSLIDER UI */

		<?php if (class_exists('RevSlider') && $canon_options_post['revslider_clean_ui'] == "checked") : ?>

			.rs-dashboard, 
			.rs-update-history-wrapper,
			.rs-update-notice-wrap, 
			comma-guard {
				display: none!important;
			}
		
		
		<?php endif; ?>
		
	</style>


<?php 

	} // end function canon_dynamic_css_admin