<?php 

      $canon_options = get_option('canon_options'); 
      $canon_options_frame = get_option('canon_options_frame'); 

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['footer_pre_layout'])) { $canon_options_frame['footer_pre_layout'] = wp_filter_nohtml_kses($_GET['footer_pre_layout']); }
        if (isset($_GET['footer_main_layout'])) { $canon_options_frame['footer_main_layout'] = wp_filter_nohtml_kses($_GET['footer_main_layout']); }
        if (isset($_GET['footer_post_layout'])) { $canon_options_frame['footer_post_layout'] = wp_filter_nohtml_kses($_GET['footer_post_layout']); }
    }


?>

		<!-- FOOTER -->
		<footer>

            <?php 

                if ($canon_options_frame['footer_pre_layout'] != "off") { get_template_part('inc/templates/footer/template_' . $canon_options_frame['footer_pre_layout']); }
                if ($canon_options_frame['footer_main_layout'] != "off") { get_template_part('inc/templates/footer/template_footer_main'); }
                if ($canon_options_frame['footer_post_layout'] != "off") { get_template_part('inc/templates/footer/template_' . $canon_options_frame['footer_post_layout']); }


            ?>			

		</footer>