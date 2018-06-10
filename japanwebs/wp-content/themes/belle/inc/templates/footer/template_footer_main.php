<!-- TEMPLATE: template_footer_main -->

<?php
    
    // GET OPTIONS
    $canon_options = get_option('canon_options'); 
    $canon_options_frame = get_option('canon_options_frame');

    // DEV MODE OPTIONS
    if ($canon_options['dev_mode'] == "checked") {
        if (isset($_GET['footer_main_layout'])) { $canon_options_frame['footer_main_layout'] = wp_filter_nohtml_kses($_GET['footer_main_layout']); }
    }

?>

    <div class="outter-wrapper main-footer-container">

        <?php get_template_part('inc/templates/elements/template_element_' . $canon_options_frame['footer_main_layout']); ?>

    </div>
