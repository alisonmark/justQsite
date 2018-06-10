<?php
	
	// GET OPTIONS
	$canon_options = get_option('canon_options'); 
	$canon_options_frame = get_option('canon_options_frame'); 

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") { 
        if (isset($_GET['block_post_grid_layout'])) { $canon_options_frame['block_post_grid_layout'] = wp_filter_nohtml_kses($_GET['block_post_grid_layout']); }
    }

?>

        <?php get_template_part('inc/templates/elements/template_element_block_post_grid_' . $canon_options_frame['block_post_grid_layout']); ?>
